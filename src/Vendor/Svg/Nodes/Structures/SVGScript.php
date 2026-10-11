<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\CDataContainer;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'script'.
 */
class SVGScript extends SVGNodeContainer implements CDataContainer
{
    public const TAG_NAME = 'script';

    /**
     * @param string $content The script content.
     */
    public function __construct(string $content = '')
    {
        parent::__construct();

        $this->setValue($content);
    }

    /**
     * @inheritdoc
     */
    public function rasterize(SVGRasterizer $rasterizer): void
    {
    }
}
