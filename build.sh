#!/usr/bin/env bash
# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins, and publishes release/<id>.zip plus update.json so the
# panel can offer the update itself.

set -euo pipefail

# Where the panel will fetch updates from. It has to be reachable without
# logging in: Pelican downloads it with a plain GET and no credentials.
# Point this somewhere public if the repository is private.
repo_base='https://raw.githubusercontent.com/Legend-Develepment/prlican-theame'

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
