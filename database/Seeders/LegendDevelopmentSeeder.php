<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Throwable;

/**
 * Clears the panel's caches at the end of installing this plugin.
 *
 * Pelican looks for a seeder named after the plugin - Str::studly() of the name
 * in plugin.json, so "Legend Development" becomes LegendDevelopment - and runs
 * it as the last step of an install. Renaming the plugin means renaming this
 * class with it, or the step is silently skipped.
 *
 * A seeder rather than only a migration because it runs on *every* install: a
 * migration's up() is recorded and would not run again on a reinstall.
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
    }
}
