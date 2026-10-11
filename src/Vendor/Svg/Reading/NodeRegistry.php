<?php

namespace LegendDevelopment\Theme\Vendor\Svg\Reading;

use LegendDevelopment\Theme\Vendor\Svg\Nodes\Embedded\SVGForeignObject;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Embedded\SVGImage;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEBlend;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEColorMatrix;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEComponentTransfer;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEComposite;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEConvolveMatrix;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEDiffuseLighting;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEDisplacementMap;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEDistantLight;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEDropShadow;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEFlood;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEFuncA;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEFuncB;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEFuncG;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEFuncR;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEGaussianBlur;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEImage;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEMerge;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEMergeNode;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEMorphology;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEOffset;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFEPointLight;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFESpecularLighting;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFESpotLight;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFETile;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFETurbulence;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Filters\SVGFilter;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGAnimate;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGAnimateMotion;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGAnimateTransform;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGLinearGradient;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGMPath;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGRadialGradient;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGSet;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGStop;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Presentation\SVGView;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGCircle;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGEllipse;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGLine;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGPath;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGPolygon;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGPolyline;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Shapes\SVGRect;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGClipPath;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGDefs;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGDocumentFragment;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGGroup;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGLinkGroup;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGMarker;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGMask;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGMetadata;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGPattern;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGScript;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGStyle;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGSwitch;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGSymbol;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Structures\SVGUse;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGNode;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\SVGGenericNodeType;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts\SVGDesc;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts\SVGText;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts\SVGTextPath;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts\SVGTitle;
use LegendDevelopment\Theme\Vendor\Svg\Nodes\Texts\SVGTSpan;

/**
 * This class contains a list of all known SVG node types, and enables dynamic
 * instantiation of the respective class.
 */
class NodeRegistry
{
    /**
    * @var string[] $nodeTypes Map of tag names to fully-qualified class names.
    */
    private static array $nodeTypes = [
        'foreignObject'         => SVGForeignObject::class,
        'image'                 => SVGImage::class,

        'feBlend'               => SVGFEBlend::class,
        'feColorMatrix'         => SVGFEColorMatrix::class,
        'feComponentTransfer'   => SVGFEComponentTransfer::class,
        'feComposite'           => SVGFEComposite::class,
        'feConvolveMatrix'      => SVGFEConvolveMatrix::class,
        'feDiffuseLighting'     => SVGFEDiffuseLighting::class,
        'feDisplacementMap'     => SVGFEDisplacementMap::class,
        'feDistantLight'        => SVGFEDistantLight::class,
        'feDropShadow'          => SVGFEDropShadow::class,
        'feFlood'               => SVGFEFlood::class,
        'feFuncA'               => SVGFEFuncA::class,
        'feFuncB'               => SVGFEFuncB::class,
        'feFuncG'               => SVGFEFuncG::class,
        'feFuncR'               => SVGFEFuncR::class,
        'feGaussianBlur'        => SVGFEGaussianBlur::class,
        'feImage'               => SVGFEImage::class,
        'feMerge'               => SVGFEMerge::class,
        'feMergeNode'           => SVGFEMergeNode::class,
        'feMorphology'          => SVGFEMorphology::class,
        'feOffset'              => SVGFEOffset::class,
        'fePointLight'          => SVGFEPointLight::class,
        'feSpecularLighting'    => SVGFESpecularLighting::class,
        'feSpotLight'           => SVGFESpotLight::class,
        'feTile'                => SVGFETile::class,
        'feTurbulence'          => SVGFETurbulence::class,
        'filter'                => SVGFilter::class,

        'animate'               => SVGAnimate::class,
        'animateMotion'         => SVGAnimateMotion::class,
        'animateTransform'      => SVGAnimateTransform::class,
        'linearGradient'        => SVGLinearGradient::class,
        'mpath'                 => SVGMPath::class,
        'radialGradient'        => SVGRadialGradient::class,
        'set'                   => SVGSet::class,
        'stop'                  => SVGStop::class,
        'view'                  => SVGView::class,

        'circle'                => SVGCircle::class,
        'ellipse'               => SVGEllipse::class,
        'line'                  => SVGLine::class,
        'path'                  => SVGPath::class,
        'polygon'               => SVGPolygon::class,
        'polyline'              => SVGPolyline::class,
        'rect'                  => SVGRect::class,

        'clipPath'              => SVGClipPath::class,
        'defs'                  => SVGDefs::class,
        'svg'                   => SVGDocumentFragment::class,
        'g'                     => SVGGroup::class,
        'a'                     => SVGLinkGroup::class,
        'marker'                => SVGMarker::class,
        'mask'                  => SVGMask::class,
        'metadata'              => SVGMetadata::class,
        'pattern'               => SVGPattern::class,
        'script'                => SVGScript::class,
        'style'                 => SVGStyle::class,
        'switch'                => SVGSwitch::class,
        'symbol'                => SVGSymbol::class,
        'use'                   => SVGUse::class,

        'desc'                  => SVGDesc::class,
        'text'                  => SVGText::class,
        'textPath'              => SVGTextPath::class,
        'title'                 => SVGTitle::class,
        'tspan'                 => SVGTSpan::class,
    ];

    /**
     * Instantiate a node class matching the given type.
     * If no such class exists, a generic one will be used.
     *
     * @param string $type The node tag name ('svg', 'rect', 'title', etc.).
     *
     * @return SVGNode The node that was created.
     */
    public static function create(string $type): SVGNode
    {
        if (isset(self::$nodeTypes[$type])) {
            $nodeClass = self::$nodeTypes[$type];
            return new $nodeClass();
        }

        return new SVGGenericNodeType($type);
    }
}
