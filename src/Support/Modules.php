<?php

namespace LegendDevelopment\Theme\Support;

use LegendDevelopment\Theme\Support\Access\RoleServers;
use LegendDevelopment\Theme\Support\Api\Connections;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Api\Writes;
use LegendDevelopment\Theme\Support\Shop\Tables as ShopTables;
use LegendDevelopment\Theme\Support\Status\Publish;
use LegendDevelopment\Theme\Support\Tickets\Tables as TicketTables;
use Throwable;

/**
 * The fifty-five switches, grouped into the seven things they are actually for.
 *
 * A flat list of fifty-five checkboxes sorted by translated label is a list
 * nobody reads. It was seven when that list was designed, and the comment above
 * it still reasoned about seven. Somebody installing this plugin to restyle
 * their panel has to find, among "Alerts", "Announcements", "API", "Backups
 * overview", "Console button", "Coupons", which of those is a webshop.
 *
 * This is the grouping, and nothing else. **It holds no state**: what is on is
 * still `Features::disabled()` and one list in `.env`, because two places that
 * both remember which parts are on is one place that can be wrong. A module is
 * on when everything in it is on, off when none of it is, and part-way in
 * between, and all three are computed from the same answer as before.
 *
 * Three things a module says that a checkbox cannot:
 *
 * **What it needs.** Some of these do nothing at all without another one, and
 * the switch does not say so. The public shop needs the shop. The waiting list
 * needs the shop. Telling server owners their node is down needs the watchdog
 * that notices. Turning one of those on without the other is a switch that
 * reads as on and changes nothing.
 *
 * **What it lessens.** Weaker than needing, and worth its own word. The backup
 * warning on somebody's own server list draws from two halves, and one of them
 * is switched off by an administrator's schedules page - so turning off an admin
 * overview quietly halves a customer-facing warning. Neither helper mentions the
 * other today.
 *
 * **What it is still waiting for.** Seven of these arrive switched on and draw
 * nothing until a list somewhere is filled in: the Minecraft pages need eggs
 * named, the public status page needs something published, telling owners needs
 * its own second switch on the alerts page. A tick that means "on, and doing
 * nothing" is the least honest thing on that page.
 */
class Modules
{
    /** How the panel looks, and the pages for changing that. */
    public const APPEARANCE = 'appearance';

    /** Things about a server, on the pages where a server is. */
    public const SERVERS = 'servers';

    /** Running the panel: what is full, what stopped, what happened. */
    public const PANEL = 'panel';

    /** Telling somebody when one of those goes wrong. */
    public const ALERTS = 'alerts';

    /** Selling what the panel runs. */
    public const SHOP = 'shop';

    /** Answering the people who bought it. */
    public const SUPPORT = 'support';

    /** Anything reachable from outside the panel, or that keeps files elsewhere. */
    public const OUTSIDE = 'outside';

    /**
     * Every module, in the order they are offered.
     *
     * Written down rather than sorted, unlike the feature list: this order is an
     * argument. What the panel looks like first, because that is what most
     * people install this for; the things that reach outside last, because they
     * are the ones worth thinking about before saying yes.
     */
    public const ALL = [
        self::APPEARANCE,
        self::SERVERS,
        self::PANEL,
        self::ALERTS,
        self::SUPPORT,
        self::SHOP,
        self::OUTSIDE,
    ];

    /**
     * What a panel does not get merely by installing this.
     *
     * The list of what is switched off cannot tell an administrator who wanted
     * everything from one who has never been asked: both are empty. So the
     * answer is written down once, at the first install, and these four are the
     * ones written down as off.
     *
     * The rule behind the choice, and it is the same rule in all four cases:
     * anything that takes money, speaks to somebody outside the panel, or opens
     * an address the public can reach is off until a person says otherwise.
     * Selling is the obvious one. A watchdog mails and posts to Discord on a
     * timer whether anybody asked. A ticket desk puts a table in front of
     * somebody who has to answer it. An API key and a public status page are
     * doors, and a door nobody decided to open is the kind of thing found later
     * by somebody else.
     *
     * The other three arrive on, because they are what this plugin is: how the
     * panel looks, what a server shows, and what is full or stopped.
     */
    public const QUIET = [
        self::ALERTS,
        self::SUPPORT,
        self::SHOP,
        self::OUTSIDE,
    ];

    /**
     * Which module each feature belongs to.
     *
     * Every one of the fifty-five is here exactly once; tools/check-modules.js
     * refuses a feature that is in none or in two, because a feature in none is
     * one the page would silently not offer.
     *
     * @var array<string, array<int, string>>
     */
    private const HOLDS = [
        self::APPEARANCE => [
            Features::LOOK,
            Features::PAGES,
            Features::ADVANCED,
            Features::ANNOUNCEMENTS,
            Features::NAV_LINKS,
            Features::LOGIN,
            Features::BARS,
            Features::SIDEBAR_FOOTER,
            Features::SETTINGS_SEARCH,
            Features::PREVIEW,
            Features::SCHEDULED,
            Features::USER_THEMES,
            Features::ARRANGER,
            Features::LANGUAGES,
            // Beside the languages, because it is the same question asked of
            // Pelican's pages rather than of this plugin's.
            Features::PELICAN_STRINGS,
        ],

        self::SERVERS => [
            Features::DUPLICATE,
            Features::FAVOURITES,
            Features::QUICK,
            Features::CONSOLE,
            Features::MY_BACKUPS,
            Features::ARTWORK,
            Features::ACCESS,
            Features::MINECRAFT,
            Features::PALWORLD,
            Features::GAMES,
            Features::GAME_PLAYERS,
        ],

        self::PANEL => [
            Features::DASHBOARD_STATUS,
            Features::DASHBOARD_NODES,
            Features::SYSTEM_STATUS,
            Features::BACKUPS,
            Features::SCHEDULES,
            Features::CAPACITY,
            Features::ACTIVITY,
            Features::LOG_CLOCK,
        ],

        self::ALERTS => [
            Features::ALERTS,
            Features::OWNER_ALERTS,
        ],

        self::SUPPORT => [
            Features::TICKETS,
        ],

        self::SHOP => [
            Features::SHOP,
            Features::PACKAGES,
            Features::ORDERS,
            Features::INVOICES,
            Features::PAYMENTS,
            Features::COUPONS,
            Features::CUSTOMERS,
            Features::CREDIT,
            Features::UPGRADES,
            Features::ADDONS,
            Features::OVERVIEW,
            Features::TERMINATE,
            Features::WAITLIST,
            Features::PUBLIC_SHOP,
        ],

        self::OUTSIDE => [
            Features::API,
            Features::PUBLIC_STATUS,
            Features::FILES,
        ],
    ];

    /**
     * What a feature does nothing at all without.
     *
     * Checked in the code rather than guessed at. The shop ones are the tables:
     * every shop page asks Tables::ready() and the tables belong to the shop.
     * The waiting list reads them too. Telling owners runs from inside the
     * watchdog's node check, so without the watchdog nothing ever calls it.
     *
     * The Favourites page used to be here, gated on the go-to menu rather than
     * on the star: switching the menu off took the page with it while the stars
     * stayed. That was a crooked wire rather than a need, so it was
     * straightened instead of written down.
     *
     * @var array<string, array<int, string>>
     */
    private const NEEDS = [
        Features::PUBLIC_SHOP => [Features::SHOP],
        Features::WAITLIST => [Features::SHOP],
        Features::OWNER_ALERTS => [Features::ALERTS],
    ];

    /**
     * What a feature does less without, which is a different sentence.
     *
     * The warning above somebody's own server list is built from two halves, and
     * Attention::schedules() answers with nothing when the schedules page is
     * switched off. So an administrator turning off an overview they never look
     * at makes a customer-facing warning quieter, and nothing anywhere says so.
     *
     * @var array<string, array<int, string>>
     */
    private const LESSENS = [
        Features::MY_BACKUPS => [Features::SCHEDULES],
    ];

    /** A module holds all of its features, some of them, or none. */
    public const ON = 'on';

    public const PART = 'part';

    public const OFF = 'off';

    /**
     * Which module a feature is in, or null if somebody has added one and not
     * put it anywhere.
     */
    public static function of(string $feature): ?string
    {
        foreach (self::HOLDS as $module => $features) {
            if (in_array($feature, $features, true)) {
                return $module;
            }
        }

        return null;
    }

    /**
     * What a module holds.
     *
     * @return array<int, string>
     */
    public static function holds(string $module): array
    {
        return self::HOLDS[$module] ?? [];
    }

    /**
     * Make what the modules that are on need, and nothing for the ones that are off.
     *
     * Three of the seven own tables, and every panel got all of them on the day
     * it installed this plugin: a panel that has never sold anything has the
     * shop's five tables, its invoices, its orders and its coupons, because
     * installing was the only moment anybody thought to make them. That was
     * defensible while everything arrived switched on. It stopped being
     * defensible the moment a fresh panel started with four modules off.
     *
     * So the tables arrive with the module. Called at install for whatever is
     * on, and again whenever the switches change, which also means a panel that
     * somehow has a module on without its tables gets them on the next save
     * rather than staying half-offered for ever.
     *
     * Off is the only state that skips. Part-way counts as on: one feature out
     * of fourteen still needs somewhere to put what it writes.
     *
     * **Nothing is ever dropped here.** Switching a module off leaves every
     * table exactly where it is, with everything in it, which is what somebody
     * switching the shop off for a fortnight expects and what nobody should
     * have to find out by trying.
     */
    public static function arrive(bool $thorough = false): void
    {
        foreach (self::ALL as $module) {
            if (self::state($module) === self::OFF) {
                continue;
            }

            /*
             * A save is not an install, and asking the database about
             * seventeen tables is not free: it was seventy-five queries and
             * sixty milliseconds on a panel where every one of them already
             * exists. ready() answers that from the panel's own cache, so a
             * save where nothing is missing costs a cache read per module.
             *
             * The thorough pass is for the two places that are an install:
             * there, install() is also what adds a column a later release
             * wants, and skipping it because the table exists would make that
             * column arrive a release late - which is the exact fault the note
             * on InstallTasks::schema() was written about.
             */
            if (!$thorough && self::stocked($module)) {
                continue;
            }

            try {
                match ($module) {
                    self::SHOP => ShopTables::install(),
                    self::SUPPORT => TicketTables::install(),
                    self::OUTSIDE => self::outside(),
                    default => null,
                };
            } catch (Throwable $exception) {
                /*
                 * One module's tables are not worth failing a save or an
                 * install over. The page that needs them asks whether they are
                 * there before it offers itself, so the honest outcome is that
                 * this part is not offered yet - and the next save tries again.
                 */
                report($exception);
            }
        }
    }

    /** Whether this module already has everything it needs. */
    private static function stocked(string $module): bool
    {
        try {
            return match ($module) {
                self::SHOP => ShopTables::ready(),
                self::SUPPORT => TicketTables::ready(),
                self::OUTSIDE => Keys::ready(),
                default => true,
            };
        } catch (Throwable) {
            // Not knowing is a reason to look, not a reason to skip.
            return false;
        }
    }

    /** The API's key table, its columns, and the connections that use them. */
    private static function outside(): void
    {
        Keys::install();
        Keys::upgrade();
        Writes::install();
        Connections::install();
    }

    /**
     * Everything inside the modules a fresh panel leaves off.
     *
     * @return array<int, string>
     */
    public static function quietStart(): array
    {
        $features = [];

        foreach (self::QUIET as $module) {
            $features = array_merge($features, self::holds($module));
        }

        return $features;
    }

    /**
     * The three shapes a panel is asked to choose between at the first install.
     *
     * Not seven questions. Somebody who has just installed this has no way to
     * answer "do you want the activity log", and a page of fourteen switches is
     * the thing the modules page exists to stop being the first thing anybody
     * sees. Three answers that a person actually has an opinion about, and
     * every switch stays theirs afterwards.
     */
    public const SHAPES = [
        // What most panels install this for, and nothing that acts on its own.
        'look' => [self::APPEARANCE],

        // A panel somebody runs servers on: what a server shows and what is
        // full or stopped, and still nothing that sells or speaks outside.
        'run' => [self::APPEARANCE, self::SERVERS, self::PANEL],

        // And a panel that sells: everything, because a shop without somewhere
        // to answer questions and nothing watching the nodes is half a shop.
        'sell' => [
            self::APPEARANCE,
            self::SERVERS,
            self::PANEL,
            self::ALERTS,
            self::SUPPORT,
            self::SHOP,
            self::OUTSIDE,
        ],
    ];

    /**
     * Whether this panel should be asked what it is for.
     *
     * Only a panel that had never seen this plugin when it was installed, and
     * only until somebody answers or waves it away. A panel that was already
     * running keeps what it had and is never offered the question: acting on
     * "what is this panel for" where the answer is already a year of orders is
     * a way to switch off a shop somebody is using.
     */
    public static function askFirst(): bool
    {
        try {
            return (bool) Theme::config('modules_fresh', false)
                && !(bool) Theme::config('modules_asked', false);
        } catch (Throwable) {
            // Not knowing is a reason to say nothing, not a reason to ask.
            return false;
        }
    }

    /**
     * What switching to one of those shapes would change.
     *
     * Every feature in the modules that shape holds goes on, every feature in
     * the ones it does not goes off. Returned rather than written, because the
     * page that offers this is the one that should say what it is about to do.
     *
     * @return array<string, bool>
     */
    public static function shape(string $shape): array
    {
        $wanted = self::SHAPES[$shape] ?? null;

        if ($wanted === null) {
            return [];
        }

        $changes = [];

        foreach (self::ALL as $module) {
            $on = in_array($module, $wanted, true);

            foreach (self::holds($module) as $feature) {
                $changes[$feature] = $on;
            }
        }

        return $changes;
    }

    /**
     * Whether this module is doing what it says, or only switched on.
     *
     * A state of "on" is a promise about what was decided, not about what
     * happens. Seven of the fifty-five arrive switched on and draw nothing at
     * all until a list somewhere is filled in - the Minecraft pages need eggs
     * named, telling server owners needs its own second switch - and a module
     * can hold a part that needs another part somebody turned off. Both read as
     * on, and the page said so.
     *
     * Three numbers rather than a verdict, because the page has to say which
     * and how many, and a word like "degraded" answers neither. Nothing here
     * asks the daemon or the network: it is the same three questions the cards
     * already answer per part, counted for the module.
     *
     * @return array{waiting: int, missing: int, ready: bool}
     */
    public static function health(string $module): array
    {
        $waiting = 0;
        $missing = 0;

        foreach (self::holds($module) as $feature) {
            if (!Features::enabled($feature)) {
                continue;
            }

            if (self::waitingFor($feature) !== null) {
                $waiting++;
            }

            if (self::missing($feature) !== []) {
                $missing++;
            }
        }

        return [
            'waiting' => $waiting,
            'missing' => $missing,

            // A module that is off needs nothing, so nothing is what it is
            // short of: asking the database about tables it does not use would
            // be a query per card for an answer nobody reads.
            'ready' => self::state($module) === self::OFF || self::stocked($module),
        ];
    }

    /**
     * On, off, or part-way.
     *
     * Read from Features every time rather than remembered. There is one record
     * of what is switched on and this is not it.
     */
    public static function state(string $module): string
    {
        $features = self::holds($module);

        if ($features === []) {
            return self::OFF;
        }

        $on = 0;

        foreach ($features as $feature) {
            if (Features::enabled($feature)) {
                $on++;
            }
        }

        if ($on === 0) {
            return self::OFF;
        }

        return $on === count($features) ? self::ON : self::PART;
    }

    /**
     * How many of a module's features are on, and how many there are.
     *
     * @return array{on: int, of: int}
     */
    public static function counted(string $module): array
    {
        $features = self::holds($module);
        $on = 0;

        foreach ($features as $feature) {
            if (Features::enabled($feature)) {
                $on++;
            }
        }

        return ['on' => $on, 'of' => count($features)];
    }

    /**
     * What this feature needs that is currently switched off.
     *
     * Empty when it has everything it needs, which is the ordinary answer.
     *
     * @return array<int, string>
     */
    public static function missing(string $feature): array
    {
        return array_values(array_filter(
            self::NEEDS[$feature] ?? [],
            static fn (string $needed): bool => !Features::enabled($needed),
        ));
    }

    /**
     * What this feature would do more with, that is currently switched off.
     *
     * @return array<int, string>
     */
    public static function quieter(string $feature): array
    {
        return array_values(array_filter(
            self::LESSENS[$feature] ?? [],
            static fn (string $needed): bool => !Features::enabled($needed),
        ));
    }

    /**
     * Everything that has to go on with this one for it to do anything.
     *
     * Followed rather than looked up once, because a need can have a need:
     * the public shop needs the shop, and were the shop ever to need something
     * itself, switching on the public shop would have to bring that too.
     *
     * @return array<int, string>
     */
    public static function alsoNeeded(string $feature): array
    {
        $found = [];
        $queue = self::NEEDS[$feature] ?? [];

        while ($queue !== []) {
            $next = array_shift($queue);

            if (in_array($next, $found, true) || $next === $feature) {
                continue;
            }

            $found[] = $next;
            $queue = array_merge($queue, self::NEEDS[$next] ?? []);
        }

        return $found;
    }

    /**
     * What a feature is still waiting for before it draws anything.
     *
     * A key into `settings.waiting.*`, or null when it is doing its job. These
     * are the seven that arrive switched on and show nothing: a page whose egg
     * list is empty appears on no server, a status page with nothing published
     * answers 404, and a tick that means "on, and doing nothing" is the least
     * honest thing on the settings page.
     *
     * Answered from configuration only. Anything needing a query belongs on the
     * page that draws it, not on a list of switches.
     */
    public static function waitingFor(string $feature): ?string
    {
        if (!Features::enabled($feature)) {
            return null;
        }

        try {
            return match ($feature) {
                Features::MINECRAFT => self::listed('minecraft_eggs') ? null : 'eggs',
                Features::GAME_PLAYERS => self::listed('query_eggs') ? null : 'eggs',
                Features::GAMES => self::listed('ark_eggs') || self::listed('terraria_eggs') || self::listed('vrising_eggs') || self::listed('enshrouded_eggs') || self::listed('satisfactory_eggs') || self::listed('factorio_eggs') || self::listed('dontstarve_eggs') || self::listed('onset_eggs') || self::listed('craftopia_eggs') || self::listed('valheim_eggs') ? null : 'eggs',
                Features::USER_THEMES => self::listed('user_themes') ? null : 'styles',
                Features::ACCESS => RoleServers::rows() === [] ? 'granted' : null,
                Features::FILES => ((string) Theme::config('files_where', 'panel')) === 'panel' ? 'store' : null,

                /*
                 * The seventh, which three comments promised and this did not
                 * have. Publish::enabled() is the switch *and* something being
                 * on the page, so a panel that turned this on and picked no
                 * servers, nodes or monitors has a public address that answers
                 * 404 - while the card beside it called the module healthy.
                 *
                 * Asked through Publish rather than by reading the three
                 * settings here, because which lists count is that class's
                 * business and it already had to grow once: it asked only
                 * about the servers, and a panel with a machine and two
                 * monitors on it was told it was serving nothing.
                 */
                Features::PUBLIC_STATUS => Publish::published() ? null : 'shown',
                default => null,
            };
        } catch (Throwable) {
            // A reading that will not answer is not a promise this can keep, so
            // it says nothing rather than guessing at a warning.
            return null;
        }
    }

    /**
     * When a module does its work, which is the question somebody weighing one
     * up actually has.
     *
     * Three answers and no more. "Only when you open it" means a page nobody
     * visits costs nothing at all; "on a timer" means it runs whether anybody
     * is looking or not, which is the one worth knowing before switching it on;
     * "on every page" means every reader pays for it on every request.
     */
    public static function cost(string $module): string
    {
        return match (true) {
            $module === self::APPEARANCE => 'page',
            in_array($module, [self::ALERTS, self::SUPPORT, self::SHOP, self::OUTSIDE], true) => 'timer',

            /*
             * Servers is the one that depends on what is on inside it.
             *
             * Ten of its eleven parts wait to be opened. The stars do not: the
             * list of what somebody starred is handed over in the first
             * response of every page, because a star that appears a moment
             * after the card does is worse than the read. So the card said
             * "only when you open it" about a module that was reading a file on
             * every page of the panel, which is the sort of small untruth this
             * whole page exists to stop telling.
             */
            $module === self::SERVERS => Features::enabled(Features::FAVOURITES) ? 'page' : 'opened',

            // And running the panel, for the same reason: its overviews wait to
            // be opened, but the log's clock is set as every request starts.
            $module === self::PANEL => Features::enabled(Features::LOG_CLOCK) ? 'page' : 'opened',

            default => 'opened',
        };
    }

    /** Whether a comma separated setting holds anything at all. */
    private static function listed(string $key): bool
    {
        $value = Theme::config($key, '');

        if (is_array($value)) {
            return $value !== [];
        }

        return trim((string) $value) !== '';
    }
}
