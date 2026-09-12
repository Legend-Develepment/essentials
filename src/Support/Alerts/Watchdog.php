<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LegendDevelopment\Theme\Support\Backups;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\NodeHealth;
use LegendDevelopment\Theme\Support\Schedules;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
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

        /*
         * From the file, not from whatever this process remembers.
         *
         * A queue worker handles many jobs and State holds its rows in a static,
         * so without this a pass reads the panel as it was when the worker
         * started - which on a quiet panel is days ago, and which is why Reset
         * in the browser appeared to do nothing.
         */
        State::refresh();

        $sent = [];

        foreach ([
            ...self::nodes(),
            ...self::panel(),
            ...self::worker(),
            ...self::failures(),
            ...self::backups(),
            ...self::schedules(),
            ...self::stock(),
        ] as $event) {
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
            $reach = self::one(
                'node.' . $id . '.reachable',
                $node['reachable'] ? State::OK : State::BAD,
                $repeat,
                Theme::trans('alerts.node_down', ['node' => $name]),
                Theme::trans('alerts.node_down_body', ['node' => $name]),
                Theme::trans('alerts.node_up', ['node' => $name]),
            );

            $events = array_merge($events, $reach);

            /*
             * And the people whose servers are on it.
             *
             * Only when this run produced an event, which is what makes it
             * once down and once back rather than once a quarter hour - and
             * never on a reminder. The watchdog repeats itself to an
             * administrator on purpose, because that is somebody who has to
             * act. Repeating it to four hundred customers is how a panel's
             * notifications stop being read.
             */
            foreach ($reach as $event) {
                if (($event['kind'] ?? '') === 'reminder') {
                    continue;
                }

                Owners::tell($id, $name, !$node['reachable']);
            }

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

    /**
     * Work the queue gave up on.
     *
     * A failed job is a thing that was supposed to happen and did not: a server
     * never built, a renewal invoice never written, a mail never sent. Laravel
     * puts them in a table and says nothing, which is right for a framework and
     * wrong for a panel - that row is only ever read by somebody who already
     * suspects something.
     *
     * Counted rather than listed. Twenty failures at three in the morning are
     * one cause, and a message naming all twenty is a message nobody reads to
     * the end.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    /** How far down the failed table this has already looked. */
    private const FAILED_SEEN = 'legend-theme.failed.seen';

    private static function failures(): array
    {
        if (!(bool) Theme::config('alert_failed', true)) {
            return [];
        }

        try {
            // Not every panel keeps a table of them, and nothing to read is
            // not a fault to report.
            if (!Schema::hasTable('failed_jobs')) {
                return [];
            }

            $newest = (int) (DB::table('failed_jobs')->max('id') ?? 0);
            $seen = cache()->get(self::FAILED_SEEN);

            /*
             * The first look never reports anything.
             *
             * A panel that has kept its failures for a year is not having a
             * problem this minute, and being told about all of them the moment
             * this check is installed is the fastest way to teach somebody to
             * ignore it. So the first run writes down where the table had got
             * to and says nothing.
             */
            if (!is_int($seen)) {
                cache()->forever(self::FAILED_SEEN, $newest);

                return [];
            }

            $count = DB::table('failed_jobs')->where('id', '>', $seen)->count();

            cache()->forever(self::FAILED_SEEN, $newest);
        } catch (Throwable) {
            return [];
        }

        /*
         * What has failed since the last look, not what is in the table.
         *
         * The first version of this counted the table, and the table is
         * deliberately kept for a month - so it was never empty, the condition
         * never cleared, and the message came back every few hours saying the
         * same number and how many hours it had been saying it. A warning that
         * cannot stop is a warning somebody turns off.
         */
        return self::one(
            'panel.failed',
            $count > 0 ? State::BAD : State::OK,
            self::repeat(),
            Theme::trans('alerts.failed_title', ['count' => $count]),
            Theme::trans('alerts.failed_body'),
            Theme::trans('alerts.failed_back'),
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
     * A scheduled task that has stopped.
     *
     * The same silence the backups check exists for, one step earlier: a backup
     * goes stale because the schedule that makes it stopped, and this is the
     * thing that stopped. Pelican's own status has no word for it - a run that
     * crashed part way stays "processing" and is drawn exactly like one running
     * now - so nothing anywhere says it.
     *
     * One event rather than three. Stuck, overdue and never-run are different
     * shapes of the same sentence, "this is not running any more", and three
     * messages arriving together about the same cron would be three ways of
     * saying one thing.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function schedules(): array
    {
        if (!(bool) Theme::config('alert_schedules', false)) {
            return [];
        }

        $troubled = Schedules::troubled();

        $names = array_map(
            static fn (array $row): string => ($row['server'] === '' ? '' : $row['server'] . ' / ')
                . ($row['name'] === '' ? Theme::trans('schedules.state_' . $row['verdict']) : $row['name']),
            $troubled,
        );

        return self::one(
            'schedules.stopped',
            $troubled === [] ? State::OK : State::BAD,
            self::repeat(),
            Theme::trans('alerts.schedule_stopped', ['count' => count($troubled)]),
            Theme::trans('alerts.schedule_stopped_body', [
                'hours' => Schedules::STUCK_HOURS,
                'schedules' => self::list($names),
            ]),
            Theme::trans('alerts.schedule_running'),
        );
    }

    /* ------------------------------------------------------------- stock -- */

    /** Where a package's two rows live, so one that is gone can be forgotten. */
    private const STOCK = 'shop.stock.';

    /**
     * Packages the shop can no longer sell, and ones it is about to run out of.
     *
     * **One pair of rows per package, and at most three messages.** Every other
     * check here keys on a condition for the whole panel, and that is wrong for
     * this one: a shop nearly always has something permanently sold out, so a
     * key meaning "anything is short" stands at bad for ever and the next
     * package to sell out is silence. The shape follows from that. Each package
     * remembers its own level; the digest is built afterwards from whichever
     * levels moved, so six packages selling out together is still one sentence.
     *
     * **Sold out and nearly sold out are separate levels rather than one.** The
     * moment a package goes from two left to none is the moment the shop starts
     * refusing money, and under a single "short" level nothing has changed and
     * nobody hears about it.
     *
     * **Never repeated.** self::repeat() is deliberately not passed. Somewhere
     * being sold out is an ordinary state of a shop rather than an outage, and
     * a reminder every four hours that a package the owner chose to cap is
     * still capped is how somebody learns to ignore this.
     *
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function stock(): array
    {
        if (!(bool) Theme::config('alert_stock', false)) {
            return [];
        }

        try {
            if (!Features::enabled(Features::SHOP) || !Tables::ready()) {
                return [];
            }

            $capped = Packages::capped();
        } catch (Throwable) {
            return [];
        }

        /*
         * A reading that failed is not a shop with room in everything.
         *
         * Nothing is recorded and nothing is pruned, so whatever is standing
         * stays standing. The other direction would treat a database that
         * refused one query as a restock and announce it.
         */
        if ($capped === null) {
            return [];
        }

        // Nought switches off the warning and keeps the sold-out message. That
        // is the only reason the two are separate settings.
        $limit = max(0, (int) Theme::config('alert_stock_left', 3));
        $standing = State::all();

        $out = [];
        $low = [];
        $back = [];
        $readings = [];

        foreach ($capped as $row) {
            $outKey = self::STOCK . $row['id'] . '.out';
            $lowKey = self::STOCK . $row['id'] . '.low';

            $was = match (true) {
                ($standing[$outKey]['state'] ?? State::OK) === State::BAD => 'out',
                $limit > 0 && ($standing[$lowKey]['state'] ?? State::OK) === State::BAD => 'low',
                default => 'fine',
            };

            $now = self::level((int) $row['left'], $limit, $was);

            $readings[$outKey] = $now === 'out' ? State::BAD : State::OK;

            /*
             * With the warning switched off the low row is not written at all,
             * and pruning takes away whatever one is left over. Recording it as
             * fine instead would announce every package that was low when the
             * owner turned the warning off as back on sale, which is a message
             * about a setting dressed up as news about the shop.
             */
            if ($limit > 0) {
                $readings[$lowKey] = $now === 'low' ? State::BAD : State::OK;
            }

            if ($now === $was) {
                continue;
            }

            /*
             * Which of the three sentences this package belongs in, and the
             * order matters.
             *
             * Coming back is only ever coming back from sold out. A package
             * that dipped to the warning line and climbed off it again was on
             * sale the whole time, and "it is back on sale" would be a plain
             * untruth about it - so that one moves quietly and says nothing,
             * which is also the least interesting of the four things that can
             * happen to a package.
             *
             * And a package restocked from nothing to below the line reports as
             * back rather than as nearly gone, because being buyable again is
             * the news and how few there are is the detail.
             */
            match (true) {
                $now === 'out' => $out[] = (string) $row['name'],
                $was === 'out' => $back[] = (string) $row['name'],
                $now === 'low' => $low[] = (string) $row['name'],
                default => null,
            };
        }

        // Written once rather than twice per package, which is the whole reason
        // records() exists.
        State::records($readings);

        /*
         * A package that is no longer for sale is no longer short of anything.
         *
         * After the loop rather than before it, and only on a reading that
         * worked, because the list of keys to keep is what the loop just built.
         */
        State::prune(self::STOCK, array_keys($readings));

        /*
         * No quiet first pass, unlike the checks above.
         *
         * State has one that silences a state it has never seen before, and it
         * could not reach here anyway: every check in run() records before this
         * one does, so the file is never empty by the time this is reached. But
         * it should not be wanted either. What it would hide is a shop that is
         * already short of something on the day the owner switches this on,
         * which is the answer they turned it on to get, and the digest means
         * hearing it costs three messages whether the shop has six packages or
         * six hundred.
         */
        return [
            ...self::digest('shop.stock.out', $out, 'alerts.stock_out', 'alerts.stock_out_body', false),
            ...self::digest('shop.stock.low', $low, 'alerts.stock_low', 'alerts.stock_low_body', false, $limit),
            ...self::digest('shop.stock.back', $back, 'alerts.stock_back', 'alerts.stock_back_body', true),
        ];
    }

    /**
     * What a package's own count means, given where it already was.
     *
     * The band is the whole of the hysteresis and it is per package, which is
     * the only place it can be honest: raise at or below the number the owner
     * set, hold at one above it, and call it well again only at two above, so a
     * package that a purchase and a cancellation push across the line holds
     * where it is instead of announcing itself both ways every pass.
     *
     * Widened only on the way out of "low". Coming back from sold out the band
     * would admit a package at one above the threshold and call it nearly sold
     * out, which is a message contradicting the number in the settings.
     */
    private static function level(int $left, int $limit, string $was): string
    {
        if ($left === 0) {
            return 'out';
        }

        if ($limit < 1) {
            return 'fine';
        }

        return $left <= ($was === 'low' ? $limit + 1 : $limit) ? 'low' : 'fine';
    }

    /**
     * One sentence about however many packages just did the same thing.
     *
     * Not self::one(), and the difference is the point: that one turns a
     * standing condition into a message and is right for a node, where the
     * subject and the condition are the same thing. Here the state is already
     * recorded, per package, and what is left is to say what moved. The key
     * only travels so the event can be identified.
     *
     * @param  array<int, string>  $names
     * @return array<int, array{key: string, kind: string, title: string, body: string, good: bool}>
     */
    private static function digest(
        string $key,
        array $names,
        string $title,
        string $body,
        bool $good,
        ?int $limit = null,
    ): array {
        if ($names === []) {
            return [];
        }

        return [[
            'key' => $key,
            'kind' => $good ? 'cleared' : 'raised',
            'title' => Theme::choice($title, count($names)),
            'body' => Theme::trans($body, [
                'packages' => self::list($names),
                'limit' => (string) ($limit ?? 0),
            ]),
            'good' => $good,
        ]];
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
