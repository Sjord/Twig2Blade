<?php

namespace Sjord\Twig2Blade\Node\Expression;

use Twig\Compiler;

class FilterExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression
{
    private static $filterMap = [
        'capitalize' => 'ucfirst',
        'keys' => 'array_keys',
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
        if ($filterName == 'raw') {
            $compiler->subcompile($this->getNode('node'));
            return;
        }

        if ($filterName == 'default') {
            $args = [$this->getNode('node'), ...$this->getNode('arguments')->nodes];
            $first = true;
            foreach ($args as $arg) {
                if (!$first) {
                    $compiler->raw(' ?? ');
                }
                $compiler->subcompile($arg);
                $first = false;
            }
            return;
        }

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

    public function isRaw()
    {
        return $this->getNode('filter')->getAttribute('value') == 'raw';
    }
}
