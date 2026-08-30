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
use LegendDevelopment\Theme\Support\Versions;
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

    /**
     * One per block, so a card is recognisable before it is read. All from
     * Tabler, which is the set the rest of the panel draws from.
     */
    private const ICONS = [
        'cpu' => 'tabler-cpu',
        'memory' => 'tabler-device-sd-card',
        'swap' => 'tabler-arrows-exchange',
        'disk' => 'tabler-database',
        'load' => 'tabler-activity',
        'uptime' => 'tabler-clock',
        'system' => 'tabler-server-2',
        'version' => 'tabler-package',
        'node' => 'tabler-server-2',
    ];

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

        $usage = [];
        $about = [];

        foreach (Status::blocks() as $block) {
            // A block is usually one card, but "disk" is one per filesystem:
            // the panel is normally on one and the server files on another, and
            // a root partition at 95% beside a data mount at 10% is exactly
            // what a single figure hides.
            foreach ($this->cardsFor($block, $readings[$block] ?? null) as $card) {
                // How hard the machine is working, and what the machine is, are
                // two questions. They get a heading each rather than being
                // interleaved for the reader to sort out.
                if (in_array($block, Status::USAGE, true)) {
                    $usage[] = $card;
                } else {
                    $about[] = $card;
                }
            }
        }

        $sections = [];

        foreach ([['usage', $usage], ['host', $about], ['nodes', $this->nodeCards()]] as [$key, $cards]) {
            if ($cards !== []) {
                $sections[] = ['title' => Theme::trans('system.section_' . $key), 'cards' => $cards];
            }
        }

        return [
            'sections' => $sections,
            // Seconds, or nothing. The view turns it into a wire:poll, so "off"
            // has to be an absent attribute rather than a zero.
            'refresh' => Status::refresh() === 'off' ? null : Status::refresh(),
        ];
    }

    /**
     * A card per chosen node, beside the panel's own.
     *
     * Every figure is Pelican's own, from the daemon on the node - the same
     * source the dashboard block uses, and already cached by the panel. Nothing
     * here reads the node's /proc, because the panel has no way to.
     *
     * @return array<int, array<string, mixed>>
     */
    private function nodeCards(): array
    {
        $chosen = Status::nodes();

        if ($chosen === []) {
            return [];
        }

        try {
            // With versions: this is the page that shows them.
            $nodes = Health::nodes($chosen, true);
        } catch (Throwable) {
            return [];
        }

        $cards = [];

        foreach ($nodes as $node) {
            $card = $this->blank('node');
            // A node is three readings side by side rather than one big figure,
            // and three bars squeezed into a column of a grid is the one shape
            // that does not suit.
            $card['wide'] = true;
            $card['kind'] = 'meters';
            $card['label'] = $node['name'];
            $card['figure'] = '';

            if ($node['maintenance']) {
                $card['flags'][] = ['text' => Theme::trans('nodes.maintenance'), 'kind' => 'maintenance'];
            } elseif (!$node['reachable']) {
                // Said plainly. A node that is not answering, drawn with three
                // empty bars, reads as a very idle machine.
                $card['flags'][] = ['text' => Theme::trans('nodes.offline'), 'kind' => 'offline'];
            }

            if ($node['version'] !== '') {
                $version = Versions::wings($node['version']);

                $card['details'][] = Theme::trans('system.wings', ['version' => $version['installed']]);
                $card['flags'] = array_merge($card['flags'], $this->versionFlags($version));
            }

            if ($node['reachable']) {
                $memory = Health::percent($node['memory_used'], $node['memory_total']);
                $disk = Health::percent($node['disk_used'], $node['disk_total']);

                $card['meters'] = [
                    $this->sub(Theme::trans('nodes.cpu'), $node['cpu'], round((float) $node['cpu'], 1) . '%'),
                    $this->sub(Theme::trans('nodes.memory'), $memory, $this->pair($node['memory_used'], $node['memory_total'])),
                    $this->sub(Theme::trans('nodes.disk'), $disk, $this->pair($node['disk_used'], $node['disk_total'])),
                ];

                if ($node['load'] !== null) {
                    $card['details'][] = Theme::trans('nodes.load') . ' ' . number_format((float) $node['load'], 2);
                }
            }

            $cards[] = $card;
        }

        return $cards;
    }

    /**
     * One small labelled bar inside a card.
     *
     * @return array<string, mixed>
     */
    private function sub(string $label, ?float $percent, string $value): array
    {
        return [
            'label' => $label,
            'value' => $value,
            'fill' => round(max(0, min(100, (float) $percent)), 1),
            'level' => Health::level($percent),
        ];
    }

    /**
     * The cards one block turns into - one, except for disks.
     *
     * @return array<int, array<string, mixed>>
     */
    private function cardsFor(string $block, mixed $reading): array
    {
        if ($block !== 'disk') {
            return [$this->card($block, $reading)];
        }

        $disks = is_array($reading) ? $reading : [];

        if ($disks === []) {
            return [$this->card('disk', null)];
        }

        $cards = [];

        foreach ($disks as $disk) {
            $card = $this->blank('disk');

            // The mount point, so two disks are told apart by the thing that
            // actually tells them apart. "Disk" and "Disk" is no help at all.
            $card['label'] = Theme::trans('system.block_disk') . ' ' . $disk['mount'];
            $card = $this->meter($card, Health::percent($disk['used'], $disk['total']));
            $card['details'][] = $this->pair($disk['used'], $disk['total']);

            if ($disk['panel']) {
                // Worth saying: it is the one that fills up when backups and
                // server files do.
                $card['details'][] = Theme::trans('system.disk_panel');
            }

            $cards[] = $card;
        }

        return $cards;
    }

    /**
     * A card with nothing read into it yet, which is also what a card that
     * could not be read stays as.
     *
     * @return array<string, mixed>
     */
    private function blank(string $block): array
    {
        return [
            'kind' => 'missing',
            'wide' => false,
            'label' => Theme::trans('system.block_' . $block),
            'icon' => self::ICONS[$block] ?? 'tabler-info-circle',
            // A list, because a card can want to say two things at once: a node
            // in maintenance that is also a version behind.
            'flags' => [],
            'figure' => Theme::trans('system.unavailable'),
            // Split off the figure so it can be set smaller and dimmer: the
            // number is the reading, the per cent sign is punctuation.
            'unit' => '',
            'details' => [],
            'meters' => [],
            'facts' => [],
            'level' => 'unknown',
            'fill' => 0,
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
        $card = $this->blank($block);

        if ($reading === null || $reading === [] || $reading === false) {
            return $card;
        }

        switch ($block) {
            case 'cpu':
                return $this->meter($card, (float) $reading);

            case 'memory':
                $card = $this->meter($card, Health::percent($reading['used'], $reading['total']));
                $card['details'][] = $this->pair($reading['used'], $reading['total']);

                return $card;

            case 'swap':
                /*
                 * Its own card, and its own colour rule. Swap sits at whatever
                 * high-water mark the machine once reached and stays there for
                 * weeks, so full swap beside comfortable memory is normal on a
                 * long-running host - painting it red would raise an alarm
                 * about a machine that is fine. Muted says "a reading", not "a
                 * problem".
                 */
                $card = $this->meter($card, Health::percent($reading['used'], $reading['total']));
                $card['level'] = 'muted';
                $card['details'][] = $this->pair($reading['used'], $reading['total']);

                return $card;

            case 'load':
                $one = (float) ($reading[0] ?? 0);
                $cores = Status::cores();

                /*
                 * A load average means nothing on its own: 8 is a machine at
                 * half effort on sixteen processors and a machine in trouble on
                 * four. When the core count can be had, the bar and the colour
                 * are load per processor; when it cannot, the figure stands
                 * alone rather than being coloured on a guess.
                 */
                $card = $cores !== null && $cores > 0
                    ? $this->meter($card, min(100, $one / $cores * 100), number_format($one, 2))
                    : $this->plain($card, number_format($one, 2));

                if ($cores !== null && $cores > 0) {
                    $card['details'][] = Theme::trans('system.load_cores', [
                        'percent' => round($one / $cores * 100),
                        'cores' => $cores,
                    ]);
                }

                $card['details'][] = Theme::trans('system.load_windows', [
                    'five' => number_format((float) ($reading[1] ?? 0), 2),
                    'fifteen' => number_format((float) ($reading[2] ?? 0), 2),
                ]);

                return $card;

            case 'uptime':
                $card = $this->plain($card, $this->duration((int) $reading));

                try {
                    $card['details'][] = Theme::trans('system.uptime_since', [
                        'date' => now()->subSeconds((int) $reading)->format('j M Y, H:i'),
                    ]);
                } catch (Throwable) {
                    // The duration is the reading; the date it implies is a
                    // convenience, and not worth failing the card over.
                }

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

            case 'version':
                $card['kind'] = 'facts';
                $card['facts'][] = [
                    'label' => Theme::trans('system.version_installed'),
                    'value' => $reading['installed'],
                ];

                /*
                 * The latest is only worth a line when it differs. A panel that
                 * is current does not need to be told its own version twice,
                 * and the flag in the header already says which state it is in.
                 */
                if ($reading['latest'] !== null && $reading['current'] === false) {
                    $card['facts'][] = [
                        'label' => Theme::trans('system.version_latest'),
                        'value' => $reading['latest'],
                    ];
                }

                $card['flags'] = $this->versionFlags($reading);

                return $card;
        }

        return $card;
    }

    /**
     * What a version reading says in the card's header.
     *
     * "Could not check" is its own answer rather than being folded into "up to
     * date": they are different facts, and only one of them is safe to guess.
     *
     * @param  array{installed: string, latest: ?string, current: ?bool}  $version
     * @return array<int, array<string, string>>
     */
    private function versionFlags(array $version): array
    {
        if ($version['current'] === null) {
            return [['text' => Theme::trans('system.version_unknown'), 'kind' => 'unknown']];
        }

        return $version['current']
            ? [['text' => Theme::trans('system.version_current'), 'kind' => 'current']]
            : [['text' => Theme::trans('system.version_update'), 'kind' => 'update']];
    }

    /**
     * A card with a bar: the figure, the fill and the colour all from one
     * percentage, unless a different figure is worth showing beside it.
     *
     * @param  array<string, mixed>  $card
     * @return array<string, mixed>
     */
    private function meter(array $card, ?float $percent, ?string $figure = null): array
    {
        if ($percent === null) {
            return $card;
        }

        $card['kind'] = 'meter';
        // No figure given means the percentage is the reading, and it gets the
        // sign. A figure given is something else measured against the bar - a
        // load average against the core count - and carries its own units or
        // none.
        $card['figure'] = $figure ?? (string) round($percent, 1);
        $card['unit'] = $figure === null ? '%' : '';
        $card['fill'] = round(max(0, min(100, $percent)), 1);
        $card['level'] = Health::level($percent);

        return $card;
    }

    /**
     * A card with a figure and no bar - something that is not a fraction of
     * anything, like how long the machine has been up.
     *
     * @param  array<string, mixed>  $card
     * @return array<string, mixed>
     */
    private function plain(array $card, string $figure): array
    {
        $card['kind'] = 'text';
        $card['figure'] = $figure;

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
                    'system_status_nodes' => Status::nodes(),
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
                        ->bulkToggleable()
                        ->columns(2),

                    /*
                     * Hidden on a panel with no nodes rather than shown empty:
                     * an empty tick list reads as something broken, and there
                     * is nothing here to choose between.
                     */
                    CheckboxList::make('system_status_nodes')
                        ->label(fn () => Theme::trans('system.nodes'))
                        ->helperText(fn () => Theme::trans('system.nodes_helper'))
                        ->options(fn () => Status::nodeOptions())
                        ->visible(fn () => Status::nodeOptions() !== [])
                        ->bulkToggleable()
                        ->searchable()
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
