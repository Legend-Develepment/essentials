<?php

namespace LegendDevelopment\Theme\Support;

use App\Traits\EnvironmentWriterTrait;
use Throwable;

/**
 * Which parts of the plugin are switched on, and who may see them.
 *
 * This covers what the plugin *adds* to the panel - the pages, the blocks, the
 * announcement bar - and not the styling. The styling has its own off switch
 * and has had one since the first release: Style -> None, which makes the panel
 * render completely untouched. Two switches for one thing is worse than one.
 *
 * What is stored is the list of features that are OFF, not the list that are on,
 * and that is the whole point of the design. A feature added in a later release
 * is absent from everybody's stored list, so it arrives switched on rather than
 * invisible to every panel that saved its settings before it existed. Storing
 * what is on has the opposite behaviour, and it is a quiet one: nothing appears,
 * nothing errors, and the setting that would explain it looks correct.
 */
class Features
{
    use EnvironmentWriterTrait;

    public const LOOK = 'look';

    public const PAGES = 'pages';

    public const ADVANCED = 'advanced';

    public const ANNOUNCEMENTS = 'announcements';

    public const NAV_LINKS = 'nav_links';

    public const LOGIN = 'login';

    public const BARS = 'bars';

    public const DASHBOARD_STATUS = 'dashboard_status';

    public const DASHBOARD_NODES = 'dashboard_nodes';

    public const SYSTEM_STATUS = 'system_status';

    public const SIDEBAR_FOOTER = 'sidebar_footer';

    public const PALWORLD = 'palworld';

    /**
     * The search box above the settings forms.
     *
     * A feature like the others because every part of this plugin can be
     * switched off, including the parts only an administrator ever sees. Its
     * permission is narrower than it looks: the box is only ever drawn on a
     * settings page, which already needs a permission of its own to reach.
     */
    public const SETTINGS_SEARCH = 'settings_search';

    /** The box beside the Look form. See Support\Preview. */
    public const PREVIEW = 'preview';

    /**
     * Making another server like one that already exists.
     *
     * The one feature here that creates something rather than draws something,
     * which is why its permission is worth handing out separately: somebody who
     * should be able to spin up another copy of a bot is not necessarily
     * somebody who should be repainting the panel.
     */
    public const DUPLICATE = 'duplicate';

    /**
     * A star on each server card, kept in the viewer's own browser.
     *
     * Nothing of it reaches the server, so the permission is thinner than the
     * others - it decides whether the panel offers the star at all, not who may
     * see whose. Which server somebody looks at most is theirs.
     */
    public const FAVOURITES = 'favourites';

    /**
     * Minecraft: its own settings tab, and server.properties as a form.
     *
     * A tab of its own rather than a page, because there is more than one
     * Minecraft thing to put in it and a panel with six Minecraft rows in its
     * sidebar is a sidebar about Minecraft.
     */
    public const MINECRAFT = 'minecraft';

    /**
     * One control in the top bar: which server, or which page, next.
     *
     * A convenience rather than a capability, which is why it carries no
     * permission of its own. It searches the list somebody already has - it is
     * accessibleServers() behind it, the same question Pelican's own server
     * list asks - and it opens onto what they starred themselves. Gating it
     * could only ever take away a shortcut to something they may already reach
     * by walking.
     */
    public const QUICK = 'quick';

    /**
     * Game artwork for eggs, fetched from Steam and IGDB.
     *
     * A permission of its own, and one of the clearer cases for one. It writes
     * to every egg on the panel - the picture and two tags - and it makes
     * requests to two services on the panel's own address. Neither is something
     * to hand out with the colour scheme.
     */
    public const ARTWORK = 'artwork';

    /**
     * The watchdog, and where it sends what it finds.
     *
     * Its own permission and firmly a gated one. It reaches every node's daemon
     * on a timer and it posts to an address somebody typed - which of your
     * machines is down, and how full its disk is, going to a webhook. Neither
     * belongs to whoever was given the panel's colours.
     */
    public const ALERTS = 'alerts';

    /**
     * Backups, asked about across the whole panel.
     *
     * Its own permission, and a narrow one: it lists every server somebody can
     * reach along with how long it has gone without a backup, which is a map of
     * where the gaps are. Read only - nothing here makes or deletes one.
     */
    public const BACKUPS = 'backups';

    /**
     * A page outside the login showing which servers are up.
     *
     * The only thing this plugin serves to somebody who is not signed in.
     *
     * Which is why the switch is not what makes it public - what has been put
     * on the page is. Servers, machines and monitors all start empty and
     * Publish::enabled() is false while all three are, so a panel that installs
     * this plugin and changes nothing serves nothing, and the moment anything
     * is served an administrator has named it by hand.
     * The permission governs who may name them; reading the page needs nobody's
     * permission at all, which is the entire point of it.
     */
    public const PUBLIC_STATUS = 'public_status';

    /**
     * Who is on a server, for the games that answer Valve's query.
     *
     * Its own switch rather than riding on the public status page. The two
     * share a list of eggs - one question, asked for two reasons - but they are
     * not one feature, and somebody switching off a page the internet can see
     * should not lose a page inside their own panel with it.
     *
     * No permission, like the Palworld and Minecraft pages: it goes by the
     * subuser permissions of the server it is inside, which is Pelican's answer
     * and already the right one. Seeing who is on a server is not more than
     * seeing its console.
     */
    public const GAME_PLAYERS = 'game_players';

    /**
     * The files two games keep beside their world, as forms.
     *
     * One switch for ARK and Valheim together rather than one each, and the
     * reason is what it turns off. Both are the same page in a different shape
     * - a file the game writes, read into a form and written back without
     * losing the rest of it - and somebody who does not want that does not want
     * it per game. Which servers get it is the egg list on the settings page,
     * and an empty list is already a per-game off switch.
     *
     * Minecraft has one of its own for a reason that is not symmetry: it
     * carries three pages and a live query, and it was here first.
     */
    public const GAMES = 'games';

    /**
     * Servers tied to a role, kept true in Pelican's own subuser table.
     *
     * The one feature here that writes to a table the panel owns, which is why
     * it says so in its own name and why the settings page says it twice. It
     * grants nothing until a mapping exists - the list starts empty, exactly
     * like the status page's does, and an empty list is the whole off switch
     * for a panel that installs this and changes nothing.
     *
     * Switching it off stops the reconciling; it does not take access away.
     * That is deliberate: an off switch that silently removed a hundred
     * people's servers would be a worse switch than one that stops. Taking it
     * back is a button on the page, pressed on purpose.
     */
    public const ACCESS = 'access';

    /**
     * A different look between two times of day.
     *
     * On, but doing nothing: the list of windows starts empty, and an empty
     * list is a panel that draws exactly what it drew before this existed. The
     * switch is here for the panel that wants the section gone from the Look
     * page rather than for the panel that has not used it.
     *
     * It changes nothing that is saved - a window is laid over the settings
     * while the stylesheet is built and released straight after - so switching
     * it off restores the panel's own look immediately and loses nothing.
     */
    public const SCHEDULED = 'scheduled';

    /**
     * Everything that happened on the panel, in one list.
     *
     * Pelican logs it all and shows it only per server, which is the right page
     * for one server and no help for forty. This is the same log asked the
     * other way round, and it is read only - nothing here deletes a line, and
     * how long lines are kept stays Pelican's own setting.
     *
     * Its own permission, because a panel-wide record of who did what is a
     * thing to hand over deliberately rather than something that comes free
     * with the sidebar.
     */
    public const ACTIVITY = 'activity';

    /**
     * Which scheduled task has stopped.
     *
     * The third of the overview pages, and the one whose column is a verdict.
     * Pelican shows schedules per server and its own status has three states -
     * off, processing, active - none of which is "this stopped": a run that
     * crashed part way stays processing for ever and is drawn like one running
     * now. Read only, and its own permission, because a list of every schedule
     * on the panel is a list of what every server is set up to do.
     */
    public const SCHEDULES = 'schedules';

    /**
     * Whether another server fits on a node.
     *
     * Nothing on the panel answers it. Pelican's node list shows a name and a
     * count of servers; the dashboard block here shows live host usage, which
     * is a different question - a node can be twenty percent busy and
     * completely full, because full is about what has been handed out.
     *
     * Its own permission, because a table of what every machine has left is a
     * map of where a panel can and cannot grow.
     */
    public const CAPACITY = 'capacity';

    /**
     * A line above somebody's own server list: which of theirs has no backup.
     *
     * The first thing here built for the person whose servers they are rather
     * than for whoever runs the panel. Pelican's cards say what a server is
     * doing right now; nothing on that page says a backup has not run in three
     * weeks, which is the thing somebody finds out on the day they need one.
     *
     * No permission, and it belongs with the others that have none: it counts
     * backups on servers they can already open, and reaches nothing they could
     * not already reach. A permission on it would take away a warning, not a
     * capability.
     */
    public const MY_BACKUPS = 'my_backups';

    /**
     * Telling somebody their own server's machine has stopped answering.
     *
     * Its own switch on top of the setting on the alerts page, and the doubling
     * is deliberate: this is the only thing in the plugin that writes to people
     * who are not administrators, so switching the whole thing off has to be
     * one action rather than a setting somebody has to find.
     *
     * No permission. It is not a page and nobody administers it from a role -
     * the alerts page already carries the permission that decides who may
     * configure the watchdog at all.
     */
    public const OWNER_ALERTS = 'owner_alerts';

    /**
     * Which languages this plugin will answer in.
     *
     * A feature like the rest, and its off state is meaningful rather than
     * nominal: with this switched off every reader gets English, which is the
     * right answer for a panel whose team works in one language and who would
     * rather not meet a half-translated page because one account is set to
     * something else.
     */
    public const LANGUAGES = 'languages';

    /**
     * A way in from outside the panel.
     *
     * The first feature here that is not a page somebody opens while signed in,
     * and the reason it has a switch like everything else is that a panel which
     * has not asked for an API should not have one listening. Off leaves no
     * route registered at all, rather than a route that answers 403 - a closed
     * door and a locked one are different amounts of surface.
     *
     * **Its permission gates the administration of it, not the asking.** Anyone
     * signed in may request a key for their own servers, because a key that
     * only ever answers what its owner can already see takes nothing away from
     * anybody. Granting one, refusing one, revoking somebody else's and issuing
     * a panel-wide one are the acts that need the permission, and they are all
     * on the admin page. See roadmap/api.md.
     */
    public const API = 'api';

    /**
     * The floating button inside a server: the console, and the power buttons.
     *
     * Its switch used to be a third choice in the shape picker - full, console,
     * off - which meant the one list claiming to hold every switch did not hold
     * this one. Whether it is drawn belongs here with everything else; what
     * shape it takes stays on the settings page, because that is a different
     * question and not a second answer to this one.
     *
     * No permission. It reaches the console and the power buttons of the server
     * somebody is already inside, which are Pelican's own to allow or refuse -
     * a permission here could only take away a shortcut to something they may
     * already do by walking.
     */
    public const CONSOLE = 'console';

    /**
     * Dragging the blocks on a page into the order somebody wants.
     *
     * Also moved from a toggle of its own. It already carries a permission -
     * "arrange", registered in the role editor - so the switch here decides
     * whether the panel offers it at all and the permission decides to whom.
     * That pair is why it is ungated below: a second permission would be a
     * second answer to a question already asked.
     */
    public const ARRANGER = 'arranger';

    /**
     * Letting each person pick a style from the ones offered.
     *
     * Its off state was an empty list of offered styles, which is a real way to
     * switch it off and an invisible one: somebody looking for the switch found
     * a list. The list stays and says *which*; this says *whether*.
     */
    public const USER_THEMES = 'user_themes';

    /**
     * The shop: buying a server from the panel.
     *
     * The master switch for everything a customer touches - the store, the
     * checkout, their billing page - and for the Shop settings page. Off, no
     * customer can buy or pay, and what was already sold is still
     * administered through the pages below, each on its own switch.
     */
    public const SHOP = 'shop';

    /**
     * What is for sale: a server template with a price on it.
     *
     * Its own permission because setting a price is a different job from
     * marking an invoice paid, and a panel may well hand the first to somebody
     * it does not hand the second.
     */
    public const PACKAGES = 'packages';

    /** What was bought, and the server it became. */
    public const ORDERS = 'orders';

    /** What is owed, and marking it paid by hand. */
    public const INVOICES = 'invoices';

    /**
     * The payment providers and every attempt made through them.
     *
     * Gated on its own because it is where the credentials live. Somebody who
     * may see every invoice still may not need to see the Stripe secret.
     */
    public const PAYMENTS = 'payments';

    /** Codes that take something off the first invoice. */
    public const COUPONS = 'coupons';

    /**
     * The people who bought, and what each of them has.
     *
     * Its own permission because it is the one page in the shop that is about
     * a person rather than about a row: somebody trusted to price packages or
     * to mark an invoice paid has no need to read a customer's whole history
     * in one place, and somebody answering support does.
     */
    public const CUSTOMERS = 'customers';

    /**
     * Stopping a service now and removing the server with it.
     *
     * Apart from the orders permission, and that gap is the point. Suspending
     * a server, moving a due date and cancelling an agreement are all
     * reversible; this one deletes somebody's files. The person who answers
     * tickets can have the first three without having the fourth.
     */
    public const TERMINATE = 'terminate';

    /**
     * The page anybody can open, without an account, listing what is for sale.
     *
     * No permission: it publishes nothing a signed-in customer would not see on
     * the store page, and on or off is the whole of the decision. Off answers
     * 404, like the status page does.
     */
    public const PUBLIC_SHOP = 'public_shop';

    /** Every feature, in the order the settings page offers them. */
    public const ALL = [
        self::LOOK,
        self::PAGES,
        self::ADVANCED,
        self::ANNOUNCEMENTS,
        self::NAV_LINKS,
        self::LOGIN,
        self::BARS,
        self::DASHBOARD_STATUS,
        self::DASHBOARD_NODES,
        self::SYSTEM_STATUS,
        self::SIDEBAR_FOOTER,
        self::PALWORLD,
        self::SETTINGS_SEARCH,
        self::PREVIEW,
        self::DUPLICATE,
        self::FAVOURITES,
        self::QUICK,
        self::MINECRAFT,
        self::ARTWORK,
        self::ALERTS,
        self::BACKUPS,
        self::PUBLIC_STATUS,
        self::GAME_PLAYERS,
        self::GAMES,
        self::ACCESS,
        self::SCHEDULED,
        self::ACTIVITY,
        self::SCHEDULES,
        self::CAPACITY,
        self::MY_BACKUPS,
        self::OWNER_ALERTS,
        self::LANGUAGES,
        self::API,
        self::CONSOLE,
        self::ARRANGER,
        self::USER_THEMES,
        self::SHOP,
        self::PACKAGES,
        self::ORDERS,
        self::INVOICES,
        self::PAYMENTS,
        self::COUPONS,
        self::CUSTOMERS,
        self::TERMINATE,
        self::PUBLIC_SHOP,
    ];

    public static function enabled(string $key): bool
    {
        return !in_array($key, self::disabled(), true);
    }

    /**
     * The action half of each feature's permission.
     *
     * One word each, and that is not tidiness. Pelican labels a permission with
     * Str::headline() of this action, and the role editor draws its sections
     * three across the page with the options two across inside that - about
     * sixty pixels per label. "Dashboard Status" in sixty pixels is broken up
     * one letter per line. "Version" fits.
     *
     * They are a map rather than the feature keys themselves because the keys
     * are also config values and translation keys, and those want to stay
     * explicit.
     */
    private const ACTIONS = [
        self::LOOK => 'look',
        self::PAGES => 'pages',
        self::ADVANCED => 'advanced',
        self::ANNOUNCEMENTS => 'notices',
        self::NAV_LINKS => 'links',
        self::LOGIN => 'login',
        // Six features are deliberately absent from this list, and their
        // absence is what gives them no permission. See UNGATED below.

        self::DASHBOARD_STATUS => 'version',
        self::DASHBOARD_NODES => 'machines',
        self::SYSTEM_STATUS => 'system',
        self::DUPLICATE => 'duplicate',
        self::MINECRAFT => 'minecraft',
        self::GAMES => 'games',
        self::ACCESS => 'access',
        self::SCHEDULED => 'timed',
        self::ACTIVITY => 'activity',
        self::SCHEDULES => 'schedules',
        self::CAPACITY => 'capacity',
        self::ARTWORK => 'artwork',
        self::ALERTS => 'alerts',
        self::BACKUPS => 'backups',
        self::PUBLIC_STATUS => 'status',
        self::LANGUAGES => 'languages',
        self::API => 'api',
        self::SHOP => 'shop',
        self::PACKAGES => 'packages',
        self::ORDERS => 'orders',
        self::INVOICES => 'invoices',
        self::PAYMENTS => 'payments',
        self::COUPONS => 'coupons',
        self::CUSTOMERS => 'customers',
        self::TERMINATE => 'terminate',
    ];

    /**
     * Features that carry no permission of their own, and why.
     *
     * A permission is worth having when somebody might reasonably be given one
     * part of this plugin and not the rest. These six fail that test in one of
     * two ways.
     *
     * Three of them are decoration that everybody sees and nobody administers
     * from a role: the resource meters and the sidebar footer are drawn by the
     * stylesheet for every reader, and the settings search filters a form you
     * are already looking at. Their permissions gated nothing at all - each was
     * read with enabled() alone - so the entry in the role editor was a promise
     * the code never kept.
     *
     * Two are reached through Pelican's own permissions rather than this
     * plugin's. The Palworld page and the pages inside a Minecraft server check
     * the subuser permissions for the server they are in, which is the right
     * answer and already the answer: a second permission on top could only ever
     * take away something Pelican had granted.
     *
     * And one was doing active harm. The star on a server card is a personal
     * convenience, like a bookmark, and it was gated on a plugin permission -
     * so a normal user with no administrative rights got no stars at all, which
     * is not a security boundary, it is a feature that did not work for the
     * people it was for.
     *
     * The preview box goes with them for a plainer reason: it lives on the Look
     * page, so anyone who can see it has already passed a permission and one
     * more decides nothing.
     *
     * The top bar's switcher joins them on the same argument as the star. It is
     * a way to reach servers and pages somebody can already reach; a permission
     * on it would take away the shortcut and leave the destination, which is
     * not a boundary, it is an inconvenience.
     */
    private const UNGATED = [
        self::BARS,
        self::SIDEBAR_FOOTER,
        self::PALWORLD,
        self::SETTINGS_SEARCH,
        self::PREVIEW,
        self::FAVOURITES,
        self::QUICK,
        self::GAME_PLAYERS,
        self::MY_BACKUPS,
        self::OWNER_ALERTS,
        self::CONSOLE,
        self::ARRANGER,
        self::USER_THEMES,
        self::PUBLIC_SHOP,
    ];

    /** Whether a feature is one somebody can be granted on its own. */
    public static function gated(string $key): bool
    {
        return !in_array($key, self::UNGATED, true);
    }

    /**
     * The permission that governs one feature, as Pelican stores it.
     *
     * One per feature, so a role can be given the announcements without being
     * given the panel's colours, or the system status without being given
     * anything to change.
     */
    public static function permission(string $key): string
    {
        return (self::ACTIONS[$key] ?? $key) . ' ' . Theme::PERMISSION_MODEL;
    }

    /**
     * @return array<int, string>
     */
    public static function permissions(): array
    {
        return array_values(self::ACTIONS);
    }

    /**
     * May this person see the feature, and is it switched on at all.
     *
     * The broad "view" permission still opens everything, deliberately: adding
     * per-feature permissions must not quietly revoke what an administrator
     * already had. The feature permission is the narrow way in, for delegating
     * one thing without handing over the rest.
     */
    public static function maySee(string $key): bool
    {
        if (!self::enabled($key)) {
            return false;
        }

        // An ungated feature is on or off and nothing else. Asking a
        // permission here is what stopped ordinary users seeing their own
        // stars.
        if (!self::gated($key)) {
            return true;
        }

        try {
            $user = user();

            return $user !== null
                && ($user->can(Theme::PERMISSION_VIEW) || $user->can(self::permission($key)));
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The same, for changing it. Being granted a feature means being able to
     * manage it - there would be no point to a permission that let somebody
     * open the announcements page and not write one.
     */
    public static function mayManage(string $key): bool
    {
        if (!self::enabled($key)) {
            return false;
        }

        try {
            $user = user();

            if ($user === null) {
                return false;
            }

            /*
             * Seeing an ungated feature needs nothing; changing its settings
             * still needs the plugin's own update permission, because the only
             * place to change any of them is a settings page.
             */
            return $user->can(Theme::PERMISSION_UPDATE)
                || (self::gated($key) && $user->can(self::permission($key)));
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Switch one off, from code rather than from the form.
     *
     * There for one job: carrying an answer somebody already gave into this
     * list when a switch moves here from somewhere else. Nothing else should
     * call it - a feature is switched off by the person who owns the panel,
     * on the page that says what each one does.
     *
     * The held list is dropped afterwards, because the next enabled() in the
     * same request would otherwise answer from before the write.
     */
    public static function disable(string $key): void
    {
        if (!in_array($key, self::ALL, true)) {
            return;
        }

        $off = self::disabled();

        if (in_array($key, $off, true)) {
            return;
        }

        $off[] = $key;

        (new self())->writeToEnvironment([
            'LEGEND_THEME_FEATURES_OFF' => implode(',', $off),
        ]);

        self::$disabled = null;
    }

    /**
     * The ones switched off, as stored.
     *
     * @return array<int, string>
     */
    public static function disabled(): array
    {
        /*
         * Worked out once. enabled() is asked something like thirty times while
         * a page is built - every page's canAccess(), every one again for its
         * sidebar row, every render hook - and splitting the same string thirty
         * times to get the same answer is thirty times more than once.
         */
        if (self::$disabled !== null) {
            return self::$disabled;
        }

        $stored = Theme::config('features_off', '');
        $stored = is_string($stored) ? array_filter(array_map('trim', explode(',', $stored))) : [];

        return self::$disabled = array_values(array_intersect(self::ALL, $stored));
    }

    /**
     * Let go of the memo above.
     *
     * Called by Theme::using(), which swaps config out from under everything
     * that reads it - so an answer worked out before that swap describes the
     * wrong settings while it is in force.
     */
    public static function forget(): void
    {
        self::$disabled = null;
    }

    /** @var array<int, string>|null */
    private static ?array $disabled = null;

    /**
     * The ones switched on, which is what the form shows ticked.
     *
     * @return array<int, string>
     */
    public static function current(): array
    {
        return array_values(array_diff(self::ALL, self::disabled()));
    }

    /**
     * A form's ticked boxes, turned back into the stored "off" list.
     *
     * Anything unticked is off, including a key the form did not offer - which
     * is why the form has to offer all of them.
     */
    public static function sanitise(mixed $ticked): string
    {
        $ticked = is_array($ticked) ? $ticked : [];
        $on = array_values(array_intersect(self::ALL, $ticked));

        return implode(',', array_values(array_diff(self::ALL, $on)));
    }

    /**
     * The stored list with one feature changed and the rest left alone.
     *
     * For the switches that live next to the thing they switch - the System
     * status page has its own - so flipping one there cannot clear the others.
     */
    public static function withOne(string $key, bool $on): string
    {
        $off = self::disabled();

        if ($on) {
            $off = array_values(array_diff($off, [$key]));
        } elseif (!in_array($key, $off, true) && in_array($key, self::ALL, true)) {
            $off[] = $key;
        }

        return implode(',', array_values(array_intersect(self::ALL, $off)));
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::ALL as $key) {
            $options[$key] = Theme::trans('settings.features.' . $key);
        }

        /*
         * Alphabetical, and on the label rather than on the key.
         *
         * The list is thirty-six long now. In declaration order that is thirty
         * six rows somebody reads from the top because there is no other way to
         * find one - and the order it was declared in is the order things were
         * built, which is a fact about this repository and not about anything
         * the reader knows.
         *
         * The label, because that is what is on screen: `nav_links` sorts under
         * n and "Navigation links" under N in whatever language the reader is
         * being answered in. Sorting the keys would give a Dutch panel an
         * English alphabet.
         *
         * Collation matters here for the same reason - `strcoll` follows the
         * locale, so a language with accented letters files them where its own
         * readers expect rather than after z.
         */
        uasort($options, static fn (string $a, string $b): int => strcoll($a, $b));

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function descriptions(): array
    {
        $descriptions = [];

        foreach (self::ALL as $key) {
            $descriptions[$key] = Theme::trans('settings.features.' . $key . '_helper');
        }

        return $descriptions;
    }
}
