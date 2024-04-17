<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class IfNode extends \Sjord\Twig2Blade\Node\Node
{
    public function compile(Compiler $compiler): void
    {
        $directive = '@if';
        foreach (array_chunk($this->getNode('tests')->nodes, 2) as [$test, $block]) {
            $compiler->raw($directive)
                ->raw(' (')
                ->subcompile($test)
                ->raw(")\n")
                ->subcompile($block);
            $directive = '@elseif';
        }

        if ($this->hasNode('else')) {
            $compiler
                ->write("@else\n")
                ->subcompile($this->getNode('else'))
            ;
        }

        $compiler->raw("@endif\n");
    }
}
