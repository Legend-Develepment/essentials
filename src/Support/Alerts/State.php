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
        if (self::$held !== null) {
            return self::$held;
        }

        self::$held = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::FILE)) {
                return self::$held;
            }

            $decoded = json_decode((string) $disk->get(self::FILE), true);

            if (!is_array($decoded)) {
                return self::$held;
            }

            foreach ($decoded as $key => $row) {
                if (!is_string($key) || !is_array($row)) {
                    continue;
                }

                self::$held[$key] = [
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

        return self::$held;
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
                self::$held[$key] = $row;
                self::write();

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

        self::$held[$key] = $row;

        // A repeat for something still wrong, when one was asked for.
        $due = !$changed
            && $result === self::BAD
            && $repeat > 0
            && $now - $row['told'] >= $repeat;

        if ($due) {
            self::$held[$key]['told'] = $now;
        }

        self::write();

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

        try {
            return Storage::disk('local')->put(self::FILE, '{}') !== false;
        } catch (Throwable) {
            return false;
        }
    }

    private static function write(): void
    {
        try {
            Storage::disk('local')->put(self::FILE, (string) json_encode(self::$held ?? []));
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
