<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;

/**
 * Represents the SVG tag 'g'.
 */
class SVGGroup extends SVGNodeContainer
{
    public const TAG_NAME = 'g';

    public function __construct()
    {
        parent::__construct();
    }
}
