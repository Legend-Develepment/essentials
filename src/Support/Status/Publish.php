<?php

namespace LegendDevelopment\Theme\Support\Status;

use App\Enums\ContainerStatus;
use App\Models\Server;
use Illuminate\Support\Facades\Cache;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\Minecraft\Ping;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What the world is allowed to see.
 *
 * This is the first thing this plugin has ever served to somebody who is not
 * signed in, and that changes the standard rather than merely adding a page. On
 * every other page the question is "what does this person need"; here it is
 * "what would I be prepared to see on somebody else's forum", and the answer is
 * a name, whether it is up, and how many people are on it.
 *
 * Four rules, and none of them is optional:
 *
 *  1. **Opt in per server.** Nothing is public because a feature was switched
 *     on. The list starts empty and a server appears on it only because
 *     somebody ticked it.
 *  2. **A typed name, not the server's own.** A server called "mc-prod-3
 *     (Bryan's, do not touch)" is an internal note. What goes out is what an
 *     administrator wrote for the public, and when they wrote nothing, nothing
 *     goes out - the server is skipped rather than named by accident.
 *  3. **Built on a timer, served from a snapshot.** A status page that asked
 *     every node on every request is a way to have a busy forum thread take
 *     your panel down. What the browser gets is a file that was written
 *     earlier.
 *  4. **Fails closed.** A server the panel cannot reach reads as "unknown", not
 *     as "down". They are different facts and only one of them is safe to
 *     guess - and saying the wrong one in public is worse than saying nothing.
 */
class Publish
{
    /** Where the built snapshot lives. */
    private const KEY = 'legend-theme.status.snapshot';

    /**
     * How long a snapshot stands.
     *
     * Longer than the schedule that writes it, so a missed run shows slightly
     * old figures rather than an empty page. Shorter than an outage matters
     * for, so a page nobody has scheduled is still roughly true.
     */
    private const HOLDS = 900;

    /**
     * The shortest gap between two builds.
     *
     * The floor under rule three. A build reaches every chosen node, so this is
     * what stops a page being refreshed forty times a minute from turning into
     * forty rounds of daemon calls.
     */
    private const FLOOR = 60;

    private const BUILDING = 'legend-theme.status.building';

    public static function enabled(): bool
    {
        try {
            return Features::enabled(Features::PUBLIC_STATUS) && self::rows() !== [];
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The servers an administrator chose, and what they called them.
     *
     * Stored as `id:name` pairs joined by a pipe, the same shape the icon
     * overrides use - one setting, no table, and it survives a round trip
     * through .env.
     *
     * @return array<int, array{id: int, name: string}>
     */
    public static function rows(): array
    {
        $out = [];

        foreach (explode('|', (string) Theme::config('status_servers', '')) as $pair) {
            [$id, $name] = array_pad(explode(':', $pair, 2), 2, null);

            $id = (int) $id;
            $name = trim((string) $name);

            // No name, no row. Falling back to the server's own name is exactly
            // the accident rule two exists to prevent.
            if ($id <= 0 || $name === '') {
                continue;
            }

            $out[$id] = ['id' => $id, 'name' => mb_substr($name, 0, 60)];
        }

        return array_slice(array_values($out), 0, 50);
    }

    /**
     * @param  array<int, array{id: mixed, name: mixed}>  $rows
     */
    public static function toStorage(array $rows): string
    {
        $pairs = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $id = (int) ($row['id'] ?? 0);
            $name = is_string($row['name'] ?? null) ? trim($row['name']) : '';

            // The two characters that would break the format back apart, and
            // control characters, which have no business in a public label.
            $name = str_replace(['|', ':'], ' ', $name);
            $name = trim(preg_replace('/[[:cntrl:]]+/u', ' ', $name) ?? '');
            $name = trim(preg_replace('/\s+/u', ' ', $name) ?? '');

            if ($id <= 0 || $name === '') {
                continue;
            }

            $pairs[$id] = $id . ':' . mb_substr($name, 0, 60);
        }

        return implode('|', array_slice(array_values($pairs), 0, 50));
    }

    /**
     * The snapshot, built if there is not one and it is allowed.
     *
     * @return array{at: int, servers: array<int, array{name: string, state: string, online: ?int, max: ?int}>}
     */
    public static function read(): array
    {
        try {
            $held = Cache::get(self::KEY);

            if (is_array($held) && isset($held['servers'])) {
                return $held;
            }
        } catch (Throwable) {
            // An unreadable cache builds below, which is slow and correct.
        }

        return self::build();
    }

    /**
     * Ask every chosen server how it is, and write the answer down.
     *
     * Behind a lock and a floor: this reaches every node it touches, and the
     * schedule is not the only thing that can call it - a page nobody has
     * scheduled builds on its first visit, and forty visitors in the same
     * minute must produce one build rather than forty.
     *
     * @return array{at: int, servers: array<int, array{name: string, state: string, online: ?int, max: ?int}>}
     */
    public static function build(): array
    {
        $empty = ['at' => time(), 'servers' => []];

        if (!Features::enabled(Features::PUBLIC_STATUS)) {
            return $empty;
        }

        try {
            // A build already running, or one that finished less than a minute
            // ago. Either way the answer is whatever is stored, even if that is
            // nothing yet - a second build would not be faster.
            if (Cache::get(self::BUILDING) !== null) {
                $held = Cache::get(self::KEY);

                return is_array($held) && isset($held['servers']) ? $held : $empty;
            }

            Cache::put(self::BUILDING, true, self::FLOOR);
        } catch (Throwable) {
            // No cache means no floor, and a page that still works. The panel
            // is in a worse state than this page.
        }

        $rows = self::rows();
        $servers = [];

        foreach ($rows as $row) {
            $servers[] = self::one($row['id'], $row['name']);
        }

        $snapshot = ['at' => time(), 'servers' => $servers];

        try {
            Cache::put(self::KEY, $snapshot, self::HOLDS);
        } catch (Throwable) {
            // Built and served without being kept, which is slow rather than
            // broken.
        }

        return $snapshot;
    }

    /**
     * One server, reduced to what may be said about it in public.
     *
     * @return array{name: string, state: string, online: ?int, max: ?int}
     */
    private static function one(int $id, string $name): array
    {
        $row = ['name' => $name, 'state' => 'unknown', 'online' => null, 'max' => null];

        try {
            $server = Server::query()->find($id);

            if ($server === null) {
                // Deleted since it was chosen. Named, because a row that
                // vanished silently is a page that quietly stops mentioning a
                // server people are asking about.
                return $row;
            }

            $state = $server->retrieveStatus();

            /*
             * Three states out of eleven.
             *
             * The public does not need to know the difference between exited,
             * dead and removing - they need to know whether they can play. And
             * Missing is what Pelican answers for a node in maintenance as well
             * as for a container it cannot find, which is precisely why it maps
             * to unknown rather than to down.
             */
            $row['state'] = match ($state) {
                ContainerStatus::Running => 'up',
                ContainerStatus::Starting, ContainerStatus::Restarting => 'starting',
                ContainerStatus::Offline, ContainerStatus::Exited, ContainerStatus::Dead,
                ContainerStatus::Stopping, ContainerStatus::Paused => 'down',
                default => 'unknown',
            };

            /*
             * Player counts, only where they are already being read.
             *
             * The Minecraft ping is off unless an administrator switched it on,
             * and it opens a connection from the panel to a game port. This
             * page does not switch it on for them - it uses the answer if there
             * is one and says nothing if there is not.
             */
            if ($row['state'] === 'up' && Minecraft::detect($server)) {
                $live = Ping::status($server);

                if (is_array($live)) {
                    $row['online'] = (int) ($live['online'] ?? 0);
                    $row['max'] = (int) ($live['max'] ?? 0);
                }
            }
        } catch (Throwable) {
            // Unknown, which is what the row already says.
        }

        return $row;
    }
}
