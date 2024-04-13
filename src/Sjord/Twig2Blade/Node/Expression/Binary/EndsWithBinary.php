<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use \Twig\Compiler;
final class EndsWithBinary extends AbstractBinary {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('str_ends_with(')
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw(')');
    }
}
