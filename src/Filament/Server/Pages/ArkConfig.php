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
use LegendDevelopment\Theme\Support\Games\Ark;
use LegendDevelopment\Theme\Support\Games\Ini;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * ARK's world settings as a form, rather than as an INI in a file manager.
 *
 * Fifteen fields out of a file with hundreds, and that is the whole design.
 * Offering all of them would be a worse file manager than the one Pelican
 * already has; these are the ones somebody changes without looking anything up,
 * and everything else in the file - mod settings, keys this plugin has never
 * heard of, comments, the order of all of it - comes back untouched. See
 * Support\Games\Ini for how that is kept.
 *
 * The name is on the file rather than on the game: this reads
 * GameUserSettings.ini at ARK's own path, so it goes by its own egg list rather
 * than by the Valve-query one. Rust and Valheim answer the same UDP packet and
 * keep nothing at that path.
 *
 * @property Schema $form
 */
class ArkConfig extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-adjustments';

    protected static ?string $slug = 'ark-settings';

    protected static ?int $navigationSort = 7;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * The file exactly as it was read.
     *
     * Held so saving can put the changed values back into *this* file rather
     * than build a new one - which is what keeps every unknown key, comment and
     * blank line where it was.
     */
    public ?string $contents = null;

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Ark::detect($server)
                && (user()?->can(SubuserPermission::FileReadContent, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('ark.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('ark.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('ark.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.ark-config';
    }

    public function mount(): void
    {
        $this->read();
    }

    /** Whether this viewer may change anything, or only look. */
    public function mayEdit(): bool
    {
        try {
            $server = $this->server();

            return $server !== null
                && (user()?->can(SubuserPermission::FileUpdate, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    /** Whether the file is there at all. */
    public function found(): bool
    {
        return $this->contents !== null;
    }

    public function read(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $this->contents = Ark::read($server);

        $values = $this->contents === null ? [] : Ini::parse($this->contents);
        $state = [];

        foreach (Ark::fields() as $key => $field) {
            $raw = $values[$key] ?? null;

            $state[self::name($key)] = match ($field['type']) {
                /*
                 * Unreal writes True and False capitalised and reads several
                 * spellings back. Anything that is not one of the words that
                 * mean yes is a no - which is also what the game does with a
                 * value it cannot make sense of.
                 */
                'bool' => in_array(strtolower((string) $raw), ['true', '1', 'yes'], true),
                'number' => is_numeric($raw) ? (int) $raw : null,
                default => (string) ($raw ?? ''),
            };
        }

        $this->form->fill($state);
    }

    public function form(Schema $schema): Schema
    {
        $may = $this->mayEdit();
        $sections = [];

        foreach (['server', 'rates', 'rules'] as $group) {
            $fields = [];

            foreach (Ark::fields() as $key => $field) {
                if ($field['group'] !== $group) {
                    continue;
                }

                $fields[] = $this->field($key, $field, $may);
            }

            if ($fields !== []) {
                // Closures rather than strings, the way the Minecraft page
                // does it: the heading is then read when the section is drawn
                // rather than when it is built, so it follows the reader's
                // language on a re-render.
                $sections[] = Section::make(fn (): string => Theme::trans('ark.group_' . $group))
                    ->description(fn (): string => Theme::trans('ark.group_' . $group . '_helper'))
                    ->schema($fields)
                    ->columns(2);
            }
        }

        return $schema->components($sections)->statePath('data');
    }

    /**
     * @param  array{type: string, group: string}  $field
     */
    private function field(string $key, array $field, bool $may): mixed
    {
        $name = self::name($key);

        /*
         * The label is the key without its section, split on its capitals.
         *
         * TamingSpeedMultiplier becomes "Taming speed multiplier", which is
         * what it is. Naming fifteen of these by hand in two languages would be
         * thirty strings that say the same thing the key already says, and each
         * one a chance to disagree with the game's own documentation.
         */
        $label = self::words($key);

        /*
         * Disabled on the field rather than on the schema.
         *
         * Every Filament field carries disabled(); whether the schema itself
         * does is something this codebase cannot check - there is no vendor
         * directory here - and a call that does not exist is a 500 on the page
         * rather than a form that ignores it. Pelican disables per field
         * everywhere for what is presumably the same reason.
         */
        return match ($field['type']) {
            'bool' => Toggle::make($name)->label($label)->inline(false)->disabled(!$may),
            'number' => TextInput::make($name)->label($label)->numeric()->minValue(0)->disabled(!$may),
            'secret' => TextInput::make($name)->label($label)->password()->revealable()->maxLength(120)->disabled(!$may),
            default => TextInput::make($name)->label($label)->maxLength(120)->disabled(!$may),
        };
    }

    /**
     * A form field name from a key with a dot in it.
     *
     * Filament reads a dot in a statePath as nesting, so ServerSettings.MaxPlayers
     * would become an array with one key in it rather than a field.
     */
    private static function name(string $key): string
    {
        return str_replace('.', '__', $key);
    }

    /** The key without its section, split on its capitals. */
    private static function words(string $key): string
    {
        $short = substr($key, (int) strrpos($key, '.') + 1);
        $spaced = preg_replace('/(?<!^)(?=[A-Z])/', ' ', $short) ?? $short;

        return ucfirst(strtolower($spaced));
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
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        if (!$this->mayEdit() || !$this->found()) {
            return [];
        }

        return [
            Action::make('ld_save')
                ->label(Theme::trans('ark.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save()),
        ];
    }

    public function save(): void
    {
        $server = $this->server();

        abort_unless($server !== null && $this->mayEdit(), 403);

        if ($this->contents === null) {
            return;
        }

        try {
            $state = $this->form->getState();
            $changes = [];

            foreach (Ark::fields() as $key => $field) {
                $value = $state[self::name($key)] ?? null;

                // A number left empty is a setting somebody cleared rather than
                // one they set to nought, and writing 0 for it would change the
                // game. It is left as it was in the file.
                if ($field['type'] === 'number' && ($value === null || $value === '')) {
                    continue;
                }

                $changes[$key] = $value;
            }

            /*
             * Written into the file that was read, not a new one.
             *
             * This is where the promise is kept: Ini::apply() replaces the
             * values on the lines it recognises and leaves the rest of somebody's
             * modded configuration exactly where it was.
             */
            $written = Ark::write($server, Ini::apply($this->contents, $changes));
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('ark.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        if (!$written) {
            Notification::make()
                ->title(Theme::trans('ark.failed'))
                ->body(Theme::trans('ark.failed_write'))
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        // Read back, so the form shows the file rather than what was sent to
        // it - and so a value the game will reformat is visible at once.
        $this->read();

        Notification::make()
            ->title(Theme::trans('ark.saved'))
            ->body(Theme::trans('ark.saved_restart'))
            ->success()
            ->send();
    }
}
