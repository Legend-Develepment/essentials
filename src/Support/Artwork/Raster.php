<?php

namespace LegendDevelopment\Theme\Support\Artwork;

use LegendDevelopment\Theme\Vendor\Svg\SVG;
use Throwable;

/**
 * A picture Pelican cannot keep as an egg's, made into one it can.
 *
 * Pelican stores an egg's picture as PNG, JPEG or WebP and nothing else. What
 * arrives is sometimes something else: a few of the artwork library's logos
 * are SVG drawings, and GIF and BMP turn up in uploads. Refusing those left an
 * egg without a picture for a reason nobody could do anything about, so they
 * are drawn as WebP instead, with GD, which every panel has.
 *
 * An SVG is drawn by the copy of php-svg under Vendor\Svg, which never reads
 * a file or an address a drawing names. See its README.
 *
 * Only ever the picture that is written, never the drawing: an SVG kept as an
 * egg's icon would be a document with scripts in it, served from the panel's
 * own address, and a WebP is only pixels.
 */
final class Raster
{
    /** The long side of a drawing once it is a picture, in pixels. */
    private const SIDE = 512;

    /** A drawing larger than this is not a logo, and drawing it is not free. */
    private const MAX_SVG_BYTES = 1048576;

    /**
     * The most pixels a picture may have before it is decoded.
     *
     * Four megabytes of GIF can describe a picture tens of thousands of pixels
     * wide, and GD holds every pixel as four bytes: past PHP's memory limit
     * that is a fatal error, which no catch here would see. Four thousand
     * pixels square is far past any icon.
     */
    private const MAX_PIXELS = 16777216;

    private const QUALITY = 90;

    /**
     * WebP bytes for a picture that is not PNG, JPEG or WebP, or null when it
     * cannot be made into one.
     *
     * Null without imagewebp as well. GD built without WebP is rare but real,
     * and on such a panel the picture is refused as a format Pelican does not
     * keep, which is what happened to all of these before.
     */
    public static function webp(string $body): ?string
    {
        if (!function_exists('imagewebp')) {
            return null;
        }

        try {
            $image = self::isSvg($body) ? self::draw($body) : self::decode($body);

            if ($image === null || $image === false) {
                return null;
            }

            // A palette picture - most GIFs - has to become true colour before
            // WebP will take it, and the transparency has to come along.
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);

            ob_start();
            $written = imagewebp($image, null, self::QUALITY);
            $bytes = (string) ob_get_clean();
        } catch (Throwable) {
            return null;
        }

        return $written && $bytes !== '' ? $bytes : null;
    }

    /** Whether the bytes are an SVG drawing rather than a picture. */
    public static function isSvg(string $body): bool
    {
        return preg_match('/<svg[\s>]/i', substr($body, 0, 4096)) === 1;
    }

    /**
     * A picture GD can read, or null, and never one too large to hold.
     *
     * @return \GdImage|false|null
     */
    private static function decode(string $body): mixed
    {
        $size = @getimagesizefromstring($body);

        if (!is_array($size) || (int) $size[0] * (int) $size[1] > self::MAX_PIXELS) {
            return null;
        }

        return @imagecreatefromstring($body);
    }

    /**
     * The drawing at SIDE pixels on its long side, in its own proportions.
     *
     * @return \GdImage|null
     */
    private static function draw(string $body): mixed
    {
        if (strlen($body) > self::MAX_SVG_BYTES) {
            return null;
        }

        $svg = SVG::fromString($body);

        if ($svg === null) {
            return null;
        }

        [$width, $height] = self::proportions($svg);
        $scale = self::SIDE / max($width, $height);

        return $svg->toRasterImage(max(1, (int) round($width * $scale)), max(1, (int) round($height * $scale)));
    }

    /**
     * Width and height as the drawing means them: its viewBox, which is what
     * a logo exported from a design tool always has, else its width and height,
     * else square. A width written as 100% says nothing about the shape.
     *
     * @return array{0: float, 1: float}
     */
    private static function proportions(SVG $svg): array
    {
        $document = $svg->getDocument();
        $box = $document->getViewBox();

        if (is_array($box) && (float) ($box[2] ?? 0) > 0 && (float) ($box[3] ?? 0) > 0) {
            return [(float) $box[2], (float) $box[3]];
        }

        $width = (string) $document->getWidth();
        $height = (string) $document->getHeight();

        if (!str_ends_with($width, '%') && !str_ends_with($height, '%') && (float) $width > 0 && (float) $height > 0) {
            return [(float) $width, (float) $height];
        }

        return [1.0, 1.0];
    }
}
