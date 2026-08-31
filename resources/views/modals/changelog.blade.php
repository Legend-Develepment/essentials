{{--
    What has changed, from the releases on this panel's channel.

    The notes are Markdown from a remote address and have already been rendered
    and stripped in Support\Changelog - which is why this is the one place in
    the plugin that prints unescaped HTML, and why the stripping happens there
    rather than here.
--}}
<div class="ld-log">
    @forelse ($entries as $entry)
        <article class="ld-log__entry">
            <header class="ld-log__head">
                <span class="ld-log__version">v{{ $entry['version'] }}</span>

                @if ($entry['date'] !== '')
                    <span class="ld-log__date">{{ $entry['date'] }}</span>
                @endif

                @if ($entry['installed'])
                    {{-- Which one you are on, so the list reads as "these are
                         above your line" rather than as an undated pile. --}}
                    <span class="ld-log__here">{{ $installedLabel }}</span>
                @endif
            </header>

            <div class="ld-log__body">{!! $entry['html'] !!}</div>
        </article>
    @empty
        <p class="ld-log__empty">{{ $empty }}</p>
    @endforelse
</div>
