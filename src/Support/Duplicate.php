<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Allocation;
use App\Models\Server;
use App\Services\Servers\ServerCreationService;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Making another server exactly like one that already exists.
 *
 * The idea is borrowed and the code is not. afikpr123's Duplicate Server Button
 * does the same job and does it from a page of its own, one copy at a time,
 * with an allocation you pick by hand. Reading it settled the one thing worth
 * settling - that Pelican's own ServerCreationService is the way in, rather
 * than writing rows and hoping the daemon agrees - and the rest is built here
 * against the panel's own classes, the same way the system status page was
 * built from /proc rather than ported.
 *
 * Two things are done differently, and both come from what the job actually is.
 *
 * **More than one at a time.** Nobody duplicates a server once. They want three
 * bots or ten test servers, and doing that one at a time through a form is the
 * work the button was supposed to remove. A count and a numbered name is the
 * whole feature.
 *
 * **The allocations are found rather than asked for.** A copy has to sit on the
 * source's node - Pelican assigns the node from the allocation, and an
 * allocation on another node would put the copy somewhere the source is not -
 * so there is exactly one sensible set to pick from: the free ones on that
 * node. Asking somebody to choose them by hand is asking them to do a lookup
 * the panel can do, and to get it wrong when they are making eight.
 *
 * What is not copied is the disk. Files, databases, backups and schedules all
 * stay where they are. That is not a shortcut: a copy of a running server's
 * files is a copy of its state, which is rarely what "another one like this"
 * means, and it is not something to do behind a button without saying so.
 */
class Duplicate
{
    /** Enough to be useful, few enough that a mistake is not a disaster. */
    public const MAX_COPIES = 10;

    /**
     * The fields a copy inherits.
     *
     * Read from Server rather than from a list written here, so a column Pelican
     * adds later is carried without this file knowing about it - the list below
     * is what ServerCreationService::createModel() actually reads, and it is
     * spelled out because "everything except a few" is the version of this that
     * copies an id or a uuid one day.
     *
     * @var array<int, string>
     */
    private const COPIED = [
        'owner_id', 'egg_id', 'image', 'startup', 'description',
        'memory', 'swap', 'disk', 'io', 'cpu', 'threads', 'oom_killer',
        'database_limit', 'allocation_limit', 'backup_limit',
        'skip_scripts', 'docker_labels',
    ];

    /**
     * The allocations a copy could be given: free, and on the source's node.
     *
     * @return array<int, string>
     */
    public static function freeAllocations(Server $server): array
    {
        try {
            return Allocation::query()
                ->where('node_id', $server->node_id)
                ->whereNull('server_id')
                ->orderBy('ip')
                ->orderBy('port')
                ->get()
                ->mapWithKeys(fn (Allocation $allocation): array => [
                    $allocation->id => $allocation->ip . ':' . $allocation->port,
                ])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * How many copies could be made right now, which is how many free
     * allocations the node has. Shown before the count is chosen, so nobody
     * asks for eight and is told about it afterwards.
     */
    public static function room(Server $server): int
    {
        return min(self::MAX_COPIES, count(self::freeAllocations($server)));
    }

    /**
     * The source's environment, in the shape ServerCreationService wants.
     *
     * @return array<string, mixed>
     */
    public static function environment(Server $server): array
    {
        $environment = [];

        try {
            foreach ($server->variables as $variable) {
                $environment[$variable->env_variable] = $variable->server_value;
            }
        } catch (Throwable) {
            // A copy with the egg's defaults is worth more than no copy. The
            // creation service fills anything missing from the egg itself.
        }

        return $environment;
    }

    /**
     * Make the copies.
     *
     * Each one is created on its own so that a failure part way through leaves
     * the ones already made rather than rolling them back - three of five
     * servers is a state somebody can finish by hand, and five deleted servers
     * after five minutes of waiting is not.
     *
     * @param  array<int, int>  $allocationIds
     * @return array{made: array<int, string>, failed: array<int, string>}
     */
    public static function make(Server $server, string $name, array $allocationIds): array
    {
        $base = array_intersect_key(
            $server->toArray(),
            array_flip(self::COPIED),
        );

        $base['environment'] = self::environment($server);
        $base['start_on_completion'] = false;

        $service = app(ServerCreationService::class);
        $made = [];
        $failed = [];

        $allocationIds = array_values($allocationIds);
        $total = count($allocationIds);

        foreach ($allocationIds as $index => $allocationId) {
            // Numbered only when there is more than one, so a single copy is
            // called what was typed rather than "the name 1".
            $copyName = $total > 1
                ? $name . ' ' . ($index + 1)
                : $name;

            try {
                $service->handle(array_merge($base, [
                    'name' => mb_substr($copyName, 0, 191),
                    'allocation_id' => $allocationId,
                    'node_id' => $server->node_id,
                ]));

                $made[] = $copyName;
            } catch (Throwable $exception) {
                report($exception);

                $failed[] = $copyName . ' - ' . Arr::first(explode("\n", $exception->getMessage()));
            }
        }

        return ['made' => $made, 'failed' => $failed];
    }
}
