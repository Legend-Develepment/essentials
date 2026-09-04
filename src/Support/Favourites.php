<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Which servers a person has starred, kept on the panel rather than in their
 * browser.
 *
 * This reverses the original design, and the reason it was written the other
 * way is worth keeping rather than deleting. Stars began in localStorage
 * because that meant no table, no migration, no permission to hand out and
 * nothing on the server that could fail - which server somebody looks at most
 * is theirs, and none of it needed to reach the panel.
 *
 * What that argument missed is that it is theirs *everywhere*. Somebody who
 * stars four servers at work and then opens the panel on their phone finds
 * nothing starred, and from the front that is indistinguishable from the
 * feature being broken. A preference that only exists on one machine is not
 * really a preference, it is a bookmark.
 *
 * So it moves, and it moves to the same place the page arranger keeps its
 * per-person layouts: a file per user under storage. No migration, which is
 * what would otherwise make this the first thing in the plugin that a panel
 * has to run something to install, and no new table for a list of short
 * strings.
 *
 * The privacy claim changes with it and the settings page says so. This is now
 * something the panel knows and an administrator with file access can read. It
 * is still nobody else's business, and nothing here exposes one person's list
 * to another.
 */
class Favourites
{
    private const DIRECTORY = 'legend-theme/favourites';

    /**
     * A cap, and a low one on purpose.
     *
     * A hundred starred servers is not a shortlist, it is the server list
     * again. The old browser-side version stopped at two hundred; this is
     * smaller because it now costs a write on somebody else's disk.
     */
    public const MAX = 100;

    /** @var array<int, array<int, string>> */
    private static array $held = [];

    /** @var array<int, array<int, array{path: string, label: string}>> */
    private static array $pages = [];

    /**
     * The pages this person has starred.
     *
     * Kept beside the servers rather than mixed in with them, because they are
     * not the same kind of thing and pretending otherwise costs more than it
     * saves. A server is an id the panel already knows how to name; a page is
     * an address and a label that has to be stored with it, because nothing
     * here can work out what /admin/essentials-languages is called without
     * being told - not in the reader's language, and not at all once the page
     * it points at belongs to a panel this request is not in.
     *
     * @return array<int, array{path: string, label: string}>
     */
    public static function pages(?int $userId = null): array
    {
        $userId ??= self::currentUser();

        if ($userId === null) {
            return [];
        }

        if (!array_key_exists($userId, self::$pages)) {
            self::read($userId);
        }

        return self::$pages[$userId] ?? [];
    }

    /**
     * Replace the starred pages for this person.
     *
     * @param  array<int, mixed>  $pages
     */
    public static function putPages(array $pages, ?int $userId = null): bool
    {
        $userId ??= self::currentUser();

        if ($userId === null) {
            return false;
        }

        $clean = self::cleanPages($pages);

        // The servers are read before the write rather than after it, because
        // write() rewrites the whole file - reading afterwards would read back
        // what it had just flattened.
        if (!self::write($userId, self::for($userId), $clean)) {
            return false;
        }

        self::$pages[$userId] = $clean;

        return true;
    }

    /**
     * What this person has starred.
     *
     * @return array<int, string>
     */
    public static function for(?int $userId = null): array
    {
        $userId ??= self::currentUser();

        if ($userId === null) {
            return [];
        }

        if (!array_key_exists($userId, self::$held)) {
            self::read($userId);
        }

        return self::$held[$userId] ?? [];
    }

    /**
     * One file, both lists.
     *
     * The file used to be an array of server ids and is now an object with two
     * keys. An array is still read as the old shape, and that compatibility
     * costs one array_is_list: somebody who starred four servers last week
     * should not lose them to a release, and there is no migration here to put
     * them back afterwards.
     */
    private static function read(int $userId): void
    {
        self::$held[$userId] = [];
        self::$pages[$userId] = [];

        try {
            $disk = Storage::disk('local');
            $path = self::path($userId);

            if (!$disk->exists($path)) {
                return;
            }

            $decoded = json_decode((string) $disk->get($path), true);

            if (!is_array($decoded)) {
                return;
            }

            if (array_is_list($decoded)) {
                self::$held[$userId] = self::clean($decoded);

                return;
            }

            self::$held[$userId] = self::clean(is_array($decoded['servers'] ?? null) ? $decoded['servers'] : []);
            self::$pages[$userId] = self::cleanPages(is_array($decoded['pages'] ?? null) ? $decoded['pages'] : []);
        } catch (Throwable) {
            // Unreadable storage is a person with nothing starred, not a page
            // that will not draw. Both lists are already empty.
        }
    }

    /**
     * Both lists to the file, or neither.
     *
     * Storage::put() answers false for the ordinary failures - an unwritable
     * directory, a full disk - and throws only for the rarer ones, so a caller
     * that only caught Throwable would report success for the common way this
     * goes wrong.
     *
     * @param  array<int, string>  $servers
     * @param  array<int, array{path: string, label: string}>  $pages
     */
    private static function write(int $userId, array $servers, array $pages): bool
    {
        try {
            return Storage::disk('local')->put(
                self::path($userId),
                (string) json_encode([
                    'servers' => array_values($servers),
                    'pages' => array_values($pages),
                ]),
            ) !== false;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Replace the whole list for this person.
     *
     * The whole list rather than one id at a time, because the browser already
     * holds the list it is drawing and sending it entire makes the two agree
     * after every save - a toggle endpoint would have to be right about the
     * order two clicks arrived in.
     *
     * Returns whether it reached the disk. Storage::put() answers false for the
     * ordinary failures - an unwritable directory, a full disk - and throws only
     * for the rarer ones, so a caller that only caught Throwable would report
     * success for the common way this goes wrong.
     *
     * @param  array<int, mixed>  $ids
     */
    public static function put(array $ids, ?int $userId = null): bool
    {
        $userId ??= self::currentUser();

        if ($userId === null) {
            return false;
        }

        $ids = self::clean($ids);

        // The pages are read before the write, for the same reason putPages()
        // reads the servers first: this rewrites the whole file.
        $written = self::write($userId, $ids, self::pages($userId));

        // Only when the disk agreed. A memo filled in before the write is a
        // promise the disk did not make.
        if ($written) {
            self::$held[$userId] = $ids;
        }

        return $written;
    }

    /**
     * Server ids, and nothing that is not one.
     *
     * These come from the browser and are written to a file, so they are held
     * to the shape Pelican's own short ids have - hex and hyphens, short. The
     * list is a set: starring twice is starring once.
     *
     * @param  array<int, mixed>  $ids
     * @return array<int, string>
     */
    private static function clean(array $ids): array
    {
        $out = [];

        foreach ($ids as $id) {
            if (!is_string($id) || preg_match('/^[A-Za-z0-9-]{4,64}$/D', $id) !== 1) {
                continue;
            }

            $out[$id] = $id;
        }

        return array_slice(array_values($out), 0, self::MAX);
    }

    /**
     * Pages, and nothing that is not one.
     *
     * The address is held to a path inside this panel, and that is the point
     * rather than a formality: it arrives from a browser and goes back out as
     * something somebody clicks, so accepting an absolute one would be this
     * plugin storing, per user, somewhere else to send them. No scheme, no
     * host, no traversal, no query and no fragment - a path this panel serves.
     *
     * The label is free text and is cleaned rather than refused. People name
     * things, and a page starred with an awkward name should keep the name.
     *
     * @param  array<int, mixed>  $pages
     * @return array<int, array{path: string, label: string}>
     */
    private static function cleanPages(array $pages): array
    {
        $out = [];

        foreach ($pages as $page) {
            if (!is_array($page)) {
                continue;
            }

            $path = is_string($page['path'] ?? null) ? trim($page['path']) : '';
            $label = is_string($page['label'] ?? null) ? trim($page['label']) : '';

            if (preg_match('#^/[A-Za-z0-9/_-]{0,190}$#D', $path) !== 1 || str_contains($path, '..')) {
                continue;
            }

            $label = preg_replace('/[[:cntrl:]]+/u', ' ', $label) ?? '';
            $label = trim(preg_replace('/\s+/u', ' ', $label) ?? '');

            if ($label === '') {
                continue;
            }

            // Keyed by path, so starring the same page twice is starring it
            // once - the same set rule the server ids follow.
            $out[$path] = ['path' => $path, 'label' => mb_substr($label, 0, 80)];
        }

        return array_slice(array_values($out), 0, self::MAX);
    }

    private static function path(int $userId): string
    {
        return self::DIRECTORY . '/' . $userId . '.json';
    }

    private static function currentUser(): ?int
    {
        try {
            $id = user()?->id;

            return is_int($id) ? $id : null;
        } catch (Throwable) {
            return null;
        }
    }
}
