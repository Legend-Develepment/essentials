<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'title'.
 */
class SVGTitle extends SVGNodeContainer
{
    public const TAG_NAME = 'title';

    public function __construct(string $text = '')
    {
        parent::__construct();
        $this->setValue($text);
    }

    /**
     * Dummy implementation
     *
     * @inheritdoc
     */
    public function rasterize(SVGRasterizer $rasterizer): void
    {
        // nothing to rasterize
    }
}
