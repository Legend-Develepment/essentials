<?php

namespace LegendDevelopment\Theme\Support;

use LegendDevelopment\Theme\Support\Access\Sync;
use LegendDevelopment\Theme\Support\Alerts\Notifier;
use LegendDevelopment\Theme\Support\Alerts\State;
use LegendDevelopment\Theme\Support\Shop\Tables as ShopTables;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;
use LegendDevelopment\Theme\Support\Shop\Credits;
use LegendDevelopment\Theme\Support\Shop\Upgrades;
use Throwable;

/**
 * What this process is still holding from the last piece of work.
 *
 * Almost everything here memoises in a class-level static, and under php-fpm
 * that is exactly right: the static is born and dies with the request, so it is
 * a per-request memo that costs nothing to manage. The queue worker is not that.
 * It is one PHP process running job after job for hours, and every static it
 * fills on the first job it keeps for all of them.
 *
 * This has already cost real things twice. Alerts\State kept a Reset button from
 * working, which is why it grew refresh(). And a balance read while writing the
 * first renewal invoice of the night is the balance every later invoice in that
 * pass is settled against, whoever moved money in between.
 *
 * So: **a job starts by forgetting what the process remembers.**
 * tools/check-jobs.js refuses a queued job whose handle() does not, because the
 * alternative is remembering which jobs need it, and the answer to that question
 * changes every time somebody adds a memo three calls down.
 *
 * Two things this deliberately does not do:
 *
 * **It does not reload the settings.** A worker holds Laravel's config from the
 * moment it booted, and nothing here can make it re-read .env - only a restart
 * can. That is why changing what is switched on tells the workers to stop
 * (Features::changed), rather than hoping they notice.
 *
 * **It does not touch anything keyed by something that cannot change.** The
 * plugin's own directory, its id, the panel's name: those are the same answer
 * for the life of the process and clearing them would be work for nothing.
 */
class Held
{
    /**
     * Drop what a new piece of work must not inherit.
     *
     * Each one on its own, because a class that will not answer is not a reason
     * for the job to not run: the worst that comes of a memo that could not be
     * cleared is the answer this was already giving before it existed.
     */
    public static function forget(): void
    {
        foreach ([
            /*
             * Everything worked out from settings, in one call.
             *
             * This listed six by hand and Theme::forgetDerived() listed
             * nineteen, which meant a worker that had been alive since before
             * somebody changed a setting went on answering from the old one -
             * the games, the languages, the timed looks, the port counts. The
             * port counts had already been patched around at the top of the
             * watchdog's own check, which is what a second list looks like
             * from the inside.
             */
            static fn () => Theme::forgetDerived(),
            static fn () => Credits::forget(),
            static fn () => Notifier::forget(),
            static fn () => Sync::forget(),
            // Every change that is still open, read once per request - and a
            // worker's request is hours long, so a retry applied by one job
            // would still read as waiting in the next.
            static fn () => Upgrades::forget(),
            static fn () => State::refresh(),
            /*
             * And whether the tables of a module are there, which is not a
             * setting and is exactly as stale.
             *
             * ready() remembers its answer for the process. A worker that asked
             * before a module was switched on keeps saying no, so the pages
             * behind it stay hidden and the job that would have used them does
             * nothing, for as long as that worker lives.
             */
            static fn () => ShopTables::forget(),
            static fn () => TicketTables::forget(),
            /*
             * And this plugin's own row, which a worker reads once and would
             * otherwise answer from for as long as it lives - including after
             * Pelican has installed a newer version underneath it.
             */
            static fn () => Installed::forget(),
            // And what the Essentials Auto Updater said, which changes as it
            // checks and installs.
            static fn () => AutoUpdater::forget(),
        ] as $drop) {
            try {
                $drop();
            } catch (Throwable $exception) {
                report($exception);
            }
        }
    }
}
