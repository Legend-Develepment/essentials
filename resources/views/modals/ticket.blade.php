{{--
    One conversation, in a window.

    A window rather than a section under a list: a conversation that opened
    below one left somebody scrolling past twenty rows to find what they had
    just clicked on, and the list moved under them whenever a reply changed a
    ticket's place in it.

    The same file on both sides. A customer reading their ticket and staff
    reading it are looking at the same conversation, and two templates for that
    is two places for it to drift. The one real difference is what staff may
    change from in here, which arrives as $controls and is null for a customer.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'reply' => Theme::trans($answering ? 'tickets.answer_hint' : 'tickets.reply_hint'),
        'hint' => Theme::trans('tickets.markdown_hint'),
        'send' => Theme::trans('tickets.send'),
        'add' => Theme::trans('tickets.file_add'),
        'busy' => Theme::trans('tickets.picture_busy'),
        'priority' => Theme::trans('tickets.priority'),
        'group' => Theme::trans('tickets.column_group'),
        'no_group' => Theme::trans('tickets.group_none'),
        'closed_note' => Theme::trans('tickets.closed_note'),
        'empty' => Theme::trans('tickets.nothing_said'),
    ];
@endphp

<div class="ld-talk">
    {{-- Scrolls on its own so the box to type in stays where it is. A
         conversation that pushed the reply box off the bottom would make
         answering a long ticket an exercise in scrolling.

         Opened at the newest message, because a transcript that opens at the
         oldest one reads as a log however good the bubbles are. And again after
         sending, on the event the page fires: Livewire keeps this element
         across a re-render, so what was just said would otherwise arrive below
         the fold of a box nobody scrolled. --}}
    <div class="ld-talk-said"
         x-data="{ newest() { this.$el.scrollTop = this.$el.scrollHeight } }"
         x-init="$nextTick(() => newest())"
         x-on:ld-said.window="$nextTick(() => newest())">
        @forelse ($said as $one)
            @include(Theme::id() . '::partials.said', ['said' => $one])
        @empty
            <p class="ld-person-none">{{ $words['empty'] }}</p>
        @endforelse
    </div>

    @if ($answerable)
        {{-- One box, and it stays put.

             Sticky rather than simply last: the window scrolls as a whole, so a
             composer at the end of a long conversation was somewhere you had to
             go and find. Everything that can be done to a ticket while writing
             about it sits on the one row under the text - attach, how urgent,
             which group, send - which is also why it is a row and not a form:
             each control acts the moment it is used. --}}
        <div class="ld-say">
            <label class="ld-say-hidden" for="ld-say-{{ $ticket->id }}">{{ $words['reply'] }}</label>

            {{-- Enter sends, shift and enter makes a line. The pair has to be
                 done together: enter alone that sends is only usable if there
                 is still a way to write a second paragraph. --}}
            <textarea id="ld-say-{{ $ticket->id }}"
                      class="ld-say-text"
                      rows="2"
                      placeholder="{{ $words['reply'] }}"
                      title="{{ $words['hint'] }}"
                      wire:model="reply"
                      x-on:keydown.enter="if (! $event.shiftKey) { $event.preventDefault(); $wire.{{ $method }}({{ $ticket->id }}) }"></textarea>

            {{-- What the browser is holding, before it is sent. --}}
            <div wire:loading wire:target="upload" class="ld-say-busy">{{ $words['busy'] }}</div>

            <div class="ld-say-tools">
                <label class="ld-say-add" title="{{ $words['add'] }}">
                    <x-filament::icon icon="tabler-plus" />
                    <span class="ld-say-hidden">{{ $words['add'] }}</span>

                    <input type="file" wire:model="upload">
                </label>

                @if ($controls !== null)
                    <label class="ld-say-hidden" for="ld-rank-{{ $ticket->id }}">{{ $words['priority'] }}</label>

                    <select id="ld-rank-{{ $ticket->id }}"
                            class="ld-say-pill"
                            title="{{ $words['priority'] }}"
                            wire:change="rank({{ $ticket->id }}, $event.target.value)">
                        @foreach ($controls['levels'] as $value => $label)
                            <option value="{{ $value }}" @selected($value === $controls['level'])>{{ $label }}</option>
                        @endforeach
                    </select>

                    <label class="ld-say-hidden" for="ld-team-{{ $ticket->id }}">{{ $words['group'] }}</label>

                    <select id="ld-team-{{ $ticket->id }}"
                            class="ld-say-pill"
                            title="{{ $words['group'] }}"
                            wire:change="team({{ $ticket->id }}, $event.target.value)">
                        <option value="">{{ $words['no_group'] }}</option>

                        @foreach ($controls['groups'] as $value => $label)
                            <option value="{{ $value }}" @selected((int) $value === (int) $controls['group'])>{{ $label }}</option>
                        @endforeach
                    </select>
                @else
                    {{-- A customer does not route their own ticket, but they do
                         get to see how urgent it is being treated as. --}}
                    <span class="ld-say-pill ld-say-pill--flat">
                        {{ Theme::trans('tickets.priority_' . $ticket->priority) }}
                    </span>
                @endif

                <button type="button"
                        class="ld-say-go"
                        title="{{ $words['send'] }}"
                        wire:click="{{ $method }}({{ $ticket->id }})">
                    <x-filament::icon icon="tabler-arrow-up" />
                    <span class="ld-say-hidden">{{ $words['send'] }}</span>
                </button>
            </div>
        </div>
    @else
        <p class="ld-person-none">{{ $words['closed_note'] }}</p>
    @endif
</div>
