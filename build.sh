#!/usr/bin/env bash
# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins, and publishes release/<id>.zip plus update.json so the
# panel can offer the update itself.

set -euo pipefail

# Where the panel will fetch updates from. It has to be reachable without
# logging in: Pelican downloads it with a plain GET and no credentials.
# Point this somewhere public if the repository is private.
publish_base='https://raw.githubusercontent.com/Legend-Develepment/prlican-theame/main'

root="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
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

# The panel checks update.json for a version and downloads whatever the URL
# hands back, so the download keeps a fixed name and only the version moves.
mkdir -p "$root/release"
cp "$zip_path" "$root/release/$id.zip"

cat > "$root/update.json" <<JSON
{
    "*": {
        "version": "$version",
        "download_url": "$publish_base/release/$id.zip"
    }
}
JSON

echo "Built $zip_path"
echo "Published release/$id.zip and update.json for version $version"
