<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * This migration exists for its down(), and for nothing else.
 *
 * The table is made at install, by Support\Api\Keys::install() through the
 * seeder. That is this plugin's own rule and it is written on the migration
 * beside this one: **installing is the seeder's work, because a seeder runs on
 * every install while a migration's up() is recorded and skipped the second
 * time round.**
 *
 * This file used to make the table, and ignoring that rule cost three broken
 * releases in one day. Worth writing down, because each fault hid the next:
 *
 *  1. `use Throwable;` in a file with no namespace. PHP calls that a use
 *     statement with no effect, and Pelican reports it as "Could not run
 *     migrations" - so the file never even loaded.
 *  2. A foreign key declared with the helper that picks its own width, against
 *     a users table created with `increments`. MySQL refuses a key between two
 *     widths with nothing but "errno: 150".
 *  3. And then the state that made it unrecoverable. MariaDB does not roll back
 *     DDL, so the CREATE that succeeded before the ALTER that failed left the
 *     table standing with the migration unrecorded. Every retry after that died
 *     on "table already exists" - a message about the retry rather than about
 *     the fault, on a panel that could no longer install the plugin at all,
 *     whatever version it was handed.
 *
 * The third is the one that mattered, and none of the first two fixes reached
 * it. A migration is bookkeeping: it runs once, it records that it ran, and
 * when the record and the database disagree there is no way back. An install
 * task asks the database what is actually there, every time, so there is no
 * such state to be in. That is the whole reason the rule exists, and it was
 * already written down before any of this.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Nothing. The table is made at install - see the note above and
        // Support\Api\Keys::install(). The record of this migration having run
        // is what makes the rollback below happen at uninstall.
    }

    /**
     * Uninstalling takes the keys with it.
     *
     * rollbackPluginMigrations() is the first thing Pelican's uninstallPlugin()
     * does, and it is the only hook there is. So this is the one place that can
     * clean up after the plugin, which means **removing the plugin revokes
     * every key** - said on the page rather than left to be discovered.
     */
    public function down(): void
    {
        try {
            Schema::dropIfExists('essentials_api_keys');
        } catch (Throwable) {
            // A table left behind is tidied by hand. A plugin that cannot be
            // uninstalled is somebody's afternoon.
        }
    }
};
