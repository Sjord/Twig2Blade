<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use \Twig\Compiler;
final class MatchesBinary extends AbstractBinary { 
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('preg_match(')
            ->subcompile($this->getNode('right'))
            ->raw(', ')
            ->subcompile($this->getNode('left'))
            ->raw(')');
    }
}
