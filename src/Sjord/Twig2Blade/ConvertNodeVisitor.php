<?php

namespace Sjord\Twig2Blade;

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Node\Node;
use Twig\Node\ModuleNode;
use Twig\Node\Expression\GetAttrExpression;
use Twig\Environment;

final class ConvertNodeVisitor implements NodeVisitorInterface
{
    private ModuleNode $moduleNode;

    public function __construct(ModuleNode $moduleNode)
    {
        $this->moduleNode = $moduleNode;
    }

    public function enterNode(Node $node, Environment $env): Node
    {
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): Node
    {
        return $this->convertNode($node);
    }

    public function getPriority()
    {
        return 0;
    }

    private function convertNode($node)
    {
        if ($node instanceof \Twig\Node\BlockReferenceNode) {
            $name = $node->getAttribute('name');
            $block = $this->moduleNode->getNode('blocks')->getNode($name);
            return new \Sjord\Twig2Blade\Node\BlockReferenceNode($node, $block);
        }
        if ($node instanceof \Twig\Node\BlockNode) {
            $hasParent = $this->moduleNode->hasNode('parent');
            return new \Sjord\Twig2Blade\Node\BlockNode($node, $hasParent);
        }
        $newClass = str_replace('Twig\Node', 'Sjord\Twig2Blade\Node', get_class($node));
        return new $newClass($node);
    }
}
