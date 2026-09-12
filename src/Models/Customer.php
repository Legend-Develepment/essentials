<?php

namespace LegendDevelopment\Theme\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LegendDevelopment\Theme\Support\Shop\Tables;

/**
 * Who the customer is, as opposed to which account they signed in with.
 *
 * Pelican knows a username and an email address, which is what a panel needs
 * and not what an invoice needs. A business buying a server has a name, an
 * address, a country and a VAT number, and in the Netherlands - and broadly
 * across the EU - an invoice without them is not a document their accountant
 * can use.
 *
 * Every field here is optional, and that is the design rather than laziness.
 * Somebody buying one game server for themselves needs none of it and must not
 * be made to fill it in; a business needs all of it. So the row exists from the
 * moment anything is filled in and not before, and every reader copes with its
 * absence.
 *
 * **Read from here, print from the invoice.** This is what the customer is
 * today; an invoice keeps what they were when it was written. Somebody who
 * moves house next year must not change where a document from this year says
 * they lived.
 */
class Customer extends Model
{
    public const TABLE = Tables::CUSTOMERS;

    protected $table = self::TABLE;

    protected $fillable = [
        'user_id',
        'company',
        'address',
        'postcode',
        'city',
        'country',
        'phone',
        'vat',
        'notes',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            // The address is lines, because every country orders street,
            // number, postcode and city differently and a form that insists on
            // one order is a form somebody has to fight.
            'address' => 'array',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Whether there is enough here to print as an address.
     *
     * A country on its own is a setting; a country with a line of address under
     * it is somewhere to send a bill.
     */
    public function addressed(): bool
    {
        return $this->lines() !== [] && trim((string) $this->city) !== '';
    }

    /**
     * The address as the lines it should print as, empty ones dropped - so a
     * trailing newline in a text box is not a gap on a document.
     *
     * @return array<int, string>
     */
    public function lines(): array
    {
        $out = [];

        foreach ((array) ($this->address ?? []) as $line) {
            $line = trim((string) $line);

            if ($line !== '') {
                $out[] = mb_substr($line, 0, 120);
            }
        }

        return array_slice($out, 0, 6);
    }
}
