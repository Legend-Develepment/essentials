<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The pictures drawn beside an egg, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::artworkData() and Settings::persistArtwork() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Artwork
{
    use EnvironmentWriterTrait;

    /**
     * The two IGDB credentials, in the shape persistArtwork() reads.
     *
     * Their own pair rather than part of the main form, for the same reason the
     * login screen has one: a form that does not carry every key must not write
     * every key, and these are edited from a modal on the egg artwork page.
     *
     * **The secret is never read back out.** What this returns fills a form,
     * and a form's state is a public Livewire property that travels in the
     * page's HTML, so filling it with the stored secret put the secret in the
     * source of the page for anybody allowed to open it. The field is filled
     * empty and says so when one is on file (see hasSecret()); write() keeps
     * the stored one when it comes back empty.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'igdb_client_id' => (string) Theme::config('igdb_client_id', ''),
            'igdb_client_secret' => '',
        ];
    }

    /**
     * Whether an IGDB client secret is on file, without handing it to anybody.
     *
     * What the form asks instead of the value: it is enough to say "one is
     * saved" in the field.
     */
    public static function hasSecret(): bool
    {
        return trim((string) Theme::config('igdb_client_secret', '')) !== '';
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        /*
         * An empty secret is a field nobody retyped, because the form is never
         * given the stored one, so it keeps what is saved rather than wiping
         * it. Everything else is written as it comes.
         */
        $secret = Clean::credential($data['igdb_client_secret'] ?? null);

        if ($secret === '') {
            $secret = Clean::credential(Theme::config('igdb_client_secret', ''));
        }

        (new self())->writeToEnvironment([
            'LEGEND_THEME_IGDB_ID' => Clean::credential($data['igdb_client_id'] ?? null),
            'LEGEND_THEME_IGDB_SECRET' => $secret,
        ]);
    }
}
