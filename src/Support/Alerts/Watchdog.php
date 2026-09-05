<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use LegendDevelopment\Theme\Support\Backups;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\NodeHealth;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Versions;
use LegendDevelopment\Theme\Support\Workers;
use Throwable;

/**
 * The checks, and nothing else.
 *
 * Every reading here already existed and was already drawn on a page: whether a
 * node answers, how full its disk is, what it is running, whether a queue worker
 * is alive. What was missing was anybody being told. This is that, and it adds
 * no new measurement - which is deliberate, because a watchdog that opens its
 * own connections is a watchdog that can take a node down while checking
 * whether the node is up.
 *
 * Each check answers OK, BAD or UNREADABLE, and State decides whether that is
 * worth a message. The two responsibilities are kept apart on purpose: this
 * file is a list of conditions somebody can read down and argue with, and the
 * awkward part - not saying the same thing seventy-two times - lives somewhere
 * it can be tested on its own.
 */
class Watchdog
{
    /**
     * One pass.
     *
     * Answers with what it sent, so the job can log a line that says something
     * rather than "ran". Nothing here throws: a check that cannot run is a
     * reading, not an error, and one node refusing to answer must not stop the
     * other nine being looked at.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    public static function run(): array
    {
        if (!Features::enabled(Features::ALERTS)) {
            return [];
        }

        $sent = [];

        foreach ([...self::nodes(), ...self::panel(), ...self::worker(), ...self::backups()] as $event) {
            $sent[] = $event;

            Notifier::send($event['title'], $event['body'], $event['good']);
        }

        return $sent;
    }

    /* ------------------------------------------------------------- nodes -- */

    /**
     * Every node the administrator asked to watch.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function nodes(): array
    {
        $events = [];

        try {
            $nodes = NodeHealth::nodes([], true);
        } catch (Throwable) {
            // No node list is not a failed check on any particular node, and
            // inventing one for each would be a message about this plugin
            // rather than about the panel.
            return [];
        }

        $repeat = self::repeat();

        foreach ($nodes as $node) {
            $id = (int) ($node['id'] ?? 0);
            $name = (string) ($node['name'] ?? '');

            if ($id === 0) {
                continue;
            }

            /*
             * A node in maintenance is not a node that is down.
             *
             * Somebody put it there on purpose, and alerting about the disk on
             * a machine that is deliberately out of service is how a channel
             * gets muted. Its own check covers being left there.
             */
            if ($node['maintenance']) {
                /*
                 * A silent marker, whose only job is to remember when
                 * maintenance began.
                 *
                 * The check is "left in maintenance for longer than N hours",
                 * and a duration cannot be read off a node - it only knows that
                 * it is. State already records when a state last changed, so a
                 * key that is never turned into a message gives exactly that
                 * for nothing. Without it the alert fired the moment somebody
                 * ticked the box, which is the opposite of what it is for.
                 */
                State::record('node.' . $id . '.inmaint', State::BAD);

                $hours = (int) Theme::config('alert_maintenance_hours', 0);
                $standing = State::standing('node.' . $id . '.inmaint');
                $tooLong = $hours > 0 && $standing !== null && $standing >= $hours * 3600;

                $events = array_merge($events, self::one(
                    'node.' . $id . '.maintenance',
                    $tooLong ? State::BAD : State::OK,
                    $repeat,
                    Theme::trans('alerts.node_maintenance', ['node' => $name, 'hours' => $hours]),
                    Theme::trans('alerts.node_maintenance_body', ['node' => $name, 'hours' => $hours]),
                    Theme::trans('alerts.node_maintenance_over', ['node' => $name]),
                ));

                continue;
            }

            // Out of maintenance: the marker is cleared so the next spell is
            // timed from when it starts rather than from the last one.
            State::record('node.' . $id . '.inmaint', State::OK);

            // Reachability first, and the rest only when it is reachable: a
            // node that is not answering has no disk figure, and reporting 0%
            // used would be worse than reporting nothing.
            $events = array_merge($events, self::one(
                'node.' . $id . '.reachable',
                $node['reachable'] ? State::OK : State::BAD,
                $repeat,
                Theme::trans('alerts.node_down', ['node' => $name]),
                Theme::trans('alerts.node_down_body', ['node' => $name]),
                Theme::trans('alerts.node_up', ['node' => $name]),
            ));

            if (!$node['reachable']) {
                continue;
            }

            /*
             * Every key written out in full rather than built from $what.
             *
             * tools/check-lang.js can only verify a literal, so
             * 'alerts.node_' . $what would hide six keys from the check that
             * exists because two of them once shipped broken and rendered on
             * screen as their own names. The arithmetic is shared; the words
             * are not.
             */
            $events = array_merge($events, self::meter(
                'node.' . $id . '.disk',
                (int) ($node['disk_used'] ?? 0),
                (int) ($node['disk_total'] ?? 0),
                (int) Theme::config('alert_disk', 90),
                $repeat,
                ['node' => $name],
                'alerts.node_disk',
                'alerts.node_disk_body',
                'alerts.node_disk_over',
            ));

            $events = array_merge($events, self::meter(
                'node.' . $id . '.memory',
                (int) ($node['memory_used'] ?? 0),
                (int) ($node['memory_total'] ?? 0),
                (int) Theme::config('alert_memory', 90),
                $repeat,
                ['node' => $name],
                'alerts.node_memory',
                'alerts.node_memory_body',
                'alerts.node_memory_over',
            ));

            if ($node['version'] !== '' && (bool) Theme::config('alert_versions', true)) {
                $wings = Versions::wings((string) $node['version']);

                $events = array_merge($events, self::one(
                    'node.' . $id . '.wings',
                    self::versionCheck($wings),
                    0,
                    Theme::trans('alerts.wings_behind', ['node' => $name]),
                    Theme::trans('alerts.wings_behind_body', [
                        'node' => $name,
                        'installed' => $wings['installed'],
                        'latest' => (string) ($wings['latest'] ?? '?'),
                    ]),
                    Theme::trans('alerts.wings_current', ['node' => $name]),
                ));
            }
        }

        return $events;
    }

    /**
     * One reading against one threshold.
     *
     * The three keys are passed in rather than built, so every one of them is
     * still a literal at the call site where check-lang.js can see it.
     *
     * @param  array<string, string>  $words
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function meter(
        string $key,
        int $used,
        int $total,
        int $limit,
        int $repeat,
        array $words,
        string $title,
        string $body,
        string $cleared,
    ): array {
        // A total of nought is a node that answered without saying how big it
        // is. Dividing by it would report a hundred per cent full.
        if ($limit <= 0 || $total <= 0) {
            return [];
        }

        $percent = round($used / $total * 100, 1);

        return self::one(
            $key,
            $percent >= $limit ? State::BAD : State::OK,
            $repeat,
            Theme::trans($title, $words + ['percent' => $percent]),
            Theme::trans($body, $words + ['percent' => $percent, 'limit' => $limit]),
            Theme::trans($cleared, $words + ['percent' => $percent]),
        );
    }

    /* ------------------------------------------------------------- panel -- */

    /**
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function panel(): array
    {
        if (!(bool) Theme::config('alert_versions', true)) {
            return [];
        }

        $panel = Versions::panel();

        return self::one(
            'panel.version',
            self::versionCheck($panel),
            0,
            Theme::trans('alerts.panel_behind'),
            Theme::trans('alerts.panel_behind_body', [
                'installed' => $panel['installed'],
                'latest' => (string) ($panel['latest'] ?? '?'),
            ]),
            Theme::trans('alerts.panel_current'),
        );
    }

    /**
     * A version reading, as a check.
     *
     * "Could not check" is unreadable rather than bad, and that distinction is
     * the reason this is its own method: a panel behind a firewall that cannot
     * reach GitHub would otherwise be told every day that it is out of date, on
     * no evidence at all.
     *
     * @param  array{installed: string, latest: ?string, current: ?bool}  $version
     */
    private static function versionCheck(array $version): string
    {
        if ($version['current'] === null) {
            return State::UNREADABLE;
        }

        return $version['current'] ? State::OK : State::BAD;
    }

    /* ------------------------------------------------------------ worker -- */

    /**
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function worker(): array
    {
        if (!(bool) Theme::config('alert_worker', true)) {
            return [];
        }

        try {
            $state = Workers::state()['state'] ?? 'unknown';
        } catch (Throwable) {
            return [];
        }

        /*
         * Only 'missing' counts.
         *
         * 'waiting' is a probe that has been out for under two minutes, which
         * is a busy worker rather than an absent one, and 'unknown' means no
         * probe has been sent yet. Alerting on either would fire on every fresh
         * install.
         */
        $result = match ($state) {
            'missing' => State::BAD,
            'working' => State::OK,
            default => State::UNREADABLE,
        };

        return self::one(
            'panel.worker',
            $result,
            self::repeat(),
            Theme::trans('alerts.worker_missing'),
            Theme::trans('alerts.worker_missing_body'),
            Theme::trans('alerts.worker_back'),
        );
    }

    /* ----------------------------------------------------------- backups -- */

    /**
     * Servers with no backup, a stale one, or a failure.
     *
     * One message for all of them rather than one per server, and that is the
     * whole design of this check. A panel where the backup schedule has stopped
     * has *every* server stale at once - forty separate messages saying the same
     * thing, arriving together, about one cause. So the names go in the body and
     * the count goes in the title, and the state key is the condition rather
     * than the server: it clears when the last one is fixed, which is also the
     * only moment worth being told about.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function backups(): array
    {
        if (!(bool) Theme::config('alert_backups', false)) {
            return [];
        }

        $behind = Backups::behind();
        $events = [];
        $repeat = self::repeat();

        // Never backed up and gone stale are separate messages, because they are
        // separate problems: one is a schedule nobody set up, the other is one
        // that has stopped.
        $events = array_merge($events, self::one(
            'backups.none',
            $behind['none'] === [] ? State::OK : State::BAD,
            $repeat,
            Theme::trans('alerts.backup_none', ['count' => count($behind['none'])]),
            Theme::trans('alerts.backup_none_body', ['servers' => self::list($behind['none'])]),
            Theme::trans('alerts.backup_none_over'),
        ));

        $events = array_merge($events, self::one(
            'backups.stale',
            $behind['stale'] === [] ? State::OK : State::BAD,
            $repeat,
            Theme::trans('alerts.backup_stale', ['count' => count($behind['stale'])]),
            Theme::trans('alerts.backup_stale_body', [
                'days' => Backups::days(),
                'servers' => self::list($behind['stale']),
            ]),
            Theme::trans('alerts.backup_stale_over'),
        ));

        return array_merge($events, self::one(
            'backups.failed',
            $behind['failed'] === [] ? State::OK : State::BAD,
            $repeat,
            Theme::trans('alerts.backup_failed', ['count' => count($behind['failed'])]),
            Theme::trans('alerts.backup_failed_body', ['servers' => self::list($behind['failed'])]),
            Theme::trans('alerts.backup_failed_over'),
        ));
    }

    /**
     * A list of names, short enough to read on a phone.
     *
     * Twelve and then a count. A message naming four hundred servers is one
     * nobody reads to the end of, and the page is where the full list belongs.
     *
     * @param  array<int, string>  $names
     */
    private static function list(array $names): string
    {
        $shown = array_slice($names, 0, 12);
        $rest = count($names) - count($shown);

        return implode(', ', $shown)
            . ($rest > 0 ? ' ' . Theme::trans('alerts.and_more', ['count' => $rest]) : '');
    }

    /* ------------------------------------------------------------ plumbing - */

    /**
     * One check, turned into nought or one message.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function one(
        string $key,
        string $result,
        int $repeat,
        string $title,
        string $body,
        string $cleared,
    ): array {
        $kind = State::record($key, $result, $repeat);

        if ($kind === null) {
            return [];
        }

        if ($kind === 'cleared') {
            return [[
                'key' => $key,
                'kind' => $kind,
                'title' => $cleared,
                'body' => Theme::trans('alerts.cleared_body', [
                    'for' => self::spell(State::standing($key)),
                ]),
                'good' => true,
            ]];
        }

        // A reminder says how long it has been going on, because that is the
        // only thing about it that has changed since the last one.
        $suffix = $kind === 'reminder'
            ? ' ' . Theme::trans('alerts.still', ['for' => self::spell(State::standing($key))])
            : '';

        return [[
            'key' => $key,
            'kind' => $kind,
            'title' => $title,
            'body' => $body . $suffix,
            'good' => false,
        ]];
    }

    /** Seconds between repeats of a standing problem; nought for never. */
    private static function repeat(): int
    {
        return max(0, (int) Theme::config('alert_repeat', 0)) * 3600;
    }

    /** A duration, in words, for a message somebody reads on a phone. */
    private static function spell(?int $seconds): string
    {
        if ($seconds === null) {
            return Theme::trans('alerts.for_unknown');
        }

        if ($seconds < 3600) {
            return Theme::trans('alerts.for_minutes', ['count' => max(1, (int) round($seconds / 60))]);
        }

        if ($seconds < 86400) {
            return Theme::trans('alerts.for_hours', ['count' => (int) round($seconds / 3600)]);
        }

        return Theme::trans('alerts.for_days', ['count' => (int) round($seconds / 86400)]);
    }
}
