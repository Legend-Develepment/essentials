<?php

namespace LegendDevelopment\Theme\Support;

use App\Services\Helpers\PluginService;
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
             */
            Artisan::call('queue:restart');
        } catch (Throwable) {
            // Same as above: worth the panel saying nothing about.
        }
    }
}
