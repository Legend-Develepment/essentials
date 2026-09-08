#!/usr/bin/env bash
# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins, and publishes release/<id>.zip plus update.json so the
# panel can offer the update itself.

set -euo pipefail

# Where the panel will fetch updates from. It has to be reachable without
# logging in: Pelican downloads it with a plain GET and no credentials.
# Point this somewhere public if the repository is private.
repo_base='https://raw.githubusercontent.com/Legend-Develepment/essentials'

root="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# The same gates and the same suites build.ps1 runs, because a second way to
# build is a second thing to keep in step and this one had fallen a long way
# behind: it ran none of them, so it could publish a release that every check
# in the repository would have refused.
#
# Found by glob rather than listed, on purpose. build.ps1 names each one with
# the reason it exists beside it, which is worth reading and worth the upkeep.
# A list here would be that upkeep twice, and the copy that drifts is the one
# nobody looks at - which is exactly what happened.
if command -v node >/dev/null 2>&1; then
    # The one that is not called check-something. It reads every PHP file in the
    # plugin and is the cheapest of the lot, so it goes first: a parse error
    # makes every gate after it a confusing way to say the same thing.
    if ! node "$root/tools/lint-php.js"; then
        echo 'lint-php failed - nothing was built.' >&2
        exit 1
    fi

    for gate in "$root"/tools/check-*.js; do
        [ -e "$gate" ] || continue

        if ! node "$gate"; then
            echo "$(basename "$gate") failed - nothing was built." >&2
            exit 1
        fi
    done

    for suite in "$root"/tools/*.test.js; do
        [ -e "$suite" ] || continue

        if ! node "$suite" >/dev/null; then
            node "$suite" || true
            echo "$(basename "$suite") failed - nothing was built." >&2
            exit 1
        fi
    done
else
    echo 'node was not found, so nothing was checked before building.' >&2
    exit 1
fi
id="$(sed -n 's/.*"id"[[:space:]]*:[[:space:]]*"\([^"]*\)".*/\1/p' "$root/plugin.json" | head -1)"
version="$(sed -n 's/.*"version"[[:space:]]*:[[:space:]]*"\([^"]*\)".*/\1/p' "$root/plugin.json" | head -1)"

dist="$root/dist"
stage="$dist/$id"

rm -rf "$stage"
mkdir -p "$stage"

for item in plugin.json LICENSE README.md src config database lang resources; do
    [ -e "$root/$item" ] && cp -r "$root/$item" "$stage/"
done

zip_path="$dist/$id-$version.zip"
rm -f "$zip_path"

(cd "$dist" && zip -qr "$zip_path" "$id")
rm -rf "$stage"

# The panel checks the manifest for a version and downloads whatever the URL
# hands back, so the download keeps a fixed name and only the version moves.
# The two channels are separate files: cutting a beta leaves stable alone.
if [ "${1:-}" = "--dev" ]; then
    channel='dev'
    branch='DEV'
    download_name="$id-dev.zip"
    manifest_name='update-dev.json'
elif [ "${1:-}" = "--beta" ]; then
    channel='beta'
    branch='beta'
    download_name="$id-beta.zip"
    manifest_name='update-beta.json'
else
    channel='stable'
    branch='main'
    download_name="$id.zip"
    manifest_name='update.json'
fi

mkdir -p "$root/release"
cp "$zip_path" "$root/release/$download_name"

cat > "$root/$manifest_name" <<JSON
{
    "*": {
        "version": "$version",
        "download_url": "$repo_base/$branch/release/$download_name"
    }
}
JSON

echo "Built $zip_path"
echo "Published release/$download_name and $manifest_name to the $channel channel (version $version)"
