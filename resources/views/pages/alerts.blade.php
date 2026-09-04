{{--
    The watchdog's settings, and the three lines that matter more than they do.

    A channel that is switched on and quietly refusing every message produces a
    panel indistinguishable from one with nothing wrong. So what each channel did
    last time is drawn above the form rather than hidden behind a button: it is
    the first thing somebody should see on this page, and it is the answer to the
    only question this feature can get badly wrong.

    Every key is written out in full below rather than through a helper.
    tools/check-lang.js can only verify a literal, and a $t('off') shorthand would
    hide every key on this page from the check that exists because two of them
    once shipped broken and rendered as their own names.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'channels' => Theme::trans('alerts.channels'),
        'channels_helper' => Theme::trans('alerts.channels_helper'),
        'state_off' => Theme::trans('alerts.state_off'),
        'state_untried' => Theme::trans('alerts.state_untried'),
        'state_ok' => Theme::trans('alerts.state_ok'),
        'state_failed' => Theme::trans('alerts.state_failed'),
        'test_one' => Theme::trans('alerts.test_one'),
    ];
@endphp

<x-filament-panels::page>
    <div class="ld-alerts">
        <h2 class="ld-alerts__head">{{ $words['channels'] }}</h2>
        <p class="ld-alerts__how">{{ $words['channels_helper'] }}</p>

        @foreach ($this->outcomes() as $row)
            <div class="ld-alerts__row" data-state="{{ $row['state'] }}" wire:key="ld-alert-{{ $row['channel'] }}">
                <span class="ld-alerts__name">{{ $row['label'] }}</span>

                <span class="ld-alerts__state">
                    @switch($row['state'])
                        @case('off')      {{ $words['state_off'] }}     @break
                        @case('untried')  {{ $words['state_untried'] }} @break
                        @case('ok')       {{ $words['state_ok'] }}      @break
                        @default          {{ $words['state_failed'] }}
                    @endswitch
                </span>

                {{-- The reason, not just that there was one. "It failed" sends
                     somebody to look at their firewall; "401 Unauthorized"
                     sends them to the URL, which is where it nearly always
                     is. --}}
                @if ($row['why'] !== '')
                    <span class="ld-alerts__why">{{ $row['why'] }}</span>
                @endif

                {{-- What to do about it, on its own line under the row.

                     A provider's reason is exactly true and tells nobody what
                     to do next: "553 5.7.1" is a sentence about an SMTP
                     server's opinion of the From address, and there is no way
                     to work that out from the number. --}}
                @if ($row['hint'] !== '')
                    <p class="ld-alerts__hint">{{ $row['hint'] }}</p>
                @endif

                @if ($row['when'] !== '')
                    <span class="ld-alerts__when">{{ $row['when'] }}</span>
                @endif

                {{-- Plain markup rather than a Filament action, deliberately.
                     Pelican turns every action into an icon-only button for
                     anybody who chose that style, and this is the one button on
                     the page that has to be findable by somebody who has just
                     read the word "Refused" next to it. --}}
                <button type="button" class="ld-alerts__test"
                        wire:click="testOne('{{ $row['channel'] }}')"
                        wire:loading.attr="disabled"
                >{{ $words['test_one'] }}</button>
            </div>
        @endforeach
    </div>

    {{ $this->form }}

    {{-- Without this the header actions open nothing: an action rendered on a
         page has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
