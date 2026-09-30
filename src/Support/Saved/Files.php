<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Stamp;
use LegendDevelopment\Theme\Support\Theme;

/**
 * Where the files this plugin keeps are put, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::filesData() and Settings::persistFiles() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Files
{
    use EnvironmentWriterTrait;

    /**
     * The two settings on the storage page that are credentials.
     *
     * A settings form's state is a public Livewire property, and a public
     * property travels in the page's HTML. Filling the page from read() put
     * the bucket secret and the CDN token in the source of that page, readable
     * by anybody allowed to open it - including somebody who may only look,
     * because a section hidden from them decides what is drawn and not what is
     * filled. So the page is filled from shown() and saves through typed().
     *
     * read() still carries them, and has to: the page's save and a settings
     * import both lay their answers over it, so a value missing from it would
     * be written back as nothing.
     */
    public const SECRETS = ['files_s3_secret', 'files_cdn_token'];

    /**
     * What the storage page is filled with: every setting, the credentials
     * empty.
     *
     * @return array<string, mixed>
     */
    public static function shown(): array
    {
        return array_merge(self::read(), array_fill_keys(self::SECRETS, ''));
    }

    /** Whether a credential is on file, which is all the page is told about it. */
    public static function kept(string $key): bool
    {
        return in_array($key, self::SECRETS, true)
            && trim((string) (self::read()[$key] ?? '')) !== '';
    }

    /**
     * A form's answers, without the credentials nobody retyped.
     *
     * Empty is what the page sends for a credential that was left alone,
     * because it was never given the stored one. Left in, it would be laid
     * over read() and written as nothing; taken out, the stored value stands.
     * The price is that a credential cannot be emptied from the page, and
     * choosing somewhere else to keep files is how one stops being used.
     *
     * @param  array<string, mixed>  $state
     * @return array<string, mixed>
     */
    public static function typed(array $state): array
    {
        foreach (self::SECRETS as $key) {
            if (array_key_exists($key, $state) && trim((string) $state[$key]) === '') {
                unset($state[$key]);
            }
        }

        return $state;
    }

    public static function read(): array
    {
        return [
            'files_where' => (string) Theme::config('files_where', 'panel'),
            'files_read_from' => (string) Theme::config('files_read_from', ''),
            'files_s3_key' => (string) Theme::config('files_s3_key', ''),
            'files_s3_secret' => (string) Theme::config('files_s3_secret', ''),
            'files_s3_region' => (string) Theme::config('files_s3_region', 'auto'),
            'files_s3_bucket' => (string) Theme::config('files_s3_bucket', ''),
            'files_s3_endpoint' => (string) Theme::config('files_s3_endpoint', ''),
            'files_s3_path_style' => (bool) Theme::config('files_s3_path_style', false),
            'files_cdn_base' => (string) Theme::config('files_cdn_base', 'https://cdn.modora.xyz'),
            'files_cdn_token' => (string) Theme::config('files_cdn_token', ''),
            'files_cdn_folder' => (string) Theme::config('files_cdn_folder', 'panel'),
            'files_mirror_minutes' => (int) Theme::config('files_mirror_minutes', 1),
        ];
    }

    /**
     * Where files go, written on its own.
     *
     * Its own writer rather than a corner of persist(), for the reason every
     * one of these has one: persist() writes every key it knows about and takes
     * a missing one as "set it to the default", so a form that does not carry
     * the whole set must not be allowed near it.
     *
     * @param  array<string, mixed>  $data
     */
    public static function write(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_FILES_WHERE' => in_array($data['files_where'] ?? '', ['s3', 'cdn'], true)
                ? (string) $data['files_where']
                : 'panel',
            'LEGEND_THEME_FILES_READ_FROM' => rtrim(trim((string) ($data['files_read_from'] ?? '')), '/'),
            'LEGEND_THEME_FILES_S3_KEY' => trim((string) ($data['files_s3_key'] ?? '')),
            'LEGEND_THEME_FILES_S3_SECRET' => trim((string) ($data['files_s3_secret'] ?? '')),
            'LEGEND_THEME_FILES_S3_REGION' => trim((string) ($data['files_s3_region'] ?? '')) ?: 'auto',
            'LEGEND_THEME_FILES_S3_BUCKET' => trim((string) ($data['files_s3_bucket'] ?? '')),
            'LEGEND_THEME_FILES_S3_ENDPOINT' => rtrim(trim((string) ($data['files_s3_endpoint'] ?? '')), '/'),
            'LEGEND_THEME_FILES_S3_PATH_STYLE' => (bool) ($data['files_s3_path_style'] ?? false),
            'LEGEND_THEME_FILES_CDN_BASE' => rtrim(trim((string) ($data['files_cdn_base'] ?? '')), '/'),
            'LEGEND_THEME_FILES_CDN_TOKEN' => trim((string) ($data['files_cdn_token'] ?? '')),
            'LEGEND_THEME_FILES_CDN_FOLDER' => trim(trim((string) ($data['files_cdn_folder'] ?? '')), '/'),
            'LEGEND_THEME_FILES_MIRROR_MINUTES' => (string) Clean::clamp($data['files_mirror_minutes'] ?? null, 1, 1440, 1),
        ]);

        /*
         * Where files live decides what address the cached stylesheet block
         * says a backdrop is at, the moment images go through here. Bumping is
         * a write that happens when somebody saves this page and never
         * otherwise, and the alternative is a panel that is right in the
         * settings and wrong on the screen.
         */
        Stamp::bump();
    }
}
