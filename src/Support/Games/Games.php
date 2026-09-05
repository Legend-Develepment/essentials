<?php

namespace LegendDevelopment\Theme\Support\Games;

use App\Models\Egg;
use App\Models\Server;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which eggs answer Valve's server query.
 *
 * The same shape as Support\Minecraft, and deliberately: an administrator says
 * which eggs are which game, and everything else asks that rather than guessing
 * from a name. A panel's eggs are named by whoever made them - "Rust", "Rust
 * (Staging)", "rust-oxide-2024" - and no amount of matching on that is going to
 * be right on somebody else's panel.
 *
 * Opt in, and for the reason the Minecraft ping is opt in: asking is the one
 * thing here that opens a connection from the panel straight to a game port. On
 * a panel whose nodes are on a network the panel cannot reach, nothing answers
 * and nothing appears - which is fine, but it should be a thing somebody chose
 * rather than a thing that started happening.
 *
 * One list for every game that speaks the protocol rather than a list per game.
 * Rust, ARK, Valheim and 7 Days to Die all answer the same query, and the reply
 * says which game it is - so splitting them would be three more settings that
 * cannot disagree usefully.
 */
class Games
{
    /** @var array<int, int>|null */
    private static ?array $eggs = null;

    /** @var array<int, bool> */
    private static array $detected = [];

    /**
     * The eggs an administrator has said answer the query.
     *
     * @return array<int, int>
     */
    public static function eggs(): array
    {
        if (self::$eggs !== null) {
            return self::$eggs;
        }

        $stored = Theme::config('query_eggs', '');

        if (!is_string($stored) || trim($stored) === '') {
            return self::$eggs = [];
        }

        return self::$eggs = array_values(array_unique(array_filter(
            array_map('intval', explode(',', $stored)),
            static fn (int $id): bool => $id > 0,
        )));
    }

    /** Whether this server is one of them. Memoised: a page asks per row. */
    public static function speaks(Server $server): bool
    {
        $id = (int) $server->id;

        if (array_key_exists($id, self::$detected)) {
            return self::$detected[$id];
        }

        try {
            return self::$detected[$id] = in_array((int) $server->egg_id, self::eggs(), true);
        } catch (Throwable) {
            return self::$detected[$id] = false;
        }
    }

    /**
     * Every egg, for the picker.
     *
     * @return array<int, string>
     */
    public static function eggOptions(): array
    {
        try {
            return Egg::query()
                ->orderBy('name')
                ->get()
                ->mapWithKeys(static fn (Egg $egg): array => [(int) $egg->id => (string) $egg->name])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The list, as one setting.
     *
     * @param  mixed  $value
     */
    public static function sanitise(mixed $value): string
    {
        if (!is_array($value)) {
            return '';
        }

        $ids = array_values(array_unique(array_filter(
            array_map('intval', $value),
            static fn (int $id): bool => $id > 0,
        )));

        return implode(',', array_slice($ids, 0, 200));
    }
}
