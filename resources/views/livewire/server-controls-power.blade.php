{{--
    The power buttons. Included twice - once in the bar, once in the pop-out's
    header - so the two can never drift apart.
--}}
<div class="ld-controls__power">
    @foreach ($buttons as $button)
        <button
            type="button"
            class="ld-controls__button ld-controls__button--{{ $button['action'] }}"
            wire:click="power('{{ $button['action'] }}')"
            wire:loading.attr="disabled"
            @if ($button['confirm']) wire:confirm="{{ $button['confirm'] }}" @endif
            title="{{ $button['label'] }}"
        >
            @if ($button['icon'])
                {!! $button['icon'] !!}
            @endif
            <span class="ld-controls__label">{{ $button['label'] }}</span>
        </button>
    @endforeach
</div>
