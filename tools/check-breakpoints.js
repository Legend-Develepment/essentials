/*
 * Keeps the responsive boundaries from overlapping each other.
 *
 * The stylesheet had written the same boundary three ways - 639px, 640px and
 * 40rem - and one pair met in the middle: `max-width: 640px` and
 * `min-width: 40rem` both apply at exactly 640 pixels, so a window at that
 * width got the phone layout and the tablet layout at once. Whichever came last
 * in the file won, which is not a decision anybody made.
 *
 * The rule is simply that no boundary may be claimed from both sides. A
 * max-width should stop just under the min-width that takes over: 39.999rem and
 * 40rem, not 40rem and 40rem.
 *
 * This says nothing about how many breakpoints there should be or where. It
 * only checks that the ones chosen do not contradict each other, which is the
 * part that cannot be seen by looking at any single rule.
 */
const fs = require('fs'), path = require('path');

const file = path.resolve(__dirname, '..', 'resources/css/theme.css');
const css = fs.readFileSync(file, 'utf8').replace(/\/\*[\s\S]*?\*\//g, '');

const toPx = (value, unit) => (unit === 'rem' ? parseFloat(value) * 16 : parseFloat(value));

const mins = new Map();
const maxes = new Map();

let line = 1;
for (const part of css.split('\n')) {
  if (part.includes('@media')) {
    for (const m of part.matchAll(/(min|max)-width:\s*([\d.]+)(px|rem)/g)) {
      const px = toPx(m[2], m[3]);
      const into = m[1] === 'min' ? mins : maxes;
      if (!into.has(px)) into.set(px, []);
      into.get(px).push(line + ': ' + part.trim().slice(0, 70));
    }
  }
  line++;
}

const clashes = [...mins.keys()].filter(px => maxes.has(px)).sort((a, b) => a - b);

if (clashes.length) {
  console.error('\nBreakpoints claimed from both sides:\n');

  for (const px of clashes) {
    console.error('  ' + px + 'px is both a min-width and a max-width:');
    for (const where of [...mins.get(px), ...maxes.get(px)]) console.error('    ' + where);
    console.error('');
  }

  console.error(
    'At that exact width both rules apply and source order decides, which is not' +
    '\na decision anybody made. End the lower range just under the upper one.' +
    '\nNothing was built.'
  );
  process.exit(1);
}

const count = new Set([...mins.keys(), ...maxes.keys()]).size;
console.log('Breakpoint check: ' + count + ' boundaries, none claimed from both sides.');
