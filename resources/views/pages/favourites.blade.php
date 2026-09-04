{{--
    Everything one person has starred, in two lists.

    Rows are plain markup rather than a table builder, for the reason the
    players page gives at more length: there is no Eloquent model behind either
    list - one is a file of short ids, the other a file of paths - and a table
    handed an array collection buys sorting and filtering nobody asked for while
    pretending these are records.

    Every key is written out in full below rather than through a helper.
    tools/check-lang.js can only verify a literal, and a $t('empty') shorthand
    would hide every key on this page from the check that exists because two of
    them once shipped broken and rendered as their own names.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'servers' => Theme::trans('quick.servers'),
        'pages' => Theme::trans('quick.pages'),
        'empty' => Theme::trans('quick.page_empty'),
        'remove' => Theme::trans('quick.remove'),
        'how' => Theme::trans('quick.how'),
    ];
@endphp

<x-filament-panels::page>
    <p class="ld-favs__how">{{ $words['how'] }}</p>

    @if (count($servers) === 0 && count($pages) === 0)
        <p class="ld-favs__empty">{{ $words['empty'] }}</p>
    @endif

    @if (count($servers) > 0)
        <div class="ld-favs">
            <h2 class="ld-favs__head">{{ $words['servers'] }}</h2>

            @foreach ($servers as $server)
                <div class="ld-favs__row" wire:key="ld-fav-server-{{ $server['id'] }}">
                    <a class="ld-favs__link" href="{{ $this->serverUrl($server['id']) }}">
                        {{ $server['name'] }}
                    </a>

                    {{-- The id as well as the name, because two servers may
                         share a name and the address is the only thing that
                         tells them apart. --}}
                    <span class="ld-favs__note">{{ $server['id'] }}</span>

                    <button
                        type="button"
                        class="ld-favs__remove"
                        title="{{ $words['remove'] }}"
                        aria-label="{{ $words['remove'] }}"
                        wire:click="forgetServer('{{ $server['id'] }}')"
                    >&times;</button>
                </div>
            @endforeach
        </div>
    @endif

    @if (count($pages) > 0)
        <div class="ld-favs">
            <h2 class="ld-favs__head">{{ $words['pages'] }}</h2>

            @foreach ($pages as $page)
                <div class="ld-favs__row" wire:key="ld-fav-page-{{ md5($page['path']) }}">
                    {{-- The stored path, joined to this host. It was checked on
                         the way in - one leading slash, no scheme, no host, no
                         traversal - so it can only ever point back into this
                         panel. --}}
                    <a class="ld-favs__link" href="{{ url($page['path']) }}">
                        {{ $page['label'] }}
                    </a>

                    <span class="ld-favs__note">{{ $page['path'] }}</span>

                    <button
                        type="button"
                        class="ld-favs__remove"
                        title="{{ $words['remove'] }}"
                        aria-label="{{ $words['remove'] }}"
                        wire:click="forgetPage(@js($page['path']))"
                    >&times;</button>
                </div>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>
