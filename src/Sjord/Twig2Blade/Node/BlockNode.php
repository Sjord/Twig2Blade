<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class BlockNode extends \Sjord\Twig2Blade\Node\Node
{
    private $hasParent;

    public function __construct($originalNode, $hasParent)
    {
        parent::__construct($originalNode);
        $this->hasParent = $hasParent;
    }

    public function compile(Compiler $compiler): void
    {
        $name = $this->getAttribute('name');
        $body = $this->getNode('body');

        if ($this->hasParent) {
            // Child template
            if ($this->bodyHasNewlines($body)) {
                $compiler
                    ->raw("@section('$name')\n")
                    ->subcompile($body)
                    ->ensureWhiteSpace()
                    ->raw("@endsection\n");
            } else {
                $compiler
                    ->raw("@section('$name', ")
                    ->repr($body->getAttribute('data'))
                    ->raw(")\n");
            }
        } else {
            if ($this->bodyIsEmpty($body)) {
                $compiler->raw("@yield('$name')\n");
            } else {
                $compiler
                    ->raw("@section('$name')\n")
                    ->subcompile($body)
                    ->ensureWhiteSpace()
                    ->raw("@show\n");
            }
        }
    }

    private function bodyIsEmpty($body)
    {
        return empty($body->nodes) && empty($body->attributes);
    }

    private function bodyHasNewlines($body)
    {
        return !empty($body->nodes) || str_contains($body->getAttribute('data'), "\n");
    }
}
