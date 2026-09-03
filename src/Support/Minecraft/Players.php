<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

use App\Models\Server;
use App\Repositories\Daemon\DaemonFileRepository;
use Throwable;

/**
 * Who plays here: whitelisted, opped, banned, and everyone the server has seen.
 *
 * Built on what Pelican and Minecraft already have rather than on a second
 * connection to the game.
 *
 * The plugin this follows uses RCON and Query, which means a socket from the
 * panel to the game server, a password kept in a settings field, and two
 * protocols to be switched on before anything works. None of that is needed
 * here. Minecraft keeps these lists as JSON in the server directory, which the
 * panel already reads through the daemon, and Pelican can already send a
 * console command through Server::send() - authenticated, permissioned, over
 * the connection the console page uses. So the lists are read from the files,
 * and every change is made the way an administrator would make it: by issuing
 * the command.
 *
 * That direction is not only convenience. Minecraft owns these files while it
 * runs and rewrites them from memory, so a whitelist edited underneath a
 * running server is an edit the game silently discards. Sending `whitelist add`
 * instead means the game makes the change, writes the file, and the two never
 * disagree.
 *
 * Deliberately not here: health, hunger, inventory and gamemode. Those are not
 * in any file the panel can read - they are NBT inside a player's .dat, or they
 * come back over RCON - and an inventory viewer is a great deal of surface for
 * something nobody actually administers a server with. The lists are the part
 * that gets used.
 */
class Players
{
    public const WHITELIST = 'whitelist.json';

    public const OPS = 'ops.json';

    public const BANNED = 'banned-players.json';

    public const BANNED_IPS = 'banned-ips.json';

    /**
     * Everyone the server has ever seen, which is what makes this a list of
     * players rather than a list of exceptions.
     */
    public const CACHE = 'usercache.json';

    /**
     * A cap on each file, and a cap on the rows built from them.
     *
     * usercache.json is the one that grows without limit: a public server up
     * for a year has seen tens of thousands of names, and all of it would be
     * decoded into memory and drawn into a table nobody can read. The byte cap
     * stops the daemon handing over something enormous; the row cap stops the
     * page trying to render it.
     */
    private const MAX_BYTES = 524288;

    private const MAX_ROWS = 500;

    /** The only verbs that may reach a console. */
    private const VERBS = ['whitelist add', 'whitelist remove', 'op', 'deop', 'ban', 'pardon', 'kick'];

    /**
     * A Minecraft name, or null.
     *
     * This is the security boundary of the whole feature, and it is worth being
     * blunt about why. Every action here ends up as a line of text sent to a
     * console that runs it. The name is chosen by whoever is typing into the
     * panel, and a name allowed to contain a newline is a name that can carry a
     * second command behind it - a player called "notch", a line break, and
     * "stop" is a stopped server, or worse on a console that can do more than
     * Minecraft.
     *
     * So this does not sanitise, it accepts or refuses. Mojang's own rule is
     * one to sixteen characters of letters, digits and underscore; anything
     * outside that is not a name in need of cleaning, it is not a name.
     */
    public static function name(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $name = trim($value);

        /*
         * The D is not decoration. Without it PHP's `$` also matches directly
         * before a newline at the end of the subject, so the pattern would
         * accept "notch\n" and the only thing standing between that and a
         * console would be trim() having run first. That happens to hold today,
         * and a security boundary that holds by coincidence of ordering is one
         * waiting for somebody to reorder it. With D, `$` means the end.
         */
        return preg_match('/^[A-Za-z0-9_]{1,16}$/D', $name) === 1 ? $name : null;
    }

    /**
     * A ban or kick reason, made safe to sit at the end of a command.
     *
     * Unlike a name, this is free text, and refusing it outright would be
     * wrong: people write "griefing spawn, third time" and mean it. So it is
     * cleaned rather than validated, and the one thing that has to go is
     * anything that could end the line - every control character, which is
     * newlines and returns and the rest of them. What survives cannot begin a
     * second command, because there is no second line for it to begin on.
     */
    public static function reason(mixed $value, int $limit = 120): string
    {
        if (!is_string($value)) {
            return '';
        }

        $clean = preg_replace('/[[:cntrl:]]/u', ' ', $value);

        if (!is_string($clean)) {
            // preg_replace returns null on a malformed UTF-8 subject. An
            // unusable reason is dropped rather than passed along unchecked.
            return '';
        }

        return trim(mb_substr(trim($clean), 0, $limit));
    }

    /* ------------------------------------------------------------- files -- */

    /**
     * One of Minecraft's JSON lists, decoded, or an empty array.
     *
     * Every failure gives the same answer: a file not there yet, a server that
     * has never started, a daemon that did not reply, JSON that is not a list.
     * None of them is a reason for an error page on a page whose whole job is
     * to show what is there.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function read(Server $server, string $path): array
    {
        try {
            $contents = (new DaemonFileRepository())
                ->setServer($server)
                ->getContent($path, self::MAX_BYTES);

            if (!is_string($contents) || trim($contents) === '') {
                return [];
            }

            $decoded = json_decode($contents, true);

            if (!is_array($decoded)) {
                return [];
            }

            // Only the entries that are objects. Minecraft writes these itself,
            // but a hand-edited file is a thing that happens.
            return array_values(array_filter($decoded, 'is_array'));
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Write one of them back.
     *
     * Only ever reached while the server is stopped. A running Minecraft holds
     * these lists in memory and writes them out itself, so a file changed
     * underneath it is a change that disappears at the next save with nobody
     * being told.
     *
     * @param  array<int, mixed>  $entries
     */
    public static function write(Server $server, string $path, array $entries): bool
    {
        try {
            $json = json_encode(array_values($entries), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            if ($json === false) {
                return false;
            }

            (new DaemonFileRepository())
                ->setServer($server)
                ->putContent($path, $json);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /* -------------------------------------------------------------- rows -- */

    /**
     * Everyone worth showing, merged from the four lists and the cache.
     *
     * Keyed by lowercased name rather than by UUID on purpose: a server in
     * offline mode gives the same player a different UUID than an online one,
     * and the name is what an administrator types and reads. The UUID is
     * carried along for display where a file happened to hold one.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function rows(Server $server): array
    {
        $rows = [];

        $add = static function (array $entry, callable $mark) use (&$rows): void {
            $name = self::name($entry['name'] ?? null);

            if ($name === null) {
                return;
            }

            $key = mb_strtolower($name);

            $rows[$key] ??= [
                'name' => $name,
                'uuid' => is_string($entry['uuid'] ?? null) ? $entry['uuid'] : null,
                'whitelisted' => false,
                'op' => false,
                'level' => null,
                'banned' => false,
                'reason' => null,
                'seen' => false,
            ];

            $rows[$key] = $mark($rows[$key], $entry);
        };

        foreach (self::read($server, self::CACHE) as $entry) {
            $add($entry, static function (array $row): array {
                $row['seen'] = true;

                return $row;
            });
        }

        foreach (self::read($server, self::WHITELIST) as $entry) {
            $add($entry, static function (array $row): array {
                $row['whitelisted'] = true;

                return $row;
            });
        }

        foreach (self::read($server, self::OPS) as $entry) {
            $add($entry, static function (array $row, array $source): array {
                $row['op'] = true;
                $row['level'] = is_int($source['level'] ?? null) ? $source['level'] : null;

                return $row;
            });
        }

        foreach (self::read($server, self::BANNED) as $entry) {
            $add($entry, static function (array $row, array $source): array {
                $row['banned'] = true;
                $row['reason'] = self::reason($source['reason'] ?? null) ?: null;

                return $row;
            });
        }

        /*
         * Banned first, then ops, then the whitelist, then everyone else, and
         * alphabetically inside each. The order answers the question the page
         * is opened with, which is what is unusual about this list today.
         */
        uasort($rows, static function (array $a, array $b): int {
            $rank = static fn (array $row): int => match (true) {
                $row['banned'] => 0,
                $row['op'] => 1,
                $row['whitelisted'] => 2,
                default => 3,
            };

            return [$rank($a), mb_strtolower($a['name'])] <=> [$rank($b), mb_strtolower($b['name'])];
        });

        return array_slice(array_values($rows), 0, self::MAX_ROWS);
    }

    /**
     * The banned addresses, which are a list of their own: they have no name to
     * hang on a player row.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function bannedIps(Server $server): array
    {
        $rows = [];

        foreach (self::read($server, self::BANNED_IPS) as $entry) {
            $ip = is_string($entry['ip'] ?? null) ? trim($entry['ip']) : '';

            if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
                continue;
            }

            $rows[] = [
                'ip' => $ip,
                'reason' => self::reason($entry['reason'] ?? null) ?: null,
                'source' => self::reason($entry['source'] ?? null, 40) ?: null,
            ];
        }

        return array_slice($rows, 0, self::MAX_ROWS);
    }

    /* ---------------------------------------------------------- commands -- */

    /**
     * Send one command, built from parts that were checked first.
     *
     * The name is validated and the reason cleaned in here rather than at the
     * call sites, so that a future caller cannot reach the console by
     * forgetting to. An unknown verb is refused for the same reason: the list
     * is what this feature is allowed to do, not a hint.
     */
    public static function send(Server $server, string $verb, string $name, string $reason = ''): bool
    {
        try {
            $safe = self::name($name);

            if ($safe === null || !in_array($verb, self::VERBS, true)) {
                return false;
            }

            $server->send(trim($verb . ' ' . $safe . ' ' . self::reason($reason)));

            return true;
        } catch (Throwable) {
            return false;
        }
    }
}
