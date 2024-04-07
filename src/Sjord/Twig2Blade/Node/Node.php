<?php
namespace Sjord\Twig2Blade\Node;
class Node extends \Twig\Node\Node {
    public function __construct(\Twig\Node\Node $originalNode) {
        $this->nodes = $originalNode->nodes;
        $this->attributes = $originalNode->attributes;
        $this->lineno = $originalNode->lineno;
        $this->tag = $originalNode->tag;
    }
}
