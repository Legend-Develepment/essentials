<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use LegendDevelopment\Theme\Models\Credit;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Money the shop holds for a customer, and the documents that put it there.
 *
 * **A ledger, never a balance.** Every movement is a row and the balance is the
 * sum of them. The alternative - a column on the customer that goes up and down
 * - is one number that can end up disagreeing with its own history, and there
 * is then no way to say which of the two is the truth. Summing a handful of
 * rows costs nothing next to that.
 *
 * **What settles what.** A new invoice is offered the balance the moment it is
 * written, before the customer ever sees a payment page. What is taken is
 * recorded here as a negative row and on the invoice as `credit`; the total is
 * left alone, because the total says what the supply cost and that does not
 * change because the buyer happened to have money on account. What they must
 * hand over is Invoice::due(), which is the difference.
 *
 * **A credit note is an invoice.** Same table, same numbering, `kind` of
 * credit, and issued already paid - because it is not a demand for money, it is
 * a record that some was given back. Its amounts are positive and their meaning
 * is negative, which is the only way to keep them in columns the rest of the
 * shop can still add up. Takings knows to subtract them.
 */
class Credits
{
    /**
     * The least a top-up may be.
     *
     * Not a policy about small amounts: no provider will take a payment of
     * nothing, and several refuse anything under half a unit. A pound is the
     * roundest number above all of them.
     */
    public const LEAST = 100;

    /**
     * And the most.
     *
     * A guard against a nought too many rather than a limit on how much
     * anybody may hold - ten thousand is more than any of this shop's
     * customers will ever put on account in one go, and a hundred thousand is
     * what a slipped finger looks like.
     */
    public const MOST = 1000000;

    /**
     * Balances already read this request.
     *
     * The account menu asks for one on every page - twice, once to decide
     * whether to draw the row and once to put the figure in it - and the
     * profile page and the billing page ask again. That was four SUMs to say
     * one number. Dropped the moment anything is written, so nothing can read
     * a balance that a movement two lines earlier has already changed.
     *
     * @var array<int, int>
     */
    private static array $held = [];

    /**
     * What this person has, in the shop's own currency.
     *
     * Rows in any other currency are ignored rather than converted. A shop that
     * changed currency last year has history in the old one, and turning that
     * into today's money at today's rate would be inventing a number.
     */
    public static function balance(int $userId): int
    {
        if ($userId <= 0 || !Features::enabled(Features::CREDIT)) {
            return 0;
        }

        if (array_key_exists($userId, self::$held)) {
            return self::$held[$userId];
        }

        try {
            return self::$held[$userId] = (int) Credit::query()
                ->where('user_id', $userId)
                ->where('currency', Packages::currency())
                ->sum('amount');
        } catch (Throwable) {
            // No table yet on a panel between the file swap and the install.
            // Nought is the honest answer: nothing is known to be owed. Not
            // remembered either, so an install halfway through a request is
            // answered correctly by the end of it.
            return 0;
        }
    }

    /**
     * Put money on somebody's account.
     *
     * @param  int  $amount  Minor units, and positive. A negative "add" is a
     *                       spend, and calling it by its own name is what keeps
     *                       the two apart in the history.
     */
    public static function add(
        int $userId,
        int $amount,
        string $reason,
        ?int $invoiceId = null,
        ?int $by = null,
    ): bool {
        if ($amount <= 0 || !self::write($userId, $amount, $reason, $invoiceId, $by)) {
            return false;
        }

        /*
         * And straight onto whatever they owe.
         *
         * Here rather than at the three call sites, because it is the same
         * sentence every time money lands: a customer who has just topped up,
         * or just been given credit, or just been refunded to their account,
         * should not still be looking at a demand for money the shop is now
         * holding. Doing it anywhere else would be doing it in three places and
         * forgetting the fourth.
         *
         * It cannot recurse: settling spends rather than adds.
         */
        self::settleOpen($userId);

        return true;
    }

    /**
     * Take money off it, and never more than there is.
     *
     * The check and the write are one transaction with the rows locked, because
     * two invoices settling at the same moment would otherwise both read the
     * same balance and both spend it.
     */
    public static function spend(int $userId, int $amount, string $reason, ?int $invoiceId = null): bool
    {
        if ($amount <= 0 || $userId <= 0 || !Features::enabled(Features::CREDIT)) {
            return false;
        }

        try {
            return (bool) DB::transaction(static function () use ($userId, $amount, $reason, $invoiceId): bool {
                $currency = Packages::currency();

                $held = (int) Credit::query()
                    ->where('user_id', $userId)
                    ->where('currency', $currency)
                    ->lockForUpdate()
                    ->sum('amount');

                if ($held < $amount) {
                    return false;
                }

                Credit::query()->create([
                    'user_id' => $userId,
                    'amount' => -$amount,
                    'currency' => $currency,
                    'reason' => mb_substr(trim($reason), 0, 191),
                    'invoice_id' => $invoiceId,
                    'created_by' => null,
                ]);

                unset(self::$held[$userId]);

                return true;
            });
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * Offer this invoice whatever is on the balance now.
     *
     * Called where an invoice is written, so the customer is shown the real
     * figure on the payment page rather than being asked for money the shop
     * already holds - and called again whenever money lands on the balance,
     * because an invoice that was only half covered in January should finish
     * covering itself the moment there is something to cover it with.
     *
     * **It adds rather than replaces, and it is bounded by due().** That is
     * what makes running it any number of times safe without a flag saying it
     * has run: an invoice with nothing left to pay has nought owing and takes
     * nothing, whatever the balance. The first version refused outright once
     * `credit` was set, which made a top-up useless to anybody who had already
     * had part of a bill covered.
     *
     * @return int What was taken this time.
     */
    public static function settle(Invoice $invoice): int
    {
        if (!Features::enabled(Features::CREDIT)) {
            return 0;
        }

        $userId = (int) ($invoice->user_id ?? 0);

        if ($userId <= 0 || $invoice->state !== Invoice::UNPAID) {
            return 0;
        }

        /*
         * Neither of the two documents that are about the balance itself.
         *
         * A credit note is money going the other way. A top-up is somebody
         * buying credit, and paying for credit with credit is a sum that goes
         * round in a circle and settles nothing.
         */
        if ($invoice->kind === Invoice::CREDIT || $invoice->kind === Invoice::TOPUP) {
            return 0;
        }

        $owed = $invoice->due();

        if ($owed <= 0) {
            return 0;
        }

        $take = min($owed, self::balance($userId));

        if ($take <= 0) {
            return 0;
        }

        if (!self::spend($userId, $take, Theme::trans('credit.spent_on', [
            'number' => (string) $invoice->number,
        ]), (int) $invoice->id)) {
            return 0;
        }

        try {
            $invoice->forceFill(['credit' => (int) $invoice->credit + $take])->save();
        } catch (Throwable $exception) {
            /*
             * The ledger says spent and the invoice does not. That is the wrong
             * way round to fail and it is worth undoing: without this the
             * customer is short the money and still owes the whole amount.
             */
            report($exception);

            self::write($userId, $take, Theme::trans('credit.returned'), (int) $invoice->id, null);

            return 0;
        }

        return $take;
    }

    /**
     * Put whatever is on somebody's balance against whatever they owe.
     *
     * Oldest first, because the oldest is the one closest to being chased, and
     * a customer with fifty euro against a hundred owed would rather clear the
     * bill that is overdue than the one that is not.
     *
     * Anything that ends up fully covered is settled by the same road a real
     * payment takes, so the server is built, the period moves and the customer
     * is told - none of which has a second implementation here.
     *
     * @return int What was taken across all of them.
     */
    public static function settleOpen(int $userId): int
    {
        if ($userId <= 0 || !Features::enabled(Features::CREDIT) || self::balance($userId) <= 0) {
            return 0;
        }

        $taken = 0;

        try {
            $open = Invoice::query()
                ->where('user_id', $userId)
                ->where('state', Invoice::UNPAID)
                ->whereNotIn('kind', [Invoice::CREDIT, Invoice::TOPUP])
                ->orderBy('due_at')
                ->orderBy('id')
                ->limit(50)
                ->get();
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }

        foreach ($open as $invoice) {
            $took = self::settle($invoice);
            $taken += $took;

            if ($took > 0) {
                // Only worth asking when something moved. settleFree() checks
                // whether there is anything left to pay and picks the right
                // source for it.
                Invoices::settleFree($invoice);
            }

            // Nothing left to spend. Reading the balance once per invoice is
            // one query each; stopping when it is empty is what keeps a
            // customer with forty open invoices from being forty of them.
            if (self::balance($userId) <= 0) {
                break;
            }
        }

        return $taken;
    }

    /**
     * Every balance against every bill, once a day.
     *
     * The safety net rather than the mechanism: money landing already settles
     * what its owner owes, so on a shop that has been running this release the
     * whole time this finds nothing. It is here for the two cases that door
     * cannot cover - a balance that existed before this was written, and an
     * invoice that fell due after the money arrived - and for the third that
     * nobody has thought of yet.
     *
     * Only people who actually hold something are looked at, which on most
     * panels is nobody.
     *
     * @return int What was taken, across everybody.
     */
    public static function sweep(): int
    {
        if (!Features::enabled(Features::CREDIT)) {
            return 0;
        }

        try {
            $holders = Credit::query()
                ->where('currency', Packages::currency())
                ->groupBy('user_id')
                ->havingRaw('SUM(amount) > 0')
                ->pluck('user_id');
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }

        $taken = 0;

        foreach ($holders as $userId) {
            $taken += self::settleOpen((int) $userId);
        }

        return $taken;
    }

    /**
     * An invoice for putting money on the account.
     *
     * **No tax, and that is not an oversight.** Money on account is not a
     * supply of anything: nothing has been bought yet. The tax is worked out
     * and charged on the invoice this eventually settles, which is where the
     * thing being bought actually is. An invoice that taxed the top-up and then
     * taxed the purchase would charge it twice.
     *
     * The amount has a floor and a ceiling. The floor is there because no
     * provider will take a payment of nothing and most refuse very small ones;
     * the ceiling is a guard against a typed nought too many rather than a
     * policy about how much anybody may hold.
     */
    public static function topUp(?User $user, int $amount): ?Invoice
    {
        if (!Features::enabled(Features::CREDIT) || $user === null) {
            return null;
        }

        if ($amount < self::LEAST || $amount > self::MOST) {
            return null;
        }

        try {
            $invoice = new Invoice();

            $invoice->forceFill([
                'number' => Invoices::number(),
                'user_id' => (int) $user->id,
                'order_id' => null,
                'kind' => Invoice::TOPUP,
                'state' => Invoice::UNPAID,
                'subtotal' => $amount,
                'discount' => 0,
                'tax' => 0,
                'total' => $amount,
                'tax_rate' => 0,
                'currency' => Packages::currency(),
                'credit' => 0,
                'lines' => [[
                    'description' => Theme::trans('credit.topup_line'),
                    'quantity' => 1,
                    'amount' => $amount,
                ]],
                ...Customers::snapshot($user),
                'due_at' => now(),
            ])->save();

            return $invoice;
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }
    }

    /**
     * A paid top-up, put on the account.
     *
     * Called from Invoices::markPaid(). Guarded on the balance not already
     * carrying it, because a webhook and a customer's return both arrive here
     * and either can be first.
     */
    public static function credited(Invoice $invoice): void
    {
        if ($invoice->kind !== Invoice::TOPUP || !$invoice->paid()) {
            return;
        }

        try {
            $already = Credit::query()
                ->where('invoice_id', (int) $invoice->id)
                ->where('amount', '>', 0)
                ->exists();

            if ($already) {
                return;
            }
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        self::add(
            (int) ($invoice->user_id ?? 0),
            (int) $invoice->total,
            Theme::trans('credit.topup_reason', ['number' => (string) $invoice->number]),
            (int) $invoice->id,
            null,
        );
    }

    /**
     * Write a credit note against an invoice.
     *
     * The document, and only the document. Whether the money went back to a
     * card or on to the account is the caller's decision, because those are two
     * different things happening in the world and this cannot tell which one
     * did.
     *
     * @param  int  $amount  Minor units, positive, never more than the original.
     */
    public static function note(Invoice $about, int $amount, string $reason = ''): ?Invoice
    {
        if (!Features::enabled(Features::CREDIT) || $amount <= 0) {
            return null;
        }

        if ($amount > self::refundable($about)) {
            return null;
        }

        try {
            $note = new Invoice();

            $note->forceFill([
                'number' => Invoices::number(),
                'user_id' => $about->user_id,

                /*
                 * No order, on purpose. A credit note is about a document and
                 * not about a service: refunding half of somebody's first month
                 * does not un-build their server, and an order_id here would put
                 * this note in every list that asks what an order has cost.
                 */
                'order_id' => null,
                'kind' => Invoice::CREDIT,

                // Issued settled. It is not a demand for money; it is a record
                // that some was given back, and there is nothing to wait for.
                'state' => Invoice::PAID,
                'paid_at' => now(),
                'paid_via' => Invoice::MANUAL,

                /*
                 * Positive figures whose meaning is negative.
                 *
                 * The columns are unsigned and every reader of them adds them
                 * up; a negative total would need each of those readers to know
                 * about this one kind of row. Takings subtracts credit notes
                 * instead, in the one place that reports money.
                 */
                'subtotal' => $amount,
                'discount' => 0,
                'tax' => 0,
                'total' => $amount,
                'tax_rate' => (int) $about->tax_rate,
                'currency' => $about->currency,
                'credit' => 0,
                'credit_for' => (int) $about->id,

                // What it says on the document is whatever reason was given,
                // and the plain sentence when none was. A credit note whose one
                // line reads "credit note" tells the customer nothing they did
                // not already see in the heading.
                'lines' => [[
                    'description' => trim($reason) !== ''
                        ? mb_substr(trim($reason), 0, 191)
                        : Theme::trans('credit.note_line', ['number' => (string) $about->number]),
                    'quantity' => 1,
                    'amount' => $amount,
                ]],

                /*
                 * Who it was for, copied off the original rather than read
                 * fresh. A credit note about a document has to name the same
                 * party that document named, whatever the customer has changed
                 * about themselves since.
                 */
                'customer_name' => $about->customer_name,
                'customer_email' => $about->customer_email,
                'customer_company' => $about->customer_company,
                'customer_address' => $about->customer_address,
                'customer_country' => $about->customer_country,
                'customer_vat' => $about->customer_vat,

                'due_at' => null,
            ])->save();
        } catch (Throwable $exception) {
            report($exception);

            return null;
        }

        return $note;
    }

    /**
     * What of an invoice has not been given back yet.
     *
     * Its total less every credit note already written against it, so a second
     * partial refund cannot take the amount past the whole.
     */
    public static function refundable(Invoice $invoice): int
    {
        if (!$invoice->paid() || $invoice->kind === Invoice::CREDIT) {
            return 0;
        }

        try {
            $given = (int) Invoice::query()
                ->where('kind', Invoice::CREDIT)
                ->where('credit_for', (int) $invoice->id)
                ->sum('total');
        } catch (Throwable) {
            $given = 0;
        }

        return max(0, (int) $invoice->total - $given);
    }

    /**
     * This person's movements, newest first.
     *
     * @return Collection<int, Credit>
     */
    public static function history(int $userId, int $limit = 50): Collection
    {
        if ($userId <= 0 || !Features::enabled(Features::CREDIT)) {
            return new Collection();
        }

        try {
            return Credit::query()
                ->where('user_id', $userId)
                ->orderByDesc('id')
                ->limit($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Everybody's balance in one query, for a table that would otherwise ask
     * per row.
     *
     * @param  array<int, int>  $userIds
     * @return array<int, int>
     */
    public static function balances(array $userIds): array
    {
        if ($userIds === [] || !Features::enabled(Features::CREDIT)) {
            return [];
        }

        try {
            return Credit::query()
                ->whereIn('user_id', $userIds)
                ->where('currency', Packages::currency())
                ->groupBy('user_id')
                ->selectRaw('user_id, SUM(amount) as held')
                ->pluck('held', 'user_id')
                ->map(static fn ($held): int => (int) $held)
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /** Whoever is signed in, which is who every customer-facing caller means. */
    public static function mine(): int
    {
        return self::balance((int) (user()?->id ?? 0));
    }

    /** The one place a row is made, so a movement always looks the same. */
    private static function write(
        int $userId,
        int $amount,
        string $reason,
        ?int $invoiceId,
        ?int $by,
    ): bool {
        if ($userId <= 0 || $amount === 0 || !Features::enabled(Features::CREDIT)) {
            return false;
        }

        try {
            Credit::query()->create([
                'user_id' => $userId,
                'amount' => $amount,
                'currency' => Packages::currency(),
                'reason' => mb_substr(trim($reason), 0, 191),
                'invoice_id' => $invoiceId,
                'created_by' => $by,
            ]);

            unset(self::$held[$userId]);

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /** Only here so the class can be asked about somebody by model. */
    public static function of(?User $user): int
    {
        return self::balance((int) ($user?->id ?? 0));
    }
}
