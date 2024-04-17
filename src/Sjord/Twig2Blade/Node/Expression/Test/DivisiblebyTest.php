<?php

namespace Sjord\Twig2Blade\Node\Expression\Test;

use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\TestExpression;

class DivisiblebyTest extends TestExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('(0 == ')
            ->subcompile($this->getNode('node'))
            ->raw(' % ')
            ->subcompile($this->getNode('arguments')->getNode(0))
            ->raw(')')
        ;
    }
}
