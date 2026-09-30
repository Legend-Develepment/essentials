<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The ticket desk, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::ticketsData() and Settings::persistTickets() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Tickets
{
    use EnvironmentWriterTrait;

    /**
     * The ticket settings, in the shape persistTickets() reads.
     *
     * Its own pair for the same reason the login screen has one: a form that
     * does not carry every key must not write every key.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'tickets_via' => (string) Theme::config('tickets_via', 'panel'),
            'tickets_modora_key' => (string) Theme::config('tickets_modora_key', ''),
            'tickets_modora_panel' => (string) Theme::config('tickets_modora_panel', ''),
            'tickets_hook_secret' => (string) Theme::config('tickets_hook_secret', ''),
            'tickets_open' => (bool) Theme::config('tickets_open', true),
            'tickets_button' => (bool) Theme::config('tickets_button', true),
        ];
    }

    /**
     * Where tickets are answered, and the key for the far end.
     *
     * Its own writer for the reason the login screen has one: a form that does
     * not carry every key must not write every key, and these three are edited
     * from a modal on the tickets page.
     *
     * @param  array<string, mixed>  $data
     */
    public static function write(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_TICKETS_VIA' => (string) ($data['tickets_via'] ?? 'panel'),
            'LEGEND_THEME_TICKETS_MODORA_KEY' => (string) ($data['tickets_modora_key'] ?? ''),
            'LEGEND_THEME_TICKETS_MODORA_PANEL' => (string) ($data['tickets_modora_panel'] ?? ''),
            'LEGEND_THEME_TICKETS_HOOK_SECRET' => (string) ($data['tickets_hook_secret'] ?? ''),
            'LEGEND_THEME_TICKETS_OPEN' => (bool) ($data['tickets_open'] ?? true),
            'LEGEND_THEME_TICKETS_BUTTON' => (bool) ($data['tickets_button'] ?? true),
        ]);
    }
}
