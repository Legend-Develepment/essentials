<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * What each check said last time, so the same news is not sent twice.
 *
 * This is the piece that decides whether a watchdog is usable. A node that goes
 * down at three in the morning and is fixed at nine is one event; a check
 * running every five minutes turns it into seventy-two messages, and seventy-two
 * messages is a channel people mute. A muted channel is worse than no watchdog,
 * because the next outage arrives somewhere nobody is looking.
 *
 * So a message is sent when a check **changes** state, in either direction.
 * Recovery is news - arguably the more useful half, since it is the answer to
 * "is it back yet" that somebody would otherwise go and look for.
 *
 * Three rules, each of which exists because the obvious version is wrong:
 *
 *  1. **A check that cannot run is not a check that failed.** A daemon that
 *     timed out once says nothing about the node; it says something about the
 *     network for two seconds. An unreadable result is held and only becomes an
 *     alert after it happens twice in a row.
 *  2. **A state that persists repeats at most on a chosen interval**, and the
 *     default for that is never. Somebody who wants a reminder every six hours
 *     that a disk is still full can ask for one; nobody should get one because
 *     it seemed thorough.
 *  3. **Nothing is sent on the first run after installing.** A fresh state file
 *     means every check is "changed" - which would deliver one message per node
 *     per check the moment the feature is switched on. The first run learns and
 *     says nothing.
 *
 * Kept in a file under storage rather than a table, for the same reason
 * favourites and per-user layouts are: no migration, and this plugin has never
 * needed one.
 */
class State
{
    private const FILE = 'legend-theme/alerts/state.json';

    /** @var array<string, array{state: string, since: int, told: int, unread: int}>|null */
    private static ?array $held = null;

    /**
     * The keys this process has changed, and the ones it has taken away.
     *
     * Kept because a write only ever puts these back, never the whole of what
     * was read. Somebody else's rows are theirs.
     *
     * @var array<string, true>
     */
    private static array $touched = [];

    /** @var array<string, true> */
    private static array $dropped = [];

    /** A check is fine, or it is not, or nothing could be read. */
    public const OK = 'ok';

    public const BAD = 'bad';

    public const UNREADABLE = 'unreadable';

    /**
     * Everything the file holds.
     *
     * @return array<string, array{state: string, since: int, told: int, unread: int}>
     */
    public static function all(): array
    {
        if (self::$held === null) {
            self::$held = self::read();
        }

        return self::$held;
    }

    /**
     * Forget what is held, so the next question goes to the file.
     *
     * A queue worker is one process handling many jobs, and the rows above are
     * static, so without this the snapshot taken by the first pass a worker ran
     * is the snapshot every later pass reads - for as long as the worker lives,
     * which on a quiet panel is days. Reset in the browser is a different
     * process, and the worker would never learn that it had happened.
     *
     * Called at the top of a pass. Anything not yet written down is dropped
     * with it, which is right there and nowhere else: a pass that has begun has
     * nothing pending.
     */
    public static function refresh(): void
    {
        self::$held = null;
        self::$touched = [];
        self::$dropped = [];
    }

    /**
     * The file, parsed, every time.
     *
     * @return array<string, array{state: string, since: int, told: int, unread: int}>
     */
    private static function read(): array
    {
        $rows = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::FILE)) {
                return $rows;
            }

            $decoded = json_decode((string) $disk->get(self::FILE), true);

            if (!is_array($decoded)) {
                return $rows;
            }

            foreach ($decoded as $key => $row) {
                if (!is_string($key) || !is_array($row)) {
                    continue;
                }

                $rows[$key] = [
                    'state' => in_array($row['state'] ?? null, [self::OK, self::BAD], true)
                        ? $row['state']
                        : self::OK,
                    'since' => (int) ($row['since'] ?? 0),
                    'told' => (int) ($row['told'] ?? 0),
                    'unread' => (int) ($row['unread'] ?? 0),
                ];
            }
        } catch (Throwable) {
            // An unreadable state file is a watchdog that has just been
            // installed. It will say nothing this run and learn, which is the
            // same as the honest first run and not a failure worth reporting.
        }

        return $rows;
    }

    /** Whether anything has ever been recorded. Governs the quiet first run. */
    public static function fresh(): bool
    {
        return self::all() === [];
    }

    /**
     * Record what a check just said, and answer whether that is worth sending.
     *
     * @param  string  $key     the check and what it is about - 'node.7.disk'
     * @param  string  $result  OK, BAD or UNREADABLE
     * @param  int     $repeat  seconds before a standing state is repeated; 0 for never
     * @return string|null      'raised', 'cleared', 'reminder', or null for say nothing
     */
    public static function record(string $key, string $result, int $repeat = 0): ?string
    {
        $said = self::note($key, $result, $repeat);

        self::write();

        return $said;
    }

    /**
     * The same for several at once, written once.
     *
     * record() writes the file as it goes, which is right for a check that has
     * one key and wrong for one that keeps a key per subject: the stock check
     * holds two rows per package, and four hundred packages would be eight
     * hundred writes of a file that grows with every row in it.
     *
     * @param  array<string, string>  $readings  key to OK, BAD or UNREADABLE
     * @return array<string, string|null>        key to what record() would have answered
     */
    public static function records(array $readings, int $repeat = 0): array
    {
        $said = [];

        foreach ($readings as $key => $result) {
            $said[$key] = self::note($key, $result, $repeat);
        }

        if ($readings !== []) {
            self::write();
        }

        return $said;
    }

    /** One reading, remembered but not yet written down. */
    private static function note(string $key, string $result, int $repeat): ?string
    {
        $rows = self::all();
        $now = time();
        $quiet = self::fresh();

        $row = $rows[$key] ?? ['state' => self::OK, 'since' => $now, 'told' => 0, 'unread' => 0];

        /*
         * Unreadable twice before it counts.
         *
         * One failed reading is a network having a moment. The count is kept
         * rather than the result, so a check that flickers between unreadable
         * and fine never accumulates its way to an alert.
         */
        if ($result === self::UNREADABLE) {
            $row['unread']++;

            if ($row['unread'] < 2) {
                self::keep($key, $row);

                return null;
            }

            $result = self::BAD;
        } else {
            $row['unread'] = 0;
        }

        $was = $row['state'];
        $changed = $was !== $result;

        if ($changed) {
            $row['state'] = $result;
            $row['since'] = $now;
            $row['told'] = $now;
        }

        // A repeat for something still wrong, when one was asked for.
        $due = !$changed
            && $result === self::BAD
            && $repeat > 0
            && $now - $row['told'] >= $repeat;

        if ($due) {
            $row['told'] = $now;
        }

        self::keep($key, $row);

        /*
         * The first run says nothing at all.
         *
         * With no file, every check has "changed" - so switching the feature on
         * would deliver one message per node per check, immediately, describing
         * a panel that is fine. The run learns instead.
         */
        if ($quiet) {
            return null;
        }

        if ($changed) {
            return $result === self::BAD ? 'raised' : 'cleared';
        }

        return $due ? 'reminder' : null;
    }

    /**
     * Hold a row, and remember whether it is actually different.
     *
     * The comparison is the point rather than an economy. A pass on a panel
     * with nothing wrong reaches every key and changes none of them, so without
     * this it would rewrite the whole file anyway - and that write is what
     * would put another process's rows back after they had been taken away.
     *
     * @param  array{state: string, since: int, told: int, unread: int}  $row
     */
    private static function keep(string $key, array $row): void
    {
        if ((self::$held[$key] ?? null) === $row) {
            return;
        }

        self::$held[$key] = $row;
        self::$touched[$key] = true;
        unset(self::$dropped[$key]);
    }

    /** How long the current state has stood, in seconds, or null if unknown. */
    public static function standing(string $key): ?int
    {
        $row = self::all()[$key] ?? null;

        return $row === null || $row['since'] === 0 ? null : max(0, time() - $row['since']);
    }

    /**
     * Drop everything.
     *
     * Offered on the settings page, because the alternative to a reset is
     * somebody deleting a file on a server to make the watchdog stop insisting
     * about a node they have decommissioned.
     */
    public static function forget(): bool
    {
        self::$held = [];
        self::$touched = [];
        self::$dropped = [];

        try {
            return Storage::disk('local')->put(self::FILE, '{}') !== false;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Drop the rows under a prefix that this pass did not see.
     *
     * A check that keeps one key per subject has to answer what happens when a
     * subject goes. Without this, a package deleted from the shop leaves its
     * two rows behind for ever, and a new package that happens to be given the
     * same id inherits a state it never earned - it would be told it had come
     * back into stock, from a row about something else.
     *
     * Only ever called with a reading that worked. Handed the answer from a
     * failed query it would forget the whole shop and announce all of it again
     * on the next pass.
     *
     * @param  array<int, string>  $keep  the full keys this pass recorded
     * @return int  how many were dropped
     */
    public static function prune(string $prefix, array $keep): int
    {
        if ($prefix === '') {
            return 0;
        }

        $rows = self::all();
        $keeping = array_flip($keep);
        $gone = 0;

        foreach (array_keys($rows) as $key) {
            if (!str_starts_with($key, $prefix) || isset($keeping[$key])) {
                continue;
            }

            unset(self::$held[$key], self::$touched[$key]);
            self::$dropped[$key] = true;
            $gone++;
        }

        if ($gone > 0) {
            self::write();
        }

        return $gone;
    }

    /**
     * Put back what this process changed, and nothing else.
     *
     * The file is read again here rather than written from what was held, and
     * that is the whole of the repair. Written whole, a pass puts back every row
     * it read at the start - including rows another process has since taken
     * away, which is how pressing Reset in the browser did nothing on a panel
     * whose queue worker was already running, and how two passes overlapping
     * lost each other's news.
     *
     * Read, overlay, write is not atomic and two writes landing in the same
     * instant can still lose one. That is a narrower window than the length of
     * a whole pass, it costs nothing to close this far, and closing it further
     * would mean a lock around a file that four checks write to.
     */
    private static function write(): void
    {
        if (self::$touched === [] && self::$dropped === []) {
            return;
        }

        try {
            $rows = self::read();

            foreach (array_keys(self::$touched) as $key) {
                if (isset(self::$held[$key])) {
                    $rows[$key] = self::$held[$key];
                }
            }

            foreach (array_keys(self::$dropped) as $key) {
                unset($rows[$key]);
            }

            Storage::disk('local')->put(self::FILE, (string) json_encode($rows));

            // What is on the file is now what this process knows, which is how
            // a later pass in the same worker sees another one's work.
            self::$held = $rows;
            self::$touched = [];
            self::$dropped = [];
        } catch (Throwable) {
            /*
             * A state that cannot be written means every run looks like the
             * first one, so nothing is ever sent. That is the safe direction:
             * the other one is a watchdog repeating itself every five minutes
             * for ever with no way to stop it from the panel.
             */
        }
    }
}
