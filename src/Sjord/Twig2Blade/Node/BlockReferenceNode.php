<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class BlockReferenceNode extends \Sjord\Twig2Blade\Node\Node
{
    public function __construct($originalNode, $block)
    {
        parent::__construct($originalNode);
        $this->setNode('block', $block);
    }
}
