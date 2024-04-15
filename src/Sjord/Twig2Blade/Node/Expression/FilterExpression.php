<?php
namespace Sjord\Twig2Blade\Node\Expression;
use \Twig\Compiler;
class FilterExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    private static $filterMap = [
        'capitalize' => 'ucfirst',
        'length' => 'count',
        'lower' => 'strtolower',
        'replace' => 'strtr',
        'reverse' => 'array_reverse',
        'striptags' => 'strip_tags',
        'title' => 'ucwords',
        'upper' => 'strtoupper',
        'url_encode' => 'rawurlencode',
    ];

    public function compile(Compiler $compiler): void
    {
        $filterName = $this->getNode('filter')->getAttribute('value');
        $functionName = static::$filterMap[$filterName] ?? $filterName;
        $compiler
            ->raw($functionName)
            ->raw('(');

        $args = [$this->getNode('node'), ...$this->getNode('arguments')->nodes];
        $first = true;
        foreach ($args as $arg) {
            if (!$first) {
                $compiler->raw(', ');
            }
            $compiler->subcompile($arg);
            $first = false;
        }
        $compiler->raw(')');
    }
}
