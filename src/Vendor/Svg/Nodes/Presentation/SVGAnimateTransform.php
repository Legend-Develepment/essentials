<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'animateTransform'.
 */
class SVGAnimateTransform extends SVGNodeContainer
{
    public const TAG_NAME = 'animateTransform';

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
