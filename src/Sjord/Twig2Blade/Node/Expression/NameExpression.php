<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
class NameExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    private $context = null;

    public function compile(Compiler $compiler): void
    {
        $name = $this->getAttribute('name');
        $context = $this->context;
        if ($context == 'expression') {
            $compiler->raw('$' . $name);
        } else if ($context == 'array') {
            $compiler->string($name);
        } else {
            $compiler->raw($name);
        }
    }

    public function asPhpExpression() {
        $this->context = 'expression';
        return $this;
    }
}
