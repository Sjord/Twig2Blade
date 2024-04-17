<?php
namespace Sjord\Twig2Blade\Node\Expression;
use Twig\Compiler;
use Twig\Template;

class GetAttrExpression extends \Sjord\Twig2Blade\Node\Expression\AbstractExpression {
    public function compile(Compiler $compiler): void
    {
        if ($this->isLoopAttr()) {
            $this->translateLoopAttr();
        }

        if (Template::ARRAY_CALL === $this->getAttribute('type')) {
            $compiler
                ->subcompile($this->getNode('node'))
                ->raw('[')
                ->subcompile($this->getNode('attribute'))
                ->raw(']');
        } else {
            $compiler
                ->subcompile($this->getNode('node'))
                ->raw('->')
                ->subcompile($this->getNode('attribute')->asObjectProperty());
        }
    }

    private function isLoopAttr() {
        $node = $this->getNode('node');
        $attr = $this->getNode('attribute');
        return $this->getAttribute('insideLoop')
            && $node instanceof NameExpression
            && $attr instanceof ConstantExpression
            && 'loop' === $node->getAttribute('name');
    }

    private function translateLoopAttr() {
        $map = [
            'index' => 'iteration',
            'index0' => 'index',
            'revindex0' => 'remaining',
            'length' => 'count',
            // TODO revindex0
        ];
        $attr = $this->getNode('attribute')->getAttribute('value');
        if (isset($map[$attr])) {
            $this->getNode('attribute')->setAttribute('value', $map[$attr]);
        }
    }
}
