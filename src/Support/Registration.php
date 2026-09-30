<?php

namespace LegendDevelopment\Theme\Support;

use App\Extensions\OAuth\OAuthService;
use Throwable;

/**
 * Whether anybody may make themselves an account, and what they may call it.
 *
 * **Off unless somebody said yes, and that is the opposite of how a feature
 * here normally arrives.** Everything in `Features::ALL` is on until it is
 * listed as off, deliberately, so that a panel which updates gets what was
 * added. That rule is right for a sidebar row and wrong for a public door: a
 * panel that updated overnight and woke up accepting signups from anyone is not
 * a panel anybody asked for. So this is a plain setting with a default of
 * false, not a feature constant, and the only way to open it is to open it.
 *
 * It lives with the login screen because that is where it is seen. The login
 * page is the one page a signed-out visitor reaches, and the link to register
 * is drawn on it.
 */
class Registration
{
    /**
     * What a username may be made of.
     *
     * Stricter than Pelican's own rule, which is `between:1,255` and unique and
     * nothing else. An administrator typing a name into the user editor is a
     * person who can be asked what they meant; a signup form is reachable by
     * anything with an HTTP client, and a username is printed in the panel, in
     * the activity log and in a Discord message. Letters, digits, and the three
     * separators a name actually uses.
     *
     * The length is Pelican's own upper bound and a floor of three, because a
     * one-character username is available exactly once and then never again.
     */
    public const PATTERN = '/^[A-Za-z0-9][A-Za-z0-9._-]{2,63}$/';

    public const MAX_LENGTH = 64;

    /** Whether the door is open. */
    public static function open(): bool
    {
        return (bool) Theme::config('register_open', false);
    }

    /**
     * The other way in, which this plugin does not own.
     *
     * **Pelican makes accounts through OAuth too, and the switch above knows
     * nothing about it.** A provider set up under Settings, OAuth with "create
     * missing users" on will make somebody an account the first time they sign
     * in with it, whether or not the form is open. So a panel with this feature
     * off is not necessarily a panel nobody can join, and saying it was would
     * be this page lying about the thing it exists to control.
     *
     * Answered by asking Pelican rather than by reading the environment: the
     * variables are per provider and a provider is only a door when it is
     * configured as well as switched on, which is a question its own schema
     * answers.
     *
     * Guarded on the class existing. This is somebody else's code, and a panel
     * whose Pelican is older or newer than the one this was written against
     * should show one door rather than a stack trace.
     *
     * @return array<int, string> Provider ids, lowercase, in Pelican's order.
     */
    public static function providers(): array
    {
        if (!class_exists(OAuthService::class)) {
            return [];
        }

        try {
            $out = [];

            foreach (app(OAuthService::class)->getAll() as $driver) {
                if (!$driver->isEnabled()) {
                    continue;
                }

                $id = (string) $driver->getId();

                if (!(bool) env('OAUTH_' . strtoupper($id) . '_SHOULD_CREATE_MISSING_USERS')) {
                    continue;
                }

                $out[] = $id;
            }

            return $out;
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The line shown under the form, or null for none.
     *
     * Somewhere to put "you need an invite from Discord first" or a link to the
     * rules. One line, no markup: this is drawn to people who are not signed in
     * and there is nothing here worth the risk of letting an administrator put
     * a tag into a page a stranger loads.
     */
    public static function note(): ?string
    {
        $said = trim((string) Theme::config('register_note', ''));

        return $said === '' ? null : $said;
    }
}
