/*
 * Every field on a form must be a field the save stores.
 *
 * A package could be given a port range for a whole release and never keep one.
 * The form had the two inputs, the model had them fillable, the table had the
 * columns, and `Packages::sanitise()` - which is an allowlist that builds a
 * fresh array rather than filtering the one it is handed - did not mention
 * them. So the page saved, said "Saved", and stored nothing. Nothing was wrong
 * with any single file; the pairing was simply never checked.
 *
 * That is the shape this catches. Three pages hand their form data to a
 * sanitise() before writing it, and for each one this reads the field names out
 * of the form and the keys the sanitiser hands back, and says so when a field
 * is not in the second list.
 *
 * Not to be confused with check-persist.js, which guards the other half of the
 * same idea: that a settings writer is handed what is already stored before it
 * writes. That one is about a save that writes too much; this one is about a
 * save that writes too little.
 *
 * An allowlist would defeat the point, so the exceptions are named one by one
 * below with why. A new field fails this until it is either saved or listed.
 */
const fs = require('fs'), path = require('path');

const root = path.resolve(__dirname, '..');

/*
 * The form components that carry a value.
 *
 * Named rather than derived, because the ones that do not - Placeholder,
 * Section, Grid - are exactly the ones that would silently widen the check into
 * nonsense if they were counted, and there is no way to tell which is which
 * from the call alone.
 */
const HOLDS = [
  'TextInput', 'Textarea', 'Select', 'Toggle', 'Checkbox', 'CheckboxList',
  'Radio', 'ToggleButtons', 'KeyValue', 'TagsInput', 'Repeater', 'Builder',
  'RichEditor', 'MarkdownEditor', 'FileUpload', 'ColorPicker', 'Hidden',
  'DatePicker', 'DateTimePicker', 'TimePicker', 'Slider',
];

/*
 * Each page, the sanitiser it hands its form to, and what that sanitiser is
 * allowed not to store.
 */
const PAGES = [
  {
    page: 'src/Filament/Admin/Pages/ShopPackages.php',
    persister: 'src/Support/Shop/Packages.php',
    method: 'sanitise',
    // The row's own id, which the edit form carries so the upgrade list can
    // leave the package out of its own options. It is the key of the row being
    // written, not a column on it.
    //
    // And the artwork library picker, which stores nothing of its own on
    // purpose: picking a logo writes its address into art_url, which is saved,
    // and the picker itself is not dehydrated.
    allowed: ['id', 'art_library'],
  },
  {
    page: 'src/Filament/Admin/Pages/ShopAddons.php',
    persister: 'src/Filament/Admin/Pages/ShopAddons.php',
    method: 'sanitise',
    allowed: ['id'],
  },
  {
    page: 'src/Filament/Admin/Pages/ShopCoupons.php',
    persister: 'src/Filament/Admin/Pages/ShopCoupons.php',
    method: 'sanitise',
    allowed: ['id'],
  },
];

/*
 * The body of one method, ending at the next function of any visibility.
 *
 * The same rule check-export.js arrived at, and for the same reason: a private
 * helper sitting between two methods would otherwise be read as part of the one
 * above it, and every key inside it counted as saved.
 */
const bodyOf = (source, method) => {
  const i = source.search(new RegExp('(?:public|private|protected)\\s+static\\s+function\\s+' + method + '\\b'));
  if (i < 0) return null;
  const next = source.slice(i + 40).search(/\n\s*(?:public|protected|private)\s+(?:static\s+)?function\b/);
  return next < 0 ? source.slice(i) : source.slice(i, i + 40 + next);
};

/*
 * The strings in `Foo::BAR`, wherever Foo.php is.
 *
 * Resolved by file name rather than by parsing a use statement, because every
 * class in this plugin lives at the path its name says and a constant that
 * cannot be found is reported rather than assumed empty.
 */
const constant = (className, name) => {
  const found = [];

  const walk = dir => {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
      const full = path.join(dir, entry.name);
      if (entry.isDirectory()) walk(full);
      else if (entry.name === className + '.php') found.push(full);
    }
  };

  walk(path.join(root, 'src'));

  if (found.length === 0) return null;

  const source = fs.readFileSync(found[0], 'utf8');
  const m = new RegExp('const\\s+' + name + '\\s*=\\s*\\[([^\\]]*)\\]').exec(source);

  return m === null ? null : [...m[1].matchAll(/'([^']+)'/g)].map(x => x[1]);
};

/** Every field name a `foreach (Foo::BAR as $x)` in this body writes under $x. */
const namesLoopedOver = body => {
  const out = [];

  for (const m of body.matchAll(/foreach\s*\(\s*(\w+)::([A-Z_]+)\s+as\s+\$(\w+)\s*\)/g)) {
    if (!new RegExp('\\$\\w+\\[\\s*\\$' + m[3] + '\\s*\\]\\s*=').test(body)) continue;

    const names = constant(m[1], m[2]);

    if (names === null) {
      console.log('  ' + m[1] + '::' + m[2] + ' is looped over and cannot be read');
      continue;
    }

    out.push(...names);
  }

  return out;
};

let problems = 0;
let fields = 0;

for (const entry of PAGES) {
  const page = fs.readFileSync(path.join(root, entry.page), 'utf8');
  const persister = entry.persister === entry.page
    ? page
    : fs.readFileSync(path.join(root, entry.persister), 'utf8');

  const body = bodyOf(persister, entry.method);

  if (body === null) {
    console.log('  ' + entry.persister + ' has no ' + entry.method + '()');
    problems++;
    continue;
  }

  /*
   * What comes OUT, not what goes in.
   *
   * Reading $data['port_from'] is not storing it, and the bug this exists for
   * would have walked straight past a check that counted reads: half a fix -
   * the value read into a variable and the variable never returned - looks
   * exactly like a whole one from the input side.
   */
  const saved = new Set([
    ...[...body.matchAll(/'([^']+)'\s*=>/g)].map(m => m[1]),
    // And the names a loop writes rather than spells. An extra stores its seven
    // limits with one `foreach (Addon::LIMITS as $limit)` over `$out[$limit]`,
    // which is the same saving done better, and a check that could not see
    // through it would report seven fields as lost every time it ran.
    ...namesLoopedOver(body),
  ]);

  const seen = new Set();

  for (const m of page.matchAll(new RegExp('\\b(' + HOLDS.join('|') + ')::make\\(\\s*\'([^\']+)\'', 'g'))) {
    const name = m[2];

    if (seen.has(name)) continue;
    seen.add(name);
    fields++;

    if (saved.has(name) || entry.allowed.includes(name)) continue;

    const line = page.slice(0, m.index).split('\n').length;

    console.log('  ' + entry.page + ':' + line + ' has ' + m[1] + " '" + name
      + "' and " + entry.method + '() never stores it');
    problems++;
  }
}

if (problems > 0) {
  console.log('Field check: ' + problems + ' field(s) a form collects and nothing stores.');
  process.exit(1);
}

console.log('Field check: ' + fields + ' field(s) across ' + PAGES.length
  + ' form(s), every one of them stored by the save.');
