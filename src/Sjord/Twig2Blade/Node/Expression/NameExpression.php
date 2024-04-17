<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class NameExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $name = $this->getAttribute('name');
        $compiler->raw('$' . $name);
    }
}
