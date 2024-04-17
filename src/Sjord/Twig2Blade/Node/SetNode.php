<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class SetNode extends \Sjord\Twig2Blade\Node\Node
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw("@php\n")
            ->subcompile($this->getNode('names'))
            ->raw(' = ')
            ->subcompile($this->getNode('values'))
            ->raw(";\n@endphp\n");
    }
}
