<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Node;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
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
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
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
                    ->modalDescription(Theme::trans('packages.delete_confirm'))
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
                        ->options(static fn (): array => self::nodeOptions())
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
            Package::query()->create(Packages::sanitise($data));

            Notification::make()->title(Theme::trans('packages.saved'))->success()->send();
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
        });
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
            if ($record->orders()->exists()) {
                Notification::make()
                    ->title(Theme::trans('packages.delete_refused'))
                    ->body(Theme::trans('packages.delete_refused_body'))
                    ->warning()
                    ->persistent()
                    ->send();

                return;
            }

            $record->delete();

            Notification::make()->title(Theme::trans('packages.deleted'))->success()->send();
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

        if ($price === null || $setup === null) {
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
