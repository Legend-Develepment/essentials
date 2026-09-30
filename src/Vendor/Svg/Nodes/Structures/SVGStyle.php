<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\CDataContainer;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNodeContainer;
use LegendDevelopment\Theme\Vendor\Svg\Rasterization\SVGRasterizer;

/**
 * Represents the SVG tag 'style'.
 * Has the attribute 'type' and the CSS content.
 */
class SVGStyle extends SVGNodeContainer implements CDataContainer
{
    public const TAG_NAME = 'style';

    /**
     * @param string $css   The CSS data rules.
     * @param string $type  The style type attribute.
     */
    public function __construct(string $css = '', string $type = 'text/css')
    {
        parent::__construct();

        $this->setValue($css);
        $this->setType($type);
    }

    /**
     * @return string|null The type attribute.
     */
    public function getType(): ?string
    {
        return $this->getAttribute('type');
    }

    /**
     * @param $type string|null The type attribute.
     *
     * @return $this This node instance, for call chaining.
     */
    public function setType(?string $type): SVGStyle
    {
        return $this->setAttribute('type', $type);
    }

    /**
     * @inheritdoc
     */
    public function rasterize(SVGRasterizer $rasterizer): void
    {
    }
}
