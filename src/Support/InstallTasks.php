<?php

namespace LegendDevelopment\Theme\Support;

use App\Services\Helpers\PluginService;
use Illuminate\Support\Facades\Artisan;
use LegendDevelopment\Theme\Jobs\EnsureEnabled;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Shop\Tables;
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
     * Where the answer to "what should this panel offer" is written down.
     *
     * Deliberately not in config/essentials.php. Nothing reads it on a request,
     * only the install below reads it, and a key in the config is a key the
     * settings form would eventually write over.
     */
    private const CHOSEN = 'LEGEND_THEME_MODULES_CHOSEN';

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
     *
     * **This plugin's version, and it used to be the panel's.** Versions::installed()
     * answers currentPanelVersion(), which is Pelican's number and changes when
     * somebody upgrades Pelican. Keyed on that, this ran once and then never
     * again however many releases of this plugin went by - so every column a
     * later release added arrived only if the cache happened to be lost. It was
     * found by widening essentials_invoices.state, watching four releases go
     * past, and asking the database what the column actually was: still the old
     * width, on a panel that had installed every one of them.
     */
    public static function schema(): void
    {
        try {
            $version = trim(Installed::version());

            if ($version === '' || $version === '?' || $version === '0.0.0') {
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
             *
             * Through Modules::arrive() rather than by name, so a panel with
             * the support desk switched off does not get its tables made here
             * either - the same rule as at the end of an install.
             */
            try {
                /*
                 * Asked first here too, and for the same reason as in run().
                 *
                 * This is the other door into the same room: on a fresh panel
                 * the first boot of a new version reaches this before anything
                 * has been asked, the list of what is off is still empty, every
                 * module reads as on, and the tables of the four quiet ones get
                 * made for a panel that is about to be told it has none of
                 * them. firstChoice() returns on the spot once the answer is
                 * written, so on every boot after the first it costs one read
                 * of a file that is already in the page cache.
                 */
                self::firstChoice();
            } catch (Throwable) {
                // A panel that could not be asked still gets its tables. That
                // is the behaviour every release before the modules had, and
                // run() asks again a moment later.
            }

            Modules::arrive(thorough: true);

            /*
             * And the uploaded translations an earlier release kept in
             * lang/vendor, where Pelican listed them as a language called
             * Vendor. Here for the reason this whole method exists: the install
             * that brings the new place runs the old code, so it is the first
             * boot of the new version that knows where they now go.
             */
            Translations::relocate();

            cache()->put(self::SEEN, $version, now()->addYear());
        } catch (Throwable) {
            // A database or a cache that will not answer leaves the columns as
            // they are, and every reader of them copes with one being absent.
        }
    }

    /**
     * Whether an old key in .env says no, read from the file.
     *
     * Not through the config, and the difference is not theoretical. This runs
     * during an install, and an install can be performed by the queue worker -
     * one process, hours old, holding the configuration it booted with. Asked
     * through config(), a key written an hour ago reads as whatever it was when
     * that worker started, so a carry-over that has already happened happens
     * again, against a list that is also an hour out of date.
     *
     * That is not a story: it is what took a panel's page-arranger setting
     * twice in one night. The file is the only answer that cannot be stale.
     */
    private static function saidNo(string $key): bool
    {
        return self::said($key) === 'false';
    }

    /**
     * What .env says about one key, or null where it says nothing.
     *
     * Read off the file rather than out of the configuration, for the reason
     * firstChoice() gives at length: an install performed by a queue worker is
     * running against a copy of the configuration that booted hours ago, and
     * the file is the only answer that cannot be stale.
     *
     * Lowercased and trimmed, because a carry-over asks about values people
     * typed ('false', 'off') rather than values a program wrote.
     */
    private static function said(string $key): ?string
    {
        try {
            $path = app()->environmentFilePath();

            if (!is_readable($path)) {
                return null;
            }

            $text = (string) file_get_contents($path);

            if (preg_match('~^\s*' . preg_quote($key, '~') . '\s*=\s*"?([^"
]*)"?~m', $text, $found) !== 1) {
                // No line at all: nothing was ever said.
                return null;
            }

            return strtolower(trim($found[1]));
        } catch (Throwable) {
            // Not knowing is not a reason to change somebody's settings.
            return null;
        }
    }

    /**
     * Decide once, at the first install, what this panel offers.
     *
     * Everything arrives switched on, and that is on purpose: the stored list
     * says what is *off*, so a feature added in a later release turns up rather
     * than staying invisible. It is the right rule for a panel that updates and
     * the wrong one for a panel meeting this plugin for the first time, and the
     * two were never told apart. Somebody who wanted a nicer looking panel got a
     * webshop, a ticket desk, an API and a watchdog sending mail, on a machine
     * with customers on it.
     *
     * They are told apart by writing the answer down. A panel that has been
     * asked has this key; one that has not, has not, and the empty list stops
     * meaning two different things.
     *
     * **Read from the file, not from env().** Laravel does not load .env at all
     * when the config is cached, so env() answers null on exactly the panels
     * that have been running longest - and a null here reads as "never been
     * asked", which would switch four modules off under somebody who has been
     * selling through them for a year. The file is the only answer that cannot
     * be stale.
     *
     * **An existing panel keeps what it has.** The only thing written there is
     * the key itself, with the list put back exactly as it was found.
     *
     * **And a panel running the modules is an existing panel**, even when its
     * .env says nothing of this plugin's. The modules read
     * LEGEND_THEME_FEATURES_OFF until they have saved switches of their own, so
     * the quiet start written here switched their shop, support desk, API and
     * watchdog off. Measured on a test panel running every module: installing
     * this plugin took twelve of their pages away, and removing it again did
     * not bring them back.
     */
    private static function firstChoice(): void
    {
        $path = app()->environmentFilePath();

        if (!is_readable($path)) {
            return;
        }

        $text = (string) file_get_contents($path);

        // Nothing readable is not evidence of a fresh panel. Leave it alone.
        if (trim($text) === '') {
            return;
        }

        if (preg_match('~^\s*' . self::CHOSEN . '\s*=~m', $text) === 1) {
            return;
        }

        $used = preg_match('~^\s*LEGEND_THEME_~m', $text) === 1 || self::modulesInstalled();

        Settings::persistFeatures(
            $used
                ? Features::withMany([])
                : Features::withMany(array_fill_keys(Modules::quietStart(), false)),
            Installed::version(),
            !$used,
        );
    }

    /**
     * Whether any Essentials module is on this panel, switched on or not.
     *
     * By folder rather than by plugin row, the way the migrations decide which
     * tables are a module's: a module that is switched off still reads the same
     * .env the moment it is switched back on.
     */
    private static function modulesInstalled(): bool
    {
        return (glob(base_path('plugins/essentials-*'), GLOB_ONLYDIR) ?: []) !== [];
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
            /*
             * The console had two off switches and this is the one that goes.
             *
             * 'off' was a third choice in the server controls dropdown next to
             * Features::CONSOLE, so switching the console off worked in two
             * places and switching it on in one of them did nothing. The mode
             * now says how the controls look; whether there are any is the
             * feature, and only the feature.
             *
             * A panel that had picked 'off' keeps having it off: the answer is
             * moved into the feature and the mode put back to what it means
             * when there is nothing to hide, which is 'full'.
             */
            if (self::said('LEGEND_THEME_SERVER_CONTROLS') === 'off') {
                Features::disable(Features::CONSOLE);

                Settings::clearOldSwitch('LEGEND_THEME_SERVER_CONTROLS', ServerControls::FULL);
            }

            /*
             * And owner alerts, the same shape with the opposite default.
             *
             * alert_owners sat beside Features::OWNER_ALERTS and was off unless
             * somebody said otherwise, so a panel with the feature on and the
             * switch untouched was sending nothing. Dropping the switch without
             * carrying that over would start sending on every such panel at
             * once, which is the loudest possible way to be wrong.
             *
             * So anything that is not an explicit yes becomes off. A panel that
             * never said anything was not sending these, and does not start.
             */
            if (self::said('LEGEND_THEME_ALERT_OWNERS') !== null) {
                if (self::said('LEGEND_THEME_ALERT_OWNERS') !== 'true') {
                    Features::disable(Features::OWNER_ALERTS);
                }

                Settings::clearOldSwitch('LEGEND_THEME_ALERT_OWNERS');
            }

            if (self::saidNo('LEGEND_THEME_ARRANGER')) {
                Features::disable(Features::ARRANGER);

                /*
                 * And cross out the old key, so this never runs again.
                 *
                 * One key rather than the whole settings block. Writing the
                 * block meant reading a hundred settings out of whatever
                 * configuration this process held and putting them all back,
                 * which during an install performed by the queue worker is an
                 * hour-old copy - and the first thing it undid was the line
                 * above it.
                 */
                Settings::clearOldSwitch('LEGEND_THEME_ARRANGER');
            }

            /*
             * And nothing writes it back any more.
             *
             * It did. persist() wrote LEGEND_THEME_ARRANGER on every save, from
             * a Settings::data() entry that existed for no other reason, while
             * Theme::arrangerEnabled() had already stopped reading it. So the
             * key this carry-over crosses out came straight back, and with it
             * the chance of the whole thing running a second time.
             *
             * Worse than untidy, because of how it came back: persist() read
             * `$data['arranger'] ?? false`. A caller that did not hand it the
             * stored settings wrote **false** into that key while the feature
             * was on, and the next install read that as "this panel said no"
             * and switched the arranger off. Nothing does that now - see
             * tools/check-persist.js - and the key is gone as well, which is
             * the half that cannot come loose again.
             */

            /*
             * The GitHub token the old dev channel downloaded builds with.
             *
             * Up to 3.225 this plugin fetched and installed its own releases,
             * and a development panel kept a token for the private repository
             * here. Releases come from Pelican Hub now and nothing reads it, so
             * the credential is blanked rather than left lying in .env. The
             * other channel settings are simply no longer read.
             */
            if ((string) self::said('LEGEND_THEME_DEV_TOKEN') !== '') {
                Settings::clearOldSwitch('LEGEND_THEME_DEV_TOKEN', '');
            }
        } catch (Throwable) {
            // A carry-over that could not run leaves the old key in place, so
            // the next install tries again. Nothing is lost by it failing.
        }

        /*
         * Asked before anything is built for the answer.
         *
         * This ran after the tables, and that was the whole feature undone: on
         * a fresh panel the list of what is off is still empty when the tables
         * are made, so every module reads as on and the shop's five tables, the
         * support desk's two and the API's were created on a panel that was
         * about to be told it had none of them. The four quiet modules were
         * switched off a moment later and nothing dropped the tables again.
         */
        try {
            self::firstChoice();
        } catch (Throwable) {
            // A panel that could not be asked keeps everything it had, which is
            // the behaviour every release before this one had. The next install
            // tries again, because nothing was written down.
        }

        try {
            /*
             * And then the tables, for the modules that are on.
             *
             * This used to make all of them on every panel: the shop's five,
             * the support desk's two and the API's, whether or not anybody had
             * asked for a shop. That was defensible while everything arrived
             * switched on, and stopped being defensible the moment a fresh
             * install started with four modules off.
             *
             * After the answer above, so "the modules that are on" means what
             * this panel was actually set up with rather than the everything it
             * reads as before anybody has said otherwise.
             *
             * Nothing is dropped for a module that is off. A panel that has
             * been selling for a year and switches the shop off keeps every
             * order it ever took, and switching it back on finds them there.
             */
            Modules::arrive(thorough: true);
        } catch (Throwable) {
            // An install is not failed over one module's tables. Each page asks
            // whether its own are there before it offers itself, so the honest
            // outcome is that part is not offered yet - and the next save or
            // the next install tries again.
        }

        /*
         * Pelican's own strings where its translation stops, written against
         * the Pelican that is here. refresh() compares what they were last
         * written against and reports its own failures, so an install that
         * finds them current costs one small read.
         */
        PelicanStrings::refresh();

        // And anything uploaded that is still in lang/vendor, for a panel where
        // the move in schema() could not finish. It reports its own failures.
        Translations::relocate();

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
             * And forget that the schema pass has run.
             *
             * This method is the install, and an install happens in a process
             * that loaded this plugin before the files were swapped: the
             * Tables::upgrade() reachable from here is the *previous* release's,
             * which knows nothing about the columns the new one adds. If that
             * process also writes down the new version as done, the pass never
             * runs with the code that has the new steps in it.
             *
             * Clearing the mark instead means the next request - a fresh
             * process, new classes - finds nothing recorded, does the work, and
             * records it then. One extra schema pass per release, on one
             * request, which is what it was supposed to cost all along.
             */
            cache()->forget(self::SEEN);
        } catch (Throwable) {
            // A cache that will not answer runs the pass again next boot, which
            // is the safe direction: both upgrades ask the database what it has.
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
             * without the rights, and a plugin has no business running commands
             * on the panel host. Recording the outcome is what can
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
