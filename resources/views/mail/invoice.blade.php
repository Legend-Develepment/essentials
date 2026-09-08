{{--
    The invoice, in somebody's inbox.

    Plain HTML with inline styles, because that is what mail clients actually
    render: no stylesheet block, no custom properties, no grid. A table for the
    lines, because a table in mail is the one layout every client agrees about.

    Nothing is looked up here that is not already on the invoice. The lines, the
    totals and the name were snapshotted when it was written, so a copy resent
    a year later says exactly what the document says.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $rate = (int) $invoice->tax_rate;

    $words = [
        'hello' => Theme::trans('invoices.mail_hello', ['name' => (string) $invoice->customer_name]),
        'intro' => Theme::trans('invoices.mail_intro', ['number' => (string) $invoice->number]),
        'description' => Theme::trans('invoices.doc_description'),
        'amount' => Theme::trans('invoices.doc_amount'),
        'subtotal' => Theme::trans('invoices.doc_subtotal'),
        'discount' => Theme::trans('invoices.doc_discount'),
        'total' => Theme::trans('invoices.doc_total'),
        'due' => Theme::trans('invoices.doc_due'),
        'open' => Theme::trans('invoices.mail_open'),
        'foot' => Theme::trans('invoices.mail_foot'),
        'tax' => Theme::trans('shop.tax_line', [
            'rate' => rtrim(rtrim(number_format($rate / 100, 2, '.', ''), '0'), '.'),
        ]),
    ];
@endphp
<div style="font: 15px/1.6 system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif; color: #16181d; max-width: 34rem;">
    <p>{{ $words['hello'] }}</p>

    <p>{{ $words['intro'] }}</p>

    <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; margin: 1.25rem 0;">
        <tr>
            <th align="left" style="padding: 0.4rem 0; border-bottom: 2px solid #e3e6ea; font-size: 0.8125rem; color: #5c636b;">
                {{ $words['description'] }}
            </th>
            <th align="right" style="padding: 0.4rem 0; border-bottom: 2px solid #e3e6ea; font-size: 0.8125rem; color: #5c636b;">
                {{ $words['amount'] }}
            </th>
        </tr>

        @foreach ($lines as $line)
            <tr>
                <td style="padding: 0.5rem 0; border-bottom: 1px solid #eceef1;">{{ $line['text'] ?? '' }}</td>
                <td align="right" style="padding: 0.5rem 0; border-bottom: 1px solid #eceef1;">
                    {{ $money((int) ($line['amount'] ?? 0)) }}
                </td>
            </tr>
        @endforeach

        <tr>
            <td align="right" style="padding: 0.5rem 0; color: #5c636b;">{{ $words['subtotal'] }}</td>
            <td align="right" style="padding: 0.5rem 0;">{{ $money((int) $invoice->subtotal) }}</td>
        </tr>

        @if ((int) $invoice->discount > 0)
            <tr>
                <td align="right" style="padding: 0.2rem 0; color: #5c636b;">
                    {{ $words['discount'] }}@if ($invoice->coupon_code) ({{ $invoice->coupon_code }})@endif
                </td>
                <td align="right" style="padding: 0.2rem 0;">-{{ $money((int) $invoice->discount) }}</td>
            </tr>
        @endif

        @if ($rate > 0)
            <tr>
                <td align="right" style="padding: 0.2rem 0; color: #5c636b;">{{ $words['tax'] }}</td>
                <td align="right" style="padding: 0.2rem 0;">{{ $money((int) $invoice->tax) }}</td>
            </tr>
        @endif

        <tr>
            <td align="right" style="padding: 0.6rem 0 0; border-top: 2px solid #e3e6ea; font-weight: 700;">
                {{ $words['total'] }}
            </td>
            <td align="right" style="padding: 0.6rem 0 0; border-top: 2px solid #e3e6ea; font-weight: 700;">
                {{ $money((int) $invoice->total) }}
            </td>
        </tr>
    </table>

    @if ($invoice->due_at !== null && $invoice->open())
        <p style="color: #5c636b;">{{ $words['due'] }} {{ $invoice->due_at->toFormattedDateString() }}</p>
    @endif

    <p>
        <a href="{{ $address }}" style="display: inline-block; padding: 0.6rem 1.1rem; border-radius: 0.5rem; background: #16181d; color: #fff; text-decoration: none; font-weight: 600;">
            {{ $words['open'] }}
        </a>
    </p>

    <p style="color: #5c636b; font-size: 0.875rem;">{{ $words['foot'] }}</p>
</div>
