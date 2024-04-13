<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use \Twig\Compiler;
final class HasSomeBinary extends AbstractBinary { 
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('!empty(array_filter(')
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw('))');
    }
}
