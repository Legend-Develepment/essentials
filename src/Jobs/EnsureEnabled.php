<?php

namespace LegendDevelopment\Theme\Jobs;

use App\Enums\PluginStatus;
use App\Models\Plugin;
use App\Services\Helpers\PluginService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Switches the theme back on after an install or an update.
 *
 * A plugin's status lives in the meta block of its own plugin.json, and an
 * update replaces that file - so by the time PluginService decides what to do
 * with the status, the plugin it is looking at reads as "not installed" and gets
 * disabled. That decision happens after the seeder has run, so nothing shipped
 * in the new version can win it on the spot; this runs afterwards instead.
 *
 * Called from the seeder, which is the one piece of the new version that runs on
 * every install and every update, whichever button started it - the one on the
 * Theme page or Pelican's own on Admin -> Plugins.
 *
 * Do not dispatch this. It still carries the queue interfaces because it was a
 * queued job until 2.48.3, and that is exactly what broke it: a worker
 * registers a plugin's PSR-4 prefix once at boot, and PluginService skips that
 * registration for a plugin it thinks is incompatible or whose manifest it
 * could not read. A worker that started while this plugin was in either state
 * unserialised every dispatch into an __PHP_Incomplete_Class and failed, over
 * and over, in the one situation this job exists for - the moments right after
 * the plugin was replaced on disk. InstallTasks calls handle() in-process from
 * app()->terminating() instead, where nothing is serialised.
 */
class EnsureEnabled implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle(PluginService $pluginService): void
    {
        try {
            // The rows are read from the plugin.json files on disk, and the one
            // this is about was rewritten a moment ago.
            Plugin::refreshRows();

            $plugin = Plugin::find(Theme::id());

            if ($plugin === null) {
                return;
            }

            // Only from off to on. Errored and incompatible are saying something
            // worth leaving alone - switching those on would hide the reason the
            // panel gave for not running the plugin.
            if (!in_array($plugin->status, [PluginStatus::Disabled, PluginStatus::NotInstalled], true)) {
                return;
            }

            $pluginService->enablePlugin($plugin);

            // The status is written into the plugin's own plugin.json, and
            // PluginService writes it without checking whether that worked - so
            // a file the panel may not write to fails silently and the plugin
            // simply stays off. Read it back and say so.
            Plugin::refreshRows();

            if (Plugin::find(Theme::id())?->status !== PluginStatus::Enabled) {
                Log::warning(
                    'Legend Theme could not be switched on. The panel could not write '
                    . plugin_path(Theme::id(), 'plugin.json')
                    . ' - check that it belongs to the user the panel runs as.'
                );
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    public function uniqueId(): string
    {
        return 'legend-theme:ensure-enabled';
    }
}
