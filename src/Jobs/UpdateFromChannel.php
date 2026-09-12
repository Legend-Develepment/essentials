<?php

namespace LegendDevelopment\Theme\Jobs;

use App\Enums\PluginStatus;
use App\Models\Plugin;
use App\Models\User;
use App\Services\Helpers\PluginService;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Updating;

/**
 * Updates the theme from a given download.
 *
 * Pelican's own UpdatePlugin job takes only a plugin id and reads the download
 * address from plugin.json, which is always the stable feed - so a beta needs a
 * job that can be handed a URL. The steps are the same ones PluginService
 * performs for a normal update, in the same order.
 *
 * Queued for the same reason theirs is: rebuilding assets takes minutes.
 */
class UpdateFromChannel implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The user is who gets told how it went. There is none when the scheduler
     * starts the update on its own, and then the log is the only place to say.
     */
    public function __construct(
        public ?User $user,
        public string $downloadUrl,
        public string $version,
    ) {}

    public function handle(PluginService $pluginService): void
    {
        $id = Theme::id();

        // The status lives in plugin.json's meta block, and the download
        // replaces that file - so read it before, and hand it back after.
        // Without this every update lands disabled and has to be switched on by
        // hand, which turns one button into two.
        $wasEnabled = $this->wasEnabled($id);

        try {
            /*
             * Said here rather than where the job is dispatched.
             *
             * A job can die before handle() is ever entered - three of them on
             * this panel have - and a flag set at dispatch in that case has
             * nobody left to take it down. Here it also covers the path that
             * runs this without a queue at all, and re-arms for free on a
             * retry.
             */
            Updating::started($this->version);

            // The id inside the archive is checked against ours, so a wrong
            // download cannot overwrite a different plugin - both ways in.
            $headers = Channels::downloadHeaders($this->downloadUrl);

            if ($headers === []) {
                $pluginService->downloadPluginFromUrl($this->downloadUrl, $id);
            } else {
                $this->downloadWith($pluginService, $headers, $id);
            }

            Plugin::refreshRows();

            $plugin = Plugin::findOrFail($id);

            $pluginService->installPlugin($plugin, $wasEnabled);

            cache()->forget("plugins.{$id}.update");

            Updating::finished($this->version);

            $this->tell(
                Notification::make()
                    ->success()
                    ->title(Theme::trans('page.update_done'))
                    ->body('v' . $this->version),
                'Legend Theme updated to v' . $this->version,
            );
        } catch (Exception $exception) {
            report($exception);

            /*
             * Pelican's own message says what went wrong; this says what to do
             * about the one cause a person cannot work out from it.
             *
             * An update is refused when the id in the package differs from the
             * id installed, and that is exactly what a rename produces - the
             * plugin has had three ids and each change stranded every panel on
             * the one before it. The message for that is "expected X, got Y",
             * which is true and tells nobody that the answer is to uninstall
             * and install rather than to try again.
             *
             * Appended to every failure rather than matched on the message,
             * because the message is translated and matching text across
             * locales is a bug waiting for its first non-English panel.
             */
            $body = $exception->getMessage() . "\n\n" . Theme::trans('page.update_renamed');

            $this->tell(
                Notification::make()
                    ->danger()
                    ->persistent()
                    ->title(Theme::trans('page.update_failed'))
                    ->body($body),
                'Legend Theme update failed: ' . $exception->getMessage(),
            );
        } finally {
            /*
             * And the line comes down.
             *
             * Whichever of three happens first: this, or the cache clear the
             * install performs, or the record's own expiry. Only the last of
             * the three survives the worker killing this process outright,
             * which is why the expiry is the one that is relied on.
             *
             * A finally also catches what the catch above does not: that one
             * takes an Exception, and a bad release is at least as likely to
             * arrive as an Error.
             */
            Updating::settle();
        }
    }

    /**
     * The same download, for an address that will not answer without headers.
     *
     * Pelican's downloadPluginFromUrl() sends a plain GET and has nowhere to put
     * a token, which is fine for a public release and is the whole problem for
     * the dev channel: that repository is private. So the fetch happens here and
     * the archive is handed to the same service by file - the checks on it, the
     * size limit and the id comparison included, are the ones an import through
     * the panel goes through.
     *
     * @param  array<string, string>  $headers
     *
     * @throws Exception
     */
    private function downloadWith(PluginService $pluginService, array $headers, string $id): void
    {
        // The same timeouts Pelican downloads a release with: a rebuild takes
        // minutes, so five seconds to answer and a minute to send is generous
        // for a few megabytes and still short of hanging the queue.
        $body = Http::withHeaders($headers)
            ->timeout(60)
            ->connectTimeout(5)
            ->throw()
            ->get($this->downloadUrl)
            ->body();

        /*
         * The size limit Pelican applies to a download, applied before anything
         * is written rather than after. Its own downloader measures the response
         * for exactly this reason: the check inside the importer happens once
         * the bytes are already on a disk that may not have room for them.
         */
        $limit = (int) config('panel.plugin.max_import_size');

        if ($limit > 0 && strlen($body) > $limit) {
            throw new Exception('Zip file too large. (' . round($limit / 1024 / 1024, 2) . ' MiB)');
        }

        /*
         * Through the local disk rather than PHP's own file writing, which is
         * what everything else here does: Pelican Hub's submission check refuses
         * a package that names those functions at all, and this plugin has been
         * turned away by it before.
         *
         * A name of its own each time, so two updates started at once cannot
         * meet in one file - which they should not be able to anyway, since the
         * job is unique, but a temporary file is a cheap thing to be sure about.
         */
        $disk = Storage::disk('local');
        $name = 'essentials-update-' . Str::random(16) . '.zip';

        try {
            if ($disk->put($name, $body) === false) {
                throw new Exception('The download could not be written to a temporary file.');
            }

            // Named for the plugin rather than after the address: what the API
            // hands a release back from ends in an id, and this name is what the
            // importer reports when something is wrong with the archive.
            $pluginService->downloadPluginFromFile(
                new UploadedFile($disk->path($name), $id . '.zip', 'application/zip'),
                $id,
            );
        } finally {
            // The importer unpacks into a directory of its own under plugins/,
            // so this copy has done its job either way.
            $disk->delete($name);
        }
    }

    /**
     * Only a plugin that was switched off on purpose stays off. Anything else -
     * enabled, errored, or a row that cannot be read at all - is on its way back
     * to working, which is what pressing the button was for.
     */
    private function wasEnabled(string $id): bool
    {
        try {
            return Plugin::find($id)?->status !== PluginStatus::Disabled;
        } catch (Exception) {
            return true;
        }
    }

    private function tell(Notification $notification, string $line): void
    {
        if ($this->user !== null) {
            $notification->sendToDatabase($this->user);

            return;
        }

        Log::info($line);
    }

    /**
     * Half an hour, rather than the forever it was.
     *
     * This job is unique, and a unique job holds a lock for however long this
     * says. Left unset it means no expiry at all, and the lock is released only
     * on a clean finish or a final failure - neither of which the worker's
     * timeout kill reaches. So one update killed mid-build left a lock nothing
     * would ever remove, and every update after it was dropped without a word.
     *
     * The trade, said rather than buried: a build that reliably dies is now
     * retried every half hour instead of never again. Retrying something broken
     * is noisy; never updating again and not saying so is worse.
     */
    public int $uniqueFor = 1800;

    public function uniqueId(): string
    {
        return 'legend-theme:update';
    }
}
