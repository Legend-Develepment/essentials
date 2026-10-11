# php-svg, carried inside this plugin

A copy of [meyfa/php-svg](https://github.com/meyfa/php-svg) (MIT, see `LICENSE`), used to turn an SVG logo into a WebP egg picture, because Pelican keeps egg pictures only as PNG, JPEG or WebP and most panels have GD and nothing that can draw an SVG.

Carried rather than required through Composer, because a plugin's Composer packages are installed with `composer require` in the panel's own directory, which not every panel can do.

Four changes from upstream, and nothing else:

- The namespace is `LegendDevelopment\Theme\Vendor\Svg` instead of `SVG`, so a panel that also has the upstream package loads both without either replacing the other.
- `Rasterization\Renderers\ImageRenderer::loadImageContent()` only accepts `data:` URIs. Upstream reads any other `href` with `file_get_contents()`, which would let a drawing make the panel open a local file or an internal address. `loadImage()` leaves such an image undrawn instead of handing GD an empty string, whose warning Laravel turns into an exception that would lose the whole drawing.
- No font can be registered: `SVG::addFont()`, `Fonts\FontRegistry::addFont()` and `Fonts\TrueTypeFontFile`, which read a font file from disk, are gone. Nothing here registered one, and without a font upstream leaves text undrawn as well, so a drawing comes out the same. The font reader was also the one place this copy opened a file on disk by a path it was handed.
- `Reading\SVGReader::parseString()` parses with `LIBXML_NONET` instead of `LIBXML_PARSEHUGE`, so libxml's own limits on nesting and entity expansion stay in force.

Used only by `Support\Artwork\Raster`.
