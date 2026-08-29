<?php

namespace LegendDevelopment\Theme\Livewire;

use App\Enums\ContainerStatus;
use App\Enums\SubuserPermission;
use App\Filament\Server\Pages\Console;
use App\Filament\Server\Widgets\ServerConsole as PelicanConsole;
use App\Models\Server;
use App\Repositories\Daemon\DaemonServerRepository;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use LegendDevelopment\Theme\Support\IconPacks;
use LegendDevelopment\Theme\Support\ServerControls as Controls;
use LegendDevelopment\Theme\Support\Theme;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Throwable;

/**
 * The bar of server controls on every page inside a server.
 *
 * Pelican puts the power buttons in the console page's header, where they can
 * be, because the console page holds the websocket they talk over. Everywhere
 * else in a server - files, backups, schedules, startup - there is no way to
 * start or stop the thing you are looking at without going back to the console
 * first.
 *
 * This is the same buttons on the same daemon call the server list already
 * makes, which is the route that does not need a socket: the list card's power
 * group posts straight to the node. So the bar works on any page, and the way
 * back to the console is a link beside it.
 *
 * Lazy, because the status is an HTTP call to the node and no page should wait
 * on one to paint.
 */
#[Lazy]
class ServerControls extends Component
{
    /**
     * Locked: it is set once from the panel's own tenant, and a component that
     * takes power actions must not accept a server id from the browser.
     */
    #[Locked]
    public int $serverId = 0;

    /**
     * Whether the pop-out console is open. Not locked: opening and closing a
     * window is exactly what the browser is allowed to decide.
     */
    public bool $open = false;

    /**
     * Whether the console has been opened at all on this page.
     *
     * Once it has, its markup stays and only the window around it is hidden.
     * Taking a live console back out again means asking Livewire to remove a
     * component that owns a websocket, a wire:ignore'd element and an xterm
     * instance nothing here has a handle on - and the leftovers of that are
     * visible on the page. Keeping it costs one socket for as long as you stay
     * on the page, and gives the scrollback back when you re-open it.
     */
    public bool $mounted = false;

    /**
     * What the websocket last said the server was doing.
     *
     * While the pop-out is open the console holds a socket that reports every
     * change the moment it happens, so the bar listens to that instead of
     * asking the node again on a timer. It is how Pelican's own console header
     * keeps its buttons right.
     */
    public ?string $live = null;

    /** @var array<string, string> */
    private const ICONS = [
        'console' => 'tabler-terminal-2',
        'start' => 'tabler-player-play-filled',
        'restart' => 'tabler-reload',
        'stop' => 'tabler-player-stop-filled',
        'kill' => 'tabler-alert-square',
        'close' => 'tabler-x',
        'expand' => 'tabler-external-link',
    ];

    public function mount(int $serverId): void
    {
        $this->serverId = $serverId;
    }

    public function openConsole(): void
    {
        $this->mounted = true;
        $this->open = true;
    }

    public function closeConsole(): void
    {
        // Only the window goes. See $mounted.
        $this->open = false;
    }

    public function render(): View
    {
        $server = $this->server();

        if (!$server instanceof Server) {
            return $this->blank();
        }

        $status = $this->status($server);
        $show = Controls::mode();

        $buttons = $show === Controls::CONSOLE ? [] : $this->buttons($server, $status);
        $console = $this->console($server);

        // Nothing this person may press is nothing worth a bar.
        if ($buttons === [] && $console === null) {
            return $this->blank();
        }

        $popout = $console !== null
            && $this->canConnect($server)
            && class_exists(PelicanConsole::class);

        /*
         * One floating button, and everything else inside the console it opens.
         * The state, start, restart and stop are built the same way and
         * rendered from the same partial - in the pop-out's header, which is
         * where they were going to be read when they were wanted.
         *
         * Without a pop-out to move them into - someone who may control the
         * server but not connect to its websocket - they stay beside the
         * button, which is then a link to the console page rather than a way to
         * open one here. Rare, and it leaves nobody without their buttons.
         */
        $inPopout = $popout;

        return view(Theme::id() . '::livewire.server-controls', [
            'inPopout' => $inPopout,
            'position' => Controls::position(),
            'iconOnly' => Controls::label() === 'icon',
            'buttons' => $buttons,
            'console' => $console,
            'consoleIcon' => IconPacks::svg(self::ICONS['console']),
            'consoleLabel' => Theme::trans('controls.console'),
            'status' => $status,
            'serverName' => $server->name,
            // Handed to Pelican's console widget as its own tenant. It is
            // already loaded; looking it up again in the view would be a second
            // query for the same row.
            'serverModel' => $server,
            // Without the websocket permission the console cannot be opened
            // here at all, so the button stays what it was: a link.
            'popout' => $popout,
            'open' => $popout && $this->open,
            // Rendered from the first time it was opened onwards; after that
            // only the window around it is hidden.
            'mount' => $popout && $this->mounted,
            'windowUrl' => $console === null ? null : self::windowUrl($console),
            // Checked rather than assumed: if a future Pelican moves its console
            // widget, the button goes back to being a link instead of taking
            // the page down with it.
            'consoleWidget' => class_exists(PelicanConsole::class) ? PelicanConsole::class : null,
            'closeIcon' => IconPacks::svg(self::ICONS['close']),
            'expandIcon' => IconPacks::svg(self::ICONS['expand']),
            'expandLabel' => Theme::trans('controls.full_page'),
            'closeLabel' => Theme::trans('controls.close'),
            // Only the power buttons care what the state is - and while the
            // pop-out is open the socket says so the moment it changes, which
            // is better than a timer and cheaper than one.
            'poll' => $buttons !== [] && !($popout && $this->open),
        ]);
    }

    /**
     * Held to the same height as the bar itself, so a page does not jump once
     * the node has answered.
     */
    public function placeholder(): View
    {
        // Floating, like the button it stands in for: out of the page's flow,
        // so it holds no height open in it.
        return view(Theme::id() . '::livewire.server-controls-placeholder');
    }

    /**
     * Sends one power action, by the route that needs no websocket: straight to
     * the node, the way the server list does it.
     */
    public function power(string $action): void
    {
        $server = $this->server();

        if (!$server instanceof Server || !$this->may($action, $server)) {
            return;
        }

        // Installing, transferring, suspended. The buttons are not drawn then,
        // but a wire:click is a public entry point and gets its own check.
        if ($this->attempt(fn () => $server->isInConflictState(), false)) {
            return;
        }

        try {
            app(DaemonServerRepository::class)->setServer($server)->power($action);

            // Both readings of the state are now wrong by definition: the one
            // Pelican cached, and the one the socket last reported.
            cache()->forget("servers.{$server->uuid}.status");

            $this->live = null;

            Notification::make()
                ->title(Theme::trans('controls.sent_title'))
                ->body(Theme::trans('controls.sent_body', [
                    'action' => Theme::trans('controls.' . $action),
                    'name' => $server->name,
                ]))
                ->success()
                ->send();
        } catch (Throwable) {
            Notification::make()
                ->title(Theme::trans('controls.failed'))
                ->danger()
                ->send();
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function buttons(Server $server, ?ContainerStatus $status): array
    {
        // A server the panel will not let anyone touch - installing, being
        // transferred, suspended - gets no buttons at all rather than four that
        // refuse.
        if ($this->attempt(fn () => $server->isInConflictState(), false)) {
            return [];
        }

        $buttons = [];

        foreach (['start', 'restart', 'stop', 'kill'] as $action) {
            if (!$this->may($action, $server) || !$this->applies($action, $status)) {
                continue;
            }

            $buttons[] = [
                'action' => $action,
                'label' => Theme::trans('controls.' . $action),
                'icon' => IconPacks::svg(self::ICONS[$action]),
                // Killing drops the container where it stands, which loses
                // whatever the server had not written to disk yet.
                'confirm' => $action === 'kill' ? Theme::trans('controls.kill_confirm') : null,
            ];
        }

        return $buttons;
    }

    /**
     * Which of the four the current state has any use for. An unknown state -
     * an unreachable node, an unwritable cache - offers all of them but kill
     * and lets the node be the one to say no.
     */
    private function applies(string $action, ?ContainerStatus $status): bool
    {
        if (!$status instanceof ContainerStatus) {
            return $action !== 'kill';
        }

        return match ($action) {
            'start' => $status->isStartable(),
            'restart' => $status->isRestartable(),
            // Kill replaces stop rather than joining it, which is how Pelican's
            // own console header behaves.
            'stop' => $status->isStoppable() && !$status->isKillable(),
            'kill' => $status->isKillable(),
            default => false,
        };
    }

    /**
     * The one thing standing between a wire:click and someone else's server.
     * Checked on the way in as well as on the way out, so a hand-written
     * Livewire call gets the same answer the rendered button did.
     */
    private function may(string $action, Server $server): bool
    {
        $permission = match ($action) {
            'start' => SubuserPermission::ControlStart,
            'restart' => SubuserPermission::ControlRestart,
            // Killing is stopping, harder. Pelican gates both on the same one.
            'stop', 'kill' => SubuserPermission::ControlStop,
            default => null,
        };

        if ($permission === null) {
            return false;
        }

        return $this->attempt(fn () => (bool) user()?->can($permission, $server), false);
    }

    /**
     * The console page, marked as a window that should hold nothing but the
     * console. The mark is read server side, so the window opens as what it is
     * rather than showing a whole panel first.
     */
    private static function windowUrl(string $console): string
    {
        return $console
            . (str_contains($console, '?') ? '&' : '?')
            . Controls::BARE . '=' . Controls::BARE_VALUE;
    }

    private function console(Server $server): ?string
    {
        $allowed = $this->attempt(
            fn () => (bool) user()?->can(SubuserPermission::ControlConsole, $server),
            false,
        );

        if (!$allowed) {
            return null;
        }

        return $this->attempt(fn () => Console::getUrl(panel: 'server', tenant: $server), null);
    }

    private function server(): ?Server
    {
        return $this->attempt(fn () => Server::query()->find($this->serverId), null);
    }

    /**
     * The console's websocket, reporting a state change as it happens.
     *
     * Dispatched by Pelican's own console script. The console page listens for
     * exactly this; while the pop-out is open, so does the bar - and then it
     * has no reason to keep asking the node on a timer.
     */
    #[On('console-status')]
    public function consoleStatus(?string $state = null): void
    {
        if ($state === null || ContainerStatus::tryFrom($state) === null) {
            return;
        }

        $this->live = $state;
    }

    /**
     * The node's answer, cached by Pelican for fifteen seconds. Null means it
     * could not be had - and that is a bar that still works rather than a page
     * that does not render.
     *
     * The socket wins when there is one: it is the same fact, sooner.
     */
    private function status(Server $server): ?ContainerStatus
    {
        if ($this->live !== null) {
            $live = ContainerStatus::tryFrom($this->live);

            if ($live instanceof ContainerStatus) {
                return $live;
            }
        }

        return $this->attempt(fn () => $server->retrieveStatus(), null);
    }

    /**
     * Whether the console can be opened here at all. Without this permission
     * the widget's own token request throws, so the button stays a link to the
     * page, where Pelican says so properly.
     */
    private function canConnect(Server $server): bool
    {
        return $this->attempt(
            fn () => (bool) user()?->can(SubuserPermission::WebsocketConnect, $server),
            false,
        );
    }

    private function blank(): View
    {
        return view(Theme::id() . '::livewire.server-controls-blank');
    }

    /**
     * @template T
     *
     * @param  callable(): T  $callback
     * @param  T  $fallback
     * @return T
     */
    private function attempt(callable $callback, mixed $fallback): mixed
    {
        try {
            return $callback();
        } catch (Throwable) {
            return $fallback;
        }
    }
}
