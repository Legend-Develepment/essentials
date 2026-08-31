<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Artisan;
use LegendDevelopment\Theme\Jobs\EnsureEnabled;
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
    public static function run(): void
    {
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
            // Not now: PluginService decides what to do with the status after
            // the seeder returns, and on an update that decision is to disable.
            // Half a minute puts this behind the rest of the install without
            // leaving the panel unstyled long enough to notice.
            EnsureEnabled::dispatch()->delay(now()->addSeconds(30));
        } catch (Throwable) {
            // Without a queue there is nothing to switch it back on, which is
            // the Enable button on Admin -> Plugins - not a failed install.
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
             */
            Artisan::call('queue:restart');
        } catch (Throwable) {
            // Same as above: worth the panel saying nothing about.
        }
    }
}
