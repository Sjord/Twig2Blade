<?php

namespace Sjord\Twig2Blade;

use Twig\TwigFunction;

class Twig2Blade
{
    public function convertFile($path)
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname($path));
        return $this->convertTwigLoader($loader, basename($path));
    }

    public function convertString($twig)
    {
        $loader = new \Twig\Loader\ArrayLoader(["string" => $twig]);
        return $this->convertTwigLoader($loader, "string");
    }

    protected function convertTwigLoader(\Twig\Loader\LoaderInterface $loader, string $name)
    {
        $source = $loader->getSourceContext($name);
        $twig = new \Twig\Environment($loader, [
            "autoescape" => false,
            "optimizations" => 0
        ]);
        $twig->setCompiler(new Compiler($twig));
        $twig->registerUndefinedFunctionCallback([$this, 'undefinedFunctionCallback']);
        $node = $twig->parse($twig->tokenize($source));
        $traverser = new \Twig\NodeTraverser($twig, [
            new ConvertNodeVisitor($node),
            new InsideLoopVisitor(),
        ]);
        $node = new Node\ModuleNode($traverser->traverse($node));
        return $twig->compile($node);
    }

    public function undefinedFunctionCallback($name)
    {
        return new TwigFunction($name, $name);
    }
}
