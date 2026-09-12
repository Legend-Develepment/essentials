<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * This migration exists for its down(), and for nothing else.
 *
 * The shop's five tables are made at install, by Support\Shop\Tables::install()
 * through the seeder - the same rule the API keys table follows and for the
 * same reason, written at length on the migration beside this one: a seeder
 * runs on every install and asks the database what is there, while a
 * migration's up() is recorded once and then trusted, and the day the record
 * and the database disagree there is no way back.
 *
 * Dropped in reverse dependency order, because MySQL will not drop a table
 * another one still points at.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Nothing. The tables are made at install - see the note above and
        // Support\Shop\Tables::install(). The record of this migration having
        // run is what makes the rollback below happen at uninstall.
    }

    /**
     * Uninstalling takes the shop with it.
     *
     * rollbackPluginMigrations() is the first thing Pelican's uninstallPlugin()
     * does, and it is the only hook there is. So this is the one place that can
     * clean up after the plugin - which means **removing the plugin removes
     * every package, order, invoice and payment record**. The servers those
     * orders made are Pelican's and stay exactly where they are.
     */
    public function down(): void
    {
        foreach ([
            // The basket's pairing table first: it points at two of the tables
            // below it, and MySQL will not drop a table another one still
            // references.
            'essentials_customers',
            'essentials_invoice_orders',
            'essentials_payments',
            'essentials_invoices',
            'essentials_orders',
            'essentials_coupons',
            'essentials_packages',
        ] as $table) {
            try {
                Schema::dropIfExists($table);
            } catch (Throwable) {
                // A table left behind is tidied by hand. A plugin that cannot
                // be uninstalled is somebody's afternoon.
            }
        }
    }
};
