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

        if (array_key_exists($userId, self::$held)) {
            return self::$held[$userId];
        }

        try {
            $disk = Storage::disk('local');
            $path = self::path($userId);

            if (!$disk->exists($path)) {
                return self::$held[$userId] = [];
            }

            $decoded = json_decode((string) $disk->get($path), true);

            return self::$held[$userId] = self::clean(is_array($decoded) ? $decoded : []);
        } catch (Throwable) {
            // Unreadable storage is a person with nothing starred, not a server
            // list that will not draw.
            return self::$held[$userId] = [];
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

        try {
            $written = Storage::disk('local')->put(
                self::path($userId),
                (string) json_encode(array_values($ids)),
            ) !== false;
        } catch (Throwable) {
            $written = false;
        }

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
