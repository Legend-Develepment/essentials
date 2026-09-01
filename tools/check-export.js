/*
 * Every setting the plugin can save must be a setting the plugin can export.
 *
 * The settings file carried 61 of 78 settings and neither announcement nor
 * sidebar link, for as long as it did, because the gap was structural and
 * therefore invisible: Portable asked Settings::data(), and the login screen,
 * the system status page and the two stored lists each had a persist() that
 * data() knew nothing about. Nothing was wrong with any single file. The export
 * simply had no way to reach three quarters of the settings pages.
 *
 * So this reads the pairing rather than trusting it. For every persist* method
 * in Settings.php it collects the $data['key'] reads, and checks each one is
 * reachable from what Portable::settings() puts in a file - the data methods it
 * merges, its list constants, minus the uploads it deliberately excludes.
 *
 * A new settings page fails this until it is either exported or explicitly
 * excluded. Both are one line; being silently unexportable is not an option.
 */
const fs = require('fs'), path = require('path');

const root = path.resolve(__dirname, '..');
const settings = fs.readFileSync(path.join(root, 'src/Support/Settings.php'), 'utf8');
const portable = fs.readFileSync(path.join(root, 'src/Support/Portable.php'), 'utf8');

/*
 * The slice of Settings.php belonging to one static method.
 *
 * It ends at the next function of ANY visibility, not the next public one. That
 * distinction was learned rather than designed: a private helper placed between
 * two public methods used to be swallowed into the earlier one's slice, and
 * every `'key' =>` inside it - a translation replacement, say - was counted as
 * an exported setting. Which is the wrong direction to be wrong in: it inflates
 * the covered set, so a persister reading a genuinely unexportable key would
 * have passed this check.
 */
const bodyOf = name => {
  const i = settings.indexOf('public static function ' + name);
  if (i < 0) return null;
  const next = settings.slice(i + 40).search(/\n\s*(?:public|protected|private)\s+(?:static\s+)?function\b/);
  return next < 0 ? settings.slice(i) : settings.slice(i, i + 40 + next);
};

const keysIn = (body, re) => [...new Set([...body.matchAll(re)].map(m => m[1]))];

// What settings() merges: every Settings::xData() it names, plus its own list
// constants. Read from the source so adding a group there is enough.
const settingsBody = (() => {
  const i = portable.indexOf('public static function settings');
  return portable.slice(i, portable.indexOf('public static function', i + 40));
})();

const dataMethods = [...new Set(
  [...settingsBody.matchAll(/Settings::(\w+)\(\)/g)].map(m => m[1])
)];

const listConstants = [...settingsBody.matchAll(/self::([A-Z_]+)\s*=>/g)]
  .map(m => {
    const c = new RegExp("const\\s+" + m[1] + "\\s*=\\s*'([^']+)'").exec(portable);
    return c ? c[1] : null;
  })
  .filter(Boolean);

const excluded = (() => {
  const m = /const EXCLUDED = \[([^\]]*)\]/.exec(portable);
  return m ? [...m[1].matchAll(/'([^']+)'/g)].map(x => x[1]) : [];
})();

const exported = new Set(listConstants);
for (const name of dataMethods) {
  const body = bodyOf(name);
  if (!body) {
    console.error('Portable::settings() merges Settings::' + name + '(), which does not exist.');
    process.exit(1);
  }
  for (const k of keysIn(body, /'([a-z0-9_]+)'\s*=>/g)) exported.add(k);
}
for (const k of excluded) exported.delete(k);

const persisters = [...new Set(
  [...settings.matchAll(/public static function (persist\w*)\(/g)].map(m => m[1])
)];

let problems = 0;
for (const name of persisters) {
  const reads = keysIn(bodyOf(name), /\$data\['([a-z0-9_]+)'\]/g);
  const missing = reads.filter(k => !exported.has(k) && !excluded.includes(k));

  if (missing.length) {
    problems++;
    console.error('\n' + name + '() saves settings the export cannot carry:');
    for (const k of missing) console.error('  ' + k);
  }
}

if (problems) {
  console.error(
    '\nAdd them to a data method Portable::settings() merges, or to Portable::EXCLUDED' +
    '\nif they are files rather than values. Nothing was built.'
  );
  process.exit(1);
}

console.log(
  'Export check: ' + exported.size + ' settings exported, ' +
  persisters.length + ' persisters, all covered.'
);
