<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
class NullCoalesceExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('(')
            ->subcompile($this->getNode('expr2'))
            ->raw(' ?? ')
            ->subcompile($this->getNode('expr3'))
            ->raw(')');
    }
}
