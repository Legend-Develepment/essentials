<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Plugin;
use BackedEnum;
use Exception;
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
use LegendDevelopment\Theme\Jobs\UpdateFromChannel;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\Portable;
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

    protected static string|BackedEnum|null $navigationIcon = 'tabler-adjustments';

    protected static ?string $slug = 'theme';

    /*
     * First in the plugin's own group: it is the page the update button is on,
     * and the page that says which of the rest exist at all.
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
     * The installed version, and whether a newer one is waiting. Pelican does
     * the version check itself and caches the result for ten minutes, so this
     * costs nothing per render.
     */
    public function getSubheading(): ?string
    {
        return self::attempt(function (): string {
            $installed = 'v' . Channels::installedVersion() . ' · ' . Theme::trans('settings.channel.' . Channels::current());

            // Worth saying out loud: a panel that updates itself is a panel that
            // can restyle overnight, and whoever is on this page should know.
            if (Channels::autoUpdate() !== Channels::AUTO_OFF) {
                $installed .= ' · ' . Theme::trans('settings.channel.auto.' . Channels::autoUpdate());
            }

            $latest = Channels::latest();

            return Channels::updateAvailable() && $latest !== null
                ? $installed . ' — ' . Theme::trans('page.update_available') . ' (v' . $latest['version'] . ')'
                : $installed;
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

    protected function plugin(): ?Plugin
    {
        try {
            return Plugin::find(Theme::id());
        } catch (Exception) {
            return null;
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

    public function save(): void
    {
        abort_unless(user()?->can(Theme::PERMISSION_UPDATE), 403);

        try {
            Settings::persist($this->form->getState());

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();

            // Reload, so the panel repaints with the colour that was just saved.
            $this->redirect(self::getUrl());
        } catch (Exception $exception) {
            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->body($exception->getMessage())
                ->danger()
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

        if ($changes === []) {
            return Theme::trans('portable.summary_same');
        }

        // Named, up to a point. A list of sixty is not read; a count is.
        $lines = [];

        foreach (array_slice($changes, 0, 12) as $change) {
            $lines[] = '· ' . $change['key'] . ': ' . $change['from'] . ' → ' . $change['to'];
        }

        if (count($changes) > 12) {
            $lines[] = Theme::trans('portable.summary_more', ['count' => count($changes) - 12]);
        }

        return Theme::trans('portable.summary_count', ['count' => count($changes)])
            . "\n" . implode("\n", $lines);
    }

    private static function import(mixed $file): void
    {
        if (!user()?->can(Theme::PERMISSION_UPDATE)) {
            return;
        }

        $json = self::contents($file);
        $settings = $json === null ? [] : Portable::parse($json);

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
             * Merged over the current settings and handed to the same persist()
             * the form uses. Merged, because the file leaves the uploads out and
             * writing a missing key would read as "put it back to the default";
             * persist(), because every value in that file has to meet the same
             * sanitiser it would have met had it been typed into the form.
             */
            Settings::persist(array_merge(Settings::data(), $settings));

            Notification::make()
                ->title(Theme::trans('portable.imported'))
                ->body(Theme::trans('portable.summary_count', ['count' => count($settings)]))
                ->success()
                ->send();
        } catch (Exception $exception) {
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
            /*
             * Out to a file, and back in again. For moving a look from a test
             * panel to a live one without setting sixty fields twice, and for
             * keeping a copy before trying something so there is something to
             * go back to.
             */
            Action::make('export')
                ->label(fn () => Theme::trans('portable.export'))
                ->icon('tabler-file-download')
                ->color('gray')
                ->action(fn () => response()->streamDownload(
                    fn () => print (string) json_encode(Portable::export(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
                    Portable::filename(),
                    ['Content-Type' => 'application/json'],
                )),

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

            // Mirrors the action on Admin -> Plugins: same job, same policy, so
            // updating from here behaves exactly the same as updating there.
            // Always present, so there is a way to act even when the page says
            // you are up to date: it drops the cached feed and looks again.
            Action::make('check')
                ->label(fn () => Theme::trans('page.check'))
                ->icon('tabler-refresh')
                ->color('gray')
                ->visible(fn (): bool => !self::attempt(fn (): bool => Channels::updateAvailable(), false))
                ->action(function (): void {
                    Channels::forget();

                    $latest = Channels::latest();

                    if ($latest === null) {
                        // Silence here is what made the last feed problem so hard
                        // to spot, so this says both what went wrong and which
                        // address it went wrong on - the address being the part
                        // that is usually the actual mistake.
                        $reason = Channels::lastError() ?? Theme::trans('page.check_failed_body');

                        Notification::make()
                            ->title(Theme::trans('page.check_failed'))
                            ->body($reason . ' — ' . (Channels::feed() ?? '?'))
                            ->danger()
                            ->persistent()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title(Channels::updateAvailable()
                            ? Theme::trans('page.update_available') . ' (v' . $latest['version'] . ')'
                            : Theme::trans('page.up_to_date'))
                        ->body('v' . $latest['version'])
                        ->success()
                        ->send();
                }),
            // Same version, installed again - for when an install went wrong.
            Action::make('reinstall')
                ->label(fn () => Theme::trans('page.reinstall'))
                ->icon('tabler-refresh-dot')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('page.update_confirm'))
                ->visible(fn (): bool => self::attempt(fn (): bool => !Channels::updateAvailable() && Channels::latest() !== null, false))
                ->authorize(fn (): bool => ($plugin = $this->plugin()) !== null
                    && (user()?->can('update', $plugin) ?? false))
                ->action(function (): void {
                    $latest = Channels::latest();

                    if ($latest === null) {
                        return;
                    }

                    UpdateFromChannel::dispatch(user(), $latest['download_url'], $latest['version']);

                    Notification::make()
                        ->title(Theme::trans('page.update_started'))
                        ->body(Theme::trans('page.update_background'))
                        ->success()
                        ->send();
                }),
            Action::make('update')
                ->label(fn () => Theme::trans('page.update'))
                ->icon('tabler-download')
                ->color('success')
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('page.update_confirm'))
                ->visible(fn (): bool => self::attempt(fn (): bool => Channels::updateAvailable(), false))
                ->authorize(fn (): bool => ($plugin = $this->plugin()) !== null
                    && (user()?->can('update', $plugin) ?? false))
                ->action(function (): void {
                    $latest = Channels::latest();

                    if ($latest === null) {
                        return;
                    }

                    try {
                        UpdateFromChannel::dispatch(user(), $latest['download_url'], $latest['version']);

                        Notification::make()
                            ->title(Theme::trans('page.update_started'))
                            ->body(Theme::trans('page.update_background'))
                            ->success()
                            ->send();
                    } catch (Exception $exception) {
                        Notification::make()
                            ->title(Theme::trans('page.update_failed'))
                            ->body($exception->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Action::make('save')
                ->label(Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save')
                ->authorize(fn () => user()?->can(Theme::PERMISSION_UPDATE))
                ->keyBindings(['mod+s']),
        ];
    }
}
