<?php

namespace LegendDevelopment\Theme\Support;

use LegendDevelopment\Theme\Jobs\Heartbeat;
use Throwable;

/**
 * Whether there is a queue worker, and whether it can run this plugin's code.
 *
 * Nearly everything this plugin does that takes longer than a request happens
 * on the queue: updating itself, installing a modpack. All of it needs a worker
 * process, and a panel without one fails in the quietest possible way - the
 * button says "started", the job is written to the table, and nothing ever
 * reads it. There is no error, because nothing errored.
 *
 * So this asks the only question that can actually be answered from inside the
 * panel: dispatch a job, and see whether anything runs it.
 *
 * That the probe is one of *this plugin's* job classes is the point rather than
 * a convenience. A worker registers a plugin's PSR-4 prefix once, when it boots,
 * and PluginService skips that registration entirely for a plugin it considers
 * incompatible or whose manifest it could not read. A worker that started while
 * this plugin was in either state is running perfectly well and still cannot
 * unserialise a single job of ours. A probe using a framework job would come
 * back healthy and be wrong about the only thing being asked. This one fails
 * exactly where an update would fail.
 *
 * What this cannot do is start a worker. That is a supervisor's job - systemd,
 * supervisord, whatever the host uses - and a plugin has neither the rights nor
 * the permission to reach it. See the note in InstallTasks. What it can do is
 * make "there is no worker" something the panel says on the page you are already
 * looking at, instead of something worked out days later from an update that
 * never arrived.
 */
class Workers
{
    private const BEAT = 'legend-theme.worker.beat';

    private const PROBED = 'legend-theme.worker.probed';

    /**
     * How long an unanswered probe stands before another is sent.
     *
     * One outstanding probe at a time, and that bound matters: the automatic
     * check runs as often as every minute, and a probe per check on a panel
     * with no worker would write 1,440 rows a day into a table nothing is
     * reading. Fifteen minutes also sets how stale the answer can be, which is
     * the right trade for a line that reports a condition lasting until someone
     * fixes it.
     */
    private const STANDS_FOR = 900;

    /**
     * How long an answer stays good enough not to ask again.
     *
     * The other half of the same restraint. Without it a healthy panel on the
     * every-minute setting would dispatch 1,440 probes a day - each one
     * trivial, all of them pointless, and every one of them noise in a queue
     * somebody may be watching. Ten minutes is far inside the window in which
     * anyone would notice a worker had stopped.
     */
    private const FRESH_FOR = 600;

    /**
     * Ask, if nothing is already being waited on.
     *
     * Cheap enough to call on every automatic check and after every install:
     * on a healthy panel the previous probe has been answered and this is one
     * job; on a broken one it is one job per quarter hour.
     */
    public static function probe(): void
    {
        try {
            $probed = self::at(self::PROBED);
            $beat = self::at(self::BEAT);

            if ($probed !== null) {
                $answered = $beat !== null && $beat >= $probed;

                // Answered, and recently enough that asking again would only
                // be repeating a question with a known answer.
                if ($answered && time() - $beat < self::FRESH_FOR) {
                    return;
                }

                // Not answered, and not yet standing long enough to be worth
                // putting a second one behind it.
                if (!$answered && time() - $probed < self::STANDS_FOR) {
                    return;
                }
            }

            cache()->put(self::PROBED, time(), now()->addDays(30));

            Heartbeat::dispatch();
        } catch (Throwable) {
            // Being unable to ask is not worth failing an install or a
            // scheduled check over. The line simply says nothing.
        }
    }

    /**
     * Called by the job itself, from inside the worker.
     */
    public static function beat(): void
    {
        try {
            cache()->put(self::BEAT, time(), now()->addDays(30));
        } catch (Throwable) {
            // Then the probe reads as unanswered, which on a panel whose cache
            // will not hold an integer is not the wrong conclusion to draw.
        }
    }

    /**
     * One of:
     *
     *  - `unknown`  - nothing has been asked yet, so nothing can be said.
     *  - `working`  - a worker answered, and it could load this plugin's code.
     *  - `waiting`  - asked, not yet answered, and not long enough ago to call it.
     *  - `missing`  - asked, and nothing has answered since. Either there is no
     *                 worker, or there is one that cannot run this plugin's jobs
     *                 because it booted before the plugin was installable.
     *
     * @return array{state: string, at: int|null}
     */
    public static function state(): array
    {
        try {
            $probed = self::at(self::PROBED);
            $beat = self::at(self::BEAT);

            if ($probed === null) {
                return ['state' => 'unknown', 'at' => $beat];
            }

            if ($beat !== null && $beat >= $probed) {
                return ['state' => 'working', 'at' => $beat];
            }

            // A worker takes a moment to pick a job up, and a busy one takes
            // longer. Nothing is called missing until a probe has stood
            // unanswered for a good deal longer than any of that.
            return [
                'state' => time() - $probed < 120 ? 'waiting' : 'missing',
                'at' => $beat,
            ];
        } catch (Throwable) {
            return ['state' => 'unknown', 'at' => null];
        }
    }

    /**
     * What to say under "Update started".
     *
     * A button that queues work a worker will never take should not report
     * success and leave it at that. It is still queued - the moment a worker
     * appears it runs, so the dispatch is not wasted and the wording must not
     * claim it failed either. What changes is that the panel now says which
     * part is missing instead of leaving somebody to press it again.
     *
     * Only ever downgraded on a probe that actually went unanswered. `unknown`
     * and `waiting` both read as normal: a guess dressed as a warning would be
     * worse than the silence it replaces.
     */
    public static function body(): string
    {
        $background = Theme::trans('page.update_background');

        try {
            return self::state()['state'] === 'missing'
                ? $background . ' ' . Theme::trans('page.worker_missing')
                : $background;
        } catch (Throwable) {
            return $background;
        }
    }

    private static function at(string $key): ?int
    {
        $held = cache()->get($key);

        return is_int($held) ? $held : null;
    }
}
