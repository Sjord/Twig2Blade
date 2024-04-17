<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class PrintNode extends \Sjord\Twig2Blade\Node\Node
{
    public function compile(Compiler $compiler): void
    {
        $expr = $this->getNode('expr');
        if ($expr->isRaw()) {
            $compiler->raw('{!! ')
                ->subcompile($this->getNode('expr'))
                ->raw(' !!}');
        } else {
            $compiler->raw('{{ ')
                ->subcompile($this->getNode('expr'))
                ->raw(' }}');
        }
    }
}
