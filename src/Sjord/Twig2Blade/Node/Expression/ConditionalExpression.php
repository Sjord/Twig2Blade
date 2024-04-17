<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class ConditionalExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        // Ternary with no then uses Elvis operator
        if ($this->getNode('expr1') === $this->getNode('expr2')) {
            $compiler
                ->raw('((')
                ->subcompile($this->getNode('expr1'))
                ->raw(') ?: (')
                ->subcompile($this->getNode('expr3'))
                ->raw('))');
        } else {
            $compiler
                ->raw('((')
                ->subcompile($this->getNode('expr1'))
                ->raw(') ? (')
                ->subcompile($this->getNode('expr2'))
                ->raw(') : (')
                ->subcompile($this->getNode('expr3'))
                ->raw('))');
        }
    }
}
