<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The panel's own machine: what it is running on and how hard it is working.
 *
 * This is deliberately a different question from the node health block on the
 * dashboard. That one asks the daemon about the machines the servers run on;
 * this one reads the host the web interface itself is on. On a single-box
 * install they are the same machine and the two agree. On any install with a
 * separate node they are not, and both are worth knowing.
 *
 * Everything is read from /proc and from PHP's own functions - no shell
 * commands, so nothing here depends on exec() being allowed, on a particular
 * shell, or on the output format of a tool that varies between distributions.
 * A host without /proc simply reports what it can and says nothing about the
 * rest.
 */
class SystemStatus
{
    /** The blocks that can be shown, and the order they are shown in. */
    public const BLOCKS = ['cpu', 'memory', 'disk', 'load', 'uptime', 'system'];

    private const REFRESH = ['off', '5', '10', '30', '60'];

    /* ------------------------------------------------------------ settings */

    public static function enabled(): bool
    {
        return (bool) Theme::config('system_status', true);
    }

    /**
     * How often the page asks again, in seconds - or 'off'.
     *
     * Off is a real answer, not a missing one: every one of these readings is a
     * handful of small files, but a page left open on a wall display asking
     * four times a minute forever is a choice somebody should get to make.
     */
    public static function refresh(): string
    {
        return self::oneOf(Theme::config('system_status_refresh', '10'), self::REFRESH, '10');
    }

    /**
     * @return array<int, string>
     */
    public static function blocks(): array
    {
        $stored = Theme::config('system_status_blocks', '');
        $stored = is_string($stored) ? array_filter(explode(',', $stored)) : [];

        $chosen = array_values(array_intersect(self::BLOCKS, $stored));

        // Nothing chosen is everything, not an empty page: a fresh install
        // should show what it can do rather than a heading and white space.
        return $chosen === [] ? self::BLOCKS : $chosen;
    }

    public static function sanitiseRefresh(mixed $value): string
    {
        return self::oneOf($value, self::REFRESH, '10');
    }

    /**
     * @param  mixed  $value
     */
    public static function sanitiseBlocks(mixed $value): string
    {
        $value = is_array($value) ? $value : [];

        return implode(',', array_values(array_intersect(self::BLOCKS, $value)));
    }

    /**
     * @return array<string, string>
     */
    public static function refreshOptions(): array
    {
        $options = [];

        foreach (self::REFRESH as $seconds) {
            $options[$seconds] = $seconds === 'off'
                ? Theme::trans('system.refresh_off')
                : Theme::trans('system.refresh_seconds', ['seconds' => $seconds]);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function blockOptions(): array
    {
        $options = [];

        foreach (self::BLOCKS as $block) {
            $options[$block] = Theme::trans('system.block_' . $block);
        }

        return $options;
    }

    /* ------------------------------------------------------------ readings */

    /**
     * Everything, in one call, with each part answering null when it cannot be
     * had.
     *
     * @return array<string, mixed>
     */
    public static function all(): array
    {
        return [
            'cpu' => self::cpu(),
            'memory' => self::memory(),
            'disk' => self::disk(),
            'load' => self::load(),
            'uptime' => self::uptime(),
            'system' => self::system(),
        ];
    }

    /**
     * How busy the processor is, as a percentage.
     *
     * /proc/stat counts time since boot, so a single reading says nothing - the
     * figure is the difference between two of them. The previous one is kept in
     * the cache, which means the first look after a quiet period has nothing to
     * compare against and honestly says so rather than inventing a number.
     */
    public static function cpu(): ?float
    {
        $now = self::cpuTotals();

        if ($now === null) {
            return null;
        }

        $key = 'legend-theme.system.cpu';
        $before = null;

        try {
            $before = cache()->get($key);
            cache()->put($key, $now, now()->addMinutes(5));
        } catch (Throwable) {
            // No cache is no comparison, and no comparison is no figure.
            return null;
        }

        if (!is_array($before) || $before['total'] >= $now['total']) {
            return null;
        }

        $total = $now['total'] - $before['total'];
        $idle = $now['idle'] - $before['idle'];

        return $total <= 0 ? null : round(max(0, min(100, (1 - $idle / $total) * 100)), 1);
    }

    /**
     * @return array{total: int, idle: int}|null
     */
    private static function cpuTotals(): ?array
    {
        $line = self::firstLine('/proc/stat');

        if ($line === null || !str_starts_with($line, 'cpu ')) {
            return null;
        }

        $fields = array_values(array_filter(explode(' ', substr($line, 4)), static fn ($v) => $v !== ''));

        if (count($fields) < 5) {
            return null;
        }

        $numbers = array_map('intval', $fields);

        // Field four is idle and field five is iowait: a processor waiting on a
        // disk is not a processor doing work.
        return [
            'total' => array_sum($numbers),
            'idle' => $numbers[3] + $numbers[4],
        ];
    }

    /**
     * @return array<string, int>|null
     */
    public static function memory(): ?array
    {
        $info = self::proc('/proc/meminfo');

        if ($info === null) {
            return null;
        }

        $values = [];

        foreach (explode("\n", $info) as $line) {
            if (preg_match('/^(\w+):\s+(\d+)\s*kB/', $line, $match) === 1) {
                $values[$match[1]] = (int) $match[2] * 1024;
            }
        }

        $total = $values['MemTotal'] ?? 0;

        if ($total <= 0) {
            return null;
        }

        /*
         * MemAvailable rather than MemFree: Linux uses everything spare as
         * cache, so free memory on a healthy machine is close to nothing and
         * reporting it would have every panel looking like it is out of memory.
         */
        $available = $values['MemAvailable'] ?? $values['MemFree'] ?? 0;
        $swapTotal = $values['SwapTotal'] ?? 0;

        return [
            'total' => $total,
            'used' => max(0, $total - $available),
            'swap_total' => $swapTotal,
            'swap_used' => max(0, $swapTotal - ($values['SwapFree'] ?? 0)),
        ];
    }

    /**
     * @return array<string, int>|null
     */
    public static function disk(): ?array
    {
        try {
            // The panel's own directory, which is the disk that fills up when
            // backups and server files do.
            $path = base_path();
            $total = @disk_total_space($path);
            $free = @disk_free_space($path);

            if ($total === false || $free === false || $total <= 0) {
                return null;
            }

            return [
                'total' => (int) $total,
                'used' => (int) max(0, $total - $free),
            ];
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @return array<int, float>|null
     */
    public static function load(): ?array
    {
        try {
            $load = function_exists('sys_getloadavg') ? sys_getloadavg() : false;

            return is_array($load) ? array_map(static fn ($v) => round((float) $v, 2), $load) : null;
        } catch (Throwable) {
            return null;
        }
    }

    /** Seconds since the machine came up. */
    public static function uptime(): ?int
    {
        $line = self::firstLine('/proc/uptime');

        if ($line === null) {
            return null;
        }

        $seconds = (float) strtok($line, ' ');

        return $seconds > 0 ? (int) $seconds : null;
    }

    /**
     * @return array<string, string>
     */
    public static function system(): array
    {
        $facts = [];

        try {
            $facts['os'] = php_uname('s') . ' ' . php_uname('r');
            $facts['hostname'] = (string) (gethostname() ?: php_uname('n'));
            $facts['php'] = PHP_VERSION;
        } catch (Throwable) {
            // Whatever was gathered before it failed is still worth showing.
        }

        $cores = self::cores();

        if ($cores !== null) {
            $facts['cores'] = (string) $cores;
        }

        $processes = self::processes();

        if ($processes !== null) {
            $facts['processes'] = (string) $processes;
        }

        return $facts;
    }

    /**
     * How many processors, counted from /proc/cpuinfo rather than asked of a
     * shell. nproc is the usual answer and it needs exec(), which a hardened
     * panel host has every reason to have switched off.
     */
    private static function cores(): ?int
    {
        $info = self::proc('/proc/cpuinfo');

        if ($info === null) {
            return null;
        }

        $count = preg_match_all('/^processor\s*:/m', $info);

        return $count > 0 ? $count : null;
    }

    private static function processes(): ?int
    {
        try {
            if (!is_dir('/proc')) {
                return null;
            }

            $entries = @scandir('/proc');

            if ($entries === false) {
                return null;
            }

            // Every process has a directory named after its id, and nothing
            // else in /proc is all digits.
            return count(array_filter($entries, static fn ($e) => ctype_digit((string) $e)));
        } catch (Throwable) {
            return null;
        }
    }

    /* -------------------------------------------------------------- pieces */

    private static function proc(string $path): ?string
    {
        try {
            if (!is_readable($path)) {
                return null;
            }

            $contents = @file_get_contents($path);

            return is_string($contents) && $contents !== '' ? $contents : null;
        } catch (Throwable) {
            return null;
        }
    }

    private static function firstLine(string $path): ?string
    {
        $contents = self::proc($path);

        if ($contents === null) {
            return null;
        }

        $line = strtok($contents, "\n");

        return $line === false ? null : trim($line);
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
