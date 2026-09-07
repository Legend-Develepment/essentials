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
        'pending_body' => Theme::trans('api.state_pending_body'),
        'refused_body' => Theme::trans('api.state_refused_body'),
        'revoked_body' => Theme::trans('api.state_revoked_body'),
    ];

    $endpoint = url('/api/essentials/v1/health');
    $keys = $this->keys();
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
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
