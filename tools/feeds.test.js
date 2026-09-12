/*
 * Which repository each channel is read from, and where the token may go.
 *
 * Stable and beta come out of the public repository named in plugin.json. Dev
 * comes out of a private one of its own, so that the public one can be opened up
 * without the working branch going with it - and a private repository cannot be
 * read with a plain GET, which is why the dev feed is an API address with a
 * token behind it rather than a file on raw.githubusercontent.com.
 *
 * Two things can go wrong with that, and neither is visible from any one file:
 *
 *   The four places that name the dev repository - Channels.php, build.ps1,
 *   build.sh and the published update-dev.json - can drift apart. Three of them
 *   are build time and the fourth is what every dev panel actually fetches, so a
 *   drift shows up as an update that silently never arrives.
 *
 *   And the token can be sent somewhere it should not go. The dev feed can be
 *   pointed elsewhere by hand, so the rule cannot be "send it to whatever is
 *   configured" - a typo would be a credential handed to a stranger's host.
 *
 * So this ports the two rules out of Channels.php and then reads the other three
 * files to check they say the same thing.
 */
const fs = require('fs');
const path = require('path');

let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

/* ------------------------------------------------------- what is named ---- */

const channels = read('src/Support/Channels.php');

const constant = (name) => {
    const match = channels.match(new RegExp('const\\s+' + name + "\\s*=\\s*'([^']*)'"));

    return match ? match[1] : null;
};

const DEV_REPO = constant('DEV_REPO');
const DEV_BRANCH = constant('DEV_BRANCH');

check('Channels names a dev repository', typeof DEV_REPO === 'string' && DEV_REPO.includes('/'), true);
check('Channels names a dev branch', typeof DEV_BRANCH === 'string' && DEV_BRANCH !== '', true);

/* ------------------------------------------------------------ the port ---- */

/** Channels::devContents(). */
const devContents = (file) =>
    'https://api.github.com/repos/' + DEV_REPO + '/contents/' + file.replace(/^\/+/, '') + '?ref=' + DEV_BRANCH;

/** Channels::derive(). */
function derive(channel, updateUrl) {
    if (channel === 'stable') { return updateUrl; }
    if (channel === 'dev') { return devContents('update-dev.json'); }

    const url = new URL(updateUrl);

    url.pathname = url.pathname.replace(/update(\.json)$/, 'update-' + channel + '$1');

    if (url.host.toLowerCase() === 'raw.githubusercontent.com') {
        const segments = url.pathname.replace(/^\//, '').split('/');

        // <owner>/<repo>/<ref>/<path...>
        if (segments.length >= 4) {
            segments[2] = channel;
            url.pathname = '/' + segments.join('/');
        }
    }

    return url.toString();
}

/** Channels::isDevRepoUrl(). */
function isDevRepoUrl(address) {
    let url;

    try { url = new URL(address); } catch (nothing) { return false; }

    const host = url.host.toLowerCase();

    if (host !== 'api.github.com' && host !== 'raw.githubusercontent.com') { return false; }

    const segments = url.pathname.split('/').filter((segment) => segment !== '');

    if (host === 'api.github.com' && segments.shift() !== 'repos') { return false; }

    return ((segments[0] || '') + '/' + (segments[1] || '')).toLowerCase() === DEV_REPO.toLowerCase();
}

/** Channels::headers(). */
const headers = (address, accept, token) =>
    token === '' || !isDevRepoUrl(address) ? {} : {
        Authorization: 'Bearer ' + token,
        Accept: accept,
        'X-GitHub-Api-Version': '2022-11-28',
    };

/** Channels::downloadHeaders(). */
const downloadHeaders = (address, token) => headers(
    address,
    address.includes('/releases/assets/') ? 'application/octet-stream' : 'application/vnd.github.raw',
    token,
);

/* ------------------------------------------------------- the addresses ---- */

const STABLE = 'https://raw.githubusercontent.com/Legend-Develepment/essentials/main/update.json';

check('stable is the address in plugin.json', derive('stable', STABLE), STABLE);

check(
    'beta moves the branch and the file together',
    derive('beta', STABLE),
    'https://raw.githubusercontent.com/Legend-Develepment/essentials/beta/update-beta.json',
);

check(
    'dev leaves the public repository entirely',
    derive('dev', STABLE),
    'https://api.github.com/repos/' + DEV_REPO + '/contents/update-dev.json?ref=' + DEV_BRANCH,
);

/*
 * And it names the branch. Without ?ref the contents endpoint answers for the
 * default branch, which is the fault the branch swap on the raw address was
 * written for: it serves whatever the default happens to be on the day rather
 * than what the channel published.
 */
check('the dev feed names its branch', derive('dev', STABLE).includes('?ref=' + DEV_BRANCH), true);

/* ----------------------------------------------------- where it may go ---- */

const TOKEN = 'github_pat_example';

check(
    'the dev feed carries the token',
    downloadHeaders(devContents('release/essentials-dev.zip'), TOKEN).Authorization,
    'Bearer ' + TOKEN,
);

check(
    'so does a release asset',
    downloadHeaders('https://api.github.com/repos/' + DEV_REPO + '/releases/assets/1', TOKEN).Authorization,
    'Bearer ' + TOKEN,
);

// GitHub reads an owner and a repository without regard to case, so a link
// somebody retyped is still the same repository.
check(
    'and the repository written the other way up',
    downloadHeaders('https://api.github.com/repos/' + DEV_REPO.toUpperCase() + '/contents/update-dev.json', TOKEN).Authorization,
    'Bearer ' + TOKEN,
);

check('the public feed does not', downloadHeaders(STABLE, TOKEN), {});

check(
    'nor another repository on the same host',
    downloadHeaders('https://api.github.com/repos/Legend-Develepment/essentials/releases', TOKEN),
    {},
);

check(
    'nor a look-alike owner',
    downloadHeaders('https://api.github.com/repos/evil/Essentials-dev/contents/update-dev.json', TOKEN),
    {},
);

check(
    'nor a host that merely starts the same',
    downloadHeaders('https://api.github.com.example.com/repos/' + DEV_REPO + '/contents/update-dev.json', TOKEN),
    {},
);

check(
    'nor the API without /repos in front of it',
    downloadHeaders('https://api.github.com/' + DEV_REPO + '/contents/update-dev.json', TOKEN),
    {},
);

check('nor anything that is not an address', downloadHeaders('not an address at all', TOKEN), {});
check('and nothing at all without a token', downloadHeaders(devContents('update-dev.json'), ''), {});

/*
 * An asset and a file in the tree come from two endpoints, and each wants its
 * own media type. Ask the asset endpoint for raw and it answers with JSON
 * describing the asset - a perfectly successful response, saved to disk as a
 * zip, and refused by the importer with a message about the archive rather than
 * about the request that fetched it.
 */
check(
    'an asset is asked for as bytes',
    downloadHeaders('https://api.github.com/repos/' + DEV_REPO + '/releases/assets/9', TOKEN).Accept,
    'application/octet-stream',
);

check(
    'a file in the tree is asked for raw',
    downloadHeaders(devContents('release/essentials-dev.zip'), TOKEN).Accept,
    'application/vnd.github.raw',
);

/* ------------------------------------------------- and the other files ---- */

const ps1 = read('build.ps1');
const sh = read('build.sh');

const named = (source, pattern) => {
    const match = source.match(pattern);

    return match ? match[1] : null;
};

check('build.ps1 builds for the same repository', named(ps1, /\$devRepo\s*=\s*'([^']*)'/), DEV_REPO);
check('build.ps1 builds for the same branch', named(ps1, /\$devBranch\s*=\s*'([^']*)'/), DEV_BRANCH);
check('build.sh builds for the same repository', named(sh, /dev_repo='([^']*)'/), DEV_REPO);
check('build.sh builds for the same branch', named(sh, /dev_branch='([^']*)'/), DEV_BRANCH);

/*
 * And the manifest every dev panel actually fetches. It is written by the build
 * rather than by hand, so this is not about typing - it is about a manifest left
 * behind by a build from before the repositories were split, which would go on
 * naming a public address that no longer carries the file.
 */
if (!fs.existsSync(path.join(root, 'update-dev.json'))) {
    /*
     * Only where a dev manifest lives, which is the dev repository and nowhere
     * else. The public repository carries a branch per channel and each branch
     * carries its own manifest, so on beta and on main there is no dev manifest
     * to have gone stale - and a build there would otherwise stop on a file
     * whose absence is the correct state.
     */
    console.log('  (no dev manifest here, so the three checks about it were skipped)');
} else {
    const manifest = JSON.parse(read('update-dev.json'));
    const download = (manifest['*'] || {}).download_url || '';

    check('the published dev manifest points at the dev repository', isDevRepoUrl(download), true);

    check(
        'at a download the panel will send its token with',
        downloadHeaders(download, TOKEN).Authorization,
        'Bearer ' + TOKEN,
    );

    check('and names the branch it was published from', download.includes('ref=' + DEV_BRANCH), true);
}

/* ------------------------------------------------------------------------- */

console.log('Feeds: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
