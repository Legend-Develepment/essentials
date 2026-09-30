/*
 * A class this plugin names has to be a class this plugin has.
 *
 * PHP resolves both halves of this lazily: naming something that is not there
 * costs nothing until the line runs, and then it is a fatal in front of whoever
 * pressed the button. Lifting two clusters out of Settings into classes of
 * their own produced one of each in an afternoon.
 *
 * **An import of a class that does not exist.** `use
 * LegendDevelopment\Theme\Support\Api\IconPacks;` at the top of the new file -
 * a namespace that does not exist, for a class that sits one level up. Every
 * gate passed, every suite passed, the file parsed and the page drew. Saving
 * the settings said "Class ... not found".
 *
 * **A class used without coming from anywhere.** `Uploads::` with no import,
 * which in its new namespace means Support\Uploads, which is nothing. In a
 * namespaced file an unqualified name means *this* namespace - PHP falls back
 * to the global one for functions, never for classes - so that one would have
 * failed on the first picture somebody sent to a CDN.
 *
 * Only this plugin's own namespace is checked. There is no vendor directory
 * here, so Filament, Laravel and Pelican names cannot be looked up and are
 * skipped once they are imported, which is enough: the ones that go wrong are
 * the ones somebody types from memory about their own code.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');

/** Where this plugin's namespace is rooted, as composer.json declares it. */
const PREFIX = 'LegendDevelopment\\Theme\\';
const HOME = path.join(root, 'src');

/** Every file that can name a class. */
function sources(dir) {
    const out = [];

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            out.push(...sources(full));

            continue;
        }

        if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

const files = [...sources(HOME)];

const views = path.join(root, 'resources', 'views');

if (fs.existsSync(views)) {
    files.push(...sources(views));
}

/*
 * What the file at that path declares, if anything.
 *
 * Read rather than worked out from the path: PSR-4 says the two agree, and a
 * file that quietly does not is the other way this goes wrong.
 */
function declares(file) {
    if (!fs.existsSync(file)) {
        return null;
    }

    const source = fs.readFileSync(file, 'utf8');
    const space = source.match(/^namespace\s+([^;]+);/m);
    const name = source.match(/^(?:final\s+|abstract\s+)?(?:class|interface|trait|enum)\s+(\w+)/m);

    if (space === null || name === null) {
        return null;
    }

    return space[1].trim() + '\\' + name[1];
}

/*
 * The code, with the comments and the strings blanked out.
 *
 * Written the moment this gate read "see Duplicate::COPIED" in a docblock and
 * called it a fatal. Every character is replaced by a space rather than
 * removed, so a line number counted in this copy is a line number in the file.
 */
function code(source) {
    const out = source.split('');
    let i = 0;

    while (i < source.length) {
        const two = source.slice(i, i + 2);

        if (two === '/*') {
            const end = source.indexOf('*/', i + 2);
            const stop = end === -1 ? source.length : end + 2;

            for (let j = i; j < stop; j++) {
                if (out[j] !== '\n') out[j] = ' ';
            }

            i = stop;

            continue;
        }

        if (two === '//' || source[i] === '#') {
            const end = source.indexOf('\n', i);
            const stop = end === -1 ? source.length : end;

            for (let j = i; j < stop; j++) out[j] = ' ';

            i = stop;

            continue;
        }

        const quote = source[i];

        if (quote === "'" || quote === '"') {
            let j = i + 1;

            while (j < source.length) {
                if (source[j] === '\\') {
                    j += 2;

                    continue;
                }

                if (source[j] === quote) break;

                j++;
            }

            for (let k = i; k <= j && k < source.length; k++) {
                if (out[k] !== '\n') out[k] = ' ';
            }

            i = j + 1;

            continue;
        }

        i++;
    }

    return out.join('');
}

/** Where a class of this plugin's would have to live. */
function fileFor(fullName) {
    return path.join(HOME, ...fullName.slice(PREFIX.length).split('\\')) + '.php';
}

function lineOf(source, at) {
    return source.slice(0, at).split('\n').length;
}

const problems = [];
let imports = 0;
let mentions = 0;
let caught = 0;

for (const file of files) {
    const source = fs.readFileSync(file, 'utf8');
    const where = path.relative(root, file);

    // ---- what the file imports -----------------------------------------
    const imported = new Set();

    for (const match of source.matchAll(/^\s*use\s+([^;\s(]+)\s*(?:as\s+(\w+)\s*)?;/gm)) {
        const named = match[1];
        const alias = match[2] ?? named.split('\\').pop();

        imported.add(alias);

        if (!named.startsWith('LegendDevelopment\\')) {
            continue;
        }

        imports += 1;

        if (!named.startsWith(PREFIX)) {
            problems.push(
                `${where}:${lineOf(source, match.index)}  ${named}\n` +
                    "      is not in this plugin's namespace at all.",
            );

            continue;
        }

        const expected = fileFor(named);
        const found = declares(expected);

        if (found === null) {
            problems.push(
                `${where}:${lineOf(source, match.index)}  ${named}\n` +
                    `      There is no class there. It would be ${path.relative(root, expected)}.`,
            );

            continue;
        }

        if (found !== named) {
            problems.push(
                `${where}:${lineOf(source, match.index)}  ${named}\n` +
                    `      ${path.relative(root, expected)} declares ${found} instead.`,
            );
        }
    }

    // ---- and what it names without importing ---------------------------
    const space = source.match(/^namespace\s+([^;]+);/m);

    // A file with no namespace of its own resolves everything globally, which
    // is a different question from this one.
    if (space === null) {
        continue;
    }

    const here = space[1].trim();

    if (!here.startsWith(PREFIX)) {
        continue;
    }

    const inside = here.slice(PREFIX.length).split('\\').filter(Boolean);
    const seen = new Set();

    // ---- and what it imports over the top of a neighbour ----------------
    /*
     * An import wins over the namespace a file is in, silently.
     *
     * Settings sits in Support and wrote Login:: for Support\Login, unqualified,
     * because a file does not import its own neighbours. Then the settings forms
     * moved to Support\Fields and Settings imported Fields\Login - and all five
     * of those unqualified calls started meaning the new class, which has none
     * of those methods. Both names resolve and the file parses, so php -l is
     * happy and so are the two checks above; the panel finds out when somebody
     * opens the login screen settings.
     *
     * So the rule is about the name and not about the use: if this namespace
     * already has a class called X, an import that arrives calling itself X
     * does not belong in the file. Write the other one out in full, or alias
     * it to a name nothing here already answers to.
     *
     * An explicit `as X` is left alone, because that is somebody choosing the
     * name rather than inheriting it from a path. Two files do it on purpose -
     * MyServers and MyStatus each alias something to Store while a Store page
     * sits beside them - and both read consistently throughout. The accident
     * this catches is the other one: a name that came along with the class and
     * landed on a neighbour nobody was thinking about.
     */
    for (const match of source.matchAll(/^\s*use\s+([^;\s(]+)\s*;/gm)) {
        const named = match[1];
        const short = named.split('\\').pop();

        if (named === here + '\\' + short) {
            continue;
        }

        if (declares(path.join(HOME, ...inside, short + '.php')) !== here + '\\' + short) {
            continue;
        }

        problems.push(
            `${where}:${lineOf(source, match.index)}  imports ${short}, and ${here} already has one.\n` +
                `      Every unqualified ${short}:: in this file now means ${named},\n` +
                '      which parses, resolves, and is a different class. Alias the import.',
        );
    }

    /*
     * Foo:: at the start of a name, and not $this->Foo:: or \Foo:: or a second
     * segment of something already qualified. self, static and parent are the
     * language's own and are not classes to look up.
     */
    for (const match of code(source).matchAll(/(^|[^\w$\\>:-])([A-Z]\w*)::/g)) {
        const name = match[2];

        if (seen.has(name) || imported.has(name)) {
            continue;
        }

        seen.add(name);
        mentions += 1;

        const beside = path.join(HOME, ...inside, name + '.php');

        if (declares(beside) === here + '\\' + name) {
            continue;
        }

        problems.push(
            `${where}:${lineOf(source, match.index)}  ${name}::\n` +
                `      Not imported, and there is no ${name} in ${here}.\n` +
                '      An unqualified name means this namespace, so it is a fatal when the line runs.',
        );
    }

    // ---- and the name in a catch, which fails the other way round -------
    /*
     * `catch (Throwable)` in a namespaced file with no `use Throwable;` means
     * `catch (This\Namespace\Throwable)`, and that class does not exist. PHP
     * does not complain. It simply never matches, so the block is dead and
     * whatever it was written to swallow goes straight past it.
     *
     * Eight of these were live in this tree at once, and their comments say
     * exactly what they were for: "the upload as bytes, or nothing at all
     * rather than an exception", and a modulesUrl() whose whole job was to
     * answer null rather than offer a link to nowhere. Both threw instead.
     *
     * It is the opposite failure from the Foo:: rule above. There, a name that
     * does not exist is a fatal the first time the line runs, which is loud.
     * Here it is silence: the panel behaves as though the guard was never
     * written, and the only sign is an error that should have been handled.
     */
    for (const match of code(source).matchAll(/catch\s*\(\s*([A-Z]\w*)\s*(?:\$\w+\s*)?\)/g)) {
        const name = match[1];

        caught += 1;

        if (imported.has(name)) {
            continue;
        }

        if (declares(path.join(HOME, ...inside, name + '.php')) === here + '\\' + name) {
            continue;
        }

        problems.push(
            `${where}:${lineOf(source, match.index)}  catch (${name})\n` +
                `      Not imported, and there is no ${name} in ${here}, so this catches nothing.\n` +
                '      PHP does not complain: the block is simply never entered.',
        );
    }
}

if (problems.length > 0) {
    console.error(`Use check: ${problems.length} name(s) with no class behind them.\n`);

    for (const line of problems) {
        console.error('  ' + line);
    }

    console.error('\nPHP only finds this out when the line runs, which is in front of somebody.');
    process.exit(1);
}

console.log(
    `Use check: ${imports} import(s) of this plugin's own classes, ` +
        `${mentions} name(s) used without one and ${caught} catch clause(s), ` +
        'every one of them real.',
);
