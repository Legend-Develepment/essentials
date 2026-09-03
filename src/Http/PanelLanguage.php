<?php

namespace LegendDevelopment\Theme\Http;

use Closure;
use Illuminate\Http\Request;
use LegendDevelopment\Theme\Support\Languages;
use Throwable;

/**
 * Makes this plugin's answer about language the panel's answer too.
 *
 * Without it the two disagree in one specific way, and the result is worse than
 * either on its own. Pelican sets the locale from the reader's account; this
 * plugin then decides separately whether to honour that, and answers in English
 * when it will not. Switch German off and a German reader gets Pelican in German
 * with this plugin's pages in English - two languages on one screen, which is
 * not what anybody meant by turning a language off.
 *
 * So when the setting is on, the decision is made once and applies to
 * everything. A language this plugin does not carry, or one an administrator has
 * switched off, puts the whole panel in English for that reader rather than half
 * of it.
 *
 * It has to run after Pelican's LanguageMiddleware, which is what registration
 * on the panel achieves: the panel's own list already holds that one, and a
 * plugin's middleware is appended to it.
 *
 * Nothing here writes to the account. Somebody whose language is switched off
 * keeps their choice, and gets it back the moment it is switched on again -
 * this decides what to answer in, not what they asked for.
 */
class PanelLanguage
{
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            if (Languages::leads()) {
                app()->setLocale(Languages::current());
            }
        } catch (Throwable) {
            // A panel that cannot work out its language should still answer in
            // whatever it already had. Never the request over a locale.
        }

        return $next($request);
    }
}
