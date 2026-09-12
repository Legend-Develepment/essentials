<?php

namespace LegendDevelopment\Theme\Support\Tickets;

use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Tickets\Desks\Modora;
use LegendDevelopment\Theme\Support\Tickets\Desks\Panel;
use Throwable;

/**
 * Which desk answers the questions.
 *
 * One at a time, chosen on a setting, and the panel's own is what a panel falls
 * back to whenever the other is not usable. That fallback is the important part
 * of this class: a Modora key that stops working must not turn the Ask button
 * into a page that throws. It turns it into a panel ticket, which is a thing
 * somebody can still answer.
 */
class Desks
{
    /** @return array<string, Desk> */
    public static function all(): array
    {
        return [
            Panel::KEY => new Panel(),
            Modora::KEY => new Modora(),
        ];
    }

    /**
     * The one in use.
     *
     * Never null. A setting naming a desk that is not switched on gets the
     * panel's own, because the alternative is a support feature that is on and
     * cannot be used.
     */
    public static function current(): Desk
    {
        $wanted = trim((string) Theme::config('tickets_via', Panel::KEY));

        try {
            $desk = self::all()[$wanted] ?? null;

            if ($desk instanceof Desk && $desk->enabled()) {
                return $desk;
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return new Panel();
    }

    /** Whether the chosen desk is the one that was asked for. */
    public static function fellBack(): bool
    {
        $wanted = trim((string) Theme::config('tickets_via', Panel::KEY));

        return $wanted !== Panel::KEY && self::current()->key() === Panel::KEY;
    }

    /** What is wrong with the chosen desk, said in a sentence, or null. */
    public static function check(): ?string
    {
        $wanted = trim((string) Theme::config('tickets_via', Panel::KEY));

        try {
            $desk = self::all()[$wanted] ?? null;

            return $desk instanceof Desk ? $desk->check() : null;
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return [
            Panel::KEY => Theme::trans('tickets.via_panel'),
            Modora::KEY => Theme::trans('tickets.via_modora'),
        ];
    }
}
