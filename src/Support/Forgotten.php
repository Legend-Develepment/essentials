<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use LegendDevelopment\Theme\Support\Status\Pages as StatusPages;
use LegendDevelopment\Theme\Support\Tickets\Files;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;
use Throwable;

/**
 * Everything this plugin holds about one person, removed when their account is.
 *
 * The tables were never the problem. Every one of them names its owner through
 * a foreign key with cascadeOnDelete on it, so Pelican removing an account
 * removes the rows without this class existing. What it cannot reach is the
 * files: four of them named after the account's own id, and any picture that
 * account attached to a ticket.
 *
 * Those outlived everything. Deleting the ticket did not remove them, deleting
 * the account did not remove them, and an erasure request had nothing to act
 * on - the attachment stayed on disk at an address that needs no account to
 * open. An unguessable name answers "can a stranger find this" and answers
 * nothing at all about "delete what you hold about me", which is a question a
 * hosting company has to be able to answer with a yes.
 *
 * **Two phases, and the order is the point.** The attachments have to be read
 * while the tickets still exist, and they must not be deleted until the account
 * really is gone - a delete that is rolled back would otherwise take somebody's
 * files with it and leave the account standing. So `noted()` runs on the way in
 * and writes down what to remove, and `of()` runs once the row has actually
 * gone.
 *
 * Nothing here may stop an account being deleted. A panel that cannot remove a
 * person because a plugin could not remove a file is a worse outcome than the
 * file, so every step catches for itself and the count comes back short.
 */
class Forgotten
{
    /**
     * What to remove once the account is really gone, by id.
     *
     * @var array<int, array<int, mixed>>
     */
    private static array $noted = [];

    /**
     * Written down before the rows go, because afterwards they cannot be read.
     *
     * An attachment is a token inside a message row, and the messages cascade
     * away with the ticket, which cascades away with the account. By the time
     * anything knows the account is gone, the only record of which files were
     * theirs is gone with it.
     */
    public static function noted(int $userId): void
    {
        self::$noted[$userId] = [];

        try {
            if (!TicketTables::ready()) {
                return;
            }

            $tickets = DB::table(TicketTables::TICKETS)
                ->where('user_id', $userId)
                ->pluck('id')
                ->all();

            if ($tickets === []) {
                return;
            }

            $rows = DB::table(TicketTables::MESSAGES)
                ->whereIn('ticket_id', $tickets)
                ->whereNotNull('file')
                ->pluck('file')
                ->all();

            foreach ($rows as $row) {
                $decoded = json_decode((string) $row, true);

                if (is_array($decoded) && $decoded !== []) {
                    self::$noted[$userId][] = $decoded;
                }
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * And then remove it, once there is no account to belong to.
     *
     * @return int  how many files went
     */
    public static function of(int $userId): int
    {
        $gone = 0;

        foreach (self::$noted[$userId] ?? [] as $file) {
            try {
                if (Files::forget($file)) {
                    $gone++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        unset(self::$noted[$userId]);

        /*
         * The four named after the account itself.
         *
         * Each class removes its own, because each class owns its own path and
         * its own memo - the same reason Leftovers asks each of them how much
         * there is rather than knowing where any of it lives.
         */
        foreach ([
            static fn (): bool => Layouts::forgetUser($userId),
            static fn (): bool => UserTheme::forgetUser($userId),
            static fn (): bool => Favourites::forgetUser($userId),
            static fn (): bool => StatusPages::forget($userId),
        ] as $drop) {
            try {
                if ($drop()) {
                    $gone++;
                }
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return $gone;
    }

    /**
     * Both halves, for anybody who is not an event.
     *
     * An administrator answering an erasure request for somebody who has
     * already been removed from the panel has no deleting event to hang on,
     * and the account is the only thing that knows which tickets were theirs.
     * So this is the honest shape: it works while the account exists, and after
     * that only the four files named after its id can still be found.
     */
    public static function everything(User $user): int
    {
        $id = (int) $user->id;

        self::noted($id);

        return self::of($id);
    }
}
