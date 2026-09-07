<?php

namespace LegendDevelopment\Theme\Filament\App\Widgets;

use App\Models\Server;
use Filament\Widgets\Widget;
use LegendDevelopment\Theme\Support\Backups;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A line above somebody's own server list: which of theirs has no backup.
 *
 * Pelican's cards say what a server is doing right now - its state, and three
 * meters. Nothing on that page says a backup has not run in three weeks, and
 * that is the thing somebody finds out on the day they need one.
 *
 * The administrator has had this since the backups overview shipped. This is the
 * same question asked by the person whose servers they are, and it is the first
 * thing this plugin has added for them rather than for whoever runs the panel.
 *
 * **Through Pelican's own extension point.** ListServers carries
 * CanCustomizeHeaderWidgets, so a widget above that page is a supported API
 * taking a class name - not another selector against a card that has no class of
 * its own, which the backlog already names as the most fragile thing in the
 * stylesheet.
 *
 * It reuses Support\Backups::query(), which already scopes to what the reader
 * may see. That is the right half of the pair here: a widget runs in a request
 * with somebody signed in, which is exactly the case the panel-wide half exists
 * to cover for the watchdog.
 */
class MyBackups extends Widget
{
    /**
     * Written out, like the dashboard widget's, and for the same reason:
     * Filament reads the property and a property cannot call a method.
     */
    protected string $view = 'essentials::widgets.my-backups';

    protected int|string|array $columnSpan = 'full';

    /**
     * Lazy.
     *
     * It counts backups across every server somebody can reach, which is a
     * query with two aggregates on it. The server list is the page people land
     * on after signing in, and nothing here is worth a millisecond of that.
     */
    protected static bool $isLazy = true;

    /**
     * How many names the line carries before it starts counting instead.
     *
     * Somebody with forty servers behind on backups does not need forty names
     * on the page they land on - they need to know it is forty.
     */
    private const SHOWN = 6;

    public static function canView(): bool
    {
        try {
            return Features::enabled(Features::MY_BACKUPS) && self::rows() !== [];
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The servers with nothing, and the servers gone stale.
     *
     * Two lists rather than one count, because they are two different things
     * and only one of them is a surprise: "no backup at all" is usually a
     * server nobody set one up for, and "the last one was nine days ago" is a
     * schedule that has stopped.
     *
     * @return array<string, array<int, string>>
     */
    public static function rows(): array
    {
        static $rows = null;

        if ($rows !== null) {
            return $rows;
        }

        $none = [];
        $stale = [];

        try {
            foreach (Backups::query()->get() as $server) {
                /** @var Server $server */
                $last = $server->ld_last;

                if ($last === null) {
                    $none[] = (string) $server->name;

                    continue;
                }

                if (Backups::stale($last) === true) {
                    $stale[] = (string) $server->name;
                }
            }
        } catch (Throwable) {
            // A count that will not run is a line that is not drawn, on the
            // page somebody lands on. It may not take that page with it.
            return $rows = [];
        }

        if ($none === [] && $stale === []) {
            return $rows = [];
        }

        return $rows = ['none' => $none, 'stale' => $stale];
    }

    /**
     * What the line says.
     *
     * One sentence, built from whichever halves apply. A widget that always
     * says something is a widget people stop reading; this one is not drawn at
     * all when every server has a recent backup, which is the usual case and
     * the one worth saying nothing about.
     */
    public function sentence(): string
    {
        $rows = self::rows();

        if ($rows === []) {
            return '';
        }

        $parts = [];

        if (($rows['none'] ?? []) !== []) {
            $parts[] = Theme::trans('mybackups.none', ['count' => count($rows['none'])]);
        }

        if (($rows['stale'] ?? []) !== []) {
            $parts[] = Theme::trans('mybackups.stale', [
                'count' => count($rows['stale']),
                'days' => Backups::days(),
            ]);
        }

        return implode(' ', $parts);
    }

    /**
     * The names, capped.
     *
     * A list rather than a sentence with commas in it. Both say the same six
     * words; only one of them can be drawn as six things somebody scans for
     * their own server rather than as a paragraph they read to the end. The
     * blade draws them - the cap and the arithmetic stay here.
     *
     * @return array<int, string>
     */
    public function names(): array
    {
        $rows = self::rows();

        return array_slice(array_merge($rows['none'] ?? [], $rows['stale'] ?? []), 0, self::SHOWN);
    }

    /**
     * "and 28 more", or nothing at all when every name is on the page.
     *
     * Its own method rather than the tail of the last name, because it is not a
     * server: it is drawn without the ground the others have, so that nobody
     * looks for a server called "and 28 more".
     */
    public function more(): string
    {
        $rows = self::rows();

        $rest = count(array_merge($rows['none'] ?? [], $rows['stale'] ?? [])) - self::SHOWN;

        return $rest > 0 ? Theme::trans('mybackups.and_more', ['count' => $rest]) : '';
    }
}
