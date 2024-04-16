<?php
namespace Sjord\Twig2Blade\Node;
use Twig\Compiler;
use Sjord\Twig2Blade\Node\Expression\ArrayExpression;
class IncludeNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        if ($this->getNode('expr') instanceof ArrayExpression) {
            $compiler->raw('@includeFirst(');
        } else {
            if ($this->getAttribute('ignore_missing')) {
                $compiler->raw('@includeIf(');
            } else {
                $compiler->raw('@include(');
            }
        }

        $compiler->subcompile($this->getNode('expr'));

        if ($this->hasNode('variables')) {
            $compiler->raw(', ')->subcompile($this->getNode('variables'));
        }

        $compiler->raw(")\n");
    }
}
