<?php
namespace Sjord\Twig2Blade\Node;
use \Twig\Compiler;
class TextNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $compiler->raw($this->getAttribute('data'));
    }
}
