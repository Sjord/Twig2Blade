<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
use Twig\Template;

class GetAttrExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        if (Template::ARRAY_CALL === $this->getAttribute('type')) {
            $compiler
                ->subcompile($this->getNode('node')->asPhpExpression())
                ->raw('[')
                ->subcompile($this->getNode('attribute'))
                ->raw(']');
        } else {
            $compiler
                ->subcompile($this->getNode('node')->asPhpExpression())
                ->raw('->')
                ->subcompile($this->getNode('attribute')->asObjectProperty());
        }
    }
}
