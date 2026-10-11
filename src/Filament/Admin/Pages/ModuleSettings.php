<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Leftovers;
use LegendDevelopment\Theme\Support\Modules;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which parts of this plugin are switched on, as seven groups rather than as
 * fifty-three checkboxes.
 *
 * Its own page and not a tab, because the question it answers comes before the
 * settings rather than among them: somebody who has just installed this wants
 * to decide what it is before they decide what colour it is. The old list is
 * still on the settings page for anybody who prefers it; this is the same
 * switches asked the other way round.
 *
 * **A switch here writes once.** A module holds up to fourteen features and
 * flipping them one at a time would be fourteen writes to .env and fourteen
 * route cache clears, so the whole change is computed first and written in one
 * pass.
 *
 * **Switching something on brings what it needs.** The public shop without the
 * shop is a switch that reads as on and does nothing; so is the waiting list,
 * and so is telling server owners their node is down without the watchdog that
 * notices. Those are followed and turned on with it, and the message says which
 * ones came along rather than doing it quietly.
 *
 * **Switching something off leaves the data.** Nothing here drops a table or
 * deletes a file. A shop that is off is a shop whose pages are gone and whose
 * orders are exactly where they were, which is what somebody switching it off
 * for a week expects and what nobody should have to find out by trying.
 */
class ModuleSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-layout-grid';

    protected static ?string $slug = 'essentials-modules';

    /**
     * Second, under the settings row it belongs beside.
     *
     * Not first: the settings page is the one people are looking for by name,
     * and a panel that has already been set up has no reason to be sent here
     * every time.
     */
    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        try {
            return user()?->can(Theme::PERMISSION_VIEW) ?? false;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('modules.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('modules.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('modules.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    /**
     * A word beside the sidebar entry while the first question is unanswered.
     *
     * The question itself is the top of this page and nothing anywhere pointed
     * at it, so a fresh panel asked it of whoever happened to open Modules and
     * of nobody else. This is the smallest thing that is still a way in: it
     * costs one config read, it is gone the moment the question is answered or
     * dismissed, and it does not interrupt anybody who is in the middle of
     * something else.
     */
    public static function getNavigationBadge(): ?string
    {
        try {
            return Modules::askFirst() ? Theme::trans('modules.go') : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The return type is Filament's, not the narrower one it looks like it
     * wants: Page declares `string | array | null`, and PHP refuses a child
     * that narrows it. Caught by tools/check-inherit.js rather than by a panel.
     */
    public static function getNavigationBadgeColor(): string|array|null
    {
        return self::getNavigationBadge() === null ? null : 'warning';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.modules';
    }

    /** Whether this reader may change any of it, or is only reading. */
    public function mayChange(): bool
    {
        try {
            return user()?->can(Theme::PERMISSION_UPDATE) ?? false;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The question a panel is asked once, and what each answer would do.
     *
     * Empty on every panel that has been running, and on every one where
     * somebody has already answered - which is the common case about a minute
     * after an install. The counts are worked out here rather than written
     * down, so an answer says how many parts it switches on today rather than
     * how many it did when this was written.
     *
     * @return array<int, array<string, mixed>>
     */
    public function shapes(): array
    {
        if (!Modules::askFirst()) {
            return [];
        }

        $out = [];

        foreach (array_keys(Modules::SHAPES) as $shape) {
            $changes = Modules::shape($shape);

            $out[] = [
                'key' => $shape,
                'name' => Theme::trans('modules.first_' . $shape),
                'about' => Theme::trans('modules.first_' . $shape . '_helper'),
                'on' => count(array_filter($changes)),
                'of' => count($changes),
            ];
        }

        return $out;
    }

    /** One of the three answers, applied. */
    public function chooseShape(string $shape): void
    {
        $changes = Modules::shape($shape);

        if ($changes === []) {
            return;
        }

        $this->apply($changes, [], true);
    }

    /** Or none of them, which is also an answer and is remembered as one. */
    public function chooseNone(): void
    {
        abort_unless($this->mayChange(), 403);

        try {
            // The list exactly as it is: this says who decided, not what.
            Settings::persistFeatures(Features::withMany([]), null, null, true);
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('modules.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        /*
         * Said out loud, because nothing else on the screen changes: the
         * question goes and the cards stay exactly as they were. Without a word
         * it reads as a button that did nothing.
         */
        Notification::make()
            ->title(Theme::trans('modules.first_left'))
            ->success()
            ->send();
    }

    /**
     * The seven cards, with everything the view needs and no logic in it.
     *
     * @return array<int, array<string, mixed>>
     */
    public function cards(): array
    {
        $cards = [];

        foreach (Modules::ALL as $module) {
            $counted = Modules::counted($module);

            $cards[] = [
                'key' => $module,
                'name' => Theme::trans('settings.modules.' . $module),
                'about' => Theme::trans('settings.modules.' . $module . '_helper'),
                'state' => Modules::state($module),
                'on' => $counted['on'],
                'of' => $counted['of'],
                'cost' => Theme::trans('settings.cost.' . Modules::cost($module)),
                'url' => self::settingsUrl($module),
                'health' => $this->health($module),
                'leftovers' => $this->leftovers($module),
                'parts' => $this->parts($module),
            ];
        }

        return $cards;
    }

    /**
     * Where somebody goes to set this module up, when there is one such place.
     *
     * Four of the seven have a single page that is plainly theirs. The other
     * three are spread over five or six, and there is no honest answer to
     * "where do I set up Panel" - so those get no link rather than a link to
     * whichever one came first in the list, which would teach somebody the
     * wrong place and then have to be unlearned.
     *
     * Every address is asked for inside a try: a page that is not registered,
     * because its own feature is off, throws rather than answering, and a card
     * with no link is the right outcome there too.
     */
    private static function settingsUrl(string $module): ?string
    {
        $page = match ($module) {
            Modules::APPEARANCE => Look::class,
            Modules::ALERTS => Alerts::class,
            Modules::SHOP => ShopSettings::class,
            Modules::SUPPORT => SupportTickets::class,
            default => null,
        };

        if ($page === null) {
            return null;
        }

        try {
            return $page::canAccess() ? $page::getUrl() : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * And what it left behind, for the parts of it that are switched off.
     *
     * The mirror of health() below: that one asks only about the parts that are
     * on, this one only about the parts that are not. Most of them say a
     * sentence and no more - a saved arrangement is a file nobody is being
     * served, and it is correct again the moment the switch comes back. One of
     * them offers a button, because one of them is still happening.
     *
     * @return array<int, array<string, mixed>>
     */
    private function leftovers(string $module): array
    {
        $out = [];

        foreach (Leftovers::of($module) as $row) {
            $feature = (string) $row['feature'];
            $count = $row['count'];

            $out[] = [
                'feature' => $feature,
                'tone' => $count === null ? 'bad' : ($row['tone'] === Leftovers::ACTS ? 'acts' : 'kept'),
                'said' => $count === null
                    ? Theme::trans('modules.left_unknown')
                    : Theme::choice('modules.left_' . $feature, (int) $count),

                // Offered only where there is something to end, and only to
                // somebody who may change this module.
                /*
                 * The words the access page already uses, rather than a second
                 * set saying the same thing in thirty-one languages. It is the
                 * same act, pressed from somewhere else.
                 */
                'clear' => $count !== null && $row['clears'] && Features::mayTidy($feature)
                    ? Theme::trans('access.revoke')
                    : null,
            ];
        }

        return $out;
    }

    /**
     * End what one switched-off part is still doing.
     *
     * Guarded again here rather than trusting the button: a page that was open
     * while somebody else switched the feature back on would otherwise sweep a
     * feature that is running.
     */
    public function clearLeftover(string $feature): void
    {
        abort_unless(Features::mayTidy($feature), 403);

        try {
            $gone = Leftovers::clear($feature);
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('modules.clear_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::choice('modules.cleared', $gone))
            ->success()
            ->send();
    }

    /**
     * What this module is short of, as lines somebody can act on.
     *
     * Nothing at all when it is doing what it says, which is the common case
     * and should not cost a line on every card. A module that is off says
     * nothing either: it is not short of anything, it was decided against.
     *
     * @return array<int, array{tone: string, said: string}>
     */
    private function health(string $module): array
    {
        if (Modules::state($module) === Modules::OFF) {
            return [];
        }

        $read = Modules::health($module);
        $out = [];

        if (!$read['ready']) {
            $out[] = ['tone' => 'bad', 'said' => Theme::trans('modules.health_tables')];
        }

        if ($read['missing'] > 0) {
            $out[] = [
                'tone' => 'bad',
                'said' => Theme::choice('modules.health_missing', $read['missing']),
            ];
        }

        if ($read['waiting'] > 0) {
            $out[] = [
                'tone' => 'wait',
                'said' => Theme::choice('modules.health_waiting', $read['waiting']),
            ];
        }

        return $out;
    }

    /**
     * One module's features, each with whatever is true of it beyond on or off.
     *
     * @return array<int, array<string, mixed>>
     */
    private function parts(string $module): array
    {
        $parts = [];

        foreach (Modules::holds($module) as $feature) {
            $on = Features::enabled($feature);
            $waiting = Modules::waitingFor($feature);

            $parts[] = [
                'key' => $feature,
                'name' => Theme::trans('settings.features.' . $feature),
                'about' => Theme::trans('settings.features.' . $feature . '_helper'),
                'on' => $on,

                /*
                 * Only said of something that is switched on. A feature that is
                 * off is not missing anything; it is off, and a second sentence
                 * about it would be noise on every card.
                 */
                'needs' => $on ? $this->naming('settings.needs', Modules::missing($feature)) : null,
                'lessens' => $on ? $this->naming('settings.lessens', Modules::quieter($feature)) : null,
                'waiting' => $waiting === null ? null : Theme::trans('settings.waiting.' . $waiting),
            ];
        }

        return $parts;
    }

    /**
     * "Needs X, which is off", or nothing at all.
     *
     * @param  array<int, string>  $features
     */
    private function naming(string $line, array $features): ?string
    {
        if ($features === []) {
            return null;
        }

        return Theme::trans($line, [
            'names' => implode(', ', array_map(
                static fn (string $key): string => Theme::trans('settings.features.' . $key),
                $features,
            )),
        ]);
    }

    /** Everything in a module, together. */
    public function toggleModule(string $module, bool $on): void
    {
        $features = Modules::holds($module);

        if ($features === []) {
            return;
        }

        $this->apply(array_fill_keys($features, $on));
    }

    /** One feature, and whatever it cannot work without. */
    public function toggleFeature(string $feature, bool $on): void
    {
        if (!in_array($feature, Features::ALL, true)) {
            return;
        }

        $changes = [$feature => $on];
        $brought = [];

        if ($on) {
            foreach (Modules::alsoNeeded($feature) as $needed) {
                if (Features::enabled($needed)) {
                    continue;
                }

                $changes[$needed] = true;
                $brought[] = Theme::trans('settings.features.' . $needed);
            }
        }

        $this->apply($changes, $brought);
    }

    /**
     * Write the change, say what happened, and say what came with it.
     *
     * @param  array<string, bool>  $changes
     * @param  array<int, string>  $brought
     */
    private function apply(array $changes, array $brought = [], bool $answered = false): void
    {
        abort_unless($this->mayChange(), 403);

        try {
            Settings::persistFeatures(
                Features::withMany($changes),
                null,
                null,
                // Only an answer to the opening question says so. A switch
                // flipped later is somebody changing their mind, which is what
                // this page is for and not something to record.
                $answered ? true : null,
            );
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('modules.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('modules.saved'))
            ->body($brought === [] ? null : Theme::trans('modules.brought', [
                'names' => implode(', ', $brought),
            ]))
            ->success()
            ->send();
    }
}
