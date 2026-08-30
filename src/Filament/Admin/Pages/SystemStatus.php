<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Support\NodeHealth as Health;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\SystemStatus as Status;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The panel's own machine, on a page of its own.
 *
 * A different question from the node health block on the dashboard: that one
 * asks the daemon about the machines the servers run on, this one reads the
 * host the web interface is on. On a single-box install they agree; on any
 * install with a separate node they do not, and both are worth knowing.
 *
 * The options live in a modal on this page rather than in the theme's settings.
 * Which blocks to show and how often to look are things you decide while
 * looking at them.
 */
class SystemStatus extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-cpu';

    protected static ?string $slug = 'system-status';

    /** Last in the plugin's own group. */
    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    /**
     * Switched off takes it out of the sidebar, and no further.
     *
     * The switch is on this page, so a switch that also closed the page would
     * be a one-way door - off, gone, and nothing left to turn it back on with
     * short of editing .env by hand. The address keeps working; the row does
     * not appear.
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Status::enabled() && parent::shouldRegisterNavigation();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.system-status';
    }

    public function getTitle(): string
    {
        return Theme::trans('system.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('system.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('system.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $readings = [];

        try {
            $readings = Status::all();
        } catch (Throwable) {
            // A host that will not be read is a page of "not available", not an
            // error page.
        }

        $cards = [];

        foreach (Status::blocks() as $block) {
            $cards[] = $this->card($block, $readings[$block] ?? null);
        }

        return [
            'cards' => $cards,
            // Seconds, or nothing. The view turns it into a wire:poll, so "off"
            // has to be an absent attribute rather than a zero.
            'refresh' => Status::refresh() === 'off' ? null : Status::refresh(),
        ];
    }

    /**
     * One reading, worked out into what the view puts on the page.
     *
     * Everything is decided here rather than in Blade: a view that calls into
     * the theme's own classes is a view that can throw halfway through the
     * markup, which is the one place there is no good way to report it.
     *
     * @return array<string, mixed>
     */
    private function card(string $block, mixed $reading): array
    {
        $card = [
            'kind' => 'missing',
            'label' => Theme::trans('system.block_' . $block),
            'figure' => Theme::trans('system.unavailable'),
            'details' => [],
            'facts' => [],
            'level' => 'unknown',
            'fill' => 0,
        ];

        if ($reading === null || $reading === [] || $reading === false) {
            return $card;
        }

        switch ($block) {
            case 'cpu':
                return $this->meter($card, (float) $reading, round((float) $reading, 1) . '%');

            case 'memory':
                $percent = Health::percent($reading['used'], $reading['total']);
                $card = $this->meter($card, $percent, round((float) $percent, 1) . '%');
                $card['details'][] = $this->pair($reading['used'], $reading['total']);

                // Only when there is any. A machine with swap switched off
                // saying "0 B / 0 B" is a line that reads like a fault.
                if ($reading['swap_total'] > 0) {
                    $card['details'][] = Theme::trans('system.swap') . ' '
                        . $this->pair($reading['swap_used'], $reading['swap_total']);
                }

                return $card;

            case 'disk':
                $percent = Health::percent($reading['used'], $reading['total']);
                $card = $this->meter($card, $percent, round((float) $percent, 1) . '%');
                $card['details'][] = $this->pair($reading['used'], $reading['total']);

                return $card;

            case 'load':
                $card['kind'] = 'text';
                $card['figure'] = number_format((float) ($reading[0] ?? 0), 2);
                $card['details'][] = Theme::trans('system.load_windows', [
                    'five' => number_format((float) ($reading[1] ?? 0), 2),
                    'fifteen' => number_format((float) ($reading[2] ?? 0), 2),
                ]);

                return $card;

            case 'uptime':
                $card['kind'] = 'text';
                $card['figure'] = $this->duration((int) $reading);

                return $card;

            case 'system':
                $card['kind'] = 'facts';

                foreach ($reading as $key => $value) {
                    $card['facts'][] = [
                        'label' => Theme::trans('system.fact_' . $key),
                        'value' => (string) $value,
                    ];
                }

                return $card;
        }

        return $card;
    }

    /**
     * @param  array<string, mixed>  $card
     * @return array<string, mixed>
     */
    private function meter(array $card, ?float $percent, string $figure): array
    {
        if ($percent === null) {
            return $card;
        }

        $card['kind'] = 'meter';
        $card['figure'] = $figure;
        $card['fill'] = round(max(0, min(100, $percent)), 1);
        $card['level'] = Health::level($percent);

        return $card;
    }

    /**
     * "used / total", in bytes said the way a person would.
     *
     * Not NodeHealth::bytes() straight through: that answers an em dash for
     * nought, which is right for a node that could not be reached and wrong
     * here, where a machine with swap allocated and none of it touched is
     * telling you something and should say 0 B.
     */
    private function pair(int $used, int $total): string
    {
        $said = static fn (int $bytes): string => $bytes > 0 ? Health::bytes($bytes) : '0 B';

        return $said($used) . ' / ' . $said($total);
    }

    /** Seconds as days, hours and minutes, dropping the parts that are nought. */
    private function duration(int $seconds): string
    {
        $days = intdiv($seconds, 86400);
        $hours = intdiv($seconds % 86400, 3600);
        $minutes = intdiv($seconds % 3600, 60);

        $parts = [];

        if ($days > 0) {
            $parts[] = $days . 'd';
        }

        if ($days > 0 || $hours > 0) {
            $parts[] = $hours . 'h';
        }

        // Always, so a machine up for forty seconds says "0m" rather than
        // nothing at all.
        $parts[] = $minutes . 'm';

        return implode(' ', $parts);
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('options')
                ->label(fn () => Theme::trans('system.options'))
                ->icon('tabler-settings')
                ->visible(fn () => user()?->can(Theme::PERMISSION_UPDATE) ?? false)
                ->fillForm(fn (): array => [
                    'system_status' => Status::enabled(),
                    'system_status_refresh' => Status::refresh(),
                    'system_status_blocks' => Status::blocks(),
                ])
                ->schema([
                    Toggle::make('system_status')
                        ->label(fn () => Theme::trans('system.enabled'))
                        ->helperText(fn () => Theme::trans('system.enabled_helper')),

                    Select::make('system_status_refresh')
                        ->label(fn () => Theme::trans('system.refresh'))
                        ->helperText(fn () => Theme::trans('system.refresh_helper'))
                        ->options(fn () => Status::refreshOptions())
                        ->selectablePlaceholder(false)
                        ->required(),

                    CheckboxList::make('system_status_blocks')
                        ->label(fn () => Theme::trans('system.blocks'))
                        ->helperText(fn () => Theme::trans('system.blocks_helper'))
                        ->options(fn () => Status::blockOptions())
                        ->columns(2),
                ])
                ->action(function (array $data): void {
                    if (!user()?->can(Theme::PERMISSION_UPDATE)) {
                        return;
                    }

                    try {
                        Settings::persistSystemStatus($data);

                        Notification::make()
                            ->title(Theme::trans('page.saved'))
                            ->success()
                            ->send();

                        // Reloaded, so the new interval is the one the page is
                        // now polling on rather than the one it was opened with.
                        $this->redirect(self::getUrl());
                    } catch (Throwable $exception) {
                        report($exception);

                        Notification::make()
                            ->title(Theme::trans('page.save_failed'))
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
