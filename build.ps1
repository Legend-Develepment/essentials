# Bundles the plugin into dist/<id>-<version>.zip: the archive uploaded to
# Pelican Hub, which reviews it before any panel can install it. Panels get
# releases from the Hub and from nowhere else, so this publishes nothing - no
# release file, no update feed. Beta builds go to the Hub the same way, with its
# Publish to beta workflow.
#
# The archive is written entry by entry instead of with Compress-Archive: that
# cmdlet stores Windows path separators, and PHP's ZipArchive::extractTo() on the
# panel host then unpacks "<id>\plugin.json" as one flat filename, leaving the
# importer unable to find the manifest.

$ErrorActionPreference = 'Stop'

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$root = $PSScriptRoot
$manifest = Get-Content (Join-Path $root 'plugin.json') -Raw | ConvertFrom-Json
$version = $manifest.version

# Lowercased, because Pelican lowercases the id itself when it reads plugin.json
# (Plugin::getRows), and the folder it installs into is the lowered form, so this
# is the same value the panel uses rather than a second convention.
$id = $manifest.id.ToLower()

# A PHP file that does not parse takes down every page of the panel that renders
# it and makes the plugin impossible to install. There is no PHP on the machine
# this is built on, so `php -l` was never an option and 2.47.3 shipped a broken
# lang file to all three channels without anything objecting. This is the check
# that would have stopped it.
if (Get-Command node -ErrorAction SilentlyContinue) {
    & node (Join-Path $root 'tools/lint-php.js')
    if ($LASTEXITCODE -ne 0) { throw 'PHP check failed - nothing was built.' }

    <#
        Every gate in tools/, by the glob rather than by name.

        This was a list of twenty-seven, each with a paragraph above it saying
        why it exists. The paragraphs are worth reading and they are already in
        the gates themselves, which is where somebody looking at a failure ends
        up anyway - so keeping them here was the same upkeep twice, and the copy
        that drifts is the one nobody opens. build.sh learned this first and
        says so; the suite list in this file learned it the hard way, having
        quietly not run stock.test.js since the day it was written.
    #>
    Get-ChildItem -Path (Join-Path $root 'tools') -Filter 'check-*.js' |
        Sort-Object Name |
        ForEach-Object {
            & node $_.FullName

            if ($LASTEXITCODE -ne 0) { throw "$($_.Name) failed - nothing was built." }
        }


    # The suites, which are gates rather than files that happen to exist. Each
    # covers a boundary where input from outside becomes something with
    # authority, or arithmetic somebody is charged for: a console command, a
    # parsed network packet, a path handed to deleteFiles, a pro-rata credit.
    # Every one of them was written alongside its code and every one found
    # something that code was getting wrong.
    #
    # A suite that exists and is not named here is a suite nothing runs, which
    # is worse than no suite at all: it looks like cover and is not.
    #
    # It used to be a list of names, with that sentence above it claiming the
    # list was every file in tools/. It was not: stock.test.js was written, was
    # never added, and forty-five assertions sat there looking like cover for a
    # day. build.sh had globbed all along. A list a person maintains drifts the
    # first time somebody is in a hurry; the directory cannot.
    $suites = Get-ChildItem -Path (Join-Path $root 'tools') -Filter '*.test.js' | Sort-Object Name

    if ($suites.Count -eq 0) {
        throw 'No test suites were found in tools/ - nothing was built.'
    }

    foreach ($suite in $suites) {
        & node $suite.FullName | Out-Null
        if ($LASTEXITCODE -ne 0) {
            & node $suite.FullName
            throw "The $($suite.BaseName) tests failed - nothing was built."
        }
    }

    Write-Host "Suites: $($suites.Count) ran, all passed."
} else {
    # Not a warning. Every gate above this point is a thing that has already
    # shipped broken once, and a release built without them is a release
    # nobody checked - which is the state they exist to make impossible.
    # build.sh has always treated this as fatal; these two now agree.
    throw 'node was not found, so nothing could be checked - nothing was built.'
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

# Only what the repository actually holds.
#
# .gitignore already says which files are not part of this plugin - two icon
# packs kept in resources/img for testing are named in it - and the build was
# not reading it. So every dev build from 2.54.11 onwards carried a 42 MB icon
# pack that nobody asked for, and the one after it would have carried 218 MB.
# GitHub's own file size limit is what finally said so, four days later.
#
# Asking git rather than re-implementing the ignore rules: the question is
# "is this file part of the plugin", and the repository is already the place
# that answers it.
$tracked = $null
try {
    # -c core.quotepath=false, and the console told to read UTF-8.
    #
    # git escapes a non-ASCII path by default - logsökare comes back as
    # logsÃ¶kare, in quotes - so the comparison below missed it and the
    # file was dropped from the release without a word. Two icons went that way
    # before this line existed, and any language file with an accent in its name
    # would have gone the same.
    $was = [Console]::OutputEncoding
    [Console]::OutputEncoding = [Text.Encoding]::UTF8
    try {
        $listed = & git -C $root -c core.quotepath=false ls-files -- $include 2>$null
    } finally {
        [Console]::OutputEncoding = $was
    }
    if ($LASTEXITCODE -eq 0 -and $listed) {
        $tracked = [System.Collections.Generic.HashSet[string]]::new(
            [string[]]($listed | ForEach-Object { $_ -replace '/', [IO.Path]::DirectorySeparatorChar }),
            [StringComparer]::OrdinalIgnoreCase
        )
    }
} catch {
    # No git, or not a checkout. The list below is then whatever was found on
    # disk, which is what this did before and is better than refusing to build.
}

if ($tracked) {
    $before = @($files).Count
    $files = @($files | Where-Object {
        $tracked.Contains($_.FullName.Substring($root.Length).TrimStart('\', '/'))
    })

    $dropped = $before - $files.Count
    if ($dropped -gt 0) {
        Write-Host "Left out $dropped file(s) the repository does not track."
    }

    # And a new file that nobody has added yet stops the build.
    #
    # Filtering by git ls-files was there to keep .gitignore'd things out - the
    # icon packs, node_modules, the 218 MB release that once shipped. It also
    # silently drops a file that simply has not been committed yet, which is a
    # different thing entirely, and the line above reported it as one number in
    # a wall of output.
    #
    # That shipped. 2.58.0-dev was built before its own commit, so seven new
    # files - a support class, a controller, a page, its view, a script and two
    # language files - were left out while the service provider that references
    # them went in. The result was Class "...SupportQuick" not found on every
    # page of the panel, and Pelican's plugin loader catches Exception rather
    # than Throwable, so a missing class is not caught at all.
    #
    # --others --exclude-standard is exactly the difference: files git does not
    # track and .gitignore does not claim. Those are never deliberate.
    $forgotten = $null
    try {
        $was = [Console]::OutputEncoding
        [Console]::OutputEncoding = [Text.Encoding]::UTF8
        try {
            $forgotten = & git -C $root -c core.quotepath=false ls-files --others --exclude-standard -- $include 2>$null
        } finally {
            [Console]::OutputEncoding = $was
        }
    } catch {
        # No git. The check above already said so.
    }

    if ($LASTEXITCODE -eq 0 -and $forgotten) {
        $names = @($forgotten)
        $shown = ($names | Select-Object -First 10) -join "`n  "
        $rest = if ($names.Count -gt 10) { "`n  ...and $($names.Count - 10) more" } else { '' }

        throw "$($names.Count) file(s) inside the plugin are not committed, so they would be left out of the release while anything referencing them goes in:`n  $shown$rest`nCommit them, or add them to .gitignore if they are not part of the plugin. Nothing was built."
    }
} else {
    Write-Warning 'git could not list the tracked files, so everything on disk was packaged.'
}

# A plugin package is a few hundred kilobytes. This is not a tuning knob - it is
# the second half of the fix above, because a rule about which files go in only
# helps while somebody remembers to keep it right, and a number is checked every
# time. Twenty-five megabytes is far past anything this has ever produced.
$largest = $files | Sort-Object Length -Descending | Select-Object -First 1
$total = ($files | Measure-Object -Property Length -Sum).Sum

if ($total -gt 25MB) {
    $mb = [math]::Round($total / 1MB, 1)
    $big = if ($largest) { "$($largest.FullName.Substring($root.Length).TrimStart('\','/')) at $([math]::Round($largest.Length / 1MB, 1)) MB" } else { 'unknown' }
    throw "The package would be $mb MB, which is not a plugin. Largest file: $big. Nothing was built."
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
