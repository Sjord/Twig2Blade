<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use \Twig\Compiler;
final class NotInBinary extends AbstractBinary {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('is_string(')
            ->subcompile($this->getNode('left'))
            ->raw(') ? !str_contains(')
            ->subcompile($this->getNode('right'))
            ->raw(', ')
            ->subcompile($this->getNode('left'))
            ->raw(') : !in_array(')
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw(')');
    }
}
