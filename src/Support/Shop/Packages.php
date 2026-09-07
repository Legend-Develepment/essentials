<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Egg;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What can be bought, and what each package would become.
 *
 * Two questions this answers that are easy to conflate. "Is it for sale" is
 * the `live` flag plus whether an egg still exists to build it from. "Is there
 * one left" is stock minus the orders that hold a place - counted from the
 * orders table every time, never from a number on the package that could
 * drift from the truth.
 */
class Packages
{
    /**
     * Everything for sale, in the order the shop shows it.
     *
     * @return Collection<int, Package>
     */
    public static function live(): Collection
    {
        try {
            return Package::query()
                ->where('live', true)
                ->whereNotNull('egg_id')
                ->orderBy('sort')
                ->orderBy('name')
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * How many orders currently hold a place in a package's stock.
     *
     * Pending, active and suspended all count: a pending order is somebody who
     * has bought and not yet been provisioned, and their place is theirs.
     */
    public static function occupied(int $packageId): int
    {
        try {
            return Order::query()
                ->where('package_id', $packageId)
                ->whereIn('state', Order::OCCUPYING)
                ->count();
        } catch (Throwable) {
            return 0;
        }
    }

    /** Null for unlimited, otherwise how many more could be sold. */
    public static function stockLeft(Package $package): ?int
    {
        if ($package->stock === null) {
            return null;
        }

        return max(0, $package->stock - self::occupied((int) $package->id));
    }

    public static function soldOut(Package $package): bool
    {
        return self::stockLeft($package) === 0;
    }

    /**
     * The egg's own answers, for filling a form the moment an egg is picked.
     *
     * The same three things Pelican's own Create Server page fills in when its
     * egg field changes: the first image, the first startup command, and every
     * variable at its default. Read here rather than copied from that page so
     * the shop and the panel agree about what "the default" is.
     *
     * @return array{image: ?string, startup: ?string, environment: array<string, string>}
     */
    public static function eggDefaults(int $eggId): array
    {
        $out = ['image' => null, 'startup' => null, 'environment' => []];

        try {
            $egg = Egg::query()->with('variables')->find($eggId);

            if ($egg === null) {
                return $out;
            }

            $images = is_array($egg->docker_images) ? $egg->docker_images : [];
            $startups = is_array($egg->startup_commands) ? $egg->startup_commands : [];

            $out['image'] = is_string(Arr::first($images)) ? Arr::first($images) : null;
            $out['startup'] = is_string(Arr::first($startups)) ? Arr::first($startups) : null;

            foreach ($egg->variables as $variable) {
                $out['environment'][(string) $variable->env_variable] = (string) $variable->default_value;
            }
        } catch (Throwable) {
            // An egg that will not answer leaves the form empty, which the
            // form says rather than guessing.
        }

        return $out;
    }

    /**
     * The images an egg offers, as a select's options: the image is the value,
     * the egg's own label for it is what is shown.
     *
     * @return array<string, string>
     */
    public static function images(?int $eggId): array
    {
        return self::choices($eggId, 'docker_images');
    }

    /**
     * The startup commands an egg offers, the same way.
     *
     * @return array<string, string>
     */
    public static function startups(?int $eggId): array
    {
        return self::choices($eggId, 'startup_commands');
    }

    /**
     * @return array<string, string>
     */
    private static function choices(?int $eggId, string $column): array
    {
        if ($eggId === null || $eggId <= 0) {
            return [];
        }

        try {
            $egg = Egg::query()->find($eggId);
            $list = $egg?->{$column};

            if (!is_array($list)) {
                return [];
            }

            $out = [];

            /*
             * Pelican keeps these as label => value. A select wants
             * value => label, and a label that is missing or blank falls back
             * to the value itself, which is at least true.
             */
            foreach ($list as $label => $value) {
                if (!is_string($value) || $value === '') {
                    continue;
                }

                $out[$value] = is_string($label) && $label !== '' ? $label : $value;
            }

            return $out;
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The eggs a package may be built from, for a select.
     *
     * @return array<int, string>
     */
    public static function eggOptions(): array
    {
        try {
            return Egg::query()
                ->orderBy('name')
                ->pluck('name', 'id')
                ->map(static fn ($name): string => (string) $name)
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The periods, as a select's options.
     *
     * @return array<string, string>
     */
    public static function periodOptions(): array
    {
        $out = [];

        foreach (Package::PERIODS as $period) {
            $out[$period] = Theme::trans('packages.period_' . $period);
        }

        return $out;
    }

    /** The one currency the shop is set to. */
    public static function currency(): string
    {
        return Money::currency(Theme::config('shop_currency', Money::DEFAULT));
    }

    /** "€ 12,50 a month" - the price the way a card or a column says it. */
    public static function priceLabel(Package $package, ?string $currency = null): string
    {
        return Money::format((int) $package->price, $currency ?? self::currency())
            . ' ' . Theme::trans('packages.per_' . self::period($package->period));
    }

    /** A period that is one of the four, whatever the row says. */
    public static function period(mixed $value): string
    {
        return in_array($value, Package::PERIODS, true) ? (string) $value : Package::MONTH;
    }

    /**
     * A slug nobody else has, from a name.
     *
     * The public page anchors on it and the URL a bot might build carries it,
     * so it has to be stable and it has to be unique - two packages called
     * "Starter" get starter and starter-2.
     */
    public static function slug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug(mb_substr($name, 0, 48)) ?: 'package';
        $slug = $base;
        $n = 1;

        try {
            while (Package::query()
                ->where('slug', $slug)
                ->when($ignoreId !== null, static fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()) {
                $n++;
                $slug = $base . '-' . $n;
            }
        } catch (Throwable) {
            // A database that will not answer gets the base slug, and the
            // unique index says no if it has to.
        }

        return mb_substr($slug, 0, 64);
    }

    /**
     * What a form hands back, held to what a package can be.
     *
     * Every number is clamped to Pelican's own range for it, the environment
     * is flattened to string => string, and the node list is integers. Prices
     * arrive as what somebody typed and leave as minor units - see Money.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function sanitise(array $data, ?int $ignoreId = null): array
    {
        $name = mb_substr(trim((string) ($data['name'] ?? '')), 0, 120);
        $slug = trim((string) ($data['slug'] ?? ''));
        $slug = $slug === '' ? self::slug($name, $ignoreId) : self::slug($slug, $ignoreId);

        $environment = [];

        foreach ((array) ($data['environment'] ?? []) as $key => $value) {
            $key = trim((string) $key);

            if ($key === '' || preg_match('/^[A-Za-z_][A-Za-z0-9_]{0,190}$/', $key) !== 1) {
                continue;
            }

            $environment[$key] = is_scalar($value) ? (string) $value : '';
        }

        $nodes = [];

        foreach ((array) ($data['node_ids'] ?? []) as $id) {
            if (is_numeric($id) && (int) $id > 0) {
                $nodes[] = (int) $id;
            }
        }

        $stock = $data['stock'] ?? null;
        $image = trim((string) ($data['image'] ?? ''));
        $startup = trim((string) ($data['startup'] ?? ''));
        $threads = trim((string) ($data['threads'] ?? ''));

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => mb_substr(trim((string) ($data['description'] ?? '')), 0, 2000) ?: null,
            'egg_id' => is_numeric($data['egg_id'] ?? null) && (int) $data['egg_id'] > 0 ? (int) $data['egg_id'] : null,
            'image' => $image === '' ? null : mb_substr($image, 0, 191),
            'startup' => $startup === '' ? null : mb_substr($startup, 0, 4000),
            'memory' => self::clamp($data['memory'] ?? null, 0, 1048576, 1024),
            'swap' => self::clamp($data['swap'] ?? null, -1, 1048576, 0),
            'disk' => self::clamp($data['disk'] ?? null, 0, 10485760, 5120),
            'io' => self::clamp($data['io'] ?? null, 10, 1000, 500),
            'cpu' => self::clamp($data['cpu'] ?? null, 0, 100000, 100),
            // Pelican's own rule for the field: digits, commas and dashes.
            'threads' => $threads !== '' && preg_match('/^[0-9,-]{1,64}$/', $threads) === 1 ? $threads : null,
            'oom_killer' => (bool) ($data['oom_killer'] ?? false),
            'database_limit' => self::clamp($data['database_limit'] ?? null, 0, 100, 0),
            'allocation_limit' => self::clamp($data['allocation_limit'] ?? null, 0, 100, 0),
            'backup_limit' => self::clamp($data['backup_limit'] ?? null, 0, 100, 0),
            'environment' => $environment,
            'node_ids' => array_values(array_unique($nodes)),
            'price' => Money::fromInput($data['price'] ?? null) ?? 0,
            'setup_fee' => Money::fromInput($data['setup_fee'] ?? null) ?? 0,
            'period' => self::period($data['period'] ?? null),
            'stock' => $stock === null || $stock === '' ? null : self::clamp($stock, 0, 100000, 0),
            'live' => (bool) ($data['live'] ?? false),
            'sort' => self::clamp($data['sort'] ?? null, 0, 1000, 0),
        ];
    }

    /**
     * A row, the way the form wants to see it: prices as text in the reader's
     * own decimal mark, and nothing null where a field wants a string.
     *
     * @return array<string, mixed>
     */
    public static function toForm(Package $package): array
    {
        $data = $package->toArray();

        $data['price'] = Money::toInput((int) $package->price);
        $data['setup_fee'] = Money::toInput((int) $package->setup_fee);
        $data['environment'] = is_array($package->environment) ? $package->environment : [];
        $data['node_ids'] = is_array($package->node_ids) ? $package->node_ids : [];

        return $data;
    }

    /**
     * Everything an order needs to remember about a package, at the moment it
     * is bought. Read by Provision in the next release; recorded from the
     * first one so no order is ever without it.
     *
     * @return array<string, mixed>
     */
    public static function spec(Package $package): array
    {
        return [
            'name' => $package->name,
            'egg_id' => $package->egg_id,
            'image' => $package->image,
            'startup' => $package->startup,
            'memory' => $package->memory,
            'swap' => $package->swap,
            'disk' => $package->disk,
            'io' => $package->io,
            'cpu' => $package->cpu,
            'threads' => $package->threads,
            'oom_killer' => (bool) $package->oom_killer,
            'database_limit' => $package->database_limit,
            'allocation_limit' => $package->allocation_limit,
            'backup_limit' => $package->backup_limit,
            'environment' => is_array($package->environment) ? $package->environment : [],
            'node_ids' => is_array($package->node_ids) ? $package->node_ids : [],
        ];
    }

    private static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max($min, min($max, (int) $value));
    }
}
