<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Support\Shop\Tables;
use Throwable;

/**
 * What somebody owes, or paid.
 *
 * Every amount is minor units and every amount is a snapshot: the lines, the
 * tax rate, the currency and the customer's name are copied in when the
 * invoice is made, because a document that changes after it was issued is not
 * a document. Editing the package, changing the tax rate, renaming the account
 * - none of it reaches an invoice already written.
 *
 * Three states. `unpaid` is the only one that can change on its own; `paid`
 * and `cancelled` are final, and a paid invoice is never cancelled - a refund
 * is a separate record and a later release.
 */
class Invoice extends Model
{
    public const TABLE = 'essentials_invoices';

    /** The first invoice for an order: the package, and any setup fee. */
    public const ORDER = 'order';

    /** One period more of the same. */
    public const RENEWAL = 'renewal';

    /**
     * An extra bought part-way through a period.
     *
     * A kind of its own for the same reason an upgrade has one: settled as a
     * renewal it would advance the due date, and a customer who bought a
     * gigabyte would get a free month for it.
     */
    public const ADDON = 'addon';

    /**
     * Money put on the account, bought as a thing in itself.
     *
     * No tax on it: nothing has been supplied yet. The tax is charged on
     * whatever this eventually pays for, which is where the supply is. Taxing
     * both would charge it twice.
     */
    public const TOPUP = 'topup';

    /**
     * The difference between two packages, mid-period.
     *
     * Its own kind because of what settling one must not do: an upgrade
     * invoice does not move a due date and does not build anything. It is a
     * charge inside a period that is already paid for, and treating it as a
     * renewal would give the customer a free month every time they upgraded.
     */
    public const UPGRADE = 'upgrade';

    /**
     * Money given back, as a document.
     *
     * Its figures are positive and their meaning is negative, because the
     * amount columns are unsigned and everything that reads them adds them up.
     * Takings is the one place that has to know, and it subtracts these.
     */
    public const CREDIT = 'credit';

    public const UNPAID = 'unpaid';

    public const PAID = 'paid';

    public const CANCELLED = 'cancelled';

    /** Marked paid by hand, on the admin page. */
    public const MANUAL = 'manual';

    /**
     * Settled out of what the shop was already holding for this customer.
     *
     * Its own source rather than free or manual: nobody paid anything today,
     * but somebody did once, and an administrator reading the invoices page
     * should be able to tell the difference between money that arrived and
     * money that was moved.
     */
    public const BALANCE = 'balance';

    /**
     * Settled because there was nothing to settle.
     *
     * A coupon that takes everything off, or a package priced at nothing, ends
     * at a total of zero - and zero is not a thing a payment provider will take.
     * Recorded as its own source rather than as manual, because nobody did
     * anything: an administrator reading the invoices page should not see a
     * payment somebody has to be asked about.
     */
    public const FREE = 'free';

    protected $table = self::TABLE;

    protected $fillable = [
        'number',
        'user_id',
        'order_id',
        'kind',
        'state',
        'subtotal',
        'discount',
        'tax',
        'total',
        'tax_rate',
        'currency',
        'coupon_code',
        'credit',
        'credit_for',
        'addon_for',
        'lines',
        'customer_name',
        'customer_email',
        'customer_vat',
        'customer_company',
        'customer_address',
        'customer_country',
        'due_at',
        'paid_at',
        'reminded_at',
        'paid_via',
        'emailed_at',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            // The buyer's address, as the lines it should print as.
            'customer_address' => 'array',
            'order_id' => 'integer',
            'subtotal' => 'integer',
            'discount' => 'integer',
            'tax' => 'integer',
            'total' => 'integer',
            'tax_rate' => 'integer',
            'credit' => 'integer',
            'credit_for' => 'integer',
            // Which addon an addon invoice is for, and how many. On the
            // document rather than in a table of its own: it is two integers.
            'addon_for' => 'array',
            'lines' => 'array',
            'due_at' => 'datetime',
            'paid_at' => 'datetime',
            'reminded_at' => 'datetime',
            'emailed_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return BelongsTo<Order, $this> */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /** @return HasMany<Payment, $this> */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    /**
     * Every order this invoice bills.
     *
     * The pairing table, for an invoice that covers more than one - a basket,
     * or a renewal that fell due on the same day for two services.
     *
     * @return BelongsToMany<Order, $this>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, Tables::INVOICE_ORDERS, 'invoice_id', 'order_id')
            ->withPivot('amount')
            ->withTimestamps();
    }

    /**
     * The same question, answered for every invoice there has ever been.
     *
     * Invoices written before the basket existed have no rows in the pairing
     * table and name their one order in order_id. Reading them through here
     * means nothing had to be back-filled, and means a caller never has to ask
     * which era an invoice is from - which is the sort of question that gets
     * asked correctly in four places and forgotten in the fifth.
     *
     * @return Collection<int, Order>
     */
    public function billed(): Collection
    {
        try {
            // What the table already loaded, when it did. A list of invoices
            // asks this once per row, and a relation fetched per row is a page
            // that gets slower the longer somebody has been selling.
            $orders = $this->relationLoaded('orders') ? $this->orders : $this->orders()->get();

            if ($orders->isNotEmpty()) {
                return $orders;
            }
        } catch (Throwable) {
            // No pairing table yet - a panel between the file swap and the
            // install. The one order below is the honest answer there.
        }

        $order = $this->order;

        return $order instanceof Order ? new Collection([$order]) : new Collection();
    }

    public function paid(): bool
    {
        return $this->state === self::PAID;
    }

    /**
     * What the customer actually has to hand over.
     *
     * The total less whatever was settled out of their balance. The total
     * itself is left alone on purpose: it says what the supply cost and what
     * tax was due on it, and neither of those changes because the buyer
     * happened to have money on account. Every provider is asked for this, and
     * the document prints both figures.
     */
    public function due(): int
    {
        return max(0, (int) $this->total - (int) $this->credit);
    }

    /** Whether the balance covered part of this, and how visibly. */
    public function settledFromCredit(): bool
    {
        return (int) $this->credit > 0;
    }

    /**
     * Nothing to pay: a coupon took it all, it never cost anything, or the
     * customer's balance covered the lot.
     *
     * The third case is why this asks due() rather than the total. It used to
     * ask the total, which was the same question until credit existed.
     */
    public function free(): bool
    {
        return $this->due() <= 0;
    }

    /** Money given back rather than money owed. */
    public function note(): bool
    {
        return $this->kind === self::CREDIT;
    }

    public function open(): bool
    {
        return $this->state === self::UNPAID;
    }

    /** Past due and still unpaid. */
    public function overdue(): bool
    {
        return $this->open() && $this->due_at !== null && $this->due_at->isPast();
    }
}
