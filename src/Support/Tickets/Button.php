<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use Filament\Facades\Filament;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A way to ask for help from wherever somebody is standing.
 *
 * **The corner, because there is no sidebar.** The client panel has none - it
 * is the reason Services and Invoices live in the account menu - and a customer
 * whose server will not start is not going to go looking through a menu for the
 * word Help. They are looking at the thing that is wrong. So the button follows
 * them: one fixed corner, every page, both panels a customer sits in.
 *
 * **It goes to the form rather than to the page.** `?ask=1` opens the ask
 * window on arrival, so pressing this is one click to a box to type in. A
 * button that lands somebody on a list they then have to find a button on is a
 * button that has moved the problem rather than solved it.
 *
 * **Nothing here decides where the question ends up.** That is already decided
 * in one place: Board writes it to this panel and asks whichever desk is
 * switched on to mirror it. Whether that is Modora or the panel's own page is a
 * setting, and this button does not know or care - which is the whole point of
 * there being a desk interface at all.
 *
 * Static markup in the first response, like the notice bar above it. No
 * JavaScript, no request of its own: it is a link, and a link that renders with
 * the page cannot fail to render.
 */
class Button
{
    /** The panels a customer is actually in. */
    private const PANELS = ['app', 'server'];

    /**
     * The markup, or nothing at all.
     *
     * Nothing when there is no feature, no tables, nobody signed in, or the
     * panel is the administrator's - who has the ticket page in their own
     * sidebar and does not need a customer's button on top of it.
     */
    public static function html(): string
    {
        try {
            /*
             * Three questions, and all three have to say yes.
             *
             * Whether tickets exist at all, whether new ones are being taken,
             * and whether this panel wants a button following people around.
             * The last two are separate switches because they are separate
             * decisions: a panel can want the page without the furniture.
             */
            if (!Board::opening() || !Theme::config('tickets_button', true) || user() === null) {
                return '';
            }

            if (!in_array(Filament::getCurrentPanel()?->getId(), self::PANELS, true)) {
                return '';
            }

            $where = rtrim((string) (Filament::getPanel('app')?->getUrl() ?? ''), '/') . '/tickets?ask=1';
            $label = Theme::trans('tickets.ask');

            /*
             * The word is in the markup and not on the screen.
             *
             * `title` is the tooltip a mouse gets; the span is what a screen
             * reader reads, and the stylesheet is what takes it out of the
             * picture. An icon on its own with nothing behind it is a button
             * that is unreachable for anybody not looking at it.
             */
            return '<a class="ld-help-button" href="' . e($where) . '"'
                . ' title="' . e($label) . '" aria-label="' . e($label) . '">'
                . self::icon()
                . '<span>' . e($label) . '</span>'
                . '</a>';
        } catch (Throwable) {
            /*
             * A corner of the screen is never worth a page for. Anything that
             * goes wrong here - a panel that is not registered yet, a table
             * that is not there - is a button that is simply absent, and the
             * account menu still has the row.
             */
            return '';
        }
    }

    /**
     * The lifebuoy, or nothing.
     *
     * Asked for by name through blade-icons rather than written out here, so it
     * is the same glyph as the one in the account menu and on the admin page.
     * A panel whose icon set has been changed underneath us gets a button with
     * a word on it, which is still a button.
     */
    private static function icon(): string
    {
        try {
            return svg('tabler-lifebuoy', 'ld-help-icon')->toHtml();
        } catch (Throwable) {
            return '';
        }
    }
}
