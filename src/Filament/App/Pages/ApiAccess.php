<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Key;
use LegendDevelopment\Theme\Support\Api\Keys;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Asking for a key of your own.
 *
 * In the client panel, and with no permission of its own, for the same reason
 * the status page here has none: what it hands out cannot reach further than
 * the person holding it already can. A personal key answers for the servers its
 * owner can open, asked through the same call the panel asks, so somebody
 * losing one loses nothing they could not already see.
 *
 * **What needs a permission is the answering**, and that is on the
 * administrator's page. Whether a request waits for an answer at all is a
 * setting - on by default, because a panel where anybody mints themselves a key
 * the moment they sign in is a reasonable thing to want and a bad thing to
 * arrive at without having chosen it.
 *
 * One open request at a time. Not a rule about resources - a person with four
 * pending requests is a person who clicked twice and an administrator with four
 * rows to read that all say the same thing.
 */
class ApiAccess extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-plug-connected';

    protected static ?string $slug = 'api-access';

    protected static ?int $navigationSort = 92;

    /**
     * A key granted a moment ago, held for one render and never stored.
     *
     * See the note on the administrator's page: there is no way back to this
     * string from the row it belongs to, which is the property that makes the
     * table safe to look at and this box the only chance to copy it.
     */
    public ?string $fresh = null;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::API) && Keys::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('api.my_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('api.my_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('api.my_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.api-access';
    }

    /**
     * This person's keys, newest first.
     *
     * Scoped on user_id and nothing else. There is no filter here that somebody
     * could be talked past: the query cannot express another person's rows.
     *
     * @return Collection<int, Key>
     */
    public function keys(): Collection
    {
        try {
            return Key::query()
                ->where('user_id', $this->actor()->id)
                ->orderByDesc('created_at')
                ->get();
        } catch (Throwable) {
            return collect();
        }
    }

    /** Whether there is already one waiting, which is what stops a second. */
    public function waiting(): bool
    {
        return $this->keys()->contains(fn (Key $key): bool => $key->state === Key::PENDING);
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('ld_ask')
                ->label(Theme::trans('api.ask'))
                ->icon('tabler-plus')
                ->schema([
                    TextInput::make('name')
                        ->label(Theme::trans('api.ask_name'))
                        ->helperText(Theme::trans('api.ask_name_helper'))
                        ->required()
                        ->maxLength(60),

                    Textarea::make('reason')
                        ->label(Theme::trans('api.ask_reason'))
                        ->helperText(Theme::trans('api.ask_reason_helper'))
                        ->maxLength(500),
                ])
                ->action(fn (array $data) => $this->ask($data)),
        ];
    }

    /** @param  array<string, mixed>  $data */
    public function ask(array $data): void
    {
        abort_unless(Features::enabled(Features::API), 404);

        if ($this->waiting()) {
            Notification::make()
                ->title(Theme::trans('api.ask_open'))
                ->body(Theme::trans('api.ask_open_body'))
                ->warning()
                ->send();

            return;
        }

        try {
            $me = $this->actor();
            $key = Keys::ask($me, (string) ($data['name'] ?? ''), (string) ($data['reason'] ?? ''));

            /*
             * Where approval is off, the same person is asking and answering,
             * so the request and the grant are one act. The row still records
             * both - it is granted by its own owner, which is the honest
             * account of what happened and reads correctly on the
             * administrator's page.
             */
            if (!Keys::approvalNeeded()) {
                $this->fresh = Keys::grant($key, $me);

                Notification::make()->title(Theme::trans('api.ask_granted'))->success()->send();

                return;
            }

            Notification::make()
                ->title(Theme::trans('api.ask_sent'))
                ->body(Theme::trans('api.ask_sent_body'))
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('api.ask_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Withdrawing a request, or ending a key.
     *
     * One method for both, because from here they are the same sentence - "I do
     * not want this any more" - and because the check that matters is the same
     * one: the row has to be this person's. It is looked up by id *and* by
     * owner rather than found and then checked, so a wrong id is a row that
     * does not exist rather than a row somebody has to remember to refuse.
     */
    public function drop(int $id): void
    {
        abort_unless(Features::enabled(Features::API), 404);

        try {
            /** @var Key|null $key */
            $key = Key::query()
                ->where('id', $id)
                ->where('user_id', $this->actor()->id)
                ->first();

            if ($key === null) {
                return;
            }

            Keys::revoke($key);

            Notification::make()->title(Theme::trans('api.revoked'))->success()->send();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * And off their own page, once it has stopped answering.
     *
     * Same lookup as drop(): by id *and* by owner, so a wrong id is a row that
     * does not exist rather than one somebody has to remember to refuse. The
     * decision about what may be removed is Keys::forget()'s, in one place, so
     * this page and the administrator's cannot disagree about it.
     */
    public function forget(int $id): void
    {
        abort_unless(Features::enabled(Features::API), 404);

        try {
            /** @var Key|null $key */
            $key = Key::query()
                ->where('id', $id)
                ->where('user_id', $this->actor()->id)
                ->first();

            if ($key === null || !Keys::forget($key)) {
                return;
            }

            Notification::make()->title(Theme::trans('api.forgotten'))->success()->send();
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /** Whoever is signed in. A Filament page cannot be reached without one. */
    private function actor(): User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }
}
