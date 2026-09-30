<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Egg;
use App\Models\Node;
use BackedEnum;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Artwork\Library;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Hostnames;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Shop\Ports;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Every package, and the form that makes one.
 *
 * A package is Pelican's own Create Server form saved for later with a price on
 * it, and this page asks the same questions that form asks - egg, image,
 * startup, variables, limits - in the same units, so that what an administrator
 * writes here is exactly what a customer's server will be. Picking an egg fills
 * the rest in from the egg's own defaults, the way Pelican's page does.
 *
 * Nothing here can be bought yet. This release makes the shelf; the next one
 * opens the door.
 */
class ShopPackages extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-package';

    protected static ?string $slug = 'essentials-packages';

    protected static ?int $navigationSort = 1;

    /**
     * What the offer on this package is worth, as the badge says it.
     *
     * A percentage where it is one, money where it is one, and the condition
     * appended where the offer waits for a fuller basket - so a row says "Sale
     * 25% from 2" and nobody has to open it to find out which of those three
     * things they set.
     */
    private static function offerWorth(Package $package): string
    {
        $value = max(0, (int) $package->offer_value);

        $worth = (string) $package->offer_kind === Packages::OFFER_AMOUNT
            ? Money::format($value, Packages::currency())
            : $value . '%';

        $needs = Packages::offerNeeds($package);

        return $needs > 1
            ? $worth . ' ' . Theme::trans('packages.column_flags_from', ['count' => $needs])
            : $worth;
    }

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::PACKAGES) && Tables::ready();
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
        return Theme::trans('packages.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('packages.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('packages.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.packages';
    }

    public function table(Table $table): Table
    {
        $currency = Packages::currency();

        return $table
            ->query(fn (): Builder => Package::query()->with('egg')->withCount('orders'))
            ->defaultSort('sort')
            ->reorderable('sort')
            ->columns([
                TextColumn::make('name')
                    ->label(Theme::trans('packages.column_name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->wrap()
                    ->description(static fn (Package $record): ?string => $record->description ?: null),

                /*
                 * Which of these is on sale and which one is being pointed at.
                 *
                 * On the packages page and not only in the shop, because this
                 * is where somebody decides - and a table that cannot say which
                 * of eight packages is discounted is a table you have to open
                 * eight rows to read. The badge carries the discount as well as
                 * the fact of it, so the answer to "how much" is in the same
                 * glance as "which one".
                 *
                 * One column for the pair rather than two, because a package is
                 * usually one or the other and two mostly empty columns cost
                 * more width than the table has to spare.
                 */
                TextColumn::make('ld_flags')
                    ->label(Theme::trans('packages.column_flags'))
                    ->badge()
                    ->state(static function (Package $record): array {
                        $out = [];

                        if (Packages::onOffer($record)) {
                            $out[] = Theme::trans('shop.offer_flag') . ' ' . self::offerWorth($record);
                        }

                        if ((bool) $record->popular) {
                            $out[] = Theme::trans('shop.popular_flag');
                        }

                        return $out;
                    })
                    ->color(static fn (string $state): string => str_starts_with(
                        $state,
                        Theme::trans('shop.offer_flag'),
                    ) ? 'danger' : 'warning')
                    ->icon(static fn (string $state): string => str_starts_with(
                        $state,
                        Theme::trans('shop.offer_flag'),
                    ) ? 'tabler-rosette-discount' : 'tabler-crown')
                    ->placeholder(''),

                TextColumn::make('egg.name')
                    ->label(Theme::trans('packages.column_egg'))
                    ->placeholder(Theme::trans('packages.no_egg'))
                    ->sortable(),

                TextColumn::make('price')
                    ->label(Theme::trans('packages.column_price'))
                    ->sortable()
                    ->formatStateUsing(static fn (Package $record): string => Packages::priceLabel($record, $currency))
                    ->description(static fn (Package $record): ?string => $record->setup_fee > 0
                        ? '+ ' . Money::format((int) $record->setup_fee, $currency)
                        : null),

                TextColumn::make('stock')
                    ->label(Theme::trans('packages.column_stock'))
                    ->formatStateUsing(static function (Package $record): string {
                        $left = Packages::stockLeft($record);

                        if ($left === null) {
                            return Theme::trans('packages.stock_unlimited');
                        }

                        return $left === 0
                            ? Theme::trans('packages.stock_out')
                            : Theme::trans('packages.stock_left', ['count' => $left]);
                    })
                    ->placeholder(Theme::trans('packages.stock_unlimited')),

                /*
                 * Which ports this package sells into, in the list of packages.
                 *
                 * **This is where somebody looks.** The settings page has an
                 * overview of the same thing and that is still worth having,
                 * but a column here is the answer to "which ports belong to
                 * which package" asked while looking at the packages, which is
                 * when it gets asked.
                 *
                 * The free count sits underneath rather than in its own column:
                 * it is the second thing you want about a range and never the
                 * first, and a table on an admin page has only so much room
                 * before it starts wrapping.
                 */
                TextColumn::make('port_from')
                    ->label(Theme::trans('packages.column_ports'))
                    ->placeholder(Theme::trans('packages.ports_any'))
                    ->formatStateUsing(static function (Package $record): string {
                        $range = Ports::forPackage($record);

                        return $range === null
                            ? Theme::trans('packages.ports_any')
                            : $range['from'] . ' - ' . $range['to'];
                    })
                    ->description(static function (Package $record): ?string {
                        $range = Ports::forPackage($record);

                        if ($range === null) {
                            return null;
                        }

                        $nodes = is_array($record->node_ids) ? array_map('intval', $record->node_ids) : [];
                        $count = Ports::count($range, $nodes);

                        if ($count === null) {
                            return null;
                        }

                        return Theme::trans(
                            $count['free'] <= Ports::WARN_AT ? 'packages.ports_low' : 'packages.ports_left',
                            ['free' => $count['free'], 'total' => $count['total']],
                        );
                    })
                    ->color(static function (Package $record): ?string {
                        $range = Ports::forPackage($record);

                        if ($range === null) {
                            return null;
                        }

                        $nodes = is_array($record->node_ids) ? array_map('intval', $record->node_ids) : [];
                        $count = Ports::count($range, $nodes);

                        return $count !== null && $count['free'] <= Ports::WARN_AT ? 'danger' : null;
                    })
                    ->sortable(),

                TextColumn::make('orders_count')
                    ->label(Theme::trans('packages.column_orders'))
                    ->sortable(),

                IconColumn::make('live')
                    ->label(Theme::trans('packages.column_live'))
                    ->boolean()
                    ->tooltip(static fn (Package $record): string => $record->live && $record->buildable()
                        ? Theme::trans('packages.live')
                        : Theme::trans('packages.offline')),
            ])
            ->filters([
                TernaryFilter::make('live')
                    ->label(Theme::trans('packages.column_live')),

                // Both flags are a column already; these are for the shop that
                // has thirty packages rather than three, where seeing which one
                // is on sale and finding it are different problems.
                TernaryFilter::make('offer')
                    ->label(Theme::trans('shop.offer_flag')),

                TernaryFilter::make('popular')
                    ->label(Theme::trans('shop.popular_flag')),
            ])
            ->recordActions([
                Action::make('ld_edit')
                    ->label(Theme::trans('packages.edit'))
                    ->icon('tabler-pencil')
                    ->slideOver()
                    ->modalWidth(Width::TwoExtraLarge)
                    ->schema(self::fields())
                    ->fillForm(static fn (Package $record): array => Packages::toForm($record))
                    ->visible(static fn (): bool => Features::mayManage(Features::PACKAGES))
                    ->action(fn (Package $record, array $data) => $this->update($record, $data)),

                Action::make('ld_live')
                    ->label(static fn (Package $record): string => $record->live
                        ? Theme::trans('packages.go_offline')
                        : Theme::trans('packages.go_live'))
                    ->icon(static fn (Package $record): string => $record->live ? 'tabler-eye-off' : 'tabler-eye')
                    ->color('gray')
                    ->visible(static fn (): bool => Features::mayManage(Features::PACKAGES))
                    ->action(fn (Package $record) => $this->toggle($record)),

                Action::make('ld_copy')
                    ->label(Theme::trans('packages.duplicate'))
                    ->icon('tabler-copy')
                    ->color('gray')
                    ->visible(static fn (): bool => Features::mayManage(Features::PACKAGES))
                    ->action(fn (Package $record) => $this->copy($record)),

                Action::make('ld_delete')
                    ->label(Theme::trans('packages.delete'))
                    ->icon('tabler-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    /*
                     * A package somebody bought is a different sentence from
                     * one nobody did, and the difference is the thing an
                     * administrator is actually asking about: what happens to
                     * the servers. So the confirmation counts them and says.
                     */
                    ->modalDescription(static function (Package $record): string {
                        $sold = self::soldCount($record);

                        return $sold === 0
                            ? Theme::trans('packages.delete_confirm')
                            : Theme::trans('packages.delete_confirm_sold', ['count' => $sold]);
                    })
                    ->visible(static fn (): bool => Features::mayManage(Features::PACKAGES))
                    ->action(fn (Package $record) => $this->delete($record)),
            ])
            ->emptyStateHeading(Theme::trans('packages.empty'))
            ->emptyStateDescription(Theme::trans('packages.empty_body'))
            ->emptyStateIcon('tabler-package');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::PACKAGES)) {
            return [];
        }

        return [
            Action::make('ld_new')
                ->label(Theme::trans('packages.new'))
                ->icon('tabler-plus')
                ->slideOver()
                ->modalWidth(Width::TwoExtraLarge)
                ->schema(self::fields())
                ->action(fn (array $data) => $this->create($data)),
        ];
    }

    /**
     * The form, shared by New and Edit so the two can never drift apart.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function fields(): array
    {
        return [
            Section::make(Theme::trans('packages.section_basics'))
                ->description(Theme::trans('packages.section_basics_helper'))
                ->schema([
                    TextInput::make('name')
                        ->label(Theme::trans('packages.name'))
                        ->helperText(Theme::trans('packages.name_helper'))
                        ->required()
                        ->maxLength(120),

                    TextInput::make('slug')
                        ->label(Theme::trans('packages.slug'))
                        ->helperText(Theme::trans('packages.slug_helper'))
                        ->maxLength(64)
                        ->regex('/^[a-z0-9][a-z0-9-]*$/'),

                    Textarea::make('description')
                        ->label(Theme::trans('packages.description'))
                        ->helperText(Theme::trans('packages.description_helper'))
                        ->rows(3)
                        ->maxLength(2000)
                        ->columnSpanFull(),

                    Toggle::make('popular')
                        ->label(Theme::trans('packages.popular'))
                        ->helperText(Theme::trans('packages.popular_helper')),

                    /*
 * The offer, as three fields that only appear once it is on.
 *
 * A percentage or an amount rather than both at once: a package is one or
 * the other, and two boxes would let it be neither clearly.
 */
                    Toggle::make('offer')
                        ->label(Theme::trans('packages.offer'))
                        ->helperText(Theme::trans('packages.offer_helper'))
                        ->live(),

                    Select::make('offer_kind')
                        ->label(Theme::trans('packages.offer_kind'))
                        // The sentence under the value below says whether it is
                        // a percentage or money, so changing this has to reach
                        // it - and now that the box takes 2,50 as well, being
                        // told which one it is reading matters more.
                        ->live()
                        ->options([
                            'percent' => Theme::trans('packages.offer_percent'),
                            'amount' => Theme::trans('packages.offer_amount'),
                        ])
                        ->default('percent')
                        ->selectablePlaceholder(false)
                        ->visible(fn (Get $get): bool => (bool) $get('offer')),

                    TextInput::make('offer_value')
                        ->label(Theme::trans('packages.offer_value'))
                        ->helperText(fn (Get $get): string => Theme::trans(
                            $get('offer_kind') === 'amount' ? 'packages.offer_value_amount' : 'packages.offer_value_percent',
                        ))
                        /*
                         * Typed the way the prices further down are typed,
                         * because an amount off is money: 2,50 has to get
                         * through, and ->numeric() refuses a comma in half of
                         * Europe. A percentage goes through the same box
                         * unharmed, being a plain number either way. The
                         * pattern allows no minus sign, which is what
                         * ->minValue(0) was there for.
                         */
                        ->maxLength(16)
                        ->regex('/^[0-9 .,]*$/')
                        ->visible(fn (Get $get): bool => (bool) $get('offer')),

                    TextInput::make('offer_min_items')
                        ->label(Theme::trans('packages.offer_min'))
                        ->helperText(Theme::trans('packages.offer_min_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(20)
                        ->visible(fn (Get $get): bool => (bool) $get('offer')),

                    Toggle::make('live')
                        ->label(Theme::trans('packages.live_field'))
                        ->helperText(Theme::trans('packages.live_helper'))
                        ->inline(false),

                    TextInput::make('sort')
                        ->label(Theme::trans('packages.sort'))
                        ->helperText(Theme::trans('packages.sort_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1000)
                        ->default(0),
                ])
                ->columns(['default' => 1, 'sm' => 2]),

            Section::make(Theme::trans('packages.section_server'))
                ->description(Theme::trans('packages.section_server_helper'))
                ->schema([
                    /*
                     * Live, and it fills three other fields when it changes -
                     * the same thing Pelican's own Create Server page does the
                     * moment an egg is chosen. Done here rather than left to
                     * the administrator because the egg's defaults are the
                     * right answer nineteen times out of twenty.
                     */
                    Select::make('egg_id')
                        ->label(Theme::trans('packages.egg'))
                        ->helperText(Theme::trans('packages.egg_helper'))
                        ->options(static fn (): array => Packages::eggOptions())
                        ->searchable()
                        ->required()
                        ->live()
                        ->afterStateUpdated(static function ($state, Set $set): void {
                            $defaults = Packages::eggDefaults((int) $state);

                            $set('image', $defaults['image']);
                            $set('startup', $defaults['startup']);
                            $set('environment', $defaults['environment']);
                        })
                        ->columnSpanFull(),

                    Select::make('image')
                        ->label(Theme::trans('packages.image'))
                        ->helperText(Theme::trans('packages.image_helper'))
                        ->options(static fn (Get $get): array => Packages::images(self::int($get('egg_id'))))
                        ->placeholder(Theme::trans('packages.image_default')),

                    Select::make('startup')
                        ->label(Theme::trans('packages.startup'))
                        ->helperText(Theme::trans('packages.startup_helper'))
                        ->options(static fn (Get $get): array => Packages::startups(self::int($get('egg_id'))))
                        ->placeholder(Theme::trans('packages.startup_default')),

                    KeyValue::make('environment')
                        ->label(Theme::trans('packages.environment'))
                        ->helperText(Theme::trans('packages.environment_helper'))
                        ->keyLabel(Theme::trans('packages.env_key'))
                        ->valueLabel(Theme::trans('packages.env_value'))
                        ->columnSpanFull(),

                    CheckboxList::make('node_ids')
                        ->label(Theme::trans('packages.nodes'))
                        ->helperText(Theme::trans('packages.nodes_helper'))
                        // The free-port count below is counted over the nodes
                        // ticked here, so ticking one has to reach it.
                        ->live()
                        ->options(static fn (): array => self::nodeOptions())
                        ->columns(['default' => 1, 'sm' => 2])
                        ->columnSpanFull(),

                    /*
                     * Which ports a purchase of this package lands on.
                     *
                     * On the package because the package is the thing being
                     * sold and the thing somebody is already editing when they
                     * think about this. It was a list in the shop settings with
                     * packages pointing at entries by name for one release, and
                     * that was one indirection too many: two screens to set one
                     * number, and a package whose ports were decided somewhere
                     * the person editing it could not see.
                     *
                     * Both ends or neither. A package with one filled in is one
                     * somebody started and did not finish, and guessing the
                     * other end would be the form deciding something nobody
                     * asked it to.
                     *
                     * The count beside them is live and is the point of them. A
                     * range is four digits that mean nothing until somebody
                     * knows how many of them are free, and finding that out
                     * otherwise means a query nobody is going to write.
                     */
                    TextInput::make('port_from')
                        ->label(Theme::trans('packages.port_from'))
                        ->helperText(Theme::trans('packages.port_range_helper'))
                        /*
                         * On leaving the field rather than on every key.
                         *
                         * The count underneath is the reason these two are
                         * worth filling in, and it sat at "fill in both
                         * numbers" until the page was reloaded. Each refresh is
                         * two queries against the allocations table, and half a
                         * port number is not a question worth answering.
                         */
                        ->live(onBlur: true)
                        ->numeric()
                        ->minValue(Ports::LOWEST)
                        ->maxValue(Ports::HIGHEST)
                        ->requiredWith('port_to')
                        ->columnSpan(1),

                    TextInput::make('port_to')
                        ->label(Theme::trans('packages.port_to'))
                        ->live(onBlur: true)
                        ->numeric()
                        ->minValue(Ports::LOWEST)
                        ->maxValue(Ports::HIGHEST)
                        ->requiredWith('port_from')
                        ->columnSpan(1),

                    Placeholder::make('port_free')
                        ->label(Theme::trans('packages.port_free'))
                        ->content(function (Get $get): string {
                            $range = Ports::of((int) $get('port_from'), (int) $get('port_to'));

                            if ($range === null) {
                                return Theme::trans('packages.port_free_none');
                            }

                            $nodes = array_map('intval', (array) $get('node_ids'));
                            $count = Ports::count($range, $nodes);

                            if ($count === null) {
                                return Theme::trans('packages.port_free_none');
                            }

                            return Theme::trans('packages.port_free_body', [
                                'free' => $count['free'],
                                'total' => $count['total'],
                            ]);
                        })
                        ->columnSpanFull(),

                    /*
                     * The name the customer sees instead of the node's IP.
                     *
                     * Checked here as well as on save, so a name that is not
                     * one is refused while somebody is looking at it rather
                     * than quietly stored as empty. Hostnames::sanitise() is
                     * the rule; this only asks it.
                     */
                    TextInput::make('hostname')
                        ->label(Theme::trans('packages.hostname'))
                        ->helperText(Theme::trans('packages.hostname_helper'))
                        ->placeholder('mc.example.com')
                        ->maxLength(253)
                        ->rule(static fn (): Closure => static function (string $attribute, mixed $value, Closure $fail): void {
                            if (trim((string) $value) !== '' && Hostnames::sanitise($value) === null) {
                                $fail(Theme::trans('packages.hostname_invalid'));
                            }
                        })
                        ->columnSpanFull(),

                    /*
                     * Where a live service on this package may be moved to.
                     *
                     * Only packages on the same egg are offered, because that is
                     * the only kind of move that is an upgrade rather than a
                     * different server - and the list is drawn from the egg
                     * chosen above, so changing the egg changes what is on
                     * offer here rather than leaving a stale tick behind.
                     *
                     * Upgrades::may() checks the same rule again when somebody
                     * actually presses the button. A form is where a mistake is
                     * prevented; it is not where a rule is kept.
                     */
                    CheckboxList::make('upgrade_to')
                        ->label(Theme::trans('packages.upgrade_to'))
                        ->helperText(Theme::trans('packages.upgrade_to_helper'))
                        ->visible(static fn (): bool => Features::enabled(Features::UPGRADES))
                        ->options(static fn (Get $get): array => self::upgradeOptions($get('egg_id'), $get('id')))
                        ->descriptions(static fn (Get $get): array => self::upgradePrices($get('egg_id'), $get('id')))
                        ->noSearchResultsMessage(Theme::trans('packages.upgrade_to_none'))
                        ->columns(['default' => 1, 'sm' => 2])
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'sm' => 2]),

            Section::make(Theme::trans('packages.section_limits'))
                ->description(Theme::trans('packages.section_limits_helper'))
                ->schema([
                    TextInput::make('memory')
                        ->label(Theme::trans('packages.memory'))
                        ->numeric()
                        ->minValue(0)
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(1024),

                    TextInput::make('disk')
                        ->label(Theme::trans('packages.disk'))
                        ->numeric()
                        ->minValue(0)
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(5120),

                    TextInput::make('cpu')
                        ->label(Theme::trans('packages.cpu'))
                        ->helperText(Theme::trans('packages.cpu_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->suffix(Theme::trans('packages.unit_percent'))
                        ->default(100),

                    TextInput::make('swap')
                        ->label(Theme::trans('packages.swap'))
                        ->helperText(Theme::trans('packages.swap_helper'))
                        ->numeric()
                        ->minValue(-1)
                        ->suffix(Theme::trans('packages.unit_mib'))
                        ->default(0),

                    TextInput::make('io')
                        ->label(Theme::trans('packages.io'))
                        ->helperText(Theme::trans('packages.io_helper'))
                        ->numeric()
                        ->minValue(10)
                        ->maxValue(1000)
                        ->default(500),

                    TextInput::make('threads')
                        ->label(Theme::trans('packages.threads'))
                        ->helperText(Theme::trans('packages.threads_helper'))
                        ->maxLength(64)
                        ->regex('/^[0-9,-]*$/'),

                    TextInput::make('database_limit')
                        ->label(Theme::trans('packages.databases'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0),

                    TextInput::make('allocation_limit')
                        ->label(Theme::trans('packages.allocations'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0),

                    TextInput::make('backup_limit')
                        ->label(Theme::trans('packages.backups'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0),

                    Toggle::make('oom_killer')
                        ->label(Theme::trans('packages.oom_killer'))
                        ->helperText(Theme::trans('packages.oom_killer_helper'))
                        ->inline(false),
                ])
                ->columns(['default' => 1, 'sm' => 2, 'lg' => 3]),

            /*
             * The picture on the card.
             *
             * Two ways in and a fallback, in that order: a file somebody
             * uploaded, a URL they typed, and failing both the egg's own
             * artwork - which the artwork feature already fetches from Steam
             * and IGDB, so most packages get a picture without anybody doing
             * anything.
             */
            /*
             * What the customer is asked while they are buying.
             *
             * Two kinds. The egg's own variables, so a package can sell one
             * thing and let somebody pick the version or the seed - the answers
             * go into the server's environment when it is built, over the
             * package's own values. And a file, which is the case an egg cannot
             * express at all: a world, a modpack, a set of configs.
             */
            Section::make(Theme::trans('packages.section_ask'))
                ->description(Theme::trans('packages.section_ask_helper'))
                ->schema([
                    CheckboxList::make('ask_vars')
                        ->label(Theme::trans('packages.ask_vars'))
                        ->helperText(Theme::trans('packages.ask_vars_helper'))
                        ->options(static fn (Get $get): array => Packages::variableOptions(self::int($get('egg_id'))))
                        ->columns(['default' => 1, 'md' => 2])
                        ->bulkToggleable()
                        ->columnSpanFull(),

                    Toggle::make('upload_ask')
                        ->label(Theme::trans('packages.upload_ask'))
                        ->helperText(Theme::trans('packages.upload_ask_helper'))
                        ->inline(false)
                        ->live()
                        ->columnSpanFull(),

                    TextInput::make('upload_label')
                        ->label(Theme::trans('packages.upload_label'))
                        ->helperText(Theme::trans('packages.upload_label_helper'))
                        ->maxLength(120)
                        ->visible(fn (Get $get): bool => (bool) $get('upload_ask')),

                    TextInput::make('upload_dir')
                        ->label(Theme::trans('packages.upload_dir'))
                        ->helperText(Theme::trans('packages.upload_dir_helper'))
                        ->maxLength(255)
                        ->default('/')
                        ->visible(fn (Get $get): bool => (bool) $get('upload_ask')),

                    Toggle::make('upload_extract')
                        ->label(Theme::trans('packages.upload_extract'))
                        ->helperText(Theme::trans('packages.upload_extract_helper'))
                        ->inline(false)
                        ->default(true)
                        ->visible(fn (Get $get): bool => (bool) $get('upload_ask'))
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'md' => 2]),

            Section::make(Theme::trans('packages.section_art'))
                ->description(Theme::trans('packages.section_art_helper'))
                ->schema([
                    /*
                     * What the card shows with the form as it stands, and why.
                     * Mostly nothing is set here and the picture comes from the
                     * egg or the library, and a form that only showed the two
                     * empty fields would make that look like no picture at all.
                     */
                    Placeholder::make('art_now')
                        ->label(Theme::trans('packages.art_now'))
                        ->content(static fn (Get $get): HtmlString => self::artNow($get)),

                    /*
                     * A logo from the artwork library, put in the address field
                     * rather than kept anywhere of its own: the card only ever
                     * needs an address, and a package keeps working the same
                     * way on a panel that later cannot reach the library.
                     */
                    Select::make('art_library')
                        ->label(Theme::trans('packages.art_library'))
                        ->helperText(Theme::trans('packages.art_library_helper'))
                        ->searchable()
                        ->live()
                        ->dehydrated(false)
                        // What the library has under the chosen egg's name,
                        // before anything is typed; typing searches all of it.
                        ->options(static fn (Get $get): array => self::logoOptions(Library::search(self::eggName($get('egg_id')))))
                        ->getSearchResultsUsing(static fn (string $search): array => self::logoOptions(Library::search($search)))
                        ->getOptionLabelUsing(static fn (mixed $value): ?string => Library::logo((int) $value)['name'] ?? null)
                        ->afterStateUpdated(static function (mixed $state, Set $set): void {
                            // Resolved by id, so the address comes from the
                            // library and not from what the browser sent.
                            $logo = Library::logo((int) $state);

                            if ($logo !== null) {
                                $set('art_url', $logo['url']);
                                // An upload wins over the address, so it goes:
                                // picking a logo is asking for that logo.
                                $set('art_path', null);
                            }
                        })
                        ->columnSpanFull(),

                    FileUpload::make('art_path')
                        ->label(Theme::trans('packages.art_file'))
                        ->helperText(Theme::trans('packages.art_file_helper'))
                        ->disk('public')
                        ->directory('theme')
                        ->image()
                        ->maxFiles(1)
                        ->maxSize(8192)
                        ->columnSpanFull(),

                    TextInput::make('art_url')
                        ->label(Theme::trans('packages.art_url'))
                        ->helperText(Theme::trans('packages.art_url_helper'))
                        ->url()
                        ->maxLength(2048)
                        // So Shown now follows an address typed by hand, once
                        // it is finished rather than on every key.
                        ->live(onBlur: true)
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1]),

            Section::make(Theme::trans('packages.section_price'))
                ->description(Theme::trans('packages.section_price_helper'))
                ->schema([
                    /*
                     * Text, not a number field. A number field refuses a comma,
                     * and half the people setting this up write 12,50. What
                     * they typed goes through Money::fromInput on save, which
                     * takes either mark and refuses anything that is not an
                     * amount.
                     */
                    TextInput::make('price')
                        ->label(Theme::trans('packages.price'))
                        ->helperText(Theme::trans('packages.price_helper'))
                        ->required()
                        ->maxLength(16)
                        ->regex('/^[0-9 .,]+$/')
                        ->prefix(static fn (): string => Money::symbol(Packages::currency())),

                    TextInput::make('setup_fee')
                        ->label(Theme::trans('packages.setup_fee'))
                        ->helperText(Theme::trans('packages.setup_fee_helper'))
                        ->maxLength(16)
                        ->regex('/^[0-9 .,]*$/')
                        ->prefix(static fn (): string => Money::symbol(Packages::currency())),

                    Select::make('period')
                        ->label(Theme::trans('packages.period'))
                        ->helperText(Theme::trans('packages.period_helper'))
                        ->options(static fn (): array => Packages::periodOptions())
                        ->default(Package::MONTH)
                        ->selectablePlaceholder(false)
                        ->required(),

                    /*
                     * The minimum contract, and what it is counted in.
                     *
                     * Beside the price rather than beside the billing period,
                     * because it is a question about money and not about
                     * timing: how long somebody is committed for. Zero is no
                     * commitment, which is what most packages want.
                     */
                    TextInput::make('term')
                        ->label(Theme::trans('packages.term'))
                        ->helperText(Theme::trans('packages.term_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(120)
                        ->default(0),

                    Select::make('term_unit')
                        ->label(Theme::trans('packages.term_unit'))
                        ->helperText(Theme::trans('packages.term_unit_helper'))
                        ->options(static fn (): array => Packages::termUnits())
                        ->default(Package::MONTH_TERM)
                        ->selectablePlaceholder(false),

                    TextInput::make('stock')
                        ->label(Theme::trans('packages.stock'))
                        ->helperText(Theme::trans('packages.stock_helper'))
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100000)
                        ->placeholder(Theme::trans('packages.stock_unlimited')),
                ])
                ->columns(['default' => 1, 'sm' => 2]),
        ];
    }

    /** @param  array<string, mixed>  $data */
    private function create(array $data): void
    {
        abort_unless(Features::mayManage(Features::PACKAGES), 403);

        if (!$this->priced($data)) {
            return;
        }

        $this->guard(function () use ($data): void {
            $record = Package::query()->create(Packages::sanitise($data));

            Notification::make()->title(Theme::trans('packages.saved'))->success()->send();

            self::makePorts($record);
        });
    }

    /** @param  array<string, mixed>  $data */
    private function update(Package $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::PACKAGES), 403);

        if (!$this->priced($data)) {
            return;
        }

        $this->guard(function () use ($record, $data): void {
            $record->update(Packages::sanitise($data, (int) $record->id));

            Notification::make()->title(Theme::trans('packages.saved'))->success()->send();

            self::makePorts($record->fresh() ?? $record);
        });
    }

    /**
     * Make the ports this package sells into, and say so when something happened.
     *
     * **Silent when there was nothing to do.** This runs on every save, and a
     * package saved for its description would otherwise report that nought
     * ports were made every single time. What is worth a message is a port
     * that was made, and a range that could not be.
     *
     * After the save rather than inside it. The range is stored either way: a
     * node that will not take new allocations is a thing to go and look at, not
     * a reason to refuse the edit somebody just made.
     */
    private static function makePorts(Package $record): void
    {
        $made = Ports::make($record);

        if ($made['refused'] === 'wide') {
            $range = Ports::forPackage($record);

            Notification::make()
                ->title(Theme::trans('packages.ports_wide'))
                ->body(Theme::trans('packages.ports_wide_body', [
                    'width' => $range === null ? 0 : $range['to'] - $range['from'] + 1,
                    'most' => Ports::MOST,
                ]))
                ->warning()
                ->persistent()
                ->send();

            return;
        }

        if ($made['refused'] !== null) {
            Notification::make()
                ->title(Theme::trans('packages.ports_nowhere'))
                ->body(Theme::trans('packages.ports_nowhere_body'))
                ->warning()
                ->send();

            return;
        }

        $failed = count(array_filter(
            $made['nodes'],
            static fn (string $how): bool => $how !== 'made' && $how !== 'complete',
        ));

        if ($failed > 0) {
            Notification::make()
                ->title(Theme::trans('packages.ports_failed'))
                ->body(Theme::trans('packages.ports_failed_body', [
                    'failed' => $failed,
                    'nodes' => count($made['nodes']),
                ]))
                ->warning()
                ->persistent()
                ->send();
        }

        if ($made['made'] < 1) {
            return;
        }

        Notification::make()
            ->title(Theme::trans('packages.ports_made'))
            ->body(Theme::trans('packages.ports_made_body', [
                'made' => $made['made'],
                'nodes' => count(array_filter($made['nodes'], static fn (string $how): bool => $how === 'made')),
            ]))
            ->success()
            ->send();
    }

    private function toggle(Package $record): void
    {
        abort_unless(Features::mayManage(Features::PACKAGES), 403);

        $this->guard(function () use ($record): void {
            $record->update(['live' => !$record->live]);

            Notification::make()->title(Theme::trans('packages.saved'))->success()->send();
        });
    }

    /**
     * How many orders were ever placed against this package.
     *
     * Every one of them, not only the live ones: a cancelled order still has an
     * invoice with this package's name on it, and that invoice is a document
     * somebody may have to produce years later.
     */
    private static function soldCount(Package $record): int
    {
        try {
            return (int) $record->orders()->count();
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * A copy, off sale, with its own slug - so a second tier starts from the
     * first rather than from an empty form.
     */
    private function copy(Package $record): void
    {
        abort_unless(Features::mayManage(Features::PACKAGES), 403);

        $this->guard(function () use ($record): void {
            /*
             * Without the count. The table this record came from is loaded with
             * withCount('orders'), which puts an orders_count on the model as
             * though it were a column - and replicate() copies every attribute,
             * so the INSERT named a column the table does not have and every
             * duplicate failed with "Unknown column 'orders_count'".
             */
            $copy = $record->replicate(['orders_count']);
            $copy->name = mb_substr($record->name . Theme::trans('packages.copy_suffix'), 0, 120);
            $copy->slug = Packages::slug($copy->name);
            $copy->live = false;
            $copy->save();

            Notification::make()->title(Theme::trans('packages.saved'))->success()->send();
        });
    }

    /**
     * Gone - unless somebody bought it.
     *
     * An order points at its package, and although it carries its own copy of
     * everything, a row that says "package: (deleted)" on a customer's billing
     * page is a row that raises a question. Taking it off sale is the answer
     * for a package that has been sold.
     */
    private function delete(Package $record): void
    {
        abort_unless(Features::mayManage(Features::PACKAGES), 403);

        $this->guard(function () use ($record): void {
            $sold = self::soldCount($record);

            $record->delete();

            /*
             * The orders are left exactly where they are.
             *
             * package_id is nullable and the key is nullOnDelete, so every
             * order that pointed here now points at nothing - and that costs
             * them nothing, because an order has never read the package for
             * anything that matters. It carries its own copy of the name, the
             * price, the limits and the questions from the moment it was
             * placed, which is what makes the servers keep running and the
             * invoices keep saying what was bought.
             *
             * The one thing that goes is the picture on a service card, which
             * is read from the package because it is decoration.
             */
            Notification::make()
                ->title(Theme::trans('packages.deleted'))
                ->body($sold === 0 ? null : Theme::trans('packages.deleted_sold', ['count' => $sold]))
                ->success()
                ->send();
        });
    }

    /**
     * Whether what was typed for money is money. Said before anything is
     * written, so a typo does not become a package priced at nothing.
     *
     * @param  array<string, mixed>  $data
     */
    private function priced(array $data): bool
    {
        $price = Money::fromInput($data['price'] ?? null);
        $setup = trim((string) ($data['setup_fee'] ?? '')) === '' ? 0 : Money::fromInput($data['setup_fee'] ?? null);

        /*
         * An amount off is money too, and it goes through the same reader.
         *
         * Without this a discount typed as anything that reader cannot make
         * sense of is stored as nought, and the package quietly sells at full
         * price with an offer badge on it.
         */
        $offer = ($data['offer'] ?? false)
            && ($data['offer_kind'] ?? '') === Packages::OFFER_AMOUNT
            && trim((string) ($data['offer_value'] ?? '')) !== ''
            ? Money::fromInput($data['offer_value'] ?? null)
            : 0;

        if ($price === null || $setup === null || $offer === null) {
            Notification::make()
                ->title(Theme::trans('packages.save_failed'))
                ->body(Theme::trans('packages.price_invalid'))
                ->danger()
                ->send();

            return false;
        }

        return true;
    }

    /**
     * The packages a service on this one may be moved to.
     *
     * Same egg, and never itself. A package that is not live is still listed:
     * an owner may well take a tier off sale while people are still on it and
     * still want them able to move off it.
     *
     * @return array<int, string>
     */
    private static function upgradeOptions(mixed $eggId, mixed $ignoreId): array
    {
        $egg = (int) (is_scalar($eggId) ? $eggId : 0);

        if ($egg === 0) {
            return [];
        }

        try {
            return Package::query()
                ->where('egg_id', $egg)
                ->when((int) $ignoreId > 0, static fn ($query) => $query->whereKeyNot((int) $ignoreId))
                ->orderBy('price')
                ->pluck('name', 'id')
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * And what each of them costs, under its name.
     *
     * The price is the whole reason somebody is choosing between them, and a
     * list of names alone makes an owner open another tab to find out which of
     * two tiers is the bigger one.
     *
     * @return array<int, string>
     */
    private static function upgradePrices(mixed $eggId, mixed $ignoreId): array
    {
        $egg = (int) (is_scalar($eggId) ? $eggId : 0);

        if ($egg === 0) {
            return [];
        }

        try {
            return Package::query()
                ->where('egg_id', $egg)
                ->when((int) $ignoreId > 0, static fn ($query) => $query->whereKeyNot((int) $ignoreId))
                ->orderBy('price')
                ->get()
                ->mapWithKeys(static fn (Package $package): array => [
                    (int) $package->id => Packages::priceLabel($package),
                ])
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The nodes, as a checkbox list's options.
     *
     * @return array<int, string>
     */
    private static function nodeOptions(): array
    {
        try {
            return Node::query()
                ->orderBy('name')
                ->pluck('name', 'id')
                ->map(static fn ($name): string => (string) $name)
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    private static function int(mixed $value): ?int
    {
        return is_numeric($value) && (int) $value > 0 ? (int) $value : null;
    }

    /** The chosen egg's name, which is what the artwork library is searched by. */
    private static function eggName(mixed $id): string
    {
        return (string) (self::egg($id)?->name ?? '');
    }

    private static function egg(mixed $id): ?Egg
    {
        $id = self::int($id);

        try {
            return $id === null ? null : Egg::query()->find($id);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Library rows as picker options: the id, and the name somebody reads.
     *
     * @param  array<int, array{id: int, name: string}>  $logos
     * @return array<int, string>
     */
    private static function logoOptions(array $logos): array
    {
        $options = [];

        foreach ($logos as $logo) {
            if ($logo['id'] > 0 && $logo['name'] !== '') {
                $options[$logo['id']] = $logo['name'];
            }
        }

        return $options;
    }

    /**
     * The picture the card shows with the form as it stands, and where it
     * comes from.
     *
     * An upload that has not been saved yet has no address to draw, and the
     * upload field shows its own preview, so that one is only named.
     */
    private static function artNow(Get $get): HtmlString
    {
        $upload = $get('art_path');
        $uploaded = is_array($upload) ? $upload !== [] : trim((string) $upload) !== '';

        $art = $uploaded
            ? ['url' => null, 'from' => 'upload', 'name' => null]
            : Packages::artworkFor('', (string) $get('art_url'), self::egg($get('egg_id')));

        $text = match ($art['from']) {
            'upload' => Theme::trans('packages.art_from_upload'),
            'url' => Theme::trans('packages.art_from_url'),
            'egg' => Theme::trans('packages.art_from_egg'),
            'library' => Theme::trans('packages.art_from_library', ['name' => (string) $art['name']]),
            default => Theme::trans('packages.art_from_none'),
        };

        $picture = $art['url'] === null
            ? ''
            : '<img src="' . e($art['url']) . '" alt="" style="display: block; max-height: 6rem; border-radius: 0.5rem; margin-bottom: 0.5rem;">';

        return new HtmlString($picture . '<span>' . e($text) . '</span>');
    }

    /**
     * Run one of the five, and say so rather than failing quietly.
     *
     * Not named attempt(): tools/check-attempt.js exists because two shapes of
     * that name once got mixed up, and this page does not need to be the
     * fifth class defining it.
     */
    private function guard(callable $work): void
    {
        try {
            $work();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('packages.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
