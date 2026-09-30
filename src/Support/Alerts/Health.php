<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Saved\Alerts as SavedAlerts;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Whether the watchdog is switched on and still unable to tell anybody.
 *
 * It is the part of this plugin most easily left on and doing nothing: its
 * interval can be Off, and every way it has of telling somebody can be empty or
 * broken, and nothing anywhere says so until the outage it was meant to report.
 * The channel rows on the Alerts page only answer once something has been sent,
 * and on a panel in this state nothing ever is.
 *
 * Read from the settings only. No address is tried here; that is what the Test
 * buttons on the same page are for, and a page that posted to Discord every
 * time it was opened would be a worse problem than the one it reports.
 *
 * Not on the module card. Modules::waitingFor() is one quiet "on, and showing
 * nothing yet" per feature, counted into the card's health line and into the
 * watchdog's own module check. These are warnings, several of them can be true
 * at once, and a watchdog reporting through that check that it cannot report
 * is not a message anybody receives.
 */
class Health
{
    /**
     * What is wrong, as sentences, in the order worth fixing them.
     *
     * @return array<int, string>
     */
    public static function notes(): array
    {
        $notes = [];

        try {
            $on = Features::enabled(Features::ALERTS);

            // The same two questions Schedule::register() asks before it puts
            // the watchdog on the schedule at all.
            $watching = $on && (string) Theme::config('alert_every', 'fifteen') !== 'off';

            if ($on && !$watching) {
                $notes[] = Theme::trans('alerts.health_interval_off');
            }

            if ($watching) {
                array_push($notes, ...self::channels());
            }

            // Owners are told by the watchdog's node check and by nothing else,
            // so a watchdog that never runs tells them nothing either.
            if (Owners::enabled() && !$watching) {
                $notes[] = Theme::trans('alerts.health_owners_unwatched');
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return $notes;
    }

    /**
     * Whether the watchdog has anywhere to say what it found.
     *
     * Each channel is held to what Notifier itself will refuse to send to, so
     * a working address is never warned about. Email has a second way to fail
     * that Notifier cannot see: a panel whose mailer is `log` or `array`
     * accepts every message and delivers none of them.
     *
     * @return array<int, string>
     */
    private static function channels(): array
    {
        $on = array_filter(Notifier::CHANNELS, static fn (string $channel): bool => Notifier::enabled($channel));

        if ($on === []) {
            return [Theme::trans('alerts.health_no_channel')];
        }

        $notes = [];

        if (Notifier::enabled(Notifier::DISCORD) && Notifier::webhook() === null) {
            $notes[] = Theme::trans('alerts.health_discord');
        }

        if (Notifier::enabled(Notifier::BOT)
            && (Notifier::botUrl() === null || !SavedAlerts::hasSecret('alert_bot_secret'))) {
            $notes[] = Theme::trans('alerts.health_bot');
        }

        if (Notifier::enabled(Notifier::EMAIL)
            && (Notifier::recipients() === [] || in_array((string) config('mail.default'), ['log', 'array'], true))) {
            $notes[] = Theme::trans('alerts.health_email');
        }

        return $notes;
    }
}
