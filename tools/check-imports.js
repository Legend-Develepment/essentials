/*
 * An import with its namespace missing.
 *
 * `use Illuminate\Contracts\Support\Htmlable;` becomes
 * `use IlluminateContractsSupportHtmlable;` the moment something eats the
 * backslashes - sed and shell heredocs both do, repeatedly - and the result is
 * still perfectly valid PHP. It parses. It lints. It fails at the moment that
 * class is actually needed, which may be on one page nobody has opened yet.
 *
 * That is exactly how it got in: an import added by sed, a lint that said all
 * 176 files parse, and a page that would have thrown the first time somebody
 * loaded the sidebar. lint-php.js cannot catch it, because there is nothing
 * wrong with the syntax.
 *
 * So a single-word import is checked against the classes that genuinely live in
 * the global namespace. Anything else with capitals running together is a
 * squashed path rather than a class name.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

/*
 * The ones a file may legitimately import without a namespace. Short on
 * purpose: adding to it should be a decision, and a name that belongs here is
 * always one somebody can point at in the PHP manual.
 */
const GLOBAL_CLASSES = new Set([
    'Throwable', 'Exception', 'Error', 'TypeError', 'ValueError', 'ArgumentCountError',
    'RuntimeException', 'LogicException', 'InvalidArgumentException', 'JsonException',
    'BackedEnum', 'UnitEnum', 'Stringable', 'Countable', 'ArrayAccess', 'Traversable',
    'IteratorAggregate', 'Iterator', 'ArrayIterator', 'JsonSerializable', 'Closure',
    'Generator', 'DateTime', 'DateTimeImmutable', 'DateTimeInterface', 'DateInterval',
    'DateTimeZone', 'ZipArchive', 'SplFileInfo', 'SplObjectStorage', 'ArrayObject',
    'ReflectionClass', 'ReflectionMethod', 'WeakMap',
]);

const DIRS = ['src', 'config', 'database', 'lang', 'resources'];

function walk(dir, out = []) {
    if (!fs.existsSync(dir)) {
        return out;
    }

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
        } else if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

const files = DIRS.flatMap((dir) => walk(path.join(root, dir)));
const mangled = [];
let imports = 0;

for (const file of files) {
    const rel = path.relative(root, file).split(path.sep).join('/');
    const source = fs.readFileSync(file, 'utf8');

    // Only a top-level `use` statement. A `use` inside a closure captures
    // variables and is a different thing entirely.
    const pattern = /^use\s+([A-Za-z_\\][A-Za-z0-9_\\]*)\s*(?:as\s+[A-Za-z_][A-Za-z0-9_]*\s*)?;/gm;

    let match;

    while ((match = pattern.exec(source)) !== null) {
        imports += 1;

        const name = match[1];

        if (name.includes('\\') || GLOBAL_CLASSES.has(name)) {
            continue;
        }

        /*
         * Two capitals with lowercase between them, in a name with no
         * separators. `Htmlable` passes; `IlluminateContractsSupportHtmlable`
         * does not. A real global class this rejects can be added to the list
         * above, which is a deliberate act rather than a silent pass.
         */
        if (/[A-Z][a-z0-9]+[A-Z]/.test(name)) {
            mangled.push(rel + ':' + source.slice(0, match.index).split('\n').length + '  use ' + name + ';');
        }
    }
}

if (mangled.length > 0) {
    console.error('Import check: ' + mangled.length + ' import(s) with the namespace missing.\n');

    for (const entry of mangled) {
        console.error('  ' + entry);
    }

    console.error('\nThese are valid PHP and fail later, where the class is used - usually');
    console.error('because a tool ate the backslashes. If one is a real global class, add it');
    console.error('to GLOBAL_CLASSES in tools/check-imports.js.');
    process.exit(1);
}

console.log('Import check: ' + imports + ' imports, every one of them namespaced.');
