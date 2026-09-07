<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Models\Payment;
use Throwable;

/**
 * The five tables the shop owns, made at install and asked about on every
 * request.
 *
 * **Not migrations, and that is this plugin's own rule.** The migration beside
 * Api\Keys::install() has said so since it was written: installing is the
 * seeder's work, because a seeder runs on every install while a migration's
 * up() is recorded and skipped the second time round. A migration that half
 * ran once cost three broken releases in a day; an install task asks the
 * database what is there and cannot end up in a state it cannot talk itself
 * out of.
 *
 * All five are made in the first release of the shop, including the three the
 * first release does not yet write to. A table added later is a table some
 * panel is missing, and "is it there" is a question every page would then
 * have to ask per table rather than once.
 *
 * **Every key into one of Pelican's tables is `unsignedInteger`.** Its users,
 * servers and eggs tables are `increments` - four bytes - and MySQL refuses a
 * foreign key between two widths with nothing but "errno: 150". Keys between
 * the shop's own tables are `unsignedBigInteger`, because these use id().
 *
 * A table already there is left exactly as it is. It holds orders people paid
 * for, and this is not the place to decide anything about them.
 */
class Tables
{
    /** In dependency order, so dropping runs it backwards. */
    public const ALL = [
        Package::TABLE,
        Coupon::TABLE,
        Order::TABLE,
        Invoice::TABLE,
        Payment::TABLE,
    ];

    private static ?bool $ready = null;

    /**
     * Whether every table exists - asked once per request, because every shop
     * page and the public route ask it before they draw anything.
     */
    public static function ready(): bool
    {
        if (self::$ready !== null) {
            return self::$ready;
        }

        try {
            foreach (self::ALL as $table) {
                if (!Schema::hasTable($table)) {
                    return self::$ready = false;
                }
            }

            return self::$ready = true;
        } catch (Throwable) {
            // A database that will not answer is a shop that is not offered,
            // not a panel that will not draw.
            return self::$ready = false;
        }
    }

    public static function forget(): void
    {
        self::$ready = null;
    }

    public static function install(): void
    {
        self::packages();
        self::coupons();
        self::orders();
        self::invoices();
        self::payments();

        self::forget();
    }

    /** The template and the price. */
    private static function packages(): void
    {
        if (Schema::hasTable(Package::TABLE)) {
            return;
        }

        Schema::create(Package::TABLE, function (Blueprint $table): void {
            $table->id();

            $table->string('name', 120);
            $table->string('slug', 64)->unique();
            $table->text('description')->nullable();

            /*
             * Nullable and set null when the egg goes. A package whose egg was
             * deleted cannot be bought - Packages::live() leaves it out - but it
             * is still the thing four orders were placed against, and a
             * cascade here would take their history with it.
             */
            $table->unsignedInteger('egg_id')->nullable();
            $table->foreign('egg_id')->references('id')->on('eggs')->nullOnDelete();

            // Null means the egg's own first image and first startup command,
            // looked up when the server is made rather than copied now.
            $table->string('image')->nullable();
            $table->text('startup')->nullable();

            // Pelican's own shapes. swap may be -1 for unlimited.
            $table->unsignedInteger('memory')->default(1024);
            $table->integer('swap')->default(0);
            $table->unsignedInteger('disk')->default(5120);
            $table->unsignedInteger('io')->default(500);
            $table->unsignedInteger('cpu')->default(100);
            $table->string('threads', 64)->nullable();
            $table->boolean('oom_killer')->default(false);

            $table->unsignedInteger('database_limit')->default(0);
            $table->unsignedInteger('allocation_limit')->default(0);
            $table->unsignedInteger('backup_limit')->default(0);

            // ENV => value, over the egg's defaults. Null is "the defaults".
            $table->json('environment')->nullable();

            // Which nodes a server may land on, in order of preference. Empty
            // or null is any node the panel has.
            $table->json('node_ids')->nullable();

            // Minor units - cents - and never a decimal. See Support\Money.
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('setup_fee')->default(0);
            $table->string('period', 8)->default(Package::MONTH);

            // Null is unlimited. Zero is sold out on purpose.
            $table->unsignedInteger('stock')->nullable();

            $table->boolean('live')->default(false);
            $table->unsignedInteger('sort')->default(0);

            $table->timestamps();
        });
    }

    /** A code, and what it takes off. */
    private static function coupons(): void
    {
        if (Schema::hasTable(Coupon::TABLE)) {
            return;
        }

        Schema::create(Coupon::TABLE, function (Blueprint $table): void {
            $table->id();

            $table->string('code', 40)->unique();
            $table->string('kind', 8)->default(Coupon::PERCENT);

            // A whole percentage, 1-100, or minor units. Which is `kind`.
            $table->unsignedInteger('value')->default(0);

            $table->json('package_ids')->nullable();
            $table->unsignedInteger('max_uses')->nullable();
            $table->unsignedInteger('uses')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('live')->default(true);

            $table->timestamps();
        });
    }

    /** One bought package. */
    private static function orders(): void
    {
        if (Schema::hasTable(Order::TABLE)) {
            return;
        }

        Schema::create(Order::TABLE, function (Blueprint $table): void {
            $table->id();

            /*
             * Null when the account is deleted, not cascaded. An order is a
             * record that money changed hands; the invoice under it says who
             * paid, and neither should vanish because a user did.
             */
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on(Package::TABLE)->nullOnDelete();

            // The server this became. Null before provisioning, and null again
            // if somebody deletes the server in Pelican.
            $table->unsignedInteger('server_id')->nullable();
            $table->foreign('server_id')->references('id')->on('servers')->nullOnDelete();

            $table->string('state', 16)->default(Order::PENDING);

            /*
             * Everything about the package as it was when this was bought:
             * name, egg, image, startup, the limits, the environment, the
             * nodes. A package is edited after it is sold - a price goes up,
             * a limit comes down - and the server somebody paid for is the
             * one they were shown, not the one the row says today.
             */
            $table->json('spec');

            // The commercial half of the same snapshot.
            $table->string('period', 8);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('setup_fee')->default(0);
            $table->string('currency', 3);

            // When the next period starts. Null for a one-off.
            $table->timestamp('next_due_at')->nullable();

            $table->timestamp('provisioned_at')->nullable();

            // Set only by this plugin, so a payment never lifts a suspension
            // an administrator put on for a reason of their own.
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // The last thing that went wrong provisioning it, for the admin
            // page and the retry button.
            $table->text('note')->nullable();

            $table->timestamps();

            $table->index(['state', 'next_due_at']);
        });
    }

    /** What is owed, and whether it was paid. */
    private static function invoices(): void
    {
        if (Schema::hasTable(Invoice::TABLE)) {
            return;
        }

        Schema::create(Invoice::TABLE, function (Blueprint $table): void {
            $table->id();

            $table->string('number', 32)->unique();

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on(Order::TABLE)->nullOnDelete();

            $table->string('kind', 8)->default(Invoice::ORDER);
            $table->string('state', 8)->default(Invoice::UNPAID);

            // Every amount in minor units. tax_rate is basis points: 2100 is
            // twenty-one percent, so a rate with two decimals is still an
            // integer.
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('tax')->default(0);
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedSmallInteger('tax_rate')->default(0);
            $table->string('currency', 3);

            $table->string('coupon_code', 40)->nullable();

            // [{description, quantity, amount}] - what the document prints.
            $table->json('lines');

            // Who it was for, as they were then. An account renamed or removed
            // later does not change what the document said.
            $table->string('customer_name', 191)->nullable();
            $table->string('customer_email', 191)->nullable();

            $table->timestamp('due_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('paid_via', 16)->nullable();
            $table->timestamp('emailed_at')->nullable();

            $table->timestamps();

            $table->index(['state', 'due_at']);
        });
    }

    /** Every attempt at a payment provider. */
    private static function payments(): void
    {
        if (Schema::hasTable(Payment::TABLE)) {
            return;
        }

        Schema::create(Payment::TABLE, function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on(Invoice::TABLE)->cascadeOnDelete();

            $table->string('gateway', 16);

            // The provider's own id for this attempt. Unique with the gateway,
            // and that pair is what makes a webhook that fires twice harmless:
            // the second one finds the row the first one made.
            $table->string('gateway_id', 191)->nullable();

            // Our own handle for the return address, so the URL a provider
            // sends somebody back to carries nothing guessable.
            $table->string('token', 40)->unique();

            $table->string('state', 12)->default(Payment::OPEN);
            $table->unsignedBigInteger('amount')->default(0);
            $table->string('currency', 3);

            // The provider's last answer, kept for the admin page. Trimmed
            // before it is stored; never the whole body.
            $table->json('raw')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->unique(['gateway', 'gateway_id']);
        });
    }
}
