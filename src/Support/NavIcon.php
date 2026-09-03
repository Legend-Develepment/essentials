<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Throwable;

/**
 * The picture on the Essentials settings row.
 *
 * Three answers, in order: a file somebody uploaded, then the logo this plugin
 * ships with, then the tabler icon it used to have. Each step is a fallback for
 * the one before it failing rather than a setting, so there is no arrangement
 * in which the row has no icon at all.
 *
 * An <img> and never inline SVG, and that is the whole security question here.
 * SVG is a document format: it can carry <script>, event handlers and external
 * references, and pasted straight into the page it runs all of them with the
 * panel's own origin. Inside an <img> a browser refuses to script an image, so
 * an uploaded file can be exactly what arrived and still be inert - and nobody
 * has to maintain an SVG sanitiser, which is a thing people get wrong for years
 * at a time.
 *
 * The trade is that an <img> cannot take its colour from the text around it the
 * way a tabler icon does, so a logo appears in its own colours. For a brand mark
 * that is the point rather than a loss.
 *
 * Served from the public disk rather than inlined as a data URI. The sidebar is
 * on every page of the panel, and the logo is nine kilobytes - which as base64
 * would be twelve, on every single page load, compressing badly because it is
 * already a compressed image. As a file the browser fetches it once.
 */
class NavIcon
{
    /** What Filament draws if neither picture can be reached. */
    public const FALLBACK = 'tabler-adjustments';

    /**
     * The three the settings form accepts.
     *
     * PNG for a logo with transparency, SVG because it stays sharp at any size,
     * ICO because that is what a lot of people already have from a favicon. No
     * JPEG on purpose: a navigation icon is twenty pixels of mostly transparent
     * brand mark, and JPEG has neither transparency nor a kind edge.
     */
    public const TYPES = ['png', 'svg', 'ico'];

    /** @var array<int, string> */
    public const MIMES = ['image/png', 'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon'];

    /** Where the shipped logo lives inside the package. */
    private const SHIPPED = 'resources/img/nav-icon.png';

    /** Where it is copied to so a browser can fetch it. */
    private const PUBLIC_DIR = 'legend-theme';

    private static ?string $url = null;

    private static bool $looked = false;

    /**
     * The address of whatever picture should be drawn, or null.
     *
     * Held for the request: the sidebar asks once per row, and this is a config
     * read, a disk URL and - the first time only - a file copy.
     */
    public static function url(): ?string
    {
        if (self::$looked) {
            return self::$url;
        }

        self::$looked = true;

        try {
            $uploaded = trim((string) Theme::config('nav_icon', ''));

            if ($uploaded !== '') {
                $url = Storage::disk('public')->url($uploaded);

                return self::$url = is_string($url) && $url !== '' ? $url : null;
            }

            return self::$url = self::shipped();
        } catch (Throwable) {
            // A disk that will not answer is a row with the tabler icon, not a
            // panel that will not draw its sidebar.
            return self::$url = null;
        }
    }

    /**
     * The logo that comes with the plugin, published where a browser can get it.
     *
     * Copied on first use rather than during installation. Installation is the
     * one moment this plugin has least control over - it is running inside
     * Pelican's installer, possibly from a queue worker, possibly with the disk
     * in a state nobody has checked - and a copy that fails there fails silently
     * and for good. Doing it here means the first page after any install puts it
     * in place, and a panel whose storage was unwritable that day fixes itself
     * the next time somebody loads a page.
     *
     * The filename carries a hash of the file, so shipping a different logo
     * publishes it under a different name. Without that, every browser that had
     * seen the old one would go on showing it - a cached image is not re-fetched
     * because a plugin was updated.
     */
    private static function shipped(): ?string
    {
        $source = plugin_path(Theme::directory(), self::SHIPPED);

        if (!is_file($source)) {
            return null;
        }

        $hash = md5_file($source);

        if (!is_string($hash)) {
            return null;
        }

        $path = self::PUBLIC_DIR . '/nav-icon-' . substr($hash, 0, 8) . '.png';
        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            $contents = file_get_contents($source);

            if (!is_string($contents) || $disk->put($path, $contents) === false) {
                // Storage that will not take it. The tabler icon is a perfectly
                // good sidebar row and this is not worth an error page.
                return null;
            }
        }

        $url = $disk->url($path);

        return is_string($url) && $url !== '' ? $url : null;
    }

    /**
     * What to give Filament for a navigation icon.
     *
     * Filament accepts an Htmlable where it expects an icon name, so the row
     * draws exactly as it did with everything around the picture unchanged.
     */
    public static function icon(): string|HtmlString
    {
        $url = self::url();

        if ($url === null) {
            return self::FALLBACK;
        }

        /*
         * Sized in the stylesheet rather than here, so the plugin's own
         * lettering setting can move it with the row's text. The alt is empty
         * because the label is directly beside it: a repeated name is noise to
         * a screen reader, not help.
         */
        return new HtmlString('<img src="' . e($url) . '" alt="" class="ld-nav-icon">');
    }

    /** Called when the setting is saved, since the sidebar redraws in the same request. */
    public static function forget(): void
    {
        self::$looked = false;
        self::$url = null;
    }
}
