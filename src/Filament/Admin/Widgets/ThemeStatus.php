<?php

namespace LegendDevelopment\Theme\Filament\Admin\Widgets;

use Filament\Pages\Page;
use Filament\Widgets\Widget;
use LegendDevelopment\Theme\Filament\Admin\Pages\Capacity;
use LegendDevelopment\Theme\Filament\Admin\Pages\SystemStatus;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Machines;
use LegendDevelopment\Theme\Support\AutoUpdater;
use LegendDevelopment\Theme\Support\Installed;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Workers;
use Throwable;

/**
 * The plugin's block on the dashboard, in two halves.
 *
 * The top line is the plugin's own state: which version is installed and,
 * when the Essentials Auto Updater is installed, whether it reports a newer
 * one, with the way to its page. On the dashboard rather than only on the
 * plugin's page, because "is there an update" is a question you have before you
 * go looking, not after.
 *
 * Under it, the machines: the host the panel is on, then every node, under a
 * heading of their own and each name a link to the page that says more. See
 * Support\Machines, and machines() below.
 *
 * One block rather than two, because two cards carrying the same plugin's name
 * was one too many. Either half can be switched off on its own, and with both
 * off there is no block at all.
 *
 * Every reading is wrapped. This sits on the first page of the panel: a
 * reading that fails may cost this block a line, and nothing else.
 */
class ThemeStatus extends Widget
{
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
                ? $this->attempt(fn (): array => $this->machines(), [])
                : [],
            'words' => [
                'title' => Theme::trans('nodes.title'),
                'offline' => Theme::trans('nodes.offline'),
                'maintenance' => Theme::trans('nodes.maintenance'),
                'cpu' => Theme::trans('nodes.cpu'),
                'memory' => Theme::trans('nodes.memory'),
                'disk' => Theme::trans('nodes.disk'),
                'load' => Theme::trans('nodes.load'),
            ],

            'name' => $this->attempt(fn (): string => Theme::name(), 'Theme'),
            'version' => $this->attempt(fn (): string => Installed::version(), '?'),

            /*
             * An update the Essentials Auto Updater reports as waiting, when it
             * is installed, with the way to its page. Its summary is what it
             * already holds, so this asks nothing of the network.
             */
            'update' => $this->attempt(fn (): ?array => AutoUpdater::plugin(Theme::id()), null),
            'updater' => $this->attempt(fn (): ?array => AutoUpdater::status(), null),

            // The worker is what performs a modpack install and every other
            // job, and without one they all fail the same silent way.
            'worker' => $this->attempt(fn (): string => self::worker(), ''),
            'cron' => $this->attempt(fn (): string => self::cron(), ''),
        ];
    }

    /**
     * The machines, each with the page its name sends you to when there is one.
     *
     * The panel's row goes to System status, which is the same host in full:
     * every filesystem rather than the one the panel is on, the load against
     * the core count, what the machine is running. A node's row goes to
     * Capacity, which answers the question this block raises rather than
     * repeating it: this is how hard a node is working now, that is how much of
     * it has already been promised away, and a node can be idle and full at the
     * same time.
     *
     * A node row carries the node's id and the panel's row does not, which is
     * the only thing that tells them apart from out here. Each address is
     * worked out once rather than per row, because asking Filament for a page's
     * address is a route lookup.
     *
     * @return array<int, array<string, mixed>>
     */
    private function machines(): array
    {
        $panel = $this->pageUrl(SystemStatus::class, Features::SYSTEM_STATUS);
        $node = $this->pageUrl(Capacity::class, Features::CAPACITY);

        return array_map(
            static fn (array $row): array => $row + ['link' => array_key_exists('id', $row) ? $node : $panel],
            Machines::rows(),
        );
    }

    /**
     * Where one row sends you, or nothing.
     *
     * Nothing when the page is switched off or the reader may not see it. A
     * switched-off page is not registered at all (see ThemePlugin), so a link
     * to it is a link to a 404, which is worse than a name that is not a link.
     *
     * @param  class-string<Page>  $page
     */
    private function pageUrl(string $page, string $feature): ?string
    {
        try {
            return Features::maySee($feature) ? $page::getUrl() : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Whether the panel's cron is running, which nothing scheduled can answer.
     *
     * A scheduled check cannot report that scheduling has stopped - there is
     * nothing left to run it. So the scheduler leaves a mark every tick and
     * this reads it, on a page, in a browser: the one place in the panel that
     * is proof something other than cron is still awake.
     *
     * Silent until the mark has been seen at least once. A panel installed five
     * minutes ago has no history to be alarmed about, and crying wolf on a
     * fresh install is how a warning gets ignored on the one that matters.
     */
    private static function cron(): string
    {
        $since = Workers::sinceTick();

        if ($since === null) {
            return '';
        }

        /*
         * Ten minutes. The scheduler runs every minute, so five would fire on
         * an ordinary busy tick and an hour would let half a day of renewals go
         * missing before anybody was told.
         */
        return $since > 600
            ? Theme::trans('page.cron_missing', ['for' => (int) floor($since / 60)])
            : '';
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
