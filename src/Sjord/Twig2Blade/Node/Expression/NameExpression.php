<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
class NameExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {

    public function compile(Compiler $compiler): void
    {
        $context = $this->getAttribute('context');
        $name = $this->getAttribute('name');
        if ($context == 'expression') {
            $compiler->raw('$' . $name);
        } else if ($context == 'array') {
            $compiler->string($name);
        } else {
            $compiler->raw($name);
        }
    }
}
