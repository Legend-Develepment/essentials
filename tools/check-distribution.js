/*
 * This plugin is distributed and updated through Pelican Hub, and through
 * nothing else.
 *
 * Pelican Hub reviews every version before a panel can install it. Up to
 * 3.225 this plugin fetched its own releases - stable and beta from this
 * repository on GitHub, dev from a private one with a token - and installed
 * them itself, which put code on panels that never went through that review.
 * The Hub rejected it for that. Updates are Pelican's own now: plugin.json
 * names the Hub's feed, and Pelican installs what the Hub approved under
 * Admin, Plugins.
 *
 * So this fails the build when:
 *
 *  - plugin.json's update_url is anything but this plugin's feed on the Hub;
 *  - the repository carries a release archive or an update feed of its own;
 *  - a shipped file downloads, installs or replaces a plugin: Pelican's
 *    importer, installer and install commands, an archive extracted whole or
 *    opened as a Phar, a download written straight to a file, a tool run to
 *    fetch or unpack code, or a GitHub address a release could be fetched from.
 *
 * Calls and addresses rather than every possible spelling: it catches the
 * usual ways back in, and review is still what keeps the rest out.
 *
 * An uploaded icon pack is read entry by entry and only its SVG files are
 * kept (Support\IconPacks); that is data somebody chose to add, and it is not
 * what this is about.
 *
 * Break it by setting update_url to a GitHub address, or by writing
 * `$service->downloadPluginFromUrl($url);` in any file under src/.
 *
 *     node tools/check-distribution.js
 */
const fs = require('fs');
const path = require('path');
const { execFileSync } = require('child_process');

const root = path.resolve(__dirname, '..');
const problems = [];

const manifest = JSON.parse(fs.readFileSync(path.join(root, 'plugin.json'), 'utf8'));

// Pelican lowercases the id, and so does the Hub's address for it.
const feed = `https://hub.pelican.dev/plugins/${String(manifest.id).toLowerCase()}/update.json`;

if (manifest.update_url !== feed) {
    problems.push(`plugin.json update_url is ${JSON.stringify(manifest.update_url ?? null)}; it has to be ${feed}`);
}

const tracked = execFileSync('git', ['ls-files', '-z'], { cwd: root, encoding: 'utf8' })
    .split('\0')
    .filter((file) => file !== '');

for (const file of tracked) {
    if (file.startsWith('release/') || /\.zip$/i.test(file) || /(^|\/)update(-[a-z]+)?\.json$/i.test(file)) {
        problems.push(`${file} is a release archive or an update feed, and a release only ever comes from the Hub`);
    }

    if (file.startsWith('.github/workflows/') && /release|publish|deploy/i.test(fs.existsSync(path.join(root, file)) ? fs.readFileSync(path.join(root, file), 'utf8') : '')) {
        problems.push(`${file} looks like a workflow that publishes a build; releases go to Pelican Hub only`);
    }
}

/**
 * What a shipped file may not do, each with the reason it says.
 *
 * Calls rather than names, so a comment that explains how Pelican installs a
 * plugin is still allowed to say so.
 */
const FORBIDDEN = [
    [/->\s*downloadPluginFrom(File|Url)\s*\(/, 'hands an archive to Pelican\'s importer'],
    [/->\s*(installPlugin|updatePlugin)\s*\(/, 'installs or updates a plugin itself'],
    [/->\s*(runPluginMigrations|runPluginSeeder|manageComposerPackages|buildAssets)\s*\(/, 'runs a step of Pelican\'s installer itself'],
    [/['"`]p:plugin:(install|update|composer|import)\b/, 'calls Pelican\'s plugin install commands'],
    [/->\s*extractTo\s*\(/, 'extracts an archive whole'],
    [/new\s+\\?PharData\b/, 'opens an archive'],
    [/(::|->)\s*sink\s*\(|['"]sink['"]\s*=>/, 'downloads straight to a file'],
    // A process started with one of these as its command. Documentation that
    // shows somebody a curl line is not a process, so the call is what counts.
    [/(Process::\w+|->\s*(run|start)|\b(proc_open|shell_exec|exec|system|passthru|popen))\s*\(\s*\[?\s*['"]\s*(unzip|tar|curl|wget|composer|git)\b/, 'runs a tool that fetches or unpacks code'],
    [/raw\.githubusercontent\.com|objects\.githubusercontent\.com|codeload\.github\.com|api\.github\.com|cdn\.jsdelivr\.net\/gh\/|\/releases\/download\/|github\.com\/[^\s'"]+\/(archive|zipball|tarball)\//, 'names a GitHub address a release could be fetched from'],
];

// What build.ps1 and build.sh put in the archive.
const SHIPPED = ['plugin.json', 'README.md', 'src/', 'config/', 'database/', 'lang/', 'resources/'];
const shipped = tracked.filter((file) => SHIPPED.some((prefix) => file === prefix || file.startsWith(prefix))
    && /\.(php|js|json|css|md)$/.test(file) && fs.existsSync(path.join(root, file)));

for (const file of shipped) {
    const source = fs.readFileSync(path.join(root, file), 'utf8');

    for (const [pattern, why] of FORBIDDEN) {
        const match = source.match(pattern);

        if (match !== null) {
            const line = source.slice(0, match.index).split('\n').length;

            problems.push(`${file}:${line}  ${why}: ${match[0]}`);
        }
    }
}

if (problems.length > 0) {
    console.error(`Distribution check: ${problems.length} problem(s).\n`);
    problems.forEach((problem) => console.error('  ' + problem));
    console.error('\nThis plugin is installed and updated through Pelican Hub only. Nothing here may fetch or install plugin code.');
    process.exit(1);
}

console.log(`Distribution check: update_url is the Hub feed, no release archive, feed or publishing workflow is carried, and none of ${shipped.length} shipped file(s) fetches or installs plugin code.`);
