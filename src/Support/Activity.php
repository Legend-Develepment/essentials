<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\ActivityLog;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

/**
 * What happened on this panel, all of it, in one list.
 *
 * Pelican logs every event panel-wide and shows it **only per server**, on the
 * Activity tab inside each one. That is the right page for somebody looking
 * after one server and no help at all to somebody looking after forty, whose
 * question is "who deleted that" and whose only way to answer it today is to
 * open forty tabs.
 *
 * So this is the same data asked the other way round, and nothing else: it
 * reads Pelican's own ActivityLog, uses Pelican's own labels for the events,
 * and respects Pelican's own permission for who may see an IP address. There is
 * no second copy of anything here.
 *
 * **Read only, and permanently so.** Nothing on this page deletes a line or
 * prunes the log. Pelican's settings already own the prune age, and a log that
 * the people it records can edit is not a log.
 */
class Activity
{
    /** Enough for a filter to stay a filter. */
    private const MAX_OPTIONS = 200;

    /** @var array<string, string>|null */
    private static ?array $events = null;

    /** @var array<int, string>|null */
    private static ?array $actors = null;

    public static function enabled(): bool
    {
        return Features::enabled(Features::ACTIVITY);
    }

    public static function forget(): void
    {
        self::$events = null;
        self::$actors = null;
    }

    /**
     * Every event this person may see.
     *
     * Two things are in it, and the second is the one worth explaining. Events
     * about a server they can reach - accessibleServers() is the same question
     * the backups overview asks, and it honours the node scoping Pelican
     * already applies to a delegated administrator. And events about no server
     * at all: a user created, a node edited, somebody signing in. Those have no
     * server to scope by, and leaving them out would make a panel-wide log a
     * log of everything except what happens to the panel.
     *
     * @return Builder<ActivityLog>
     */
    public static function query(): Builder
    {
        $ids = [];

        try {
            $ids = user()?->accessibleServers()->pluck('servers.id')->all() ?? [];
        } catch (Throwable) {
            // No list is an empty page rather than every server on the panel.
        }

        $type = self::serverType();

        return ActivityLog::query()
            // The same exclusion Pelican's own page makes. A file upload logs a
            // line per file, so a single drag of a modpack buries a day.
            ->whereNotIn('activity_logs.event', ActivityLog::DISABLED_EVENTS)
            ->with(['actor', 'subjects.subject'])
            ->where(static function (Builder $query) use ($ids, $type): void {
                $query
                    ->whereHas('subjects', static fn (Builder $subject): Builder => $subject
                        ->where('subject_type', $type)
                        ->whereIn('subject_id', $ids))
                    ->orWhereDoesntHave('subjects', static fn (Builder $subject): Builder => $subject
                        ->where('subject_type', $type));
            });
    }

    /**
     * The server one line is about, or null for a panel-level event.
     *
     * A line can carry several subjects - a subuser event names the subuser and
     * the server - so this looks for the one that is a server rather than
     * taking the first.
     */
    public static function serverOf(ActivityLog $log): ?Server
    {
        try {
            foreach ($log->subjects as $subject) {
                if ($subject->subject instanceof Server) {
                    return $subject->subject;
                }
            }
        } catch (Throwable) {
            // A subject whose record has gone is a line with no server on it,
            // which is a row with a dash in that column rather than an error.
        }

        return null;
    }

    /**
     * Who did it.
     *
     * Three answers, and the middle one matters: an event with no actor at all
     * was the panel itself - a schedule firing, a queue job - and an event
     * whose actor has since been deleted is not the same thing. Saying "system"
     * for both would hide that somebody's account is gone.
     */
    public static function who(ActivityLog $log): string
    {
        try {
            $actor = $log->actor;

            if ($actor instanceof User) {
                return (string) $actor->username;
            }

            return $log->actor_id === null
                ? Theme::trans('activity.system')
                : Theme::trans('activity.gone');
        } catch (Throwable) {
            return Theme::trans('activity.gone');
        }
    }

    /**
     * What happened, in Pelican's own words.
     *
     * getLabel() reads the panel's activity translations and fills in the
     * properties, which wrapProperties() has already stripped of tags - so the
     * result is trusted markup with untrusted values already made safe. That is
     * the same trust Pelican's own page accepts by rendering it as HTML, and
     * inventing a different one here would mean a second set of sentences for
     * every event the panel can log.
     *
     * The fallback is the raw event, because trans() answers with the key it
     * could not find, and "activity.server.backup.delete" on a screen is worse
     * than "server:backup.delete".
     */
    public static function label(ActivityLog $log): string
    {
        $event = (string) $log->event;

        try {
            $label = $log->getLabel();

            /*
             * Compared against the exact key rather than searched for "activity."
             * inside the sentence. trans_choice answers with the key it could
             * not find and nothing else, so an exact match is the only thing
             * that means "missing" - and a real sentence is free to contain the
             * word activity without being mistaken for one.
             */
            return $label === 'activity.' . str_replace(':', '.', $event) ? $event : $label;
        } catch (Throwable) {
            return $event;
        }
    }

    /**
     * The address it came from, or null.
     *
     * Through the model's own getIp(), which returns null unless the reader
     * holds Pelican's `seeIps activityLog`. Reading the column directly would
     * publish on this page what the panel deliberately hides on its own.
     */
    public static function ip(ActivityLog $log): ?string
    {
        try {
            return $log->getIp();
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The events that actually appear in this log, for the filter.
     *
     * Read from the log rather than listed here. Pelican adds events and so do
     * its plugins, and a list written out would be a list that is wrong by the
     * next release.
     *
     * @return array<string, string>
     */
    public static function eventOptions(): array
    {
        if (self::$events !== null) {
            return self::$events;
        }

        self::$events = [];

        try {
            $events = ActivityLog::query()
                ->whereNotIn('event', ActivityLog::DISABLED_EVENTS)
                ->distinct()
                ->orderBy('event')
                ->limit(self::MAX_OPTIONS)
                ->pluck('event')
                ->all();

            foreach ($events as $event) {
                self::$events[(string) $event] = self::pretty((string) $event);
            }

            return self::$events;
        } catch (Throwable) {
            return self::$events = [];
        }
    }

    /**
     * `server:backup.delete` as "Server · backup delete".
     *
     * The raw key rather than the sentence, deliberately. The sentence is built
     * per line from that line's own properties - "Deleted backup mc-1.tar.gz" -
     * so it is different on every row and useless as a filter. The key is what
     * groups them.
     */
    public static function pretty(string $event): string
    {
        [$group, $rest] = array_pad(explode(':', $event, 2), 2, null);

        if ($rest === null) {
            return ucfirst(str_replace(['.', '-'], ' ', $group));
        }

        return ucfirst($group) . ' · ' . str_replace(['.', '-'], ' ', $rest);
    }

    /**
     * Who appears in the log, for the filter.
     *
     * @return array<int, string>
     */
    public static function actorOptions(): array
    {
        if (self::$actors !== null) {
            return self::$actors;
        }

        self::$actors = [];

        try {
            $ids = ActivityLog::query()
                ->whereNotNull('actor_id')
                ->where('actor_type', (new User())->getMorphClass())
                ->distinct()
                ->limit(self::MAX_OPTIONS)
                ->pluck('actor_id')
                ->all();

            if ($ids === []) {
                return self::$actors;
            }

            return self::$actors = User::query()
                ->whereIn('id', $ids)
                ->orderBy('username')
                ->pluck('username', 'id')
                ->map(static fn (mixed $name): string => (string) $name)
                ->all();
        } catch (Throwable) {
            return self::$actors = [];
        }
    }

    /**
     * Whether this reader sees the address a line came from.
     *
     * Pelican's own permission, asked here only so the page can say that the
     * addresses are hidden rather than leaving somebody hovering over a tooltip
     * that never appears.
     */
    public static function showsIps(): bool
    {
        try {
            return user()?->can('seeIps activityLog') ?? false;
        } catch (Throwable) {
            return false;
        }
    }

    public static function serverType(): string
    {
        try {
            return (new Server())->getMorphClass();
        } catch (Throwable) {
            return Server::class;
        }
    }
}
