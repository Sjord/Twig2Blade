<?php
namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class ModuleNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        if ($this->hasNode('parent')) {
            // Child view
            $parent = $this->getNode('parent');
            $compiler
                ->raw("@extends(")
                ->subcompile($parent)
                ->raw(")\n");
            $compiler->subcompile($this->getNode('blocks'));
        } else {
            $compiler->subcompile($this->getNode('body'));

            foreach ($this->getAttribute('embedded_templates') as $template) {
                $compiler->subcompile($template);
            }
        }
    }
}
