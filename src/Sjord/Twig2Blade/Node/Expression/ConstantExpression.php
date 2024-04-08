<?php
namespace Sjord\Twig2Blade\Node\Expression;
use \Twig\Compiler;
class ConstantExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        if ($this->getAttribute('context') == 'array') {
            $compiler->repr($this->getAttribute('value'));
        } else {
            $compiler->raw($this->getAttribute('value'));
        }
    }
}
