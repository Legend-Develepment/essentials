{{--
    The plugin keys this person already has, on Pelican's own profile page.

    Read only. Everything that acts on a key - revoking, cancelling, the
    Discord connection, the reason a request was refused - stays on the
    plugin's own API access page, because a second set of actions here would be
    a second set to keep in step.

    Every key is written out in full, for the reason in tools/check-lang.js.
--}}
@php
    use LegendDevelopment\Theme\Models\Key;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'empty' => Theme::trans('api.my_empty'),
        'manage' => Theme::trans('api.profile_manage'),
        'scope' => Theme::trans('api.scope_person'),
        'ready' => Theme::trans('api.state_ready_body'),
    ];

    $mine = collect();

    try {
        $mine = Key::query()
            ->where('user_id', user()?->id)
            ->orderByDesc('created_at')
            ->get();
    } catch (\Throwable) {
        // A list that cannot be read is an empty one, on somebody's account
        // page. It may not take the page with it.
    }
@endphp

@if ($mine->isEmpty())
    <p class="ld-docs__body">{{ $words['empty'] }}</p>
@else
    <ul class="ld-keys ld-keys--tight">
        @foreach ($mine as $key)
            <li class="ld-keys__row">
                <div class="ld-keys__text">
                    <p class="ld-keys__name">
                        {{ $key->name }}
                        <span class="ld-keys__state ld-keys__state--{{ $key->state }}">
                            {{ Theme::trans('api.state_' . $key->state) }}
                        </span>
                    </p>

                    @if ($key->state === Key::ACTIVE && $key->token === null)
                        {{-- Granted and not picked up. Worth saying here, on
                             the page somebody is already looking at, rather
                             than leaving a key that looks active and does
                             nothing. --}}
                        <p class="ld-keys__note">{{ $words['ready'] }}</p>
                    @else
                        <p class="ld-keys__note">
                            <code>{{ $key->prefix }}</code>
                            &middot; {{ $words['scope'] }}
                        </p>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
@endif

<p class="ld-docs__body">{{ $words['manage'] }}</p>
