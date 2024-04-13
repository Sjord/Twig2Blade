<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use \Twig\Compiler;
final class StartsWithBinary extends AbstractBinary {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('str_starts_with(')
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw(')');
    }
}
