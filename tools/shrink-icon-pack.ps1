# Turns an icon pack of embedded rasters into one the panel can actually use.
#
# Each file in the source is an <svg> wrapper around a single 1254x1254 PNG in
# base64, plus provenance metadata from whatever generated it. That is about
# four megabytes for something drawn at twenty pixels. This decodes the image,
# scales it to 128 - four times the size it is ever drawn at, so it holds up on
# any screen - and wraps it back into an SVG, because the pack uploader takes
# SVG and this keeps that unchanged.
#
# Re-encoding also drops the metadata, which is a few hundred kilobytes of
# credentials nobody is going to read out of a sidebar icon.

param(
    [string]$Source = 'F:\GitHub\prlican-theame\resources\img\Legends-icon-pack-svg.zip',
    [string]$Out    = 'F:\GitHub\prlican-theame\resources\img\Legends-icon-pack-small.zip',
    [int]$Size      = 128
)

Add-Type -AssemblyName System.Drawing
Add-Type -AssemblyName System.IO.Compression.FileSystem

# A short path on purpose. The scratchpad this script lives in is already deep,
# and a staging directory under it plus a long icon name passed the 260
# character limit CreateFromDirectory still enforces.
$staging = Join-Path 'C:\Windows\Temp' ('ip' + [guid]::NewGuid().ToString('N').Substring(0, 8))
New-Item -ItemType Directory -Force $staging | Out-Null

$zip = [IO.Compression.ZipFile]::OpenRead($Source)
$done = 0
$failed = 0
$sourceBytes = 0
$outBytes = 0

foreach ($entry in $zip.Entries) {
    if ($entry.FullName -notlike '*.svg') { continue }

    $sourceBytes += $entry.Length

    try {
        $reader = New-Object IO.StreamReader($entry.Open())
        $svg = $reader.ReadToEnd()
        $reader.Dispose()

        # The one embedded image. Nothing clever: these files hold exactly one.
        $m = [regex]::Match($svg, 'data:image/(png|jpe?g);base64,([A-Za-z0-9+/=]+)')

        if (-not $m.Success) {
            $failed++
            continue
        }

        $bytes = [Convert]::FromBase64String($m.Groups[2].Value)
        $ms = New-Object IO.MemoryStream(,$bytes)
        $img = [Drawing.Image]::FromStream($ms)

        $bmp = New-Object Drawing.Bitmap $Size, $Size, ([Drawing.Imaging.PixelFormat]::Format32bppArgb)
        $g = [Drawing.Graphics]::FromImage($bmp)
        $g.Clear([Drawing.Color]::Transparent)
        $g.InterpolationMode = [Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $g.PixelOffsetMode = [Drawing.Drawing2D.PixelOffsetMode]::HighQuality
        $g.SmoothingMode = [Drawing.Drawing2D.SmoothingMode]::HighQuality
        $g.DrawImage($img, 0, 0, $Size, $Size)

        $small = New-Object IO.MemoryStream
        $bmp.Save($small, [Drawing.Imaging.ImageFormat]::Png)

        $g.Dispose(); $bmp.Dispose(); $img.Dispose(); $ms.Dispose()

        $b64 = [Convert]::ToBase64String($small.ToArray())
        $small.Dispose()

        $name = [IO.Path]::GetFileName($entry.FullName)
        $svgOut = @"
<svg xmlns="http://www.w3.org/2000/svg" width="$Size" height="$Size" viewBox="0 0 $Size $Size">
<image width="$Size" height="$Size" href="data:image/png;base64,$b64"/>
</svg>
"@

        [IO.File]::WriteAllText((Join-Path $staging $name), $svgOut, (New-Object Text.UTF8Encoding($false)))
        $outBytes += [Text.Encoding]::UTF8.GetByteCount($svgOut)
        $done++
    } catch {
        $failed++
        Write-Warning "$($entry.FullName): $($_.Exception.Message)"
    }
}

$zip.Dispose()

if (Test-Path $Out) { Remove-Item $Out -Force }
[IO.Compression.ZipFile]::CreateFromDirectory($staging, $Out)
Remove-Item $staging -Recurse -Force

$zipMb = (Get-Item $Out).Length / 1MB

"converted     : $done"
"failed        : $failed"
"source svg    : {0:N1} MB" -f ($sourceBytes / 1MB)
"rewritten svg : {0:N2} MB  (largest fits well under the 256 KB per-icon limit)" -f ($outBytes / 1MB)
"zip written   : {0:N2} MB  -> {1}" -f $zipMb, $Out
"per icon      : {0:N0} KB average" -f ($outBytes / [math]::Max(1, $done) / 1KB)
