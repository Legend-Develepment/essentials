<?php

namespace LegendDevelopment\Theme\Jobs;

use App\Models\Egg;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Artwork\Artwork;
use LegendDevelopment\Theme\Support\Artwork\Igdb;
use LegendDevelopment\Theme\Support\Artwork\Steam;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Artwork for every egg that has none, fetched in the background.
 *
 * Queued, and that is the one real change from the plugin this grew out of.
 * There, the bulk fetch ran inside the request: four hundred eggs, two network
 * calls each, a fifth of a second of politeness between them - twenty minutes
 * with the browser spinning, and the documentation said so, in as many words:
 * *the page will appear frozen during this time, this is normal.* It is not.
 * PHP's own time limit ends it long before the eggs do, and what you get is an
 * unfinished job and no way to know where it stopped.
 *
 * So it goes to the queue, which this plugin already requires for the modpack
 * installer. If nothing is running a worker, nothing happens - and the page
 * says so before the button rather than after.
 *
 * Steam first, IGDB for what is left. Not a preference about quality: Steam
 * needs no credentials, so it is the half that works on every panel, and asking
 * IGDB for something Steam already answered would spend somebody's rate limit
 * for nothing.
 */
class FetchArtwork implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** Four hundred eggs at two calls each, with a pause between. */
    public int $timeout = 3600;

    /**
     * Once.
     *
     * A retry would start again from the first egg, re-fetch everything that
     * worked, and fail at the same one - so the second run costs what the first
     * did and ends the same way.
     */
    public int $tries = 1;

    /**
     * A fifth of a second between eggs.
     *
     * Steam's store search is undocumented and unmetered, which is not the same
     * as unlimited. Four hundred requests as fast as PHP can make them is the
     * behaviour that gets an address blocked, and the whole run only takes a
     * minute and a half longer this way.
     */
    private const PAUSE = 200000;

    public function __construct(
        private readonly ?int $userId,
        private readonly bool $useIgdb,
    ) {}

    public function handle(): void
    {
        $fetched = 0;
        $skipped = 0;
        $failed = 0;

        try {
            /*
             * Read in chunks rather than all at once.
             *
             * Egg::all() on a panel with a large library is every row and every
             * one of its JSON columns in memory before the first picture is
             * fetched - and the variables, docker images and install script on
             * an egg are not small. A hundred at a time is the same work
             * without the spike.
             */
            Egg::query()->orderBy('id')->chunkById(100, function ($eggs) use (&$fetched, &$skipped, &$failed): void {
                foreach ($eggs as $egg) {
                    if (Artwork::isProtected($egg) || Artwork::hasImage($egg)) {
                        $skipped++;

                        continue;
                    }

                    if (Steam::byName($egg) === null) {
                        $fetched++;
                        usleep(self::PAUSE);

                        continue;
                    }

                    if ($this->useIgdb && Igdb::byName($egg) === null) {
                        $fetched++;
                        usleep(self::PAUSE);

                        continue;
                    }

                    $failed++;
                    usleep(self::PAUSE);
                }
            });
        } catch (Throwable $exception) {
            report($exception);

            $this->tell(
                Theme::trans('artwork.bulk_failed'),
                $exception->getMessage(),
                false,
            );

            return;
        }

        /*
         * Counted rather than summarised.
         *
         * "Done" is not an answer to the question somebody has after this runs,
         * which is always the same one: how many eggs still have no picture,
         * and is that because they were skipped or because nothing was found.
         * Those are different problems - one is protection working, the other
         * is a name Steam has never heard of.
         */
        $this->tell(
            Theme::trans('artwork.bulk_done'),
            Theme::trans('artwork.bulk_done_body', [
                'fetched' => $fetched,
                'skipped' => $skipped,
                'failed' => $failed,
            ]),
            true,
        );
    }

    /**
     * Tell whoever pressed the button, and the log either way.
     *
     * The log entry is the record rather than a fallback. A run that took
     * twenty minutes while somebody closed the tab is exactly the one worth
     * being able to read about afterwards.
     */
    private function tell(string $title, string $body, bool $good): void
    {
        Log::log($good ? 'info' : 'warning', 'Essentials egg artwork: ' . $title . ' - ' . $body);

        if ($this->userId === null) {
            return;
        }

        try {
            $user = User::query()->find($this->userId);

            if ($user === null) {
                return;
            }

            $notification = Notification::make()->title($title)->body($body);

            ($good ? $notification->success() : $notification->danger())
                ->persistent()
                ->sendToDatabase($user);
        } catch (Throwable) {
            // The log already has it. A notification that cannot be stored is
            // not worth failing a finished run over.
        }
    }
}
