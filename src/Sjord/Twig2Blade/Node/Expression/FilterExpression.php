<?php
namespace Sjord\Twig2Blade\Node\Expression;
use \Twig\Compiler;
class FilterExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->subcompile($this->getNode('filter')->asFunctionName())
            ->raw('(')
            ->subcompile($this->getNode('node'))
            ->raw(')');
    }
}
