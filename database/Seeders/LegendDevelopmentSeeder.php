<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use LegendDevelopment\Theme\Jobs\EnsureEnabled;
use Throwable;

/**
 * Runs at the end of installing or updating this plugin.
 *
 * Pelican looks for a seeder named after the plugin - Str::studly() of the name
 * in plugin.json, so "Legend Development" becomes LegendDevelopment - and runs
 * it as the last step of an install. Renaming the plugin means renaming this
 * class with it, or the step is silently skipped.
 *
 * A seeder rather than only a migration because it runs on *every* install: a
 * migration's up() is recorded and would not run again on a reinstall. That also
 * makes it the one piece of a new version that runs no matter which button
 * started the update.
 */
class LegendDevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Config, so the theme's settings are read fresh, and routes, so the
            // arranger's endpoint exists. Views and events come along with it.
            Artisan::call('optimize:clear');
        } catch (Throwable) {
            // A cache that could not be cleared is not worth failing an install
            // over - `php artisan optimize:clear` by hand fixes it.
        }

        try {
            // Not now: PluginService decides what to do with the status after
            // this seeder returns, and on an update that decision is to disable.
            // Half a minute puts this behind the rest of the install without
            // leaving the panel unstyled long enough to notice.
            EnsureEnabled::dispatch()->delay(now()->addSeconds(30));
        } catch (Throwable) {
            // Without a queue there is nothing to switch it back on, which is
            // the Enable button on Admin -> Plugins - not a failed install.
        }

        try {
            // An update replaces this plugin's code, and the queue workers that
            // just ran it are long-lived processes: PHP reads a class file once
            // per process, so they keep the version they started with. Without
            // this, the *next* update runs the seeder from the version being
            // replaced - and anything fixed here would never take effect.
            //
            // The same reason Laravel wants queue:restart after any deploy. The
            // workers exit once the current job is done and come back up under
            // whatever supervises them.
            Artisan::call('queue:restart');
        } catch (Throwable) {
            // Same as above: worth the panel saying nothing about.
        }
    }
}
