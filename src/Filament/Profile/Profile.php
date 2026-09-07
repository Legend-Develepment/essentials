<?php

namespace LegendDevelopment\Theme\Filament\Profile;

use App\Filament\Pages\Auth\EditProfile;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Pelican's profile page with one tab taken out of it.
 *
 * **A stylesheet rule was the wrong tool and it did not work.** The first
 * attempt hid the tab by matching where it points, which matched nothing - and
 * even if it had, hiding is not removing: the address still answered, the panel
 * behind it still rendered, and anybody who knew the URL still got there. Asked
 * for it to be gone for everybody, a rule that paints over it is the wrong
 * answer twice.
 *
 * So the tab is removed from the schema instead. Pelican registers its profile
 * page with `->profile(EditProfile::class, false)`, which means the panel takes
 * a class name and this can hand it a different one - a subclass that returns
 * the same tabs minus that one. There is no address to reach a tab that is not
 * built, so nothing is left to find.
 *
 * **What this still does not do**, and it has to be said rather than assumed:
 * Pelican's own client API at `/api/client/account/api-keys` will still make an
 * account key for anybody who asks it. The tab is where people make one by
 * hand, and taking it away takes away the hand. Refusing the API is Pelican's
 * to arrange and not this plugin's.
 *
 * **Named by matching Pelican's own translation key**, not by an id guessed at.
 * Both sides resolve `profile.tabs.api_keys`, so this holds in every language
 * the panel speaks - and if Pelican ever renames that key the filter matches
 * nothing and the tab comes back, which is the right way for a rule against
 * somebody else's page to be wrong.
 */
class Profile extends EditProfile
{
    /**
     * @return array<int, mixed>
     */
    protected function getTabs(): array
    {
        $tabs = parent::getTabs();

        try {
            if (!Theme::config('api_hide_pelican', false)) {
                return $tabs;
            }

            $hide = (string) trans('profile.tabs.api_keys');

            // A key that resolves to itself is a key Pelican no longer has, and
            // filtering on it would take out nothing or - worse - something
            // whose label happens to be that string.
            if ($hide === '' || $hide === 'profile.tabs.api_keys') {
                return $tabs;
            }

            return array_values(array_filter(
                $tabs,
                static function ($tab) use ($hide): bool {
                    try {
                        return (string) $tab->getLabel() !== $hide;
                    } catch (Throwable) {
                        // A tab that will not say what it is called is a tab
                        // this leaves alone.
                        return true;
                    }
                },
            ));
        } catch (Throwable) {
            // Every failure here keeps the page exactly as Pelican draws it.
            return $tabs;
        }
    }
}
