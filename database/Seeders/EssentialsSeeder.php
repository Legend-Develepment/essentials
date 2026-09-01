<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LegendDevelopment\Theme\Support\InstallTasks;

/**
 * The seeder Pelican actually looks for.
 *
 * It resolves the class from the plugin's *name*, not its id:
 * Plugin::getSeeder() is Str::studly($this->name) . 'Seeder', and if that class
 * does not exist it returns null and the step is skipped **without a word**.
 *
 * That is exactly what happened. The plugin was renamed in 2.29.0, the seeder
 * was still called LegendDevelopmentSeeder, and from that release until 2.44.3
 * nothing ran at the end of an install - no cache clear, no re-enable, no queue
 * restart. It looked like the settings resetting themselves on every update.
 *
 * So: **renaming this plugin means renaming this file to match.** It has now
 * been done twice - LegendDevelopmentSeeder, then PelicanEssentialsSeeder, now
 * this - and each time the rename was the whole of the work. The first one is
 * kept beside this file rather than deleted, because a panel rolling back to a
 * release carrying that name needs it, and an extra file costs nothing next to
 * a step that fails without saying so.
 */
class EssentialsSeeder extends Seeder
{
    public function run(): void
    {
        InstallTasks::run();
    }
}
