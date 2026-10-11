<?php

namespace LegendDevelopment\Theme\Support\Games;

/**
 * A setting's name in words, worked out from the key.
 *
 * **Derived rather than listed, and the reason is the whole of roadmap/games.md.**
 * A list of labels is a list that goes stale: a game adds a setting, a mod adds
 * three, and a key with no entry in the list appears as nothing at all or as
 * itself while everything around it reads properly. Support\Palworld\Palworld
 * has done this since before any of it was planned; this is the same idea
 * without the part of it that is about Unreal.
 *
 * **It leaves a key alone when there is nothing to derive.** `maxplayers` is one
 * lowercase run and splitting it needs a dictionary, so it comes back as
 * "Maxplayers" rather than as a guess. The page shows the raw key beside the
 * label only where the two differ, so a setting like that reads once rather
 * than twice.
 */
class Words
{
    /**
     * Pairs the splitter cannot tell from two words, and what they should be.
     *
     * Repaired after the split rather than protected before it. Protecting them
     * means putting a placeholder through a rule that is about capital letters,
     * and any placeholder that survives that rule is one that can collide with
     * a real setting. Putting `Pv P` back together afterwards has neither
     * problem and is the same two lines.
     *
     * @var array<string, string>
     */
    private const MENDED = [
        'Pv P' => 'PvP',
        'Pv E' => 'PvE',
    ];

    /**
     * @param  string  $key  A setting's name as the file writes it.
     */
    public static function of(string $key): string
    {
        // A sectioned INI puts the heading in the key. The heading is on the
        // section, so the field only needs what comes after it.
        $short = str_contains($key, '.') ? substr($key, (int) strrpos($key, '.') + 1) : $key;

        /*
         * Unreal's two prefixes, neither of which is part of the name.
         *
         * A leading b marks a boolean and a leading m marks a member variable:
         * bIsPvP is "Is PvP" and mAutoPause is "Auto Pause". Both are Unreal's
         * own convention rather than anything a player would recognise, and a
         * Satisfactory Game.ini is almost entirely the second one.
         *
         * Only before a capital. A key that genuinely begins with one of these
         * letters as a word - `mods`, `banlist` - has a lowercase after it and
         * keeps every letter it was written with.
         */
        $name = preg_match('/^[bm][A-Z]/', $short) === 1 ? substr($short, 1) : $short;

        $name = str_replace(['_', '-'], ' ', $name);

        /*
         * Two rules rather than one, and the second is the one that matters.
         *
         * Splitting before every capital turns XPMultiplier into "X P
         * multiplier", which is what ArkConfig::words() does and is the reason
         * this is not simply lifted from there. A run of capitals is a word:
         * the split goes before a capital that follows a lowercase, and before
         * the last capital of a run when a lowercase follows it.
         */
        $spaced = preg_replace(
            ['/([a-z0-9])([A-Z])/', '/([A-Z]+)([A-Z][a-z])/'],
            '$1 $2',
            $name,
        ) ?? $name;

        $spaced = strtr($spaced, self::MENDED);
        $spaced = trim(preg_replace('/\s+/', ' ', $spaced) ?? $spaced);

        /*
         * Not lowercased, which is the other half of the same decision. XP,
         * PvP, HP and RCON are words somebody typed in capitals on purpose, and
         * a label that reads "Xp multiplier" reads as a mistake.
         */
        return $spaced === '' ? $key : ucfirst($spaced);
    }
}
