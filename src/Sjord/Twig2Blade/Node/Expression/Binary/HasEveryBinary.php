<?php

namespace Sjord\Twig2Blade\Node\Expression\Binary;

use Twig\Compiler;

final class HasEveryBinary extends AbstractBinary
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('array_product(array_map(')
            ->subcompile($this->getNode('right'))
            ->raw(', ')
            ->subcompile($this->getNode('left'))
            ->raw('))');
    }
}
