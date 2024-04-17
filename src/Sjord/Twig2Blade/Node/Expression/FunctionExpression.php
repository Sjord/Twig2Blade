<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class FunctionExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $name = $this->getAttribute('name');

        $compiler
            ->raw($name)
            ->raw('(');
        $first = true;
        foreach ($this->getNode('arguments') as $arg) {
            if (!$first) {
                $compiler->raw(', ');
            }
            $compiler->subcompile($arg);
            $first = false;
        }
        $compiler
            ->raw(')');
    }
}
