/*
 * Keeps the package acceptable to Pelican Hub's submission check.
 *
 * That check refuses a plugin that appears to run processes or touch files
 * directly, and it reads for the word followed by a bracket rather than for what
 * the code does. Which is reasonable of it - a scanner that tried to understand
 * intent would be a scanner that could be talked around.
 *
 * It turned this plugin away for four things, and not one of them was a call:
 *
 *   SidebarFooter.php:125   private static function link()
 *   SystemStatus.php:589    public static function system()
 *   SystemStatus.php:17     a comment saying "nothing here depends on exec()"
 *   SystemStatus.php:618    a comment saying "nproc needs exec()"
 *
 * Two method names and two sentences explaining that the class deliberately
 * avoids the shell. The system status page reads /proc precisely so it works on
 * a host where process execution is switched off - it was turned away for
 * documenting the reason it should be allowed.
 *
 * So the rule here is simply: do not write these words followed by a bracket,
 * anywhere in the shipped files, including in comments. It costs a method name
 * and a rephrasing. Being able to publish is worth more than either.
 */
const fs = require('fs'), path = require('path');

const root = path.resolve(__dirname, '..');

/*
 * Process execution first, then the file operations a scanner is most likely to
 * object to. This plugin reaches storage through Laravel's Storage facade and
 * .env through Pelican's own writer, so none of these should ever appear.
 */
const NAMES = [
  'exec', 'shell_exec', 'system', 'passthru', 'proc_open', 'popen', 'pcntl_exec',
  'eval', 'assert', 'create_function',
  'link', 'symlink', 'unlink', 'rename', 'chmod', 'chown', 'chgrp',
  'mkdir', 'rmdir', 'fopen', 'fwrite', 'file_put_contents',
];

// The directories build.ps1 packages. Nothing outside them is submitted.
const DIRS = ['src', 'config', 'database', 'lang', 'resources'];

const files = [];
const walk = d => {
  for (const e of fs.readdirSync(d, { withFileTypes: true })) {
    const p = path.join(d, e.name);
    if (e.isDirectory()) { walk(p); continue; }
    if (/\.(php|js)$/.test(e.name)) files.push(p);
  }
};
for (const d of DIRS) {
  const p = path.join(root, d);
  if (fs.existsSync(p)) walk(p);
}

const hits = [];

for (const file of files) {
  const rel = path.relative(root, file).split(path.sep).join('/');

  fs.readFileSync(file, 'utf8').split('\n').forEach((line, i) => {
    for (const name of NAMES) {
      // A word boundary that also rules out $obj->name( and Class::name(),
      // which a scanner may or may not forgive - so this is stricter than the
      // one being satisfied, deliberately.
      if (new RegExp('(^|[^A-Za-z0-9_$])' + name + '\\s*\\(').test(line)) {
        hits.push(rel + ':' + (i + 1) + '  ' + name + '()\n    ' + line.trim().slice(0, 100));
      }
    }
  });
}

if (hits.length) {
  console.error('\nPelican Hub will refuse this package:\n');
  for (const h of hits) console.error('  ' + h);
  console.error(
    '\nRename it or rephrase it - a method called link() and a comment mentioning' +
    '\nexec() are both enough. Nothing was built.'
  );
  process.exit(1);
}

console.log('Submission check: ' + files.length + ' files, nothing a scanner would flag.');
