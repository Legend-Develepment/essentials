{{--
    What Modora actually posted.

    A setting-up tool first and a diagnosis tool afterwards. The body is shown
    exactly as it arrived, escaped, because the whole point is to read the shape
    rather than a tidied version of it - and because it is a stranger's input,
    which is never drawn as anything but text.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'none' => Theme::trans('tickets.hook_seen_none'),
        'none_body' => Theme::trans('tickets.hook_seen_none_body'),
        'headers' => Theme::trans('tickets.hook_headers'),
        'body' => Theme::trans('tickets.hook_body'),
        'address' => Theme::trans('tickets.hook'),
    ];
@endphp

<div class="ld-hook">
    @if ($address !== null)
        <p class="ld-hook-address"><strong>{{ $words['address'] }}</strong> <code>{{ $address }}</code></p>
    @endif

    @if (count($deliveries) === 0)
        <div class="ld-shop-empty">
            <strong>{{ $words['none'] }}</strong>
            <span>{{ $words['none_body'] }}</span>
        </div>
    @else
        @foreach ($deliveries as $delivery)
            <article class="ld-hook-one">
                <header>
                    <strong>{{ $delivery['event'] !== '' ? $delivery['event'] : '?' }}</strong>
                    <span class="ld-said-when">{{ $delivery['at'] ?? '' }}</span>
                </header>

                @if (count($delivery['headers'] ?? []) > 0)
                    <p class="ld-hook-label">{{ $words['headers'] }}</p>

                    <dl class="ld-hook-headers">
                        @foreach ($delivery['headers'] as $name => $value)
                            <div>
                                <dt>{{ $name }}</dt>
                                <dd>{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif

                <p class="ld-hook-label">{{ $words['body'] }}</p>

                <pre class="ld-hook-body">{{ $delivery['body'] ?? '' }}</pre>
            </article>
        @endforeach
    @endif
</div>
