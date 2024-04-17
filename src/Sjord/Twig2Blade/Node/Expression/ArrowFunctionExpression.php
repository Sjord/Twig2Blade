<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class ArrowFunctionExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('function (')
            ->subcompile($this->getNode('names'))
            ->raw(") { return ")
            ->subcompile($this->getNode('expr'))
            ->raw('; }');
    }
}
