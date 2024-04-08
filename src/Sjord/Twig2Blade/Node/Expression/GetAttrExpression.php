<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
use Twig\Template;

class GetAttrExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        $attribute = $this->getNode('attribute');
        if (Template::ARRAY_CALL === $this->getAttribute('type')) {
            $node = $this->getNode('node');
            $node->setAttribute('context', 'expression');
            $attribute->setAttribute('context', 'array');
            $compiler
                ->subcompile($node)
                ->raw('[')
                ->subcompile($attribute)
                ->raw(']');
        } else {
            $node = $this->getNode('node');
            $node->setAttribute('context', 'expression');
            $attribute->setAttribute('context', 'object');
            $compiler
                ->subcompile($node)
                ->raw('->')
                ->subcompile($attribute);
        }
    }
}
