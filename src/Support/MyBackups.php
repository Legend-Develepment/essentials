<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Server;
use Throwable;

/**
 * Which of somebody's own servers has no backup.
 *
 * Pelican's cards say what a server is doing right now - its state, and three
 * meters. Nothing on that page says a backup has not run in three weeks, and
 * that is the thing somebody finds out on the day they need one.
 *
 * **This was a header widget for eight releases and is a render hook now.** Not
 * a preference: a widget lands in Filament's widget grid, which is two columns
 * wide, so a one-line warning about twenty-five servers was drawn down half the
 * page in a column beside nothing. Three attempts to widen it from the
 * stylesheet all failed, each in a way that looked like the last - and the
 * fourth would have been another guess at markup that cannot be read from here.
 *
 * The announcement bar has been full width since the day it shipped, because it
 * is rendered at PAGE_START and never went near the grid. So this is too. The
 * hook is scoped to the server list, so it appears there and nowhere else.
 *
 * What that costs, said plainly: it is no longer a Livewire component, so it
 * cannot poll or refresh itself. It never did either - it was drawn once per
 * page load - and in exchange the layout stops depending on a wrapper this
 * codebase has no way to inspect.
 *
 * The reading is unchanged. Support\Backups::query() already scopes to what the
 * reader may see, which is the right half of the pair: a page has a reader,
 * where the watchdog does not.
 */
class MyBackups
{
    /**
     * How many names the line carries before it starts counting instead.
     *
     * Somebody with forty servers behind on backups does not need forty names
     * on the page they land on - they need to know it is forty.
     */
    private const SHOWN = 6;

    /** Whether there is anything at all to say. */
    public static function enabled(): bool
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
     * One sentence, built from whichever halves apply. A line that always says
     * something is one people stop reading; this one is not drawn at all when
     * every server has a recent backup, which is the usual case and the one
     * worth saying nothing about.
     */
    public static function sentence(): string
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
     * their own server rather than as a paragraph they read to the end.
     *
     * @return array<int, string>
     */
    public static function names(): array
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
    public static function more(): string
    {
        $rows = self::rows();

        $rest = count(array_merge($rows['none'] ?? [], $rows['stale'] ?? [])) - self::SHOWN;

        return $rest > 0 ? Theme::trans('mybackups.and_more', ['count' => $rest]) : '';
    }
}
