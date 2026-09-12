<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LegendDevelopment\Theme\Models\Order;
use Throwable;

/**
 * The two tables a support desk owns.
 *
 * Their own install task rather than a block inside the shop's, because
 * tickets are not the shop: a panel may want somewhere for people to ask
 * questions without selling anything, and the feature that switches one on has
 * nothing to say about the other.
 *
 * Not migrations, for the reason written on the shop's own: installing is the
 * seeder's work, because a seeder runs on every install while a migration's
 * up() is recorded and skipped the second time round.
 */
class Tables
{
    public const TICKETS = 'essentials_tickets';

    public const MESSAGES = 'essentials_ticket_messages';

    private static ?bool $ready = null;

    /** Whether both exist, asked once per request. */
    public static function ready(): bool
    {
        if (self::$ready !== null) {
            return self::$ready;
        }

        try {
            return self::$ready = Schema::hasTable(self::TICKETS) && Schema::hasTable(self::MESSAGES);
        } catch (Throwable) {
            return self::$ready = false;
        }
    }

    public static function forget(): void
    {
        self::$ready = null;
    }

    /**
     * Make them, and add anything a later release wants.
     *
     * One method rather than install() and upgrade(), because the two are the
     * same act guarded differently: a table is made if it is missing, a column
     * is added if it is missing, and a panel arriving here halfway finishes the
     * job on the next boot either way.
     *
     * Guarded on the shape rather than on a version, like the shop's own
     * upgrade, so there is nothing to keep in step with a release number.
     */
    public static function install(): void
    {
        try {
            if (!Schema::hasTable(self::TICKETS)) {
                Schema::create(self::TICKETS, function (Blueprint $table): void {
                    $table->id();

                    /*
                     * unsignedInteger and not foreignId(), because Pelican's
                     * users.id is an `increments` and a foreign key between two
                     * widths is refused by MySQL naming neither column.
                     */
                    $table->unsignedInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

                    // What it is about, where it is about something. Both may
                    // go without taking the conversation with them.
                    $table->unsignedBigInteger('order_id')->nullable();
                    $table->foreign('order_id')->references('id')->on(Order::TABLE)->nullOnDelete();

                    $table->unsignedInteger('server_id')->nullable();
                    $table->foreign('server_id')->references('id')->on('servers')->nullOnDelete();

                    $table->string('subject', 191);
                    $table->string('state', 8)->default('open');
                    $table->string('priority', 8)->default('normal');

                    // The same ticket at the far end, when there is one.
                    $table->string('remote', 191)->nullable();

                    /*
                     * And the number it is known by over there, which is not
                     * the same thing as its id.
                     *
                     * Kept so both sides can say the same number out loud. A
                     * customer reading #3 here and staff reading #17 in the
                     * channel are two people who cannot help each other, and
                     * the id is no use for that: it counts across the whole of
                     * Modora, while the number counts per server and is what
                     * the channel is named after.
                     */
                    $table->string('remote_number', 32)->nullable();

                    // Where a guest goes to claim it with their Discord
                    // account. Only ever set by a desk that issues one.
                    $table->text('claim_url')->nullable();

                    /*
                     * Who picked it up, and which team it belongs to.
                     *
                     * Both here rather than at the far end, because the far end
                     * has nowhere to put them: Modora's API has no assign, no
                     * transfer and no priority endpoint, so a panel that wanted
                     * to wait for one would be waiting for ever. What it does
                     * have is a channel, and a change worth making is a change
                     * worth saying out loud in it - which is what Board does.
                     */
                    $table->unsignedInteger('claimed_by')->nullable();
                    $table->foreign('claimed_by')->references('id')->on('users')->nullOnDelete();

                    /*
                     * The group, which is a role.
                     *
                     * unsignedBigInteger and not unsignedInteger, which is the
                     * opposite of every other key on this table: Spatie's own
                     * migration makes roles.id a bigIncrements while Pelican's
                     * users and servers are increments. Pelican's node_role
                     * table has both widths side by side for the same reason.
                     */
                    $table->unsignedBigInteger('role_id')->nullable();
                    $table->foreign('role_id')->references('id')->on('roles')->nullOnDelete();

                    // When anything was last said, which is what the list sorts
                    // by: a ticket somebody just replied to is the one to look
                    // at, whatever order it was opened in.
                    $table->timestamp('last_at')->nullable();
                    $table->timestamp('closed_at')->nullable();

                    $table->timestamps();

                    $table->index(['state', 'last_at']);
                    $table->index(['user_id', 'id']);
                });
            }

            if (!Schema::hasTable(self::MESSAGES)) {
                Schema::create(self::MESSAGES, function (Blueprint $table): void {
                    $table->id();

                    $table->unsignedBigInteger('ticket_id');
                    $table->foreign('ticket_id')->references('id')->on(self::TICKETS)->cascadeOnDelete();

                    // Null for anything said by somebody with no account here,
                    // which is what a reply from Discord is.
                    $table->unsignedInteger('user_id')->nullable();
                    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

                    $table->string('author', 191);
                    $table->boolean('staff')->default(false);

                    /*
                     * Not somebody talking, but something happening.
                     *
                     * "X picked this up", "moved to Billing", "now urgent". It
                     * is a message because it belongs in the conversation and
                     * has to reach the channel like any other, and it is
                     * flagged because a window that drew it as a reply would be
                     * telling the customer that staff answered them when
                     * nobody had.
                     */
                    $table->boolean('notice')->default(false);

                    /*
                     * And a notice the customer never sees.
                     *
                     * Which group answers a ticket is a thing this panel
                     * invented - Discord has no groups and a customer has no
                     * use for the name of the role that will answer them. So a
                     * move is recorded in the conversation, shown to staff, and
                     * goes nowhere else.
                     */
                    $table->boolean('inside')->default(false);

                    $table->text('body');

                    /*
                     * Both ids, because Modora hands back both and they answer
                     * different questions: one names the message in their
                     * system, the other names it in the channel. Keeping one
                     * makes the other unanswerable later.
                     */
                    $table->string('remote', 191)->nullable();
                    $table->string('discord_id', 191)->nullable();

                    /*
                     * When this was handed to the desk.
                     *
                     * Kept apart from the id because they answer different
                     * questions: the id is how a message is recognised when it
                     * comes back, and this is whether it went at all. A desk
                     * that answers successfully but names the id in a way this
                     * release does not read would otherwise leave every message
                     * looking unsent for ever, and the catch-up pass would post
                     * the conversation again every five minutes.
                     */
                    $table->timestamp('sent_at')->nullable();

                    /*
                     * A picture, where there is one.
                     *
                     * One column rather than four, because what is kept about a
                     * file is a small fixed record and splitting it across
                     * columns would only make the day somebody adds a second
                     * one harder.
                     */
                    $table->json('file')->nullable();

                    $table->timestamps();

                    $table->index(['ticket_id', 'id']);

                    /*
                     * What stops a message arriving twice.
                     *
                     * A pull can overlap another pull, and a message posted
                     * through the API comes back on the read as well. Two rows
                     * saying the same thing is the failure this whole design is
                     * arranged to avoid, so the database refuses it rather than
                     * the code remembering to.
                     *
                     * A message that only exists here has a null remote, and
                     * every engine this runs on allows any number of nulls in a
                     * unique index - which is exactly right: two of ours are two
                     * different things somebody said.
                     */
                    $table->unique(['ticket_id', 'remote']);
                });
            }
            /*
             * And on a panel that had these tables before the column existed.
             *
             * Guarded on the column rather than on a version, like the shop's
             * own upgrade does, so a panel that arrives here halfway finishes
             * the job on the next boot instead of being stuck between two
             * shapes.
             */
            if (Schema::hasTable(self::TICKETS) && !Schema::hasColumn(self::TICKETS, 'remote_number')) {
                Schema::table(self::TICKETS, static function (Blueprint $table): void {
                    $table->string('remote_number', 32)->nullable();
                });
            }

            /*
             * The two that are also a foreign key, each on its own.
             *
             * Apart from the blocks around them because a constraint is the one
             * thing here that a live database can refuse - an engine without
             * them, a table left as MyISAM by a much older panel - and a refusal
             * inside the big try would take every block after it down with it.
             * The column is what the code reads; the constraint is tidiness the
             * panel can live without.
             */
            self::add('claimed_by', static function (Blueprint $table): void {
                $table->unsignedInteger('claimed_by')->nullable();
                $table->foreign('claimed_by')->references('id')->on('users')->nullOnDelete();
            });

            self::add('role_id', static function (Blueprint $table): void {
                $table->unsignedBigInteger('role_id')->nullable();
                $table->foreign('role_id')->references('id')->on('roles')->nullOnDelete();
            });

            if (Schema::hasTable(self::MESSAGES) && !Schema::hasColumn(self::MESSAGES, 'inside')) {
                Schema::table(self::MESSAGES, static function (Blueprint $table): void {
                    $table->boolean('inside')->default(false);
                });
            }

            if (Schema::hasTable(self::MESSAGES) && !Schema::hasColumn(self::MESSAGES, 'notice')) {
                Schema::table(self::MESSAGES, static function (Blueprint $table): void {
                    $table->boolean('notice')->default(false);
                });
            }

            if (Schema::hasTable(self::MESSAGES) && !Schema::hasColumn(self::MESSAGES, 'sent_at')) {
                Schema::table(self::MESSAGES, static function (Blueprint $table): void {
                    $table->timestamp('sent_at')->nullable();
                });
            }

            if (Schema::hasTable(self::MESSAGES) && !Schema::hasColumn(self::MESSAGES, 'file')) {
                Schema::table(self::MESSAGES, static function (Blueprint $table): void {
                    $table->json('file')->nullable();
                });
            }
        } catch (Throwable) {
            // A database that will not answer leaves the tables as they are.
            // Board::ready() decides on every page whether any of this is
            // offered, so the feature is simply absent until they exist.
        }

        self::forget();
    }

    /**
     * Add a column to the tickets table on a panel that predates it.
     *
     * Its own try, so a constraint the engine will not take leaves the column
     * behind rather than stopping the rest of the upgrade. Nothing here reads
     * the constraint; it is the database keeping a promise the code would
     * otherwise have to remember.
     *
     * @param  callable(Blueprint): void  $shape
     */
    private static function add(string $column, callable $shape): void
    {
        try {
            if (!Schema::hasTable(self::TICKETS) || Schema::hasColumn(self::TICKETS, $column)) {
                return;
            }

            Schema::table(self::TICKETS, $shape);
        } catch (Throwable $exception) {
            /*
             * Two boots racing is this working, not failing.
             *
             * The schema check and the ALTER are not one statement, so on a
             * panel where the update job and the request that triggered it come
             * up together both can pass the check and the loser is told the
             * column already exists. That is the right outcome reported as a
             * fault, and it filled the log every time a column was added.
             *
             * So the question asked here is the only one worth asking: is the
             * column there now. If it is, somebody added it and it does not
             * matter who.
             */
            if (Schema::hasColumn(self::TICKETS, $column)) {
                return;
            }

            report($exception);
        }
    }
}
