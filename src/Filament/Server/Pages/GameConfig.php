<?php

namespace LegendDevelopment\Theme\Filament\Server\Pages;

use App\Enums\SubuserPermission;
use App\Models\Server;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Games\Words;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * A game's configuration file as a form, drawn from the file itself.
 *
 * **Everything a game page does that is not about the game.** Reading the file,
 * deciding who may look and who may write, turning what was read into fields,
 * putting the changed values back into the bytes that were read, and saying the
 * right thing when the file is not there yet or the daemon refuses.
 *
 * What is left for a game is four small answers and its own name. That is the
 * whole point: roadmap/games.md is about what a game costs, and the first one
 * built this way cost three hundred lines. The second should cost forty.
 *
 * **It is deliberately not ArkConfig's parent.** ARK has a hand-written list of
 * fifteen settings, grouped into three sections with a heading and a sentence
 * apiece, and that is a different page that happens to edit a file. Forcing the
 * two together would give this one groups it cannot fill and give that one a
 * field list it does not want. They share a promise rather than a shape: change
 * the lines you recognise and leave everything else exactly where it was.
 *
 * The field names are the file's own, untranslated, and the page says so before
 * the form rather than leaving somebody to conclude it is broken. Nothing here
 * knows what any of these settings mean, which is why there is no grouping, no
 * ordering and no validation beyond refusing a line ending.
 *
 * @property Schema $form
 */
abstract class GameConfig extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    /**
     * Each file exactly as it was read, by its path.
     *
     * Held so saving puts the changed values back into *those* files rather
     * than building new ones, which is what keeps every comment, blank line and
     * unknown key where it was.
     *
     * **More than one, because several games keep more than one.** Satisfactory
     * has Game.ini and Engine.ini, Don't Starve Together has three, Factorio
     * has two. A page that held one file would have been a page those games
     * could not have, and the alternative - a sidebar row per file - is a
     * sidebar about files.
     *
     * @var array<string, string|null>
     */
    public array $contents = [];

    /**
     * What each field on the form is, by the name the form knows it by.
     *
     * Filament reads a dot in a field name as a step into a nested array and
     * these keys are full of dots, so a field cannot be named after its
     * setting. It is named after its place instead - `f0_12` - and this says
     * which file and which key that place is. Numbered rather than encoded,
     * because any encoding of a key is an encoding something can collide with,
     * and a number cannot.
     *
     * @var array<string, array{file: string, key: string, set: bool}>
     */
    public array $named = [];

    /** The translation prefix this game's own six strings live under. */
    abstract protected static function words(): string;

    /** Whether this server is this game. */
    abstract protected static function knows(Server $server): bool;

    /**
     * The files this game keeps, in the order they should be shown.
     *
     * Paths relative to the server's root, which is what the daemon's file
     * repository takes. The heading over each section is the file's own name,
     * untranslated, because `Engine.ini` is `Engine.ini` in every language and
     * a heading this invented would be a claim about what is in it.
     *
     * @return array<int, string>
     */
    abstract protected static function paths(): array;

    /** One file, or null where there is not one yet. */
    abstract protected function contentsOf(Server $server, string $path): ?string;

    abstract protected function saveTo(Server $server, string $path, string $contents): bool;

    /**
     * Every setting the file mentions, set or not.
     *
     * A string for a key that is set and null for one that is only mentioned in
     * a comment. A game whose file has no such convention answers the parse and
     * nothing else, which is a correct answer to this question.
     *
     * @return array<string, string|null>
     */
    abstract protected function offered(string $contents): array;

    /**
     * The file back, with those values changed and nothing else.
     *
     * @param  array<string, string>  $changes
     */
    abstract protected function rewrite(string $contents, array $changes): string;

    public static function canAccess(): bool
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server
                && static::knows($server)
                && (user()?->can(SubuserPermission::FileReadContent, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans(static::words() . '.title');
    }

    /**
     * One view for all of them.
     *
     * There is nothing in it that is about any particular game: the sections,
     * their headings and every field come from what the server actually has,
     * read above. Four identical copies of it is four places for a fix to miss.
     */
    public function getView(): string
    {
        return Theme::id() . '::pages.game-config';
    }

    /**
     * Shared, with the file names put into it.
     *
     * Written per game once, and it named the file it read - which is right
     * until a game keeps two, at which point "everything Game.ini mentions" is
     * a sentence about half the page and "Game.ini and Engine.ini mentions"
     * does not agree with itself in most languages. So the sentence is one
     * sentence and the file names go in as a value.
     */
    public function getSubheading(): ?string
    {
        $paths = static::paths();

        return Theme::trans('games.subheading', [
            'files' => implode(', ', array_map(
                static fn (string $path): string => self::heading($path, $paths),
                $paths,
            )),
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans(static::words() . '.nav_label');
    }

    public function mount(): void
    {
        $this->read();
    }

    /** Whether this viewer may change anything, or only look. */
    public function mayEdit(): bool
    {
        try {
            $server = $this->server();

            return $server !== null
                && (user()?->can(SubuserPermission::FileUpdate, $server) ?? false);
        } catch (Throwable) {
            return false;
        }
    }

    /** Whether any of them are there at all. */
    public function found(): bool
    {
        foreach ($this->contents as $text) {
            if ($text !== null) {
                return true;
            }
        }

        return false;
    }

    public function read(): void
    {
        $server = $this->server();

        if ($server === null) {
            return;
        }

        $this->contents = [];
        $this->named = [];

        $state = [];

        foreach (static::paths() as $at => $path) {
            $text = $this->contentsOf($server, $path);
            $this->contents[$path] = $text;

            if ($text === null) {
                continue;
            }

            $index = 0;

            foreach ($this->offered($text) as $key => $value) {
                $name = 'f' . $at . '_' . $index++;

                $this->named[$name] = [
                    'file' => $path,
                    'key' => (string) $key,
                    'set' => $value !== null,
                ];

                $state[$name] = $value ?? '';
            }
        }

        $this->data = $state;
        $this->form->fill($state);
    }

    /**
     * One section, and one field a setting.
     *
     * No grouping, in the file's own order. Both follow from the same thing:
     * this page knows the names of these settings and nothing else about them,
     * so any order it invented would be a guess and any heading it wrote would
     * be a claim.
     */
    public function form(Schema $schema): Schema
    {
        $may = $this->mayEdit();
        $sections = [];

        foreach (static::paths() as $path) {
            $fields = [];

            foreach ($this->named as $name => $about) {
                if ($about['file'] !== $path) {
                    continue;
                }

                $key = $about['key'];
                $said = Words::of($key);

                $fields[] = $this->field((string) $name, $key, $said, $about['set'], $may);
            }

            if ($fields === []) {
                continue;
            }

            /*
             * One section a file, headed by the file's own name.
             *
             * A game with one file gets one section and reads as it did before
             * there were two. A game with three gets three, in the order it
             * named them, which is the only order there is: nothing here knows
             * what any of these settings mean.
             */
            $sections[] = Section::make(self::heading($path, static::paths()))
                ->description(fn (): string => Theme::trans('games.group_all_helper'))
                ->schema($fields)
                ->columns(['default' => 1, 'sm' => 2]);
        }

        return $schema->components($sections)->statePath('data');
    }

    /**
     * What to call a file on the page: as short as it can be and still be one.
     *
     * The basename, which is what somebody would say out loud - until two of
     * the files share one. Don't Starve Together keeps a `server.ini` for each
     * shard, `Master/server.ini` and `Caves/server.ini`, and two sections both
     * headed `server.ini` are two sections nobody can tell apart. So the
     * directory comes back in, for every file rather than only the ones that
     * clash: a page where one heading is a path and the next is a bare name
     * reads as though something went wrong with one of them.
     *
     * The separator is a forward slash and only ever one: these paths go to
     * the daemon's file repository, which is what fixes that.
     *
     * Untranslated either way. `Engine.ini` is `Engine.ini` in every language,
     * and a name this invented would be a claim about what is inside it.
     *
     * @param  array<int, string>  $paths  Every file this game keeps.
     */
    private static function heading(string $path, array $paths): string
    {
        $names = array_map('basename', $paths);

        if (count(array_unique($names)) === count($names)) {
            return basename($path);
        }

        $parts = explode('/', trim($path, '/'));

        return implode('/', array_slice($parts, -2));
    }

    /** One setting, as a control. */
    private function field(string $name, string $key, string $said, bool $set, bool $may): TextInput
    {
        return TextInput::make($name)
                /*
                 * The key in words, and the key itself underneath it.
                 *
                 * Both, because they answer different questions. "Max players"
                 * is what somebody reads; `maxplayers` is what they search the
                 * game's own documentation for and what they would type into
                 * the file by hand. Showing only the first would hide the thing
                 * this page is actually editing.
                 *
                 * Where there is nothing to derive - a single lowercase run -
                 * Words::of() gives the key back and the two read the same,
                 * which is honest rather than untidy.
                 */
            ->label($said)
            /*
             * The raw key underneath, but only where it says something the
             * label does not. A setting whose name is one lowercase word reads
             * the same both ways, and printing it twice is noise.
             */
            ->hint(strcasecmp($said, $key) === 0 ? null : $key)
            ->helperText($set ? null : Theme::trans('games.unset'))
            // maxLength rather than a rule about the value: these files are
            // line-based, so the only thing that could turn one setting into
            // two is a line ending, and the readers refuse that.
            ->maxLength(2000)
            ->disabled(!$may);
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!$this->mayEdit() || !$this->found()) {
            return [];
        }

        return [
            Action::make('ld_save')
                ->label(Theme::trans('games.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save()),
        ];
    }

    public function save(): void
    {
        $server = $this->server();

        abort_unless($server !== null && $this->mayEdit(), 403);

        if (!$this->found()) {
            return;
        }

        try {
            $state = $this->form->getState();
            $changes = [];

            foreach ($state as $name => $value) {
                $about = $this->named[$name] ?? null;

                if ($about === null) {
                    continue;
                }

                $said = trim((string) $value);

                /*
                 * A setting that was only a comment is written only when it is
                 * given something.
                 *
                 * Otherwise opening this page and pressing Save would append
                 * every commented example in the file as an empty live setting,
                 * which is a different server than the one somebody had. A key
                 * that was already set is written either way, because clearing
                 * one is a thing people mean.
                 */
                if ($said === '' && !$about['set']) {
                    continue;
                }

                $changes[$about['file']][$about['key']] = $said;
            }

            $written = true;

            /*
             * The files this game names, not the files the request carries.
             *
             * Both $contents and $named are public properties, which means they
             * are state Livewire sends to the browser and reads back. Livewire
             * signs that snapshot, so a changed path should never reach here at
             * all - and this page writes files on somebody's server through the
             * daemon, which is not the place to let one check stand alone. The
             * paths are declared in code; asking that list is one line.
             */
            foreach (static::paths() as $path) {
                $text = $this->contents[$path] ?? null;

                if ($text === null || !isset($changes[$path])) {
                    continue;
                }

                /*
                 * Each file on its own, and a refusal stops the rest.
                 *
                 * Writing the second after the first was refused would leave a
                 * game half configured, which is worse than not configured: the
                 * two files of a game like Satisfactory are read together and a
                 * server started on half a change is a server nobody can reason
                 * about.
                 */
                if (!$this->saveTo($server, $path, $this->rewrite($text, $changes[$path]))) {
                    $written = false;

                    break;
                }
            }
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('games.failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        if (!$written) {
            Notification::make()
                ->title(Theme::trans('games.failed'))
                ->body(Theme::trans('games.failed_write'))
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        // Read back, so the form shows the file rather than what was sent to
        // it - and so a key that has just become set stops saying it is not.
        $this->read();

        Notification::make()
            ->title(Theme::trans('games.saved'))
            ->body(Theme::trans('games.restart'))
            ->success()
            ->send();
    }

    protected function server(): ?Server
    {
        try {
            $server = Filament::getTenant();

            return $server instanceof Server ? $server : null;
        } catch (Throwable) {
            return null;
        }
    }
}
