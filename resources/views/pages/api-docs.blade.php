{{--
    How to use the API, on the panel that has it.

    Everything here comes from Support\Api\Docs, which is also what the two
    downloads are rendered from - so the page and the file somebody takes away
    cannot disagree, and neither can be a release behind the code.

    Every key is written out in full, for the reason in tools/check-lang.js.
--}}
@php
    use LegendDevelopment\Theme\Support\Api\Docs;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'docs_base' => Theme::trans('api.docs_base'),
        'docs_endpoints' => Theme::trans('api.docs_endpoints'),
        'docs_answers' => Theme::trans('api.docs_answers'),
        'docs_calls' => Theme::trans('api.docs_calls'),
    ];
@endphp

<x-filament-panels::page>
    <div class="ld-docs">
        <section class="ld-docs__block">
            <h2 class="ld-docs__heading">{{ $words['docs_base'] }}</h2>
            <code class="ld-docs__base">{{ Docs::base() }}</code>
        </section>

        {{-- What is true of every call, before any one of them. --}}
        @foreach (Docs::notes() as $note)
            <section class="ld-docs__block">
                <h2 class="ld-docs__heading">{{ $note['title'] }}</h2>
                <p class="ld-docs__body">{!! \Illuminate\Support\Str::inlineMarkdown($note['body']) !!}</p>
            </section>
        @endforeach

        <section class="ld-docs__block">
            <h2 class="ld-docs__heading">{{ $words['docs_endpoints'] }}</h2>

            @foreach (Docs::endpoints() as $endpoint)
                <article class="ld-docs__endpoint">
                    <p class="ld-docs__route">
                        <span class="ld-docs__method">{{ $endpoint['method'] }}</span>
                        <code>{{ $endpoint['path'] }}</code>
                    </p>

                    <p class="ld-docs__summary">{{ $endpoint['summary'] }}</p>
                    <p class="ld-docs__body">{{ $endpoint['detail'] }}</p>

                    <p class="ld-docs__scope">
                        {{ $words['docs_calls'] }}: <strong>{{ Docs::scopeWords($endpoint['scope']) }}</strong>
                    </p>

                    <p class="ld-docs__label">{{ $words['docs_answers'] }}</p>
                    <pre class="ld-docs__json"><code>{{ Docs::pretty($endpoint['answers']) }}</code></pre>
                </article>
            @endforeach
        </section>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
