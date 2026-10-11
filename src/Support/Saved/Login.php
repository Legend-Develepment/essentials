<?php

namespace LegendDevelopment\Theme\Support\Saved;

use App\Traits\EnvironmentWriterTrait;
use LegendDevelopment\Theme\Support\Clean;
use LegendDevelopment\Theme\Support\Login as LoginScreen;
use LegendDevelopment\Theme\Support\Pictures;
use LegendDevelopment\Theme\Support\Registration;
use LegendDevelopment\Theme\Support\Stamp;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Uploaded;

/**
 * The sign-in screen, read and written.
 *
 * Lifted out of Settings whole rather than rewritten. That file answered for
 * ten pages at once and every change to one of them went through it; this is
 * the same code, in the file named after the page that owns it.
 *
 * Settings::loginData() and Settings::persistLogin() are still there and still
 * work: they hand over to these two. Nothing that called them had to change,
 * which is the point of moving the body and leaving the name.
 *
 * The sign-in screen itself, which this file is the settings of. Aliased
 * because the two would otherwise share a name in here and the import
 * would quietly win: see tools/check-uses.js, which said so.
 */
class Login
{
    use EnvironmentWriterTrait;

    /**
     * @return array<string, mixed>
     */
    public static function read(): array
    {
        return [
            'login_image' => (string) Theme::config('login_image', ''),
            'login_image_url' => (string) Theme::config('login_image_url', ''),
            'login_dim' => (int) Theme::config('login_dim', 45),
            'login_blur' => (int) Theme::config('login_blur', 0),
            'login_width' => (int) Theme::config('login_width', 28),
            'login_position' => LoginScreen::position(),
            'login_align' => LoginScreen::align(),
            'login_opacity' => LoginScreen::opacity(),
            'login_glow' => LoginScreen::glow(),
            'login_hide_heading' => (bool) Theme::config('login_hide_heading', false),
            'login_hide_footer' => (bool) Theme::config('login_hide_footer', false),
            'login_above' => (string) Theme::config('login_above', ''),
            'login_notice' => (string) Theme::config('login_notice', ''),
            'register_open' => Registration::open(),
            'register_note' => (string) Theme::config('register_note', ''),
        ];
    }

    /**
     * The sign-in screen's own settings, written on their own.
     *
     * persist() writes every key it knows about, taking a missing one as "set
     * it to the default". That is right when the whole form is on one page and
     * ruinous when it is not: saving the sign-in page would reset the accent,
     * the layout and everything else to their defaults. So the page that owns
     * these keys writes these keys.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function write(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_LOGIN_IMAGE' => Uploaded::stored($data['login_image'] ?? null, Pictures::BACKDROP),
            'LEGEND_THEME_LOGIN_URL' => Clean::url($data['login_image_url'] ?? null),
            'LEGEND_THEME_LOGIN_DIM' => (string) Clean::clamp($data['login_dim'] ?? null, 0, 90, 45),
            'LEGEND_THEME_LOGIN_BLUR' => (string) Clean::clamp($data['login_blur'] ?? null, 0, 24, 0),
            'LEGEND_THEME_LOGIN_WIDTH' => (string) Clean::clamp($data['login_width'] ?? null, 20, 60, 28),
            'LEGEND_THEME_LOGIN_POSITION' => LoginScreen::sanitisePosition($data['login_position'] ?? null),
            'LEGEND_THEME_LOGIN_ALIGN' => LoginScreen::sanitiseAlign($data['login_align'] ?? null),
            'LEGEND_THEME_LOGIN_OPACITY' => (string) Clean::clamp($data['login_opacity'] ?? null, 30, 100, 92),
            'LEGEND_THEME_LOGIN_GLOW' => ($data['login_glow'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_HEADING' => ($data['login_hide_heading'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_FOOTER' => ($data['login_hide_footer'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_ABOVE' => Clean::line($data['login_above'] ?? null),
            'LEGEND_THEME_LOGIN_NOTICE' => Clean::line($data['login_notice'] ?? null),
            'LEGEND_THEME_REGISTER_OPEN' => ($data['register_open'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_REGISTER_NOTE' => Clean::line($data['register_note'] ?? null),
        ]);

        // LoginScreen::css() is inside the cached settings block. The other three
        // persisters below write nothing the panel's stylesheet reads - the
        // system status page, the watchdog and the public status page each
        // build their own - so none of them bumps.
        Stamp::bump();
    }
}
