<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Palworld\OptionSettings;
use LegendDevelopment\Theme\Support\Palworld\Palworld;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Palworld's world settings, on a page instead of in a file.
 *
 * Written from the game's own file format rather than ported from anywhere: the
 * shape of PalWorldSettings.ini is Palworld's, and every setting on this page
 * came out of the server's own file at the moment it was opened. There is no
 * list of settings in this plugin - see Support\Palworld\OptionSettings for why
 * that is the design and not a shortcut.
 *
 * **Saving is only possible while the server is stopped**, and that is the whole
 * reason this page is careful rather than convenient. Palworld holds these
 * settings in memory and writes the file out again when it shuts down: a change
 * saved to a running server is quietly undone hours later, with nothing left to
 * point at.
 *
 * @property Schema $form
 */
class PalworldSettings extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-adjustments-alt';

    protected static ?string $slug = 'palworld';

    protected static ?int $navigationSort = 20;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /** Where the file was found, so saving writes back to the same place. */
    public ?string $path = null;

    /**
     * What was read, keyed as OptionSettings returns it. Held so saving can
     * write back the keys this page never drew.
     *
     * @var array<string, array<string, mixed>>
     */
    public array $settings = [];

    public ?string $contents = null;

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Palworld::detect($server)
                && (user()?->can(SubuserPermission::FileReadContent, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('palworld.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('palworld.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('palworld.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function mount(): void
    {
        $this->read();
    }

    /**
     * Read the file and fill the form from it.
     *
     * Also what the Reload button does, which is worth having: the file is
     * somebody else's to change, over SFTP or by hand, while this page is open.
     */
    public function read(): void
    {
        $server = $this->server();

        $this->path = $server === null ? null : Palworld::find($server);
        $this->contents = $this->path === null || $server === null
            ? null
            : Palworld::read($server, $this->path);

        $this->settings = $this->contents === null ? [] : OptionSettings::parse($this->contents);

        $values = [];

        foreach ($this->settings as $key => $setting) {
            $values[$key] = $setting['value'];
        }

        $this->form->fill(['settings' => $values]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components($this->sections())
            ->statePath('data');
    }

    /**
     * One section per group, in the order Palworld::groups() gives them, and
     * only for the groups this file actually has something in.
     *
     * @return array<int, Section>
     */
    private function sections(): array
    {
        $grouped = [];

        foreach ($this->settings as $key => $setting) {
            $grouped[Palworld::group($key)][$key] = $setting;
        }

        $sections = [];
        $editable = $this->canEdit();

        foreach (Palworld::groups() as $group) {
            if (!isset($grouped[$group])) {
                continue;
            }

            $fields = [];

            foreach ($grouped[$group] as $key => $setting) {
                $fields[] = $this->field($key, $setting);
            }

            $sections[] = Section::make(Theme::trans('palworld.groups.' . $group))
                ->icon('tabler-settings')
                ->columns(2)
                ->collapsible()
                // Everything but the first is folded: the file has around eighty
                // settings in it and a page of eighty open fields is a page
                // nobody finds anything on.
                ->collapsed($sections !== [])
                ->disabled(!$editable)
                ->schema($fields);
        }

        return $sections;
    }

    /**
     * One control, chosen by what the value is rather than by what the key is.
     *
     * @param  array<string, mixed>  $setting
     */
    private function field(string $key, array $setting): Toggle|TextInput
    {
        $label = Palworld::label($key);
        $path = 'settings.' . $key;

        if ($setting['type'] === OptionSettings::BOOL) {
            return Toggle::make($path)->label($label);
        }

        $field = TextInput::make($path)->label($label);

        if ($setting['type'] === OptionSettings::NUMBER) {
            // Not ->numeric(): the file holds both counts and rates, and a rate
            // is a decimal. Numeric with no step would refuse 1.5 on a browser
            // that enforces it.
            return $field->rule('numeric');
        }

        return $field->maxLength(200);
    }

    private function server(): ?Server
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server ? $server : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Editable only while the server is stopped, and only for somebody who may
     * write the server's files.
     */
    public function canEdit(): bool
    {
        $server = $this->server();

        if ($server === null || $this->path === null) {
            return false;
        }

        return Palworld::isStopped($server)
            && (user()?->can(SubuserPermission::FileUpdate, $server) ?? false);
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('reload')
                ->label(fn () => Theme::trans('palworld.reload'))
                ->icon('tabler-refresh')
                ->color('gray')
                ->action(fn () => $this->read()),

            Action::make('save')
                ->label(fn () => Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->visible(fn (): bool => $this->canEdit())
                ->requiresConfirmation()
                ->modalDescription(fn () => Theme::trans('palworld.save_confirm'))
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $server = $this->server();

        // Checked again here, not only on the button. The server could have
        // been started from another tab between opening this page and pressing
        // save, and that is exactly the case this guard exists for.
        if ($server === null || $this->path === null || $this->contents === null || !$this->canEdit()) {
            Notification::make()
                ->title(Theme::trans('palworld.running'))
                ->body(Theme::trans('palworld.running_body'))
                ->danger()
                ->send();

            return;
        }

        try {
            $state = (array) ($this->form->getState()['settings'] ?? []);

            // Only keys that were in the file. A key the form somehow carries
            // and the file does not is not a setting this server has.
            $changes = array_intersect_key($state, $this->settings);

            $updated = OptionSettings::apply($this->contents, $changes);

            if (!Palworld::write($server, $this->path, $updated)) {
                throw new \RuntimeException('write failed');
            }

            $this->contents = $updated;
            $this->settings = OptionSettings::parse($updated);

            Notification::make()
                ->title(Theme::trans('palworld.saved'))
                ->body(Theme::trans('palworld.saved_body'))
                ->success()
                ->send();
        } catch (Throwable) {
            Notification::make()
                ->title(Theme::trans('palworld.save_failed'))
                ->danger()
                ->send();
        }
    }
}
