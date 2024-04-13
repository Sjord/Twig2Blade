<?php
namespace Sjord\Twig2Blade;

class Twig2Blade {
    public function convert($path) {
        $loader = new \Twig\Loader\FilesystemLoader(dirname($path));
        $source = $loader->getSourceContext(basename($path));
        $twig = new \Twig\Environment($loader, ["autoescape" => false]);
        $twig->setCompiler(new Compiler($twig));
        $node = $twig->parse($twig->tokenize($source));
        $traverser = new \Twig\NodeTraverser($twig, [new ConvertNodeVisitor($node)]);
        $node = new Node\ModuleNode($traverser->traverse($node));
        return $twig->compile($node);
    }
}