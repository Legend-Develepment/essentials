<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Alerts\Notifier;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The watchdog: what it watches, how loudly, and who hears it, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::alertsData() and Settings::persistAlerts() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 */
class Alerts
{
    use EnvironmentWriterTrait;

    /**
     * The two settings that are credentials, by form key and by .env key.
     *
     * Neither is ever filled into the form. A form's state is a public Livewire
     * property, and a public property travels in the page's HTML: filling these
     * put the Discord webhook and the bot's signing secret in the source of the
     * Alerts page, readable by anybody allowed to open it - including somebody
     * who may only look, because a disabled form is still a filled one. So the
     * form gets an empty field and a placeholder saying one is on file, and
     * write() reads an empty field as "keep what is there".
     */
    private const SECRETS = [
        'alert_webhook' => 'LEGEND_THEME_ALERT_WEBHOOK',
        'alert_bot_secret' => 'LEGEND_THEME_ALERT_BOT_SECRET',
    ];

    /**
     * Whether a credential is on file, without handing it to anybody.
     *
     * What the form asks instead of the value: enough to say "saved" in the
     * field, and nothing that could be read out of the page.
     */
    public static function hasSecret(string $key): bool
    {
        return array_key_exists($key, self::SECRETS)
            && trim((string) Theme::config($key, '')) !== '';
    }

    /**
     * The watchdog's settings, in the shape persistAlerts() reads.
     *
     * Their own pair for the same reason the login screen has one: a form that
     * does not carry every key must not write every key.
     *
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'alert_every' => (string) Theme::config('alert_every', 'fifteen'),
            'alert_discord' => (bool) Theme::config('alert_discord', false),
            // Never the stored credential; see SECRETS. Empty keeps what is saved.
            'alert_webhook' => '',
            'alert_panel' => (bool) Theme::config('alert_panel', true),
            'alert_email' => (string) Theme::config('alert_email', ''),
            'alert_repeat' => (int) Theme::config('alert_repeat', 0),
            'alert_disk' => (int) Theme::config('alert_disk', 90),
            'alert_memory' => (int) Theme::config('alert_memory', 90),
            'alert_maintenance_hours' => (int) Theme::config('alert_maintenance_hours', 0),
            'alert_versions' => (bool) Theme::config('alert_versions', true),
            'alert_worker' => (bool) Theme::config('alert_worker', true),
            'alert_failed' => (bool) Theme::config('alert_failed', true),
            'alert_backups' => (bool) Theme::config('alert_backups', false),
            'alert_schedules' => (bool) Theme::config('alert_schedules', false),
            'alert_unbuilt' => (bool) Theme::config('alert_unbuilt', false),
            'alert_stock' => (bool) Theme::config('alert_stock', false),
            'alert_ports' => (bool) Theme::config('alert_ports', false),
            'alert_modules' => (bool) Theme::config('alert_modules', false),
            'alert_stock_left' => (int) Theme::config('alert_stock_left', 3),
            'alert_backup_days' => (int) Theme::config('alert_backup_days', 7),
            'alert_bot' => (bool) Theme::config('alert_bot', false),
            'alert_bot_url' => (string) Theme::config('alert_bot_url', ''),
            'alert_bot_secret' => '',
            'alert_facts' => Notifier::facts(),
        ];
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        $values = [
            'LEGEND_THEME_ALERT_EVERY' => Clean::oneOf(
                $data['alert_every'] ?? null,
                ['off', 'five', 'fifteen', 'thirty', 'hourly', 'daily'],
                'fifteen',
            ),
            'LEGEND_THEME_ALERT_DISCORD' => ($data['alert_discord'] ?? false) ? 'true' : 'false',
            // A webhook is an address this panel will post its own operational
            // detail to, so it is held to https and to being a URL at all.
            'LEGEND_THEME_ALERT_WEBHOOK' => Clean::url($data['alert_webhook'] ?? null),
            'LEGEND_THEME_ALERT_PANEL' => ($data['alert_panel'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_EMAIL' => Clean::line($data['alert_email'] ?? null),
            'LEGEND_THEME_ALERT_REPEAT' => (string) Clean::clamp($data['alert_repeat'] ?? null, 0, 168, 0),
            'LEGEND_THEME_ALERT_DISK' => (string) Clean::clamp($data['alert_disk'] ?? null, 0, 100, 90),
            'LEGEND_THEME_ALERT_MEMORY' => (string) Clean::clamp($data['alert_memory'] ?? null, 0, 100, 90),
            'LEGEND_THEME_ALERT_MAINTENANCE' => (string) Clean::clamp($data['alert_maintenance_hours'] ?? null, 0, 720, 0),
            'LEGEND_THEME_ALERT_VERSIONS' => ($data['alert_versions'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_WORKER' => ($data['alert_worker'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_FAILED' => ($data['alert_failed'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_BACKUPS' => ($data['alert_backups'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_SCHEDULES' => ($data['alert_schedules'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_UNBUILT' => ($data['alert_unbuilt'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_STOCK' => ($data['alert_stock'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_PORTS' => ($data['alert_ports'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ALERT_MODULES' => ($data['alert_modules'] ?? false) ? 'true' : 'false',
            // Nought is a number rather than an absence: it means say
            // nothing until a package is actually gone.
            'LEGEND_THEME_ALERT_STOCK_LEFT' => (string) Clean::clamp($data['alert_stock_left'] ?? null, 0, 1000, 3),
            'LEGEND_THEME_ALERT_BACKUP_DAYS' => (string) Clean::clamp($data['alert_backup_days'] ?? null, 1, 365, 7),
            'LEGEND_THEME_ALERT_BOT' => ($data['alert_bot'] ?? false) ? 'true' : 'false',
            // https, like the Discord one: this posts which of your machines is
            // down to an address on the internet.
            'LEGEND_THEME_ALERT_BOT_URL' => Clean::url($data['alert_bot_url'] ?? null),
            'LEGEND_THEME_ALERT_BOT_SECRET' => Clean::line($data['alert_bot_secret'] ?? null),
            /*
             * Which of the things that simply happened go out, and nothing is
             * in here to begin with.
             *
             * The other switches in this file store what is off, so a feature
             * added later arrives switched on. This one stores what is on, for
             * the opposite reason: an address that has been posting outages for
             * a year should not start receiving sales because the plugin
             * updated. A new event name is a new unticked box.
             */
            'LEGEND_THEME_ALERT_FACTS' => Notifier::sanitise((array) ($data['alert_facts'] ?? [])),
        ];

        /*
         * An empty credential is one nobody retyped, not one somebody cleared.
         *
         * read() never hands the stored value to the form, so every save that
         * did not touch these fields sends them back empty - and writing that
         * would wipe the webhook and the secret on every save of an unrelated
         * threshold. Left out, the line in .env stays as it is. Switching the
         * channel off is how one stops being used. Something typed is still
         * cleaned above, as it always was.
         */
        foreach (self::SECRETS as $key => $env) {
            if (trim((string) ($data[$key] ?? '')) === '') {
                unset($values[$env]);
            }
        }

        (new self())->writeToEnvironment($values);
    }
}
