<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;

/**
 * Represents the SVG tag 'a'.
 */
class SVGLinkGroup extends SVGNodeContainer
{
    public const TAG_NAME = 'a';

    public function __construct()
    {
        parent::__construct();
    }
}
