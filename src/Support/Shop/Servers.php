<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\Server;
use App\Repositories\Daemon\DaemonServerRepository;
use App\Services\Servers\BuildModificationService;
use Throwable;

/**
 * The one place this plugin changes what a server is allowed to use.
 *
 * **Pelican's own service cannot be trusted to say whether it worked**, and
 * that is not a criticism of it. `BuildModificationService::handle()` writes
 * the new limits in a transaction and then tries to tell the node; if that call
 * throws, it writes a line to the log and returns the server as though nothing
 * had gone wrong. For the panel that is the right trade - the daemon fetches a
 * fresh configuration whenever a server boots, so the limits arrive late rather
 * than never, and an administrator standing at the form does not want a red box
 * about it.
 *
 * For us it is not, because nobody is standing at a form. An upgrade is charged
 * for, and "upgraded" is a word a customer reads as "my server has more memory
 * now". So this asks the node itself, afterwards, and says what it found.
 *
 * **Three outcomes, not two, and that is deliberate.** The plan for this said a
 * bool; writing it made clear a bool has to lie about one of the three cases.
 *
 *   ok false           Nothing changed. The caller leaves the order where it
 *                      was and puts the reason on it.
 *
 *   ok true, cold      The limits are recorded and the node has not taken them
 *                      yet. The upgrade did happen: the order is right, the
 *                      invoice is right, and the new limits apply from the next
 *                      time that server starts. Refusing here would undo an
 *                      upgrade somebody paid for because a node was briefly
 *                      unreachable, which is the worse of the two wrongs.
 *
 *   ok true, synced    Done, and the node knows.
 *
 * The middle one is why this returns a shape rather than a bool: it is the only
 * honest way to say "yes, and there is something to tell the owner".
 */
class Servers
{
    /**
     * What a build change may set. Anything else in the array is dropped
     * before it reaches Pelican, because this is a plugin writing into somebody
     * else's model and a key that is not on this list is a key we did not mean
     * to send.
     */
    private const LIMITS = [
        'memory',
        'swap',
        'disk',
        'io',
        'cpu',
        'threads',
        'oom_killer',
        'database_limit',
        'allocation_limit',
        'backup_limit',
    ];

    /**
     * Give a server different limits.
     *
     * @param  array<string, mixed>  $limits
     * @return array{ok: bool, synced: bool, reason: string}
     */
    public static function resize(Server $server, array $limits): array
    {
        $wanted = array_intersect_key($limits, array_flip(self::LIMITS));

        if ($wanted === []) {
            return self::no('nothing to change');
        }

        /*
         * Named by string and resolved through the container, like every other
         * reach into Pelican in this plugin. A class that moved would otherwise
         * be a fatal at load time rather than a sentence here.
         */
        if (!class_exists(BuildModificationService::class)) {
            return self::no('this panel has no build service');
        }

        try {
            app(BuildModificationService::class)->handle($server, $wanted);
        } catch (Throwable $exception) {
            report($exception);

            return self::no($exception->getMessage());
        }

        return ['ok' => true, 'synced' => self::sync($server), 'reason' => ''];
    }

    /**
     * Ask the node to take the configuration it has just been given.
     *
     * Pelican already tried this inside handle() and swallowed the answer. This
     * is the same call made again, which costs one request and is the only way
     * to find out. Pushing a configuration twice is not a thing a node minds:
     * it is the same configuration.
     */
    public static function sync(Server $server): bool
    {
        if (!class_exists(DaemonServerRepository::class)) {
            return false;
        }

        try {
            app(DaemonServerRepository::class)->setServer($server->refresh())->sync();

            return true;
        } catch (Throwable $exception) {
            /*
             * Reported rather than thrown. The caller is told by the flag, and
             * a node that is down is a thing an owner should see in the log
             * with its own message rather than as a failed upgrade.
             */
            report($exception);

            return false;
        }
    }

    /**
     * The limits a package's snapshot asks for, as the keys Pelican uses.
     *
     * Read from the order's own `spec` rather than from the package, because
     * the spec is what was agreed. Everything is cast here so a snapshot
     * written by an older release, with a string where a number belongs, does
     * not reach somebody else's model as a string.
     *
     * @param  array<string, mixed>  $spec
     * @return array<string, mixed>
     */
    public static function limits(array $spec): array
    {
        return [
            'memory' => (int) ($spec['memory'] ?? 0),
            'swap' => (int) ($spec['swap'] ?? 0),
            'disk' => (int) ($spec['disk'] ?? 0),
            'io' => (int) ($spec['io'] ?? 500),
            'cpu' => (int) ($spec['cpu'] ?? 0),
            // Null and not nought: nought threads is a server pinned to no core
            // at all, and Pelican reads null as "no pinning", which is what a
            // package that says nothing about threads means.
            'threads' => self::text($spec['threads'] ?? null),
            'oom_killer' => (bool) ($spec['oom_killer'] ?? false),
            'database_limit' => (int) ($spec['database_limit'] ?? 0),
            'allocation_limit' => (int) ($spec['allocation_limit'] ?? 0),
            'backup_limit' => (int) ($spec['backup_limit'] ?? 0),
        ];
    }

    /** A pinning string, or null where there is none. */
    private static function text(mixed $value): ?string
    {
        $text = trim((string) (is_scalar($value) ? $value : ''));

        return $text === '' ? null : $text;
    }

    /** @return array{ok: bool, synced: bool, reason: string} */
    private static function no(string $reason): array
    {
        return ['ok' => false, 'synced' => false, 'reason' => mb_substr(trim($reason), 0, 500)];
    }
}
