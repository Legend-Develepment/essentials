<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use LegendDevelopment\Theme\Support\Games\A2S;
use LegendDevelopment\Theme\Support\Games\Games;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Who is on the server, for every game that answers Valve's query.
 *
 * One page rather than one per game, and that is not laziness: Rust, ARK,
 * Valheim and 7 Days to Die answer the *same* question with the same packet, so
 * a page per game would be four copies of one list differing in nothing but the
 * word at the top.
 *
 * What does differ per game is what you can *do* to somebody - kicking is
 * `kick "name"` on one and `KickPlayer <id>` on another - so this page reads and
 * does not act. Adding that means an egg list per game and a command per game,
 * which is a release of its own rather than a footnote to this one.
 *
 * Read-only also means no permission of its own beyond Pelican's: seeing who is
 * on a server is not more than seeing the console, and the Minecraft players
 * page has taken the same view since it shipped.
 */
class GamePlayers extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-users';

    protected static ?string $slug = 'game-players';

    protected static ?int $navigationSort = 8;

    /** @var array<int, array{name: string, score: int, minutes: int}> */
    public array $rows = [];

    /**
     * Null when the server could not be asked at all, which is different from
     * an empty list and is said differently on the page.
     */
    public bool $answered = false;

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && Games::speaks($server)
                // Pelican's own permission for looking at a running server.
                // Nothing here reaches further than the console already does.
                && (user()?->can(SubuserPermission::ControlConsole, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('gameplayers.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('gameplayers.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('gameplayers.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.game-players';
    }

    public function mount(): void
    {
        $this->load();
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('ld_refresh')
                ->label(Theme::trans('gameplayers.refresh'))
                ->icon('tabler-refresh')
                ->color('gray')
                ->action(fn () => $this->load()),
        ];
    }

    /**
     * Ask the server who is on it.
     *
     * The answer is held for twenty seconds by A2S itself, so pressing Refresh
     * twice in a row is one socket rather than two - and the button is honest
     * about that by simply redrawing whatever the cache now holds.
     */
    public function load(): void
    {
        $this->rows = [];
        $this->answered = false;

        try {
            $server = Filament::getTenant();

            if (!$server instanceof Server) {
                return;
            }

            $players = A2S::players($server);

            if ($players === null) {
                return;
            }

            $this->answered = true;

            // Longest on first. Somebody scanning this list is usually looking
            // for who has been there all evening rather than who joined a
            // minute ago.
            usort($players, static fn (array $a, array $b): int => $b['minutes'] <=> $a['minutes']);

            $this->rows = $players;
        } catch (Throwable) {
            // A page that says it could not ask, which is what $answered means.
        }
    }

    /** How long somebody has been on, in words. */
    public function spell(int $minutes): string
    {
        if ($minutes < 1) {
            return Theme::trans('gameplayers.just_joined');
        }

        if ($minutes < 60) {
            return Theme::trans('gameplayers.minutes', ['count' => $minutes]);
        }

        $hours = intdiv($minutes, 60);
        $rest = $minutes % 60;

        return $rest === 0
            ? Theme::trans('gameplayers.hours', ['count' => $hours])
            : Theme::trans('gameplayers.hours_minutes', ['hours' => $hours, 'minutes' => $rest]);
    }
}
