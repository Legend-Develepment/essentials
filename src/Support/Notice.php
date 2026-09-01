<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

/**
 * Announcements: lines across the top of the panel, with a window of time each
 * one is shown in.
 *
 * A maintenance window announced three days ahead and taken down by itself when
 * it passes, an invite that stays up, a warning that runs for an hour. They are
 * a list rather than one setting because that is what they are used as, and
 * they are on a page of their own rather than in the theme's settings because
 * writing one is a job, not a preference.
 *
 * Stored as JSON in storage, not in .env: a list of records with dates in it is
 * not what dotenv is for, and the custom CSS already lives there for the same
 * reason.
 *
 * Every one is plain text, escaped on the way in and again on the way out, with
 * the link built separately from an address that has been checked. Not a rich
 * text field, and that restriction is the feature: this ends up on every page
 * of a panel other people log in to.
 */
class Notice
{
    private const PATH = 'legend-theme/announcements.json';

    private const STYLES = ['info', 'warning', 'danger', 'accent'];

    /** Which panels one appears on. */
    private const SCOPES = ['all', 'client', 'admin'];

    /** Long enough for a sentence, short enough to stay one line. */
    private const MAX_LENGTH = 200;

    /**
     * A ceiling on how many can be kept. Every active one is a bar on every
     * page and a rule in the stylesheet, and a panel with fifty of them is not
     * a panel anyone can read.
     */
    public const MAX_ROWS = 10;

    /** @var array<int, array<string, mixed>>|null */
    private static ?array $cached = null;

    /* ------------------------------------------------------------- storage */

    /**
     * Every announcement, sanitised, in the order they were saved.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function rows(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        $raw = null;

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::PATH)) {
                $raw = json_decode((string) $disk->get(self::PATH), true);
            }
        } catch (Throwable) {
            // Unreadable storage is a panel without announcements, not a panel
            // that will not render.
        }

        return self::$cached = self::clean(is_array($raw) ? $raw : []);
    }

    /**
     * Returns whether the list actually reached the disk.
     *
     * It used to return nothing, catch Throwable, and fill the memo either way -
     * which meant a write that did not happen looked exactly like one that did,
     * for the rest of the request and to the person who pressed Save. Two things
     * were wrong with that. Storage::put() answers **false** for the ordinary
     * failures - an unwritable directory, a full disk - and throws only for the
     * rarer ones, so the catch was watching the wrong door. And a memo filled in
     * before the write is a promise the disk did not make.
     *
     * @param  array<int|string, mixed>  $rows
     */
    public static function save(array $rows): bool
    {
        $rows = self::clean($rows);

        try {
            $written = Storage::disk('local')->put(self::PATH, json_encode(
                $rows,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ));

            if ($written === false) {
                report(new RuntimeException(
                    'Could not write ' . self::PATH . ' to the local disk. Check that '
                    . storage_path('app') . ' belongs to the user the panel runs as.',
                ));

                return false;
            }
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        self::$cached = $rows;

        return true;
    }

    /**
     * Takes anything the form hands over and gives back rows that can be
     * trusted from here on.
     *
     * @param  array<int|string, mixed>  $rows
     * @return array<int, array<string, mixed>>
     */
    private static function clean(array $rows): array
    {
        $clean = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $text = self::text($row['text'] ?? null);

            // An announcement with nothing to announce is not one.
            if ($text === '') {
                continue;
            }

            $clean[] = [
                'enabled' => (bool) ($row['enabled'] ?? true),
                'text' => $text,
                'style' => self::oneOf($row['style'] ?? null, self::STYLES, 'info'),
                'scope' => self::oneOf($row['scope'] ?? null, self::SCOPES, 'all'),
                'link_label' => self::text($row['link_label'] ?? null, 40),
                'link_url' => self::url($row['link_url'] ?? null),
                'dismissible' => (bool) ($row['dismissible'] ?? true),
                'starts_at' => self::moment($row['starts_at'] ?? null),
                'ends_at' => self::moment($row['ends_at'] ?? null),
            ];

            if (count($clean) >= self::MAX_ROWS) {
                break;
            }
        }

        return $clean;
    }

    /* ------------------------------------------------------------- showing */

    /**
     * The ones to show on this page, right now.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function active(): array
    {
        $now = self::stamp();
        $panel = self::panel();

        return array_values(array_filter(self::rows(), static function (array $row) use ($now, $panel): bool {
            if (!$row['enabled']) {
                return false;
            }

            if ($row['starts_at'] !== null && $row['starts_at'] > $now) {
                return false;
            }

            if ($row['ends_at'] !== null && $row['ends_at'] < $now) {
                return false;
            }

            return self::inScope($row['scope'], $panel);
        }));
    }

    /**
     * The bars, as static markup in the first response.
     *
     * Deliberately not a Livewire component. Nothing of this theme's own that
     * arrives after a page has painted may go above a terminal - four attempts
     * at that emptied the console every time - and these are meant to appear on
     * every page there is, the console included.
     */
    public static function html(): string
    {
        $html = '';

        foreach (self::active() as $row) {
            $html .= self::bar($row);
        }

        return $html;
    }

    private static function bar(array $row): string
    {
        $html = '<div class="ld-notice ld-notice--' . $row['style'] . '" role="status"'
            . ' data-ld-notice="' . self::key($row) . '">'
            . '<span class="ld-notice__text">' . e($row['text']) . '</span>';

        if ($row['link_url'] !== '') {
            $label = $row['link_label'] === '' ? $row['link_url'] : $row['link_label'];

            $html .= '<a class="ld-notice__link" href="' . e($row['link_url']) . '" rel="noopener">'
                . e($label)
                . '</a>';
        }

        if ($row['dismissible']) {
            // No name on it: the label is the icon, and the icon is a cross.
            $html .= '<button type="button" class="ld-notice__close"'
                . ' aria-label="' . e(Theme::trans('settings.notice.dismiss')) . '">'
                . '&times;</button>';
        }

        return $html . '</div>';
    }

    /**
     * One rule per announcement that can be closed, so a browser that has
     * closed one hides that one and no other.
     *
     * The browser cannot be asked what it has closed from here, so it says so
     * instead: the inlined runtime writes the keys it finds in storage onto
     * <html> before the first paint, and these rules match on them. A bar that
     * shows for a frame and is then taken away is worse than one that never
     * showed.
     */
    public static function css(): string
    {
        $css = '';

        foreach (self::active() as $row) {
            if (!$row['dismissible']) {
                continue;
            }

            $key = self::key($row);

            $css .= 'html[data-ld-closed~="' . $key . '"] .ld-notice[data-ld-notice="' . $key . '"]'
                . '{display:none!important;}';
        }

        return $css;
    }

    /**
     * An announcement's own name, so closing one does not close the next, and
     * so editing the words brings it back for everyone who closed it.
     *
     * A hash rather than the words: it ends up in an attribute and in the
     * browser's storage, and neither is a place to put a sentence someone can
     * choose.
     */
    public static function key(array $row): string
    {
        return substr(sha1($row['text'] . '|' . $row['link_url']), 0, 12);
    }

    /* -------------------------------------------------------------- fields */

    /**
     * @return array<string, string>
     */
    public static function styleOptions(): array
    {
        return self::options(self::STYLES, 'style_');
    }

    /**
     * @return array<string, string>
     */
    public static function scopeOptions(): array
    {
        return self::options(self::SCOPES, 'scope_');
    }

    /**
     * @param  array<int, string>  $values
     * @return array<string, string>
     */
    private static function options(array $values, string $prefix): array
    {
        $options = [];

        foreach ($values as $value) {
            $options[$value] = Theme::trans('settings.notice.' . $prefix . $value);
        }

        return $options;
    }

    /* -------------------------------------------------------------- pieces */

    private static function panel(): ?string
    {
        try {
            return Filament::getCurrentPanel()?->getId();
        } catch (Throwable) {
            return null;
        }
    }

    private static function inScope(string $scope, ?string $panel): bool
    {
        if ($scope === 'all' || $panel === null) {
            // No panel to ask. Showing it is the smaller mistake: one nobody
            // wanted is a line of text, and one nobody saw could have been the
            // maintenance window.
            return true;
        }

        return $scope === 'admin' ? $panel === 'admin' : $panel !== 'admin';
    }

    private static function stamp(): string
    {
        try {
            return now()->format('Y-m-d H:i:s');
        } catch (Throwable) {
            // Without a clock nothing can be judged early or late, so nothing
            // is held back.
            return '';
        }
    }

    /**
     * A moment, normalised, or nothing. Compared as strings afterwards, which
     * this format is safe to do.
     */
    private static function moment(mixed $value): ?string
    {
        if (!is_scalar($value)) {
            return null;
        }

        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        try {
            $time = strtotime($value);

            return $time === false ? null : date('Y-m-d H:i:s', $time);
        } catch (Throwable) {
            return null;
        }
    }

    private static function text(mixed $value, int $max = self::MAX_LENGTH): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        // Control characters out, whitespace collapsed: this is one line, and a
        // pasted newline should not make it two.
        $value = preg_replace('/[\x00-\x1f\x7f]+/u', ' ', (string) $value) ?? '';
        $value = preg_replace('/\s+/u', ' ', $value) ?? '';

        return mb_substr(trim($value), 0, $max);
    }

    /**
     * An address, or nothing. Only http and https, or a path inside this panel -
     * which rules out javascript: and data:, the two that turn a link into
     * something else.
     */
    private static function url(mixed $value): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = trim((string) $value);

        if ($value === '' || mb_strlen($value) > 300) {
            return '';
        }

        if (str_starts_with($value, '/') && !str_starts_with($value, '//')) {
            return $value;
        }

        $scheme = strtolower((string) (parse_url($value, PHP_URL_SCHEME) ?: ''));

        return in_array($scheme, ['http', 'https'], true) ? $value : '';
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
