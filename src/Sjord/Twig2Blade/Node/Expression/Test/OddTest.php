<?php
namespace Sjord\Twig2Blade\Node\Expression\Test;

use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\TestExpression;

class OddTest extends TestExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('(')
            ->subcompile($this->getNode('node'))
            ->raw(' % 2 != 0')
            ->raw(')')
        ;
    }
}
