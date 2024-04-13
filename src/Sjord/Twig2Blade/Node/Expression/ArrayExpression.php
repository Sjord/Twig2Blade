<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
use Twig\Template;
class ArrayExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        $first = true;
        $compiler->raw('[');
        foreach (array_chunk($this->nodes, 2) as [$key, $value]) {
            if (!$first) {
                $compiler->raw(', ');
            }
            if ($value->hasAttribute('spread')) {
                $compiler
                    ->raw('...')
                    ->subcompile($value);
            } else {
                $compiler->subcompile($key)
                    ->raw(' => ')
                    ->subcompile($value);
            }
            $first = false;
        }
        $compiler->raw(']');
    }
}
