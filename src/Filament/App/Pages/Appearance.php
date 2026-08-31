<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\UserTheme;
use Throwable;

/**
 * Where somebody picks the panel's look for themselves.
 *
 * It appears only when an administrator has offered something to pick from,
 * which is the whole shape of this feature: **which** styles exist is theirs,
 * **which one you use** is yours. Picking one changes what you see and nothing
 * else - it is written to a file of your own and read back when your pages are
 * built, so there is no flash of somebody else's colours first.
 *
 * No permission of its own, deliberately. Choosing the colour of your own panel
 * is not a thing to be granted, and gating it would mean every subuser needing
 * a role before they could stop looking at orange.
 *
 * @property Schema $form
 */
class Appearance extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-palette';

    protected static ?string $slug = 'appearance';

    protected static ?int $navigationSort = 90;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            return UserTheme::enabled() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('appearance.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('appearance.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('appearance.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.theme-settings';
    }

    public function mount(): void
    {
        $this->form->fill(['preset' => UserTheme::choice() ?? '']);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(Theme::trans('appearance.section'))
                    ->icon('tabler-palette')
                    ->schema([
                        Select::make('preset')
                            ->label(fn () => Theme::trans('appearance.style'))
                            ->helperText(fn () => Theme::trans('appearance.style_helper'))
                            /*
                             * The empty option is first and is not a blank: it
                             * is a choice with a name, because "follow the
                             * panel" is what most people want and an unlabelled
                             * empty row does not say that.
                             */
                            ->options(fn (): array => ['' => Theme::trans('appearance.follow')]
                                + self::styles())
                            ->allowHtml()
                            ->selectablePlaceholder(false)
                            ->native(false),
                    ]),
            ])
            ->statePath('data');
    }

    /**
     * The styles on offer, drawn with their own colours - the same swatches the
     * administrator's picker uses, from the same values.
     *
     * @return array<string, string>
     */
    private static function styles(): array
    {
        $options = [];

        foreach (UserTheme::allowed() as $preset) {
            $options[$preset] = self::swatch($preset);
        }

        return $options;
    }

    private static function swatch(string $preset): string
    {
        $label = e(Presets::label($preset));
        $swatch = Presets::swatch($preset);

        if ($swatch === null) {
            return $label;
        }

        $chip = static fn (string $colour): string => '<span style="'
            . 'display:inline-block;width:0.85rem;height:0.85rem;'
            . 'border-radius:' . e($swatch['radius']) . ';'
            . 'background:' . e($colour) . ';'
            . 'box-shadow:inset 0 0 0 1px rgba(255,255,255,0.15);'
            . '"></span>';

        return '<span style="display:inline-flex;align-items:center;gap:0.4rem;">'
            . $chip($swatch['background'])
            . $chip($swatch['surface'])
            . $chip($swatch['accent'])
            . '<span>' . $label . '</span>'
            . '</span>';
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label(fn () => Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $chosen = (string) ($this->form->getState()['preset'] ?? '');

        // Empty means "follow the panel", which is a choice and is stored as
        // the absence of one rather than as a style called nothing.
        if (!UserTheme::save($chosen === '' ? null : $chosen)) {
            Notification::make()
                ->title(Theme::trans('appearance.save_failed'))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('appearance.saved'))
            ->success()
            ->send();

        // Reloaded, so the panel is already wearing it rather than describing
        // it. This is a page about how things look; saying "saved" and changing
        // nothing on screen would be the wrong answer.
        $this->redirect(self::getUrl());
    }
}
