<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * This migration exists for its down(), and for nothing else.
 *
 * The tables are made at install, by the install tasks through the seeder - the
 * same rule the API keys table follows and for the same reason, written at
 * length on the migration beside this one: a seeder runs on every install and
 * asks the database what is there, while a migration's up() is recorded once
 * and then trusted, and the day the record and the database disagree there is
 * no way back.
 *
 * **This is the whole teardown, not the shop's.** It is dated last, so Pelican
 * rolls it back first, and it drops every table the plugin owns - the shop's
 * twelve, the support desk's two, and the API's two. The one beside it keeps
 * its own dropIfExists as a backstop for a panel old enough never to have
 * recorded this file; after this has run, that one finds nothing and says so.
 *
 * It said "the shop's five tables" and listed seven, while the plugin had
 * grown to sixteen. That is not untidiness, it is a failed uninstall: four of
 * the nine it forgot hold foreign keys into tables it does drop, so MySQL
 * refuses the drop, the refusal lands in the catch below, and the panel is
 * left with half a shop and no way to remove the rest. tools/check-teardown.js
 * exists so the list cannot fall behind the code again.
 *
 * Children first, because MySQL will not drop a table another one still points
 * at, and the order below is checked against the foreign keys in the code.
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
     * Uninstalling takes everything this plugin wrote down with it.
     *
     * rollbackPluginMigrations() is the first thing Pelican's uninstallPlugin()
     * does, and it is the only hook there is. So this is the one place that can
     * clean up after the plugin - which means **removing the plugin removes
     * every package, order, invoice, payment, ticket and API key**. The servers
     * those orders made are Pelican's and stay exactly where they are.
     *
     * There is no confirmation step here and there cannot be one: Pelican calls
     * this, not a page of ours. The settings export is the way to keep a copy,
     * and the plugin's own page says so before it comes to this.
     */
    public function down(): void
    {
        foreach ([
            // A message belongs to a ticket.
            'essentials_ticket_messages',

            // And a ticket can name the order it is about.
            'essentials_tickets',

            // Everything hanging off an order or an invoice.
            'essentials_order_addons',
            'essentials_upgrades',
            'essentials_credit',
            'essentials_invoice_orders',
            'essentials_payments',
            'essentials_waitlist',

            // Then the two that point at each other's way: an invoice names its
            // first order, an order names its package.
            'essentials_invoices',
            'essentials_orders',

            // What an add-on and a package are.
            'essentials_addons',
            'essentials_packages',

            // And the four nothing here points at.
            'essentials_coupons',
            'essentials_customers',
            'essentials_connections',
            // Before the keys it points at, which is the whole reason the
            // order in this list is checked rather than trusted.
            'essentials_api_writes',
            'essentials_api_keys',
        ] as $table) {
            if (self::keptByModule($table)) {
                continue;
            }

            try {
                Schema::dropIfExists($table);
            } catch (Throwable) {
                // A table left behind is tidied by hand. A plugin that cannot
                // be uninstalled is somebody's afternoon.
            }
        }
    }

    /**
     * Whether a table now belongs to a separate Essentials module.
     *
     * The shop, the support desk and the API were split out of this plugin into
     * essentials-shop, essentials-support and essentials-api, and those modules
     * took these tables over by name. Pelican's uninstall rolls back this
     * plugin's migrations whether or not a module is using the tables, so
     * without this, removing the legacy plugin from a panel that runs the
     * modules deletes every order, invoice, ticket and API key they hold. That
     * happened on a live panel on 2026-09-28.
     *
     * A module whose directory is under plugins/ keeps its tables, installed or
     * not: a module that is switched off or not yet installed still owns what
     * it will read the moment it is.
     */
    private static function keptByModule(string $table): bool
    {
        $owner = match (true) {
            in_array($table, ['essentials_tickets', 'essentials_ticket_messages'], true) => 'essentials-support',
            in_array($table, ['essentials_api_keys', 'essentials_api_writes', 'essentials_connections'], true) => 'essentials-api',
            default => 'essentials-shop',
        };

        return is_dir(base_path('plugins/' . $owner));
    }

};
