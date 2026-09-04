<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Carbon\CarbonImmutable;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Jobs\RunWatchdog;
use LegendDevelopment\Theme\Support\Alerts\Notifier;
use LegendDevelopment\Theme\Support\Alerts\State;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Workers;
use Throwable;

/**
 * Where the watchdog is set up, and where it admits what it is doing.
 *
 * The settings are the smaller half. The larger half is the three lines saying
 * what each channel did last time it was asked to send something, and the
 * buttons that ask it to send something now - because the failure this feature
 * is most likely to have is not "it did not check", it is "it checked, found
 * something, and the message went nowhere". A panel in that state looks exactly
 * like a panel with nothing wrong.
 *
 * @property Schema $form
 */
class Alerts extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-bell-ringing';

    protected static ?string $slug = 'essentials-alerts';

    protected static ?int $navigationSort = 9;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::ALERTS);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('alerts.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('alerts.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('alerts.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function mount(): void
    {
        $this->form->fill(Settings::alertsData());
    }

    public function form(Schema $schema): Schema
    {
        $may = Features::mayManage(Features::ALERTS);

        return $schema
            ->components([
                Section::make(Theme::trans('alerts.when'))
                    ->description(Theme::trans('alerts.when_helper'))
                    ->schema([
                        Select::make('alert_every')
                            ->label(Theme::trans('alerts.every'))
                            ->helperText(Theme::trans('alerts.every_helper'))
                            ->options([
                                'off' => Theme::trans('alerts.every_off'),
                                'five' => Theme::trans('alerts.every_five'),
                                'fifteen' => Theme::trans('alerts.every_fifteen'),
                                'thirty' => Theme::trans('alerts.every_thirty'),
                                'hourly' => Theme::trans('alerts.every_hourly'),
                                'daily' => Theme::trans('alerts.every_daily'),
                            ])
                            ->selectablePlaceholder(false),

                        TextInput::make('alert_repeat')
                            ->label(Theme::trans('alerts.repeat'))
                            ->helperText(Theme::trans('alerts.repeat_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(168)
                            ->suffix(Theme::trans('alerts.hours')),
                    ])
                    ->columns(2),

                Section::make(Theme::trans('alerts.where'))
                    ->description(Theme::trans('alerts.where_helper'))
                    ->schema([
                        Toggle::make('alert_discord')
                            ->label(Theme::trans('alerts.discord'))
                            ->helperText(Theme::trans('alerts.discord_helper'))
                            ->inline(false),

                        TextInput::make('alert_webhook')
                            ->label(Theme::trans('alerts.webhook'))
                            ->helperText(Theme::trans('alerts.webhook_helper'))
                            ->url()
                            ->maxLength(400)
                            // Revealable rather than plain: it is pasted from
                            // Discord and it is a credential, so it should be
                            // checkable and not shoulder-readable.
                            ->password()
                            ->revealable(),

                        Toggle::make('alert_panel')
                            ->label(Theme::trans('alerts.panel'))
                            ->helperText(Theme::trans('alerts.panel_helper'))
                            ->inline(false),

                        TextInput::make('alert_email')
                            ->label(Theme::trans('alerts.email'))
                            ->helperText(Theme::trans('alerts.email_helper'))
                            ->maxLength(400)
                            ->placeholder('you@example.com, someone@example.com'),
                    ])
                    ->columns(2),

                Section::make(Theme::trans('alerts.what'))
                    ->description(Theme::trans('alerts.what_helper'))
                    ->schema([
                        TextInput::make('alert_disk')
                            ->label(Theme::trans('alerts.disk'))
                            ->helperText(Theme::trans('alerts.percent_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),

                        TextInput::make('alert_memory')
                            ->label(Theme::trans('alerts.memory'))
                            ->helperText(Theme::trans('alerts.percent_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%'),

                        TextInput::make('alert_maintenance_hours')
                            ->label(Theme::trans('alerts.maintenance'))
                            ->helperText(Theme::trans('alerts.maintenance_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(720)
                            ->suffix(Theme::trans('alerts.hours')),

                        Toggle::make('alert_versions')
                            ->label(Theme::trans('alerts.versions'))
                            ->helperText(Theme::trans('alerts.versions_helper'))
                            ->inline(false),

                        Toggle::make('alert_worker')
                            ->label(Theme::trans('alerts.worker'))
                            ->helperText(Theme::trans('alerts.worker_helper'))
                            ->inline(false),
                    ])
                    ->columns(2),
            ])
            ->disabled(!$may)
            ->statePath('data');
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::ALERTS)) {
            return [];
        }

        return [
            Action::make('ld_save')
                ->label(Theme::trans('alerts.save'))
                ->action(fn () => $this->save()),

            /*
             * Send one now, to whatever is switched on.
             *
             * The single most useful button on this page. Nobody should
             * discover their webhook URL has a typo in it from the outage it
             * failed to report - and the outcomes below say exactly which
             * channel refused and what it said.
             */
            Action::make('ld_test')
                ->label(Theme::trans('alerts.test'))
                ->icon('tabler-send')
                ->color('gray')
                ->action(fn () => $this->test()),

            /*
             * Run the checks now rather than waiting for the schedule.
             *
             * Queued like the scheduled run, so it behaves identically - and
             * so a panel with no worker finds that out here rather than in
             * three days of silence.
             */
            Action::make('ld_now')
                ->label(Theme::trans('alerts.run_now'))
                ->icon('tabler-refresh')
                ->color('gray')
                ->action(fn () => $this->now()),

            /*
             * Forget what every check last said.
             *
             * The alternative to offering this is somebody deleting a file on
             * the server to stop the watchdog insisting about a node they
             * decommissioned last week.
             */
            Action::make('ld_reset')
                ->label(Theme::trans('alerts.reset'))
                ->icon('tabler-eraser')
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription(Theme::trans('alerts.reset_confirm'))
                ->action(function (): void {
                    State::forget();

                    Notification::make()
                        ->title(Theme::trans('alerts.reset_done'))
                        ->success()
                        ->send();
                }),
        ];
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(Features::ALERTS), 403);

        try {
            Settings::persistAlerts($this->form->getState());
        } catch (Throwable $exception) {
            /*
             * Reported rather than swallowed.
             *
             * A save that silently did nothing was a real fault here twice, and
             * both times it was only findable because this catch exists and
             * says what happened.
             */
            report($exception);

            Notification::make()
                ->title(Theme::trans('alerts.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()->title(Theme::trans('alerts.saved'))->success()->send();
    }

    /**
     * A test message to every channel that is switched on.
     *
     * Sent from the request rather than the queue, deliberately: this button
     * exists to answer "does the webhook work", and answering it through a
     * queue would mean a panel with no worker getting no answer at all - which
     * is the same silence the button is there to break.
     */
    private function test(): void
    {
        abort_unless(Features::mayManage(Features::ALERTS), 403);

        // Saved first, so pressing Test after typing a URL tests the URL that
        // was typed rather than the one from before.
        $this->save();

        $done = Notifier::send(
            Theme::trans('alerts.test_title'),
            Theme::trans('alerts.test_body'),
            true,
        );

        if ($done === []) {
            Notification::make()
                ->title(Theme::trans('alerts.test_none'))
                ->body(Theme::trans('alerts.test_none_body'))
                ->warning()
                ->send();

            return;
        }

        $failed = array_keys(array_filter($done, static fn (bool $ok): bool => !$ok));

        if ($failed === []) {
            Notification::make()->title(Theme::trans('alerts.test_sent'))->success()->send();

            return;
        }

        // Named, with the reason, because "a channel failed" sends somebody to
        // look at their firewall and "401 Unauthorized" sends them to the URL.
        $why = [];

        foreach (Notifier::outcomes() as $channel => $outcome) {
            if (in_array($channel, $failed, true) && $outcome['why'] !== '') {
                $why[] = $channel . ': ' . $outcome['why'];
            }
        }

        Notification::make()
            ->title(Theme::trans('alerts.test_failed'))
            ->body(implode(' — ', $why))
            ->danger()
            ->persistent()
            ->send();
    }

    private function now(): void
    {
        abort_unless(Features::mayManage(Features::ALERTS), 403);

        try {
            RunWatchdog::dispatch();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('alerts.run_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('alerts.run_started'))
            ->body(Workers::body())
            ->success()
            ->send();
    }

    /**
     * What each channel did last time, for the view.
     *
     * @return array<int, array{channel: string, label: string, on: bool, state: string, when: string, why: string}>
     */
    public function outcomes(): array
    {
        $outcomes = Notifier::outcomes();
        $rows = [];

        foreach (Notifier::CHANNELS as $channel) {
            $on = Notifier::enabled($channel);
            $row = $outcomes[$channel] ?? null;

            $rows[] = [
                'channel' => $channel,
                'label' => match ($channel) {
                    Notifier::DISCORD => Theme::trans('alerts.discord'),
                    Notifier::PANEL => Theme::trans('alerts.panel'),
                    default => Theme::trans('alerts.email'),
                },
                'on' => $on,
                // Four states rather than two: a channel that is switched off
                // and one that has never been asked are different situations,
                // and only one of them is worth doing something about.
                'state' => match (true) {
                    !$on => 'off',
                    $row === null => 'untried',
                    $row['ok'] => 'ok',
                    default => 'failed',
                },
                'when' => $row === null || $row['at'] === 0
                    ? ''
                    : CarbonImmutable::createFromTimestamp($row['at'])->diffForHumans(),
                'why' => $row['why'] ?? '',
            ];
        }

        return $rows;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.alerts';
    }
}
