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
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Theme;

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
            // The id inside the archive is checked against ours, so a wrong
            // download cannot overwrite a different plugin.
            $pluginService->downloadPluginFromUrl($this->downloadUrl, $id);

            Plugin::refreshRows();

            $plugin = Plugin::findOrFail($id);

            $pluginService->installPlugin($plugin, $wasEnabled);

            cache()->forget("plugins.{$id}.update");

            $this->tell(
                Notification::make()
                    ->success()
                    ->title(Theme::trans('page.update_done'))
                    ->body('v' . $this->version),
                'Legend Theme updated to v' . $this->version,
            );
        } catch (Exception $exception) {
            report($exception);

            $this->tell(
                Notification::make()
                    ->danger()
                    ->title(Theme::trans('page.update_failed'))
                    ->body($exception->getMessage()),
                'Legend Theme update failed: ' . $exception->getMessage(),
            );
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

    public function uniqueId(): string
    {
        return 'legend-theme:update';
    }
}
