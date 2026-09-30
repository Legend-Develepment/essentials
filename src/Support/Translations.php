<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Making a language without touching the plugin.
 *
 * Download a JSON of every string, translate the values, upload it back. That
 * is the whole of it, and the two halves are shaped by where the result has to
 * live.
 *
 * Not in the plugin's own lang directory, which is the obvious place and the
 * wrong one: installing an update replaces the plugin folder entire, so a
 * translation kept there would be thrown away by the next release - silently,
 * and at the moment somebody is least expecting it. Laravel already has a way
 * for exactly this. A namespaced translation is overridden by
 * vendor/<namespace>/<locale>/<group>.php under any registered translation path,
 * and merged over the plugin's own per key. So an uploaded language can also be
 * a partial one: what it translates wins, and the rest falls back the way every
 * other language here does.
 *
 * **Under private storage, not under base_path('lang').** Laravel's own
 * documentation would put it in lang/vendor, and that is where it was. But
 * Pelican lists every directory under lang as a language somebody can pick, so
 * a panel with lang/vendor in it offered a language called Vendor in the
 * profile picker. It lives under the panel's private storage now, and register()
 * hands that directory to the translator itself, so nothing enumerates it.
 *
 * The file covers the panel's own strings too, so one download and one upload
 * is the whole of a language rather than half of it. The two halves are told
 * apart by the prefix Laravel itself uses: this plugin's keys are addressed as
 * `essentials::page.title` in code and appear that way in the file, and the
 * panel's own are bare - `activity.description`, `admin/node.title`.
 *
 * They are also written to different places, and the difference matters. A
 * namespaced translation is merged over the plugin's per key, so a partial file
 * is a partial language. The panel's own are not namespaced and Laravel does not
 * merge those: `lang/nl/activity.php` replaces the file. So the panel half is
 * read, merged over, and written back whole - otherwise uploading five Dutch
 * strings would throw away the several hundred Pelican already ships.
 *
 * One thing that cannot be helped and is worth knowing: updating Pelican
 * replaces its own lang files, and the panel half of an upload lives in them.
 * The plugin half is outside the plugin and outside Pelican, and survives
 * everything.
 *
 * Flat keys in the JSON rather than nested objects, because it is meant to be
 * edited by a person in a text editor and a flat list is one you can search,
 * sort and diff. It is expanded back into the nested arrays PHP wants on the
 * way in.
 */
class Translations
{
    /**
     * The JSON is written and read by hand, so this is a real ceiling rather
     * than a formality: the file is about a hundred kilobytes with every string
     * in it, and anything much past that is not a translation of this plugin.
     */
    public const MAX_BYTES = 2097152;

    /**
     * The translation path this plugin registers, on the private disk.
     *
     * What is uploaded for this plugin's own strings sits under it at
     * vendor/<id>/<code>/<group>.php, which is the shape Laravel looks for when
     * it merges an override over a plugin's own file.
     */
    private const ROOT = 'legend-theme/languages/uploaded';

    /**
     * Whether the path has been handed to the translator in this process.
     *
     * Laravel appends a path every time it is given one, so handing it over
     * twice would read every group twice for the rest of the request.
     */
    private static bool $registered = false;

    /**
     * Every string, flattened, with the values of one language in them.
     *
     * English when the code is unknown or not asked for, which is what makes
     * this a template: somebody starting a new language gets the English text
     * to translate rather than a file of empty strings, and can see what each
     * key is for.
     *
     * @return array<string, string>
     */
    public static function template(?string $code = null): array
    {
        return self::build($code)['lines'];
    }

    /**
     * The template, and how much of it is not English.
     *
     * The count is what makes the file worth opening. A language nothing has
     * ever been written for downloads as a few thousand English lines, and with
     * no count there is no way to tell that apart from one that is finished.
     *
     * @return array{lines: array<string, string>, translated: int}
     */
    private static function build(?string $code): array
    {
        $out = [];
        $translated = 0;
        $existing = $code !== null && $code !== Languages::BASE;

        // This plugin's, under the prefix its keys actually carry in code.
        foreach (self::groups() as $group => $english) {
            $theirs = $existing ? self::read($code, $group) : [];

            foreach (self::flatten($english) as $key => $value) {
                $line = self::pluck($theirs, $key);
                $out[self::prefix() . $group . '.' . $key] = $line ?? $value;
                $translated += $line === null ? 0 : 1;
            }
        }

        /*
         * The panel's own, bare, which is how Laravel addresses them.
         *
         * Asked of the translator rather than read out of Pelican's file, so
         * the file holds what the panel actually says: Pelican's own strings
         * where there are some, and the ones this plugin fills in where Pelican
         * stops. install() measures an upload against this same answer, and the
         * two have to agree - a file handed out with English where the reader
         * sees Finnish would come back as a change nobody made.
         */
        foreach (self::panelGroups() as $group => $english) {
            foreach (self::flatten($english) as $key => $value) {
                $name = $group . '.' . $key;
                $line = $existing ? self::panelSays((string) $code, $name) : null;
                $out[$name] = $line ?? $value;
                $translated += $line === null ? 0 : 1;
            }
        }

        ksort($out);

        return [
            'lines' => $out,
            // English is finished by definition: it is what everything else is
            // measured against.
            'translated' => $existing ? $translated : count($out),
        ];
    }

    /**
     * The file somebody downloads, with how much of it was already done.
     *
     * @return array{json: string, total: int, translated: int}
     */
    public static function download(string $code): array
    {
        $built = self::build($code);

        return [
            'json' => self::encode($built['lines']),
            'total' => count($built['lines']),
            'translated' => $built['translated'],
        ];
    }

    /**
     * The template as the file people are handed.
     *
     * Unescaped slashes and unicode so a translator reads their own alphabet in
     * the file rather than a run of escapes, and pretty-printed because they are
     * going to open it.
     */
    public static function json(?string $code = null): string
    {
        return self::encode(self::template($code));
    }

    /** @param  array<string, string>  $lines */
    private static function encode(array $lines): string
    {
        return (string) json_encode($lines, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /* ------------------------------------------------------- installing --- */

    /**
     * Write an uploaded translation where Laravel will read it.
     *
     * Answers with what it did, because a translation is nearly always partial
     * and the person who made it is the one who can tell whether the number is
     * the number they expected.
     *
     * **Only the lines that say something different are kept.** The file
     * somebody uploads is the file they downloaded, which holds every string
     * the panel says. Keeping all of it would pin the hundreds of lines they
     * never touched at whatever those said that afternoon, and a correction in
     * a later release would never get past them. So each line is measured
     * against what the panel says without the upload - what this plugin ships
     * for its own strings, what Pelican and the strings filled in beside it say
     * for the panel's - and a line that matches is left alone and counted.
     *
     * **This plugin's half is replaced, not added to.** Whenever the file holds
     * any of this plugin's strings, what was uploaded for them before goes and
     * what differs in this file takes its place. That is what makes taking one
     * correction back work: delete the line, upload the file again, and the
     * string says what the plugin ships. A file of the panel's strings alone
     * leaves this plugin's half as it was.
     *
     * The panel's half cannot work that way and does not try: it is merged into
     * Pelican's own files, where there is nothing underneath to go back to.
     *
     * **A line that would break a page is left out and named**, and the rest of
     * the file is installed anyway: one bad line in Polish should cost that
     * line, not the language. See fault() for what counts.
     *
     * @param  array<string, mixed>  $flat
     * @return array{written: int, mine: int, panel: int, same: int, skipped: int, dropped: array<int, string>}
     *
     * @throws \RuntimeException
     */
    public static function install(string $code, array $flat): array
    {
        throw_if(!self::code($code), new \RuntimeException('That is not a language code this can use.'));

        $known = self::template();
        $nested = [];
        $panel = [];
        $written = 0;
        $mineCount = 0;
        $panelCount = 0;
        $same = 0;
        $carried = false;
        $skipped = 0;
        $dropped = [];
        $prefix = self::prefix();

        // Named, up to a point: the count says how many, the names say which.
        $drop = static function (string $key, string $why) use (&$skipped, &$dropped): void {
            $skipped++;

            if (count($dropped) < 20) {
                $dropped[] = $key . ': ' . $why;
            }
        };

        foreach ($flat as $key => $value) {
            if (!is_string($key) || !is_string($value)) {
                $drop((string) $key, 'not a string');

                continue;
            }

            if (trim($value) === '') {
                $drop($key, 'empty');

                continue;
            }

            /*
             * Only keys English has.
             *
             * A key nothing asks for is dead weight at best, and at worst it is
             * a misspelling of a real one - which means that string is not
             * actually translated while looking as though it is. The same rule
             * the build applies to the translations shipped here.
             */
            /*
             * A file downloaded before the panel's strings were in it has this
             * plugin's keys without the prefix. Accepting those is a small
             * kindness that costs one lookup: a translation somebody spent an
             * evening on should not be refused wholesale for a naming change.
             */
            if (!array_key_exists($key, $known) && array_key_exists($prefix . $key, $known)) {
                $key = $prefix . $key;
            }

            if (!array_key_exists($key, $known)) {
                $drop($key, 'not a string this plugin or the panel has');

                continue;
            }

            $mine = str_starts_with($key, $prefix);
            $parts = explode('.', $mine ? substr($key, strlen($prefix)) : $key);
            $group = array_shift($parts);

            if ($parts === []) {
                $drop($key, 'not a string this plugin or the panel has');

                continue;
            }

            $carried = $carried || $mine;

            // Before the checks below: a line that says what the panel already
            // says changes nothing, so a flaw in it is not this file's to answer.
            if ($value === self::says($code, $key, $known[$key])) {
                $same++;

                continue;
            }

            $fault = self::fault($value, $known[$key]);

            if ($fault !== null) {
                $drop($key, $fault);

                continue;
            }

            /*
             * The slot is made first and then passed, rather than both at once.
             *
             * `self::put($nested[$group] ??= [], ...)` reads well and cannot
             * work: ??= is an expression, and PHP will not pass the result of an
             * expression to a parameter taken by reference. It is a fatal at the
             * moment of the call, so it never showed up until somebody actually
             * uploaded a translation - and then only as "Error while loading
             * page" until the save started catching Throwable.
             */
            if ($mine) {
                $nested[$group] ??= [];
                self::put($nested[$group], $parts, $value);
                $mineCount++;
            } else {
                $panel[$group] ??= [];
                self::put($panel[$group], $parts, $value);
                $panelCount++;
            }

            $written++;
        }

        /*
         * Nothing that says anything new, and nothing is touched.
         *
         * Not even this plugin's half, which the file would otherwise replace:
         * a file in which every line matches is far more often the downloaded
         * file sent straight back than a decision to undo every correction, and
         * the Remove button is there for that one.
         */
        if ($written === 0) {
            return [
                'written' => 0,
                'mine' => 0,
                'panel' => 0,
                'same' => $same,
                'skipped' => $skipped,
                'dropped' => $dropped,
            ];
        }

        if ($carried) {
            Storage::disk('local')->deleteDirectory(self::base() . '/' . $code);
        }

        if ($nested !== []) {
            self::write($code, $nested);

            // The first upload on a panel is what makes the directory, so the
            // translator could not have been told about it at boot.
            self::register();
        }

        if ($panel !== []) {
            self::panelWrite($code, $panel);

            /*
             * And Pelican's own strings for this language worked out again, at
             * once. What was just merged into Pelican's files is what that pass
             * subtracts, and until it ran the string filled in beside Pelican
             * would be laid over the one just uploaded.
             */
            PelicanStrings::again($code);
        }

        /*
         * What the translator has read so far in this request is now out of
         * date, and the same request goes on to use it: the settings page
         * redraws itself, and the off-panel copy is built straight after.
         */
        try {
            app('translator')->setLoaded([]);
        } catch (Throwable) {
            // The next request reads it fresh either way.
        }

        /*
         * The two halves counted apart, because a file with none of one and all
         * of the other is a real and confusing outcome. A translation of the
         * panel strings alone installs, works, and leaves this plugin's own
         * pages in English - and "1,822 strings installed" says nothing about
         * that while "1,822 for the panel, 0 for this plugin" says all of it.
         */
        return [
            'written' => $written,
            'mine' => $mineCount,
            'panel' => $panelCount,
            'same' => $same,
            'skipped' => $skipped,
            'dropped' => $dropped,
        ];
    }

    /**
     * Long enough for the longest thing the panel says, and far short of a page
     * somebody pasted into the wrong line.
     */
    private const MAX_LENGTH = 2000;

    /**
     * What is wrong with one uploaded line, or nothing.
     *
     * The same checks Essentials Core makes of a translation before it is
     * written, and for the same reason: each of these is a line that installs
     * without complaint and then breaks the page it is drawn on.
     *
     * Named in English, like the key beside it. They are read by whoever wrote
     * the file, looking for the line, and a key is not translated either.
     */
    private static function fault(string $text, string $english): ?string
    {
        if (mb_strlen($text) > self::MAX_LENGTH) {
            return 'longer than ' . self::MAX_LENGTH . ' characters';
        }

        /*
         * Control characters out, and that includes the newline and the tab.
         *
         * A translation is one line of text. Where a sentence breaks is a
         * layout decision the page makes when it draws it, and a newline in a
         * button label is a button that is suddenly two lines tall. The rest are
         * invisible and there is no reason for any of them to be here. Unless
         * the English line has one itself, which is the page saying it wants it.
         */
        $control = '/[\x00-\x1f\x7f]/u';

        if (preg_match($control, $text) === 1 && preg_match($control, $english) !== 1) {
            return 'contains a control character or a line break';
        }

        /*
         * And the one that breaks a page rather than reading oddly. ":name has
         * :count servers" is filled in when the page is drawn: drop one and the
         * sentence comes out with a gap, invent one and a colon and a word are
         * printed exactly as they stand.
         *
         * Without regard to case, because Laravel fills :Name and :NAME from the
         * same value as :name, and a sentence that starts with one wants it.
         *
         * A colon glued to the end of a word is not a placeholder. Finnish
         * attaches case endings that way, and so do Swedish and Estonian.
         */
        $want = self::placeholders($english);
        $have = self::placeholders($text);

        foreach ($want as $name) {
            if (!in_array($name, $have, true)) {
                return 'drops :' . $name;
            }
        }

        foreach (self::placeholders($text, true) as $name) {
            if (!in_array($name, $want, true)) {
                return 'adds :' . $name;
            }
        }

        return null;
    }

    /**
     * The placeholders a line carries, lower-cased.
     *
     * Standing alone means with nothing but the start of the line or something
     * other than a letter or a digit in front of the colon, which is what tells
     * ":count" from a Finnish "tiedosto:n".
     *
     * @return array<int, string>
     */
    private static function placeholders(string $text, bool $standing = false): array
    {
        $pattern = $standing
            ? '/(?:^|[^\p{L}\p{N}]):([a-zA-Z_][a-zA-Z0-9_]*)/u'
            : '/:([a-zA-Z_][a-zA-Z0-9_]*)/u';

        preg_match_all($pattern, $text, $found);

        return array_values(array_unique(array_map('strtolower', $found[1])));
    }

    /**
     * What the panel says for one key in one language, leaving any upload for
     * this plugin's own strings out of it.
     *
     * This plugin's strings are measured against what it ships, falling back to
     * English, because the upload is what is being decided and cannot be its
     * own yardstick. The panel's are measured against what the reader sees now,
     * which is Pelican's own file with anything uploaded before already merged
     * in, the strings filled in beside it, and English under both.
     */
    private static function says(string $code, string $key, string $english): string
    {
        // One read per file rather than one per line: an upload is a few
        // thousand lines across a few dozen files.
        static $shipped = [];

        $prefix = self::prefix();

        if (!str_starts_with($key, $prefix)) {
            return self::panelSays($code, $key) ?? $english;
        }

        [$group, $rest] = array_pad(explode('.', substr($key, strlen($prefix)), 2), 2, '');

        if (!array_key_exists($code . '/' . $group, $shipped)) {
            $file = $code === Languages::BASE ? null : self::shippedFile($code, $group);
            $values = $file !== null && is_file($file) ? @include $file : [];
            $shipped[$code . '/' . $group] = is_array($values) ? $values : [];
        }

        return self::pluck($shipped[$code . '/' . $group], $rest) ?? $english;
    }

    /**
     * What the translator answers for one of the panel's own keys in one
     * language, or null when that language has nothing for it.
     *
     * Without the fallback, so English coming back is never mistaken for a
     * translation.
     */
    private static function panelSays(string $code, string $key): ?string
    {
        try {
            $line = app('translator')->get($key, [], $code, false);
        } catch (Throwable) {
            return null;
        }

        return is_string($line) && $line !== $key ? $line : null;
    }

    /** The code is not one that could name a directory. */
    public const BAD_CODE = 'bad_code';

    /** The plugin carries this language and nothing was uploaded over it. */
    public const SHIPPED = 'shipped';

    /** Nothing was ever uploaded under this name. */
    public const UNKNOWN = 'unknown';

    /** It is the language the panel currently falls back to. */
    public const IN_USE = 'in_use';

    /** The directories are there and would not go. */
    public const STUCK = 'stuck';

    /**
     * Take an uploaded language back out again, both halves of it.
     *
     * Null when it is gone, and one of the constants above when it is not.
     *
     * **Only what somebody uploaded.** One nothing was ever uploaded under is
     * refused, because what is being deleted here is a directory, and two of
     * the directories involved are not this plugin's to delete.
     *
     * **For a language this plugin carries, only the corrections.** Uploading
     * over Dutch is how a panel changes a word or two of it, and taking that
     * back is a thing somebody means. It was refused outright, while the same
     * dialog listed the language as one it could remove. The override goes and
     * nothing else does: lang/<code> inside the plugin is what comes back, and
     * it arrives with every release whatever this does.
     *
     * **The panel's half only when this plugin made it.** install() writes the
     * translated panel strings into the application's own language directory,
     * and for a locale Pelican itself ships that directory is Pelican's, full
     * of Pelican's files. Removing it would take the panel's own translation
     * with it and leave that language with nothing at all. So the test is not
     * "is there a directory" but "did this plugin make it", and for a code
     * Pelican knows the answer is no even when we have written into it.
     *
     * The order matters. Everything is decided before anything is deleted,
     * because uploaded() answers by looking at the very directory the first
     * delete takes away.
     */
    public static function remove(string $code): ?string
    {
        if (!self::code($code)) {
            return self::BAD_CODE;
        }

        $shipped = Languages::ships($code);

        if (!in_array($code, self::uploaded(), true)) {
            return $shipped ? self::SHIPPED : self::UNKNOWN;
        }

        // Without its corrections a language this plugin carries is still a
        // language, so it may go on being the one everything falls back to.
        if (!$shipped && $code === Languages::main()) {
            return self::IN_USE;
        }

        // Pelican's own is left alone; one that only exists because somebody
        // uploaded it goes with the rest.
        $ours = !$shipped && !Languages::knows($code);

        try {
            Storage::disk('local')->deleteDirectory(self::base() . '/' . $code);

            if ($ours) {
                self::panelDisk()?->deleteDirectory($code);
            }
        } catch (Throwable $exception) {
            report($exception);

            return self::STUCK;
        }

        $directory = self::path($code);

        if ($directory !== null && is_dir($directory)) {
            return self::STUCK;
        }

        return $ours && is_dir(lang_path($code)) ? self::STUCK : null;
    }

    /**
     * The codes somebody has uploaded, which are languages this plugin can
     * answer in even though it ships nothing for them.
     *
     * @return array<int, string>
     */
    public static function uploaded(): array
    {
        $codes = [];

        try {
            $disk = Storage::disk('local');

            foreach ($disk->directories(self::base()) as $directory) {
                $code = basename((string) $directory);

                // A directory with nothing in it is a language somebody started
                // and did not finish, not one this can answer in.
                if (self::code($code) && $disk->files((string) $directory) !== []) {
                    $codes[] = $code;
                }
            }

            /*
             * And a language whose panel half was written but whose plugin half
             * was not.
             *
             * An uploaded file has two halves and they land in different places,
             * so a translation of the panel strings alone creates lang/<code>
             * and leaves the override directory empty. That is a real language -
             * Pelican lists it, somebody can set their account to it - and this
             * refused to acknowledge it existed, which is how a translation that
             * installed correctly came to look like one that had not.
             *
             * Told apart from Pelican's own by name: a directory whose code this
             * class cannot name is not one Pelican ships, so it is one somebody
             * made here.
             */
            foreach ((array) glob(lang_path('*'), GLOB_ONLYDIR) as $directory) {
                $code = basename((string) $directory);

                if ($code === 'vendor' || in_array($code, $codes, true) || Languages::knows($code)) {
                    continue;
                }

                if (glob($directory . '/*.php') !== []) {
                    $codes[] = $code;
                }
            }
        } catch (Throwable) {
            return [];
        }

        return $codes;
    }

    /**
     * Hand the uploaded translations to Laravel's translator.
     *
     * Called from the service provider on every request, and whether or not
     * anything has been uploaded: a path that does not exist costs Laravel one
     * is_file() per group it misses, and creating it here would mean a panel
     * that never uploaded anything growing a directory anyway. So it waits for
     * the directory, and install() calls it again once there is one.
     */
    public static function register(): void
    {
        if (self::$registered) {
            return;
        }

        try {
            $root = Storage::disk('local')->path(self::ROOT);

            if (is_dir($root)) {
                app('translator')->addPath($root);
                self::$registered = true;
            }
        } catch (Throwable) {
            // A panel that cannot take the path reads what this plugin ships,
            // which is what it would read with nothing uploaded.
        }
    }

    /**
     * Move what an earlier release wrote to lang/vendor to where it lives now.
     *
     * Once, and then there is nothing left to move. Every file is copied before
     * anything is deleted, and a file already at the new address is kept over
     * the old one: it can only have got there after the move began. Then the
     * old directory goes, and lang/vendor with it only if nothing else is in
     * it - another package may keep its own overrides there, and those are not
     * this plugin's to take.
     *
     * Through the disks rather than PHP's own file functions, for the reason
     * written on write(): Pelican Hub refuses a plugin that names them.
     *
     * @return int how many files were moved
     */
    public static function relocate(): int
    {
        $old = 'vendor/' . Theme::id();

        if (!is_dir(lang_path($old))) {
            return 0;
        }

        $lang = self::panelDisk();

        if ($lang === null) {
            return 0;
        }

        $disk = Storage::disk('local');
        $moved = 0;

        try {
            foreach ($lang->allFiles($old) as $file) {
                $target = self::base() . substr((string) $file, strlen($old));

                if (!$disk->exists($target)) {
                    throw_if(
                        $disk->put($target, (string) $lang->get((string) $file)) === false,
                        new \RuntimeException('Could not copy ' . $file . ' out of lang/vendor.'),
                    );
                }

                $moved++;
            }

            $lang->deleteDirectory($old);

            if ($lang->allFiles('vendor') === [] && $lang->allDirectories('vendor') === []) {
                $lang->deleteDirectory('vendor');
            }
        } catch (Throwable $exception) {
            // Whatever did not move is still read from where it was, so the
            // panel is no worse off, and the next install tries again.
            report($exception);
        }

        return $moved;
    }

    /* ------------------------------------------------------------ inside --- */

    /**
     * Where this plugin's half of every upload is, on the private disk.
     *
     * Private storage rather than anywhere inside the plugin: this has to
     * outlive an update, and an update replaces the plugin folder.
     */
    private static function base(): string
    {
        return self::ROOT . '/vendor/' . Theme::id();
    }

    /**
     * One uploaded language's directory, as an absolute path, or null.
     *
     * Public because Languages counts what is in it: a language uploaded here
     * is as translated as its files say.
     */
    public static function path(string $code): ?string
    {
        try {
            /*
             * A name, not necessarily a locale.
             *
             * It was held to the shape of a locale - nl, pt_BR - which refused
             * anything else, and refusing Gaming-NL is refusing a language
             * somebody meant to make. What this actually has to guarantee is
             * narrower: the code becomes a directory name, so it may not be a
             * path or a traversal.
             *
             * A code that is not a real locale is still worth having, and worth
             * being clear about: no reader can have it on their account, because
             * Pelican validates that against ICU's own list. It can be the main
             * language, which is what everyone gets whose own cannot be used.
             */
            return self::code($code) ? Storage::disk('local')->path(self::base() . '/' . $code) : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Write this plugin's half of an upload.
     *
     * Through the panel's private disk, and that is not only about where. Every
     * write goes through a disk: mkdir, file_put_contents, unlink and rmdir are
     * all names Pelican Hub refuses, and this plugin has been turned away over
     * exactly that before.
     *
     * @param  array<string, array<string, mixed>>  $groups
     *
     * @throws \RuntimeException
     */
    private static function write(string $code, array $groups): void
    {
        throw_if(!self::code($code), new \RuntimeException('That is not a language code this can use.'));

        $disk = Storage::disk('local');

        foreach ($groups as $group => $values) {
            /*
             * var_export rather than building the PHP by hand.
             *
             * These strings are full of apostrophes and accents, and hand-rolled
             * escaping of exactly this kind has broken this plugin before - a
             * single unescaped apostrophe in a lang file took the whole panel
             * down in 2.48. var_export is the language's own answer and cannot
             * get it wrong.
             */
            $php = "<?php\n\n"
                . "/*\n"
                . " * Written by the Languages tab from an uploaded translation.\n"
                . " *\n"
                . " * Outside the plugin on purpose: an update replaces the plugin folder,\n"
                . " * and Laravel merges this over what the plugin ships, per key.\n"
                . " */\n\n"
                . 'return ' . var_export($values, true) . ";\n";

            $name = preg_replace('/[^a-z0-9_-]/', '', strtolower($group));

            throw_if(
                $name === null || $name === '',
                new \RuntimeException('A group in that file has no usable name.'),
            );

            /*
             * put() answers false for the ordinary failures - an unwritable
             * directory, a full disk - and throws only for the rarer ones, so a
             * caller watching for an exception alone would report success for
             * the common way this goes wrong. The directory is created for us.
             */
            throw_if(
                $disk->put(self::base() . '/' . $code . '/' . $name . '.php', $php) === false,
                new \RuntimeException(
                    'Could not write the ' . $group . ' file. Check that storage/app belongs to the user the panel runs as.',
                ),
            );
        }
    }

    /**
     * The prefix this plugin's own keys carry, which is how code addresses them.
     *
     * Public because the mirror has to tell the two halves of a document apart
     * before it restores one of them, and a second copy of this rule living
     * over there is a second copy that can drift.
     */
    public static function prefix(): string
    {
        return Theme::id() . '::';
    }

    /**
     * The panel's own English files, by group.
     *
     * One level of directories as well as the files at the top, because Laravel
     * addresses a file in a subdirectory as `admin/node.title` - and Pelican
     * keeps most of its strings that way.
     *
     * @return array<string, array<string, mixed>>
     */
    private static function panelGroups(): array
    {
        $groups = [];

        try {
            $root = lang_path(Languages::BASE);

            foreach ((array) glob($root . '/*.php') as $file) {
                $values = @include (string) $file;

                if (is_array($values)) {
                    $groups[basename((string) $file, '.php')] = $values;
                }
            }

            foreach ((array) glob($root . '/*', GLOB_ONLYDIR) as $directory) {
                $name = basename((string) $directory);

                foreach ((array) glob($directory . '/*.php') as $file) {
                    $values = @include (string) $file;

                    if (is_array($values)) {
                        $groups[$name . '/' . basename((string) $file, '.php')] = $values;
                    }
                }
            }
        } catch (Throwable) {
            // A panel whose own lang directory cannot be read still gets this
            // plugin's half, which is better than nothing at all.
            return [];
        }

        ksort($groups);

        return $groups;
    }

    /**
     * One group of the panel's own translation for a locale.
     *
     * @return array<string, mixed>
     */
    private static function panelRead(string $code, string $group): array
    {
        if (!self::code($code) || !self::group($group)) {
            return [];
        }

        $file = lang_path($code . '/' . $group . '.php');

        if (!is_file($file)) {
            return [];
        }

        $values = @include $file;

        return is_array($values) ? $values : [];
    }

    /**
     * Write the panel half, merged over whatever is already there.
     *
     * Merged rather than replaced, and this is the difference between the two
     * halves. Laravel merges a namespaced override per key, so the plugin half
     * can be partial and the rest falls back. It does not do that for the
     * panel's own files - lang/nl/activity.php is the file - so writing five
     * translated strings on their own would throw away the several hundred
     * Pelican already ships in that language.
     *
     * @param  array<string, array<string, mixed>>  $groups
     *
     * @throws \RuntimeException
     */
    private static function panelWrite(string $code, array $groups): void
    {
        throw_if(
            !self::code($code),
            new \RuntimeException(
                'A language code may hold letters, digits, hyphens and underscores, must start with a letter, and may be at most 32 characters.',
            ),
        );

        $disk = self::panelDisk();

        throw_if(
            $disk === null,
            new \RuntimeException('The panel could not open its own lang directory to write to.'),
        );

        foreach ($groups as $group => $values) {
            if (!self::group($group)) {
                continue;
            }

            $merged = array_replace_recursive(self::panelRead($code, $group), $values);

            $php = "<?php\n\n"
                . "/*\n"
                . " * The panel's own strings for this language, with an uploaded\n"
                . " * translation merged over them by the Languages tab.\n"
                . " *\n"
                . " * Updating Pelican replaces this file. The plugin's own half of the\n"
                . " * same upload lives outside the plugin and survives that.\n"
                . " */\n\n"
                . 'return ' . var_export($merged, true) . ";\n";

            throw_if(
                $disk->put($code . '/' . $group . '.php', $php) === false,
                new \RuntimeException(
                    'Could not write the ' . $group . ' file. The panel needs to be able to write to its lang directory.',
                ),
            );
        }
    }

    private static function panelDisk(): ?\Illuminate\Contracts\Filesystem\Filesystem
    {
        try {
            return Storage::build(['driver' => 'local', 'root' => lang_path()]);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * A usable language code, which is a directory name and nothing else.
     *
     * Letters, digits, hyphen and underscore, starting with a letter. No dots,
     * so no traversal; no slashes, so no path.
     */
    public static function code(string $code): bool
    {
        return preg_match('/^[A-Za-z][A-Za-z0-9_-]{1,31}$/D', $code) === 1;
    }

    /**
     * A group name, which may carry one directory - `admin/node`.
     *
     * Checked because it becomes a path. One level and no more: Pelican nests
     * exactly that far, and allowing deeper would allow a great deal else.
     */
    private static function group(string $group): bool
    {
        return preg_match('/^[a-z0-9_-]+(\/[a-z0-9_-]+)?$/D', $group) === 1;
    }

    /**
     * The English files, by group.
     *
     * @return array<string, array<string, mixed>>
     */
    private static function groups(): array
    {
        $groups = [];

        try {
            foreach ((array) glob(plugin_path(Theme::directory(), 'lang/' . Languages::BASE) . '/*.php') as $file) {
                $values = @include (string) $file;

                if (is_array($values)) {
                    $groups[basename((string) $file, '.php')] = $values;
                }
            }
        } catch (Throwable) {
            return [];
        }

        ksort($groups);

        return $groups;
    }

    /**
     * One group of one language as the panel reads it: what the plugin ships,
     * with anything uploaded laid over it.
     *
     * Both, merged the way Laravel merges them. Reading only the override
     * meant "start from Deutsch" handed a translator a file that was English
     * from top to bottom, while the panel beside them rendered German perfectly.
     * It was a fallback from one file to the other once, which was right while
     * an upload held every line; now that it holds only the lines that differ,
     * a fallback would hand back those few and English for the rest.
     *
     * It matters more than a download: anything that copies a language out of
     * here and puts it back would write that English into the override and
     * bury the German for good.
     *
     * @return array<string, mixed>
     */
    private static function read(string $code, string $group): array
    {
        $directory = self::path($code);

        if ($directory === null) {
            return [];
        }

        $merged = [];

        foreach ([self::shippedFile($code, $group), $directory . '/' . $group . '.php'] as $file) {
            if ($file === null || !is_file($file)) {
                continue;
            }

            $values = @include $file;

            if (is_array($values)) {
                $merged = array_replace_recursive($merged, $values);
            }
        }

        return $merged;
    }

    /** Where the plugin's own copy of a group lives, if it has one. */
    private static function shippedFile(string $code, string $group): ?string
    {
        try {
            $file = plugin_path(Theme::directory(), 'lang', $code, $group . '.php');
        } catch (Throwable) {
            return null;
        }

        return is_string($file) ? $file : null;
    }

    /**
     * @param  array<string, mixed>  $values
     * @return array<string, string>
     */
    private static function flatten(array $values, string $prefix = ''): array
    {
        $out = [];

        foreach ($values as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix . '.' . $key;

            if (is_array($value)) {
                $out += self::flatten($value, $path);

                continue;
            }

            // Only strings are translatable. A boolean or a number in a lang
            // file is a setting that happens to live there.
            if (is_string($value)) {
                $out[$path] = $value;
            }
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    private static function pluck(array $values, string $key): ?string
    {
        foreach (explode('.', $key) as $part) {
            if (!is_array($values) || !array_key_exists($part, $values)) {
                return null;
            }

            $values = $values[$part];
        }

        return is_string($values) ? $values : null;
    }

    /**
     * @param  array<string, mixed>  $target
     * @param  array<int, string>  $parts
     */
    private static function put(array &$target, array $parts, string $value): void
    {
        $key = array_shift($parts);

        if ($parts === []) {
            $target[$key] = $value;

            return;
        }

        if (!is_array($target[$key] ?? null)) {
            $target[$key] = [];
        }

        self::put($target[$key], $parts, $value);
    }
}
