<?php
namespace Sjord\Twig2Blade\Node;
use \Twig\Compiler;
class ForNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $sequence = $this->getNode('seq');
        $sequence->setAttribute('context', 'expression');

        $compiler
            ->raw('@foreach (')
            ->subcompile($sequence)
            ->raw(' as ')
            ->subcompile($this->getNode('value_target'))
            ->raw(")\n")
            ->subcompile($this->getNode('body'))
            ->write("@endforeach\n");
    }
}
