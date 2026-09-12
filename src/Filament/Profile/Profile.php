<?php

namespace LegendDevelopment\Theme\Filament\Profile;

use App\Filament\Pages\Auth\EditProfile;
use LegendDevelopment\Theme\Support\Shop\Profile as Billing;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Pelican's profile page, with one tab taken out and one section added.
 *
 * **A stylesheet rule was the wrong tool and it did not work.** The first
 * attempt hid the API keys tab by matching where it points, which matched
 * nothing - and even if it had, hiding is not removing: the address still
 * answered, the panel behind it still rendered, and anybody who knew the URL
 * still got there. Asked for it to be gone for everybody, a rule that paints
 * over it is the wrong answer twice.
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
 *
 * **The billing section is here for the same reason the tab is not.**
 * `registerCustomTabs()` appends whole tabs and nothing appends to one, so
 * reaching inside Account means being the class that builds it. The section
 * itself lives in `Support\Shop\Profile`; this page only says where it goes and
 * carries its values through the fill and the save.
 */
class Profile extends EditProfile
{
    /**
     * @return array<int, mixed>
     */
    protected function getDefaultTabs(): array
    {
        $tabs = parent::getDefaultTabs();

        try {
            $extra = Billing::components();

            if ($extra === []) {
                return $tabs;
            }

            $account = (string) trans('profile.tabs.account');

            // A key that resolves to itself is a key Pelican no longer has.
            // Matching on the raw key would append the section to nothing, or
            // to whichever tab happens to be labelled that.
            if ($account === '' || $account === 'profile.tabs.account') {
                return $tabs;
            }

            foreach ($tabs as $tab) {
                if (!self::labelled($tab, $account)) {
                    continue;
                }

                $inside = $tab->getDefaultChildComponents();

                // Pelican hands `schema()` a plain array. A Schema object means
                // that page has been rewritten underneath us, and appending to
                // something whose shape we no longer know is how a profile page
                // stops rendering for everybody.
                if (!is_array($inside)) {
                    break;
                }

                $tab->schema([...$inside, ...$extra]);

                break;
            }
        } catch (Throwable) {
            // Every failure here keeps the page exactly as Pelican draws it.
        }

        return $tabs;
    }

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

            if ($hide === '' || $hide === 'profile.tabs.api_keys') {
                return $tabs;
            }

            return array_values(array_filter(
                $tabs,
                static fn ($tab): bool => !self::labelled($tab, $hide),
            ));
        } catch (Throwable) {
            return $tabs;
        }
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data = parent::mutateFormDataBeforeFill($data);

        try {
            return Billing::fill($data);
        } catch (Throwable) {
            // Empty boxes rather than a profile page that will not open.
            return $data;
        }
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ours out first, then Pelican's own pass over what is left. The other
        // way round would hand the user record seven keys it has no columns for.
        return parent::mutateFormDataBeforeSave(Billing::save($data));
    }

    /** Whether a tab says it is called this. */
    private static function labelled(mixed $tab, string $label): bool
    {
        try {
            return (string) $tab->getLabel() === $label;
        } catch (Throwable) {
            // A tab that will not say what it is called is a tab this leaves
            // alone: not matched, not filtered, not appended to.
            return false;
        }
    }
}
