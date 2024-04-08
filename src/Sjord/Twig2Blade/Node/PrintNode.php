<?php
namespace Sjord\Twig2Blade\Node;
use \Twig\Compiler;
class PrintNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $expr = $this->getNode('expr');
        $expr->setAttribute('context', 'expression');
        $compiler->raw('{{ ')
            ->subcompile($expr)
            ->raw(' }}');
    }
}
