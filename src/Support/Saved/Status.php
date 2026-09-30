<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Status\Monitors;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The public status page, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::statusData() and Settings::persistStatus() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Status
{
    use EnvironmentWriterTrait;

    /**
     * The public status page's settings.
     *
     * The server list is handed to the form as rows and stored as one string,
     * the same way the icon overrides are - one setting, no table, and it
     * survives a round trip through .env.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'status_servers' => Publish::rows(),
            'status_nodes' => Publish::nodeRows(),
            'status_user_pages' => (bool) Theme::config('status_user_pages', false),
            'status_monitors' => Monitors::rows(),
            'status_title' => (string) Theme::config('status_title', ''),
            'status_note' => (string) Theme::config('status_note', ''),
            'status_link' => (bool) Theme::config('status_link', true),
            'status_every' => (string) Theme::config('status_every', Publish::DEFAULT_EVERY),
            'status_style' => (string) Theme::config('status_style', 'panel'),
            'query_eggs' => Games::eggs(),
        ];
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_STATUS_SERVERS' => Publish::toStorage(
                is_array($data['status_servers'] ?? null) ? $data['status_servers'] : [],
            ),
            // line() rather than the raw value: both of these are drawn on a
            // page served to the public, and a newline in .env ends the
            // variable and starts something else.
            'LEGEND_THEME_STATUS_TITLE' => Clean::line($data['status_title'] ?? null),
            'LEGEND_THEME_STATUS_NOTE' => Clean::line($data['status_note'] ?? null),
            'LEGEND_THEME_STATUS_NODES' => Publish::toStorage(
                is_array($data['status_nodes'] ?? null) ? $data['status_nodes'] : [],
            ),
            'LEGEND_THEME_STATUS_LINK' => ($data['status_link'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_STATUS_USER_PAGES' => ($data['status_user_pages'] ?? false) ? 'true' : 'false',
            // Empty means "follow the panel", so an empty value has to survive
            // rather than being turned into the default accent.
            'LEGEND_THEME_QUERY_EGGS' => Games::sanitise($data['query_eggs'] ?? null),
            'LEGEND_THEME_STATUS_EVERY' => Clean::oneOf(
                $data['status_every'] ?? null,
                array_keys(Publish::EVERY),
                Publish::DEFAULT_EVERY,
            ),
            'LEGEND_THEME_STATUS_STYLE' => Clean::oneOf(
                $data['status_style'] ?? null,
                array_keys(Publish::styles()),
                'panel',
            ),
        ]);

        // A list rather than a value, so it goes in a file beside the
        // announcements and the sidebar links rather than into .env.
        if (is_array($data['status_monitors'] ?? null)) {
            Monitors::save($data['status_monitors']);
        }

        /*
         * The snapshot is now wrong, so it goes.
         *
         * Everything above changes what the public page says, and the page is
         * served from a snapshot rather than from these settings. Leaving it to
         * age out meant a monitor removed here stayed on the page for minutes -
         * which is the same thing, from the outside, as a page that does not
         * work.
         */
        Publish::forget();
    }
}
