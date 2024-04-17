<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class DoNode extends \Sjord\Twig2Blade\Node\Node
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw("@php\n")
            ->subcompile($this->getNode('expr'))
            ->raw(";\n@endphp\n");
    }
}
