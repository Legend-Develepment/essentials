<?php

namespace LegendDevelopment\Theme\Jobs;

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

    public function __construct(
        public User $user,
        public string $downloadUrl,
        public string $version,
    ) {}

    public function handle(PluginService $pluginService): void
    {
        $id = Theme::id();

        try {
            // The id inside the archive is checked against ours, so a wrong
            // download cannot overwrite a different plugin.
            $pluginService->downloadPluginFromUrl($this->downloadUrl, $id);

            Plugin::refreshRows();

            $plugin = Plugin::findOrFail($id);

            // false: keep whatever status it had rather than force-enabling.
            $pluginService->installPlugin($plugin, false);

            cache()->forget("plugins.{$id}.update");

            Notification::make()
                ->success()
                ->title(Theme::trans('page.update_done'))
                ->body('v' . $this->version)
                ->sendToDatabase($this->user);
        } catch (Exception $exception) {
            report($exception);

            Notification::make()
                ->danger()
                ->title(Theme::trans('page.update_failed'))
                ->body($exception->getMessage())
                ->sendToDatabase($this->user);
        }
    }

    public function uniqueId(): string
    {
        return 'legend-theme:update';
    }
}
