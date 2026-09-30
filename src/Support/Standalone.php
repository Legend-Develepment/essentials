<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Plugin;
use Throwable;

final class Standalone
{
    /**
     * The modules that can take a feature over, and how each one says it is ready.
     *
     * Both halves belong to the module and neither can be worked out from the
     * other: the namespace is what the plugin row has to match, and the marker
     * is the name that module's own Integration binds in the container once it
     * is running.
     *
     * They were a namespace map with the marker chosen by a two-way ternary on
     * the id, which answered correctly only while there were exactly two
     * modules. A third would have been handed the second one's readiness - so
     * on a panel already running Announcements, a module that had not loaded
     * anything would have been reported as owning its features, and the legacy
     * would have stood down for a replacement that was not there.
     */
    private const MODULES = [
        'essentials-core' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Core',
            'marker' => 'essentials.core.active',
        ],
        'essentials-announcements' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Announcements',
            'marker' => 'essentials.announcements.active',
        ],
        'essentials-appearance' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Appearance',
            'marker' => 'essentials.appearance.active',
        ],
        'essentials-server-tools' => [
            'namespace' => 'LegendDevelopment\\Essentials\\ServerTools',
            'marker' => 'essentials.server-tools.active',
        ],
        'essentials-duplicate' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Duplicate',
            'marker' => 'essentials.duplicate.active',
        ],
        'essentials-support' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Support',
            'marker' => 'essentials.support.active',
        ],
        'essentials-monitoring' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Monitoring',
            'marker' => 'essentials.monitoring.active',
        ],
        'essentials-game-manager' => [
            'namespace' => 'LegendDevelopment\\Essentials\\GameManager',
            'marker' => 'essentials.game-manager.active',
        ],
        'essentials-shop' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Shop',
            'marker' => 'essentials.shop.active',
        ],
        'essentials-api' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Api',
            'marker' => 'essentials.api.active',
        ],
        'essentials-console' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Console',
            'marker' => 'essentials.console.active',
        ],
        'essentials-arranger' => [
            'namespace' => 'LegendDevelopment\\Essentials\\Arranger',
            'marker' => 'essentials.arranger.active',
        ],
    ];

    /**
     * The modules that are installed and take nothing over yet.
     *
     * Ordinarily a module in the list above with no feature beside it is a
     * fault: two plugins loaded, both drawing the same thing, and the gate says
     * so. An id here is the exception on purpose: the shell of a module and
     * nothing else, no page, no route, no render hook, so it can be installed on
     * a real panel to prove the install, the handshake and the module list
     * without anything being drawn twice.
     *
     * Three came off it at once. The shop draws sixteen pages, the game manager
     * twenty-one and support two, and every feature each of them now owns is
     * named below, so leaving them here would have been a panel drawing all of
     * it twice.
     *
     * The server tools were the last, and came off when that module stopped
     * being empty: Servers by Role, the star and the switcher out of Core, and
     * duplicating and the console button out of plugins of their own, are all
     * drawn there now. Server Tools reads this list and refuses to start beside
     * a release of this plugin that still names it here, because that release
     * would go on drawing all five.
     *
     * Written down here rather than allowed by silence, because the day a
     * module starts drawing is the day its entry has to go. Taking an id off
     * this list is what makes the gate demand the features it now owns.
     *
     * @var array<int, string>
     */
    public const COEXIST = [];

    /**
     * Whether this plugin has been taught to hand anything to that module.
     *
     * ThemePlugin::supportsStandalone() is this, and nothing else. The two used
     * to be separate lists that a gate compared, which worked and was one list
     * too many: a module added to one and not the other refuses to start on
     * every panel that still has this plugin, and the gate was the only thing
     * standing between that and a release.
     */
    public static function knows(string $id): bool
    {
        return array_key_exists($id, self::MODULES);
    }

    public static function owns(string $id): bool
    {
        $module = self::MODULES[$id] ?? null;

        if ($module === null) {
            return false;
        }

        try {
            if (app()->bound($module['marker']) && app($module['marker']) === true) {
                return true;
            }

            $plugin = Plugin::query()->find($id);

            if ($plugin === null || $plugin->namespace !== $module['namespace']
                || !$plugin->shouldLoad() || !$plugin->isCompatible()) {
                return false;
            }

            $integration = $module['namespace'] . '\\Support\\Integration';

            // Autoloading a class also works for disabled plugins in Pelican.
            // Ownership transfers only after the enabled replacement is ready.
            return class_exists($integration) && $integration::ready();
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * Whether a module has taken a feature over from this plugin.
     *
     * Features::enabled() asks this first, so a feature named here switches off
     * every page, every route and every navigation entry that hangs on it,
     * without anything else being told.
     *
     * Appearance claims five at once, which is what makes it different from the
     * two before it. The look is not one page: it is the style picker, the panel
     * pages, the advanced block, the navigation links and the sign-in screen,
     * and a module that owns the stylesheet has to own all five or a panel ends
     * up with two settings pages writing to two different places while only one
     * of them is being drawn.
     */
    public static function replacesFeature(string $feature): bool
    {
        return match ($feature) {
            Features::ANNOUNCEMENTS => self::owns('essentials-announcements'),
            Features::LOOK,
            Features::PAGES,
            Features::ADVANCED,
            Features::NAV_LINKS,
            Features::LOGIN,
            /*
             * And five more that module has been drawing since the day it was
             * split out, none of which was ever named here.
             *
             * The bars are the memory and disk meters, the preview is the panel
             * drawn in a colour before it is saved, the scheduled window is when
             * a look comes into effect, the sidebar footer is the line under the
             * navigation, and user themes are the per-person choice of one. All
             * five hang off the stylesheet and the settings page that module now
             * owns, so keeping them here meant a panel with both plugins drew
             * each of them twice.
             *
             * SETTINGS_SEARCH is not with them on purpose. That module declares
             * the constant and reads it nowhere, and the script behind it was
             * never copied across, so handing it over would take the search box
             * off the settings pages and put nothing in its place.
             */
            Features::BARS,
            Features::PREVIEW,
            Features::SCHEDULED,
            Features::SIDEBAR_FOOTER,
            Features::USER_THEMES => self::owns('essentials-appearance'),
            /*
             * The star and the switcher move together, and they have to.
             *
             * One endpoint answers for both: FavouriteController is reached when
             * either feature is visible, and both lists live in the same file
             * per person. Handing one over and keeping the other would leave the
             * star saving through a controller that this plugin no longer
             * registers, which is a star that lights up and is gone on the next
             * page.
             *
             * They went to Core first and on to Server Tools with Servers by
             * Role, so either of the two may be the one drawing them: a Core
             * from before the move still does, and Server Tools waits for it.
             * Whichever it is, this plugin has handed them over.
             */
            Features::ACCESS,
            Features::FAVOURITES,
            Features::QUICK => self::owns('essentials-server-tools') || self::owns('essentials-core'),
            /*
             * And the last three that were still this plugin's alone.
             *
             * The language policy is a page Core now draws at this plugin's own
             * address, with the half of the policy that never came across: how
             * complete each language is, what it is called here, whether this
             * plugin's opinion about the panel's locale applies at all, and
             * adding one of your own. Handing it over is what stops two plugins
             * drawing a page at essentials-languages.
             *
             * The search box and the banner while an update installs are the
             * other two. Neither is a page: the first is a script and some
             * markup a settings page opts into, the second a line drawn over
             * every admin page while the plugin's own files are being replaced.
             * Both were written here and neither was ported until now.
             *
             * With these three, every one of this plugin's fifty-three features
             * belongs to a module. What is left here is the module list itself.
             */
            Features::LANGUAGES,
            Features::SETTINGS_SEARCH,
            Features::UPDATING,
            /*
             * And the dashboard, which is one block in two halves and always
             * was. This plugin drew both in one widget behind two switches:
             * dashboard_status for what the plugin is running, dashboard_nodes
             * for the machines.
             *
             * They are in two modules now and the arrangement survived. Core
             * answers what is running, gated on this switch, and monitoring
             * draws it in one card with its own machines, gated on the other.
             * So the half a panel switched off stays off, and neither module
             * hands the other something it was told not to draw.
             */
            Features::DASHBOARD_STATUS,
            /*
             * And Pelican's own strings, which Core carries the same files for
             * under a switch of its own. Both writing them would be two copies
             * of one translation laid over Pelican, each refreshed on its own
             * clock, so this plugin neither writes nor registers its copy once
             * Core is running.
             */
            Features::PELICAN_STRINGS,
            // And the log's clock, which Core sets itself on every request.
            Features::LOG_CLOCK => self::owns('essentials-core'),
            // Both had a plugin of their own before Server Tools took them in.
            // Installing Server Tools switches those off, so on a panel
            // midway through either one is drawing them.
            Features::DUPLICATE => self::owns('essentials-server-tools') || self::owns('essentials-duplicate'),
            /*
             * The four that read this panel's own rows and nothing else.
             *
             * The rest of what that module will hold - the watchdog, the
             * dashboard blocks, the public status page - is not here yet, and
             * each of those needs something belonging to another plugin. They
             * are named here one at a time as they land, rather than in advance:
             * a feature handed over before the module draws it is a feature
             * nothing draws at all.
             */
            Features::BACKUPS,
            Features::CAPACITY,
            Features::ACTIVITY,
            Features::SCHEDULES,
            Features::SYSTEM_STATUS,
            Features::MY_BACKUPS,
            /*
             * And the three that needed something belonging to another plugin,
             * now that those plugins exist. The watchdog asks the shop about
             * unbuilt orders and sold-out packages by name rather than by class,
             * and the status page asks the game manager for a player count the
             * same way, so all three draw on a panel that has only monitoring
             * and draw more on a panel that has the rest.
             */
            Features::ALERTS,
            Features::OWNER_ALERTS,
            Features::PUBLIC_STATUS,
            // The machines half of the dashboard block. See the note on
            // DASHBOARD_STATUS above: one block, two switches, two modules.
            Features::DASHBOARD_NODES => self::owns('essentials-monitoring'),
            /*
             * The shop, which is fourteen features because it is fourteen pages
             * and two public routes rather than one thing with switches.
             *
             * PUBLIC_SHOP and WAITLIST are here with the rest. Both are reached
             * without a login - the storefront and the form somebody joins a
             * waiting list on - so a panel that handed over the shop and kept
             * these two would serve the old plugin's copy of a public page while
             * the module served its own, on the same address.
             */
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
            Features::PUBLIC_SHOP,
            Features::WAITLIST => self::owns('essentials-shop'),
            Features::TICKETS => self::owns('essentials-support'),
            /*
             * The API and where uploaded files go, which travel together.
             *
             * FILES is not an API feature by name and is one by nature: it
             * decides whether a file goes to this panel's own disk, a CDN or an
             * S3 bucket, which is the same question of what this panel says to
             * the world outside it. Splitting them would leave a panel handing
             * over its keys page while still answering the old plugin's idea of
             * where an upload belongs.
             */
            Features::API,
            Features::FILES => self::owns('essentials-api'),
            /*
             * The game pages. GAMES is the generic one that covers every egg
             * named in the settings, and the four beside it are the ones with a
             * page of their own written for them.
             */
            Features::MINECRAFT,
            Features::GAMES,
            Features::GAME_PLAYERS,
            Features::PALWORLD,
            Features::ARTWORK => self::owns('essentials-game-manager'),
            Features::CONSOLE => self::owns('essentials-server-tools') || self::owns('essentials-console'),
            // Essentials Appearance took the arranger in from its own plugin,
            // and switches that one off when it is installed. Appearance asks
            // this method before it draws the arranger, so a release that did
            // not name it here keeps drawing the arranger itself.
            Features::ARRANGER => self::owns('essentials-appearance') || self::owns('essentials-arranger'),
            default => false,
        };
    }

    public static function announcements(): ?string
    {
        return self::owns('essentials-announcements')
            ? self::MODULES['essentials-announcements']['namespace'] . '\\Support\\Notice'
            : null;
    }
}
