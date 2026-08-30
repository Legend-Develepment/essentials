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
    public const BLOCKS = ['cpu', 'memory', 'swap', 'disk', 'load', 'uptime', 'system', 'version'];

    /**
     * The ones that are a bar. They get a section of their own, away from the
     * ones that are a fact: how hard the machine is working and what the
     * machine is are two different questions, and a page that interleaves them
     * makes you sort them yourself.
     */
    public const USAGE = ['cpu', 'memory', 'swap', 'disk', 'load'];

    private const REFRESH = ['off', '5', '10', '30', '60'];

    /** A ceiling on disk cards. A container host can mount a dozen. */
    private const MAX_DISKS = 8;

    /**
     * Filesystem types that are not a disk. The kernel's own bookkeeping, the
     * things that live in memory, and the read-only images a snap is mounted
     * from - none of them fill up, and a meter on one says nothing.
     */
    private const VIRTUAL_TYPES = [
        'autofs', 'binfmt_misc', 'bpf', 'cgroup', 'cgroup2', 'configfs', 'debugfs',
        'devpts', 'devtmpfs', 'efivarfs', 'fusectl', 'hugetlbfs', 'mqueue', 'nsfs',
        'proc', 'pstore', 'ramfs', 'rpc_pipefs', 'securityfs', 'selinuxfs',
        'squashfs', 'sysfs', 'tmpfs', 'tracefs',
    ];

    /**
     * And the places they are usually mounted, for anything the list above
     * misses. A new virtual filesystem appears more often than /proc moves.
     */
    private const VIRTUAL_PATHS = ['/proc/', '/sys/', '/dev/', '/run/', '/snap/', '/var/snap/'];

    /** @var array<int, string>|null Read once, for the life of the request. */
    private static ?array $mounts = null;

    /* ------------------------------------------------------------ settings */

    /**
     * One switch, in two places.
     *
     * The Features tab lists it beside everything else the plugin adds, and the
     * page itself has it in its own options where you are when you decide you
     * do not want it. Both write the same stored list, so they can never
     * disagree.
     */
    public static function enabled(): bool
    {
        return Features::enabled(Features::SYSTEM_STATUS);
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

    /**
     * Which nodes get a card of their own on the page, as ids.
     *
     * Empty means none, and that is the opposite rule to blocks() on purpose.
     * Nothing ticked there would leave an empty page, so it means everything;
     * nothing ticked here leaves the page doing its own job, which is the panel
     * host. Nodes are an addition, and "none" is a real answer - the dashboard
     * already has a block that shows them all.
     *
     * @return array<int, int>
     */
    public static function nodes(): array
    {
        $stored = Theme::config('system_status_nodes', '');
        $stored = is_string($stored) ? array_filter(explode(',', $stored)) : [];

        return array_values(array_unique(array_map('intval', array_filter($stored, 'ctype_digit'))));
    }

    public static function sanitiseRefresh(mixed $value): string
    {
        return self::oneOf($value, self::REFRESH, '10');
    }

    /**
     * Ids only, and ids that exist: a node that has been deleted since it was
     * ticked should fall out of the setting rather than sit in .env forever
     * asking for a row that can never be drawn.
     */
    public static function sanitiseNodes(mixed $value): string
    {
        $value = is_array($value) ? $value : [];
        $known = array_keys(NodeHealth::options());

        $ids = [];

        foreach ($value as $id) {
            $id = is_scalar($id) ? (int) $id : 0;

            if ($id > 0 && in_array($id, $known, true) && !in_array($id, $ids, true)) {
                $ids[] = $id;
            }
        }

        return implode(',', $ids);
    }

    /**
     * @return array<int, string>
     */
    public static function nodeOptions(): array
    {
        return NodeHealth::options();
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
            'swap' => self::swap(),
            'disk' => self::disks(),
            'load' => self::load(),
            'uptime' => self::uptime(),
            'system' => self::system(),
            'version' => Versions::panel(),
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
     * Memory, and swap, as two readings rather than one.
     *
     * They answer different questions - how much room the machine has right
     * now, and how much it once ran out of - and a page that mixes them into
     * one card makes the reader do the separating.
     *
     * @return array<string, int>|null
     */
    public static function memory(): ?array
    {
        $values = self::meminfo();
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

        return [
            'total' => $total,
            'used' => max(0, $total - $available),
        ];
    }

    /**
     * @return array<string, int>|null
     */
    public static function swap(): ?array
    {
        $values = self::meminfo();
        $total = $values['SwapTotal'] ?? 0;

        // No swap is not a failed reading, but there is no meter to draw for
        // it either, and "0 B / 0 B" reads like a fault.
        if ($total <= 0) {
            return null;
        }

        return [
            'total' => $total,
            'used' => max(0, $total - ($values['SwapFree'] ?? 0)),
        ];
    }

    /**
     * /proc/meminfo as name to bytes.
     *
     * @return array<string, int>
     */
    private static function meminfo(): array
    {
        $info = self::proc('/proc/meminfo');

        if ($info === null) {
            return [];
        }

        $values = [];

        foreach (explode("\n", $info) as $line) {
            // Only the lines in kB. HugePages_Total and friends are counts, not
            // sizes, and multiplying them by 1024 would be nonsense.
            if (preg_match('/^(\w+):\s+(\d+)\s*kB/', $line, $match) === 1) {
                $values[$match[1]] = (int) $match[2] * 1024;
            }
        }

        return $values;
    }

    /**
     * Every filesystem worth a meter, largest first.
     *
     * One reading for "the disk" is not enough on a real host: the panel is
     * usually on one filesystem and the server files on another, and a root
     * partition at 95% while a data mount sits at 10% is exactly the thing a
     * single figure hides.
     *
     * /proc/mounts lists everything the kernel has mounted, most of which is
     * not a disk. Rather than guess at an allowlist of filesystem types - which
     * would quietly drop whatever the next distribution ships - anything
     * virtual is turned away by type and by mount point, and what is left has
     * to answer disk_total_space() with a real size.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function disks(): array
    {
        $points = self::mountPoints();

        try {
            $base = base_path();
        } catch (Throwable) {
            $base = '';
        }

        /*
         * Nothing readable is not nothing to show: on a host with no
         * /proc/mounts the panel's own directory is still a filesystem, and it
         * is the one that matters most.
         */
        if ($points === [] && $base !== '') {
            $points = [$base];
        }

        $panelMount = $base === '' ? null : (self::mountFor($base) ?? $base);

        $rows = [];
        $seen = [];

        foreach ($points as $mount) {
            $row = self::readDisk($mount);

            if ($row === null) {
                continue;
            }

            /*
             * The same filesystem reached by two paths is one disk. Docker
             * bind-mounts /etc/hosts and /etc/resolv.conf off the host's own
             * disk, and each of them answers with that disk's figures - three
             * identical cards for one partition. Two different filesystems
             * agreeing to the byte on both size and usage does not happen.
             */
            $signature = $row['total'] . ':' . $row['used'];

            if (isset($seen[$signature])) {
                continue;
            }

            $seen[$signature] = true;
            $row['panel'] = $panelMount !== null && $mount === $panelMount;
            $rows[] = $row;
        }

        // Biggest first, and capped: a container host can mount a dozen, and a
        // page of twelve disk cards is not clearer than a page of four.
        usort($rows, static fn (array $a, array $b) => $b['total'] <=> $a['total']);

        return array_slice($rows, 0, self::MAX_DISKS);
    }

    /**
     * @return array<string, mixed>|null
     */
    private static function readDisk(string $mount): ?array
    {
        try {
            $total = @disk_total_space($mount);
            $free = @disk_free_space($mount);

            if ($total === false || $free === false || $total <= 0) {
                return null;
            }

            return [
                'mount' => $mount,
                'total' => (int) $total,
                'used' => (int) max(0, $total - $free),
                // Set by disks(), which knows which mount the panel is on.
                'panel' => false,
            ];
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The longest mount point the given path sits under, which is the
     * filesystem it is actually on.
     */
    private static function mountFor(string $path): ?string
    {
        $best = null;

        foreach (self::mountPoints() as $mount) {
            $under = $mount === '/' || str_starts_with($path . '/', rtrim($mount, '/') . '/');

            if ($under && ($best === null || strlen($mount) > strlen($best))) {
                $best = $mount;
            }
        }

        return $best;
    }

    /**
     * Real filesystems from /proc/mounts, in the order the kernel lists them.
     *
     * @return array<int, string>
     */
    private static function mountPoints(): array
    {
        // Read once. disks() asks for the list, and asking which mount the
        // panel is on asks for it again.
        if (self::$mounts !== null) {
            return self::$mounts;
        }

        $mounts = self::proc('/proc/mounts');

        if ($mounts === null) {
            return self::$mounts = [];
        }

        $points = [];
        $seen = [];

        foreach (explode("\n", $mounts) as $line) {
            $fields = explode(' ', trim($line));

            if (count($fields) < 3) {
                continue;
            }

            [$device, $mount, $type] = $fields;

            // Mount points are written with octal escapes for spaces and tabs.
            $mount = preg_replace_callback(
                '/\\\\(\d{3})/',
                static fn (array $m) => chr((int) octdec($m[1])),
                $mount
            ) ?? $mount;

            if (in_array($type, self::VIRTUAL_TYPES, true) || str_starts_with($type, 'fuse.')) {
                continue;
            }

            foreach (self::VIRTUAL_PATHS as $prefix) {
                if ($mount === rtrim($prefix, '/') || str_starts_with($mount, $prefix)) {
                    continue 2;
                }
            }

            // One card per filesystem, not per bind mount: the same device
            // mounted twice is one disk filling up, shown twice.
            if (isset($seen[$device])) {
                continue;
            }

            $seen[$device] = true;
            $points[] = $mount;
        }

        return self::$mounts = $points;
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
    public static function cores(): ?int
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
