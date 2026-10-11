#!/usr/bin/env bash
# Bundles the plugin into dist/<id>-<version>.zip: the archive uploaded to
# Pelican Hub, which reviews it before any panel can install it. Panels get
# releases from the Hub and from nowhere else, so this publishes nothing - no
# release file, no update feed.

set -euo pipefail

root="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# The same gates and the same suites build.ps1 runs, because a second way to
# build is a second thing to keep in step and this one had fallen a long way
# behind: it ran none of them, so it could build a release that every check
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

# What git tracks, and not what happens to be lying about.
#
# This copied the working tree whole. build.ps1 stopped doing that a long time
# ago and its comment says why: every dev build from 2.54.11 carried a 42 MB icon
# pack nobody asked for, the next would have carried 218 MB, and GitHub's file
# size limit is what finally said so four days later. Those three files are still
# in resources/img and .gitignore still names all three, so this builder went on
# packing them: the archive it produced was 230 MB against a 5 MB release.
#
# Asking git rather than re-implementing the ignore rules. The question is "is
# this file part of the plugin", and the repository already answers it.
#
# -z, because a path is not always ASCII. Without it git quotes any name
# carrying a byte above 127 and writes those bytes as octal escapes, so a
# Swedish icon called logsokare arrives as a literal string with quotation marks
# in it and the copy below reads a file that does not exist.
while IFS= read -r -d '' item; do
    case "$item" in
        plugin.json|LICENSE|README.md|src/*|config/*|database/*|lang/*|resources/*) ;;
        *) continue ;;
    esac

    mkdir -p "$stage/$(dirname "$item")"
    cp "$root/$item" "$stage/$item"
done < <(cd "$root" && git ls-files -z)

if [ ! -f "$stage/plugin.json" ]; then
    echo 'plugin.json is not tracked, so it would not ship - nothing was built.' >&2
    exit 1
fi

zip_path="$dist/$id-$version.zip"
rm -f "$zip_path"

(cd "$dist" && zip -qr "$zip_path" "$id")
rm -rf "$stage"

echo "Built $zip_path"
