<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Actions\Action;
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
     * The button, wherever it is wanted.
     *
     * One definition rather than one per place it appears: it is on the
     * dashboard block beside the update button, and on the plugin's own page
     * beside the update controls there. Two copies of a modal's wording is two
     * things to keep in step.
     */
    public static function action(string $name = 'changelog'): Action
    {
        return Action::make($name)
            ->label(fn () => Theme::trans('changelog.button'))
            ->icon('tabler-list-details')
            ->color('gray')
            ->modalHeading(fn () => Theme::trans('changelog.title'))
            ->modalDescription(fn () => Theme::trans('changelog.description', [
                'channel' => self::channel(),
            ]))
            ->modalContent(fn () => view(Theme::id() . '::modals.changelog', [
                'entries' => self::safely(),
                'empty' => Theme::trans('changelog.empty'),
                'installedLabel' => Theme::trans('changelog.installed'),
            ]))
            // Nothing to submit: it is something to read.
            ->modalSubmitAction(false)
            ->modalCancelActionLabel(fn () => Theme::trans('changelog.close'));
    }

    private static function channel(): string
    {
        try {
            return Theme::trans('settings.channel.' . Channels::current());
        } catch (Throwable) {
            return '?';
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private static function safely(): array
    {
        try {
            return self::entries();
        } catch (Throwable) {
            // A feed that will not answer costs the modal its list, and the
            // modal says so - it does not cost the page it was opened from.
            return [];
        }
    }

    /**
     * @return array<int, array{version: string, date: string, html: string, installed: bool}>
     */
    public static function entries(int $limit = 15): array
    {
        $installed = self::installed();
        $entries = [];

        foreach (Channels::changelog($limit) as $release) {
            $html = self::render($release['notes']);

            // A release whose whole note was a trailer has nothing left once
            // they are taken off, and an entry with a version and no words is
            // the empty row changelog() already refuses to hand over.
            if ($html === '') {
                continue;
            }

            $entries[] = [
                'version' => $release['version'],
                'date' => self::date($release['published_at']),
                'html' => $html,
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
     * The notes without git's trailers on the end.
     *
     * The release notes are the commit message, and a commit message ends with
     * lines like "Co-authored-by:" and "Signed-off-by:". Those belong to the
     * history: they say who wrote the change. A change log says what changed,
     * and a reader looking at one has no use for them.
     *
     * Stripped here rather than only where releases are cut, because that only
     * cleans up the ones cut afterwards - and every release already published
     * would keep its trailer for good.
     */
    private static function withoutTrailers(string $markdown): string
    {
        $lines = preg_split('/\r\n|\r|\n/', $markdown) ?: [];

        // From the end, because a trailer is only a trailer at the end. The same
        // words halfway down a note are somebody writing a sentence.
        while ($lines !== []) {
            $last = trim((string) end($lines));

            if ($last === '' || preg_match('/^[A-Za-z][A-Za-z-]*-[Bb]y:\s/', $last) === 1) {
                array_pop($lines);

                continue;
            }

            break;
        }

        return trim(implode("\n", $lines));
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
        $markdown = self::withoutTrailers($markdown);

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
