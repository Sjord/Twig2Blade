<?php

namespace Sjord\Twig2Blade\Node\Expression\Test;

use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\TestExpression;

class NullTest extends TestExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('(null === ')
            ->subcompile($this->getNode('node'))
            ->raw(')')
        ;
    }
}
