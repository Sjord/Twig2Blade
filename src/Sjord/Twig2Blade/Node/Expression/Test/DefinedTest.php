<?php

namespace Sjord\Twig2Blade\Node\Expression\Test;

use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\TestExpression;

class DefinedTest extends TestExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('isset(')
            ->subcompile($this->getNode('node'))
            ->raw(')')
        ;
    }
}
