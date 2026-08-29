<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Facades\Filament;
use Throwable;

/**
 * One line across the top of the panel: a maintenance window, a Discord invite,
 * a notice that backups run at four.
 *
 * Plain text, escaped, with the link built separately from an address that has
 * been checked. Not a rich text field, and that restriction is the feature:
 * this ends up on every page of a panel that other people log in to, so an
 * administrator typing a `<` gets a `<` rather than a surprise. The login
 * notice already takes the same care on its way into a CSS string.
 *
 * Dismissal is per browser and keyed to the message, so a new message comes
 * back for someone who closed the last one. A notice that has to be
 * acknowledged is a different feature and does not belong in a theme.
 */
class Notice
{
    private const STYLES = ['info', 'warning', 'danger', 'accent'];

    /** Which panels it appears on. */
    private const SCOPES = ['all', 'client', 'admin'];

    /** Long enough for a sentence, short enough to stay one line. */
    private const MAX_LENGTH = 200;

    public static function text(): string
    {
        return self::clean(Theme::config('notice_text', ''));
    }

    public static function style(): string
    {
        return self::oneOf(Theme::config('notice_style', 'info'), self::STYLES, 'info');
    }

    public static function scope(): string
    {
        return self::oneOf(Theme::config('notice_scope', 'all'), self::SCOPES, 'all');
    }

    public static function linkLabel(): string
    {
        return self::clean(Theme::config('notice_link_label', ''), 40);
    }

    public static function linkUrl(): string
    {
        return self::url(Theme::config('notice_link_url', ''));
    }

    public static function dismissible(): bool
    {
        return (bool) Theme::config('notice_dismissible', true);
    }

    /**
     * @return array<string, string>
     */
    public static function styleOptions(): array
    {
        $options = [];

        foreach (self::STYLES as $style) {
            $options[$style] = Theme::trans('settings.notice.style_' . $style);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function scopeOptions(): array
    {
        $options = [];

        foreach (self::SCOPES as $scope) {
            $options[$scope] = Theme::trans('settings.notice.scope_' . $scope);
        }

        return $options;
    }

    public static function sanitiseText(mixed $value): string
    {
        return self::clean($value);
    }

    public static function sanitiseLabel(mixed $value): string
    {
        return self::clean($value, 40);
    }

    public static function sanitiseUrl(mixed $value): string
    {
        return self::url($value);
    }

    public static function sanitiseStyle(mixed $value): string
    {
        return self::oneOf($value, self::STYLES, 'info');
    }

    public static function sanitiseScope(mixed $value): string
    {
        return self::oneOf($value, self::SCOPES, 'all');
    }

    /**
     * The bar itself, as static markup in the first response.
     *
     * Deliberately not a Livewire component. Nothing of this theme's own that
     * arrives after a page has painted may go above a terminal - four attempts
     * at that emptied the console every time - and this one is meant to appear
     * on every page there is, the console included.
     */
    public static function html(): string
    {
        $text = self::text();

        if ($text === '' || !self::onThisPanel()) {
            return '';
        }

        $html = '<div class="ld-notice ld-notice--' . self::style() . '"'
            . ' role="status" data-ld-notice="' . self::key() . '">'
            . '<span class="ld-notice__text">' . e($text) . '</span>';

        $url = self::linkUrl();

        if ($url !== '') {
            $label = self::linkLabel();

            $html .= '<a class="ld-notice__link" href="' . e($url) . '" rel="noopener">'
                . e($label === '' ? $url : $label)
                . '</a>';
        }

        if (self::dismissible()) {
            // No name on it: the label is the icon, and the icon is a cross.
            $html .= '<button type="button" class="ld-notice__close"'
                . ' aria-label="' . e(Theme::trans('settings.notice.dismiss')) . '">'
                . '&times;</button>';
        }

        return $html . '</div>';
    }

    /**
     * The message's own name, so closing one notice does not close the next.
     *
     * A hash rather than the message: it ends up in an attribute and in the
     * browser's storage, and neither is a place to put a sentence someone can
     * choose.
     */
    public static function key(): string
    {
        return substr(sha1(self::text() . '|' . self::linkUrl()), 0, 12);
    }

    /**
     * Which notice the browser should check against what it has closed. Read
     * back by the inlined runtime before the first paint, so a dismissed
     * notice never shows for a frame and then goes.
     */
    public static function css(): string
    {
        if (self::text() === '' || !self::dismissible() || !self::onThisPanel()) {
            return '';
        }

        return ':root{--ld-notice:"' . self::key() . '";}';
    }

    private static function onThisPanel(): bool
    {
        $scope = self::scope();

        if ($scope === 'all') {
            return true;
        }

        try {
            $panel = Filament::getCurrentPanel()?->getId();
        } catch (Throwable) {
            // No panel to ask. Showing it is the smaller mistake: a notice
            // nobody wanted is a line of text, and one nobody saw could have
            // been the maintenance window.
            return true;
        }

        return $scope === 'admin'
            ? $panel === 'admin'
            : $panel !== 'admin';
    }

    private static function clean(mixed $value, int $max = self::MAX_LENGTH): string
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
