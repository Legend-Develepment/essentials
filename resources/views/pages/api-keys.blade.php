{{--
    Every key the panel has issued, and everybody waiting for one.

    The box at the top is the only place a key is ever readable, and it is
    readable exactly once - the table below holds a hash, which cannot produce
    it. So the box says what to do rather than warning in general: paste it
    where the bot reads it, now.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a shorthand would hide these from the check that exists because
    two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'once' => Theme::trans('api.once'),
        'once_body' => Theme::trans('api.once_body'),
        'address' => Theme::trans('api.address'),
    ];

    $endpoint = url('/api/essentials/v1/health');
@endphp

<x-filament-panels::page>
    @if ($fresh !== null)
        <div class="ld-key">
            <p class="ld-key__title">{{ $words['once'] }}</p>
            <p class="ld-key__body">{{ $words['once_body'] }}</p>

            <code class="ld-key__value">{{ $fresh }}</code>

            <p class="ld-key__where">
                {{ $words['address'] }}: <code>{{ $endpoint }}</code>
            </p>
        </div>
    @endif

    {{ $this->form }}

    {{--
        The documentation, folded away. It is a page-worth of prose that
        somebody reads once and then comes back to for one line, so it opens
        closed rather than pushing the keys below the fold on every visit.
    --}}
    <details class="ld-config__more">
        <summary>{{ Theme::trans('api.docs_title') }}</summary>

        <p class="ld-config__note">{{ Theme::trans('api.docs_subheading') }}</p>

        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::components.api-docs')
    </details>

    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
