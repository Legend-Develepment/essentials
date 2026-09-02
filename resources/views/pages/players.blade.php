{{--
    The four lists Minecraft keeps, as one table.

    Rows come from the page as plain arrays rather than from a table builder:
    there is no Eloquent model behind any of this, only JSON read off the
    daemon, and a table builder handed an array collection buys sorting nobody
    asked for at the cost of pretending these are records.

    Every key is written out in full in the block below rather than through a
    short helper. tools/check-lang.js can only verify a literal, and a `$t('how')`
    helper - which is what this had first - hides every key on the page from the
    check that exists because two of them shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'how' => Theme::trans('players.how'),
        'empty' => Theme::trans('players.empty'),
        'players' => Theme::trans('players.players'),
        'not_live' => Theme::trans('players.not_live'),
        'ips' => Theme::trans('players.ips'),
        'ips_empty' => Theme::trans('players.ips_empty'),
        'flag_banned' => Theme::trans('players.flag_banned'),
        'flag_op' => Theme::trans('players.flag_op'),
        'flag_whitelisted' => Theme::trans('players.flag_whitelisted'),
        'flag_seen' => Theme::trans('players.flag_seen'),
        'online' => Theme::trans('players.online'),
        'online_none' => Theme::trans('players.online_none'),
    ];
@endphp

<x-filament-panels::page>
    <div class="ld-players">
        <p class="ld-players__how">{{ $words['how'] }}</p>

        {{--
            Who is connected, asked of the game itself.

            Only here when the setting is on, the port answered, and the server
            is up. Those three are not told apart on screen on purpose: from
            here they are one fact - nobody could be asked - and three variants
            of "no answer" would be three things to read and nothing to do about
            any of them. The setting's own help text says what to expect.
        --}}
        @if ($live !== null)
            <div class="ld-players__live">
                <div class="ld-players__head">
                    <h3>{{ $words['online'] }}</h3>
                    <span class="ld-players__count">
                        {{ Theme::trans('players.online_count', ['online' => $live['online'], 'max' => $live['max']]) }}
                    </span>
                    @if ($live['version'])
                        <span class="ld-players__note">{{ $live['version'] }}</span>
                    @endif
                </div>

                @if ($live['names'] === [])
                    <p class="ld-players__empty">{{ $words['online_none'] }}</p>
                @else
                    <div class="ld-players__table">
                        @foreach ($live['names'] as $who)
                            <div class="ld-players__row ld-players__row--live">
                                <span class="ld-players__name">{{ $who }}</span>

                                {{-- Every name here came off the network and
                                     through the same validator the commands
                                     use, so it is safe to hand to them. --}}
                                <span class="ld-players__actions">
                                    {{ ($this->kickAction)(['name' => $who]) }}
                                    {{ ($this->banAction)(['name' => $who]) }}
                                    {{ ($this->opAction)(['name' => $who]) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        @if ($rows === [])
            <p class="ld-players__empty">{{ $words['empty'] }}</p>
        @else
            <div class="ld-players__head">
                <h3>{{ $words['players'] }}</h3>
                <span class="ld-players__note">{{ $words['not_live'] }}</span>
            </div>

            <div class="ld-players__table">
                @foreach ($rows as $row)
                    <div class="ld-players__row">
                        <span class="ld-players__name">{{ $row['name'] }}</span>

                        <span class="ld-players__flags">
                            @if ($row['banned'])
                                <span class="ld-players__flag ld-players__flag--banned">{{ $words['flag_banned'] }}</span>
                            @endif

                            @if ($row['op'])
                                <span class="ld-players__flag ld-players__flag--op">
                                    {{ $words['flag_op'] }}@if ($row['level'] !== null) · {{ Theme::trans('players.level', ['level' => $row['level']]) }}@endif
                                </span>
                            @endif

                            @if ($row['whitelisted'])
                                <span class="ld-players__flag ld-players__flag--white">{{ $words['flag_whitelisted'] }}</span>
                            @endif

                            @if ($row['seen'] && !$row['banned'] && !$row['op'] && !$row['whitelisted'])
                                <span class="ld-players__flag">{{ $words['flag_seen'] }}</span>
                            @endif
                        </span>

                        @if ($row['reason'])
                            <span class="ld-players__reason">{{ $row['reason'] }}</span>
                        @endif

                        {{--
                            The row's own buttons, each carrying the name as an
                            argument. Only the ones that would change something
                            are drawn: an operator has no "make operator".
                        --}}
                        <span class="ld-players__actions">
                            @if ($row['banned'])
                                {{ ($this->pardonAction)(['name' => $row['name']]) }}
                            @else
                                {{ ($this->banAction)(['name' => $row['name']]) }}
                                {{ ($this->kickAction)(['name' => $row['name']]) }}
                            @endif

                            @if ($row['op'])
                                {{ ($this->deopAction)(['name' => $row['name']]) }}
                            @else
                                {{ ($this->opAction)(['name' => $row['name']]) }}
                            @endif

                            @if ($row['whitelisted'])
                                {{ ($this->unwhitelistAction)(['name' => $row['name']]) }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Adding somebody who has never been here needs a name typed in, and
             it is the one action that cannot hang off a row. --}}
        <div class="ld-players__add">
            {{ $this->whitelistAction }}
        </div>

        <div class="ld-players__head">
            <h3>{{ $words['ips'] }}</h3>
        </div>

        @if ($ips === [])
            <p class="ld-players__empty">{{ $words['ips_empty'] }}</p>
        @else
            <div class="ld-players__table">
                @foreach ($ips as $entry)
                    <div class="ld-players__row">
                        <span class="ld-players__name">{{ $entry['ip'] }}</span>

                        @if ($entry['reason'])
                            <span class="ld-players__reason">{{ $entry['reason'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Without this the buttons above open nothing: an action rendered in a
         page body has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
