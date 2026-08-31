/*
 * Refuses to let a PHP file that will not parse leave this repository.
 *
 * 2.47.3 shipped `'System - follow the visitor's own setting'` in
 * lang/en/settings.php. The apostrophe closed the string, everything after it
 * was read as code, and the file stopped parsing - which took down every page
 * of the panel that rendered the sidebar, and made installing the plugin fail.
 * It reached DEV, beta and main before anyone saw it, because there is no PHP
 * on the machine this is built on and `php -l` was never an option.
 *
 * So this is a character-state scanner rather than a parser: it walks code,
 * '...', "...", //, #, block comments and heredocs, and reports a single-quoted
 * string whose closing quote is followed by a bare word - which is what an
 * unescaped apostrophe always looks like. It is not a substitute for php -l;
 * it catches the one mistake that is easy to make in a file full of English
 * prose and impossible to see by reading.
 *
 * Blade templates are skipped: {{ }} and {{-- --}} are not PHP, and they are
 * full of apostrophes this would call errors.
 */
const fs = require('fs'), path = require('path');

const root = path.resolve(__dirname, '..');
const dirs = ['src', 'config', 'database', 'lang'];

const files = [];
const walk = d => {
  for (const e of fs.readdirSync(d, { withFileTypes: true })) {
    const p = path.join(d, e.name);
    if (e.isDirectory()) { walk(p); continue; }
    if (/\.php$/.test(e.name) && !/\.blade\.php$/.test(e.name)) files.push(p);
  }
};
for (const d of dirs) {
  const p = path.join(root, d);
  if (fs.existsSync(p)) walk(p);
}

const lineOf = (s, i) => s.slice(0, i).split('\n').length;
const closers = { '}': '{', ')': '(', ']': '[' };
let problems = 0;

for (const f of files) {
  const s = fs.readFileSync(f, 'utf8');
  const rel = path.relative(root, f).split(path.sep).join('/');
  const depth = { '{': 0, '(': 0, '[': 0 };
  const issues = [];
  let i = 0;

  while (i < s.length) {
    const c = s[i];

    if (c === '/' && s[i + 1] === '/') { i = s.indexOf('\n', i); if (i < 0) break; continue; }
    if (c === '#' && s[i + 1] !== '[') { i = s.indexOf('\n', i); if (i < 0) break; continue; }
    if (c === '/' && s[i + 1] === '*') { const e = s.indexOf('*/', i + 2); i = e < 0 ? s.length : e + 2; continue; }

    const here = /^<<<\s*(['"]?)([A-Za-z_]\w*)\1\r?\n/.exec(s.slice(i, i + 80));
    if (here) {
      const rest = s.slice(i + here[0].length);
      const m = new RegExp('^\\s*' + here[2] + '\\b', 'm').exec(rest);
      i = m ? i + here[0].length + m.index + m[0].length : s.length;
      continue;
    }

    if (c === "'") {
      let j = i + 1;
      while (j < s.length) {
        if (s[j] === '\\' && (s[j + 1] === '\\' || s[j + 1] === "'")) { j += 2; continue; }
        if (s[j] === "'") break;
        j++;
      }
      if (/^\s*[A-Za-z_]/.test(s.slice(j + 1))) {
        issues.push(lineOf(s, i) + ': ' + s.slice(i, j + 1).split('\n')[0].slice(0, 90));
      }
      i = j + 1;
      continue;
    }

    if (c === '"') {
      let j = i + 1;
      while (j < s.length) {
        if (s[j] === '\\') { j += 2; continue; }
        if (s[j] === '"') break;
        j++;
      }
      i = j + 1;
      continue;
    }

    if (c === '{' || c === '(' || c === '[') depth[c]++;
    else if (closers[c]) depth[closers[c]]--;
    i++;
  }

  const unbalanced = Object.entries(depth).filter(([, n]) => n !== 0);
  if (issues.length || unbalanced.length) {
    problems++;
    console.error('\n' + rel);
    for (const line of issues) console.error('  string closes early at line ' + line);
    for (const [b, n] of unbalanced) console.error('  unbalanced ' + b + ' by ' + n);
  }
}

if (problems > 0) {
  console.error('\n' + problems + ' file(s) will not parse. Nothing was built.');
  process.exit(1);
}

console.log('PHP check: ' + files.length + ' files, all parse.');
