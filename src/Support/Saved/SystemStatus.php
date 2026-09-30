<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Modules;
use LegendDevelopment\Theme\Support\SystemStatus as StatusPage;

/**
 * The system status page inside the panel, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::systemStatusData() and Settings::persistSystemStatus() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 *
 * The system status page itself, which this file is the settings of.
 * Aliased for the same reason as the sign-in screen next door: a class
 * importing its own short name resolves to the import, not to itself.
 */
class SystemStatus
{
    use EnvironmentWriterTrait;

    /**
     * The system status settings, in the shape persistSystemStatus() reads.
     *
     * These four lived only inside the page's own fillForm(), which was fine
     * while the page was the only thing that wanted them - and then the settings
     * file did too, and there was nothing to ask. A group of settings with a
     * persist() and no data() cannot be exported without writing the list out a
     * second time, which is how a list starts drifting.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'system_status' => StatusPage::enabled(),
            'system_status_refresh' => StatusPage::refresh(),
            'system_status_blocks' => StatusPage::blocks(),
            'system_status_nodes' => StatusPage::nodes(),
        ];
    }

    /**
     * The system status page's own three settings, written on their own.
     *
     * Same reason as persistLogin(): a form that does not carry every key must
     * not write every key.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        // Through Features, so this switch and the one on the Features tab are
        // the same switch. withOne() leaves the rest of the list alone, which
        // matters because this form does not show the rest of it.
        $off = Features::withOne(
            Features::SYSTEM_STATUS,
            (bool) ($data['system_status'] ?? true),
        );

        (new self())->writeToEnvironment([
            'LEGEND_THEME_FEATURES_OFF' => $off,
            'LEGEND_THEME_SYSTEM_REFRESH' => StatusPage::sanitiseRefresh($data['system_status_refresh'] ?? null),
            'LEGEND_THEME_SYSTEM_HIDDEN' => StatusPage::sanitiseBlocks($data['system_status_blocks'] ?? null),
            'LEGEND_THEME_SYSTEM_NODES' => StatusPage::sanitiseNodes($data['system_status_nodes'] ?? null),
        ]);

        // This one writes the feature list too, through withOne().
        Features::changed($off);
        Modules::arrive();
    }
}
