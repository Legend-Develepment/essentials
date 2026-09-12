<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
    /**
     * The one table here without a model of its own: it holds no more than the
     * pair, and both ends already have somewhere to live.
     */
    public const INVOICE_ORDERS = 'essentials_invoice_orders';

    /**
     * Who the customer is, as opposed to which account they signed in with.
     *
     * A table of our own rather than columns on Pelican's users, because that
     * table is not ours - a plugin that widens somebody else's schema is a
     * plugin that breaks on their next migration. Linked by user_id, and the
     * row is made the first time somebody fills anything in.
     */
    public const CUSTOMERS = 'essentials_customers';

    /**
     * Money the shop owes a customer, as a ledger rather than as a balance.
     *
     * Every row is one movement and rows are never edited: a refund written as
     * credit adds one, an invoice settled from it adds a negative one, and the
     * balance is the sum. A single balance column would be one number that can
     * disagree with its own history, and the day it does there is no way to
     * find out which of the two is wrong.
     *
     * Deliberately not in ALL below. A panel between the file swap and the
     * install would answer "shop not ready" for every page until this exists,
     * and losing the whole shop for a minute is a worse trade than a balance
     * that reads nought for a minute. Credit reads its own table and copes.
     */
    public const CREDIT = 'essentials_credit';

    /**
     * A service moving from one package to another, and what it cost.
     *
     * Its own table for the same reason the credit ledger is one: it is a
     * history, not a state. A column on the order would answer "what is it now"
     * and lose "what was it, and what did the change cost" - which is the half
     * somebody actually asks about.
     *
     * Out of ALL below, like CREDIT, so a panel between the file swap and the
     * install loses upgrades for a minute rather than the whole shop.
     */
    public const UPGRADES = 'essentials_upgrades';

    /**
     * Things sold alongside a package, and the ones somebody actually has.
     *
     * Two tables rather than one for the reason every shop needs two: what is
     * for sale is edited, and what was bought must not change when it is. The
     * second carries a snapshot of the first, exactly as an order carries a
     * snapshot of its package.
     *
     * Out of ALL below, like CREDIT and UPGRADES, so a panel between the file
     * swap and the install loses addons for a minute rather than the shop.
     */
    public const ADDONS = 'essentials_addons';

    public const ORDER_ADDONS = 'essentials_order_addons';

    /** In dependency order, so dropping runs it backwards. */
    public const ALL = [
        Package::TABLE,
        Coupon::TABLE,
        Order::TABLE,
        Invoice::TABLE,
        Payment::TABLE,
    ];

    /**
     * Who asked to be told when a package is for sale again.
     *
     * Outside ALL below, deliberately: ready() walks that list, so a panel
     * between the file swap and the install would answer "the shop is not
     * ready" on every page until this one table existed. Losing the shop for a
     * minute is a worse trade than losing a waiting list for one.
     */
    public const WAITLIST = 'essentials_waitlist';

    private static ?bool $ready = null;

    private static ?bool $waitlist = null;

    /** Whether the waiting list's own table is there. Asked once per request. */
    public static function waitlistReady(): bool
    {
        if (self::$waitlist !== null) {
            return self::$waitlist;
        }

        try {
            return self::$waitlist = Schema::hasTable(self::WAITLIST);
        } catch (Throwable) {
            return self::$waitlist = false;
        }
    }

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
        self::$waitlist = null;
    }

    public static function install(): void
    {
        self::packages();
        self::coupons();
        self::orders();
        self::invoices();
        self::payments();
        self::invoiceOrders();
        self::customers();
        self::credit();
        self::upgrades();
        self::addons();

        // A fresh install already has every column; this is here for the panel
        // that had the tables before this release.
        self::upgrade();

        self::forget();
    }

    /**
     * Columns added after a panel already had these tables.
     *
     * Not a migration, for the reason written on the migration itself: a
     * migration records that it ran, and when that record and the database
     * disagree there is no way back. This asks the database what it actually
     * has, every time, which cannot be wrong.
     *
     * Every block is guarded on its own column rather than on a version, so a
     * panel that upgraded halfway through a release finishes the job on the
     * next boot instead of being stuck between two shapes.
     */
    public static function upgrade(): void
    {
        try {
            if (Schema::hasTable(Package::TABLE)) {
                if (!Schema::hasColumn(Package::TABLE, 'term')) {
                    Schema::table(Package::TABLE, static function (Blueprint $table): void {
                        $table->unsignedInteger('term')->default(0);
                        $table->string('term_unit', 8)->default('month');
                    });
                }

                if (!Schema::hasColumn(Package::TABLE, 'art_path')) {
                    Schema::table(Package::TABLE, static function (Blueprint $table): void {
                        $table->string('art_path', 255)->nullable();
                        $table->string('art_url', 2048)->nullable();
                    });
                }
            }

            if (Schema::hasTable(Package::TABLE) && !Schema::hasColumn(Package::TABLE, 'ask_vars')) {
                Schema::table(Package::TABLE, static function (Blueprint $table): void {
                    // Which of the egg's own variables the customer fills in,
                    // by env name. Everything not in here keeps the egg default.
                    $table->json('ask_vars')->nullable();

                    // And whether a file comes with the order.
                    $table->boolean('upload_ask')->default(false);
                    $table->string('upload_label', 120)->nullable();
                    $table->string('upload_dir', 255)->default('/');
                    $table->boolean('upload_extract')->default(true);
                });
            }

            if (Schema::hasTable(Order::TABLE) && !Schema::hasColumn(Order::TABLE, 'cancelled_by')) {
                Schema::table(Order::TABLE, static function (Blueprint $table): void {
                    // Who ended it. Null on an order nobody has ended.
                    $table->string('cancelled_by', 16)->nullable();
                });
            }

            if (Schema::hasTable(Order::TABLE) && !Schema::hasColumn(Order::TABLE, 'extras')) {
                Schema::table(Order::TABLE, static function (Blueprint $table): void {
                    // What the customer answered, and where their file is kept
                    // until the server exists to put it in.
                    $table->json('extras')->nullable();
                    $table->string('upload_path', 255)->nullable();
                    $table->timestamp('delivered_at')->nullable();
                });
            }

            if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, 'reminded_at')) {
                Schema::table(Invoice::TABLE, static function (Blueprint $table): void {
                    $table->timestamp('reminded_at')->nullable();
                });
            }

            if (Schema::hasTable(Order::TABLE) && !Schema::hasColumn(Order::TABLE, 'ends_at')) {
                Schema::table(Order::TABLE, static function (Blueprint $table): void {
                    $table->timestamp('ends_at')->nullable();
                });
            }

            /*
             * The one repair here that is not a missing column.
             *
             * essentials_payments.token was NOT NULL and unique while nothing
             * ever wrote it, so every row took the empty string and only the
             * first one fitted. A shop that had taken one payment could not
             * record a second - see the column itself for what that did to the
             * customer standing at the provider's checkout.
             *
             * Guarded on the index rather than on a version, like every block
             * above it: a panel that has already been repaired does nothing,
             * and one that has not is repaired on the next boot.
             */
            self::freeTokenColumn();

            // The basket's table, on a panel that had the shop before it.
            self::invoiceOrders();

            // And the customer's own details, likewise.
            self::customers();

            /*
             * The credit ledger, likewise.
             *
             * A table made here as well as in install(), because the seeder
             * that runs after the files are swapped is running the previous
             * release's Tables class - see InstallTasks::schema(). A table that
             * only install() makes arrives a release late, and the release that
             * needs it is the one that runs without it.
             */
            self::credit();

            // And the record of a service changing package, for the same
            // reason: a table only install() makes arrives a release late.
            self::upgrades();

            // And the extras, likewise.
            self::addons();

            // And the waiting list, for the same reason again.
            self::waitlist();

            // What an addon invoice is waiting to do once it is paid.
            if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, 'addon_for')) {
                Schema::table(Invoice::TABLE, static function (Blueprint $table): void {
                    $table->json('addon_for')->nullable();
                });
            }

            /*
             * Which packages a package may be changed to.
             *
             * A list on the package rather than a table of pairs. It is read
             * every time somebody opens their services page and written by hand
             * on a form, and a join table for a handful of ids per package
             * would be three queries to answer a question one column answers.
             */
            if (Schema::hasTable(Package::TABLE) && !Schema::hasColumn(Package::TABLE, 'upgrade_to')) {
                Schema::table(Package::TABLE, static function (Blueprint $table): void {
                    $table->json('upgrade_to')->nullable();
                });
            }

            /*
             * What of an invoice was settled from that ledger, and which
             * invoice a credit note is about.
             *
             * `credit` is not taken off the total. The total says what the
             * supply cost and the tax on it, which does not change because the
             * customer happened to have money here; what they must actually
             * hand over is total minus this, which is Invoice::due(). Keeping
             * them apart is what lets the document print both lines and stay
             * arithmetically true.
             */
            foreach (['credit', 'credit_for'] as $column) {
                if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, $column)) {
                    Schema::table(Invoice::TABLE, static function (Blueprint $table) use ($column): void {
                        $column === 'credit'
                            ? $table->unsignedBigInteger('credit')->default(0)
                            : $table->unsignedBigInteger('credit_for')->nullable();
                    });
                }
            }

            // How much of a payment has gone back to where it came from. On the
            // payment and not on the invoice, because a refund is against the
            // thing the provider actually holds - and an invoice can have been
            // paid by more than one attempt.
            if (Schema::hasTable(Payment::TABLE) && !Schema::hasColumn(Payment::TABLE, 'refunded')) {
                Schema::table(Payment::TABLE, static function (Blueprint $table): void {
                    $table->unsignedBigInteger('refunded')->default(0);
                });
            }

            /*
             * What the invoice keeps about the buyer.
             *
             * Snapshotted rather than joined, for the same reason the name and
             * the email already are: a customer who moves house next year must
             * not change where an invoice from this year says they lived. An
             * invoice is a record of a moment.
             */
            foreach (['customer_company' => 191, 'customer_country' => 2] as $column => $width) {
                if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, $column)) {
                    Schema::table(Invoice::TABLE, static function (Blueprint $table) use ($column, $width): void {
                        $table->string($column, $width)->nullable();
                    });
                }
            }

            if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, 'customer_address')) {
                Schema::table(Invoice::TABLE, static function (Blueprint $table): void {
                    // The address as the lines it should print as - every
                    // country orders street, number and postcode differently,
                    // and a form that insists on one order is one people fight.
                    $table->json('customer_address')->nullable();
                });
            }

            if (Schema::hasTable(Package::TABLE) && !Schema::hasColumn(Package::TABLE, 'offer')) {
                Schema::table(Package::TABLE, static function (Blueprint $table): void {
                    /*
                     * On offer, and what the offer is.
                     *
                     * The kind and the value rather than two columns for a
                     * percentage and an amount: a package is one or the other,
                     * and two columns would let it be both and leave whoever
                     * reads them to decide which wins.
                     */
                    $table->boolean('offer')->default(false);
                    $table->string('offer_kind', 8)->default('percent');
                    $table->unsignedBigInteger('offer_value')->default(0);

                    /*
                     * And how full the basket has to be first. Zero is an offer
                     * that always applies; two is "from two things onwards",
                     * counted over the whole basket rather than over this one
                     * package - which is what makes it a reason to put a second
                     * thing in rather than a reason to buy two of the same.
                     */
                    $table->unsignedSmallInteger('offer_min_items')->default(0);

                    // The one somebody should look at first. Not a discount and
                    // not a claim about sales - a shopkeeper pointing.
                    $table->boolean('popular')->default(false);
                });
            }

            if (Schema::hasTable(Invoice::TABLE) && !Schema::hasColumn(Invoice::TABLE, 'customer_vat')) {
                Schema::table(Invoice::TABLE, static function (Blueprint $table): void {
                    $table->string('customer_vat', 32)->nullable();
                });
            }
        } catch (Throwable) {
            // A database that will not answer leaves the tables as they are,
            // and every reader of these columns copes with them being absent.
        }

        self::forget();
    }

    /**
     * Drop the unique index on essentials_payments.token, and let the column be
     * null.
     *
     * Written against the database rather than through Schema::table(), for two
     * reasons. Dropping an index needs doctrine/dbal in some Laravel versions
     * and that is not a dependency this plugin may add; and the index has to be
     * looked for before it is dropped, because dropping one that is not there
     * is an error rather than a no-op.
     */
    private static function freeTokenColumn(): void
    {
        if (!Schema::hasTable(Payment::TABLE) || !Schema::hasColumn(Payment::TABLE, 'token')) {
            return;
        }

        $table = Payment::TABLE;
        $index = $table . '_token_unique';

        try {
            $found = DB::select('SHOW INDEX FROM `' . $table . '` WHERE Key_name = ?', [$index]);

            if ($found !== []) {
                DB::statement('ALTER TABLE `' . $table . '` DROP INDEX `' . $index . '`');
            }

            $column = DB::select('SHOW COLUMNS FROM `' . $table . '` LIKE ?', ['token']);

            // Only when it is still NOT NULL. The statement is harmless either
            // way, but an ALTER on a table that is already right is a table
            // rebuilt for nothing on every boot.
            if (($column[0]->Null ?? 'YES') === 'NO') {
                DB::statement('ALTER TABLE `' . $table . '` MODIFY `token` VARCHAR(40) NULL DEFAULT NULL');
            }
        } catch (Throwable) {
            /*
             * Another engine, another spelling of SHOW INDEX, or a database
             * user without ALTER. None of those may take the panel down, and a
             * shop that cannot record a second payment is visible the moment
             * somebody tries - Gateways::remember() reports it, and start()
             * now refuses to send anybody to a checkout it cannot write down.
             */
        }
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

            /*
             * The minimum contract, and what it is counted in.
             *
             * Nothing to do with the billing period above it: a package can be
             * billed monthly on a twelve-month contract, and those are two
             * different questions. Zero is no minimum - cancelling then ends
             * the service when the paid period runs out.
             */
            $table->unsignedInteger('term')->default(0);
            $table->string('term_unit', 8)->default('month');

            /*
             * The picture behind the card. An upload wins over a typed URL,
             * and with neither the egg's own artwork is used - the same order
             * the login background already resolves in.
             */
            $table->string('art_path', 255)->nullable();
            $table->string('art_url', 2048)->nullable();

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

            /*
             * When the contract runs out.
             *
             * Set when the server is built, from the package's term. A
             * cancelled order runs until this moment and the server is removed
             * after it - which is why cancelling is not the same as deleting,
             * and why the date has to be written down rather than worked out
             * later from a package that may have changed.
             */
            $table->timestamp('ends_at')->nullable();

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

            /*
             * The buyer's VAT number, snapshotted like their name and their
             * address are - a customer who changes theirs next year must not
             * change what an invoice from this year says.
             *
             * Whether the tax was reverse-charged is not a second column: it is
             * this being set on an invoice that carries a rate and no tax. The
             * numbers already say it, and a flag that can disagree with them is
             * a flag that eventually does.
             */
            $table->string('customer_vat', 32)->nullable();

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

            /*
             * Room for a handle of our own, and nothing writes one yet.
             *
             * It was declared NOT NULL and unique for a return address that in
             * the end carries the invoice id instead - so every row MySQL made
             * got the empty string, and the second payment in the life of a
             * shop collided with the first. The table then refused every
             * attempt after that, which is not a payment failing: the customer
             * still went to the provider, still paid, and came back to an
             * invoice with no row to settle against.
             *
             * Nullable and not unique, because a column nothing fills must not
             * be able to refuse a row. Whatever fills it later can add the
             * index back with a value to put in it.
             */
            $table->string('token', 40)->nullable();

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

    /**
     * Which orders an invoice bills.
     *
     * A table rather than a column, because both sides are many. An invoice
     * bills several orders - that is the basket - and an order is billed again
     * on every renewal, so it appears on a new invoice each period. Neither
     * side fits in a foreign key.
     *
     * invoices.order_id stays exactly where it was and still names the first
     * order. Everything written before this table existed reads through it, and
     * an invoice with no rows here is read as billing that one order - see
     * Invoice::billed(). So nothing has to be back-filled and nothing that
     * already works has to change.
     */
    /**
     * The customer behind the account.
     *
     * Everything here is optional. Somebody buying one game server for
     * themselves needs none of it; a business needs all of it, and needs it on
     * the invoice. So the row exists from the moment anything is filled in and
     * not before, and every reader copes with it being absent.
     */
    /**
     * Who is waiting, and nothing else about them.
     *
     * No state, no notified_at, no held_until, no position. Every one of those
     * answers a question this design does not ask, because a row is deleted at
     * the moment it is answered: told, bought, left, or the package gone. The
     * order is the id, which is first come first served in the only sense the
     * phrase can have here.
     */
    private static function waitlist(): void
    {
        if (Schema::hasTable(self::WAITLIST)) {
            return;
        }

        Schema::create(self::WAITLIST, function (Blueprint $table): void {
            $table->id();

            /*
             * unsignedBigInteger, because essentials_packages starts with an
             * id() of its own. A key of the wrong width is refused by MySQL
             * naming neither column, and nothing in the build would catch it:
             * the migration gate reads database/migrations, and this is not
             * one.
             */
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on(Package::TABLE)->cascadeOnDelete();

            /*
             * And the opposite width on the line below it, for the same
             * reason: Pelican's users.id is an increments.
             *
             * Cascading on both, which is this table's entire housekeeping. An
             * order nulls its user instead, because an order is a record that
             * money changed hands; a place on a waiting list is a promise to
             * tell somebody something, and there is nobody left to tell.
             */
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->timestamps();

            /*
             * One person, one place, one package - refused by the database
             * rather than remembered by the code. Joining twice is being told
             * the same thing twice in the same second, which is the first
             * notification anybody stops reading.
             */
            $table->unique(['package_id', 'user_id']);
        });
    }

    private static function addons(): void
    {
        if (!Schema::hasTable(self::ADDONS)) {
            Schema::create(self::ADDONS, function (Blueprint $table): void {
                $table->id();

                $table->string('name', 191);
                $table->text('description')->nullable();

                // Minor units, like every other price in this shop.
                $table->unsignedBigInteger('price')->default(0);

                // 'with' renews alongside the service; 'once' is charged on the
                // invoice that first carries it and never again.
                $table->string('billing', 8)->default('with');

                // Which packages it may be bought with. Empty means any, which
                // is what a support option or a backup slot usually is.
                $table->json('package_ids')->nullable();

                /*
                 * What it adds to the server, as a delta and never as a value.
                 *
                 * Signed, because an addon may take something away as easily as
                 * give it, and a delta is the only shape that lets two of them
                 * bought together add up. Two absolute values cannot.
                 */
                $table->bigInteger('memory')->default(0);
                $table->bigInteger('swap')->default(0);
                $table->bigInteger('disk')->default(0);
                $table->bigInteger('cpu')->default(0);
                $table->bigInteger('database_limit')->default(0);
                $table->bigInteger('allocation_limit')->default(0);
                $table->bigInteger('backup_limit')->default(0);

                // How many of one somebody may hold. One is the ordinary case;
                // a memory addon sold by the gigabyte is where this earns its
                // keep.
                $table->unsignedSmallInteger('max')->default(1);

                $table->boolean('live')->default(true);
                $table->integer('sort')->default(0);

                $table->timestamps();

                $table->index(['live', 'sort']);
            });
        }

        if (Schema::hasTable(self::ORDER_ADDONS)) {
            return;
        }

        Schema::create(self::ORDER_ADDONS, function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on(Order::TABLE)->cascadeOnDelete();

            // Nullable, and that is the point of the snapshot below: an addon
            // taken off sale must not take away the record of what somebody has.
            $table->unsignedBigInteger('addon_id')->nullable();
            $table->foreign('addon_id')->references('id')->on(self::ADDONS)->nullOnDelete();

            $table->string('name', 191);
            $table->unsignedBigInteger('price')->default(0);
            $table->string('billing', 8)->default('with');
            $table->unsignedSmallInteger('quantity')->default(1);

            // What it adds to the server, as it was when it was bought.
            $table->json('spec')->nullable();

            $table->timestamps();

            $table->index(['order_id', 'id']);
        });
    }

    private static function upgrades(): void
    {
        if (Schema::hasTable(self::UPGRADES)) {
            return;
        }

        Schema::create(self::UPGRADES, function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on(Order::TABLE)->cascadeOnDelete();

            // Null when the change cost nothing, or gave money back: there is
            // no invoice for either.
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on(Invoice::TABLE)->nullOnDelete();

            /*
             * Both packages, and both may go. A package deleted next year must
             * not take the record of what somebody was charged with it - the
             * order's own spec is the snapshot that matters, and this is the
             * story of how it got there.
             */
            $table->unsignedBigInteger('from_package_id')->nullable();
            $table->foreign('from_package_id')->references('id')->on(Package::TABLE)->nullOnDelete();

            $table->unsignedBigInteger('to_package_id')->nullable();
            $table->foreign('to_package_id')->references('id')->on(Package::TABLE)->nullOnDelete();

            // Signed, like the credit ledger: positive is owed for a bigger
            // package, negative is given back for a smaller one.
            $table->bigInteger('amount')->default(0);
            $table->string('currency', 3);

            $table->string('state', 8)->default('pending');
            $table->text('note')->nullable();
            $table->timestamp('applied_at')->nullable();

            $table->timestamps();

            // The two questions asked of it: what is waiting on this invoice,
            // and what has this service been.
            $table->index(['invoice_id', 'state']);
            $table->index(['order_id', 'id']);
        });
    }

    private static function credit(): void
    {
        if (Schema::hasTable(self::CREDIT)) {
            return;
        }

        Schema::create(self::CREDIT, function (Blueprint $table): void {
            $table->id();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            /*
             * Signed, and that is the whole point of this table. Minor units
             * like every other amount in the shop: positive is money put on the
             * account, negative is money taken off it to settle something.
             */
            $table->bigInteger('amount');

            $table->string('currency', 3);

            // Why, in whatever words whoever did it wrote. Shown to the
            // customer on their own billing page, so it is not a place for
            // internal shorthand.
            $table->string('reason', 191)->nullable();

            // What it was about, where there was something. Null for credit
            // given by hand, which is not about any one document.
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on(Invoice::TABLE)->nullOnDelete();

            // Who did it, and null when nobody did - an invoice settled from
            // the balance is the shop moving its own money.
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();

            // The one question this table is ever asked: what has this person
            // got, newest first.
            $table->index(['user_id', 'id']);
        });
    }

    private static function customers(): void
    {
        if (Schema::hasTable(self::CUSTOMERS)) {
            return;
        }

        Schema::create(self::CUSTOMERS, function (Blueprint $table): void {
            $table->id();

            /*
             * unsignedInteger and not foreignId(), because Pelican's users.id
             * is an `increments` - int unsigned - and a foreign key between two
             * widths is refused by MySQL with "errno: 150", naming neither
             * column. check-migrations.js exists because that shipped once.
             */
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->string('company', 191)->nullable();
            $table->json('address')->nullable();
            $table->string('postcode', 32)->nullable();
            $table->string('city', 120)->nullable();

            // Two letters. It decides the VAT question as much as it prints on
            // the document - see Support\Shop\Vat.
            $table->string('country', 2)->nullable();

            $table->string('phone', 40)->nullable();
            $table->string('vat', 32)->nullable();

            /*
             * The shop's own note about this person, never shown to them. It is
             * behind the customers permission like the rest of the page, which
             * is the only thing keeping it private.
             */
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    private static function invoiceOrders(): void
    {
        if (Schema::hasTable(self::INVOICE_ORDERS)) {
            return;
        }

        Schema::create(self::INVOICE_ORDERS, function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on(Invoice::TABLE)->cascadeOnDelete();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on(Order::TABLE)->cascadeOnDelete();

            /*
             * What this order was worth on this invoice, kept here rather than
             * worked out from the order later. A price can change between one
             * period and the next, and an invoice must go on saying what was
             * charged at the time - which is the same reason the invoice keeps
             * its own lines and its own customer name.
             */
            $table->unsignedBigInteger('amount')->default(0);

            $table->timestamps();

            // One order appears at most once on one invoice. Two lines for the
            // same order is either a double charge or a bug that looks like one.
            $table->unique(['invoice_id', 'order_id']);
        });
    }
}
