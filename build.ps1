# Bundles the plugin into dist/<id>-<version>.zip, ready for the Import button
# on Admin -> Plugins in the panel, and publishes it to a release channel:
#
#   .\build.ps1          stable  ->  release/<id>.zip       + update.json
#   .\build.ps1 -Beta    beta    ->  release/<id>-beta.zip  + update-beta.json
#   .\build.ps1 -Dev     dev     ->  release/<id>-dev.zip   + update-dev.json
#
# The channels are separate files, so cutting a beta never changes what stable
# panels are offered.
#
# The archive is written entry by entry instead of with Compress-Archive: that
# cmdlet stores Windows path separators, and PHP's ZipArchive::extractTo() on the
# panel host then unpacks "<id>\plugin.json" as one flat filename, leaving the
# importer unable to find the manifest.

param([switch]$Beta, [switch]$Dev)

$ErrorActionPreference = 'Stop'

# Where the panel will fetch updates from. It has to be reachable without
# logging in: Pelican downloads it with a plain GET and no credentials.
#
# Each channel is served from its own branch, so a dev build lands on DEV
# without anything being merged anywhere.
$repoBase = 'https://raw.githubusercontent.com/Legend-Develepment/pelican-essentials'

$branches = @{
    stable = 'main'
    beta   = 'beta'
    dev    = 'DEV'
}

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$root = $PSScriptRoot
$manifest = Get-Content (Join-Path $root 'plugin.json') -Raw | ConvertFrom-Json
$id = $manifest.id
$version = $manifest.version

# A PHP file that does not parse takes down every page of the panel that renders
# it and makes the plugin impossible to install. There is no PHP on the machine
# this is built on, so `php -l` was never an option and 2.47.3 shipped a broken
# lang file to all three channels without anything objecting. This is the check
# that would have stopped it.
if (Get-Command node -ErrorAction SilentlyContinue) {
    & node (Join-Path $root 'tools/lint-php.js')
    if ($LASTEXITCODE -ne 0) { throw 'PHP check failed - nothing was built.' }
} else {
    Write-Warning 'node was not found, so the PHP check was skipped.'
}

$dist = Join-Path $root 'dist'
if (-not (Test-Path $dist)) {
    New-Item -ItemType Directory -Path $dist -Force | Out-Null
}

$zipPath = Join-Path $dist "$id-$version.zip"
if (Test-Path $zipPath) { Remove-Item $zipPath -Force }

$include = @('plugin.json', 'LICENSE', 'README.md', 'src', 'config', 'database', 'lang', 'resources')

# -Recurse on a file path does not mean "this file". PowerShell reads it as a
# name to search for, so `Get-ChildItem -Path <root>\README.md -Recurse` returns
# every README.md under the whole tree - which is how another plugin sitting
# beside this one got its README.md and plugin.json into a release. Directories
# recurse; the four file entries are taken as themselves.
$files = foreach ($item in $include) {
    $source = Join-Path $root $item
    if (Test-Path $source) {
        if (Test-Path $source -PathType Leaf) {
            Get-Item -Path $source
        } else {
            Get-ChildItem -Path $source -Recurse -File
        }
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

if ($Dev) {
    $channel = 'dev'
    $downloadName = "$id-dev.zip"
    $manifestName = 'update-dev.json'
} elseif ($Beta) {
    $channel = 'beta'
    $downloadName = "$id-beta.zip"
    $manifestName = 'update-beta.json'
} else {
    $channel = 'stable'
    $downloadName = "$id.zip"
    $manifestName = 'update.json'
}

Copy-Item $zipPath (Join-Path $release $downloadName) -Force

$manifest = [ordered]@{
    '*' = [ordered]@{
        version      = $version
        download_url = "$repoBase/$($branches[$channel])/release/$downloadName"
    }
}

# Written without a byte order mark: PowerShell 5.1's -Encoding utf8 adds one,
# and a BOM makes PHP's json_decode return null - so the panel would read an
# empty feed and quietly never offer an update.
[System.IO.File]::WriteAllText(
    (Join-Path $root $manifestName),
    ($manifest | ConvertTo-Json -Depth 5),
    (New-Object System.Text.UTF8Encoding($false))
)

Write-Host "Published release/$downloadName and $manifestName to the $channel channel (version $version)"
