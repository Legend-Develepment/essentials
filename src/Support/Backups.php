<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Server;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * Backups, asked about across the whole panel instead of one server at a time.
 *
 * Pelican shows a server its own backups, which is the right page for somebody
 * looking after one server and no help at all to somebody looking after forty.
 * The question an administrator actually has is the inverse one - *which of
 * mine has no backup* - and there is nowhere in the panel that answers it.
 *
 * So this is a reading, not an integration. Every figure comes from
 * App\Models\Backup, which already carries completed_at, is_successful, bytes
 * and whether a backup was scheduled or made by hand. Nothing here talks to a
 * daemon, nothing here creates or deletes anything, and a row links to
 * Pelican's own backup page rather than growing a second set of actions that
 * would have to be kept in step with it.
 *
 * The counting is done in the database rather than in PHP, and that is not
 * premature: the obvious version loads every backup of every server to work out
 * four numbers per row, which on a panel with four hundred servers and a
 * fortnight of daily backups is five thousand models to produce a table of
 * forty lines. Four aggregate sub-selects produce the same answer in one query
 * and can be sorted on, which a computed column cannot.
 */
class Backups
{
    /** How old a backup may be before the page calls it stale. */
    public const STALE_DAYS = 7;

    /**
     * How far back a failure still counts as news.
     *
     * A backup that failed in March on a server that has been fine since is
     * history rather than a problem, and a column that never clears is a column
     * people stop reading.
     */
    public const FAILURE_DAYS = 7;

    /**
     * Every server this person may see, with its backup situation attached.
     *
     * Scoped through accessibleServers(), which is Pelican's own answer to
     * whose servers these are - including the node-level rights an
     * administrator may have. The ids are taken first and the real query built
     * fresh, because accessibleServers() is a join with a distinct on it and
     * hanging four aggregate sub-selects off that produces SQL nobody wants to
     * debug.
     *
     * @return Builder<Server>
     */
    public static function query(): Builder
    {
        $ids = [];

        try {
            $ids = user()?->accessibleServers()->pluck('servers.id')->all() ?? [];
        } catch (Throwable) {
            // No list is an empty page rather than every server on the panel.
        }

        $recent = now()->subDays(self::FAILURE_DAYS);

        return Server::query()
            ->whereIn('servers.id', $ids)
            ->withCount([
                'backups as ld_kept' => static fn (Builder $q) => $q->where('is_successful', true),

                /*
                 * Failed, not merely unfinished.
                 *
                 * is_successful defaults to false and completed_at stays null
                 * while a backup is running, so "not successful" on its own
                 * counts every backup currently in progress as a failure. It
                 * has to have finished to have failed.
                 */
                'backups as ld_failed' => static fn (Builder $q) => $q
                    ->where('is_successful', false)
                    ->whereNotNull('completed_at')
                    ->where('completed_at', '>=', $recent),

                'backups as ld_running' => static fn (Builder $q) => $q->whereNull('completed_at'),
            ])
            ->withMax(
                ['backups as ld_last' => static fn (Builder $q) => $q->where('is_successful', true)],
                'completed_at',
            )
            ->withSum(
                ['backups as ld_bytes' => static fn (Builder $q) => $q->where('is_successful', true)],
                'bytes',
            )
            /*
             * Servers with nothing first, then the stalest.
             *
             * The page exists to answer "which of mine has no backup", so that
             * answer is the top of it rather than something to sort towards.
             *
             * No HAVING to narrow it here, deliberately. Filtering on the alias
             * of an aggregate sub-select is MySQL being lenient about
             * something the standard does not allow, and Pelican runs on
             * PostgreSQL and SQLite too. The list is every server and the
             * narrowing happens where it can be done portably - a filter on the
             * table, and a pass in PHP for the watchdog.
             */
            ->orderByRaw('ld_last IS NULL DESC')
            ->orderBy('ld_last');
    }

    /**
     * How old a backup may be before it is stale, from the settings.
     *
     * Clamped rather than trusted: it goes into a date comparison, and a
     * negative number would make every backup stale for ever.
     */
    public static function days(): int
    {
        $days = (int) Theme::config('alert_backup_days', self::STALE_DAYS);

        return max(1, min(365, $days));
    }

    /**
     * Whether a server's newest successful backup is older than the threshold.
     *
     * Answers null when there has never been one, which is a different thing
     * from a stale one and is reported differently: "no backup at all" is a
     * setting somebody never finished, "the last one was nine days ago" is a
     * schedule that has stopped working.
     */
    public static function stale(?string $last): ?bool
    {
        if ($last === null || $last === '') {
            return null;
        }

        try {
            return now()->subDays(self::days())->greaterThan($last);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Bytes, in something a person reads.
     *
     * Binary units, because that is what Pelican uses everywhere else and a
     * page that disagreed with the one beside it about how big a backup is
     * would be its own small problem.
     */
    public static function size(int $bytes): string
    {
        if ($bytes <= 0) {
            return '—';
        }

        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB'];
        $at = 0;
        $size = (float) $bytes;

        while ($size >= 1024 && $at < count($units) - 1) {
            $size /= 1024;
            $at++;
        }

        return round($size, $size >= 100 || $at === 0 ? 0 : 1) . ' ' . $units[$at];
    }

    /**
     * Every server that is behind, for the watchdog.
     *
     * Its own method rather than the page's query, because the watchdog wants
     * the answer and not a table: names, split into the two states worth
     * telling apart, and capped so a panel where nothing has ever been backed
     * up produces a message rather than a wall.
     *
     * @return array{none: array<int, string>, stale: array<int, string>, failed: array<int, string>}
     */
    public static function behind(): array
    {
        $out = ['none' => [], 'stale' => [], 'failed' => []];

        try {
            foreach (self::query()->get() as $server) {
                $name = (string) $server->name;
                $last = $server->ld_last;

                if ((int) ($server->ld_failed ?? 0) > 0) {
                    $out['failed'][] = $name;
                }

                if ($last === null) {
                    $out['none'][] = $name;
                } elseif (self::stale($last) === true) {
                    $out['stale'][] = $name;
                }
            }
        } catch (Throwable) {
            // A query that cannot run is not a panel with no backups, and the
            // watchdog treats an empty answer as nothing to say rather than as
            // everything being wrong.
        }

        return $out;
    }
}
