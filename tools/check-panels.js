/*
 * One panel may not ask another panel for its address while the panels are
 * still being built.
 *
 * A plugin's register() is called from inside the panel provider that is still
 * building the panel, so Filament does not know that panel yet and
 * Filament::getPanel('app') is null. Reading an address off it there is
 *
 *   Call to a member function getUrl() on null
 *
 * on every request - the sidebar, the dashboard, the console, all of it, from
 * one line that only ever wanted a link in a menu. Written inside a closure the
 * same call runs when the menu is drawn, by which time every panel is
 * registered, which is why the rows around it have always worked.
 *
 * That shipped once. It is the worst kind of bug this plugin can have, because
 * nothing in the panel still works well enough to switch the plugin off, so it
 * is worth a gate of its own.
 *
 * Only ThemePlugin is checked, and that is the whole point of the rule rather
 * than a shortcut: it is the one file whose body runs while Filament is putting
 * the panels together. The same call in Support\Quick or Support\FullPreview
 * happens when somebody clicks something, by which time every route exists.
 *
 * Inside that file the rule is blunt: the call has to sit on a line that also
 * opens a closure. All four uses there already read that way.
 */
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');
const CALL = 'Filament::getPanel(';

// A closure opens on the same line: an arrow function or a plain one.
const LAZY = /\bfn\s*\(|\bfunction\s*\(|\bstatic\s+fn\s*\(|\bstatic\s+function\s*\(/;

const files = [path.join(ROOT, 'src/ThemePlugin.php')].filter((f) => fs.existsSync(f));
const eager = [];
let seen = 0;

for (const file of files) {
    const lines = fs.readFileSync(file, 'utf8').split(/\r?\n/);

    lines.forEach((line, index) => {
        if (!line.includes(CALL)) {
            return;
        }

        // A comment naming the call is not the call. This file's own reason for
        // existing is written above one, and a gate that fails on the sentence
        // explaining it is a gate somebody switches off.
        const trimmed = line.trim();

        if (trimmed.startsWith('*') || trimmed.startsWith('//') || trimmed.startsWith('/*')) {
            return;
        }

        seen++;

        if (LAZY.test(line)) {
            return;
        }

        eager.push(path.relative(ROOT, file) + ':' + (index + 1) + '  ' + line.trim());
    });
}

if (eager.length === 0) {
    console.log('Panel check: ' + seen + " cross-panel address(es), none resolved before the routes exist.");
    process.exit(0);
}

console.error('Panel check: ' + eager.length + ' cross-panel address(es) resolved too early.');
console.error('');

for (const line of eager) {
    console.error('  ' + line);
}

console.error('');
console.error('Each of these runs while Filament is still building the panel, where');
console.error("getPanel() is null - so this is \"Call to a member function getUrl() on");
console.error('null\" on every page of the panel, not a broken link in one menu. Move');
console.error('the call inside the closure that uses it - ->url(fn (): string => ...) -');
console.error('so it is read when the menu is drawn and every panel is registered.');

process.exit(1);
