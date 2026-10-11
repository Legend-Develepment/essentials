<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Portable;
use LegendDevelopment\Theme\Support\NavIcon;
use LegendDevelopment\Theme\Support\AutoUpdater;
use LegendDevelopment\Theme\Support\Installed;
use LegendDevelopment\Theme\Support\Records;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

/**
 * A theme page of its own, so restyling the panel can be delegated without
 * handing out the plugin permissions - those also allow installing and deleting
 * plugins, which is a much bigger thing to give away.
 *
 * @property Schema $form
 */
class ThemeSettings extends Page implements HasSchemas
{
    use InteractsWithForms;

    /**
     * The row's icon, which can be a picture somebody uploaded.
     *
     * A method rather than the property, because the property is read once when
     * Filament builds the class and cannot ask anything - and this has to read a
     * setting. The property stays behind it as the fallback, so a panel where
     * getNavigationIcon() somehow never runs draws an icon rather than a gap.
     */
    protected static string|BackedEnum|null $navigationIcon = NavIcon::FALLBACK;

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return NavIcon::icon();
    }

    protected static ?string $slug = 'theme';

    /*
     * First in the plugin's own group: it is the page that says which version
     * is installed, and which of the rest exist at all.
     */
    protected static ?int $navigationSort = 1;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function getTitle(): string
    {
        return Theme::trans('page.title');
    }

    /**
     * The installed version, and an update the Essentials Auto Updater reports
     * as waiting, when that plugin is installed. Its summary is what it already
     * holds, so this costs nothing per render.
     */
    public function getSubheading(): ?string
    {
        return self::attempt(function (): string {
            $installed = 'v' . Installed::version();
            $update = AutoUpdater::plugin(Theme::id());

            return ($update['waiting'] ?? false) ? $installed . ' - ' . $update['sentence'] : $installed;
        }, null);
    }

    /**
     * The update check reads files on disk and reaches out over the network, and
     * both are asked about while this page renders. This is the page for setting
     * the panel's colours: neither may be able to take it down. Whatever went
     * wrong is reported to the log, and the page carries on as if the check had
     * no answer.
     *
     * @template T
     *
     * @param  callable(): T  $check
     * @param  T  $fallback
     * @return T
     */
    private static function attempt(callable $check, mixed $fallback): mixed
    {
        try {
            return $check();
        } catch (Throwable $exception) {
            report($exception);

            return $fallback;
        }
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('page.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        // Every page this plugin adds sits under one heading, named after the
        // plugin itself - read from plugin.json, so renaming the plugin renames
        // the heading rather than leaving four classes saying the old one.
        return Theme::name();
    }

    public function mount(): void
    {
        $this->form->fill(Settings::data());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grouped so read-only access can disable every field at once.
                // Updates and Features only. Everything else answers 'what does
                // the panel look like' and has a page of its own in the sidebar;
                // these two answer 'what is this plugin doing', which is one
                // question and belongs on the plugin's own page.
                Group::make(Settings::mainGroups())
                    ->disabled(fn () => !user()?->can(Theme::PERMISSION_UPDATE)),
            ])
            ->statePath('data');
    }

    /** The broad grant here, because this page writes settings from every feature. */
    public function maySave(): bool
    {
        return user()?->can(Theme::PERMISSION_UPDATE) ?? false;
    }

    public function save(): void
    {
        abort_unless(user()?->can(Theme::PERMISSION_UPDATE), 403);

        try {
            /*
             * Merged with what is stored, not the form's own state alone.
             *
             * persist() writes every setting the Look pages own, each with a
             * default for the key it was not handed - and this form carries
             * three fields. Saving a channel here reset sixty-nine settings
             * belonging to pages this one does not show, quietly, to values
             * nobody had chosen. Same shape as SettingsPage::save(), for the
             * same reason.
             */
            Settings::persist(array_merge(Settings::data(), $this->form->getState()));

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();

            // Reload, so the panel repaints with the colour that was just saved.
            $this->redirect(self::getUrl());
        } catch (Throwable $exception) {
            /*
             * Throwable, not Exception.
             *
             * A TypeError is an Error and not an Exception, so it walked
             * straight past the old catch and became a five hundred - which
             * the panel shows as "Error while loading page", a sentence with
             * nothing in it for the person reading it or for anybody trying
             * to fix it. This is the same fault the settings import had in
             * 2.48 and it deserves the same answer twice.
             *
             * Reported as well as shown: the message is for whoever pressed
             * Save, and the stack trace belongs in the log.
             */
            report($exception);

            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }

    /**
     * What the chosen file would change, in words, before it changes it.
     *
     * The upload is held rather than stored - storeFiles(false) - so it arrives
     * as a temporary file that can be read straight off disk and never becomes
     * something to clean up.
     */
    private static function summary(mixed $file): string
    {
        $json = self::contents($file);

        if ($json === null) {
            return Theme::trans('portable.summary_none');
        }

        $settings = Portable::parse($json);

        if ($settings === []) {
            return Theme::trans('portable.summary_unreadable');
        }

        $changes = Portable::changes($settings);

        // Said here as well as after the import, so a missing picture is not
        // news only once it is too late to go and fetch it first.
        $missing = Portable::missing($settings);
        $left = $missing === []
            ? ''
            : "\n" . Theme::trans('portable.missing', ['files' => implode(', ', $missing)]);

        if ($changes === []) {
            return Theme::trans('portable.summary_same') . $left;
        }

        // Named, up to a point. A list of sixty is not read; a count is.
        $lines = [];

        foreach (array_slice($changes, 0, 12) as $change) {
            $lines[] = '· ' . $change['key'] . ': ' . $change['from'] . ' → ' . $change['to'];
        }

        if (count($changes) > 12) {
            $lines[] = Theme::trans('portable.summary_more', ['count' => count($changes) - 12]);
        }

        return Theme::choice('portable.summary_count', count($changes))
            . "\n" . implode("\n", $lines) . $left;
    }

    private static function import(mixed $file): void
    {
        // The button is hidden without this permission, so reaching here means
        // something went round the button. Still says so rather than returning
        // quietly: every other way out of this method reports itself, and one
        // that does not is indistinguishable from the import silently failing.
        if (!user()?->can(Theme::PERMISSION_UPDATE)) {
            Notification::make()
                ->title(Theme::trans('portable.failed'))
                ->body(Theme::trans('portable.denied'))
                ->danger()
                ->send();

            return;
        }

        $json = self::contents($file);

        // Split from the parse below, so "no file arrived" and "the file is not
        // one of ours" stop sharing one message. They have different causes: an
        // upload that expired or was refused, against a file that is readable
        // and simply wrong.
        if ($json === null) {
            Notification::make()
                ->title(Theme::trans('portable.failed'))
                ->body(Theme::trans('portable.no_file'))
                ->danger()
                ->send();

            return;
        }

        $settings = Portable::parse($json);

        if ($settings === []) {
            Notification::make()
                ->title(Theme::trans('portable.failed'))
                ->body(Theme::trans('portable.summary_unreadable'))
                ->danger()
                ->send();

            return;
        }

        try {
            /*
             * Portable::apply() rather than one persist() call.
             *
             * It was Settings::persist() alone, which writes the main form and
             * nothing else - so importing a file silently skipped the login
             * screen, the system status page, the announcements and the sidebar
             * links, and reported a cheerful count of settings for the ones it
             * had bothered with. Which groups exist and how each is written is
             * Portable's business, next to the list it exports.
             */
            $missing = Portable::apply($settings);
            $body = Theme::choice('portable.summary_count', count($settings));

            /*
             * A warning rather than a success when a picture was left out, and
             * one that stays: the setting kept what it had, and the file names
             * something to copy across by hand before it can be what was meant.
             */
            if ($missing === []) {
                Notification::make()
                    ->title(Theme::trans('portable.imported'))
                    ->body($body)
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title(Theme::trans('portable.imported'))
                    ->body($body . ' ' . Theme::trans('portable.missing', ['files' => implode(', ', $missing)]))
                    ->warning()
                    ->persistent()
                    ->send();
            }
        } catch (Throwable $exception) {
            /*
             * Throwable, not Exception.
             *
             * This block's whole job is to say what went wrong, and for a while
             * it could not say the one thing most likely to happen here. An
             * imported file is outside data going into the same sanitisers the
             * form uses, and the way outside data breaks a sanitiser is a
             * TypeError - which extends Error, not Exception, and went straight
             * past this catch. Livewire answered the request with a 500 and the
             * modal simply closed, so pressing Apply looked like it did nothing
             * at all. A failure that reports itself as no failure is worse than
             * one that reports itself loudly.
             *
             * report() as well as the notification: the message on screen is for
             * whoever pressed the button, the log entry is for working out why.
             */
            report($exception);

            Notification::make()
                ->title(Theme::trans('portable.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * The uploaded file's contents, or null.
     *
     * Filament hands a held upload back as an array of one, which is worth
     * unwrapping here rather than in both callers.
     */
    private static function contents(mixed $file): ?string
    {
        $file = is_array($file) ? reset($file) : $file;

        if (!$file instanceof TemporaryUploadedFile) {
            return null;
        }

        try {
            if ($file->getSize() > Portable::MAX_BYTES) {
                return null;
            }

            $contents = $file->get();

            return is_string($contents) && $contents !== '' ? $contents : null;
        } catch (Throwable) {
            return null;
        }
    }

    /** @return array<Action> */
    protected function getHeaderActions(): array
    {
        return [
            // The Essentials Auto Updater's own page, when it is installed and
            // this reader may open it.
            Action::make('updater')
                ->label(fn (): string => (string) (AutoUpdater::status()['label'] ?? ''))
                ->icon('tabler-cloud-download')
                ->color('gray')
                ->url(fn (): ?string => AutoUpdater::status()['url'] ?? null)
                ->visible(fn (): bool => (AutoUpdater::status()['url'] ?? null) !== null),

            /*
             * In from a file, and back out again. For moving a look from a test
             * panel to a live one without setting sixty fields twice, and for
             * keeping a copy before trying something so there is something to
             * go back to.
             *
             * In first, because that is the order somebody asked for them in
             * and there is no reason it should be the other one: the two are a
             * pair, and which half of a pair comes first is a preference rather
             * than a rule. The export of the records follows them both, being
             * the odd one out rather than the middle of the three.
             */
            Action::make('import')
                ->label(fn () => Theme::trans('portable.import'))
                ->icon('tabler-file-upload')
                ->color('gray')
                ->visible(fn () => user()?->can(Theme::PERMISSION_UPDATE) ?? false)
                ->modalSubmitActionLabel(fn () => Theme::trans('portable.apply'))
                ->schema([
                    FileUpload::make('file')
                        ->label(fn () => Theme::trans('portable.file'))
                        ->helperText(fn () => Theme::trans('portable.file_helper'))
                        ->acceptedFileTypes(['application/json', 'text/plain'])
                        ->maxSize(Portable::MAX_BYTES / 1024)
                        ->storeFiles(false)
                        // So the summary below can be drawn from the file the
                        // moment it is chosen, rather than after it is applied.
                        ->live()
                        ->required(),

                    // TextEntry rather than a Placeholder: this is the one
                    // read-only schema component the panel itself uses, so it is
                    // the one known to render here.
                    TextEntry::make('summary')
                        ->label(fn () => Theme::trans('portable.summary'))
                        ->state(fn (Get $get): string => self::summary($get('file'))),
                ])
                ->action(function (array $data): void {
                    self::import($data['file'] ?? null);
                }),

            Action::make('export')
                ->label(fn () => Theme::trans('portable.export'))
                ->icon('tabler-file-download')
                ->color('gray')
                ->action(fn () => response()->streamDownload(
                    fn () => print (string) json_encode(Portable::export(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
                    Portable::filename(),
                    ['Content-Type' => 'application/json'],
                )),

            /*
             * The other export, and the difference matters.
             *
             * The one above carries settings: what the panel looks like, read
             * from .env, small enough to hand to somebody in a chat. This one
             * carries the records - what was sold, to whom, for how much - and
             * exists because Pelican's uninstall destroys all of it without
             * asking anything first. There is no hook to put a warning on, so
             * the only place a copy can be offered is before somebody goes
             * looking for the uninstall button, which is here.
             *
             * Offered only when there is something in it. A panel that never
             * switched the shop on has none of those tables, and a button that
             * downloads an empty file is a button that looks broken.
             */
            Action::make('records')
                ->label(fn () => Theme::trans('portable.records'))
                ->icon('tabler-archive')
                ->color('gray')
                ->visible(fn (): bool => (user()?->can(Theme::PERMISSION_UPDATE) ?? false) && Records::has())
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('portable.records_helper'))
                ->modalSubmitActionLabel(fn () => Theme::trans('portable.records'))
                ->action(fn () => response()->streamDownload(
                    static fn () => Records::stream(),
                    Records::filename(),
                    ['Content-Type' => 'application/json'],
                )),

            Action::make('save')
                ->label(Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save')
                ->authorize(fn () => user()?->can(Theme::PERMISSION_UPDATE))
                ->keyBindings(['mod+s']),
        ];
    }
}
