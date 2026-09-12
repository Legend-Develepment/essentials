<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Addon;
use LegendDevelopment\Theme\Models\OrderAddon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Things sold alongside a package.
 *
 * Three decisions per extra, and the page is arranged as those three. What it
 * is and what it costs. Which packages it fits, or all of them. And what it
 * adds to the server, which may be nothing at all - priority support is an
 * extra that changes no limit anywhere and is a perfectly ordinary thing to
 * sell.
 *
 * **The limits are deltas.** The form says so in as many words, because it is
 * the one thing about this page somebody can get wrong in a way that is not
 * obvious afterwards: typing 4096 in memory does not make the server 4 GB, it
 * makes it 4 GB bigger. Two of them bought together add up, which is exactly
 * why they are written this way.
 */
class ShopAddons extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-puzzle';

    protected static ?string $slug = 'essentials-addons';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::ADDONS) && Tables::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::canAccess() && parent::shouldRegisterNavigation();
    }

    public function getTitle(): string
    {
        return Theme::trans('addons.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('addons.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('addons.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.addons';
    }

    public function table(Table $table): Table
    {
        $currency = Packages::currency();

        return $table
            ->query(fn (): Builder => Addon::query())
            ->defaultSort('sort')
            ->columns([
                TextColumn::make('name')
                    ->label(Theme::trans('addons.column_name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(static fn (Addon $record): ?string => $record->description),

                TextColumn::make('price')
                    ->label(Theme::trans('addons.column_price'))
                    ->sortable()
                    ->formatStateUsing(static fn (Addon $record): string => Money::format(
                        (int) $record->price,
                        $currency,
                    ))
                    ->description(static fn (Addon $record): string => Theme::trans(
                        $record->recurring() ? 'addons.billing_with' : 'addons.billing_once',
                    )),

                /*
                 * What it actually does, in words rather than seven columns.
                 *
                 * "Nothing on the server" is a real answer here and worth
                 * saying out loud: it is what priority support looks like, and
                 * an empty cell would read as a mistake.
                 */
                TextColumn::make('ld_adds')
                    ->label(Theme::trans('addons.column_adds'))
                    ->state(static fn (Addon $record): string => self::adds($record))
                    ->wrap(),

                TextColumn::make('ld_sold')
                    ->label(Theme::trans('addons.column_sold'))
                    ->state(static fn (Addon $record): int => self::sold((int) $record->id))
                    ->alignEnd(),

                IconColumn::make('live')
                    ->label(Theme::trans('addons.column_live'))
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('live')
                    ->label(Theme::trans('addons.column_live')),
            ])
            ->recordActions([
                Action::make('ld_edit')
                    ->label(Theme::trans('addons.edit'))
                    ->icon('tabler-pencil')
                    ->slideOver()
                    ->modalWidth(Width::Large)
                    ->schema(self::fields())
                    ->fillForm(static fn (Addon $record): array => self::toForm($record))
                    ->visible(static fn (): bool => Features::mayManage(Features::ADDONS))
                    ->action(fn (Addon $record, array $data) => $this->update($record, $data)),

                Action::make('ld_live')
                    ->label(static fn (Addon $record): string => $record->live
                        ? Theme::trans('addons.go_offline')
                        : Theme::trans('addons.go_live'))
                    ->icon(static fn (Addon $record): string => $record->live ? 'tabler-eye-off' : 'tabler-eye')
                    ->color('gray')
                    ->visible(static fn (): bool => Features::mayManage(Features::ADDONS))
                    ->action(fn (Addon $record) => $this->toggle($record)),

                Action::make('ld_delete')
                    ->label(Theme::trans('addons.delete'))
                    ->icon('tabler-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(static fn (Addon $record): string => self::sold((int) $record->id) > 0
                        ? Theme::trans('addons.delete_sold', ['count' => self::sold((int) $record->id)])
                        : Theme::trans('addons.delete_confirm'))
                    ->visible(static fn (): bool => Features::mayManage(Features::ADDONS))
                    ->action(fn (Addon $record) => $this->remove($record)),
            ])
            ->emptyStateHeading(Theme::trans('addons.empty'))
            ->emptyStateDescription(Theme::trans('addons.empty_body'))
            ->emptyStateIcon('tabler-puzzle');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::ADDONS)) {
            return [];
        }

        return [
            Action::make('ld_new')
                ->label(Theme::trans('addons.new'))
                ->icon('tabler-plus')
                ->slideOver()
                ->modalWidth(Width::Large)
                ->schema(self::fields())
                ->action(fn (array $data) => $this->create($data)),
        ];
    }

    /**
     * The form, shared by New and Edit.
     *
     * @return array<int, mixed>
     */
    private static function fields(): array
    {
        $currency = Packages::currency();

        return [
            Section::make(Theme::trans('addons.section_what'))
                ->description(Theme::trans('addons.section_what_helper'))
                ->schema([
                    TextInput::make('name')
                        ->label(Theme::trans('addons.name'))
                        ->required()
                        ->maxLength(191),

                    TextInput::make('price')
                        ->label(Theme::trans('addons.price'))
                        ->helperText(Theme::trans('addons.price_helper'))
                        ->prefix(Money::symbol($currency))
                        ->required(),

                    Select::make('billing')
                        ->label(Theme::trans('addons.billing'))
                        ->helperText(Theme::trans('addons.billing_helper'))
                        ->options([
                            Addon::WITH => Theme::trans('addons.billing_with'),
                            Addon::ONCE => Theme::trans('addons.billing_once'),
                        ])
                        ->default(Addon::WITH)
                        ->selectablePlaceholder(false)
                        ->required(),

                    TextInput::make('max')
                        ->label(Theme::trans('addons.max'))
                        ->helperText(Theme::trans('addons.max_helper'))
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(999)
                        ->default(1),

                    Textarea::make('description')
                        ->label(Theme::trans('addons.description'))
                        ->helperText(Theme::trans('addons.description_helper'))
                        ->rows(2)
                        ->maxLength(2000)
                        ->columnSpanFull(),

                    CheckboxList::make('package_ids')
                        ->label(Theme::trans('addons.packages'))
                        ->helperText(Theme::trans('addons.packages_helper'))
                        ->options(static fn (): array => self::packageOptions())
                        ->columns(['default' => 1, 'sm' => 2])
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'sm' => 2]),

            Section::make(Theme::trans('addons.section_adds'))
                ->description(Theme::trans('addons.section_adds_helper'))
                ->schema([
                    TextInput::make('memory')
                        ->label(Theme::trans('packages.memory'))
                        ->numeric()
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(0),

                    TextInput::make('disk')
                        ->label(Theme::trans('packages.disk'))
                        ->numeric()
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(0),

                    TextInput::make('swap')
                        ->label(Theme::trans('packages.swap'))
                        ->numeric()
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(0),

                    TextInput::make('cpu')
                        ->label(Theme::trans('packages.cpu'))
                        ->numeric()
                        ->suffix(Theme::trans('packages.unit_percent'))
                        ->default(0),

                    TextInput::make('database_limit')
                        ->label(Theme::trans('packages.databases'))
                        ->numeric()
                        ->default(0),

                    TextInput::make('allocation_limit')
                        ->label(Theme::trans('packages.allocations'))
                        ->numeric()
                        ->default(0),

                    TextInput::make('backup_limit')
                        ->label(Theme::trans('packages.backups'))
                        ->numeric()
                        ->default(0),

                    TextInput::make('sort')
                        ->label(Theme::trans('addons.sort'))
                        ->helperText(Theme::trans('addons.sort_helper'))
                        ->numeric()
                        ->default(0),

                    Toggle::make('live')
                        ->label(Theme::trans('addons.live'))
                        ->helperText(Theme::trans('addons.live_helper'))
                        ->default(true)
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'sm' => 2]),
        ];
    }

    /**
     * A stored row as the form shows it.
     *
     * @return array<string, mixed>
     */
    private static function toForm(Addon $addon): array
    {
        $data = $addon->toArray();

        $data['price'] = Money::toInput((int) $addon->price);
        $data['package_ids'] = is_array($addon->package_ids) ? $addon->package_ids : [];

        return $data;
    }

    /**
     * What the form typed, as the row keeps it.
     *
     * Null when the name or the price is not usable, which is the one thing
     * this refuses: everything else has a sensible nought.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>|null
     */
    private static function sanitise(array $data): ?array
    {
        $name = mb_substr(trim((string) ($data['name'] ?? '')), 0, 191);
        $price = Money::fromInput($data['price'] ?? null);

        if ($name === '' || $price === null) {
            return null;
        }

        $packages = [];

        foreach ((array) ($data['package_ids'] ?? []) as $id) {
            if (is_numeric($id) && (int) $id > 0) {
                $packages[] = (int) $id;
            }
        }

        $out = [
            'name' => $name,
            'description' => mb_substr(trim((string) ($data['description'] ?? '')), 0, 2000) ?: null,
            'price' => $price,
            'billing' => in_array($data['billing'] ?? '', Addon::BILLING, true)
                ? (string) $data['billing']
                : Addon::WITH,
            'package_ids' => array_values(array_unique($packages)),
            'max' => max(1, min(999, (int) ($data['max'] ?? 1))),
            'live' => (bool) ($data['live'] ?? true),
            'sort' => (int) ($data['sort'] ?? 0),
        ];

        /*
         * The deltas, as whole numbers of whatever their unit is.
         *
         * Signed on purpose: an extra may take something away as readily as
         * give it, and a shop that wanted to sell "no backups, cheaper" should
         * be able to. Clamped only against the absurd.
         */
        foreach (Addon::LIMITS as $limit) {
            $out[$limit] = max(-1000000, min(1000000, (int) ($data[$limit] ?? 0)));
        }

        return $out;
    }

    /** @return array<int, string> */
    private static function packageOptions(): array
    {
        try {
            return Package::query()->orderBy('name')->pluck('name', 'id')->all();
        } catch (Throwable) {
            return [];
        }
    }

    /** What this extra adds, said in words. */
    private static function adds(Addon $addon): string
    {
        $parts = [];

        foreach ($addon->deltas() as $limit => $delta) {
            if ($delta === 0) {
                continue;
            }

            $parts[] = ($delta > 0 ? '+' : '') . $delta . ' ' . Theme::trans('addons.unit_' . $limit);
        }

        return $parts === [] ? Theme::trans('addons.adds_nothing') : implode(', ', $parts);
    }

    /** How many services carry it. */
    private static function sold(int $addonId): int
    {
        try {
            return OrderAddon::query()->where('addon_id', $addonId)->count();
        } catch (Throwable) {
            return 0;
        }
    }

    /** @param array<string, mixed> $data */
    private function create(array $data): void
    {
        abort_unless(Features::mayManage(Features::ADDONS), 403);

        $clean = self::sanitise($data);

        if ($clean === null) {
            $this->invalid();

            return;
        }

        $this->guard(function () use ($clean): void {
            Addon::query()->create($clean);

            Notification::make()->title(Theme::trans('addons.saved'))->success()->send();
        });
    }

    /** @param array<string, mixed> $data */
    private function update(Addon $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::ADDONS), 403);

        $clean = self::sanitise($data);

        if ($clean === null) {
            $this->invalid();

            return;
        }

        $this->guard(function () use ($record, $clean): void {
            $record->update($clean);

            Notification::make()->title(Theme::trans('addons.saved'))->success()->send();
        });
    }

    private function toggle(Addon $record): void
    {
        abort_unless(Features::mayManage(Features::ADDONS), 403);

        $this->guard(function () use ($record): void {
            $record->update(['live' => !$record->live]);

            Notification::make()->title(Theme::trans('addons.saved'))->success()->send();
        });
    }

    /**
     * Take one off the list.
     *
     * The rows on people's services survive it: addon_id goes null and the
     * snapshot on each of them keeps the name, the price and what it adds. A
     * customer paying for two gigabytes keeps two gigabytes and keeps being
     * billed for them, which is the only honest answer - the alternative is
     * quietly shrinking somebody's server because a price list was tidied.
     */
    private function remove(Addon $record): void
    {
        abort_unless(Features::mayManage(Features::ADDONS), 403);

        $this->guard(function () use ($record): void {
            $record->delete();

            Notification::make()->title(Theme::trans('addons.deleted'))->success()->send();
        });
    }

    private function invalid(): void
    {
        Notification::make()
            ->title(Theme::trans('addons.save_failed'))
            ->body(Theme::trans('addons.invalid'))
            ->danger()
            ->send();
    }

    /** One try/catch for every write on this page. */
    private function guard(callable $work): void
    {
        try {
            $work();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('addons.save_failed'))
                ->body(Theme::trans('addons.save_failed_body'))
                ->danger()
                ->send();
        }
    }
}
