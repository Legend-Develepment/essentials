{{--
    One service, and everything about it.

    The list of cards answers "what do I have". This answers the question
    somebody actually arrives with: what is happening with this one. Read top
    to bottom in the order people ask - what is it and is it all right, what
    does it cost and when, what has it been billed, what can I change, what did
    I ask about it.

    The head and the controls are the same data and the same markup the card
    uses, so the two screens cannot describe one service differently.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $service = $this->card();
    $next = $this->next();
    $bills = $this->bills();
    $asked = $this->asked();

    $words = [
        'gone' => Theme::trans('shop.service_gone'),
        'gone_body' => Theme::trans('shop.service_gone_body'),
        'open' => Theme::trans('shop.open_server'),
        'building' => Theme::trans('shop.no_server_yet'),
        'renews' => Theme::trans('shop.renews'),
        'next' => Theme::trans('shop.service_next'),
        'bills' => Theme::trans('shop.service_bills'),
        'bills_none' => Theme::trans('shop.service_bills_none'),
        'notes' => Theme::trans('shop.service_notes'),
        'share' => Theme::trans('shop.service_share'),
        'owed' => Theme::trans('shop.service_owed'),
        'paid_on' => Theme::trans('shop.service_paid_on'),
        'pay' => Theme::trans('shop.service_pay'),
        'asked' => Theme::trans('shop.service_asked'),
        'asked_none' => Theme::trans('shop.service_asked_none'),
        'stuck' => Theme::trans('shop.service_stuck'),
    ];
@endphp

<x-filament-panels::page>
    @if ($service === null)
        {{-- Somebody else's service reads exactly like one that was never
             there. An id in an address is an id people edit, and telling the
             two apart would let them count what this panel has sold. --}}
        <div class="ld-shop-empty">
            <strong>{{ $words['gone'] }}</strong>
            <span>{{ $words['gone_body'] }}</span>
        </div>
    @else
        <div class="ld-svc">
            <section class="ld-svc-head">
                @if ($service['art'] !== null)
                    <div class="ld-shop-shot">
                        <img class="ld-shop-art-back" src="{{ $service['art'] }}" alt="" aria-hidden="true" loading="lazy">
                        <img class="ld-shop-art" src="{{ $service['art'] }}" alt="" loading="lazy">
                    </div>
                @endif

                <div class="ld-bill-row">
                    <span class="ld-bill-name">{{ $service['name'] }}</span>
                    <span class="ld-bill-badge ld-bill-badge--{{ $service['colour'] }}">{{ $service['state'] }}</span>
                </div>

                <ul class="ld-shop-specs">
                    @foreach ($service['specs'] as $spec)
                        <li>{{ $spec }}</li>
                    @endforeach
                </ul>

                <p class="ld-shop-setup">
                    {{ $service['price'] }}

                    @if ($service['due'] !== null)
                        &middot; {{ $words['renews'] }} {{ $service['due'] }}
                    @endif
                </p>

                @if ($service['server_state'] !== null)
                    <p class="ld-bill-note">{{ $service['server_state'] }}</p>
                @endif

                @if ($service['note'] !== null)
                    <p class="ld-bill-note">{{ $service['note'] }}</p>
                @endif

                {{-- A change that was paid for and then refused. The
                     administrator's page has said so since upgrades existed;
                     the customer saw a service that had simply not changed. --}}
                @if ($service['stuck'] !== null)
                    <p class="ld-bill-waiting">
                        {{ Theme::trans('shop.service_stuck_body', ['name' => $service['stuck']['name']]) }}
                    </p>
                @endif

                @if ($service['url'] !== null)
                    <a class="ld-shop-buy" href="{{ $service['url'] }}">{{ $words['open'] }}</a>
                @else
                    <span class="ld-shop-buy ld-shop-buy--off">{{ $words['building'] }}</span>
                @endif
            </section>

            {{-- What it will cost next time, through the same lines and the
                 same arithmetic the nightly pass uses - so this page cannot
                 quote a figure the invoice will not say. --}}
            @if ($next !== null)
                <section class="ld-svc-block">
                    <h3>{{ $words['next'] }}</h3>

                    <ul class="ld-svc-lines">
                        @foreach ($next['lines'] as $line)
                            <li>
                                <span>{{ $line['text'] }}</span>
                                <span>{{ $line['amount'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <p class="ld-svc-total">
                        <strong>{{ $next['total'] }}</strong>

                        @if ($next['due'] !== null)
                            <span>{{ $words['renews'] }} {{ $next['due'] }}</span>
                        @endif
                    </p>

                    <p class="ld-bill-note">{{ $next['bundled'] }}</p>
                </section>
            @endif

            <section class="ld-svc-block">
                <h3>{{ $words['bills'] }}</h3>

                @if (count($bills['invoices']) === 0)
                    <p class="ld-bill-note">{{ $words['bills_none'] }}</p>
                @else
                    <ul class="ld-ticket-list">
                        @foreach ($bills['invoices'] as $invoice)
                            <li>
                                <div class="ld-bill-row">
                                    <span class="ld-bill-name">{{ $invoice['number'] }}</span>
                                    <span class="ld-bill-badge ld-bill-badge--{{ $invoice['colour'] }}">{{ $invoice['state'] }}</span>
                                </div>

                                <div class="ld-bill-meta">
                                    <span>{{ $invoice['kind'] }}</span>
                                    <span>{{ $invoice['total'] }}</span>

                                    {{-- This service's part of a bill that
                                         covers more than one, where the panel
                                         knows it. Adding totals up would say
                                         this service cost twice what it did. --}}
                                    @if ($invoice['share'] !== null)
                                        <span>{{ $words['share'] }} {{ $invoice['share'] }}</span>
                                    @endif

                                    @if ($invoice['paid_at'] !== null)
                                        <span>{{ $words['paid_on'] }} {{ $invoice['paid_at'] }}</span>
                                    @elseif ($invoice['due'] !== null)
                                        <span>{{ $words['owed'] }} {{ $invoice['owed'] }} &middot; {{ $invoice['due'] }}</span>
                                    @endif

                                    @if ($invoice['url'] !== null)
                                        <a href="{{ $invoice['url'] }}" target="_blank" rel="noopener">{{ $invoice['number'] }}</a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- And what came back off them. A credit note carries no
                     service of its own - refunding half of somebody's first
                     month does not un-build their server - so it is found
                     through the invoices it was written against. --}}
                @if (count($bills['notes']) > 0)
                    <h3>{{ $words['notes'] }}</h3>

                    <ul class="ld-ticket-list">
                        @foreach ($bills['notes'] as $note)
                            <li>
                                <div class="ld-bill-row">
                                    <span class="ld-bill-name">{{ $note['number'] }}</span>
                                    <span class="ld-bill-badge ld-bill-badge--{{ $note['colour'] }}">{{ $note['kind'] }}</span>
                                </div>

                                <div class="ld-bill-meta">
                                    <span>{{ $note['total'] }}</span>

                                    @if ($note['url'] !== null)
                                        <a href="{{ $note['url'] }}" target="_blank" rel="noopener">{{ $note['number'] }}</a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>

            <section class="ld-svc-block">
                @include(Theme::id() . '::partials.service-does', ['service' => $service])
            </section>

            {{-- What has been asked about this one. The whole argument for
                 tickets in the panel is that a question knows which service it
                 is about, and this is the other end of that. --}}
            <section class="ld-svc-block">
                <h3>{{ $words['asked'] }}</h3>

                @if (count($asked) === 0)
                    <p class="ld-bill-note">{{ $words['asked_none'] }}</p>
                @else
                    <ul class="ld-ticket-list">
                        @foreach ($asked as $ticket)
                            <li>
                                <div class="ld-bill-row">
                                    <span class="ld-bill-name">{{ $ticket['subject'] }}</span>
                                    <span class="ld-bill-badge ld-bill-badge--{{ $ticket['colour'] }}">{{ $ticket['state'] }}</span>
                                </div>

                                <div class="ld-bill-meta">
                                    <span>{{ $ticket['number'] }}</span>
                                    <span>{{ $ticket['when'] }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
