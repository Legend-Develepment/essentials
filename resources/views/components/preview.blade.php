{{--
    A panel that is not the panel.

    Every class in here is one Pelican's own pages use - fi-section, fi-btn,
    fi-input-wrp, role="progressbar" - so what paints this box is the stylesheet
    that paints the panel, with the tokens fed from the form instead of from
    .env.

    The `.ld-preview__*` rules are the box's own frame - where it sits, how the
    label reads, how the three meter rows line up - and that is all they are
    allowed to be. Not one of them may restate a colour, a corner or a shadow the
    theme already decides, because a preview carrying its own version of an
    effect is a second place the theme can be wrong, and one that disagrees with
    the panel is worse than no preview at all.

    What it shows is what these settings actually reach: a card takes the surface,
    the corner rounding, the glass and the glow; a button takes the accent; the
    meter takes the accent and the thresholds. Layout, the server list and the
    terminal are not here, because those emit rules against Filament's classes
    rather than tokens and do not follow a box.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;
@endphp

<div
    class="ld-preview {{ $dark ? 'ld-preview--dark' : '' }}"
    aria-hidden="true"
    data-ld-preview
>
    {{-- The tokens for this box only. Written here rather than in the page's
         stylesheet because they change with the form, and a <style> beside the
         thing it styles is replaced with it when Livewire swaps the block. --}}
    <style>{!! $css !!}</style>

    <p class="ld-preview__label">{{ Theme::trans('settings.preview.label') }}</p>

    <section class="fi-section fi-section-has-header">
        <header class="fi-section-header">
            <div class="fi-section-header-text-ctn">
                <h2 class="fi-section-header-heading">{{ Theme::trans('settings.preview.card') }}</h2>
                <p class="fi-section-header-description">{{ Theme::trans('settings.preview.card_helper') }}</p>
            </div>
        </header>

        <div class="fi-section-content-ctn">
            <div class="fi-section-content">
                <div class="ld-preview__row">
                    <button type="button" class="fi-btn fi-color fi-color-primary fi-size-md" tabindex="-1">
                        {{ Theme::trans('settings.preview.button') }}
                    </button>

                    <span class="fi-input-wrp">
                        <span class="fi-input">{{ Theme::trans('settings.preview.field') }}</span>
                    </span>
                </div>

                {{-- The three levels at once, so the meter thresholds can be set
                     by eye rather than by imagining them. --}}
                @foreach ([['ok', 24], ['warning', 68], ['danger', 92]] as [$level, $percent])
                    <div class="ld-preview__meter">
                        <span class="ld-preview__meter-name">{{ Theme::trans('settings.preview.meter_' . $level) }}</span>
                        <div role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                            <div style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="ld-preview__meter-value">{{ $percent }}%</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
