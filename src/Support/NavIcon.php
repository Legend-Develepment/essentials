<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Throwable;

/**
 * Your own picture on the Essentials settings row, instead of the tabler icon.
 *
 * Filament accepts an Htmlable where it expects an icon name, so this hands back
 * an <img> and the rest of the row draws exactly as it did.
 *
 * An <img> and never inline SVG, and that is the whole security question here.
 * SVG is a document format: it can carry <script>, event handlers and external
 * references, and an SVG pasted straight into the page runs all of it with the
 * panel's own origin. Inside an <img> none of that executes - browsers refuse
 * scripting in an image context - so the file can be exactly what somebody
 * uploaded and still be inert. The alternative would be sanitising SVG by hand,
 * which is a thing people get wrong for years at a time.
 *
 * The trade is that an <img> cannot take its colour from the surrounding text
 * the way a tabler icon does, so a logo appears in its own colours. For a brand
 * mark that is usually the point.
 */
class NavIcon
{
    /** What Filament draws when nothing has been uploaded. */
    public const FALLBACK = 'tabler-adjustments';

    /**
     * The three the settings form accepts.
     *
     * PNG for a logo with transparency, SVG because it stays sharp at any size,
     * ICO because that is what a lot of people already have lying about from a
     * favicon. No JPEG on purpose: a navigation icon is twenty pixels of mostly
     * transparent brand mark, and JPEG has no transparency and blurs exactly the
     * kind of hard edge a logo is made of.
     */
    public const TYPES = ['png', 'svg', 'ico'];

    /** @var array<int, string> */
    public const MIMES = ['image/png', 'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon'];

    private static ?string $url = null;

    private static bool $looked = false;

    /**
     * Where the uploaded file is, or null.
     *
     * Held for the request: this is asked once per page for every one of the
     * plugin's admin rows, and it is a config read plus a disk URL each time.
     */
    public static function url(): ?string
    {
        if (self::$looked) {
            return self::$url;
        }

        self::$looked = true;

        try {
            $path = trim((string) Theme::config('nav_icon', ''));

            if ($path === '') {
                return self::$url = null;
            }

            $url = Storage::disk('public')->url($path);

            return self::$url = is_string($url) && $url !== '' ? $url : null;
        } catch (Throwable) {
            // A disk that will not answer is a row with its normal icon, not a
            // panel that will not draw its sidebar.
            return self::$url = null;
        }
    }

    /**
     * What to give Filament for $navigationIcon.
     *
     * The tabler name when nothing is uploaded, so the row is untouched until
     * somebody chooses otherwise.
     */
    public static function icon(): string|HtmlString
    {
        $url = self::url();

        if ($url === null) {
            return self::FALLBACK;
        }

        /*
         * Sized in em rather than pixels so it matches whatever the row's text
         * is set to - the plugin's own lettering setting changes that - and
         * given an empty alt because the label is right beside it. A repeated
         * name is noise to a screen reader, not help.
         */
        return new HtmlString(
            '<img src="' . e($url) . '" alt="" class="ld-nav-icon" width="20" height="20">',
        );
    }

    /** Called when the setting is saved, since the page redraws in the same request. */
    public static function forget(): void
    {
        self::$looked = false;
        self::$url = null;
    }
}
