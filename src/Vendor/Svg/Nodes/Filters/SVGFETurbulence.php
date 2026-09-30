<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'feTurbulence'.
 */
class SVGFETurbulence extends SVGNodeContainer
{
    public const TAG_NAME = 'feTurbulence';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function rasterize(SVGRasterizer $rasterizer): void
    {
        // Nothing to rasterize.
    }
}
