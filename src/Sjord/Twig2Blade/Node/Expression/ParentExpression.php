<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class ParentExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler->raw("@parent\n");
    }
}
