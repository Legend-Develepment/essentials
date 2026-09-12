{{--
    A customer's own questions.

    The list, and the conversation in a window over it - the same window staff
    read it in, because it is the same conversation and two templates for that
    is two places for it to drift. One page rather than two: somebody with three
    tickets does not need navigation, and somebody with thirty is not who this
    is for.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $tickets = $this->tickets();

    $words = [
        'empty' => Theme::trans('tickets.mine_empty'),
        'empty_body' => Theme::trans('tickets.mine_empty_body'),
        'read' => Theme::trans('tickets.read'),
        'claim' => Theme::trans('tickets.claim'),
    ];
@endphp

<x-filament-panels::page>
    @if (count($tickets) === 0)
        <div class="ld-shop-empty">
            <strong>{{ $words['empty'] }}</strong>
            <span>{{ $words['empty_body'] }}</span>
        </div>
    @else
        <section class="ld-bill">
            <ul class="ld-ticket-list">
                @foreach ($tickets as $ticket)
                    <li>
                        <div class="ld-bill-row">
                            <span class="ld-bill-name">{{ $ticket['subject'] }}</span>
                            <span class="ld-bill-badge ld-bill-badge--{{ $ticket['colour'] }}">{{ $ticket['state'] }}</span>
                        </div>

                        <div class="ld-bill-meta">
                            <span>{{ $ticket['when'] }}</span>

                            {{-- The claim link, where the desk issued one. It
                                 ties the ticket to their Discord account; the
                                 page below works either way, which is why it is
                                 offered rather than insisted on. --}}
                            @if ($ticket['claim'] !== null)
                                <a href="{{ $ticket['claim'] }}" target="_blank" rel="noopener">{{ $words['claim'] }}</a>
                            @endif

                            <button type="button"
                                    class="ld-extra-drop"
                                    wire:click="mountAction('ld_open', { ticket: {{ $ticket['id'] }} })">
                                {{ $words['read'] }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
