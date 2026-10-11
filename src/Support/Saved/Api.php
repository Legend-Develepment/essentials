<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Stamp;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The API: whether it answers at all, and to whom, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::apiData() and Settings::persistApi() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Api
{
    use EnvironmentWriterTrait;

    /**
     * The API's own three settings, and nothing else.
     *
     * No key and no secret. Those are rows in essentials_api_keys, hashed,
     * because a token in .env is a token in every settings export and every
     * backup of one - and this pair is exactly what the export gate reads to
     * decide what leaves the panel.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'api_approval' => (bool) Theme::config('api_approval', true),
            'api_hide_pelican' => (bool) Theme::config('api_hide_pelican', false),
            'api_rate' => (int) Theme::config('api_rate', 60),
            'api_days' => (int) Theme::config('api_days', 0),
        ];
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_API_APPROVAL' => ($data['api_approval'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_API_HIDE_PELICAN' => ($data['api_hide_pelican'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_API_RATE' => (string) Clean::clamp($data['api_rate'] ?? null, 1, 1000, 60),
            // Zero is a real answer here and the default one: until revoked.
            'LEGEND_THEME_API_DAYS' => (string) Clean::clamp($data['api_days'] ?? null, 0, 3650, 0),
        ]);

        /*
         * Because one of these is read by the cached stylesheet.
         *
         * Api\Keys::css() emits the rule that hides Pelican's own API keys tab,
         * and it lands inside the settings block - which is built once and kept
         * until the stamp moves. Without this the toggle writes .env, the
         * settings page reads back what was saved, and the panel keeps serving
         * the stylesheet it already had. Correct on the page, wrong in the
         * browser, and silent about it.
         *
         * That is the fault the icon stylesheet shipped for a day, and it is
         * why check-stamp.js now asks every persister here rather than asking
         * the file.
         */
        Stamp::bump();
    }
}
