<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class VariadicExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler->raw('...');
        parent::compile($compiler);
    }
}
