<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * A picture, made no bigger than it is ever drawn.
 *
 * This exists because of one file. The sidebar icon on the panel it was written
 * for is a 1200 by 1200 PNG wearing an SVG costume: 3.5 MB, and still 2.6 MB
 * gzipped, because base64 adds a third to something that was already
 * compressed. It is drawn at twenty pixels, on every page, for every visitor.
 * Nothing on the settings page said any of that, and nothing would have.
 *
 * **It resizes and it never converts.** A PNG stays a PNG. The saving worth
 * having is the one from 1200 pixels to 256, which is about ninety-five per
 * cent; turning it into a WebP afterwards would be a few kilobytes more and
 * would mean four places that take the extension and the content type from the
 * original file would have to be taught, one of which writes a year of
 * immutable cache onto the answer.
 *
 * **Every refusal ends with the picture untouched.** No GD, an image it cannot
 * read, one large enough to fill memory on decoding, an encoder that threw, a
 * result that did not come out meaningfully smaller: each of those returns null
 * and the bytes that arrived are the bytes that are stored. A settings page that
 * will not save because a logo could not be shrunk is worse than a large logo.
 *
 * **Three kinds of picture are never touched at all**, and each is here because
 * shrinking it would destroy the thing it is good at:
 *
 *  - A vector SVG, which has no pixels to lose and would become a raster.
 *  - Anything that moves. An animated PNG is served as image/png and an
 *    animated WebP as image/webp, and GD reads one frame of either and writes
 *    it back under the same name - a file the panel would then report as
 *    unchanged while serving a still of its first frame.
 *  - A photograph carrying an orientation in its Exif. GD does not read that
 *    tag and the browser does, so re-encoding one silently turns it on its
 *    side. Rotating it here would mean this plugin owning Exif, and leaving it
 *    alone costs nothing that matters: a backdrop that came off a phone is
 *    rare and being sideways is not.
 */
class Pictures
{
    /** The sidebar icon, drawn at twenty pixels and asked for on every page. */
    public const ICON = 256;

    /** A backdrop, drawn across whatever screen it lands on. */
    public const BACKDROP = 1920;

    /**
     * How far above the target a picture has to be before it is worth touching.
     *
     * A gap rather than a line, so a picture somebody exported at three hundred
     * pixels on purpose is stored exactly as it arrived. Re-encoding something
     * that was already the right size costs a little quality and gains nothing
     * anybody can measure, and it is the kind of surprise that makes somebody
     * stop trusting the panel with their files.
     */
    private const OVER = 2;

    /**
     * Past this, nothing is decoded.
     *
     * Dimensions are read out of the header without touching a pixel, and a
     * file that says it is forty megapixels is refused there. The byte caps on
     * the upload fields do not help with this: they bound the compressed size,
     * and a four megabyte PNG can decode to gigabytes.
     */
    private const PIXELS = 40000000;

    /** Worth storing only if it took off this much. */
    private const WORTH = 0.10;

    /**
     * A smaller copy, or null to leave the picture alone.
     *
     * @return array{bytes: string, extension: string, type: string}|null
     */
    public static function smaller(string $bytes, int $edge): ?array
    {
        if ($bytes === '' || $edge < 16) {
            return null;
        }

        try {
            /*
             * An SVG is unwrapped first and then treated as whatever came out
             * of it, so a raster in a costume takes the ordinary road from here
             * and a real vector never gets on it.
             */
            $unwrapped = self::unwrap($bytes);
            $raster = $unwrapped ?? $bytes;

            if ($unwrapped === null && self::looksVector($bytes)) {
                return null;
            }

            $size = @getimagesizefromstring($raster);

            if (!is_array($size) || ($size[0] ?? 0) < 1 || ($size[1] ?? 0) < 1) {
                return null;
            }

            $width = (int) $size[0];
            $height = (int) $size[1];
            $type = (int) ($size[2] ?? 0);

            if ($width * $height > self::PIXELS || self::moves($raster, $type) || self::turned($raster, $type)) {
                return null;
            }

            $long = max($width, $height);

            /*
             * A picture already the right size is still worth unwrapping, and
             * only that. The raster inside is stored as it is rather than
             * re-encoded, so an unwrap on its own is never lossy.
             */
            if ($long <= $edge * self::OVER) {
                return $unwrapped === null ? null : self::answer($raster, $type, strlen($bytes));
            }

            $made = self::resample($raster, $type, $width, $height, $edge);

            if ($made === null) {
                return $unwrapped === null ? null : self::answer($raster, $type, strlen($bytes));
            }

            return self::answer($made, $type, strlen($bytes));
        } catch (Throwable) {
            // Anything at all, and the picture is stored as it arrived.
            return null;
        }
    }

    /**
     * Dress the answer, and refuse one that is not an improvement.
     *
     * @return array{bytes: string, extension: string, type: string}|null
     */
    private static function answer(string $bytes, int $type, int $was): ?array
    {
        $extension = self::extension($type);

        if ($bytes === '' || $extension === null) {
            return null;
        }

        if (strlen($bytes) > (int) ($was * (1 - self::WORTH))) {
            return null;
        }

        return [
            'bytes' => $bytes,
            'extension' => $extension,
            'type' => (string) image_type_to_mime_type($type),
        ];
    }

    /** Smaller pixels, same kind of file. */
    private static function resample(string $bytes, int $type, int $width, int $height, int $edge): ?string
    {
        if (!function_exists('imagecreatefromstring') || self::extension($type) === null) {
            return null;
        }

        $from = @imagecreatefromstring($bytes);

        if ($from === false) {
            return null;
        }

        $scale = $edge / max($width, $height);
        $to = @imagecreatetruecolor(max(1, (int) round($width * $scale)), max(1, (int) round($height * $scale)));

        if ($to === false) {
            imagedestroy($from);

            return null;
        }

        // Transparency survives, which for a logo is the whole picture.
        imagealphablending($to, false);
        imagesavealpha($to, true);

        $ok = @imagecopyresampled(
            $to,
            $from,
            0,
            0,
            0,
            0,
            imagesx($to),
            imagesy($to),
            $width,
            $height,
        );

        imagedestroy($from);

        if (!$ok) {
            imagedestroy($to);

            return null;
        }

        $made = self::encode($to, $type);

        imagedestroy($to);

        return $made === '' ? null : $made;
    }

    /** The bytes GD writes, caught rather than sent anywhere. */
    private static function encode(mixed $image, int $type): string
    {
        ob_start();

        $ok = match ($type) {
            IMAGETYPE_PNG => @imagepng($image, null, 9),
            IMAGETYPE_JPEG => @imagejpeg($image, null, 88),
            IMAGETYPE_WEBP => @imagewebp($image, null, 88),
            default => false,
        };

        $made = (string) ob_get_clean();

        return $ok ? $made : '';
    }

    /** The three this can write. Anything else is left where it is. */
    private static function extension(int $type): ?string
    {
        return match ($type) {
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_WEBP => 'webp',
            default => null,
        };
    }

    /**
     * Whether the file has more than one frame in it.
     *
     * By the chunk that announces the frames rather than by decoding, because
     * GD will happily read one frame of either and hand it back looking like a
     * whole picture. An animated PNG carries acTL before its first IDAT; an
     * animated WebP carries ANIM inside its RIFF container.
     */
    private static function moves(string $bytes, int $type): bool
    {
        if ($type === IMAGETYPE_GIF) {
            return true;
        }

        if ($type === IMAGETYPE_PNG) {
            $at = strpos($bytes, 'acTL');
            $first = strpos($bytes, 'IDAT');

            return $at !== false && ($first === false || $at < $first);
        }

        if ($type === IMAGETYPE_WEBP) {
            return str_contains(substr($bytes, 0, 64), 'ANIM') || str_contains(substr($bytes, 0, 64), 'ANMF');
        }

        return false;
    }

    /**
     * Whether a JPEG is carrying an orientation that only the browser applies.
     *
     * The tag is looked for wherever it is rather than only at the front: a
     * JPEG that leads with JFIF and carries its Exif in a later marker is
     * ordinary, and a test that only reads the first marker would call it
     * unrotated and turn it on its side.
     */
    private static function turned(string $bytes, int $type): bool
    {
        if ($type !== IMAGETYPE_JPEG) {
            return false;
        }

        if (!function_exists('exif_read_data')) {
            // Without the reader there is no way to know, and a picture that
            // might be rotated is one to leave alone.
            return str_contains(substr($bytes, 0, 65536), 'Exif');
        }

        try {
            $exif = @exif_read_data('data://image/jpeg;base64,' . base64_encode($bytes));
        } catch (Throwable) {
            return true;
        }

        return is_array($exif) && (int) ($exif['Orientation'] ?? 1) > 1;
    }

    /** Whether this is an SVG at all. */
    private static function looksVector(string $bytes): bool
    {
        return str_contains(substr($bytes, 0, 1024), '<svg');
    }

    /**
     * The raster out of an SVG that is nothing but a wrapper around one.
     *
     * Deliberately hard to satisfy, because this is the only thing here that
     * cannot be undone. A wrapper that crops with its viewBox, moves its
     * contents with a transform, or paints anything behind them renders
     * differently from the raster on its own - so the test is not "mostly one
     * picture by weight" but "one picture and nothing else": one image element,
     * no attributes on it beyond its size and its data, a viewBox that is the
     * identity, and nothing left over but a title and whitespace.
     *
     * Anything short of that is a drawing, and a drawing is left alone.
     */
    private static function unwrap(string $bytes): ?string
    {
        if (!self::looksVector($bytes) || substr_count($bytes, '<image') !== 1) {
            return null;
        }

        if (preg_match('~<image\b([^>]*)/?>~i', $bytes, $tag) !== 1) {
            return null;
        }

        $attributes = (string) $tag[1];

        // Anything that changes how the picture is placed or painted.
        if (preg_match('~\b(transform|clip-path|mask|opacity|filter|style|x|y)\s*=~i', $attributes) === 1) {
            return null;
        }

        if (preg_match('~\b(?:xlink:)?href\s*=\s*"data:image/[a-z+]+;base64,([^"]+)"~i', $tag[0], $data) !== 1) {
            return null;
        }

        $raster = base64_decode((string) $data[1], true);

        if (!is_string($raster) || $raster === '') {
            return null;
        }

        // The wrapper must be the same size as what it holds, and its viewBox
        // must start at the origin at that size, or it is cropping.
        $box = self::numbers($bytes, 'width') . 'x' . self::numbers($bytes, 'height');
        $inner = self::numbers($attributes, 'width') . 'x' . self::numbers($attributes, 'height');

        if ($box !== $inner || $box === 'x') {
            return null;
        }

        /*
         * A viewBox that is there at all has to be the identity.
         *
         * Written the other way round first, and it let exactly the case it
         * was for straight through: a box of "200 200 800 800" did not match
         * the pattern, so the test never fired and the crop was thrown away
         * along with the wrapper. A guard that only looks at the shapes it
         * recognises passes everything it does not.
         */
        if (str_contains($bytes, 'viewBox')) {
            if (preg_match('~viewBox\s*=\s*"\s*0[ ,]+0[ ,]+([0-9.]+)[ ,]+([0-9.]+)\s*"~i', $bytes, $view) !== 1) {
                return null;
            }

            if (((string) (int) (float) $view[1] . 'x' . (string) (int) (float) $view[2]) !== $box) {
                return null;
            }
        }

        // And nothing else in it but the wrapper, a name for it, and space.
        $rest = preg_replace(
            [
                '~<\?xml[^>]*\?>~i',
                '~<!--.*?-->~s',
                '~<!DOCTYPE[^>]*>~i',
                '~<svg\b[^>]*>~i',
                '~</svg\s*>~i',
                '~<title\b[^>]*>.*?</title\s*>~is',
                '~<desc\b[^>]*>.*?</desc\s*>~is',
                '~<metadata\b[^>]*>.*?</metadata\s*>~is',
                '~<image\b[^>]*/?>~i',
                '~</image\s*>~i',
            ],
            '',
            $bytes,
        );

        return trim((string) $rest) === '' ? $raster : null;
    }

    /** One numeric attribute, as a whole number, or the empty string. */
    private static function numbers(string $haystack, string $name): string
    {
        if (preg_match('~\b' . preg_quote($name, '~') . '\s*=\s*"\s*([0-9.]+)\s*(?:px)?\s*"~i', $haystack, $found) !== 1) {
            return '';
        }

        return (string) (int) (float) $found[1];
    }
}
