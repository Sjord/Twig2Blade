<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class ConstantExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    private $raw = false;

    public function compile(Compiler $compiler): void
    {
        if ($this->raw) {
            $compiler->raw($this->getAttribute('value'));
        } else {
            $compiler->repr($this->getAttribute('value'));
        }
    }

    public function asObjectProperty()
    {
        // $obj->CONST
        $this->raw = true;
        return $this;
    }
}
