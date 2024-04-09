<?php
namespace Sjord\Twig2Blade\Node;
use \Twig\Compiler;
class IfNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        foreach (array_chunk($this->getNode('tests')->nodes, 2) as [$test, $block]) {
            $compiler->raw('@if ')
                ->subcompile($test)
                ->raw("\n")
                ->subcompile($block);
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
