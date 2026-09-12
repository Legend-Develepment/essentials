<?php

namespace LegendDevelopment\Theme\Http;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Filament\App\Pages\Billing;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Payment;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The two addresses a payment provider and a returning customer land on.
 *
 * They do the same thing - re-read the payment and settle it if it is paid -
 * and they exist separately because either can arrive first and neither can be
 * relied on. A webhook may be blocked by a firewall in front of the panel; a
 * customer may close the tab before being sent back. Whichever gets here
 * first does the work, and the second finds an invoice already paid and stops,
 * because markPaid() reads the invoice before it does anything.
 *
 * **The webhook has no session and no forgery token, deliberately.** It is a
 * POST from somebody else's server, the way the plugin's own API routes are
 * requests from a bot; `web` middleware would put a login session in front of
 * a machine. What stands in for it is that nothing in the body is believed:
 * the provider is asked, over an authenticated connection, what actually
 * happened.
 */
class PayController
{
    /** Where a provider posts. Answers plainly, and never with a stack trace. */
    public function hook(Request $request, string $gateway): JsonResponse
    {
        $provider = Gateways::get($gateway);

        if ($provider === null) {
            return response()->json(['ok' => false], 404);
        }

        try {
            $payment = $provider->webhook($request);
        } catch (Throwable $exception) {
            report($exception);

            /*
             * 200 rather than 500, on purpose.
             *
             * Every provider retries a failed webhook, and a panel with one
             * broken row would be retried at for days. The exception is
             * reported where an administrator can see it; the provider is told
             * the message arrived, which it did.
             */
            return response()->json(['ok' => false], 200);
        }

        if (!$payment instanceof Payment) {
            return response()->json(['ok' => false], 200);
        }

        try {
            $provider->settle($payment);
        } catch (Throwable $exception) {
            report($exception);
        }

        return response()->json(['ok' => true]);
    }

    /**
     * Where the customer comes back to.
     *
     * Behind auth, and it checks the invoice is theirs before doing anything -
     * an address with an invoice id in it is an address somebody will edit.
     * Then it settles, so a panel whose webhooks never arrive still works: the
     * customer coming back is the trigger.
     */
    public function back(Request $request, string $gateway, int $invoice): RedirectResponse
    {
        $provider = Gateways::get($gateway);
        $user = $request->user();

        if ($provider === null || !$user instanceof User) {
            return redirect()->to(Billing::getUrl());
        }

        try {
            $row = Invoice::query()->find($invoice);
        } catch (Throwable) {
            $row = null;
        }

        if (!$row instanceof Invoice || (int) $row->user_id !== (int) $user->id) {
            return redirect()->to(Billing::getUrl());
        }

        // Whatever this provider last opened for this invoice. A customer who
        // pressed Pay twice has two rows; the newest is the one they just came
        // back from.
        try {
            $payment = Payment::query()
                ->where('invoice_id', (int) $row->id)
                ->where('gateway', $gateway)
                ->orderByDesc('id')
                ->first();
        } catch (Throwable) {
            $payment = null;
        }

        if ($payment instanceof Payment) {
            try {
                $provider->settle($payment);
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return redirect()
            ->to(Billing::getUrl())
            ->with('status', Theme::trans($row->fresh()?->paid()
                ? 'shop.pay_thanks'
                : 'shop.pay_pending'));
    }
}
