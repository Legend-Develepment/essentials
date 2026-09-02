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
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Ping;
use LegendDevelopment\Theme\Support\Minecraft\Players as PlayerList;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The whitelist, the ops, the bans, and everyone the server has seen.
 *
 * Same eggs as the Minecraft page - the list an administrator ticked - because
 * "is this a Minecraft server" has one answer and asking it twice would let the
 * two drift.
 *
 * Two permissions, and the split is the point of the design rather than a
 * detail of it:
 *
 *  - reading needs FileReadContent, because that is literally what it does: it
 *    reads four JSON files out of the server directory.
 *  - acting needs ControlConsole, because that is literally what it does: it
 *    sends `ban`, `op`, `whitelist add`. Anyone holding that permission can
 *    already type those into the console page. This grants nobody anything they
 *    did not have; it saves them typing and stops them mistyping.
 *
 * That is worth stating plainly because a player manager sounds like new
 * authority, and this deliberately is not any.
 */
class Players extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-users';

    protected static ?string $slug = 'players';

    protected static ?int $navigationSort = 8;

    /** @var array<int, array<string, mixed>> */
    public array $rows = [];

    /** @var array<int, array<string, mixed>> */
    public array $ips = [];

    public bool $running = false;

    /**
     * Who is connected, when the panel was allowed to ask and got an answer.
     *
     * Null covers three things that are not worth telling apart on screen:
     * the setting is off, the game port could not be reached, or the server
     * is not running. In all three the section is simply not drawn.
     *
     * @var array{online: int, max: int, names: array<int, string>, version: string|null}|null
     */
    public ?array $live = null;

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
        return Theme::trans('players.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('players.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('players.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.players';
    }

    public function mount(): void
    {
        $this->load();
    }

    /**
     * Read the four lists again.
     *
     * Called on mount and after every action. Not polled: these files change
     * when somebody changes them, and a page that re-read four files off a
     * daemon every few seconds would cost more than it told anyone.
     */
    public function load(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $this->rows = PlayerList::rows($server);
        $this->ips = PlayerList::bannedIps($server);
        $this->running = !Minecraft::isStopped($server);
        $this->live = Ping::status($server);
    }

    /* ----------------------------------------------------------- acting -- */

    /**
     * Whether this viewer may change anything, and whether there is anything to
     * change it with.
     *
     * Both halves are needed and they fail differently. Without the permission
     * the buttons are not drawn at all. With the permission but a stopped
     * server they are drawn and disabled, because "why can I not do this" has
     * a real answer here - the change is made by the game, and the game is not
     * running - and hiding the button would leave that answer nowhere.
     */
    public function mayAct(): bool
    {
        try {
            $server = $this->server();

            return $server !== null
                && (user()?->can(SubuserPermission::ControlConsole, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function whitelistAction(): Action
    {
        // The one that is not in a row, so it keeps its words.
        return $this->command('whitelist', 'whitelist add', 'tabler-user-plus', asks: true, compact: false);
    }

    public function unwhitelistAction(): Action
    {
        return $this->command('unwhitelist', 'whitelist remove', 'tabler-user-minus');
    }

    public function opAction(): Action
    {
        return $this->command('op', 'op', 'tabler-shield');
    }

    public function deopAction(): Action
    {
        return $this->command('deop', 'deop', 'tabler-shield-off');
    }

    public function banAction(): Action
    {
        return $this->command('ban', 'ban', 'tabler-ban', reason: true);
    }

    public function pardonAction(): Action
    {
        return $this->command('pardon', 'pardon', 'tabler-lock-open');
    }

    public function kickAction(): Action
    {
        return $this->command('kick', 'kick', 'tabler-logout', reason: true);
    }

    /**
     * One definition for all seven.
     *
     * They differ in three ways - the verb, whether a name is typed or comes
     * from the row, and whether a reason is asked for - and in nothing else.
     * Seven near-copies would be seven places to forget the permission check.
     *
     * The name always goes through Players::name() inside send(); nothing here
     * is trusted to have checked it, including the row, because a row is built
     * from a file somebody may have edited by hand.
     */
    private function command(
        string $key,
        string $verb,
        string $icon,
        bool $asks = false,
        bool $reason = false,
        bool $compact = true,
    ): Action {
        /*
         * Icon-only in a row, and the icon is not decoration.
         *
         * Three or four buttons carrying words like "Remove from whitelist"
         * make a row wider than the page, which is exactly what happened: they
         * were pushed off the right-hand edge and the page looked as though it
         * had no buttons at all. The label becomes the tooltip instead, so
         * nothing is lost - and the disabled reason wins that tooltip when
         * there is one, because "why is this greyed out" is the more urgent
         * question of the two.
         *
         * Every icon name here was checked against the Tabler set rather than
         * remembered. A name that does not exist is not a missing picture, it
         * is an exception, and the page stops rendering.
         */
        $action = Action::make($key)
            ->label(fn (): string => Theme::trans('players.' . $key))
            ->icon($icon);

        /*
         * Branched rather than iconButton($compact).
         *
         * PHP accepts extra arguments to a userland method and discards them,
         * and Filament's iconButton() takes none in this version - so passing
         * false would have made the one button that needs its words icon-only
         * as well, silently and only in the rendering.
         */
        if ($compact) {
            $action = $action->iconButton();
        }

        return $action
            ->size('sm')
            ->color(match ($key) {
                'ban', 'kick' => 'danger',
                'op' => 'warning',
                default => 'gray',
            })
            ->visible(fn (): bool => $this->mayAct())
            ->disabled(fn (): bool => !$this->running)
            ->tooltip(fn (): ?string => $this->running
                ? Theme::trans('players.' . $key)
                : Theme::trans('players.needs_running'))
            ->schema(array_values(array_filter([
                $asks ? TextInput::make('name')
                    ->label(fn (): string => Theme::trans('players.name'))
                    ->required()
                    ->maxLength(16)
                    // Mojang's own rule, said here so the form refuses it before
                    // the command builder has to.
                    ->rule('regex:/^[A-Za-z0-9_]{1,16}$/')
                    : null,
                $reason ? TextInput::make('reason')
                    ->label(fn (): string => Theme::trans('players.reason'))
                    ->maxLength(120)
                    : null,
            ])))
            ->action(function (array $data, array $arguments) use ($verb): void {
                $server = $this->server();

                if ($server === null || !$this->mayAct() || !$this->running) {
                    return;
                }

                $name = is_string($data['name'] ?? null) && $data['name'] !== ''
                    ? $data['name']
                    : (string) ($arguments['name'] ?? '');

                $sent = PlayerList::send($server, $verb, $name, (string) ($data['reason'] ?? ''));

                Notification::make()
                    ->title(Theme::trans($sent ? 'players.sent' : 'players.refused'))
                    ->body($sent ? Theme::trans('players.sent_body') : null)
                    ->status($sent ? 'success' : 'danger')
                    ->send();

                $this->load();
            });
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
}
