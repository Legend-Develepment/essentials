<?php

namespace LegendDevelopment\Theme\Support\Status;

use App\Enums\ContainerStatus;
use App\Models\Server;
use Illuminate\Support\Facades\Cache;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Minecraft\Minecraft;
use LegendDevelopment\Theme\Support\NodeHealth;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Minecraft\Ping;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\UserTheme;
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
    /** Where a built snapshot lives; one per page. */
    private const KEY = 'legend-theme.status.snapshot';

    /**
     * How long a snapshot stands.
     *
     * Five minutes rather than the quarter hour it began as. The page rebuilds
     * on the minute from the scheduler, so this is only what covers a missed
     * run - and a status page showing figures from twelve minutes ago during an
     * outage is a status page nobody trusts twice.
     */
    private const HOLDS = 300;

    /**
     * The shortest gap between two builds, and how often the page asks.
     *
     * A build reaches every chosen node, so this is what stops a page being
     * refreshed forty times a minute from turning into forty rounds of daemon
     * calls. It is public because the page counts down to it: telling somebody
     * when the next check lands is the difference between a page that looks
     * stale and one that is obviously working.
     */
    public const FLOOR = 60;

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
        return self::pairs((string) Theme::config('status_servers', ''));
    }

    /**
     * Pairs of id and name, joined by a pipe.
     *
     * One parser for the servers and the nodes, because they are the same
     * decision made twice - an id somebody picked and a name they typed.
     *
     * @return array<int, array{id: int, name: string}>
     */
    private static function pairs(string $stored): array
    {
        $out = [];

        foreach (explode('|', $stored) as $pair) {
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
     * The nodes an administrator chose, and what they called them.
     *
     * Same shape and same rule as the servers: a typed name, because a node is
     * usually called something like hetzner-fsn1-01 and that is a sentence
     * about where your machines are.
     *
     * Panel-wide only. A user's own page never shows nodes - which machine
     * their server sits on is the panel's business, not a tenant's.
     *
     * @return array<int, array{id: int, name: string}>
     */
    public static function nodeRows(): array
    {
        return self::pairs((string) Theme::config('status_nodes', ''));
    }

    /** A style value meaning "whatever the panel itself is set to". */
    public const FOLLOW = 'panel';

    /**
     * How a page looks.
     *
     * One place, so the panel's own page and somebody's resolve a style
     * identically - and so "follow the panel" means the same thing on both.
     *
     * One setting, not three.
     *
     * It began as a style, an accent override and a light/dark selector, and
     * that was two too many. A style already says what colour it is and whether
     * it is a light or a dark one - Paper is light, Ember is not - so an accent
     * box beside it is a way to contradict the thing you just chose, and a mode
     * selector beside it is a way to put white text on a white page. The first
     * person to use it set an accent and then reported that the style did not
     * work, which is exactly what those two controls were built to do to each
     * other.
     *
     * So the style brings everything: its colour, the surface every grey is
     * built from, how round the corners are, and - read off that surface rather
     * than asked separately - whether the page is light or dark.
     *
     * Everything here is sanitised rather than trusted. All of it is
     * interpolated into a stylesheet on a page served with no login in front of
     * it, and the choice is made by a user.
     *
     * @param  array<string, mixed>  $own  the page's own settings, if it has any
     * @return array{accent: string, surface: string, radius: string, mode: string}
     */
    public static function style(array $own = []): array
    {
        $style = (string) ($own['style'] ?? Theme::config('status_style', self::FOLLOW));

        /*
         * A preset if it names one, and the panel's own settings otherwise.
         *
         * Presets::values() answers with every field a preset fills in, and an
         * unknown name answers with nothing - so a style that was deleted after
         * a page chose it falls back to the panel rather than to a blank page.
         */
        $values = $style === self::FOLLOW || !Presets::exists($style)
            ? ['accent' => Theme::config('accent'), 'surface' => Theme::config('surface', ''), 'radius' => Theme::config('radius', 'normal')]
            : Presets::values($style);

        $surface = trim((string) ($values['surface'] ?? ''));

        return [
            'accent' => Palette::sanitize($values['accent'] ?? ''),
            /*
             * The one colour every grey on the page is built from.
             *
             * A preset may leave it empty, meaning "the theme's own near-black",
             * so there is a fallback here rather than a page of undefined
             * custom properties.
             */
            'surface' => Palette::sanitize($surface === '' ? '#16181d' : $surface),
            'radius' => in_array($values['radius'] ?? '', ['sharp', 'normal', 'round'], true)
                ? (string) $values['radius']
                : 'normal',
            'mode' => self::modeOf($surface === '' ? '#16181d' : $surface),
        ];
    }

    /**
     * Whether a surface is a light one.
     *
     * Asked of the colour rather than of a setting, because a style already
     * knows: Paper is a light theme and Midnight is not, and making somebody
     * say so again is making them able to get it wrong.
     *
     * Worked out through Palette::contrast(), which is already here and already
     * tested - whichever of black or white reads better on the surface is the
     * ink the page wants, and that is the same question as light or dark.
     */
    private static function modeOf(string $surface): string
    {
        try {
            return Palette::contrast($surface, '#000000') > Palette::contrast($surface, '#ffffff')
                ? 'light'
                : 'dark';
        } catch (Throwable) {
            return 'dark';
        }
    }

    /**
     * The styles a page may be set to.
     *
     * Two lists, and the difference is the same one the Appearance page already
     * makes: **which styles exist is the administrator's decision, which one you
     * use is yours.**
     *
     *  - An administrator gets every style the panel has, because they can
     *    already set any of them as the panel's own look. Offering fewer here
     *    would be a restriction that exists nowhere else they go.
     *  - A user gets the list an administrator chose to offer - the same one
     *    they pick from for their own view of the panel, under Appearance. A
     *    style nobody was offered is not one to hand out on a public page
     *    through a different door.
     *
     * Both always include following the panel, which is the default and the
     * answer for anybody who does not want to think about it.
     *
     * @return array<string, string>
     */
    public static function styles(bool $forUser = false): array
    {
        $out = [self::FOLLOW => Theme::trans('status.style_panel')];

        try {
            $names = $forUser ? UserTheme::allowed() : Presets::names();

            foreach ($names as $name) {
                $out[$name] = Presets::label($name);
            }
        } catch (Throwable) {
            // No styles is just the one option, which still works.
        }

        return $out;
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
    public static function read(?int $userId = null): array
    {
        try {
            $held = Cache::get(self::key($userId));

            if (is_array($held) && isset($held['servers'])) {
                return $held;
            }
        } catch (Throwable) {
            // An unreadable cache builds below, which is slow and correct.
        }

        return self::build($userId);
    }

    /**
     * One cache entry per page.
     *
     * The panel's own and each person's are different lists reaching different
     * daemons, and sharing a key would mean the first visitor of the minute
     * deciding what everybody else's page says.
     */
    private static function key(?int $userId): string
    {
        return self::KEY . ($userId === null ? '' : '.user.' . $userId);
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
    public static function build(?int $userId = null): array
    {
        $empty = ['at' => time(), 'servers' => [], 'nodes' => [], 'monitors' => [], 'title' => '', 'note' => ''];

        if (!Features::enabled(Features::PUBLIC_STATUS)) {
            return $empty;
        }

        $key = self::key($userId);
        $lock = self::BUILDING . ($userId === null ? '' : '.user.' . $userId);

        try {
            // A build already running, or one that finished less than a minute
            // ago. Either way the answer is whatever is stored, even if that is
            // nothing yet - a second build would not be faster.
            if (Cache::get($lock) !== null) {
                $held = Cache::get($key);

                return is_array($held) && isset($held['servers']) ? $held : $empty;
            }

            Cache::put($lock, true, self::FLOOR);
        } catch (Throwable) {
            // No cache means no floor, and a page that still works. The panel
            // is in a worse state than this page.
        }

        $snapshot = $userId === null ? self::panelPage() : self::userPage($userId);

        try {
            Cache::put($key, $snapshot, self::HOLDS);
        } catch (Throwable) {
            // Built and served without being kept, which is slow rather than
            // broken.
        }

        return $snapshot;
    }

    /**
     * The panel's own page: chosen servers, chosen nodes, and the monitors.
     *
     * @return array{at: int, servers: array<int, mixed>, nodes: array<int, mixed>, monitors: array<int, mixed>, title: string, note: string}
     */
    private static function panelPage(): array
    {
        $servers = [];

        foreach (self::rows() as $row) {
            $servers[] = self::one($row['id'], $row['name']);
        }

        return [
            'at' => time(),
            'servers' => $servers,
            'nodes' => self::nodes(),
            'monitors' => Monitors::check(),
            'title' => trim((string) Theme::config('status_title', '')),
            'note' => trim((string) Theme::config('status_note', '')),
            'style' => self::style(),
        ];
    }

    /**
     * Somebody's own page: their servers, and nothing else.
     *
     * No nodes and no monitors, and neither is an oversight. See Status\Pages
     * for why each is the administrator's alone.
     *
     * @return array{at: int, servers: array<int, mixed>, nodes: array<int, mixed>, monitors: array<int, mixed>, title: string, note: string}
     */
    private static function userPage(int $userId): array
    {
        $page = Pages::of($userId);
        $servers = [];

        foreach ($page['servers'] as $row) {
            $servers[] = self::one($row['id'], $row['name']);
        }

        return [
            'at' => time(),
            'servers' => $servers,
            'nodes' => [],
            'monitors' => [],
            'title' => $page['title'],
            'note' => $page['note'],
            'style' => self::style(['style' => $page['style']]),
        ];
    }

    /**
     * The chosen nodes, reduced to what may be said in public.
     *
     * Up or down and nothing else. Not the load, not how full the disk is, not
     * how many servers are on it - a visitor asking whether they can play does
     * not need a capacity report on somebody's hardware, and publishing one is
     * a map of where the pressure is.
     *
     * @return array<int, array{name: string, state: string}>
     */
    private static function nodes(): array
    {
        $wanted = self::nodeRows();

        if ($wanted === []) {
            return [];
        }

        $named = [];

        foreach ($wanted as $row) {
            $named[$row['id']] = $row['name'];
        }

        $out = [];

        try {
            foreach (NodeHealth::nodes(array_keys($named)) as $node) {
                $id = (int) ($node['id'] ?? 0);

                if (!isset($named[$id])) {
                    continue;
                }

                $out[] = [
                    'name' => $named[$id],
                    // Maintenance reads as unknown rather than down: it is
                    // deliberate, it is temporary, and "offline" would have
                    // people asking what happened.
                    'state' => match (true) {
                        (bool) ($node['maintenance'] ?? false) => 'unknown',
                        (bool) ($node['reachable'] ?? false) => 'up',
                        default => 'down',
                    },
                ];
            }
        } catch (Throwable) {
            return [];
        }

        return $out;
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
