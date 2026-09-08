/*
 * One panel may not ask another panel for its address while the panels are
 * still being built.
 *
 * Filament::getPanel('app')->getUrl() resolves a route. During plugin boot that
 * route does not exist yet, and the panel a customer is inside boots before the
 * one the address belongs to. Written inside a closure it is resolved when the
 * menu is drawn, which is long after every route is registered and is fine.
 * Written as a plain statement it throws on every request, and a plugin that
 * throws in boot is a five hundred on every page of the panel - the sidebar,
 * the dashboard, the console, all of it.
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
console.error('Each of these runs while the panels are still booting, when the route');
console.error('it needs has not been registered. Move the call inside the closure that');
console.error('uses it - ->url(fn (): string => ...) - so it is resolved when the menu');
console.error('is drawn instead. A plugin that throws in boot is a 500 on every page.');

process.exit(1);
