<?php
namespace Sjord\Twig2Blade\Node\Expression;
use \Twig\Compiler;
class FilterExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    private static $filterMap = [
        'upper' => 'strtoupper'
    ];

    public function compile(Compiler $compiler): void
    {
        $filterName = $this->getNode('filter')->getAttribute('value');
        $functionName = static::$filterMap[$filterName] ?? $filterName;
        $compiler
            ->raw($functionName)
            ->raw('(')
            ->subcompile($this->getNode('node'))
            ->raw(')');
    }
}
