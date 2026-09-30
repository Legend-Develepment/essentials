<?php

namespace LegendDevelopment\Theme\Support;

use DateTimeZone;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Throwable;

/**
 * The panel's log, written in the server's own time.
 *
 * Pelican keeps the application on UTC on purpose - config/app.php names it
 * outright and ignores APP_TIMEZONE - because everything in the database is
 * stored in UTC and each account shows it in its own timezone. That is right
 * for the data and wrong for the log: an administrator reading storage/logs
 * beside nginx's log and the journal, both in local time, finds every panel
 * line two hours out and has to do the arithmetic to line an error up with the
 * request that caused it.
 *
 * So only the log's clock moves. Monolog stamps each record with its own
 * timezone, so setting that on the logger changes what is written and nothing
 * else: no stored time, no schedule, no page is affected.
 *
 * The zone is the server's own, read from where the system keeps it, rather
 * than a setting here. It is what the rest of the machine logs in, which is the
 * whole point, and a server moved to another zone takes the panel's log with it.
 *
 * Essentials Core does the same thing, so this stands down once Core is
 * running rather than both setting the one clock.
 */
class LogClock
{
    public static function apply(): void
    {
        try {
            if (!Features::enabled(Features::LOG_CLOCK)) {
                return;
            }

            $zone = self::serverZone();

            if ($zone === null) {
                return;
            }

            $logger = Log::driver()->getLogger();

            if ($logger instanceof Logger) {
                $logger->setTimezone(new DateTimeZone($zone));
            }
        } catch (Throwable) {
            // A log in UTC is what Pelican writes anyway.
        }
    }

    /**
     * The zone the operating system is set to, or null where it cannot say.
     *
     * /etc/timezone on Debian and Ubuntu, and the target of /etc/localtime
     * everywhere systemd sets it. Only a name PHP knows is accepted, so a file
     * holding anything else is the same as no file.
     */
    private static function serverZone(): ?string
    {
        $found = null;

        if (is_readable('/etc/timezone')) {
            $found = trim((string) file_get_contents('/etc/timezone'));
        }

        if (($found === null || $found === '') && is_link('/etc/localtime')) {
            $target = (string) readlink('/etc/localtime');
            $at = strpos($target, 'zoneinfo/');
            $found = $at === false ? null : substr($target, $at + strlen('zoneinfo/'));
        }

        return is_string($found) && in_array($found, DateTimeZone::listIdentifiers(), true) ? $found : null;
    }
}
