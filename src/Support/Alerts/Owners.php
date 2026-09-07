<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use App\Models\Server;
use App\Models\User;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Telling somebody their own server is on a machine that has stopped answering.
 *
 * The watchdog has known this since it shipped and has told only whoever
 * configured it. The person whose server it is hears nothing until they try to
 * play - which on a node that went down at three in the morning is the whole
 * night.
 *
 * **It rides the deduplication that is already there rather than building one.**
 * Alerts\State reports on a change, so this is called once when a node goes down
 * and once when it comes back. Never on a reminder: the watchdog repeats itself
 * to an administrator on purpose, because that is somebody who has to act, and
 * repeating it to four hundred customers every quarter hour is how a panel's
 * notifications get ignored entirely.
 *
 * **The bell, and nothing else.** Filament's database notifications, the ones
 * Pelican already draws in the topbar and already uses for its own plugin jobs.
 * No email: a watchdog that could email every customer on the panel is a
 * different feature with a different set of consequences, and it is not this
 * one.
 *
 * **Owners, not subusers.** Somebody sharing a server is not the person who
 * decides what to do about a dead machine, and a subuser on forty servers would
 * get forty of these.
 */
class Owners
{
    /**
     * How many people one run may write to.
     *
     * A node with four hundred servers on it is four hundred notifications from
     * a single check. The cap is not about the database - it is that a check
     * which can write unboundedly is one nobody dares switch on.
     */
    public const MAX = 200;

    /** How many of their servers to name before counting the rest. */
    private const NAMES = 4;

    public static function enabled(): bool
    {
        try {
            return Features::enabled(Features::OWNER_ALERTS)
                && (bool) Theme::config('alert_owners', false);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Tell the owners of the servers on one node.
     *
     * @param  bool  $down  Which way it went: unreachable, or answering again.
     * @return int How many people were written to.
     */
    public static function tell(int $nodeId, string $nodeName, bool $down): int
    {
        if (!self::enabled() || $nodeId <= 0) {
            return 0;
        }

        try {
            $servers = self::byOwner($nodeId);
        } catch (Throwable $exception) {
            report($exception);

            return 0;
        }

        $told = 0;

        foreach ($servers as $ownerId => $names) {
            if ($told >= self::MAX) {
                break;
            }

            if (self::one($ownerId, $names, $nodeName, $down)) {
                $told++;
            }
        }

        return $told;
    }

    /**
     * The servers on a node, grouped by who owns them.
     *
     * One query and a pass in PHP rather than a group-by, because the names are
     * wanted as well as the count - and a panel's largest node is a few hundred
     * rows, not a few hundred thousand.
     *
     * @return array<int, array<int, string>>
     */
    private static function byOwner(int $nodeId): array
    {
        $out = [];

        foreach (
            Server::query()
                ->where('node_id', $nodeId)
                ->select(['id', 'name', 'owner_id'])
                ->get() as $server
        ) {
            $owner = (int) $server->owner_id;

            if ($owner <= 0) {
                continue;
            }

            $out[$owner][] = (string) $server->name;
        }

        return $out;
    }

    /**
     * One person, one notification.
     *
     * @param  array<int, string>  $names
     */
    private static function one(int $ownerId, array $names, string $nodeName, bool $down): bool
    {
        try {
            $user = User::query()->find($ownerId);

            if ($user === null) {
                return false;
            }

            $notification = Notification::make()
                ->title($down
                    ? Theme::trans('alerts.owner_down', ['count' => count($names)])
                    : Theme::trans('alerts.owner_up', ['count' => count($names)]))
                ->body(Theme::trans(
                    $down ? 'alerts.owner_down_body' : 'alerts.owner_up_body',
                    ['servers' => self::list($names)],
                ));

            /*
             * The machine is not named to the person whose server is on it.
             *
             * Which node somebody's server sits on is the panel's business, and
             * the status page already refuses to publish it for the same
             * reason - a list of which customers are on which machine is a map
             * of where a panel's pressure is. What they need to know is that
             * theirs is affected and that somebody knows.
             */
            $notification
                ->{$down ? 'danger' : 'success'}()
                ->sendToDatabase($user);

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * A few names and then a number.
     *
     * @param  array<int, string>  $names
     */
    private static function list(array $names): string
    {
        $shown = array_slice($names, 0, self::NAMES);
        $rest = count($names) - count($shown);

        return implode(', ', $shown)
            . ($rest > 0 ? ' ' . Theme::trans('alerts.and_more', ['count' => $rest]) : '');
    }
}
