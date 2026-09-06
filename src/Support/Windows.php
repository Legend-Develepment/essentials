<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

/**
 * A different look between two times of day.
 *
 * A dark style after ten, a maintenance colour during the window somebody
 * reboots nodes in, a red one on the weekend. Off until a window is added, and
 * the reason it stayed on the backlog for so long is a fair one: whether anybody
 * wants their panel changing under them while they are working in it is a real
 * question, and the answer is theirs rather than this plugin's.
 *
 * **It changes nothing that is saved.** A window is an overlay, laid over the
 * panel's own settings while the stylesheet is built and released the moment it
 * is done - the same mechanism a person's own style already uses, through
 * Theme::using(). The settings form still shows what is stored, and saving it
 * still writes what is on it. That distinction is the whole safety of this: a
 * schedule that quietly rewrote the panel's preset at ten every night would be
 * a schedule that eventually lost somebody's real one.
 *
 * And it sits under a person's own style rather than over it. Somebody who has
 * picked a look for themselves has answered this question already.
 *
 * The clock is the panel's, from config('app.timezone'), not each reader's.
 * A panel that looked different to two people at the same moment because one of
 * them is in Sydney would be a panel that looks broken rather than scheduled.
 */
class Windows
{
    /**
     * A list, so a file rather than .env.
     *
     * Same as the monitors and the role mappings: two times, a preset and up to
     * seven days per row is not a string anybody wants to parse out of an
     * environment variable.
     */
    private const PATH = 'legend-theme/windows.json';

    /**
     * Twelve, which is more than a day has room for anybody to want.
     *
     * The cap is not about storage - it is that the first matching window wins,
     * and a list long enough that nobody can see which one that is has stopped
     * being a setting.
     */
    public const MAX = 12;

    /** Monday first, as the rest of Europe writes it. */
    public const DAYS = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

    /** @var array<int, array{from: string, to: string, preset: string, days: array<int, string>}>|null */
    private static ?array $cached = null;

    public static function enabled(): bool
    {
        return Features::enabled(Features::SCHEDULED);
    }

    public static function forget(): void
    {
        self::$cached = null;
    }

    /**
     * @return array<int, array{from: string, to: string, preset: string, days: array<int, string>}>
     */
    public static function rows(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        self::$cached = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::PATH)) {
                return self::$cached;
            }

            $decoded = json_decode((string) $disk->get(self::PATH), true);

            return self::$cached = self::clean(is_array($decoded) ? $decoded : []);
        } catch (Throwable) {
            // No windows, which is the panel drawing its own look - the right
            // direction for a file that can only ever change how things appear.
            return self::$cached = [];
        }
    }

    /**
     * Returns whether the list actually reached the disk.
     *
     * @param  array<int|string, mixed>  $rows
     */
    public static function save(array $rows): bool
    {
        $clean = self::clean($rows);

        try {
            if (Storage::disk('local')->put(self::PATH, (string) json_encode($clean, JSON_PRETTY_PRINT)) === false) {
                report(new RuntimeException(
                    'Could not write ' . self::PATH . ' to the local disk. Check that '
                    . storage_path('app') . ' belongs to the user the panel runs as.',
                ));

                return false;
            }
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }

        self::$cached = $clean;

        return true;
    }

    /**
     * @param  array<int|string, mixed>  $rows
     * @return array<int, array{from: string, to: string, preset: string, days: array<int, string>}>
     */
    public static function clean(array $rows): array
    {
        $out = [];

        foreach (array_slice(array_values($rows), 0, self::MAX) as $row) {
            if (!is_array($row)) {
                continue;
            }

            $from = self::minutes($row['from'] ?? null);
            $to = self::minutes($row['to'] ?? null);
            $preset = is_string($row['preset'] ?? null) ? $row['preset'] : '';

            if ($from === null || $to === null) {
                continue;
            }

            /*
             * The two times being the same is not a window.
             *
             * It could be read as "no time at all" or as "all day" and there is
             * no way to tell which somebody meant, so it is neither - the row is
             * dropped, and "all day" is written the way it reads: 00:00 to
             * 23:59.
             */
            if ($from === $to) {
                continue;
            }

            // A preset that has since been deleted would be a window that turns
            // the panel's look off rather than changing it.
            if ($preset === '' || !Presets::exists($preset)) {
                continue;
            }

            $out[] = [
                'from' => self::clock($from),
                'to' => self::clock($to),
                'preset' => $preset,
                'days' => self::days($row['days'] ?? null),
            ];
        }

        return $out;
    }

    /**
     * Which preset is in force right now, or null.
     *
     * The first window that covers this moment, in the order they are listed.
     * First rather than last, and the list is reorderable, so which one wins
     * where two overlap is something an administrator can see and change rather
     * than something they have to work out.
     */
    public static function active(): ?string
    {
        if (!self::enabled()) {
            return null;
        }

        $rows = self::rows();

        if ($rows === []) {
            return null;
        }

        try {
            [$minutes, $today, $yesterday] = self::now();
        } catch (Throwable) {
            return null;
        }

        foreach ($rows as $row) {
            if (self::covers($row, $minutes, $today, $yesterday)) {
                return $row['preset'];
            }
        }

        return null;
    }

    /**
     * Whether one window covers this moment.
     *
     * @param  array{from: string, to: string, preset: string, days: array<int, string>}  $row
     */
    public static function covers(array $row, int $minutes, string $today, string $yesterday): bool
    {
        $from = self::minutes($row['from']);
        $to = self::minutes($row['to']);

        if ($from === null || $to === null || $from === $to) {
            return false;
        }

        /*
         * A window that crosses midnight, and which day it belongs to.
         *
         * "Friday 22:00 to 06:00" starts on Friday, so two in the morning on
         * Saturday is inside it and two in the morning on Friday is not. The
         * day checked for the part after midnight is therefore yesterday's,
         * which is the reading anybody writing that window had in mind.
         */
        if ($from < $to) {
            return $minutes >= $from && $minutes < $to && self::onDay($row, $today);
        }

        if ($minutes >= $from) {
            return self::onDay($row, $today);
        }

        return $minutes < $to && self::onDay($row, $yesterday);
    }

    /**
     * @param  array{from: string, to: string, preset: string, days: array<int, string>}  $row
     */
    private static function onDay(array $row, string $day): bool
    {
        // No days chosen is every day. An empty list meaning "never" would be a
        // row that does nothing and says nothing about why.
        return $row['days'] === [] || in_array($day, $row['days'], true);
    }

    /**
     * The stylesheet built as if the active window's preset were the panel's.
     *
     * Identical in shape to UserTheme::css() and deliberately so: it is the
     * same question - build this with those values instead - and a second way
     * of answering it would be a second place for the two to disagree.
     *
     * @param  callable(): string  $build
     */
    public static function css(callable $build): string
    {
        $preset = self::active();

        if ($preset === null) {
            return '';
        }

        $values = Presets::values($preset);

        if ($values === []) {
            return '';
        }

        return Theme::using($values, static function () use ($build, $values): string {
            /*
             * Filament's own palette with it, for the reason UserTheme gives at
             * length: --primary-* was written from the panel's accent long
             * before this window opened, so without this the buttons keep the
             * old colour while everything around them changes.
             */
            $accent = Palette::sanitize($values['accent'] ?? null);

            return Palette::variables($accent) . $build();
        });
    }

    /**
     * Now, as minutes past midnight and the two day names a window might need.
     *
     * @return array{0: int, 1: string, 2: string}
     */
    public static function now(): array
    {
        $at = now();

        // dayOfWeekIso is 1 for Monday, which is the order DAYS is in.
        $today = self::DAYS[((int) $at->dayOfWeekIso) - 1] ?? 'mon';
        $yesterday = self::DAYS[(((int) $at->dayOfWeekIso) + 5) % 7] ?? 'mon';

        return [((int) $at->format('G')) * 60 + (int) $at->format('i'), $today, $yesterday];
    }

    /**
     * "22:00" as 1320, or null.
     *
     * Written as text because that is what a time field hands over, and kept as
     * text in the file for the same reason it is easier to read there.
     */
    public static function minutes(mixed $value): ?int
    {
        if (!is_string($value) || preg_match('/^([0-9]{1,2}):([0-9]{2})$/D', trim($value), $found) !== 1) {
            return null;
        }

        $hours = (int) $found[1];
        $minutes = (int) $found[2];

        if ($hours > 23 || $minutes > 59) {
            return null;
        }

        return $hours * 60 + $minutes;
    }

    /** 1320 as "22:00". */
    public static function clock(int $minutes): string
    {
        return sprintf('%02d:%02d', intdiv($minutes, 60) % 24, $minutes % 60);
    }

    /**
     * @return array<int, string>
     */
    private static function days(mixed $value): array
    {
        if (!is_array($value)) {
            return [];
        }

        $out = [];

        foreach ($value as $day) {
            $day = is_scalar($day) ? strtolower((string) $day) : '';

            if (in_array($day, self::DAYS, true)) {
                $out[$day] = true;
            }
        }

        // In week order rather than in the order they were ticked, so two rows
        // holding the same days read the same.
        return array_values(array_filter(self::DAYS, static fn (string $day): bool => isset($out[$day])));
    }

    /**
     * The days, for the picker.
     *
     * @return array<string, string>
     */
    public static function dayOptions(): array
    {
        $out = [];

        foreach (self::DAYS as $day) {
            $out[$day] = Theme::trans('settings.windows.day_' . $day);
        }

        return $out;
    }
}
