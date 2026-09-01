<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LegendDevelopment\Theme\Support\InstallTasks;

/**
 * The seeder for the plugin's former name, kept beside the current one.
 *
 * Pelican picks a seeder by Str::studly() of the name in plugin.json, so this
 * one is what "Legend Development" resolved to. The plugin is called Pelican
 * Essentials now and EssentialsSeeder is the one that runs - see the note
 * there for what it cost to find that out.
 *
 * Kept rather than deleted: a panel rolling back to a release that still carries
 * the old name needs this file to exist, and only one of the two is ever called.
 */
class LegendDevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        InstallTasks::run();
    }
}
