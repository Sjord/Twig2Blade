<?php
namespace Sjord\Twig2Blade\Node\Expression\Binary;
use Twig\Compiler;
final class FloorDivBinary extends AbstractBinary { 
    public function compile(Compiler $compiler): void
    {
        $compiler->raw('(int) floor(');
        parent::compile($compiler);
        $compiler->raw(')');
    }

    protected $operator = '/';
}
