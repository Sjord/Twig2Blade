<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class ForNode extends \Sjord\Twig2Blade\Node\Node
{
    public function compile(Compiler $compiler): void
    {
        if ($this->hasNode('else')) {
            $compiler
                ->raw('@forelse (')
                ->subcompile($this->getNode('seq'))
                ->raw(' as ')
                ->subcompile($this->getNode('value_target'))
                ->raw(")\n")
                ->subcompile($this->getNode('body'))
                ->write("@empty\n")
                ->subcompile($this->getNode('else'))
                ->write("@endforelse\n");
        } else {
            $compiler
                ->raw('@foreach (')
                ->subcompile($this->getNode('seq'))
                ->raw(' as ')
                ->subcompile($this->getNode('value_target'))
                ->raw(")\n")
                ->subcompile($this->getNode('body'))
                ->write("@endforeach\n");
        }
    }
}
