<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Egg;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
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
                // The egg comes along because every card asks it for a picture
                // when the package has none of its own, and a shop with twenty
                // packages is twenty queries otherwise.
                ->with('egg')
                /*
                 * What is on offer, then what somebody should look at, then
                 * everything else in the order the shop chose.
                 *
                 * Before sort rather than after it, because an offer that
                 * appears wherever its package happened to sit is an offer
                 * nobody sees - and the whole point of marking one is that it
                 * is the first thing on the page.
                 */
                ->orderByDesc('offer')
                ->orderByDesc('popular')
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
     * Every state in Order::OCCUPYING counts, which is pending, active,
     * suspended and ending: a pending order is somebody who has bought and not
     * yet been provisioned, and their place is theirs; an ending one runs to a
     * date and the server is still there until it does.
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

    /**
     * The same count for several packages, in one query.
     *
     * Asked by anything that walks a list of them. occupied() once per package
     * is one query per row, which is fine on a page drawing six cards and not
     * fine on a pass that reads every package somebody is waiting for.
     *
     * @param  array<int, int>  $packageIds
     * @return array<int, int>  Package id to how many places are held.
     */
    public static function occupiedMany(array $packageIds): array
    {
        $packageIds = array_values(array_filter(array_map('intval', $packageIds)));

        if ($packageIds === []) {
            return [];
        }

        try {
            return Order::query()
                ->whereIn('package_id', $packageIds)
                ->whereIn('state', Order::OCCUPYING)
                ->groupBy('package_id')
                ->selectRaw('package_id, COUNT(*) as held')
                ->pluck('held', 'package_id')
                ->mapWithKeys(static fn (mixed $held, mixed $id): array => [(int) $id => (int) $held])
                ->all();
        } catch (Throwable) {
            // One query that will not run is every package reading as empty,
            // which is the same answer occupied() gives on the same failure.
            return [];
        }
    }

    /**
     * Every package on sale with a cap, and how many of it are left.
     *
     * One query for the whole shop rather than stockLeft() per package. The
     * watchdog asks this on a schedule, and stockLeft() reads one count per
     * package, so a shop with four hundred capped packages would be four
     * hundred queries every pass.
     *
     * Unlimited never appears, and the filter is in SQL rather than in the loop
     * below so a null stock never reaches the arithmetic. That is the one
     * expensive mistake available here: cast first and every unlimited package
     * in the shop reads as sold out.
     *
     * **Null when the read failed, an empty array when nothing is capped.**
     * They are different answers and the caller acts on the difference: an
     * empty array means every package has room, which would clear a standing
     * alert and announce a restock that never happened.
     *
     * @return array<int, array{id: int, name: string, left: int}>|null
     */
    public static function capped(): ?array
    {
        try {
            $rows = Package::query()
                /*
                 * Three columns and not the model. A package carries its
                 * description, its startup line, an art address and four JSON
                 * columns, and Eloquent keeps every one of them twice; four
                 * hundred of those to read a name and a number is a megabyte
                 * this pass has no use for.
                 */
                ->select(['id', 'name', 'stock'])
                ->where('live', true)
                ->whereNotNull('egg_id')
                ->whereNotNull('stock')
                /*
                 * Aliased, because withCount() would otherwise name the column
                 * orders_count, and a package that happens to carry a column
                 * of that name would have it quietly overwritten.
                 */
                ->withCount(['orders as held' => static fn ($query) => $query
                    ->whereIn('state', Order::OCCUPYING)])
                ->get();
        } catch (Throwable) {
            return null;
        }

        $out = [];

        foreach ($rows as $package) {
            $out[] = [
                'id' => (int) $package->id,
                'name' => (string) $package->name,
                'left' => max(0, (int) $package->stock - (int) $package->held),
            ];
        }

        // Emptiest first, then by name, so the same shop produces the same
        // sentence every pass rather than one that reshuffles on its own.
        usort($out, static fn (array $a, array $b): int => [$a['left'], $a['name']] <=> [$b['left'], $b['name']]);

        return $out;
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

    /**
     * The egg's own variables, as a checkbox list keyed by env name.
     *
     * Every one of them, not only the ones Pelican marks user-editable: that
     * flag is about what somebody may change on a server they already have,
     * and this is about what they are asked before it exists. An administrator
     * choosing to ask for a world seed does not want to have edited the egg
     * first.
     *
     * The label is the variable's own name with the env name beside it, because
     * two eggs will happily call two different things "Version".
     *
     * @return array<string, string>
     */
    public static function variableOptions(?int $eggId): array
    {
        $out = [];

        if ($eggId === null || $eggId <= 0) {
            return $out;
        }

        try {
            $egg = Egg::query()->with('variables')->find($eggId);

            if ($egg === null) {
                return $out;
            }

            foreach ($egg->variables as $variable) {
                $name = trim((string) $variable->env_variable);

                if ($name === '') {
                    continue;
                }

                $label = trim((string) $variable->name);

                $out[$name] = ($label === '' ? $name : $label) . ' (' . $name . ')';
            }
        } catch (Throwable) {
            // An egg that will not answer offers nothing to tick, which is the
            // same as an egg with no variables.
        }

        return $out;
    }

    /**
     * What one egg variable will actually accept, as a field to draw.
     *
     * Every egg carries validation rules with its variables - in:0,1 for a
     * switch, in:paper,purpur,vanilla for a choice, numeric with a max for a
     * port - and asking the customer to type into a plain box when the egg
     * only takes two values is how somebody buys a server that refuses to
     * start. So the rules decide the field.
     *
     * The rules are read rather than enforced here: what a customer sends is
     * checked again on the way in, and Pelican checks it once more when it
     * builds the server. This is about drawing the right control.
     *
     * @param  array<int, string>  $rules
     * @return array{kind: string, options: array<int, string>, max: int}
     */
    public static function field(array $rules): array
    {
        $out = ['kind' => 'text', 'options' => [], 'max' => 255];

        foreach ($rules as $rule) {
            $rule = trim((string) $rule);
            $lower = mb_strtolower($rule);

            /*
             * in:a,b,c - the one that matters most. An egg that lists its
             * values is an egg saying "these and nothing else", and a dropdown
             * is the only honest way to ask for that.
             */
            if (str_starts_with($lower, 'in:')) {
                $values = array_values(array_filter(array_map(
                    static fn (string $value): string => trim($value, " \t\n\r\0\x0B'\""),
                    explode(',', mb_substr($rule, 3)),
                ), static fn (string $value): bool => $value !== ''));

                if ($values !== []) {
                    $out['kind'] = 'choice';
                    $out['options'] = $values;
                }

                continue;
            }

            if ($lower === 'boolean') {
                $out['kind'] = 'choice';
                $out['options'] = ['0', '1'];

                continue;
            }

            if ($lower === 'numeric' || $lower === 'integer') {
                if ($out['kind'] === 'text') {
                    $out['kind'] = 'number';
                }

                continue;
            }

            if (str_starts_with($lower, 'max:')) {
                $max = (int) mb_substr($rule, 4);

                if ($max > 0) {
                    $out['max'] = min(255, $max);
                }
            }
        }

        return $out;
    }

    /**
     * The variables a package asks for, kept to the ones its egg still has.
     *
     * An egg edited after the package was made can lose a variable, and asking
     * a customer for something the server has nowhere to put is a question with
     * no answer.
     *
     * @return array<int, string>
     */
    public static function asked(Package $package): array
    {
        $offered = array_keys(self::variableOptions($package->egg_id === null ? null : (int) $package->egg_id));

        return array_values(array_intersect($package->asked(), $offered));
    }

    /**
     * The three things a contract can be counted in, as a select's options.
     *
     * @return array<string, string>
     */
    public static function termUnits(): array
    {
        $out = [];

        foreach (Package::TERM_UNITS as $unit) {
            $out[$unit] = Theme::trans('packages.unit_' . $unit);
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

        /*
         * Where a service on this package may be moved to.
         *
         * Ids only, itself dropped, and only the ones still there: a package
         * deleted after being ticked here would otherwise sit in this list for
         * ever, offering a move to nothing. Upgrades::options() would drop it
         * anyway, and a stored list that lies is still a list that lies.
         */
        $upgrades = [];

        foreach ((array) ($data['upgrade_to'] ?? []) as $id) {
            if (is_numeric($id) && (int) $id > 0 && (int) $id !== $ignoreId) {
                $upgrades[] = (int) $id;
            }
        }

        if ($upgrades !== []) {
            $upgrades = Package::query()->whereIn('id', $upgrades)->pluck('id')->all();
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
            'upgrade_to' => array_values(array_unique(array_map(intval(...), $upgrades))),
            'price' => Money::fromInput($data['price'] ?? null) ?? 0,
            'setup_fee' => Money::fromInput($data['setup_fee'] ?? null) ?? 0,
            'period' => self::period($data['period'] ?? null),
            'stock' => $stock === null || $stock === '' ? null : self::clamp($stock, 0, 100000, 0),
            'live' => (bool) ($data['live'] ?? false),
            'popular' => (bool) ($data['popular'] ?? false),
            'offer' => (bool) ($data['offer'] ?? false),
            // One of the two, and anything else is a percentage - which is the
            // one that cannot be wrong by an order of magnitude.
            'offer_kind' => ($data['offer_kind'] ?? '') === self::OFFER_AMOUNT
                ? self::OFFER_AMOUNT
                : self::OFFER_PERCENT,
            /*
             * A percentage is a percentage and an amount is money, so they are
             * read differently: 20 typed against a percentage is a fifth off,
             * and 20 typed against an amount is twenty of whatever the currency
             * is - which is what the field says under it while it is typed.
             */
            'offer_value' => ($data['offer_kind'] ?? '') === self::OFFER_AMOUNT
                ? (Money::fromInput($data['offer_value'] ?? null) ?? 0)
                : self::clamp($data['offer_value'] ?? null, 0, 100, 0),
            'offer_min_items' => self::clamp($data['offer_min_items'] ?? null, 0, 20, 0),
            'sort' => self::clamp($data['sort'] ?? null, 0, 1000, 0),
            'term' => self::clamp($data['term'] ?? null, 0, 120, 0),
            'term_unit' => self::termUnit($data['term_unit'] ?? null),
            'ask_vars' => self::names($data['ask_vars'] ?? null),
            'upload_ask' => (bool) ($data['upload_ask'] ?? false),
            'upload_label' => mb_substr(trim((string) ($data['upload_label'] ?? '')), 0, 120),
            'upload_dir' => Delivery::directory($data['upload_dir'] ?? null),
            'upload_extract' => (bool) ($data['upload_extract'] ?? true),
            'art_path' => self::stored($data['art_path'] ?? null),
            'art_url' => self::secureUrl($data['art_url'] ?? null),
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
        // A null column and an empty list are the same thing to a checkbox
        // list, and only one of them is a thing it can be handed.
        $data['upgrade_to'] = is_array($package->upgrade_to) ? $package->upgrade_to : [];
        $data['term_unit'] = self::termUnit($package->term_unit);

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
            /*
             * And the contract, because it is part of what was agreed. A
             * package whose term is shortened next month must not shorten a
             * contract somebody already signed.
             */
            'term' => (int) $package->term,
            'term_unit' => self::termUnit($package->term_unit),
            /*
             * And what the customer was asked. Carried for the same reason as
             * the price: a package that starts asking for something else next
             * month must not change what an order already agreed to.
             */
            'ask_vars' => self::asked($package),
            'upload_dir' => Delivery::directory($package->upload_dir),
            'upload_extract' => (bool) $package->upload_extract,
        ];
    }

    /** A term unit that is one of the three, whatever the row says. */
    public static function termUnit(mixed $value): string
    {
        return in_array($value, Package::TERM_UNITS, true) ? (string) $value : Package::MONTH_TERM;
    }

    /**
     * How long somebody is tied in, as a sentence.
     *
     * Null when nothing ties them in, so a card with no contract says nothing
     * rather than saying "no minimum term" on every package that has none.
     */
    public static function termLabel(Package $package): ?string
    {
        if (!$package->hasTerm()) {
            return null;
        }

        return Theme::trans('packages.term_' . self::termUnit($package->term_unit), [
            'count' => (int) $package->term,
        ]);
    }

    /**
     * The picture behind a package's card.
     *
     * An upload wins over a typed URL, and with neither the egg's own artwork
     * is used - the same order the login background already resolves in, and
     * the reason the egg artwork feature is worth having twice over. Null when
     * there is nothing, which the card draws as no picture rather than as a
     * broken one.
     */
    /** A percentage off, rather than an amount. */
    public const OFFER_PERCENT = 'percent';

    /** An amount off, in minor units. */
    public const OFFER_AMOUNT = 'amount';

    /**
     * What comes off one of these, with this many things in the basket.
     *
     * Nothing when the package is not on offer, when the offer is worth
     * nothing, or when the basket is not full enough yet. Never more than the
     * price: an offer takes a package to free, not to owing somebody money.
     *
     * The count is the whole basket rather than this package's share of it.
     * That is what was asked for, and it is the version that means something to
     * a shopkeeper: it is a reason to put a second thing in, not a reason to
     * buy two of the same thing.
     */
    public static function offerOff(Package $package, int $items = 1): int
    {
        if (!(bool) $package->offer) {
            return 0;
        }

        $price = max(0, (int) $package->price);
        $value = max(0, (int) $package->offer_value);
        $need = max(0, (int) $package->offer_min_items);

        if ($price === 0 || $value === 0 || $items < $need) {
            return 0;
        }

        return (string) $package->offer_kind === self::OFFER_AMOUNT
            ? min($price, $value)
            : Money::percent($price, min(100, $value));
    }

    /** What one costs once the offer is off it. */
    public static function priceNow(Package $package, int $items = 1): int
    {
        return max(0, (int) $package->price - self::offerOff($package, $items));
    }

    /**
     * Whether an offer is on this package at all - which is not the same as
     * whether it applies yet. A card says "from two onwards" using the first
     * and prices itself using the second.
     */
    public static function onOffer(Package $package): bool
    {
        return (bool) $package->offer
            && max(0, (int) $package->offer_value) > 0
            && max(0, (int) $package->price) > 0;
    }

    /** How many things have to be in the basket before it applies. */
    public static function offerNeeds(Package $package): int
    {
        return self::onOffer($package) ? max(0, (int) $package->offer_min_items) : 0;
    }

    /**
     * What a package gives you, as the lines a card shows.
     *
     * One definition, because there were two and they disagreed. The panel's
     * store listed backups and databases where a package had them; the public
     * page listed memory, disk and processor and stopped. The same shop
     * answered the same question two ways depending on which door somebody came
     * in through, and neither answer was wrong on its own - which is why it
     * survived.
     *
     * @return array<int, string>
     */
    public static function specs(Package $package): array
    {
        /*
         * A zero is not nothing here, it is no limit - that is what Pelican
         * means by it everywhere, and it is what the panel writes when a field
         * is left empty. The shop said "0% CPU", which reads as a server that
         * has been given none, and it said it on the card, on the checkout and
         * on the public page at once.
         */
        $out = [
            (int) $package->memory > 0
                ? Theme::trans('shop.spec_memory', ['amount' => (int) $package->memory])
                : Theme::trans('shop.spec_memory_any'),
            (int) $package->disk > 0
                ? Theme::trans('shop.spec_disk', ['amount' => (int) $package->disk])
                : Theme::trans('shop.spec_disk_any'),
            (int) $package->cpu > 0
                ? Theme::trans('shop.spec_cpu', ['amount' => (int) $package->cpu])
                : Theme::trans('shop.spec_cpu_any'),
        ];

        // Only when there are any. "0 backups" is a line that says nothing and
        // takes up the room of one that would. Counted rather than replaced,
        // because one of them is a backup and not "1 backups".
        if ((int) $package->backup_limit > 0) {
            $out[] = Theme::choice('shop.spec_backups', (int) $package->backup_limit);
        }

        if ((int) $package->database_limit > 0) {
            $out[] = Theme::choice('shop.spec_databases', (int) $package->database_limit);
        }

        return $out;
    }

    public static function art(Package $package): ?string
    {
        $path = trim((string) $package->art_path);

        if ($path !== '') {
            try {
                return Storage::disk('public')->url($path);
            } catch (Throwable) {
                return null;
            }
        }

        $url = trim((string) $package->art_url);

        if (str_starts_with($url, 'https://')) {
            return $url;
        }

        try {
            $icon = $package->egg?->icon;

            return is_string($icon) && $icon !== '' ? $icon : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * An uploaded file, as the path it was stored at.
     *
     * The same shape the theme's own image fields use: Filament hands back a
     * temporary file the first time and the stored path every time after, and
     * both have to end up as one string.
     */
    /**
     * A list of env names and nothing else.
     *
     * The form hands back whatever was ticked, and a checkbox list is a form
     * field like any other - so what arrives is checked rather than trusted.
     *
     * @return array<int, string>
     */
    private static function names(mixed $value): array
    {
        if (!is_array($value)) {
            return [];
        }

        $out = [];

        foreach ($value as $name) {
            if (!is_string($name)) {
                continue;
            }

            $name = trim($name);

            if ($name !== '' && preg_match('/^[A-Za-z0-9_-]{1,255}$/', $name) === 1) {
                $out[] = $name;
            }
        }

        return array_values(array_unique($out));
    }

    private static function stored(mixed $value): string
    {
        if (is_array($value)) {
            $value = Arr::first($value);
        }

        if ($value instanceof TemporaryUploadedFile) {
            try {
                $value = $value->store('theme', 'public');
            } catch (Throwable) {
                return '';
            }
        }

        return is_string($value) ? ltrim($value, '/') : '';
    }

    /** https only: it is drawn on a page strangers can open. */
    private static function secureUrl(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        return str_starts_with($value, 'https://') ? mb_substr($value, 0, 2048) : '';
    }

    private static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max($min, min($max, (int) $value));
    }
}
