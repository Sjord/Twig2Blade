<?php

namespace Sjord\Twig2Blade\Node\Expression\Filter;

use Sjord\Twig2Blade\Node\Expression\AbstractExpression;
use Sjord\Twig2Blade\Node\Expression\ConditionalExpression;
use Twig\Compiler;

class DefaultFilter extends AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $node = $this->getNode('node');
        if ($node instanceof ConditionalExpression) {
            /**
             * See Twig\Node\Expression\Filter\DefaultFilter::__construct
             * The ConditionalExpression contains an expression like this:
             *
             *     DefinedTest(var) ? default(var, "fallback") : "fallback"
             *
             * And we only want the middle part.
             */
            $node = $node->getNode('expr2');
        }
        $compiler->subcompile($node);
    }
}
