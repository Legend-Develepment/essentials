<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Server;
use Throwable;

/**
 * Which of somebody's own servers needs attention.
 *
 * Pelican's cards say what a server is doing right now - its state, and three
 * meters. Nothing on that page says a backup has not run in three weeks, or
 * that the schedule which was supposed to make one stopped in August. Those are
 * the things somebody finds out on the day they need them.
 *
 * **Named for the question rather than for the first answer to it.** This began
 * as a backup warning and the name said so; it now also reports a schedule that
 * has stopped, and it will grow again. A class called MyBackups reporting
 * schedules is a name somebody has to read the body to understand.
 *
 * What is deliberately not here is anything that reaches a node. "Your server's
 * machine is not answering" is worth saying and costs a request per node - on
 * the page everybody lands on, before anything is drawn. The watchdog already
 * asks that question on a timer and already tells the owner, which is the right
 * place for it: see Features::OWNER_ALERTS.
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
class Attention
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
            return Features::enabled(Features::MY_BACKUPS)
                && (self::rows() !== [] || self::schedules() !== []);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * This person's schedules that have stopped.
     *
     * Stuck part way through a run, overdue because the cron is not running, or
     * never run at all. Pelican has no word for any of those - a crashed run
     * stays "processing" for ever and is drawn exactly like one running now -
     * so the owner of a server whose nightly backup died in August has no way
     * to find out except by opening the schedule and reading a date.
     *
     * Asked of their own servers only, and filtered in the query: a panel with
     * four hundred schedules must not read all of them to report somebody's
     * two.
     *
     * @return array<int, array{id: int, name: string, server: string, verdict: string}>
     */
    public static function schedules(): array
    {
        static $held = null;

        if ($held !== null) {
            return $held;
        }

        try {
            if (!Features::enabled(Features::SCHEDULES)) {
                return $held = [];
            }

            $ids = Backups::forUser(user())->pluck('servers.id')->all();

            return $held = $ids === [] ? [] : Schedules::troubled($ids);
        } catch (Throwable) {
            return $held = [];
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

        $stopped = count(self::schedules());

        if ($stopped > 0) {
            $parts[] = Theme::trans('mybackups.schedules', ['count' => $stopped]);
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
