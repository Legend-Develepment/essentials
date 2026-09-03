{{--
    The finder above, what is already installed below.

    Both folders are always drawn rather than only the one matching the picker:
    which of the two a server actually uses is part of what somebody comes here
    to find out, and an empty plugins list on a Forge server is an answer.

    Keys are written out in full. tools/check-lang.js can only verify a literal,
    and a short helper would hide every key on this page from it.
--}}
@php
    use LegendDevelopment\Theme\Support\Minecraft\Resources as Store;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'installed_title' => Theme::trans('resources.installed_title'),
        'installed_mods' => Theme::trans('resources.installed_mods'),
        'installed_plugins' => Theme::trans('resources.installed_plugins'),
        'installed_empty' => Theme::trans('resources.installed_empty'),
        'installed_note' => Theme::trans('resources.installed_note'),
        'running' => Theme::trans('resources.running'),
        'running_helper' => Theme::trans('resources.running_helper'),
        'unknown' => Theme::trans('resources.unknown'),
        'check_note' => Theme::trans('resources.check_note'),
    ];

    $folders = [
        'mod' => $words['installed_mods'],
        'plugin' => $words['installed_plugins'],
    ];
@endphp

<x-filament-panels::page>
    {{ $this->form }}

    <div class="ld-resources">
        @if ($running)
            {{-- Said here as well as in the notification: somebody looking at a
                 button deserves to know it will refuse before they press it. --}}
            <p class="ld-resources__warn">
                <strong>{{ $words['running'] }}</strong> {{ $words['running_helper'] }}
            </p>
        @endif

        <div class="ld-players__head">
            <h3>{{ $words['installed_title'] }}</h3>
            <span class="ld-players__note">{{ $words['installed_note'] }}</span>
        </div>

        @if ($checked)
            {{-- Only after a check, because until then the badges it explains
                 are not on the page and this would be a warning about nothing. --}}
            <p class="ld-players__note">{{ $words['check_note'] }}</p>
        @endif

        @foreach ($folders as $kind => $heading)
            <div class="ld-resources__group">
                <h4 class="ld-resources__folder">{{ $heading }}</h4>

                @if (($installed[$kind] ?? []) === [])
                    <p class="ld-players__empty">{{ $words['installed_empty'] }}</p>
                @else
                    <div class="ld-players__table">
                        @foreach ($installed[$kind] as $file)
                            @php
                                $key = Store::folder($kind) . '/' . $file['name'];
                                $newer = $updates[$key] ?? null;
                            @endphp

                            <div class="ld-players__row">
                                <span class="ld-players__name">{{ $file['name'] }}</span>

                                <span class="ld-players__flags">
                                    @if ($file['number'])
                                        <span class="ld-players__flag">v{{ $file['number'] }}</span>
                                    @endif

                                    @if ($newer)
                                        <span class="ld-players__flag ld-players__flag--op">
                                            {{ Theme::trans('resources.update_ready', ['number' => $newer['number']]) }}
                                        </span>
                                    @endif

                                    @if (!$file['project'])
                                        {{-- Not a fault, and worth saying rather
                                             than leaving as a row that quietly
                                             has fewer options than its neighbours. --}}
                                        <span class="ld-players__flag">{{ $words['unknown'] }}</span>
                                    @endif
                                </span>

                                <span class="ld-resources__size">{{ Store::size($file['size']) }}</span>

                                <span class="ld-players__actions">
                                    {{ ($this->changeAction)([
                                        'kind' => $kind,
                                        'name' => $file['name'],
                                        'project' => $file['project'],
                                    ]) }}
                                    {{ ($this->removeAction)(['kind' => $kind, 'name' => $file['name']]) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Without this the row buttons open nothing: an action rendered in a page
         body has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
