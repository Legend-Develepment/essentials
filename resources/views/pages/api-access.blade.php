{{--
    Somebody's own keys.

    Drawn by hand rather than as a table, because a person has one or two of
    these and a table of two rows with a pagination bar under it is furniture
    around nothing. What each row has to say is different per state as well: a
    refusal carries the answer it was given, a pending one carries nothing but
    the wait.

    Every key is written out in full, for the reason in tools/check-lang.js.
--}}
@php
    use LegendDevelopment\Theme\Models\Key;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'once' => Theme::trans('api.once'),
        'once_body' => Theme::trans('api.once_body'),
        'address' => Theme::trans('api.address'),
        'empty' => Theme::trans('api.my_empty'),
        'empty_body' => Theme::trans('api.my_empty_body'),
        'scope' => Theme::trans('api.scope'),
        'column_prefix' => Theme::trans('api.column_prefix'),
        'column_used' => Theme::trans('api.column_used'),
        'never_used' => Theme::trans('api.never_used'),
        'cancel' => Theme::trans('api.cancel'),
        'revoke' => Theme::trans('api.revoke'),
        'forget' => Theme::trans('api.forget'),
        'collect' => Theme::trans('api.collect'),
        'replace' => Theme::trans('api.replace'),
        'waiting_body' => Theme::trans('api.state_ready_body'),
        'discord' => Theme::trans('api.discord'),
        'discord_body' => Theme::trans('api.discord_body'),
        'discord_connect' => Theme::trans('api.discord_connect'),
        'discord_code' => Theme::trans('api.discord_code'),
        'discord_off' => Theme::trans('api.discord_off'),
        'discord_cut' => Theme::trans('api.discord_cut'),
        'discord_key_note' => Theme::trans('api.discord_key_note'),
        'pending_body' => Theme::trans('api.state_pending_body'),
        'refused_body' => Theme::trans('api.state_refused_body'),
        'revoked_body' => Theme::trans('api.state_revoked_body'),
    ];

    $endpoint = url('/api/essentials/v1/health');
    $keys = $this->keys();
    $joined = $this->connection();
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

    @if ($keys->isEmpty())
        <div class="ld-key__none">
            <p class="ld-key__title">{{ $words['empty'] }}</p>
            <p class="ld-key__body">{{ $words['empty_body'] }}</p>
        </div>
    @else
        <ul class="ld-keys">
            @foreach ($keys as $key)
                <li class="ld-keys__row">
                    <div class="ld-keys__text">
                        <p class="ld-keys__name">
                            {{ $key->name }}
                            <span class="ld-keys__state ld-keys__state--{{ $key->state }}">
                                {{ Theme::trans('api.state_' . $key->state) }}
                            </span>
                        </p>

                        {{--
                            One line per state, saying the thing that state
                            means. A row that reads the same whatever happened
                            to it is a row somebody has to decode.
                        --}}
                        @if ($key->state === Key::PENDING)
                            <p class="ld-keys__note">{{ $words['pending_body'] }}</p>
                        @elseif ($key->state === Key::REFUSED)
                            <p class="ld-keys__note">{{ $key->answer ?: $words['refused_body'] }}</p>
                        @elseif ($key->state === Key::ACTIVE && $key->token === null)
                            <p class="ld-keys__note">{{ $words['waiting_body'] }}</p>
                        @elseif ($key->state === Key::REVOKED)
                            <p class="ld-keys__note">{{ $words['revoked_body'] }}</p>
                        @else
                            <p class="ld-keys__note">
                                {{ $words['column_prefix'] }} <code>{{ $key->prefix }}</code>
                                &middot; {{ $words['scope'] }}: {{ Theme::trans('api.scope_' . $key->scope) }}
                                &middot; {{ $words['column_used'] }}:
                                {{ $key->last_used_at?->diffForHumans() ?? $words['never_used'] }}
                            </p>
                        @endif
                    </div>

                    @if ($key->state === Key::ACTIVE && $key->token === null)
                        {{-- Granted and not picked up. The secret is made at
                             the moment its owner asks for it, which is the only
                             moment it is ever readable. --}}
                        <x-filament::button
                            size="sm"
                            icon="tabler-download"
                            wire:click="collect({{ $key->id }})"
                        >
                            {{ $words['collect'] }}
                        </x-filament::button>
                    @elseif ($key->state === Key::ACTIVE)
                        {{-- There is nothing to look up: the key was never
                             stored. So the answer to losing one is a new one,
                             and the old one ending is what keeps that safe. --}}
                        <x-filament::button
                            color="gray"
                            size="sm"
                            icon="tabler-refresh"
                            wire:click="replace({{ $key->id }})"
                            wire:confirm="{{ Theme::trans('api.replace_confirm') }}"
                        >
                            {{ $words['replace'] }}
                        </x-filament::button>
                    @endif

                    @if ($key->state === Key::PENDING || $key->state === Key::ACTIVE)
                        <x-filament::button
                            color="danger"
                            size="sm"
                            icon="tabler-plug-connected-x"
                            wire:click="drop({{ $key->id }})"
                            wire:confirm="{{ Theme::trans('api.revoke_confirm') }}"
                        >
                            {{ $key->state === Key::PENDING ? $words['cancel'] : $words['revoke'] }}
                        </x-filament::button>
                    @else
                        {{--
                            It has already stopped answering, so this takes the
                            row away and nothing else. Revoking is the act that
                            stops something working; this is only tidying up
                            after it.
                        --}}
                        <x-filament::button
                            color="gray"
                            size="sm"
                            icon="tabler-trash"
                            wire:click="forget({{ $key->id }})"
                            wire:confirm="{{ Theme::trans('api.forget_confirm') }}"
                        >
                            {{ $words['forget'] }}
                        </x-filament::button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    {{--
        Discord.

        Its own block above the documentation, because it is the thing most
        people came here for - a key of your own is what a script needs, and
        this is what a bot needs.
    --}}
    <section class="ld-key__none">
        <p class="ld-key__title">{{ $words['discord'] }}</p>
        <p class="ld-key__body">{{ $words['discord_body'] }}</p>

        @if ($joined !== null)
            <p class="ld-keys__note">
                {{ Theme::trans('api.discord_on', ['name' => $joined->discord_name ?: $joined->discord_id]) }}
                &middot;
                {{ Theme::trans('api.discord_since', ['when' => $joined->created_at?->diffForHumans() ?? '-']) }}
            </p>

            <div class="ld-key__act">
                <x-filament::button
                    color="danger"
                    size="sm"
                    icon="tabler-plug-connected-x"
                    wire:click="disconnect"
                    wire:confirm="{{ Theme::trans('api.discord_cut_confirm') }}"
                >
                    {{ $words['discord_cut'] }}
                </x-filament::button>
            </div>
        @elseif ($code !== null)
            {{-- Ten minutes and one use. Shown plainly: it can only ever bind
                 a Discord account to this one, and only while the person it
                 was made for is looking at it. --}}
            <p class="ld-key__title">{{ $words['discord_code'] }}</p>
            <code class="ld-key__value">{{ $code }}</code>
            <p class="ld-key__where">
                {{ Theme::trans('api.discord_code_body', ['command' => '/connect ' . $code]) }}
            </p>
        @else
            <p class="ld-keys__note">{{ $words['discord_off'] }}</p>

            <div class="ld-key__act">
                <x-filament::button size="sm" icon="tabler-brand-discord" wire:click="connect">
                    {{ $words['discord_connect'] }}
                </x-filament::button>
            </div>
        @endif

        <p class="ld-key__where">{{ $words['discord_key_note'] }}</p>
    </section>

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

    <x-filament-actions::modals />
</x-filament-panels::page>
