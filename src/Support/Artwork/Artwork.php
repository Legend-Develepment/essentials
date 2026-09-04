<?php

namespace LegendDevelopment\Theme\Support\Artwork;

use App\Models\Egg;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Game artwork for eggs, and the two facts the panel has to remember about it.
 *
 * A fresh Pelican shows the same grey bird on every server card. The artwork
 * exists - it is on Steam, and for anything not on Steam it is on IGDB - and
 * fetching it is a solved problem, so this fetches it.
 *
 * Two things have to be remembered per egg, and neither has a column:
 *
 *  - **Which Steam game this egg is.** Searching by name works often enough to
 *    be worth offering and not often enough to trust: "Rust" is a game and a
 *    programming language, and half the eggs on a real panel are named after
 *    the person who wrote them. So once somebody has said which game it is,
 *    that is kept.
 *  - **Whether a picture was chosen by hand.** Anything set deliberately must
 *    survive a bulk fetch, or the feature becomes a thing you dare not run
 *    twice.
 *
 * Both live in the egg's own `tags`, which is Pelican's array column and needs
 * no migration. That is a real trade and worth naming: tags are visible in
 * Pelican's own egg editor, so an administrator will see `steam:892970` sitting
 * there and can delete it. Losing it costs one search. A migration to store it
 * privately would cost every panel a schema change for the same information, so
 * this is the cheaper way to be wrong.
 */
class Artwork
{
    /** The tag that says "somebody chose this picture; leave it alone". */
    public const PROTECTED = 'icon:protected';

    /** The prefix of the tag holding a Steam application id. */
    public const STEAM = 'steam:';

    /**
     * The most this will write as an egg icon.
     *
     * A Steam header is about forty kilobytes and an IGDB cover about a hundred.
     * Four megabytes is far past anything either has ever served, which is the
     * point - it is not a tuning knob, it is a refusal to write something that
     * is clearly not an icon.
     *
     * Checked after the download rather than during it. Guzzle has no body cap,
     * and the alternative is streaming machinery around two fixed, well-known
     * hosts; measuring what arrived is the honest version of the same guard.
     */
    public const MAX_BYTES = 4194304;

    /**
     * A picture, written to the egg, or a reason it was not.
     *
     * The bytes are checked before anything reaches the disk, and that is not
     * ceremony. A CDN that answers 200 with an HTML error page is ordinary, and
     * the version of this that trusted the status code wrote that page to
     * storage as `<uuid>.jpg` - so the egg had an icon, the panel drew a broken
     * image, and nothing anywhere said why.
     *
     * getimagesizefromstring() answers with the real type rather than the one
     * the URL claimed, which is also what decides the extension.
     */
    public static function store(Egg $egg, string $body): ?string
    {
        if ($body === '') {
            return 'empty';
        }

        if (strlen($body) > self::MAX_BYTES) {
            return 'large';
        }

        $size = @getimagesizefromstring($body);

        if ($size === false) {
            return 'not_an_image';
        }

        $extension = match ($size[2] ?? null) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_WEBP => 'webp',
            // Pelican stores three formats. A GIF or a BMP from a CDN is real
            // and is not one of them, and converting it would mean this plugin
            // deciding to depend on an image library.
            default => null,
        };

        if ($extension === null) {
            return 'wrong_format';
        }

        try {
            $egg->writeIcon($extension, $body);
        } catch (Throwable) {
            // writeIcon throws when the disk refuses. Reported as a failure
            // rather than swallowed: a bulk run that quietly wrote nothing for
            // two hundred eggs is worse than one that stops and says so.
            return 'unwritable';
        }

        return null;
    }

    public static function hasImage(Egg $egg): bool
    {
        try {
            return $egg->icon !== null;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Everything this feature wrote, taken back off.
     *
     * The Steam id goes with the picture. Keeping it would mean an egg with no
     * artwork still claiming to be a particular game, and the next fetch would
     * silently use an association somebody thought they had cleared.
     */
    public static function clear(Egg $egg): bool
    {
        $cleared = false;

        try {
            $disk = Storage::disk('public');

            foreach (array_keys(Egg::$iconFormats) as $extension) {
                $path = Egg::getIconStoragePath() . '/' . $egg->uuid . '.' . $extension;

                if ($disk->exists($path)) {
                    $disk->delete($path);
                    $cleared = true;
                }
            }
        } catch (Throwable) {
            return false;
        }

        self::write($egg, static fn (string $tag): bool => $tag !== self::PROTECTED
            && !str_starts_with($tag, self::STEAM));

        return $cleared;
    }

    /* ------------------------------------------------------------- tags -- */

    public static function steamAppId(Egg $egg): ?int
    {
        foreach (self::tags($egg) as $tag) {
            if (str_starts_with($tag, self::STEAM)) {
                $id = (int) substr($tag, strlen(self::STEAM));

                return $id > 0 ? $id : null;
            }
        }

        return null;
    }

    public static function setSteamAppId(Egg $egg, int $appId): void
    {
        if ($appId <= 0) {
            return;
        }

        self::write(
            $egg,
            static fn (string $tag): bool => !str_starts_with($tag, self::STEAM),
            self::STEAM . $appId,
        );
    }

    public static function isProtected(Egg $egg): bool
    {
        return in_array(self::PROTECTED, self::tags($egg), true);
    }

    public static function protect(Egg $egg): void
    {
        if (!self::isProtected($egg)) {
            self::write($egg, static fn (): bool => true, self::PROTECTED);
        }
    }

    public static function unprotect(Egg $egg): void
    {
        self::write($egg, static fn (string $tag): bool => $tag !== self::PROTECTED);
    }

    /**
     * The egg's tags, as strings and nothing else.
     *
     * The column is cast to an array and holds whatever has ever been put in
     * it, so a non-string in there would otherwise reach str_starts_with() and
     * throw on a page that is only trying to draw a table.
     *
     * @return array<int, string>
     */
    private static function tags(Egg $egg): array
    {
        try {
            $tags = $egg->tags;
        } catch (Throwable) {
            return [];
        }

        return is_array($tags) ? array_values(array_filter($tags, 'is_string')) : [];
    }

    /**
     * One read, one filter, one save.
     *
     * Every tag change went through its own copy of this and each copy was
     * subtly its own: one used array_filter without array_values and left a
     * gapped array for json_encode to turn into an object, one saved even when
     * nothing had changed. Doing it once means the JSON column always holds a
     * list, and a save that changes nothing does not happen.
     *
     * @param  callable(string): bool  $keep
     */
    private static function write(Egg $egg, callable $keep, ?string $add = null): void
    {
        $before = self::tags($egg);
        $after = array_values(array_filter($before, $keep));

        if ($add !== null) {
            $after[] = $add;
        }

        if ($after === $before) {
            return;
        }

        try {
            $egg->tags = $after;
            $egg->save();
        } catch (Throwable) {
            // An egg that will not save is a row that keeps the picture it has.
        }
    }
}
