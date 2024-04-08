<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
class AssignNameExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw('$')
            ->raw($this->getAttribute('name'))
        ;
    }
}
