<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

/**
 * This migration exists for its down(), which is the only hook Pelican runs when
 * a plugin is uninstalled: rollbackPluginMigrations() is the first thing
 * uninstallPlugin() does, before the files are removed.
 *
 * Installing is handled by the seeder instead, because that one runs on every
 * install while a migration's up() is recorded and would be skipped the second
 * time around.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Nothing to migrate. The record of this migration having run is what
        // makes the rollback below happen at uninstall.
    }

    public function down(): void
    {
        try {
            Artisan::call('optimize:clear');
        } catch (Throwable) {
            // Never let a cache clear stand in the way of removing the plugin.
        }
    }
};
