<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

/**
 * A copy of what uninstalling this plugin destroys.
 *
 * Pelican calls rollbackPluginMigrations() as the first thing uninstallPlugin()
 * does, and there is no page of ours in between - no confirmation, no "are you
 * sure", no chance to keep anything. What goes is every package, order,
 * invoice, payment and ticket the panel ever wrote. For anybody selling
 * something, that is the accounting.
 *
 * So the copy has to be taken **before**, which means it has to be somewhere
 * somebody finds before they think about removing the plugin. It is on the
 * plugin's own page, beside the settings export that was already there.
 *
 * Streamed rather than built. A panel with ten thousand invoices should not
 * need ten thousand invoices' worth of memory to write them out, and this runs
 * on the same request that serves the download - so the rows go out in batches
 * of five hundred and nothing is held.
 *
 * **Two tables are deliberately left out.** essentials_api_keys holds the keys
 * themselves and essentials_connections names which key a Discord account is
 * using. A credential written into a file somebody downloads is a credential in
 * a file, and neither is worth keeping anyway: a key cannot be restored from an
 * export, only issued again. Both are named in the file rather than quietly
 * missing from it.
 */
class Records
{
    /**
     * Everything the teardown destroys that is a record rather than a setting.
     *
     * Settings have their own export - see Portable, which reads .env and not
     * the database. These are the rows: what was sold, to whom, for how much,
     * and what was said about it.
     *
     * @var array<int, string>
     */
    public const TABLES = [
        'essentials_packages',
        'essentials_addons',
        'essentials_coupons',
        'essentials_customers',
        'essentials_orders',
        'essentials_order_addons',
        'essentials_upgrades',
        'essentials_invoices',
        'essentials_invoice_orders',
        'essentials_payments',
        'essentials_credit',
        'essentials_waitlist',
        'essentials_tickets',
        'essentials_ticket_messages',
    ];

    /**
     * And what is left out on purpose, said out loud in the file.
     *
     * @var array<int, string>
     */
    public const SECRET = [
        'essentials_api_keys',
        'essentials_connections',
    ];

    /** How many rows go out at a time, so nothing is ever all in memory. */
    private const BATCH = 500;

    /**
     * Whether there is anything to take a copy of.
     *
     * A panel that never switched the shop on has none of these tables, and a
     * button that downloads an empty file is a button that looks broken.
     */
    public static function has(): bool
    {
        try {
            foreach (self::TABLES as $table) {
                if (Schema::hasTable($table) && DB::table($table)->exists()) {
                    return true;
                }
            }
        } catch (Throwable) {
            // A database that will not answer is not something to offer.
        }

        return false;
    }

    /** Dated, because the point of one is having an older one. */
    public static function filename(): string
    {
        return Theme::id() . '-records-' . now()->format('Y-m-d-His') . '.json';
    }

    /**
     * The whole thing, written straight to the response.
     *
     * The JSON is assembled by hand rather than encoded at the end, which is
     * the only way to stream it: json_encode() of the whole export would build
     * exactly the thing this exists to avoid. Each row is still encoded by
     * json_encode(), so nothing here is escaping anything itself.
     */
    public static function stream(): void
    {
        echo '{"plugin":' . self::json(Theme::name())
            . ',"at":' . self::json(now()->toIso8601String())
            . ',"left_out":' . self::json(self::SECRET)
            . ',"tables":{';

        $first = true;

        foreach (self::TABLES as $table) {
            try {
                if (!Schema::hasTable($table)) {
                    continue;
                }
            } catch (Throwable) {
                continue;
            }

            echo ($first ? '' : ',') . self::json($table) . ':[';

            $first = false;

            self::rows($table);

            echo ']';
        }

        echo '}}';
    }

    /**
     * One table, in batches, oldest first.
     *
     * Ordered by id because chunk() needs an order to page by, and because a
     * file somebody compares against last month's should not reshuffle itself
     * between two exports of the same rows.
     */
    private static function rows(string $table): void
    {
        $first = true;

        try {
            DB::table($table)->orderBy('id')->chunk(self::BATCH, static function ($rows) use (&$first): void {
                foreach ($rows as $row) {
                    echo ($first ? '' : ',') . self::json($row);

                    $first = false;
                }

                /*
                 * Out to the browser now rather than at the end. Without this
                 * the whole export sits in PHP's output buffer, which is the
                 * same memory the batching was for.
                 */
                if (ob_get_level() > 0) {
                    ob_flush();
                }

                flush();
            });
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /** Encoded the way the rest of this plugin encodes, so a file reads the same. */
    private static function json(mixed $value): string
    {
        return (string) json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
