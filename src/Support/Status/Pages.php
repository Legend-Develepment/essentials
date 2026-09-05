<?php

namespace LegendDevelopment\Theme\Support\Status;

use App\Models\Server;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A status page of somebody's own, at /status/their-slug.
 *
 * The panel-wide page belongs to whoever runs the panel. This is the other
 * half: a person with four servers wants one address to give their own players,
 * showing their four and nothing else - and they should not have to ask an
 * administrator every time they add one.
 *
 * Three decisions, and each of them narrows what a user can do rather than what
 * they can see:
 *
 *  1. **Their own servers only.** Not accessibleServers() - `owner_id` is theirs.
 *     A subuser has been given access to somebody else's machine; that is not
 *     the same as being given the right to publish that it exists, under a name
 *     they choose, to the internet.
 *  2. **No monitors.** Status\Monitors makes the panel fetch an address, and a
 *     user who could add one would have a probe pointed wherever they like with
 *     the answer shown on a page. See the note there. Monitors are the
 *     administrator's page only.
 *  3. **No nodes.** Which machine a server sits on, how full its disk is and
 *     whether it is in maintenance is the panel's business and not a tenant's.
 *
 * The slug index is a second file, and it is worth saying why rather than
 * scanning. Resolving /status/bryan by reading every user's file is a directory
 * listing plus one read per user on a route with no login in front of it. A
 * lookup table is one read, and it can be rebuilt from the files if it is ever
 * lost - so it is a cache with a rebuild, not a second source of truth.
 */
class Pages
{
    private const DIRECTORY = 'legend-theme/status/pages';

    private const INDEX = 'legend-theme/status/slugs.json';

    /** As many as a person could sensibly put on one page. */
    public const MAX_SERVERS = 25;

    /**
     * Slugs nothing may claim.
     *
     * Not a security boundary - the route is /status/{slug} and none of these
     * would collide with a real route. It is about somebody publishing a page
     * at /status/admin and it reading, to a visitor, as though the panel put it
     * there.
     */
    private const RESERVED = [
        'admin', 'api', 'app', 'server', 'servers', 'status', 'panel', 'login',
        'auth', 'account', 'system', 'node', 'nodes', 'health', 'up', 'down',
    ];

    public static function enabled(): bool
    {
        try {
            return Features::enabled(Features::PUBLIC_STATUS)
                && (bool) Theme::config('status_user_pages', false);
        } catch (Throwable) {
            return false;
        }
    }

    /* ------------------------------------------------------------- slugs -- */

    /**
     * A slug, or null.
     *
     * Lowercase letters, digits and hyphens. Deliberately narrow: it goes into
     * a URL, it is chosen by a user, and every character allowed is a character
     * somebody has to think about later.
     */
    public static function slug(mixed $value): ?string
    {
        $slug = is_string($value) ? strtolower(trim($value)) : '';

        if (preg_match('/^[a-z0-9](?:[a-z0-9-]{1,30}[a-z0-9])?$/D', $slug) !== 1) {
            return null;
        }

        return in_array($slug, self::RESERVED, true) ? null : $slug;
    }

    /**
     * Whose page this slug is, or null.
     *
     * @return int|null  the user id
     */
    public static function owner(string $slug): ?int
    {
        $slug = self::slug($slug);

        if ($slug === null) {
            return null;
        }

        $id = self::index()[$slug] ?? null;

        return is_int($id) && $id > 0 ? $id : null;
    }

    /** @var array<string, int>|null */
    private static ?array $index = null;

    /**
     * @return array<string, int>
     */
    private static function index(): array
    {
        if (self::$index !== null) {
            return self::$index;
        }

        self::$index = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::INDEX)) {
                return self::$index;
            }

            $decoded = json_decode((string) $disk->get(self::INDEX), true);

            if (!is_array($decoded)) {
                return self::$index;
            }

            foreach ($decoded as $slug => $id) {
                if (is_string($slug) && self::slug($slug) !== null && is_int($id) && $id > 0) {
                    self::$index[$slug] = $id;
                }
            }
        } catch (Throwable) {
            // No index is no user pages, which is a 404 rather than a 500.
        }

        return self::$index;
    }

    /**
     * Whether a slug is free for this person to take.
     *
     * Their own is free to them - saving a page without changing the slug must
     * not report it as taken by themselves.
     */
    public static function available(string $slug, int $userId): bool
    {
        $slug = self::slug($slug);

        if ($slug === null) {
            return false;
        }

        $held = self::index()[$slug] ?? null;

        return $held === null || $held === $userId;
    }

    /* -------------------------------------------------------------- pages -- */

    /**
     * One person's page, as they set it up.
     *
     * @return array{slug: string, title: string, note: string, servers: array<int, array{id: int, name: string}>}
     */
    public static function of(int $userId): array
    {
        $blank = ['slug' => '', 'title' => '', 'note' => '', 'accent' => '', 'mode' => 'dark', 'servers' => []];

        try {
            $disk = Storage::disk('local');
            $path = self::DIRECTORY . '/' . $userId . '.json';

            if (!$disk->exists($path)) {
                return $blank;
            }

            $decoded = json_decode((string) $disk->get($path), true);

            if (!is_array($decoded)) {
                return $blank;
            }

            return [
                'slug' => (string) (self::slug($decoded['slug'] ?? null) ?? ''),
                'title' => self::line($decoded['title'] ?? null, 60),
                'note' => self::line($decoded['note'] ?? null, 300),
                'accent' => self::line($decoded['accent'] ?? null, 32),
                'mode' => in_array($decoded['mode'] ?? null, ['dark', 'light', 'auto'], true)
                    ? (string) $decoded['mode']
                    : 'dark',
                'servers' => self::servers($decoded['servers'] ?? [], $userId),
            ];
        } catch (Throwable) {
            return $blank;
        }
    }

    /**
     * Save one person's page.
     *
     * @param  array<string, mixed>  $data
     * @return string|null  null on success, otherwise why not
     */
    public static function put(int $userId, array $data): ?string
    {
        $slug = self::slug($data['slug'] ?? null);

        if ($slug === null) {
            return 'slug';
        }

        if (!self::available($slug, $userId)) {
            return 'taken';
        }

        $page = [
            'slug' => $slug,
            'title' => self::line($data['title'] ?? null, 60),
            'note' => self::line($data['note'] ?? null, 300),
            /*
             * Kept as typed and sanitised when it is used.
             *
             * Publish::style() runs it through Palette::sanitize() before it
             * reaches a stylesheet, and an empty value there means "follow the
             * panel" - so storing a sanitised default here would take away the
             * ability to say "whatever the panel uses".
             */
            'accent' => self::line($data['accent'] ?? null, 32),
            'mode' => in_array($data['mode'] ?? null, ['dark', 'light', 'auto'], true)
                ? (string) $data['mode']
                : 'dark',
            'servers' => self::servers($data['servers'] ?? [], $userId),
        ];

        try {
            $written = Storage::disk('local')->put(
                self::DIRECTORY . '/' . $userId . '.json',
                (string) json_encode($page, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ) !== false;
        } catch (Throwable) {
            $written = false;
        }

        if (!$written) {
            return 'unwritable';
        }

        return self::reindex($userId, $slug) ? null : 'unwritable';
    }

    /** Take a page down, and free its slug. */
    public static function forget(int $userId): bool
    {
        try {
            $disk = Storage::disk('local');
            $path = self::DIRECTORY . '/' . $userId . '.json';

            if ($disk->exists($path)) {
                $disk->delete($path);
            }
        } catch (Throwable) {
            return false;
        }

        return self::reindex($userId, null);
    }

    /**
     * Point the index at this person's new slug, and drop their old one.
     *
     * Read, change, write - the whole index each time. It is a few dozen short
     * strings, and the alternative is two files that can disagree about who owns
     * what, on a route anybody can call.
     */
    private static function reindex(int $userId, ?string $slug): bool
    {
        $index = self::index();

        foreach ($index as $held => $owner) {
            if ($owner === $userId) {
                unset($index[$held]);
            }
        }

        if ($slug !== null) {
            $index[$slug] = $userId;
        }

        try {
            $written = Storage::disk('local')->put(
                self::INDEX,
                (string) json_encode($index, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            ) !== false;
        } catch (Throwable) {
            return false;
        }

        if ($written) {
            self::$index = $index;
        }

        return $written;
    }

    /* -------------------------------------------------------------- parts -- */

    /**
     * The servers on a page, held to ones this person owns.
     *
     * Checked here rather than only when the page is saved, and that is the
     * point of putting it here: access changes. A server sold, given away or
     * deleted must stop appearing on the page it was published to, without
     * anybody remembering to take it off.
     *
     * @param  array<int, mixed>  $rows
     * @return array<int, array{id: int, name: string}>
     */
    private static function servers(array $rows, int $userId): array
    {
        $wanted = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $id = (int) ($row['id'] ?? 0);
            $name = self::line($row['name'] ?? null, 60);

            if ($id > 0 && $name !== '') {
                $wanted[$id] = $name;
            }
        }

        if ($wanted === []) {
            return [];
        }

        try {
            $mine = Server::query()
                ->whereIn('id', array_keys($wanted))
                ->where('owner_id', $userId)
                ->pluck('id')
                ->all();
        } catch (Throwable) {
            return [];
        }

        $out = [];

        foreach ($mine as $id) {
            $out[] = ['id' => (int) $id, 'name' => $wanted[(int) $id]];
        }

        return array_slice($out, 0, self::MAX_SERVERS);
    }

    /** One line of plain text, cut to length. */
    private static function line(mixed $value, int $max): string
    {
        $text = is_string($value) ? trim($value) : '';
        $text = trim(preg_replace('/[[:cntrl:]]+/u', ' ', $text) ?? '');
        $text = trim(preg_replace('/\s+/u', ' ', $text) ?? '');

        return mb_substr($text, 0, $max);
    }
}
