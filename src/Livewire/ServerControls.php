<?php

namespace LegendDevelopment\Theme\Livewire;

use App\Enums\ContainerStatus;
use App\Enums\SubuserPermission;
use App\Filament\Server\Pages\Console;
use App\Models\Server;
use App\Repositories\Daemon\DaemonServerRepository;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use LegendDevelopment\Theme\Support\IconPacks;
use LegendDevelopment\Theme\Support\ServerControls as Controls;
use LegendDevelopment\Theme\Support\Theme;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
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

    /** @var array<string, string> */
    private const ICONS = [
        'console' => 'tabler-terminal-2',
        'start' => 'tabler-player-play-filled',
        'restart' => 'tabler-reload',
        'stop' => 'tabler-player-stop-filled',
        'kill' => 'tabler-alert-square',
    ];

    public function mount(int $serverId): void
    {
        $this->serverId = $serverId;
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
        $console = $show === Controls::POWER ? null : $this->console($server);

        // Nothing this person may press is nothing worth a bar.
        if ($buttons === [] && $console === null) {
            return $this->blank();
        }

        return view(Theme::id() . '::livewire.server-controls', [
            'buttons' => $buttons,
            'console' => $console,
            'consoleIcon' => IconPacks::svg(self::ICONS['console']),
            'consoleLabel' => Theme::trans('controls.console'),
            'status' => $status,
            // Only the power buttons care what the state is. A bar that is just
            // a link to the console has nothing to keep asking the node about.
            'poll' => $buttons !== [],
        ]);
    }

    /**
     * Held to the same height as the bar itself, so a page does not jump once
     * the node has answered.
     */
    public function placeholder(): View
    {
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

            // The cached status is now wrong by definition, and the bar reads it
            // again on the very next render.
            cache()->forget("servers.{$server->uuid}.status");

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
     * The node's answer, cached by Pelican for fifteen seconds. Null means it
     * could not be had - and that is a bar that still works rather than a page
     * that does not render.
     */
    private function status(Server $server): ?ContainerStatus
    {
        return $this->attempt(fn () => $server->retrieveStatus(), null);
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
