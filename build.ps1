# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins in the panel.
#
# The archive is written entry by entry instead of with Compress-Archive: that
# cmdlet stores Windows path separators, and PHP's ZipArchive::extractTo() on the
# panel host then unpacks "<id>\plugin.json" as one flat filename, leaving the
# importer unable to find the manifest.

$ErrorActionPreference = 'Stop'

# Where the panel will fetch updates from. It has to be reachable without
# logging in: Pelican downloads it with a plain GET and no credentials.
# Point this somewhere public if the repository is private.
$publishBase = 'https://raw.githubusercontent.com/Legend-Develepment/prlican-theame/main'

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$root = $PSScriptRoot
$manifest = Get-Content (Join-Path $root 'plugin.json') -Raw | ConvertFrom-Json
$id = $manifest.id
$version = $manifest.version

$dist = Join-Path $root 'dist'
if (-not (Test-Path $dist)) {
    New-Item -ItemType Directory -Path $dist -Force | Out-Null
}

$zipPath = Join-Path $dist "$id-$version.zip"
if (Test-Path $zipPath) { Remove-Item $zipPath -Force }

$include = @('plugin.json', 'LICENSE', 'README.md', 'src', 'config', 'database', 'lang', 'resources')

$files = foreach ($item in $include) {
    $source = Join-Path $root $item
    if (Test-Path $source) {
        Get-ChildItem -Path $source -Recurse -File
    }
}

$archive = [System.IO.Compression.ZipFile]::Open($zipPath, 'Create')
try {
    foreach ($file in $files) {
        $relative = $file.FullName.Substring($root.Length).TrimStart('\', '/') -replace '\\', '/'
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile(
            $archive,
            $file.FullName,
            "$id/$relative",
            [System.IO.Compression.CompressionLevel]::Optimal
        ) | Out-Null
    }
} finally {
    $archive.Dispose()
}

Write-Host "Built $zipPath ($($files.Count) files)"

# The panel checks update.json for a version and downloads whatever the URL
# hands back, so the download keeps a fixed name and only the version moves.
$release = Join-Path $root 'release'
if (-not (Test-Path $release)) {
    New-Item -ItemType Directory -Path $release -Force | Out-Null
}

$latest = Join-Path $release "$id.zip"
Copy-Item $zipPath $latest -Force

$manifest = [ordered]@{
    '*' = [ordered]@{
        version      = $version
        download_url = "$publishBase/release/$id.zip"
    }
}

$manifest | ConvertTo-Json -Depth 5 | Set-Content (Join-Path $root 'update.json') -Encoding utf8

Write-Host "Published release/$id.zip and update.json for version $version"
