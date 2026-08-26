#!/usr/bin/env bash
# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins in the panel.

set -euo pipefail

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

echo "Built $zip_path"
