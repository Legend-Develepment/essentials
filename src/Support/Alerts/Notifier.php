<?php

namespace LegendDevelopment\Theme\Support\Alerts;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Where a watchdog message goes, and whether it got there.
 *
 * Three channels, each switched on separately, because they fail in different
 * ways and no one of them is right on its own:
 *
 *  - **A Discord webhook** is where a message is actually read, at three in the
 *    morning, by somebody who is not looking at the panel. One HTTP request, no
 *    library, no account beyond the one the server already has.
 *  - **In the panel** always works and needs nothing configured. It is also
 *    invisible to anybody who is not signed in, which is most of the time an
 *    alert matters.
 *  - **Email** is reliable when the panel's mailer is set up and completely
 *    silent when it is not - which is exactly the failure a watchdog must not
 *    have. Off by default, and the settings page says why rather than leaving
 *    somebody to find out during an outage.
 *
 * **Every send records its outcome**, and that is not bookkeeping. It is the
 * whole difference between a notifier and a notifier-shaped hole: without it, a
 * webhook URL with a typo in it produces a panel that looks configured, reports
 * nothing, and is indistinguishable from a panel with nothing wrong. The
 * settings page draws the last outcome per channel, and there is a button to
 * send a test, because nobody should discover their URL is wrong from the
 * outage it failed to report.
 */
class Notifier
{
    public const DISCORD = 'discord';

    public const PANEL = 'panel';

    public const EMAIL = 'email';

    public const CHANNELS = [self::DISCORD, self::PANEL, self::EMAIL];

    private const FILE = 'legend-theme/alerts/channels.json';

    /** Discord's own cap on an embed description. Cut here rather than refused there. */
    private const MAX_BODY = 3800;

    /** @var array<string, array{at: int, ok: bool, why: string}>|null */
    private static ?array $outcomes = null;

    /**
     * Send one message everywhere it is wanted.
     *
     * Answers with what each channel did rather than with a single boolean: two
     * channels working and one refusing is the ordinary case on a panel with a
     * mailer nobody finished setting up, and folding that into "false" would
     * report a delivered message as a failure.
     *
     * @return array<string, bool>
     */
    public static function send(string $title, string $body, bool $good = false): array
    {
        $done = [];

        foreach (self::CHANNELS as $channel) {
            if (!self::enabled($channel)) {
                continue;
            }

            $done[$channel] = self::to($channel, $title, $body, $good);
        }

        return $done;
    }

    /**
     * One channel, with the outcome written down either way.
     *
     * @return bool  whether it was delivered
     */
    public static function to(string $channel, string $title, string $body, bool $good = false): bool
    {
        try {
            $why = match ($channel) {
                self::DISCORD => self::discord($title, $body, $good),
                self::PANEL => self::panel($title, $body, $good),
                self::EMAIL => self::email($title, $body),
                default => 'unknown channel',
            };
        } catch (Throwable $exception) {
            $why = $exception->getMessage();
        }

        self::remember($channel, $why);

        return $why === null;
    }

    /* ------------------------------------------------------------ Discord -- */

    /**
     * An embed rather than a line of text.
     *
     * A watchdog message has a colour worth having - a channel where a recovery
     * looks the same as an outage is one that has to be read rather than
     * glanced at - and an embed is the only way to say that in one request. It
     * carries the panel's own name so a shared channel says which panel spoke.
     *
     * @return string|null  null when it went, otherwise why not
     */
    private static function discord(string $title, string $body, bool $good): ?string
    {
        $url = self::webhook();

        if ($url === null) {
            return 'no webhook address';
        }

        try {
            $response = Http::timeout(10)->post($url, [
                'username' => Theme::name(),
                'embeds' => [[
                    'title' => mb_substr($title, 0, 240),
                    'description' => mb_substr($body, 0, self::MAX_BODY),
                    // Discord wants a decimal integer. Amber for a problem,
                    // green for a recovery - the two states this ever sends.
                    'color' => $good ? 3066993 : 15105570,
                    'timestamp' => now()->toIso8601String(),
                    'footer' => ['text' => (string) config('app.name', 'Pelican')],
                ]],
            ]);

            if ($response->successful()) {
                return null;
            }

            /*
             * The status and what Discord said about it.
             *
             * "It failed" sends somebody to look at their firewall. "204
             * expected, 401 Unauthorized" sends them to the URL, which is where
             * the problem nearly always is.
             */
            return $response->status() . ' ' . mb_substr(trim($response->body()), 0, 200);
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * The webhook address, or null.
     *
     * Held to https, and that is not decoration: this is the panel posting its
     * own operational detail to an address somebody typed. Plain http would put
     * which of your nodes is down on the wire in clear text.
     */
    public static function webhook(): ?string
    {
        $url = trim((string) Theme::config('alert_webhook', ''));

        if ($url === '' || !str_starts_with(strtolower($url), 'https://')) {
            return null;
        }

        return filter_var($url, FILTER_VALIDATE_URL) === false ? null : $url;
    }

    /* -------------------------------------------------------- in the panel -- */

    /**
     * To everybody who may see this feature, and nobody else.
     *
     * Not to every administrator: the alerts have their own permission, and
     * somebody who was given the colours of the panel has not been given its
     * outages. Asking the permission rather than a role name means this follows
     * whatever roles a panel actually has.
     *
     * @return string|null
     */
    private static function panel(string $title, string $body, bool $good): ?string
    {
        try {
            $users = User::query()->get()->filter(
                static fn (User $user): bool => $user->can(Theme::PERMISSION_VIEW)
                    || $user->can(Features::permission(Features::ALERTS)),
            );

            if ($users->isEmpty()) {
                return 'nobody holds the permission';
            }

            $notification = Notification::make()->title($title)->body($body);

            ($good ? $notification->success() : $notification->warning())
                ->persistent()
                ->sendToDatabase($users);

            return null;
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /* ------------------------------------------------------------- email --- */

    /**
     * Plain text through the panel's own mailer.
     *
     * Mail::raw rather than a mailable, because a watchdog message is a
     * sentence and a list, and a template would be a second place for the
     * wording to live.
     *
     * @return string|null
     */
    private static function email(string $title, string $body): ?string
    {
        $to = self::recipients();

        if ($to === []) {
            return 'no addresses';
        }

        try {
            Mail::raw($body, static function ($message) use ($to, $title): void {
                $message->to($to)->subject(Theme::name() . ': ' . $title);
            });

            return null;
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * The addresses to write to.
     *
     * Comma separated in one field, each one checked - an address that is not
     * one would otherwise make the whole send throw and take the valid ones
     * with it.
     *
     * @return array<int, string>
     */
    public static function recipients(): array
    {
        $out = [];

        foreach (explode(',', (string) Theme::config('alert_email', '')) as $address) {
            $address = trim($address);

            if ($address !== '' && filter_var($address, FILTER_VALIDATE_EMAIL) !== false) {
                $out[$address] = $address;
            }
        }

        return array_slice(array_values($out), 0, 20);
    }

    /* ---------------------------------------------------------- the record -- */

    public static function enabled(string $channel): bool
    {
        if (!in_array($channel, self::CHANNELS, true)) {
            return false;
        }

        // Email is off unless asked for, because a mailer that is not set up
        // fails silently and a watchdog must not.
        return (bool) Theme::config('alert_' . $channel, $channel === self::PANEL);
    }

    /**
     * What each channel did last time.
     *
     * @return array<string, array{at: int, ok: bool, why: string}>
     */
    public static function outcomes(): array
    {
        if (self::$outcomes !== null) {
            return self::$outcomes;
        }

        self::$outcomes = [];

        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::FILE)) {
                return self::$outcomes;
            }

            $decoded = json_decode((string) $disk->get(self::FILE), true);

            if (!is_array($decoded)) {
                return self::$outcomes;
            }

            foreach ($decoded as $channel => $row) {
                if (!is_string($channel) || !is_array($row)) {
                    continue;
                }

                self::$outcomes[$channel] = [
                    'at' => (int) ($row['at'] ?? 0),
                    'ok' => (bool) ($row['ok'] ?? false),
                    'why' => is_string($row['why'] ?? null) ? $row['why'] : '',
                ];
            }
        } catch (Throwable) {
            // No record is "nothing has been sent yet", which is what the
            // settings page will say.
        }

        return self::$outcomes;
    }

    private static function remember(string $channel, ?string $why): void
    {
        self::$outcomes = self::outcomes();

        self::$outcomes[$channel] = [
            'at' => time(),
            'ok' => $why === null,
            'why' => $why === null ? '' : mb_substr($why, 0, 300),
        ];

        try {
            Storage::disk('local')->put(self::FILE, (string) json_encode(self::$outcomes));
        } catch (Throwable) {
            // The outcome is still true in memory for this request, which is
            // what the test button reads.
        }
    }
}
