<?php

namespace LegendDevelopment\Theme\Support;

use LegendDevelopment\Theme\Support\Access\Sync;
use LegendDevelopment\Theme\Support\Status\Pages as StatusPages;
use Throwable;

/**
 * What a switch leaves behind, and which of it is still happening.
 *
 * Switching something off never removes what it has written down. That is a
 * promise, it is the right promise, and it leaves a question the panel was not
 * answering: what *is* still there, then?
 *
 * For most of them the answer is "a file, doing nothing, waiting for you to
 * switch this back on". A saved arrangement is exactly that: nobody is served
 * it, nothing reads it, and switching the arranger on again finds every page
 * where its owner left it. Those get a sentence and nothing else.
 *
 * One of them is not like that. Role-based access writes rows into Pelican's
 * own subusers table, and those rows keep working: people keep the servers and
 * the SFTP. Switching the feature off deliberately does not revoke them - an
 * off switch that silently took a hundred people's servers away would be a
 * worse switch - so there has always been a button that does it on purpose.
 * That button was on a page that hides itself when the feature is off, which
 * is to say the way out was behind the switch you had just pressed.
 *
 * **The rule, so nobody adds a delete button out of symmetry: a button is for
 * what is still acting. What is only sitting on disk gets a sentence.**
 *
 * This holds no state, like Modules beside it: every number is read where it
 * lives, and nothing here is asked about a feature that is switched on.
 */
class Leftovers
{
    /** Still happening after the switch went off. */
    public const ACTS = 'acts';

    /** Sitting there, doing nothing, and correct again when the switch returns. */
    public const KEPT = 'kept';

    /**
     * What each of these leaves, and of what kind.
     *
     * Five, and the list is deliberately short: a feature that leaves nothing
     * behind has nothing to say here, and most of them leave nothing.
     *
     * @var array<string, string>
     */
    public const WATCHED = [
        Features::ACCESS => self::ACTS,
        Features::PUBLIC_STATUS => self::KEPT,
        Features::ARRANGER => self::KEPT,
        Features::USER_THEMES => self::KEPT,
    ];

    /**
     * And which of them the card offers a way out of.
     *
     * One. The others are files nobody is being served, and a button that
     * deletes what everybody would want back the moment the switch returns is
     * a button that only ever gets pressed by accident.
     *
     * @var array<int, string>
     */
    public const CLEARS = [Features::ACCESS];

    /**
     * What a module has left standing, as keys the page will translate.
     *
     * Only for the parts that are off: this is the mirror of Modules::health(),
     * which only asks about the parts that are on.
     *
     * A count of null is not nought. It means the panel could not read where
     * that answer lives, and it is drawn as something wrong rather than as a
     * clean card - the one panel whose storage has gone unreadable is exactly
     * the panel that should not be told everything is tidy.
     *
     * @return array<int, array{feature: string, tone: string, count: int|null, clears: bool}>
     */
    public static function of(string $module): array
    {
        $out = [];

        foreach (Modules::holds($module) as $feature) {
            $tone = self::WATCHED[$feature] ?? null;

            if ($tone === null || Standalone::replacesFeature($feature) || Features::enabled($feature)) {
                continue;
            }

            $count = self::count($feature);

            // Nothing left is nothing to say. Unreadable is not nothing.
            if ($count === 0) {
                continue;
            }

            $out[] = [
                'feature' => $feature,
                'tone' => $tone,
                'count' => $count,
                'clears' => in_array($feature, self::CLEARS, true),
            ];
        }

        return $out;
    }

    /**
     * How much of it there is, or null when that could not be read.
     *
     * Each answer comes from the class that owns the thing, so this knows no
     * file formats. None of them is a database query and none of them is asked
     * about a feature that is on, so a panel with everything switched on does
     * no work here at all.
     */
    public static function count(string $feature): ?int
    {
        try {
            return match ($feature) {
                Features::ACCESS => Sync::granted(),
                Features::PUBLIC_STATUS => StatusPages::published(),
                Features::ARRANGER => Layouts::saved(),
                Features::USER_THEMES => UserTheme::chosen(),
                default => 0,
            };
        } catch (Throwable) {
            // Could not tell, which is its own answer and not "none".
            return null;
        }
    }

    /**
     * End what is still happening.
     *
     * Refuses twice before it does anything: this is the way out of a switch
     * that is off, not a delete button for a feature that is running. The
     * second guard is the one that matters - a feature somebody switched back
     * on while looking at the card must not have its rows swept by a click on
     * a line that is no longer true.
     */
    public static function clear(string $feature): int
    {
        if (!in_array($feature, self::CLEARS, true)) {
            return 0;
        }

        if (Standalone::replacesFeature($feature) || Features::enabled($feature)) {
            return 0;
        }

        try {
            return match ($feature) {
                Features::ACCESS => Sync::revokeAll(),
                default => 0,
            };
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }
    }
}
