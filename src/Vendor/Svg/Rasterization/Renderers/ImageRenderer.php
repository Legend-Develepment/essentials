<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Rasterization\Renderers;

use LegendDevelopment\Theme\Vendor\Svg\SVG;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNode;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * This renderer can draw referenced images (from <image> tags).
 *
 * Options:
 * - string href: the image URI
 * - float x: the x coordinate of the upper left corner
 * - float y: the y coordinate of the upper left corner
 * - float width: the width
 * - float height: the height
 */
class ImageRenderer extends Renderer
{
    /**
     * @inheritdoc
     */
    public function render(SVGRasterizer $rasterizer, array $options, SVGNode $context): void
    {
        $transform = $rasterizer->getCurrentTransform();

        $x      = $options['x'] ?? 0;
        $y      = $options['y'] ?? 0;
        $transform->map($x, $y);

        // TODO support "auto" values for width and height

        $width  = $options['width'] ?? 0;
        $height = $options['height'] ?? 0;
        if ($width <= 0 || $height <= 0) {
            return;
        }
        $transform->resize($width, $height);

        $image = $rasterizer->getImage();

        $img = $this->loadImage($options['href'], $width, $height);

        if (!empty($img) && (is_resource($img) || $img instanceof \GdImage)) {
            imagecopyresampled(
                $image,         // dst
                $img,           // src
                $x,             // dst_x
                $y,             // dst_y
                0,              // src_x
                0,              // src_y
                $width,         // dst_w
                $height,        // dst_h
                imagesx($img),  // src_w
                imagesy($img)   // src_h
            );
        }
    }

    /**
     * Loads the image locatable via the given HREF and creates a GD resource
     * for it.
     *
     * This method supports data URIs, as well as SVG files (they are rasterized
     * through this very library). As such, the dimensions given are the
     * dimensions the rasterized SVG would have.
     *
     * @param string $href The image URI.
     * @param int    $w    The width that the rasterized image should have.
     * @param int    $h    The height that the rasterized image should have.
     *
     * @return resource The loaded image.
     */
    private function loadImage(string $href, int $w, int $h)
    {
        $content = $this->loadImageContent($href);

        // Changed for Essentials: an href that is not inline data is left
        // undrawn, rather than handed to GD as nothing, which warns - and a
        // warning under Laravel is an exception that loses the whole drawing.
        if ($content === '') {
            return null;
        }

        if (strpos($content, '<svg') !== false && strrpos($content, '</svg>') !== false) {
            $svg = SVG::fromString($content);
            return $svg->toRasterImage($w, $h);
        }

        return imagecreatefromstring($content);
    }

    /**
     * Loads the data of an image locatable via the given HREF into a string.
     *
     * @param string $href The image URI.
     *
     * @return string The image content.
     */
    private function loadImageContent(string $href): string
    {
        $dataPrefix = 'data:';

        // check if $href is data URI
        if (substr($href, 0, strlen($dataPrefix)) === $dataPrefix) {
            $commaPos = strpos($href, ',');
            $metadata = substr($href, 0, $commaPos);
            $content  = substr($href, $commaPos + 1);

            if (strpos($metadata, ';base64') !== false) {
                $content = base64_decode($content);
            }

            return $content;
        }

        // Changed for Essentials: an embedded picture may only be inline data.
        // The drawings rendered here come from outside the panel, and an href
        // read from disk or fetched over the network would let one of them
        // make the panel open a local file or an internal address.
        return '';
    }
}
