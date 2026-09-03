<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Properties;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * server.properties as a form.
 *
 * The idea is N3rdmade's Minecraft Config plugin (MIT); the code is this
 * plugin's own, following the shape the Palworld page set - read through the
 * daemon, edit while stopped, write back what was read.
 *
 * **The file is the truth and the form is a view of it.** Everything read is
 * held, the form draws the settings it knows, and saving puts the drawn values
 * back into the file that was read - so a modpack's forty keys, every comment
 * and the order somebody put them in all survive being edited here. See
 * Support\Minecraft\Properties, which is where that actually happens.
 *
 * @property Schema $form
 */
class MinecraftConfig extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-brand-minecraft';

    protected static ?string $slug = 'minecraft';

    protected static ?int $navigationSort = 8;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * The file exactly as it was read, so saving can write back the lines this
     * page never drew.
     */
    public ?string $contents = null;

    /**
     * The settings this page draws, and how.
     *
     * A deliberately short list. Everything else in the file stays in the file
     * and is reachable through the panel's own file manager - a form that tried
     * to draw every key a modpack invents would be a form that is wrong about
     * most of them.
     *
     * @var array<string, array<string, mixed>>
     */
    private const FIELDS = [
        'motd' => ['type' => 'text', 'group' => 'general', 'max' => 180],
        'gamemode' => ['type' => 'select', 'group' => 'general', 'options' => ['survival', 'creative', 'adventure', 'spectator']],
        'difficulty' => ['type' => 'select', 'group' => 'general', 'options' => ['peaceful', 'easy', 'normal', 'hard']],
        'hardcore' => ['type' => 'bool', 'group' => 'general'],
        'force-gamemode' => ['type' => 'bool', 'group' => 'general'],
        'pvp' => ['type' => 'bool', 'group' => 'general'],

        'max-players' => ['type' => 'number', 'group' => 'players', 'min' => 0, 'max' => 2000],
        'white-list' => ['type' => 'bool', 'group' => 'players'],
        'enforce-whitelist' => ['type' => 'bool', 'group' => 'players'],
        'online-mode' => ['type' => 'bool', 'group' => 'players'],
        'player-idle-timeout' => ['type' => 'number', 'group' => 'players', 'min' => 0, 'max' => 1440],
        'op-permission-level' => ['type' => 'number', 'group' => 'players', 'min' => 1, 'max' => 4],

        'level-name' => ['type' => 'text', 'group' => 'world', 'max' => 120],
        'level-seed' => ['type' => 'text', 'group' => 'world', 'max' => 120],
        'level-type' => ['type' => 'text', 'group' => 'world', 'max' => 60],
        'allow-nether' => ['type' => 'bool', 'group' => 'world'],
        'spawn-monsters' => ['type' => 'bool', 'group' => 'world'],
        'spawn-protection' => ['type' => 'number', 'group' => 'world', 'min' => 0, 'max' => 1000],

        'view-distance' => ['type' => 'number', 'group' => 'performance', 'min' => 2, 'max' => 32],
        'simulation-distance' => ['type' => 'number', 'group' => 'performance', 'min' => 2, 'max' => 32],
        'max-tick-time' => ['type' => 'number', 'group' => 'performance', 'min' => -1, 'max' => 600000],
        'sync-chunk-writes' => ['type' => 'bool', 'group' => 'performance'],

        'enable-command-block' => ['type' => 'bool', 'group' => 'access'],
        'allow-flight' => ['type' => 'bool', 'group' => 'access'],
        'enable-rcon' => ['type' => 'bool', 'group' => 'access'],
        'enable-query' => ['type' => 'bool', 'group' => 'access'],
        'resource-pack' => ['type' => 'text', 'group' => 'access', 'max' => 250],
        'require-resource-pack' => ['type' => 'bool', 'group' => 'access'],
    ];

    /** The order the sections are drawn in, with an icon each. */
    private const GROUPS = [
        'general' => 'tabler-adjustments',
        'players' => 'tabler-users',
        'world' => 'tabler-world',
        'performance' => 'tabler-gauge',
        'access' => 'tabler-shield-lock',
    ];

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Minecraft::detect($server)
                && (user()?->can(SubuserPermission::FileReadContent, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('minecraft.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('minecraft.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('minecraft.nav_label');
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
     * Also what Reload does. The file is the truth and somebody may have edited
     * it in the file manager, or the server may have rewritten it on stopping -
     * both of which make what is on screen stale rather than wrong.
     */
    public function read(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $this->contents = Minecraft::read($server);

        $values = $this->contents === null ? [] : Properties::parse($this->contents);
        $state = [];

        foreach (self::FIELDS as $key => $field) {
            $raw = $values[$key] ?? null;

            $state[self::name($key)] = match ($field['type']) {
                // Minecraft writes these as the words true and false; anything
                // else in the file is not a yes.
                'bool' => $raw === 'true',
                'number' => is_numeric($raw) ? (int) $raw : null,
                default => (string) ($raw ?? ''),
            };
        }

        $this->form->fill($state);
    }

    public function form(Schema $schema): Schema
    {
        $sections = [];

        foreach (self::GROUPS as $group => $icon) {
            $fields = [];

            foreach (self::FIELDS as $key => $field) {
                if ($field['group'] !== $group) {
                    continue;
                }

                $fields[] = $this->field($key, $field);
            }

            $sections[] = Section::make(fn (): string => Theme::trans('minecraft.groups.' . $group))
                ->icon($icon)
                ->iconColor('primary')
                ->columns(2)
                ->collapsed($group !== 'general')
                ->schema($fields);
        }

        // What the file holds that this page does not draw, shown rather than
        // hidden: a person editing settings should be able to see that a
        // modpack has put forty more in there, even though changing them is the
        // file manager's job.
        $sections[] = Section::make(fn (): string => Theme::trans('minecraft.groups.other'))
            ->icon('tabler-file-text')
            ->iconColor('gray')
            ->description(fn (): string => Theme::trans('minecraft.other_helper'))
            ->collapsed()
            ->schema([
                Textarea::make('untouched')
                    ->hiddenLabel()
                    ->rows(10)
                    ->disabled()
                    ->dehydrated(false)
                    ->default(fn (): string => $this->untouched())
                    ->columnSpanFull(),
            ]);

        return $schema->components($sections)->statePath('data');
    }

    /**
     * One field, built from its description in FIELDS.
     *
     * @param  array<string, mixed>  $field
     */
    private function field(string $key, array $field): mixed
    {
        $label = fn (): string => Theme::trans('minecraft.keys.' . self::name($key));
        $name = self::name($key);

        return match ($field['type']) {
            'bool' => Toggle::make($name)->label($label),

            'select' => Select::make($name)
                ->label($label)
                ->options(fn (): array => collect($field['options'])
                    ->mapWithKeys(fn (string $option): array => [
                        $option => Theme::trans('minecraft.values.' . $option),
                    ])
                    ->all())
                ->selectablePlaceholder(false),

            'number' => TextInput::make($name)
                ->label($label)
                ->numeric()
                ->minValue($field['min'] ?? null)
                ->maxValue($field['max'] ?? null),

            default => TextInput::make($name)
                ->label($label)
                ->maxLength($field['max'] ?? 255),
        };
    }

    /**
     * A key as a form field name.
     *
     * Dots and dashes are how Filament addresses nesting, so a field called
     * `rcon.port` would be read as `port` inside `rcon` and silently never
     * saved. Underscores throughout, and turned back on the way out.
     */
    private static function name(string $key): string
    {
        return str_replace(['.', '-'], '_', $key);
    }

    /**
     * Everything in the file this page does not draw.
     */
    private function untouched(): string
    {
        if ($this->contents === null) {
            return '';
        }

        $lines = [];

        foreach (Properties::parse($this->contents) as $key => $value) {
            if (!array_key_exists($key, self::FIELDS)) {
                $lines[] = $key . '=' . $value;
            }
        }

        return implode("\n", $lines);
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
        return [
            Action::make('reload')
                ->label(fn () => Theme::trans('minecraft.reload'))
                ->icon('tabler-refresh')
                ->color('gray')
                ->action(fn () => $this->read()),
        ];
    }

    public function save(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        abort_unless(
            user()?->can(SubuserPermission::FileUpdate, $server) ?? false,
            403,
        );

        /*
         * Stopped only, and this is not caution for its own sake. Minecraft
         * reads server.properties when it starts and writes it back when it
         * stops, so a change saved while it is running is one the game will
         * overwrite on the way out - silently, and after the panel has said it
         * saved.
         */
        if (!Minecraft::isStopped($server)) {
            Notification::make()
                ->title(Theme::trans('minecraft.running'))
                ->body(Theme::trans('minecraft.running_helper'))
                ->warning()
                ->send();

            return;
        }

        if ($this->contents === null) {
            Notification::make()
                ->title(Theme::trans('minecraft.missing'))
                ->body(Theme::trans('minecraft.missing_helper'))
                ->danger()
                ->send();

            return;
        }

        try {
            $state = $this->form->getState();
            $changes = [];

            foreach (self::FIELDS as $key => $field) {
                $value = $state[self::name($key)] ?? null;

                // A number left empty is a setting to leave as it is, not one
                // to write as nothing - Minecraft reads an empty numeric as
                // zero, which is a different server.
                if ($field['type'] === 'number' && ($value === null || $value === '')) {
                    continue;
                }

                $changes[$key] = $field['type'] === 'bool' ? (bool) $value : $value;
            }

            $written = Properties::apply($this->contents, $changes);

            if (!Minecraft::write($server, $written)) {
                Notification::make()
                    ->title(Theme::trans('minecraft.failed'))
                    ->body(Theme::trans('minecraft.failed_helper'))
                    ->danger()
                    ->send();

                return;
            }

            $this->contents = $written;

            Notification::make()
                ->title(Theme::trans('minecraft.saved'))
                ->body(Theme::trans('minecraft.saved_helper'))
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('minecraft.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }
}
