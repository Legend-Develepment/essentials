<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'clipPath'.
 */
class SVGClipPath extends SVGNodeContainer
{
    public const TAG_NAME = 'clipPath';

    public function __construct(?string $id = null)
    {
        parent::__construct();

        $this->setAttribute('id', $id);
    }

    /**
     * @inheritdoc
     */
    public function rasterize(SVGRasterizer $rasterizer): void
    {
        // TODO How do we rasterize this? The clipPath in and of itself wont get rasterized, but usages of it will be!
    }
}
