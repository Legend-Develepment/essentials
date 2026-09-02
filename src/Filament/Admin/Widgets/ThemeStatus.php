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
use LegendDevelopment\Theme\Support\Changelog;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Machines;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Workers;
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

    /**
     * The one place in this plugin where the id is written out.
     *
     * It has to be: Filament reads this property, and a property cannot call a
     * method. Deriving it in boot() was tried in 2.47.2 and taken out again -
     * Pelican's own pages use boot() so the hook exists, but nothing here could
     * prove it behaves the same on a Widget, and an unverified lifecycle hook is
     * not worth carrying for one line.
     *
     * A literal that must track the id is exactly how the seeder went quiet for
     * sixteen releases. This one is guarded differently: Pelican refuses to load
     * a plugin whose folder and id disagree, so a wrong id here cannot be quiet
     * - it takes the panel down on the first request, which is how this comment
     * came to be written.
     */
    protected string $view = 'essentials::widgets.theme-status';

    protected int|string|array $columnSpan = 'full';

    /**
     * Lazy, and that is not optional any more.
     *
     * It was not, back when this block only knew its own version - everything it
     * read was on disk or in a ten-minute cache and there was nothing to wait
     * for. Then the machines moved in here, and they are one request to each
     * node's daemon with a one-second timeout on a cold cache. The block those
     * came from was lazy for exactly that reason, and merging it into this one
     * quietly put those calls back on the critical path of the page the whole
     * panel opens on.
     *
     * The dashboard has no terminal on it, so the rule about what may load late
     * above one does not apply here.
     */
    protected static bool $isLazy = true;

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

            // What the last check did, in words. See the note in the view: a
            // countdown alone cannot tell a scheduler that never runs apart
            // from a check that finds nothing.
            'lastCheck' => $this->attempt(fn (): string => self::lastCheck(), ''),

            // Said whether or not automatic updates are on: the worker is what
            // performs a manual update and a modpack install too, and without
            // one all three fail the same silent way.
            'worker' => $this->attempt(fn (): string => self::worker(), ''),
        ];
    }

    /**
     * What has changed, from the releases themselves.
     *
     * Beside the update button rather than on a page of its own: "what would
     * that update actually do to my panel" is a question asked while looking at
     * the button, not one worth navigating for.
     *
     * The same button is on the plugin's own page beside the update controls
     * there, and both come from one definition - two copies of a modal's
     * wording would be two things to keep in step.
     */
    public function changelogAction(): Action
    {
        return Changelog::action();
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
                        ->body(Workers::body())
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
     * The last automatic check, in a sentence.
     *
     * Each outcome names the part that would need attention, because the three
     * ways this goes wrong are indistinguishable from a countdown:
     *
     *  - nothing recorded at all: run() has never been reached, so the panel's
     *    scheduler is not running. That is a cron entry on the host, and it
     *    stops every scheduled task rather than only this one.
     *  - queued, but the version has not moved: the job was handed to the queue
     *    and no worker took it.
     *  - checked and current, or checked and unreachable: the machinery works
     *    and the answer is about the feed.
     */
    private static function lastCheck(): string
    {
        $last = AutoUpdate::lastCheck();

        if ($last === null) {
            return Theme::trans('page.auto_never');
        }

        $ago = Theme::trans('page.auto_ago', [
            'ago' => max(0, time() - $last['at']) < 90
                ? Theme::trans('page.auto_just_now')
                : (int) round(max(0, time() - $last['at']) / 60) . ' ' . Theme::trans('page.auto_minutes'),
        ]);

        return $ago . ' — ' . match ($last['outcome']) {
            'queued' => Theme::trans('page.auto_queued', ['version' => $last['version'] ?? '?']),
            'current' => Theme::trans('page.auto_current'),
            'unreachable' => Theme::trans('page.auto_unreachable'),
            default => Theme::trans('page.auto_error'),
        };
    }

    /**
     * Ask about the worker, and say so if it is not there.
     *
     * The asking happens here, on a page somebody is looking at, rather than
     * only from the scheduler - because a panel whose scheduler is not running
     * is exactly a panel that needs to be told about its queue, and waiting for
     * a check that never comes would keep that hidden for ever.
     *
     * Reading straight after probing reports `waiting`, not `missing`, which is
     * deliberate: the first view arms the question and a later one answers it.
     * A warning raised before anything had a chance to reply would be a guess.
     */
    private static function worker(): string
    {
        Workers::probe();

        return Workers::state()['state'] === 'missing'
            ? Theme::trans('page.worker_missing')
            : '';
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
