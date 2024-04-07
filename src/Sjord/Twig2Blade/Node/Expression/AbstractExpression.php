<?php
namespace Sjord\Twig2Blade\Node\Expression;
use \Twig\Compiler;
class AbstractExpression extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $compiler->raw(get_class($this));
    }
}
