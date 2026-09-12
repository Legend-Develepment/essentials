<?php

namespace LegendDevelopment\Theme\Support;

use App\Services\Helpers\PluginService;
use Illuminate\Support\Facades\Artisan;
use LegendDevelopment\Theme\Jobs\EnsureEnabled;
use LegendDevelopment\Theme\Support\Api\Connections;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Versions;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;
use Throwable;

/**
 * What has to happen at the end of installing or updating this plugin.
 *
 * The work lives here rather than in the seeder because there has to be more
 * than one seeder - see the note in either of them - and two copies of this
 * would be two things to keep in step.
 */
class InstallTasks
{
    /** Where the last version whose columns were added is remembered. */
    private const SEEN = 'legend-theme.schema';

    /**
     * Add any columns this version has and the database does not.
     *
     * Called on boot rather than only at install, because an install is not
     * reliably where it happens. The update runs in a process that already had
     * this plugin loaded, and PHP loads a class once - so the seeder that runs
     * after the files are swapped is running the *old* Tables::upgrade(),
     * which knows nothing about the columns the new one adds. Schema changes
     * were arriving a release late, and the release that needed them was the
     * one that ran without them.
     *
     * Guarded on the version so it costs one cache read on an ordinary request.
     * That is not a record of having run - if the cache is lost it simply runs
     * again, and both upgrades ask the database what it actually has, so
     * running them twice is running them once. Which is the whole reason they
     * are install tasks and not migrations.
     */
    public static function schema(): void
    {
        try {
            $version = trim((string) Versions::installed());

            if ($version === '' || $version === '?') {
                return;
            }

            if (cache()->get(self::SEEN) === $version) {
                return;
            }

            Keys::upgrade();
            Tables::upgrade();

            /*
             * And the support desk's two tables.
             *
             * Here as well as in run(), for exactly the reason written above
             * this method: the seeder that runs after the files are swapped is
             * the previous release's code, so a table only run() makes arrives
             * a release late - and the release that needs it is the one that
             * runs without it. That is not a hypothetical; it happened to these
             * two, and a probe against the live panel found them missing.
             *
             * install() is guarded on each table's own existence, so calling it
             * on every version change costs one Schema::hasTable each.
             */
            TicketTables::install();

            cache()->put(self::SEEN, $version, now()->addYear());
        } catch (Throwable) {
            // A database or a cache that will not answer leaves the columns as
            // they are, and every reader of them copes with one being absent.
        }
    }

    public static function run(): void
    {
        try {
            /*
             * The one table this plugin owns, made here rather than in a
             * migration - see the note on Api\Keys::install() and on the
             * migration that used to do it. A seeder runs on every install and
             * asks the database what is there; a migration runs once and then
             * trusts a record of having run, which is the difference between
             * recoverable and not.
             */
            /*
             * The arranger's switch moved into the features list. A panel that
             * had switched it off must not have it come back on under them, so
             * the old answer is carried over once and the old key cleared -
             * after which Theme::arrangerEnabled() is reading one thing.
             *
             * Idempotent without a marker: clearing the key is what stops this
             * happening twice, and a key that was never false never triggers it
             * at all.
             */
            if (Theme::config('arranger', true) === false || Theme::config('arranger', true) === 'false') {
                Features::disable(Features::ARRANGER);
                Settings::persist(array_merge(Settings::data(), ['arranger' => true]));
            }
        } catch (Throwable) {
            // A carry-over that could not run leaves the old key in place, so
            // the next install tries again. Nothing is lost by it failing.
        }

        try {
            Keys::install();
            Keys::upgrade();
            Connections::install();
        } catch (Throwable) {
            // An install is not failed over one feature's table. The API is
            // simply not offered until it exists - Keys::ready() decides that
            // on every page and every request.
        }

        try {
            // The shop's five, on the same rule and for the same reason.
            // Tables::ready() decides on every page whether to offer any of it.
            Tables::install();
        } catch (Throwable) {
            // Same as above: the shop is not offered until its tables exist.
        }

        try {
            // And the support desk's two. Their own call rather than a line
            // inside the shop's, because a panel can want somewhere to answer
            // questions without selling anything.
            TicketTables::install();
        } catch (Throwable) {
            // Same rule again: no tables, no tickets, and no page that throws.
        }

        try {
            /*
             * Tell the queue workers to finish what they are on and stop.
             *
             * A worker registers a plugin's class map once, when it boots, so
             * one that started before this update cannot load the code that
             * just replaced it - every job of ours unserialises into an
             * incomplete class and fails, silently, which is exactly the yellow
             * line on the dashboard saying no worker answered. It came back
             * after every single update because the worker was never told.
             *
             * queue:restart is Laravel's own way to say it: a worker finishes
             * the job in its hands and exits, and the service manager starts it
             * again with the new code. Nothing is lost, and a panel whose
             * worker is not set to restart is no worse off than before - it
             * simply stays stopped, which is what it was already doing.
             */
            Artisan::call('queue:restart');
        } catch (Throwable) {
            // A signal that could not be sent leaves the worker where it was,
            // and the dashboard says so.
        }

        try {
            /*
             * Config, so the settings are read fresh, and routes, so the
             * arranger's endpoint exists. Views and events come along with it.
             *
             * This is the step whose absence looked like the settings resetting:
             * an update replaces the plugin's files while the panel is holding a
             * cached config that no longer describes it, and every setting then
             * falls back to the default in its own accessor - the style to
             * Ember, the accent to orange - while .env still holds what was
             * actually chosen.
             */
            Artisan::call('optimize:clear');
        } catch (Throwable) {
            // A cache that could not be cleared is not worth failing an install
            // over - `php artisan optimize:clear` by hand fixes it.
        }

        try {
            /*
             * In this process, at the end of it. Not on the queue.
             *
             * It was a job delayed by thirty seconds, and the queue turned out
             * to be the worst place for it. A worker is a long-lived process
             * that registers a plugin's PSR-4 prefix once, when it boots - and
             * PluginService skips that registration entirely for a plugin it
             * considers incompatible or whose manifest it could not read. A
             * worker that started while this plugin was in either state has no
             * mapping for LegendDevelopment\Theme\Jobs\* and cannot get one
             * without restarting, so every dispatch unserialises into an
             * __PHP_Incomplete_Class and fails. Which is precisely when this job
             * is needed: right after an install, when the plugin has just been
             * replaced on disk.
             *
             * terminating() runs after the response has been sent - so after
             * installPlugin() has finished deciding the status, which is the
             * moment the thirty seconds were guessing at - and it runs here,
             * where every class is already loaded. Nothing is serialised, so
             * there is nothing to fail to unserialise.
             */
            app()->terminating(static function (): void {
                try {
                    app(EnsureEnabled::class)->handle(app(PluginService::class));
                } catch (Throwable) {
                    // Same as below: the Enable button on Admin -> Plugins is
                    // the manual way back, and this is not worth a failed
                    // install.
                }
            });
        } catch (Throwable) {
            // Nothing to switch it back on, which is the Enable button on
            // Admin -> Plugins - not a failed install.
        }

        try {
            /*
             * An update replaces this plugin's code, and the queue workers that
             * just ran it are long-lived processes: PHP reads a class file once
             * per process, so they keep the version they started with. Without
             * this, the *next* update runs the seeder from the version being
             * replaced - and anything fixed here would never take effect.
             *
             * The same reason Laravel wants queue:restart after any deploy.
             *
             * This is as far as a plugin can go, and the limit is worth writing
             * down because it looks like something is missing. `queue:restart`
             * does not restart anything: it writes a timestamp to the cache, and
             * a worker checks that between jobs and exits when it sees a newer
             * one. Bringing it back up is the supervisor's job - systemd,
             * supervisord, whatever is running it.
             *
             * So a unit without `Restart=always` turns this into a worker that
             * stops after an install and never returns, which is worse than not
             * signalling at all and is invisible until the next thing that
             * needed a queue quietly does not happen.
             *
             * Running `systemctl restart` from here is not an option and should
             * not be: it needs a shell call, the panel runs as a web user
             * without the rights, and Pelican Hub refuses any plugin that so
             * much as names those functions. Recording the outcome is what can
             * be done, so that a worker that never came back is visible - which
             * is what the probe underneath is for. It asks the queue to run one
             * of this plugin's jobs; if nothing answers, the dashboard says so
             * rather than leaving it to be worked out from an update that never
             * arrived.
             */
            Artisan::call('queue:restart');

            Workers::probe();
        } catch (Throwable) {
            // Same as above: worth the panel saying nothing about.
        }
    }
}
