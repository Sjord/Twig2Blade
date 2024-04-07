<?php

namespace Sjord\Twig2Blade;

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Node\Node;
use Twig\Node\Expression\GetAttrExpression;
use Twig\Environment;

final class ConvertNodeVisitor implements NodeVisitorInterface 
{
    public function enterNode(Node $node, Environment $env): Node {
        $newClass = str_replace('Twig\Node', 'Sjord\Twig2Blade\Node', get_class($node));
        return new $newClass($node);
    }

    public function leaveNode(Node $node, Environment $env): Node {
        return $node;
    }

    public function getPriority() {
        return 0;
    }
}