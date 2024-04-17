<?php

namespace Sjord\Twig2Blade;

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Node\Node;
use Sjord\Twig2Blade\Node\ForNode;
use Twig\Environment;

final class InsideLoopVisitor implements NodeVisitorInterface
{
    private int $insideLoops = 0;

    public function enterNode(Node $node, Environment $env): Node
    {
        if ($node instanceof ForNode) {
            $this->insideLoops += 1;
        }
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): Node
    {
        $node->setAttribute('insideLoop', (bool)$this->insideLoops);
        if ($node instanceof ForNode) {
            $this->insideLoops -= 1;
        }
        return $node;
    }

    public function getPriority()
    {
        return 10;
    }
}
