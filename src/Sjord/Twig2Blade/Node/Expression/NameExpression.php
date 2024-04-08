<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
class NameExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {

    public function compile(Compiler $compiler): void
    {
        $name = $this->getAttribute('name');
        $context = $this->getAttribute('context');
        if ($context == 'expression') {
            $compiler->raw('$' . $name);
        } else if ($context == 'array') {
            $compiler->string($name);
        } else {
            $compiler->raw($name);
        }
    }

    public function asPhpExpression() {
        $this->setAttribute('context', 'expression');
        return $this;
    }
}
