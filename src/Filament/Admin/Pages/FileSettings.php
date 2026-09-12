<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use LegendDevelopment\Theme\Support\Cdn\Uploads;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Where the files this plugin keeps are put.
 *
 * Its own tab rather than a corner of another page, because it is about every
 * file rather than about one feature. It began inside the tickets window, which
 * is where the first file this plugin had to keep happened to arrive - and a
 * panel with a bucket does not want its pictures on a CDN and its backdrop on
 * the panel's own disk because of where the setting was first written.
 *
 * Everything a settings page does is in SettingsPage. What is its own is which
 * sections it shows, where it sits, and the one button that finds out whether
 * any of it actually works.
 */
class FileSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-cloud-upload';

    protected static ?string $slug = 'essentials-files';

    protected static ?int $navigationSort = 9;

    protected static function key(): string
    {
        return Features::FILES;
    }

    /**
     * This page's own settings, and only those.
     *
     * SettingsPage fills from - and saves through - the one big set, because
     * that is what its four original pages all edit between them. These are not
     * in that set: they have their own reader and their own writer, like the
     * sign-in screen and the ticket desk do.
     *
     * Getting this wrong is quiet and total. The form filled with nothing,
     * saving wrote nothing, and the page came back empty every time - which
     * reads as a page that resets what you just typed.
     */
    public function mount(): void
    {
        $this->form->fill(Settings::filesData());
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(static::key()), 403);

        try {
            /*
             * The stored set first, this form over the top.
             *
             * **A hidden field is not in the form's state**, and half this page
             * is hidden at any moment: the bucket fields only exist while the
             * destination is a bucket, the CDN fields only while it is a CDN.
             * Saving the state on its own therefore handed persistFiles() one
             * field, and a writer takes a missing key as "put it back to the
             * default" - so choosing a CDN and pressing Save wiped the address,
             * the token and the folder that had just been typed into it.
             *
             * Read again rather than trusting what was filled at mount, which
             * is what the page this one is built on does, and for the same
             * reason: another tab saved five minutes ago should not be undone
             * by this one.
             */
            Settings::persistFiles(array_merge(Settings::filesData(), $this->form->getState()));

            Notification::make()
                ->title(Theme::trans('page.saved'))
                ->success()
                ->send();

            // Back to the page, so the fields that only show for one
            // destination are drawn against what was actually saved.
            $this->redirect(static::getUrl());
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('page.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Whether it works, which is a different question from whether it is filled
     * in.
     *
     * A header action rather than a field, because it answers rather than
     * saves - and because what it does is write a real file to a real
     * destination and fetch it back over the address a browser would use. A key
     * that looks right and a bucket that refuses a write are the same screen
     * until something is written.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            /*
             * And move what is already here, which is a separate decision from
             * where the next one goes.
             *
             * Asks first, because it changes addresses that are already written
             * down - the one thing everything else in this plugin is careful
             * never to do on its own.
             */
            Action::make('move_files')
                ->label(fn (): string => Theme::trans('settings.files.move'))
                ->icon('tabler-arrows-exchange')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription(fn (): string => Theme::trans('settings.files.move_confirm'))
                ->visible(fn (): bool => Uploads::on())
                ->action(function (): void {
                    abort_unless(Features::mayManage(static::key()), 403);

                    $done = Settings::moveFiles();

                    Notification::make()
                        ->title(Theme::trans('settings.files.move_done'))
                        ->body(Theme::trans('settings.files.move_done_body', [
                            'looked' => (string) $done['looked'],
                            'moved' => (string) $done['moved'],
                            'failed' => (string) $done['failed'],
                        ]))
                        ->success()
                        ->persistent()
                        ->send();

                    $this->redirect(static::getUrl());
                }),

            Action::make('check_files')
                ->label(fn (): string => Theme::trans('settings.files.check'))
                ->icon('tabler-plug-connected')
                ->color('gray')
                ->action(fn () => $this->probe()),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected function groups(): array
    {
        return Settings::fileGroups();
    }

    /** Write something, read it back over its public address, and say so. */
    private function probe(): void
    {
        $wrong = Uploads::check();

        if ($wrong === null) {
            Notification::make()
                ->title(Theme::trans('settings.files.check_ok'))
                ->body(Theme::trans('settings.files.check_ok_body'))
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('settings.files.check_bad'))
            ->body($wrong)
            ->danger()
            ->persistent()
            ->send();
    }
}
