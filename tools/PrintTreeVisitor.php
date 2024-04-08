<?php

namespace Sjord\Twig2Blade;

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Node\Node;
use Twig\Node\Expression\GetAttrExpression;
use Twig\Environment;

final class PrintTreeVisitor implements NodeVisitorInterface 
{
    static $indent = 0;

    public function enterNode(Node $node, Environment $env): Node {
        echo str_repeat("  ", static::$indent);
        static::$indent += 1;
        echo get_class($node)."\n";
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): Node {
        static::$indent -= 1;
        return $node;
    }

    public function getPriority() {
        return 0;
    }
}