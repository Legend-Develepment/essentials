<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Lang;
use Throwable;

/**
 * What the role editor calls this plugin's block of permissions.
 *
 * Pelican titles each block with `admin/role.models.<model>` when that key
 * exists and Str::headline() of the model name when it does not. Nothing
 * declared the key, so the block was headed "Legend Theme" - the model name
 * `legendTheme` split into words - while every page, every heading and the
 * sidebar group call this plugin by the name in plugin.json. One thing with two
 * names in one panel is one thing somebody looks for under the wrong one.
 *
 * **The model name itself is left alone, and that is the whole reason this class
 * exists.** Renaming it to `essentials` would give the right heading for free,
 * because headline() would then produce it - but permission names are stored per
 * role as `view legendTheme`, and this plugin lets somebody install an older
 * version whenever they like. Rename the model and a rollback looks for
 * permissions that no longer exist, so twenty-six ticks silently become none.
 * A display name costs nothing on the way back down.
 *
 * Not translated, and it should not be. It is the plugin's own name, which is
 * the same word in every language this plugin answers in.
 */
class PermissionLabel
{
    /**
     * Locales already written to.
     *
     * Per locale rather than a plain flag: one process can serve two readers,
     * and Laravel keeps translations per locale, so a second reader in another
     * language needs the line written again for theirs.
     *
     * @var array<string, true>
     */
    private static array $done = [];

    /**
     * Put the plugin's name in front of Pelican's own model labels.
     *
     * **Read the group before adding to it.** Lang::addLines() writes straight
     * into the translator's loaded array, and Laravel treats a group that has
     * anything in it as already loaded - so adding a line to a group nobody had
     * asked for yet means the real file is never read, and every other string in
     * it disappears. Lang::get() below is what forces it in first; the returned
     * array is then merged rather than replaced, because `models` is Pelican's
     * and holds the label for every model it has of its own.
     */
    public static function apply(): void
    {
        try {
            $locale = (string) app()->getLocale();

            if ($locale === '' || isset(self::$done[$locale])) {
                return;
            }

            self::$done[$locale] = true;

            $models = Lang::get('admin/role.models', [], $locale);

            // A missing key comes back as the key itself. Then Pelican has no
            // labels of its own to lose and ours is the whole array.
            $models = is_array($models) ? $models : [];
            $models[Theme::PERMISSION_MODEL] = Theme::name();

            Lang::addLines(['admin/role.models' => $models], $locale);
        } catch (Throwable) {
            // A heading that reads "Legend Theme" is a heading. Never the
            // request over the name above a list of checkboxes.
        }
    }

    /** For the tests, and for a locale that changes inside one process. */
    public static function forget(): void
    {
        self::$done = [];
    }
}
