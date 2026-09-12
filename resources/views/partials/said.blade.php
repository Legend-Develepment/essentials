{{--
    One thing somebody said.

    Laid out the way a chat is read rather than as a list of rows: whoever is
    looking at the page on the right, the other party on the left, and anything
    written in Discord down the middle. That third lane is the point of it - a
    conversation with two ends and a channel in it has three voices, and two
    sides cannot show three.

    "Mine" is decided by the page rather than by the message, because the same
    message is somebody else's on the other screen.

    Three facts on every one and none of them left to a colour: who, in what
    role, and where it was typed. A colour alone is a label nobody can read out
    loud. The name sits above the first of a run and the rest below it, which is
    where a chat puts them - six replies in a row are one name and six bubbles,
    not six headers.

    A notice - somebody claiming it, moving it, changing how urgent it is - is
    not a bubble at all. It belongs to neither end of the conversation, so it is
    a line down the middle, which is the shape every chat uses for the same
    thing.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $notice = (bool) ($said['notice'] ?? false);
    $lane = $notice
        ? 'notice'
        : ($said['from'] === 'discord' ? 'middle' : ($said['mine'] ? 'mine' : 'theirs'));

    // The first of a run carries the name; the rest sit under it. Missing means
    // yes, so a caller that knows nothing about runs still gets a header.
    $run = (bool) ($said['run'] ?? true);
@endphp

{{-- Which day this is, on its own line between two of them. Part of the
     transcript rather than of the message, so it is drawn beside the bubble and
     never inside one. --}}
@if (($said['starts_day'] ?? false) && ($said['day_label'] ?? '') !== '')
    <div class="ld-talk-day">{{ $said['day_label'] }}</div>
@endif

<article @class([
    'ld-said',
    'ld-said--mine' => $lane === 'mine',
    'ld-said--theirs' => $lane === 'theirs',
    'ld-said--middle' => $lane === 'middle',
    'ld-said--notice' => $lane === 'notice',
    'ld-said--staff' => $said['staff'] && !$notice,
    'ld-said--run' => $run,
])>
    @if ($run && !$notice)
        <header>
            <span @class(['ld-tag', 'ld-tag--staff' => $said['staff'], 'ld-tag--user' => !$said['staff']])>
                {{ Theme::trans($said['staff'] ? 'tickets.tag_staff' : 'tickets.tag_user') }}
            </span>

            <strong>{{ $said['author'] }}</strong>
        </header>
    @endif

    {{-- Already escaped and formatted by Markdown::render(), which is the only
         thing allowed to put a tag in here. --}}
    @if (trim(strip_tags($said['body'])) !== '')
        <div class="ld-said-body">{!! $said['body'] !!}</div>
    @endif

    {{-- And the file, where there is one.

         A picture is shown, boxed, and opens full size in its own tab: a
         screenshot of a console is taller than the window it would be read in.
         Anything else is a row that says what it is and how big, because a
         crash log drawn as a picture is a picture of nothing. --}}
    @if (($said['file'] ?? null) !== null)
        @if ($said['file_shown'] ?? true)
            <a class="ld-said-picture" href="{{ $said['file'] }}" target="_blank" rel="noopener">
                <img src="{{ $said['file'] }}"
                     alt="{{ ($said['file_name'] ?? '') ?: Theme::trans('tickets.picture') }}"
                     loading="lazy">
            </a>
        @else
            <a class="ld-said-file" href="{{ $said['file'] }}" target="_blank" rel="noopener">
                <x-filament::icon icon="tabler-paperclip" class="ld-said-file-icon" />

                <span class="ld-said-file-name">
                    {{ ($said['file_name'] ?? '') ?: Theme::trans('tickets.file') }}
                </span>

                <span class="ld-said-file-size">{{ $said['file_size'] ?? '' }}</span>
            </a>
        @endif
    @endif

    {{-- Where it was typed and when, tucked under the words the way a chat does
         it. Small, muted, and still words: a message written in Discord looks
         exactly like one written here unless something says so. --}}
    @if (!$notice)
        <footer class="ld-said-meta">
            <span class="ld-said-where">
                {{ Theme::trans($said['from'] === 'panel' ? 'tickets.from_panel' : 'tickets.from_discord') }}
            </span>

            <span class="ld-said-when" title="{{ $said['when'] }}">{{ ($said['clock'] ?? '') ?: $said['when'] }}</span>

            {{-- Said here and not passed on yet. Worth a word: it is the
                 difference between "nobody has answered" and "nobody has seen
                 it". --}}
            @if (array_key_exists('pushed', $said) && !$said['pushed'])
                <span class="ld-tag ld-tag--waiting">{{ Theme::trans('tickets.pushed_no') }}</span>
            @endif
        </footer>
    @endif
</article>
