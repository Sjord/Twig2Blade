<?php
namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class ModuleNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $compiler->subcompile($this->getNode('body'));

        foreach ($this->getAttribute('embedded_templates') as $template) {
            $compiler->subcompile($template);
        }
    }
}
