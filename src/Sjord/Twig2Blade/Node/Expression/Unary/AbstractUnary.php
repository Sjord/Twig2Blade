<?php

namespace Sjord\Twig2Blade\Node\Expression\Unary;

use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\AbstractExpression;

abstract class AbstractUnary extends AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler->raw($this->operator);
        $compiler->subcompile($this->getNode('node'));
    }
}
