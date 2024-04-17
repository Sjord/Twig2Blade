<?php
namespace Sjord\Twig2Blade\Node;
use Twig\Compiler;
class FlushNode extends \Sjord\Twig2Blade\Node\Node {
    public function compile(Compiler $compiler): void
    {
        $compiler->raw("@php\nflush();\n@endphp\n");
    }
}
