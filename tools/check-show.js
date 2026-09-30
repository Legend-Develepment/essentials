/*
 * A SHOW statement may not carry a placeholder.
 *
 * `SHOW COLUMNS FROM x LIKE ?` cannot be prepared. MariaDB answers
 *
 *     SQLSTATE[42000]: Syntax error ... check the manual ... near '?' at line 1
 *
 * which is thrown, not returned - so on a panel whose schema repair wraps its
 * work in one try, as this plugin's does, every statement after that line is
 * skipped and nothing is said. A column widened in one release was still the old
 * width four releases later, on a panel that had installed every one of them.
 *
 * The fault is invisible three ways over: it is a runtime error rather than a
 * parse error, so no linter sees it; it only happens on MariaDB, which is what
 * Pelican installs and not always what a developer runs; and it is swallowed by
 * a catch that is there for good reasons of its own.
 *
 * So: read the schema through information_schema, which is an ordinary table
 * where a binding is a binding.
 *
 *     SELECT COLUMN_TYPE FROM information_schema.columns
 *      WHERE table_schema = DATABASE() AND table_name = ? AND column_name = ?
 *
 * `SHOW INDEX FROM x WHERE Key_name = ?` is the one shape that does prepare, and
 * it is allowed: WHERE is a real clause on a real result set. LIKE in a SHOW is
 * not.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

/** A single backslash, named so the namespace in the message below survives. */
const BS = String.fromCharCode(92);

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

/** PHP with its comments blanked, so a shape written out in a docblock is prose. */
function code(source) {
    return source
        .replace(/\/\*[\s\S]*?\*\//g, (match) => match.replace(/[^\n]/g, ' '))
        .replace(/\/\/[^\n]*/g, (match) => ' '.repeat(match.length));
}

const problems = [];
let statements = 0;

for (const file of walk(path.join(root, 'src'))) {
    const where = path.relative(root, file).split(path.sep).join('/');
    const lines = code(fs.readFileSync(file, 'utf8')).split('\n');

    lines.forEach((line, index) => {
        if (!/\bSHOW\s+[A-Z]/.test(line)) {
            return;
        }

        statements += 1;

        // WHERE binds. LIKE does not, and neither does a placeholder anywhere
        // else in the statement itself.
        if (/\bLIKE\s*'?\s*\?/.test(line) || /\bSHOW\s+[A-Z][^']*\?/.test(line)) {
            problems.push(
                `${where}:${index + 1}  a placeholder inside a SHOW` +
                    '\n      ' + line.trim().slice(0, 120) +
                    '\n      MariaDB cannot prepare this. Read information_schema instead.',
            );
        }
    });
}

if (problems.length > 0) {
    console.error(`Show check: ${problems.length} SHOW statement(s) that will throw on MariaDB.\n`);

    for (const one of problems) {
        console.error('  ' + one);
    }

    console.error(
        '\nSee Support' + BS + 'Shop' + BS + 'Tables::column(), which is what these should go through.',
    );

    process.exit(1);
}

console.log(`Show check: ${statements} SHOW statement(s), none of them holding a placeholder that will not prepare.`);
