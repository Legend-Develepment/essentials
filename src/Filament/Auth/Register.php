<?php

namespace LegendDevelopment\Theme\Filament\Auth;

use App\Models\User;
use Filament\Auth\Pages\Register as Base;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Illuminate\Database\Eloquent\Model;
use LegendDevelopment\Theme\Support\Registration;
use LegendDevelopment\Theme\Support\Theme;
use SensitiveParameter;

/**
 * Making an account, for a panel whose users have no name.
 *
 * Filament's own page asks for a name, an email and a password, and writes them
 * to a `name` column. **Pelican's users table has no such column**: it has
 * `username`, which is required and unique, and the stock page would fail on
 * the insert rather than in the form. So the name field is replaced rather than
 * relabelled.
 *
 * Everything else the base class already does properly and is left alone: the
 * password rules, the confirmation, the rate limit on repeated attempts, and
 * the email verification notification where a panel has that switched on.
 *
 * `uuid` is not asked for and not set here. Pelican's User fills it in on
 * `creating`, and a second opinion about a value the model already owns is a
 * second place for it to go wrong.
 */
class Register extends Base
{
    /**
     * A username, in place of the name the base class wants.
     *
     * The pattern is `Support\Registration::PATTERN` and is stricter than
     * Pelican's own, for the reason given there: this form is reachable by
     * anything with an HTTP client.
     *
     * `unique` is checked here as well as by the database, so somebody who
     * picks a taken name is told which field is wrong instead of meeting an
     * integrity error.
     */
    protected function getNameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label(fn (): string => Theme::trans('register.username'))
            ->helperText(fn (): string => Theme::trans('register.username_helper'))
            ->required()
            ->minLength(3)
            ->maxLength(Registration::MAX_LENGTH)
            ->regex(Registration::PATTERN)
            ->validationMessages([
                'regex' => fn (): string => Theme::trans('register.username_rule'),
            ])
            ->unique(table: User::class, column: 'username')
            ->autofocus()
            ->autocomplete('username');
    }

    /**
     * The account itself.
     *
     * Only the three things this form asked for. Everything else the row needs
     * has a default in the schema or is filled by the model, and naming them
     * here would be this page having an opinion about a language and a timezone
     * that the person has not been asked about yet.
     *
     * @param  array<string, mixed>  $data
     */
    protected function handleRegistration(#[SensitiveParameter] array $data): Model
    {
        return User::query()->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function getTitle(): string
    {
        return Theme::trans('register.title');
    }

    public function getHeading(): string
    {
        return Theme::trans('register.heading');
    }

    /**
     * Whatever the administrator wanted said under the form.
     *
     * Plain text by the time it reaches here - see Registration::note() - so a
     * page drawn for somebody with no account carries nothing that was typed
     * into an admin form and rendered as markup.
     */
    public function getSubheading(): ?string
    {
        return Registration::note();
    }
}
