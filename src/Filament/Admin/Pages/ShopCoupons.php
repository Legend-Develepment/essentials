<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Coupons;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Codes that take something off the first invoice.
 *
 * A percentage or a fixed amount, optionally limited to certain packages, with
 * an expiry and a cap on how many times it can be used. Deliberately only the
 * first invoice: a code that also discounts every renewal is a price change
 * with an expiry date on it, and somebody who wants that should change the
 * price.
 *
 * Uses are counted when an order is placed rather than when its invoice is
 * paid, so a code with ten uses cannot be placed a hundred times overnight and
 * still say it has ten left in the morning.
 */
class ShopCoupons extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-ticket';

    protected static ?string $slug = 'essentials-coupons';

    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::COUPONS) && Tables::ready();
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
        return Theme::trans('coupons.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('coupons.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('coupons.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.coupons';
    }

    public function table(Table $table): Table
    {
        $currency = Packages::currency();

        return $table
            ->query(fn (): Builder => Coupon::query())
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('code')
                    ->label(Theme::trans('coupons.column_code'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->copyable(),

                TextColumn::make('value')
                    ->label(Theme::trans('coupons.column_value'))
                    ->formatStateUsing(static fn (Coupon $record): string => $record->kind === Coupon::PERCENT
                        ? (int) $record->value . '%'
                        : Money::format((int) $record->value, $currency)),

                TextColumn::make('uses')
                    ->label(Theme::trans('coupons.column_uses'))
                    ->formatStateUsing(static fn (Coupon $record): string => $record->max_uses === null
                        ? (string) (int) $record->uses
                        : (int) $record->uses . ' / ' . (int) $record->max_uses),

                TextColumn::make('expires_at')
                    ->label(Theme::trans('coupons.column_expires'))
                    ->date()
                    ->sortable()
                    ->placeholder(Theme::trans('coupons.never_expires'))
                    ->color(static fn (Coupon $record): string => $record->expires_at?->isPast() ? 'danger' : 'gray'),

                /*
                 * These two are worked out as one sentence per coupon rather
                 * than formatted from the column. The column is a list, and a
                 * list is formatted once per item and not at all while empty -
                 * so a code for two packages said "2 packages" twice, and a
                 * code for everything said nothing.
                 */
                TextColumn::make('package_ids')
                    ->label(Theme::trans('coupons.column_packages'))
                    ->state(static function (Coupon $record): string {
                        $ids = is_array($record->package_ids) ? $record->package_ids : [];

                        return $ids === []
                            ? Theme::trans('coupons.all_packages')
                            : Theme::trans('coupons.some_packages', ['count' => count($ids)]);
                    }),

                TextColumn::make('user_ids')
                    ->label(Theme::trans('coupons.column_users'))
                    ->state(static function (Coupon $record): string {
                        $ids = is_array($record->user_ids) ? $record->user_ids : [];

                        if ($ids === []) {
                            return Theme::trans('coupons.all_users');
                        }

                        // One account is worth naming; more is a count.
                        return count($ids) === 1
                            ? (self::userOptions($ids)[(int) $ids[0]] ?? '#' . (int) $ids[0])
                            : Theme::trans('coupons.some_users', ['count' => count($ids)]);
                    }),

                IconColumn::make('live')
                    ->label(Theme::trans('coupons.column_live'))
                    ->boolean()
                    ->tooltip(static fn (Coupon $record): string => $record->usable()
                        ? Theme::trans('coupons.usable')
                        : Theme::trans('coupons.unusable')),
            ])
            ->filters([
                TernaryFilter::make('live')
                    ->label(Theme::trans('coupons.column_live')),
            ])
            ->recordActions([
                Action::make('ld_edit')
                    ->label(Theme::trans('coupons.edit'))
                    ->icon('tabler-pencil')
                    ->slideOver()
                    ->modalWidth(Width::Large)
                    ->schema(self::fields())
                    ->fillForm(static fn (Coupon $record): array => self::toForm($record, $currency))
                    ->visible(static fn (): bool => Features::mayManage(Features::COUPONS))
                    ->action(fn (Coupon $record, array $data) => $this->update($record, $data)),

                Action::make('ld_delete')
                    ->label(Theme::trans('coupons.delete'))
                    ->icon('tabler-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('coupons.delete_confirm'))
                    ->visible(static fn (): bool => Features::mayManage(Features::COUPONS))
                    ->action(fn (Coupon $record) => $this->delete($record)),
            ])
            ->emptyStateHeading(Theme::trans('coupons.empty'))
            ->emptyStateDescription(Theme::trans('coupons.empty_body'))
            ->emptyStateIcon('tabler-ticket');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::COUPONS)) {
            return [];
        }

        return [
            Action::make('ld_new')
                ->label(Theme::trans('coupons.new'))
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
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function fields(): array
    {
        return [
            Section::make(Theme::trans('coupons.section_code'))
                ->description(Theme::trans('coupons.section_code_helper'))
                ->schema([
                    TextInput::make('code')
                        ->label(Theme::trans('coupons.code'))
                        ->helperText(Theme::trans('coupons.code_helper'))
                        ->required()
                        ->maxLength(Coupons::MAX_LENGTH),

                    Toggle::make('live')
                        ->label(Theme::trans('coupons.live'))
                        ->helperText(Theme::trans('coupons.live_helper'))
                        ->default(true)
                        ->inline(false),
                ])
                ->columns(['default' => 1, 'sm' => 2]),

            Section::make(Theme::trans('coupons.section_worth'))
                ->description(Theme::trans('coupons.section_worth_helper'))
                ->schema([
                    Select::make('kind')
                        ->label(Theme::trans('coupons.kind'))
                        ->helperText(Theme::trans('coupons.kind_helper'))
                        ->options([
                            Coupon::PERCENT => Theme::trans('coupons.kind_percent'),
                            Coupon::FIXED => Theme::trans('coupons.kind_fixed'),
                        ])
                        ->default(Coupon::PERCENT)
                        ->live()
                        ->required(),

                    /*
                     * One field, two meanings, and the suffix says which. A
                     * percentage is a whole number up to a hundred; an amount
                     * is typed the way every other price in this plugin is
                     * typed and read by Money::fromInput.
                     */
                    TextInput::make('value')
                        ->label(Theme::trans('coupons.value'))
                        ->helperText(static fn (Get $get): string => $get('kind') === Coupon::FIXED
                            ? Theme::trans('coupons.value_fixed_helper')
                            : Theme::trans('coupons.value_percent_helper'))
                        ->suffix(static fn (Get $get): string => $get('kind') === Coupon::FIXED
                            ? Money::symbol(Packages::currency())
                            : '%')
                        ->required(),
                ])
                ->columns(['default' => 1, 'sm' => 2]),

            Section::make(Theme::trans('coupons.section_limits'))
                ->description(Theme::trans('coupons.section_limits_helper'))
                ->schema([
                    TextInput::make('max_uses')
                        ->label(Theme::trans('coupons.max_uses'))
                        ->helperText(Theme::trans('coupons.max_uses_helper'))
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(1000000),

                    DateTimePicker::make('expires_at')
                        ->label(Theme::trans('coupons.expires'))
                        ->helperText(Theme::trans('coupons.expires_helper'))
                        ->native(false)
                        ->seconds(false),

                    CheckboxList::make('package_ids')
                        ->label(Theme::trans('coupons.packages'))
                        ->helperText(Theme::trans('coupons.packages_helper'))
                        ->options(static fn (): array => self::packageOptions())
                        ->columns(['default' => 1, 'sm' => 2])
                        ->columnSpanFull(),

                    /*
                     * The accounts this code belongs to.
                     *
                     * Searched rather than listed: a panel with a few thousand
                     * accounts would otherwise send every one of them to the
                     * browser to open this form.
                     */
                    Select::make('user_ids')
                        ->label(Theme::trans('coupons.users'))
                        ->helperText(Theme::trans('coupons.users_helper'))
                        ->multiple()
                        ->searchable()
                        ->getSearchResultsUsing(static fn (string $search): array => self::userSearch($search))
                        ->getOptionLabelsUsing(static fn (array $values): array => self::userOptions($values))
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'sm' => 2]),
        ];
    }

    /**
     * Accounts matching what was typed, by name or address, for the picker.
     *
     * @return array<int, string>
     */
    private static function userSearch(string $search): array
    {
        $search = trim($search);

        if ($search === '') {
            return [];
        }

        try {
            // What was typed is matched as text, so a % or _ in it is a
            // character rather than a wildcard.
            $like = '%' . addcslashes($search, '%_' . chr(92)) . '%';

            return self::labelled(User::query()
                ->where(static fn (Builder $query): Builder => $query
                    ->where('username', 'like', $like)
                    ->orWhere('email', 'like', $like))
                ->orderBy('username')
                ->limit(25)
                ->get(['id', 'username', 'email']));
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * The accounts behind a list of ids, labelled; an id whose account is
     * gone is left out, so it quietly drops off the next save.
     *
     * @param  array<int|string, mixed>  $ids
     * @return array<int, string>
     */
    private static function userOptions(array $ids): array
    {
        $ids = array_values(array_filter(
            array_map(static fn (mixed $id): int => is_numeric($id) ? (int) $id : 0, $ids),
            static fn (int $id): bool => $id > 0,
        ));

        if ($ids === []) {
            return [];
        }

        try {
            return self::labelled(User::query()->whereIn('id', $ids)->get(['id', 'username', 'email']));
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * @param  iterable<User>  $users
     * @return array<int, string>
     */
    private static function labelled(iterable $users): array
    {
        $out = [];

        foreach ($users as $user) {
            $out[(int) $user->id] = $user->username . ' (' . $user->email . ')';
        }

        return $out;
    }

    /**
     * The packages, as a checkbox list's options.
     *
     * @return array<int, string>
     */
    private static function packageOptions(): array
    {
        try {
            return Package::query()
                ->orderBy('sort')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->map(static fn (mixed $name): string => (string) $name)
                ->all();
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * A row the way the form wants it: a fixed amount as typed money.
     *
     * @return array<string, mixed>
     */
    private static function toForm(Coupon $record, string $currency): array
    {
        $data = $record->toArray();

        $data['value'] = $record->kind === Coupon::FIXED
            ? Money::toInput((int) $record->value)
            : (string) (int) $record->value;

        $data['package_ids'] = is_array($record->package_ids) ? $record->package_ids : [];
        $data['user_ids'] = is_array($record->user_ids) ? array_map('intval', $record->user_ids) : [];

        return $data;
    }

    /**
     * What the form hands back, held to what a coupon can be.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>|null
     */
    private static function sanitise(array $data): ?array
    {
        $code = Coupons::normalise($data['code'] ?? '');
        $kind = ($data['kind'] ?? Coupon::PERCENT) === Coupon::FIXED ? Coupon::FIXED : Coupon::PERCENT;

        if ($code === '') {
            return null;
        }

        if ($kind === Coupon::FIXED) {
            $value = Money::fromInput($data['value'] ?? null);

            if ($value === null || $value <= 0) {
                return null;
            }
        } else {
            $value = is_numeric($data['value'] ?? null) ? (int) $data['value'] : 0;

            if ($value < 1 || $value > 100) {
                return null;
            }
        }

        $packages = [];

        foreach ((array) ($data['package_ids'] ?? []) as $id) {
            if (is_numeric($id) && (int) $id > 0) {
                $packages[] = (int) $id;
            }
        }

        // Only accounts that exist, so a typed or stale id cannot tie a code
        // to nobody and make it unusable without anybody seeing why.
        $users = array_keys(self::userOptions((array) ($data['user_ids'] ?? [])));

        $max = $data['max_uses'] ?? null;

        return [
            'code' => $code,
            'kind' => $kind,
            'value' => $value,
            'package_ids' => array_values(array_unique($packages)),
            'user_ids' => $users,
            'max_uses' => is_numeric($max) && (int) $max > 0 ? (int) $max : null,
            'expires_at' => ($data['expires_at'] ?? null) ?: null,
            'live' => (bool) ($data['live'] ?? false),
        ];
    }

    /** @param  array<string, mixed>  $data */
    private function create(array $data): void
    {
        abort_unless(Features::mayManage(Features::COUPONS), 403);

        $clean = self::sanitise($data);

        if ($clean === null) {
            $this->invalid();

            return;
        }

        $this->guard(function () use ($clean): void {
            Coupon::query()->create($clean);

            Notification::make()->title(Theme::trans('coupons.saved'))->success()->send();
        });
    }

    /** @param  array<string, mixed>  $data */
    private function update(Coupon $record, array $data): void
    {
        abort_unless(Features::mayManage(Features::COUPONS), 403);

        $clean = self::sanitise($data);

        if ($clean === null) {
            $this->invalid();

            return;
        }

        $this->guard(function () use ($record, $clean): void {
            $record->update($clean);

            Notification::make()->title(Theme::trans('coupons.saved'))->success()->send();
        });
    }

    private function delete(Coupon $record): void
    {
        abort_unless(Features::mayManage(Features::COUPONS), 403);

        $this->guard(function () use ($record): void {
            $record->delete();

            Notification::make()->title(Theme::trans('coupons.deleted'))->success()->send();
        });
    }

    private function invalid(): void
    {
        Notification::make()
            ->title(Theme::trans('coupons.save_failed'))
            ->body(Theme::trans('coupons.invalid'))
            ->danger()
            ->send();
    }

    /**
     * One try/catch for every write on this page.
     *
     * A duplicate code is the likely one - the column is unique, deliberately -
     * and it arrives as a database exception rather than as a validation
     * message. This turns it into a sentence instead of a 500.
     */
    private function guard(callable $work): void
    {
        try {
            $work();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('coupons.save_failed'))
                ->body(Theme::trans('coupons.taken'))
                ->danger()
                ->send();
        }
    }
}
