<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The appearance settings, as custom properties, on whatever selector is asked
 * for.
 *
 * Two callers and one body of code, which is the entire point of this class
 * existing rather than the preview building its own tokens.
 *
 * ThemeServiceProvider asks for them on `:root` and the panel is painted. The
 * preview box asks for them on its own class, with the form's unsaved values
 * standing in for the stored ones, and the same tokens land inside the box
 * instead - so the box is not a drawing of the theme, it is the theme, in a
 * smaller container.
 *
 * That only works because of a decision made early and kept: every effect in
 * this theme is read through a custom property, so turning the glow off
 * redefines a token rather than fighting the rules that use it. A preview built
 * any other way would be a second place the theme can be wrong, and a preview
 * that disagrees with the panel is worse than none - it is a lie that costs an
 * afternoon.
 *
 * What it does not cover is deliberate. Layout, the server list, the terminal
 * and the rest each emit rules against Filament's own classes rather than
 * tokens, and those are not scopable to a box by changing a selector. The
 * settings people actually sit and adjust - colour, corners, spacing, glass,
 * glow - are all here.
 */
class Preview
{
    /** The class the box carries, and the scope its tokens are written to. */
    public const SCOPE = 'ld-preview';

    /**
     * @param  string  $selector  Where the tokens are defined.
     * @param  string  $dark  Where the dark-only ones go. The panel puts those on
     *                        html.dark; a box has no html of its own, so it names
     *                        itself for both.
     */
    public static function tokens(string $selector = ':root', string $dark = 'html.dark'): string
    {
        $accent = Palette::sanitize(Theme::config('accent'));
        $density = Theme::config('density', 'comfortable') === 'compact' ? '0.72' : '1';

        // The stylesheet reads every effect through a custom property, so turning
        // one off is a matter of redefining the token rather than fighting the
        // rules that use it.
        $css = "{$selector}{--ld-accent:{$accent};--ld-density:{$density};}";

        $radius = (string) Theme::config('radius', 'normal');

        if (array_key_exists($radius, Areas::RADII)) {
            [$large, $small] = Areas::RADII[$radius];

            $css .= "{$selector}{--ld-radius:{$large};--ld-radius-sm:{$small};}";
        }

        $surface = trim((string) Theme::config('surface', ''));

        if ($surface !== '') {
            $surface = Palette::sanitize($surface, '#1c1917');

            /*
             * On the plain selector and not the dark one.
             *
             * It was dark-only, which was invisible while the panel was always
             * dark and is a setting that silently does nothing the moment it is
             * not. The two shifts hold in both directions: raised is lighter
             * than the surface and sunken is darker, whichever end of the scale
             * the surface sits at.
             */
            $css .= $selector . '{'
                . "--ld-surface:{$surface};"
                . '--ld-raised:' . Palette::shift($surface, 0.035) . ';'
                . '--ld-sunken:' . Palette::shift($surface, -0.03) . ';'
                . '}';
        }

        if (!Theme::config('glass', true)) {
            $css .= $selector . '{--ld-blur:none;}' . $dark . '{--ld-topbar-bg:var(--gray-900);}';
        }

        if (!Theme::config('glow', true)) {
            $css .= $selector . '{--ld-glow:none;--ld-glow-strong:none;}';
        }

        return $css;
    }

    /**
     * The tokens for one box, built from a form's state rather than from what is
     * stored.
     *
     * Theme::using() is the same mechanism a person's own style uses: it swaps
     * what config() answers for the length of one closure and puts it back in a
     * finally, because a global left standing would make the settings form show
     * somebody else's values as though they were the panel's.
     *
     * @param  array<string, mixed>  $values
     */
    public static function css(array $values): string
    {
        try {
            $scope = '.' . self::SCOPE;

            // The box names itself for both scopes. Inside it there is no <html>
            // to carry a mode, and the box is shown in the mode the form says.
            return Theme::using($values, static fn (): string => self::tokens($scope, $scope));
        } catch (Throwable) {
            // A preview that cannot be built is a preview that is not drawn. It
            // is beside a settings form; it may not take one down.
            return '';
        }
    }

    /**
     * Whether the box should be drawn dark, from the form rather than from what
     * is stored - so switching Panel mode changes the preview before saving.
     */
    public static function isDark(mixed $mode): bool
    {
        $mode = Mode::sanitise($mode);

        if ($mode === Mode::LIGHT) {
            return false;
        }

        if ($mode === Mode::DARK) {
            return true;
        }

        // System, which a server cannot ask about. The panel this is being
        // configured from is the better guess than a coin toss.
        return Mode::current() !== Mode::LIGHT;
    }
}
