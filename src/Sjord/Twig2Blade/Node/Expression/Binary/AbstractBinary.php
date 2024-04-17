<?php

namespace Sjord\Twig2Blade\Node\Expression\Binary;

use Sjord\Twig2Blade\Node\Expression\AbstractExpression;
use Twig\Compiler;

abstract class AbstractBinary extends AbstractExpression
{
    protected $operator = null;

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('(')
            ->subcompile($this->getNode('left'))
            ->raw(' ')
            ->raw($this->operator)
            ->raw(' ')
            ->subcompile($this->getNode('right'))
            ->raw(')')
        ;
    }
}
