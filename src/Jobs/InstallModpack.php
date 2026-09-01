<?php

namespace LegendDevelopment\Theme\Jobs;

use App\Models\Server;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Minecraft\Installer;
use LegendDevelopment\Theme\Support\Minecraft\Modpack;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Putting a modpack on a server, which is minutes of work.
 *
 * Queued because it has to be: fetching the pack, unpacking it, and asking the
 * daemon for a couple of hundred files is not something to do while somebody
 * waits for a page. That does mean it needs a queue worker - if nothing is
 * running one, nothing happens, and the page says so before the button is
 * pressed rather than after.
 *
 * The server model is not serialised. A job holding one carries a snapshot of a
 * row that a five-minute install can outlive; the id is looked up when the job
 * runs, so it works on the server as it is rather than as it was.
 */
class InstallModpack implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** A long one. Two hundred daemon calls is not a thirty-second job. */
    public int $timeout = 1800;

    /**
     * Once. A modpack install that failed halfway and then ran again from the
     * top would fetch everything twice, and the second attempt would fail the
     * same way the first did.
     */
    public int $tries = 1;

    /**
     * @param  array<int, array{path: string, url: string, size: int}>  $files
     */
    public function __construct(
        private readonly int $serverId,
        private readonly ?int $userId,
        private readonly string $packUrl,
        private readonly string $packName,
        private readonly string $label,
    ) {}

    public function handle(): void
    {
        $server = Server::query()->find($this->serverId);

        if ($server === null) {
            return;
        }

        try {
            if (!Installer::fetch($server, $this->packUrl, $this->packName)) {
                $this->tell($server, Theme::trans('modpack.failed'), Theme::trans('modpack.failed_fetch'), false);

                return;
            }

            $index = Installer::index($server);

            if ($index === null) {
                Installer::clean($server);
                $this->tell($server, Theme::trans('modpack.failed'), Theme::trans('modpack.failed_index'), false);

                return;
            }

            $files = Modpack::files($index);
            $asked = 0;
            $refused = 0;

            foreach ($files as $file) {
                Installer::place($server, $file['path'], $file['url'])
                    ? $asked++
                    : $refused++;
            }

            $moved = Installer::overrides($server, Installer::overrideNames($server));

            Installer::clean($server);

            $this->tell(
                $server,
                Theme::trans('modpack.done', ['pack' => $this->label]),
                Theme::trans('modpack.done_body', [
                    'files' => $asked,
                    'overrides' => $moved,
                ]) . ($refused > 0 ? ' ' . Theme::trans('modpack.done_refused', ['count' => $refused]) : ''),
                true,
            );
        } catch (Throwable $exception) {
            report($exception);

            Installer::clean($server);

            $this->tell($server, Theme::trans('modpack.failed'), $exception->getMessage(), false);
        }
    }

    /**
     * Tell whoever pressed the button, and the log either way.
     *
     * The log entry is not a fallback for the notification - it is the record.
     * An install that ran for four minutes while somebody closed the tab is
     * exactly the one worth being able to read about afterwards.
     */
    private function tell(Server $server, string $title, string $body, bool $good): void
    {
        Log::log($good ? 'info' : 'warning', 'Essentials modpack on server ' . $server->id . ': ' . $title . ' - ' . $body);

        if ($this->userId === null) {
            return;
        }

        try {
            $user = \App\Models\User::query()->find($this->userId);

            if ($user === null) {
                return;
            }

            $notification = Notification::make()->title($title)->body($body);

            ($good ? $notification->success() : $notification->danger())
                ->persistent()
                ->sendToDatabase($user);
        } catch (Throwable) {
            // The log already has it. A notification that cannot be stored is
            // not worth failing a finished install over.
        }
    }
}
