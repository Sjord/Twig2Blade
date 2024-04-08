<?php
namespace Sjord\Twig2Blade\Node;
use \Twig\Compiler;
class PrintNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $compiler->raw('{{ ')
            ->subcompile($this->getNode('expr')->asPhpExpression())
            ->raw(' }}');
    }
}
