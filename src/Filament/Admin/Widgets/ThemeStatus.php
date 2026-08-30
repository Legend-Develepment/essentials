<?php

namespace LegendDevelopment\Theme\Filament\Admin\Widgets;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Widgets\Widget;
use LegendDevelopment\Theme\Jobs\UpdateFromChannel;
use LegendDevelopment\Theme\Support\AutoUpdate;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Machines;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The plugin's block on the dashboard, in two halves.
 *
 * The top line is the plugin's own state: which version is installed, which
 * channel it follows, whether something newer is waiting, and - when the panel
 * updates itself - when it next looks. On the dashboard rather than only on the
 * plugin's page, because "is there an update" is a question you have before you
 * go looking, not after.
 *
 * Under it, the machines: the host the panel is on, then every node. See
 * Support\Machines.
 *
 * One block rather than two, because two cards carrying the same plugin's name
 * was one too many. Either half can be switched off on its own, and with both
 * off there is no block at all.
 *
 * Every reading is wrapped. This sits on the first page of the panel: a feed
 * that will not answer may cost this block a line, and nothing else.
 */
class ThemeStatus extends Widget implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    protected string $view = 'legend-development-theme::widgets.theme-status';

    protected int|string|array $columnSpan = 'full';

    /**
     * Not lazy. The dashboard has no terminal on it, but the reason is simpler:
     * everything read here is either on disk or in a ten-minute cache, so there
     * is nothing to wait for.
     */
    protected static bool $isLazy = false;

    protected static ?int $sort = -2;

    /**
     * Either half is enough for the block to be worth drawing, and neither on
     * its own is worth a card of its own - which is why they share one.
     */
    public static function canView(): bool
    {
        return Features::maySee(Features::DASHBOARD_STATUS)
            || Features::maySee(Features::DASHBOARD_NODES);
    }

    public function getViewData(): array
    {
        return [
            'status' => Features::maySee(Features::DASHBOARD_STATUS),
            'machines' => Features::maySee(Features::DASHBOARD_NODES)
                ? $this->attempt(fn (): array => Machines::rows(), [])
                : [],
            'words' => [
                'offline' => Theme::trans('nodes.offline'),
                'maintenance' => Theme::trans('nodes.maintenance'),
                'cpu' => Theme::trans('nodes.cpu'),
                'memory' => Theme::trans('nodes.memory'),
                'disk' => Theme::trans('nodes.disk'),
                'load' => Theme::trans('nodes.load'),
            ],

            'name' => $this->attempt(fn (): string => Theme::name(), 'Theme'),
            'version' => $this->attempt(fn (): string => Channels::installedVersion(), '?'),
            'channel' => $this->attempt(
                fn (): string => Theme::trans('settings.channel.' . Channels::current()),
                '',
            ),
            'available' => $this->attempt(fn (): bool => Channels::updateAvailable(), false),
            'latest' => $this->attempt(fn (): ?string => Channels::latest()['version'] ?? null, null),
            // Null when the feed could not be read at all, which is a different
            // thing from "no update" and should not be reported as one.
            'reachable' => $this->attempt(fn (): bool => Channels::latest() !== null, false),
            'auto' => $this->attempt(
                fn (): ?string => Channels::autoUpdate() === Channels::AUTO_OFF
                    ? null
                    : Theme::trans('settings.channel.auto.' . Channels::autoUpdate()),
                null,
            ),
            // A unix timestamp, counted down in the browser rather than polled:
            // a clock that ticks does not need a request per second.
            'nextRun' => $this->attempt(fn (): ?int => AutoUpdate::nextRun(), null),
        ];
    }

    public function updateAction(): Action
    {
        return Action::make('update')
            ->label(fn () => Theme::trans('page.update'))
            ->icon('tabler-cloud-download')
            ->requiresConfirmation()
            ->modalDescription(fn () => Theme::trans('page.update_confirm'))
            ->visible(fn (): bool => (user()?->can(Theme::PERMISSION_UPDATE) ?? false)
                && $this->attempt(fn (): bool => Channels::updateAvailable(), false))
            ->action(function (): void {
                try {
                    $latest = Channels::latest();

                    if ($latest === null) {
                        Notification::make()
                            ->title(Theme::trans('page.check_failed'))
                            ->danger()
                            ->send();

                        return;
                    }

                    UpdateFromChannel::dispatch(user()?->id, $latest['download_url'], $latest['version']);

                    Notification::make()
                        ->title(Theme::trans('page.update_started'))
                        ->body(Theme::trans('page.update_background'))
                        ->success()
                        ->send();
                } catch (Throwable $exception) {
                    report($exception);

                    Notification::make()
                        ->title(Theme::trans('page.update_failed'))
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * @template T
     *
     * @param  callable(): T  $read
     * @param  T  $fallback
     * @return T
     */
    private function attempt(callable $read, mixed $fallback): mixed
    {
        try {
            return $read();
        } catch (Throwable) {
            return $fallback;
        }
    }
}
