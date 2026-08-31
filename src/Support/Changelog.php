<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Str;
use Throwable;

/**
 * What has changed, ready to read.
 *
 * The notes come from the releases on the channel this panel follows - see
 * Channels::changelog() for why that source rather than a file shipped inside
 * the plugin. This is the part that turns them into something safe to put on a
 * page.
 *
 * They are Markdown from a remote address, and they are treated as such. Raw
 * HTML is stripped rather than passed through, and a link that is not http or
 * https is dropped. It is this plugin's own repository today; the address is
 * worked out from the update feed rather than fixed, and "today" is not a good
 * enough reason to let a remote document write markup into the admin area.
 */
class Changelog
{
    /**
     * @return array<int, array{version: string, date: string, html: string, installed: bool}>
     */
    public static function entries(int $limit = 15): array
    {
        $installed = self::installed();
        $entries = [];

        foreach (Channels::changelog($limit) as $release) {
            $entries[] = [
                'version' => $release['version'],
                'date' => self::date($release['published_at']),
                'html' => self::render($release['notes']),
                'installed' => $release['version'] === $installed,
            ];
        }

        return $entries;
    }

    private static function installed(): string
    {
        try {
            return Channels::installedVersion();
        } catch (Throwable) {
            return '';
        }
    }

    private static function date(string $published): string
    {
        if ($published === '') {
            return '';
        }

        try {
            return \Illuminate\Support\Carbon::parse($published)->format('j M Y');
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * Markdown to HTML, with the unsafe parts taken out rather than trusted.
     *
     * html_input strip: a note containing a <script> or an <iframe> loses it
     * rather than having it rendered into the dashboard. allow_unsafe_links
     * false: javascript: and data: hrefs are dropped, which is the same rule
     * the sidebar footer's link follows and for the same reason.
     */
    private static function render(string $markdown): string
    {
        if ($markdown === '') {
            return '';
        }

        try {
            return (string) Str::markdown($markdown, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);
        } catch (Throwable) {
            // No Markdown parser, or one that threw. The notes are still worth
            // reading, so they are shown as the plain text they were written as.
            return '<p>' . nl2br(e($markdown)) . '</p>';
        }
    }
}
