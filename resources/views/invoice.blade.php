{{--
    One invoice, laid out for paper.

    There is no PDF library available to a Pelican plugin and adding a composer
    dependency is not something a plugin can do, so the printable document is
    HTML with a print stylesheet - which every browser turns into a PDF from its
    own print dialog. That is not a workaround: the result is a file the reader
    chose the name of, and it needs nothing installed on the server.

    Black on white in both modes. An invoice is a document, and a dark one wastes
    a cartridge and reads badly on paper.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'invoice' => Theme::trans('invoices.doc_title'),
        'number' => Theme::trans('invoices.doc_number'),
        'issued' => Theme::trans('invoices.doc_issued'),
        'due' => Theme::trans('invoices.doc_due'),
        'billed_to' => Theme::trans('invoices.doc_billed_to'),
        'from' => Theme::trans('invoices.doc_from'),
        'description' => Theme::trans('invoices.doc_description'),
        'amount' => Theme::trans('invoices.doc_amount'),
        'subtotal' => Theme::trans('invoices.doc_subtotal'),
        'discount' => Theme::trans('invoices.doc_discount'),
        'total' => Theme::trans('invoices.doc_total'),
        'paid' => Theme::trans('invoices.state_paid'),
        'unpaid' => Theme::trans('invoices.state_unpaid'),
        'cancelled' => Theme::trans('invoices.state_cancelled'),
        'how_to_pay' => Theme::trans('invoices.doc_how_to_pay'),
        'print' => Theme::trans('invoices.doc_print'),
        'back' => Theme::trans('invoices.doc_back'),
        'paid_on' => Theme::trans('invoices.doc_paid_on'),
    ];

    $rate = (int) $invoice->tax_rate;
    $taxLabel = Theme::trans('shop.tax_line', [
        'rate' => rtrim(rtrim(number_format($rate / 100, 2, '.', ''), '0'), '.'),
    ]);

    $stateWord = match ($invoice->state) {
        'paid' => $words['paid'],
        'cancelled' => $words['cancelled'],
        default => $words['unpaid'],
    };
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $invoice->number }}</title>
    <meta name="robots" content="noindex, nofollow">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 2.5rem 1.25rem 4rem;
            background: #f2f3f5;
            color: #16181d;
            font: 15px/1.6 system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .sheet {
            max-width: 46rem;
            margin: 0 auto;
            padding: 2.5rem;
            background: #fff;
            border: 1px solid #e3e6ea;
            border-radius: 0.5rem;
        }

        .top {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        h1 { margin: 0 0 0.25rem; font-size: 1.5rem; }

        .num { color: #5c636b; font-variant-numeric: tabular-nums; }

        .state {
            align-self: flex-start;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .state--paid { background: #e6f4ea; color: #1e7a3c; }

        .state--unpaid { background: #fdf3e2; color: #8a5a00; }

        .state--cancelled { background: #eceef1; color: #5c636b; }

        .parties {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(14rem, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .parties h2 {
            margin: 0 0 0.35rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #5c636b;
        }

        .parties p { margin: 0; }

        .parties .quiet { color: #5c636b; }

        table { width: 100%; border-collapse: collapse; }

        th, td { padding: 0.6rem 0; text-align: start; }

        thead th {
            border-bottom: 2px solid #e3e6ea;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #5c636b;
        }

        tbody td { border-bottom: 1px solid #eceef1; }

        .money { text-align: end; font-variant-numeric: tabular-nums; white-space: nowrap; }

        tfoot td { border: 0; padding-top: 0.4rem; }

        tfoot .label { text-align: end; color: #5c636b; }

        tfoot .sum td {
            padding-top: 0.8rem;
            border-top: 2px solid #e3e6ea;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .pay {
            margin-top: 2rem;
            padding: 1rem 1.25rem;
            border: 1px solid #e3e6ea;
            border-radius: 0.5rem;
            background: #fbfcfd;
            white-space: pre-line;
        }

        .pay h2 { margin: 0 0 0.35rem; font-size: 0.9375rem; }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            max-width: 46rem;
            margin: 1.25rem auto 0;
        }

        .actions a, .actions button {
            padding: 0.5rem 1rem;
            border: 1px solid #d5d9de;
            border-radius: 0.5rem;
            background: #fff;
            color: #16181d;
            font: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        /* The page as it goes on paper: no chrome, no buttons, no background
           the printer has to fill in. */
        @media print {
            body { padding: 0; background: #fff; }

            .sheet { max-width: none; border: 0; border-radius: 0; padding: 0; }

            .actions { display: none; }
        }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="top">
            <div>
                <h1>{{ $words['invoice'] }}</h1>
                <p class="num">{{ $words['number'] }} {{ $invoice->number }}</p>
            </div>

            <span class="state state--{{ $invoice->state }}">{{ $stateWord }}</span>
        </div>

        <div class="parties">
            <div>
                <h2>{{ $words['from'] }}</h2>
                <p>{{ $issuer }}</p>
                <p class="quiet">{{ $panelUrl }}</p>
            </div>

            <div>
                <h2>{{ $words['billed_to'] }}</h2>
                <p>{{ $invoice->customer_name }}</p>
                <p class="quiet">{{ $invoice->customer_email }}</p>
            </div>

            <div>
                <h2>{{ $words['issued'] }}</h2>
                <p>{{ $invoice->created_at?->toFormattedDateString() }}</p>

                @if ($invoice->paid_at !== null)
                    <p class="quiet">{{ $words['paid_on'] }} {{ $invoice->paid_at->toFormattedDateString() }}</p>
                @elseif ($invoice->due_at !== null)
                    <p class="quiet">{{ $words['due'] }} {{ $invoice->due_at->toFormattedDateString() }}</p>
                @endif
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>{{ $words['description'] }}</th>
                    <th class="money">{{ $words['amount'] }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($lines as $line)
                    <tr>
                        <td>{{ $line['text'] ?? '' }}</td>
                        <td class="money">{{ $money((int) ($line['amount'] ?? 0)) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td class="label">{{ $words['subtotal'] }}</td>
                    <td class="money">{{ $money((int) $invoice->subtotal) }}</td>
                </tr>

                @if ((int) $invoice->discount > 0)
                    <tr>
                        <td class="label">
                            {{ $words['discount'] }}
                            @if ($invoice->coupon_code)
                                ({{ $invoice->coupon_code }})
                            @endif
                        </td>
                        <td class="money">-{{ $money((int) $invoice->discount) }}</td>
                    </tr>
                @endif

                @if ($rate > 0)
                    <tr>
                        <td class="label">{{ $taxLabel }}</td>
                        <td class="money">{{ $money((int) $invoice->tax) }}</td>
                    </tr>
                @endif

                <tr class="sum">
                    <td class="label">{{ $words['total'] }}</td>
                    <td class="money">{{ $money((int) $invoice->total) }}</td>
                </tr>
            </tfoot>
        </table>

        @if ($payNote !== '')
            <div class="pay">
                <h2>{{ $words['how_to_pay'] }}</h2>
                {{ $payNote }}
            </div>
        @endif
    </div>

    <div class="actions">
        <button type="button" onclick="window.print()">{{ $words['print'] }}</button>
        <a href="{{ $panelUrl }}">{{ $words['back'] }}</a>
    </div>
</body>
</html>
