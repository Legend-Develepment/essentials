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

    /**
     * A signed webhook of your own, for something that is not Discord.
     *
     * The watchdog already knows a node has stopped answering; without this, a
     * bot can only find that out by asking every minute - which is a poll
     * against the panel to learn something the panel worked out an hour ago.
     * Pelican's own webhooks cannot carry it either: they fire on models and on
     * the activity log, and "the node is not answering" writes neither.
     */
    public const BOT = 'bot';

    public const CHANNELS = [self::DISCORD, self::PANEL, self::EMAIL, self::BOT];

    /**
     * The things that simply happened, and what each one means.
     *
     * Everything this class sent before today was a fault: a node that stopped
     * answering, a disk line crossed, backups that went stale. A bot that wants
     * to say "your server is ready" or "somebody just bought a package" could
     * not be told, and had to poll the API and diff the answer against what it
     * saw last - which is how a bot ends up announcing an order four minutes
     * late and twice.
     *
     * Kept here rather than in the documentation because this is what sends
     * them, and a list of event names that the sender does not read is a list
     * that drifts. Docs::webhook() reads this one.
     *
     * **The names are the contract.** Renaming one breaks every receiver that
     * branches on it, so they are chosen once. The English beside each is a
     * description rather than a translated label, for the reason the settings
     * page gives: `shop.paid` is `shop.paid` in every language, and the person
     * reading this list is writing a receiver.
     *
     * @var array<string, string>
     */
    public const FACTS = [
        'shop.paid' => 'An invoice was paid, however it was paid.',
        'shop.built' => 'A server somebody ordered finished building.',
        'shop.failed' => 'A server somebody ordered could not be built.',
        'service.due' => 'A renewal notice went out to a customer.',
        'service.suspended' => 'A service was suspended for not being paid.',
        'ticket.said' => 'Somebody wrote in a ticket, asking or answering.',
    ];

    private const FILE = 'legend-theme/alerts/channels.json';

    /** Discord's own cap on an embed description. Cut here rather than refused there. */
    private const MAX_BODY = 3800;

    /** @var array<string, array{at: int, ok: bool, why: string}>|null */
    private static ?array $outcomes = null;

    /**
     * Forget the delivery outcomes this process read.
     *
     * The file is written by whichever process last sent something, and this
     * class both answers from its copy and writes its copy back. A worker that
     * kept one for hours would quietly revert every row another process wrote
     * in the meantime, so a new piece of work starts by dropping it.
     */
    public static function forget(): void
    {
        self::$outcomes = null;
    }

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
    public static function send(
        string $title,
        string $body,
        bool $good = false,
        array $about = [],
    ): array {
        $done = [];

        foreach (self::CHANNELS as $channel) {
            if (!self::enabled($channel)) {
                continue;
            }

            $done[$channel] = self::to($channel, $title, $body, $good, $about);
        }

        return $done;
    }

    /**
     * Tell a bot that something happened.
     *
     * Not send(), and the difference is the whole of this method. send() fans
     * out to every switched-on channel, so a paid invoice would post a Discord
     * embed, bell every administrator holding the alerts permission, and send
     * an email - for a thing that is not wrong. A panel that wired up alerts to
     * hear about dead nodes did not ask to be emailed about every sale.
     *
     * So a fact goes to the bot and nowhere else. The bot is the one channel
     * that is a program rather than a person, and a program is what wants this.
     *
     * **Off unless somebody asked for it.** Every name in FACTS starts
     * unticked, so a panel that installs this release sends exactly what it
     * sent before. That is the opposite of how the feature switches work, and
     * deliberately: an address that has been posting outages for a year should
     * not start receiving sales because the plugin updated.
     *
     * Answers false when it was not sent, including when nobody asked for it,
     * because every caller treats this the same way: it is an announcement, and
     * an announcement that does not go out changes nothing else.
     */
    public static function fact(
        string $event,
        string $title,
        string $body,
        ?array $subject = null,
        bool $good = true,
        string $kind = 'happened',
    ): bool {
        if (!Features::enabled(Features::ALERTS) || !self::wanted($event)) {
            return false;
        }

        return self::to(self::BOT, $title, $body, $good, [
            'event' => $event,
            'class' => 'fact',
            'kind' => $kind,
            'subject' => $subject,
        ]);
    }

    /**
     * Whether this panel asked to hear about this one.
     *
     * A comma-separated list in the environment, like every other list this
     * plugin stores, and an unknown name in it is ignored rather than refused:
     * a panel that ticked an event which a later release renamed should keep
     * working, silently, rather than failing on a name nobody will look at.
     */
    public static function wanted(string $event): bool
    {
        return in_array($event, self::facts(), true);
    }

    /**
     * Which of them this panel asked for.
     *
     * A comma-separated list in the environment, like every other list this
     * plugin stores. An unknown name in it is kept rather than refused: a panel
     * that ticked something a later release renamed should go quiet about it,
     * not break on a string nobody is going to look at.
     *
     * @return array<int, string>
     */
    public static function facts(): array
    {
        $stored = Theme::config('alert_facts', '');

        if (!is_string($stored) || trim($stored) === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $stored))));
    }

    /**
     * The stored form of what somebody ticked.
     *
     * Only names this release knows about survive, which is the opposite of the
     * rule above and deliberate: reading has to tolerate a stale name, and
     * writing has no reason to create one.
     *
     * @param  array<int|string, mixed>  $chosen
     */
    public static function sanitise(array $chosen): string
    {
        $out = [];

        foreach ($chosen as $one) {
            $name = is_string($one) ? trim($one) : '';

            if ($name !== '' && isset(self::FACTS[$name]) && !in_array($name, $out, true)) {
                $out[] = $name;
            }
        }

        return implode(',', $out);
    }

    /**
     * One channel, with the outcome written down either way.
     *
     * @return bool  whether it was delivered
     */
    public static function to(
        string $channel,
        string $title,
        string $body,
        bool $good = false,
        array $about = [],
    ): bool {
        try {
            $why = match ($channel) {
                self::DISCORD => self::discord($title, $body, $good),
                self::PANEL => self::panel($title, $body, $good),
                self::EMAIL => self::email($title, $body),
                self::BOT => self::bot($title, $body, $good, $about),
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

    /* --------------------------------------------------------------- a bot -- */

    /**
     * One JSON POST, signed, to an address somebody typed.
     *
     * **Signed rather than trusted.** The receiver is a bot on somebody else's
     * host, and an unsigned webhook is an address anybody who learns it can
     * post to - which for this payload means anybody can tell a Discord server
     * that a node is down. The body is hashed with a shared secret and the hash
     * travels in a header, so the bot can refuse anything it did not come from
     * this panel. Without a secret nothing is sent at all: a signature that is
     * optional is a signature nobody checks.
     *
     * The payload is deliberately small and stable - what happened, whether it
     * is good news, and which panel said so. A bot that wants detail asks the
     * API for it, which is what the API is for.
     *
     * @return string|null  null when it went, otherwise why not
     */
    private static function bot(string $title, string $body, bool $good, array $about = []): ?string
    {
        $url = self::botUrl();

        if ($url === null) {
            return 'no address, or not https';
        }

        $secret = trim((string) Theme::config('alert_bot_secret', ''));

        if ($secret === '') {
            return 'no signing secret';
        }

        try {
            /*
             * What happened, beside what to say about it.
             *
             * `title` and `body` are sentences, and translated ones: a receiver
             * given only those can repost the text and nothing else. It cannot
             * ping the operations role for a dead node and stay quiet for a
             * stale backup, because it cannot tell the two apart - and a bot
             * that has to match on a translated sentence is a bot that breaks
             * the day somebody changes a word.
             *
             * The vocabulary already existed, one layer up: the watchdog keys
             * every check `node.reachable`, `panel.worker`, `backups.none`,
             * `schedules.stopped`. It simply never left the building.
             *
             * The five fields that were here are unchanged and in the same
             * place, so a receiver written against the old shape keeps working.
             * The three new ones are additions:
             *
             *   event    the dotted name, with any id lifted out of it
             *   kind     raised, reminder or cleared
             *   subject  what it is about, where the name said so
             */
            $payload = json_encode([
                'panel' => (string) config('app.name', 'Pelican'),
                'title' => $title,
                'body' => $body,
                'good' => $good,
                'at' => now()->toIso8601String(),
            ] + self::about($about), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            if ($payload === false) {
                return 'could not be encoded';
            }

            $reply = Http::timeout(10)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    // sha256=<hex>, the shape every webhook receiver already
                    // knows how to read, so nobody has to invent a parser.
                    'X-Essentials-Signature' => 'sha256=' . hash_hmac('sha256', $payload, $secret),
                ])
                ->withBody($payload, 'application/json')
                ->post($url);

            return $reply->successful() ? null : 'refused it: ' . $reply->status();
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * A watchdog key, as an event name and what it is about.
     *
     * The keys carry an id in the middle where the check is about one thing -
     * `node.12.reachable` - because they are also the memo that remembers
     * whether that node was already down. An event name must not: a receiver
     * matching on `node.12.reachable` would have to know every node id in
     * advance, which is the opposite of a name.
     *
     * So a numeric middle segment is lifted out into `subject`, and everything
     * else is left exactly as the watchdog wrote it.
     *
     * @param  array{key?: string, kind?: string}  $about
     * @return array<string, mixed>
     */
    private static function about(array $about): array
    {
        $key = trim((string) ($about['key'] ?? ''));
        $event = trim((string) ($about['event'] ?? ''));
        $kind = trim((string) ($about['kind'] ?? ''));
        $subject = is_array($about['subject'] ?? null) ? $about['subject'] : null;

        /*
         * Two ways in, because two callers name things differently.
         *
         * The watchdog keys every check `node.3.reachable`, and that convention
         * predates this method - so it is split here rather than at forty call
         * sites. Anything announcing a fact says what it means instead, because
         * the id it carries is rarely of the same type as the first word:
         * `shop.paid` is about an invoice, and a key would have made its
         * subject type "shop".
         */
        if ($event === '') {
            if ($key === '') {
                return [];
            }

            $parts = explode('.', $key);

            foreach ($parts as $at => $part) {
                if ($at > 0 && ctype_digit($part)) {
                    $subject = ['type' => $parts[0], 'id' => (int) $part];

                    unset($parts[$at]);

                    break;
                }
            }

            $event = implode('.', $parts);
        }

        return [
            'event' => $event,
            'kind' => $kind === '' ? 'raised' : $kind,
            /*
             * Which of the two kinds of message this is.
             *
             * `good` cannot answer it. It means "the all-clear rather than the
             * alarm", which says nothing about an event that was never an alarm
             * - a receiver branching on it gets `shop.paid` wrong, because a
             * sale is neither a fault nor the end of one. So an alarm says so,
             * a fact says so, and `good` keeps the meaning it always had for
             * the alarms.
             */
            'class' => ($about['class'] ?? '') === 'fact' ? 'fact' : 'alarm',
            'subject' => $subject,
        ];
    }

    /**
     * Held to https, for the same reason the Discord one is: this posts which
     * of your machines is down to an address on the internet.
     */
    public static function botUrl(): ?string
    {
        $url = trim((string) Theme::config('alert_bot_url', ''));

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
                // Either half: being told is a kind of being shown, and
                // somebody trusted to read the watchdog should hear from it.
                static fn (User $user): bool => $user->can(Theme::PERMISSION_VIEW)
                    || $user->can(Features::permission(Features::ALERTS))
                    || $user->can(Features::viewPermission(Features::ALERTS)),
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
