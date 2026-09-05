<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

/**
 * Saved page layouts: the order of the blocks on a page, and which are hidden.
 *
 * Filament stamps every schema component with a stable key - either
 * wire:partial="schema-component::form.APP_NAME" or a wire:key ending in that
 * same path - and those components are grid items. So a layout is nothing more
 * than an `order` per key, which means the saved arrangement is applied by plain
 * CSS: no JavaScript, and no flash of the original order on load. The editor
 * that produces those numbers is the only part that needs scripting.
 *
 * Two things this cannot do, both because it is CSS and not markup:
 * a block can only move within the container it already lives in, and `order`
 * changes the visual order while the keyboard and screen readers keep following
 * the original one.
 */
class Layouts
{
    /** The arrangement everyone starts from, set by someone who may share one. */
    private const PATH = 'legend-theme/layouts.json';

    /**
     * And one file per person for their own.
     *
     * A file each rather than one file holding everybody: a request reads the
     * shared arrangement and its own reader's, never anyone else's, so the read
     * stays the same size on a panel with four users and on one with four
     * hundred - and no cap has to be invented to stop a single file growing
     * without limit.
     */
    private const USER_PATH = 'legend-theme/layouts/%d.json';

    /**
     * And one file per role.
     *
     * A file each, like the people, and for the same reason - a request reads
     * at most the shared file, the roles its reader holds and their own, never
     * anybody else's.
     */
    private const ROLE_PATH = 'legend-theme/layouts/role-%d.json';

    /**
     * Which roles have arranged anything at all.
     *
     * A list of ids in one small file, and it exists to make the unused case
     * free. Without it every signed-in reader would pay a roles query and one
     * file check per role on every page, whether or not anybody had ever set a
     * role arrangement - and on most panels nobody will have. With it that case
     * is one missing file, and the query happens only once somebody has
     * actually arranged something for a role.
     */
    private const ROLE_INDEX = 'legend-theme/layouts/roles.json';

    /** @var array<int, int>|null */
    private static ?array $arranged = null;

    /** @var array<int, string>|null */
    private static ?array $roles = null;

    public const MAX_ITEMS = 200;

    /** Everyone's, as opposed to one person's. */
    public const SHARED = 'shared';

    public const OWN = 'me';

    /**
     * A role's, written as `role:7`.
     *
     * The id is in the scope rather than in a field beside it because the
     * picker in the arranger is one list - "Just for me", "For everyone", and
     * then a row per role - and a scope that is one string keeps the endpoint's
     * validation one rule.
     */
    public const ROLE = 'role';

    /** @var array<int, array<int, int>> */
    private static array $roleIds = [];

    /** @var array<string, array<string, array<string, array{o?: int, h?: bool}>>> */
    private static array $cached = [];

    /**
     * The page a path belongs to, with record ids folded away so one layout
     * covers every server and every record of the same page.
     */
    public static function pageKey(string $path): string
    {
        $segments = array_map(static function (string $segment): string {
            if (preg_match('/^\d+$/', $segment)) {
                return '{id}';
            }

            if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-/i', $segment)) {
                return '{id}';
            }

            // Short ids like a server's uuid_short: letters and digits mixed,
            // long enough not to be a word like "settings" or "backups".
            if (preg_match('/^(?=.*\d)[A-Za-z0-9]{6,}$/', $segment)) {
                return '{id}';
            }

            return $segment;
        }, explode('/', trim($path, '/')));

        return '/' . implode('/', $segments);
    }

    /**
     * What this person sees on this page: the shared arrangement, then their
     * roles', then their own, each laid over the last.
     *
     * Per key rather than all-or-nothing, so somebody who has moved one block
     * still gets the shared arrangement of the rest - and still gets a block
     * that was added to the shared one after they last arranged anything.
     *
     * Worth saying plainly, because it is what people mean when they ask to
     * "hide things from users": an arrangement is what a page looks like, not a
     * permission. A block a role hides is still a block somebody could reach by
     * typing the address, and Pelican's own permissions are what stop that.
     *
     * @return array<string, array{o?: int, h?: bool}>
     */
    public static function for(string $path, ?int $userId = null): array
    {
        $page = self::pageKey($path);
        $userId ??= self::currentUser();

        $layout = self::read(self::PATH)[$page] ?? [];

        /*
         * Then their roles, then their own. Three layers, and the order is the
         * whole rule: the arrangement everyone starts from, what their role
         * changes about it, and what they have moved themselves - each laid
         * over the last, per key.
         *
         * Per key rather than all-or-nothing throughout, so somebody who has
         * moved one block still gets their role's arrangement of the rest.
         *
         * The intersection is what keeps this free on a panel that does not use
         * it: with nothing in the index there is no roles query and no file to
         * look for.
         */
        foreach (array_intersect(self::arrangedRoles(), self::roleIds($userId)) as $roleId) {
            $layout = array_merge($layout, self::read(self::rolePath($roleId))[$page] ?? []);
        }

        return array_merge($layout, $userId === null ? [] : (self::read(self::userPath($userId))[$page] ?? []));
    }

    /**
     * The roles this person holds, lowest id first.
     *
     * Ascending, so a role created later wins where two of them arrange the
     * same block. That is a rule rather than a preference - Pelican's roles
     * have no order of their own, so there is no "more specific" one to prefer -
     * and the way to avoid meeting it is not to arrange the same page for two
     * roles the same person holds.
     *
     * @return array<int, int>
     */
    private static function roleIds(?int $userId): array
    {
        if ($userId === null) {
            return [];
        }

        if (array_key_exists($userId, self::$roleIds)) {
            return self::$roleIds[$userId];
        }

        self::$roleIds[$userId] = [];

        try {
            $user = user();

            // Only the person asking. Loading somebody else's roles to draw
            // their stylesheet is not something any caller here does, and a
            // second query per request to allow for it would be paid by
            // everybody.
            if ($user === null || (int) $user->id !== $userId) {
                return self::$roleIds[$userId];
            }

            $ids = $user->roles->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all();

            sort($ids);

            return self::$roleIds[$userId] = array_values(array_filter(
                $ids,
                static fn (int $id): bool => $id > 0,
            ));
        } catch (Throwable) {
            return self::$roleIds[$userId] = [];
        }
    }

    /**
     * The roles that have an arrangement, lowest id first.
     *
     * @return array<int, int>
     */
    private static function arrangedRoles(): array
    {
        if (self::$arranged !== null) {
            return self::$arranged;
        }

        self::$arranged = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::ROLE_INDEX)) {
                return self::$arranged;
            }

            $decoded = json_decode((string) $disk->get(self::ROLE_INDEX), true);

            if (!is_array($decoded)) {
                return self::$arranged;
            }

            $ids = array_values(array_unique(array_filter(
                array_map('intval', $decoded),
                static fn (int $id): bool => $id > 0,
            )));

            sort($ids);

            return self::$arranged = $ids;
        } catch (Throwable) {
            // No index is a panel with no role arrangements, which is the state
            // every panel starts in - not an error.
            return self::$arranged = [];
        }
    }

    /**
     * Record that a role has an arrangement, or that it no longer does.
     *
     * Rebuilt from the list rather than appended to, so a role whose last
     * arrangement was just removed leaves the index rather than staying in it
     * as a file read that always answers with nothing.
     */
    private static function noteRole(int $roleId, bool $has): void
    {
        $ids = self::arrangedRoles();
        $known = in_array($roleId, $ids, true);

        if ($known === $has) {
            return;
        }

        $ids = $has
            ? array_merge($ids, [$roleId])
            : array_values(array_diff($ids, [$roleId]));

        sort($ids);

        try {
            Storage::disk('local')->put(self::ROLE_INDEX, (string) json_encode($ids));
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        self::$arranged = $ids;
    }

    /**
     * The role id in a scope string, or null if it is not one.
     *
     * Null for 'shared' and 'me' as well as for nonsense, so one call sorts
     * every scope there is.
     */
    public static function roleOf(string $scope): ?int
    {
        if (!str_starts_with($scope, self::ROLE . ':')) {
            return null;
        }

        $id = substr($scope, strlen(self::ROLE) + 1);

        return preg_match('/^[1-9][0-9]{0,9}$/D', $id) === 1 ? (int) $id : null;
    }

    /**
     * Every role on the panel, for the arranger's picker.
     *
     * Read once: the picker asks, roleLayouts() asks right after it, and the
     * endpoint asks again to check the id it was sent.
     *
     * @return array<int, string>
     */
    public static function roleOptions(): array
    {
        if (self::$roles !== null) {
            return self::$roles;
        }

        try {
            return self::$roles = Role::query()
                ->select(['id', 'name'])
                ->orderBy('name')
                ->get()
                ->mapWithKeys(static fn (Role $role): array => [(int) $role->id => (string) $role->name])
                ->all();
        } catch (Throwable) {
            return self::$roles = [];
        }
    }

    /**
     * One scope on its own, for the editor to show what it is about to change
     * rather than the two of them added together.
     *
     * @return array<string, array{o?: int, h?: bool}>
     */
    public static function scoped(string $path, string $scope, ?int $userId = null): array
    {
        $page = self::pageKey($path);

        if ($scope === self::SHARED) {
            return self::read(self::PATH)[$page] ?? [];
        }

        $roleId = self::roleOf($scope);

        if ($roleId !== null) {
            return self::read(self::rolePath($roleId))[$page] ?? [];
        }

        $userId ??= self::currentUser();

        return $userId === null ? [] : (self::read(self::userPath($userId))[$page] ?? []);
    }

    public static function css(string $path): string
    {
        $css = '';

        foreach (self::for($path) as $key => $item) {
            $selector = self::selector($key);

            if ($selector === null) {
                continue;
            }

            if ($item['h'] ?? false) {
                $css .= $selector . '{display:none !important;}';

                continue;
            }

            if (isset($item['o'])) {
                $css .= $selector . '{order:' . (int) $item['o'] . ';}';
            }
        }

        return $css;
    }

    /**
     * What every role has arranged on this page, keyed by role id.
     *
     * Only the roles that have arranged something - a panel with twelve roles
     * and one arrangement sends one entry, not twelve empty ones.
     *
     * @return array<int, array<string, array{o?: int, h?: bool}>>
     */
    public static function roleLayouts(string $path): array
    {
        $page = self::pageKey($path);
        $out = [];

        foreach (array_keys(self::roleOptions()) as $roleId) {
            $layout = self::read(self::rolePath($roleId))[$page] ?? [];

            if ($layout !== []) {
                $out[$roleId] = $layout;
            }
        }

        return $out;
    }

    /**
     * @param  array<mixed, mixed>  $items
     * @param  string  $scope  SHARED for everyone, OWN for the person saving,
     *                         or ROLE . ':' . id for one role's.
     */
    public static function save(string $page, array $items, string $scope = self::SHARED): void
    {
        $roleId = self::roleOf($scope);

        if ($scope === self::SHARED) {
            $file = self::PATH;
        } elseif ($roleId !== null) {
            $file = self::rolePath($roleId);
        } else {
            $userId = self::currentUser();

            if ($userId === null) {
                return;
            }

            $file = self::userPath($userId);
        }

        $layouts = self::read($file);
        $clean = [];

        foreach (array_slice($items, 0, self::MAX_ITEMS, true) as $key => $item) {
            $key = self::sanitiseKey((string) $key);

            if ($key === null || !is_array($item)) {
                continue;
            }

            $entry = [];

            if (isset($item['o']) && is_numeric($item['o'])) {
                $entry['o'] = max(1, min(999, (int) $item['o']));
            }

            if (($item['h'] ?? false) === true) {
                $entry['h'] = true;
            }

            if ($entry !== []) {
                $clean[$key] = $entry;
            }
        }

        $page = self::pageKey($page);

        if ($clean === []) {
            unset($layouts[$page]);
        } else {
            $layouts[$page] = $clean;
        }

        try {
            if (Storage::disk('local')->put($file, (string) json_encode($layouts, JSON_PRETTY_PRINT)) === false) {
                // put() answers false for an unwritable directory and throws
                // only for the rarer failures, so a catch on its own let every
                // ordinary one past.
                report(new RuntimeException(
                    'Could not write ' . $file . ' to the local disk. Check that '
                    . storage_path('app') . ' belongs to the user the panel runs as.',
                ));

                return;
            }
        } catch (Throwable $exception) {
            report($exception);

            return;
        }

        // Only once it is written. The arrangement not sticking is survivable;
        // the panel claiming for the rest of the request that it did is not.
        self::$cached[$file] = $layouts;

        /*
         * And the index, which is the half that is easy to miss: a role layer
         * written but not recorded is a layer for() never looks for, so the
         * arrangement saves, says it saved, and changes nothing.
         */
        if ($roleId !== null) {
            self::noteRole($roleId, $layouts !== []);
        }
    }

    /**
     * A key carries where it came from, because the two sources need different
     * selectors: wire:partial holds the path outright, while wire:key is
     * prefixed with a Livewire id that changes on every request - so that one is
     * matched on its ending instead.
     */
    private static function selector(string $key): ?string
    {
        [$source, $path] = array_pad(explode('|', $key, 2), 2, null);

        if (!is_string($path) || $path === '') {
            return null;
        }

        return match ($source) {
            'partial' => '[wire\\:partial="schema-component::' . $path . '"]',
            'key' => '[wire\\:key$=".' . $path . '"]',
            default => null,
        };
    }

    private static function sanitiseKey(string $key): ?string
    {
        $key = trim($key);

        if (strlen($key) > 140 || !preg_match('/^(partial|key)\|[A-Za-z0-9_.\-]+$/', $key)) {
            return null;
        }

        return $key;
    }

    private static function userPath(int $userId): string
    {
        return sprintf(self::USER_PATH, $userId);
    }

    private static function rolePath(int $roleId): string
    {
        return sprintf(self::ROLE_PATH, $roleId);
    }

    /**
     * Who is asking, or nobody.
     *
     * Nobody is a real answer here: the stylesheet is built on the sign-in
     * screen too, and there is no one there to have arranged anything.
     */
    private static function currentUser(): ?int
    {
        try {
            $id = user()?->id;

            return is_numeric($id) ? (int) $id : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * One file, read once per request.
     *
     * @return array<string, array<string, array{o?: int, h?: bool}>>
     */
    private static function read(string $file): array
    {
        if (array_key_exists($file, self::$cached)) {
            return self::$cached[$file];
        }

        self::$cached[$file] = [];

        try {
            $disk = Storage::disk('local');

            if ($disk->exists($file)) {
                $decoded = json_decode((string) $disk->get($file), true);

                if (is_array($decoded)) {
                    self::$cached[$file] = $decoded;
                }
            }
        } catch (Throwable) {
            self::$cached[$file] = [];
        }

        return self::$cached[$file];
    }
}
