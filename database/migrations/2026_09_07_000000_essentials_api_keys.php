<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Throwable;

/**
 * The first table this plugin has ever owned.
 *
 * Ninety-four dev cycles without one, and every one of those was right:
 * favourites, per-user layouts, per-user styles and the watchdog's state are
 * files under storage, which need no migration and cannot half-run. See
 * roadmap/api.md for the argument in full - in short, three things about an API
 * key are true that were true of none of those:
 *
 *  1. **Two people can ask at the same time.** A shared index file has a
 *     lost-update race, and a file per person cannot answer "whose key is this"
 *     without reading every file on the disk - which is what a request does on
 *     the way in, every time.
 *  2. **Revocation has to be certain.** A file write that quietly failed is a
 *     key that still works, and nothing would say so.
 *  3. **An administrator has to be able to list them.** A table is a list; a
 *     directory is a scan.
 *
 * One table rather than two, holding a key and the request that becomes one.
 * They are the same row at different points in its life, and a separate
 * requests table would mean the administrator's page is a join of two lists
 * that must never disagree about who asked for what.
 *
 * The secret is not in here. `token` is a SHA-256 of what was handed out and
 * `prefix` is the public half - enough to find the row and show it in a list,
 * never enough to use it. A panel whose database leaks leaks no working key.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('essentials_api_keys', function (Blueprint $table) {
            $table->id();

            /*
             * Every key belongs to somebody, including one an administrator
             * makes for a bot: a key with no owner is a key nobody is
             * answerable for, and the person who made it is the honest answer
             * to who that is. Cascading, because a key outliving its account is
             * a key nothing can revoke through the panel.
             */
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('name');

            /*
             * 'person' answers only for its owner and is scoped by
             * accessibleServers() on every request; 'panel' answers the
             * panel-wide questions and may only be issued by somebody holding
             * the permission to do so. A key cannot change scope - a wider one
             * is a new key, so that widening is an act with a date on it.
             */
            $table->string('scope')->default('person');

            // pending -> active, or pending -> refused, or active -> revoked.
            $table->string('state')->default('pending');

            /*
             * The public half. Unique and indexed because it is what a request
             * arrives carrying: the row is found by this and only then is the
             * hash compared, so verifying a key is one indexed read rather than
             * a walk through every row hashing as it goes.
             */
            $table->string('prefix', 16)->unique();

            // SHA-256 hex of the whole key. Null while a request is pending,
            // because a key that has not been granted has not been generated.
            $table->string('token', 64)->nullable()->unique();

            // What they asked for it for, and what they were told if refused.
            $table->text('reason')->nullable();
            $table->text('answer')->nullable();

            $table->json('allowed_ips')->nullable();

            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamp('decided_at')->nullable();
            $table->foreignId('decided_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            // The administrator's page opens on what is waiting, and a panel
            // with four hundred keys should not sort them in PHP to find three.
            $table->index(['state', 'created_at']);
        });
    }

    /**
     * Dropped on uninstall, which is the one hook Pelican runs when a plugin is
     * removed - rollbackPluginMigrations() is the first thing uninstallPlugin()
     * does. So **removing the plugin revokes every key**, which is the right
     * behaviour and is said on the page rather than left to be discovered.
     */
    public function down(): void
    {
        try {
            Schema::dropIfExists('essentials_api_keys');
        } catch (Throwable) {
            // Never let this stand in the way of removing the plugin. A table
            // left behind is tidied by hand; a plugin that cannot be uninstalled
            // is somebody's afternoon.
        }
    }
};
