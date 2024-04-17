<?php

require_once('vendor/autoload.php');

use Twig\NodeVisitor\NodeVisitorInterface;
use Twig\Node\Node;
use Twig\Node\Expression\GetAttrExpression;
use Twig\Environment;

final class PrintTreeVisitor implements NodeVisitorInterface
{
    public static $indent = 0;

    public function enterNode(Node $node, Environment $env): Node
    {
        echo str_repeat("  ", static::$indent);
        static::$indent += 1;
        echo get_class($node)."\n";
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): Node
    {
        static::$indent -= 1;
        return $node;
    }

    public function getPriority()
    {
        return 0;
    }
}

$path = $argv[1];
$loader = new \Twig\Loader\FilesystemLoader(dirname($path));
$source = $loader->getSourceContext(basename($path));
$twig = new \Twig\Environment($loader, [
    "autoescape" => false,
    "optimizations" => 0
]);
$node = $twig->parse($twig->tokenize($source));
$traverser = new \Twig\NodeTraverser($twig, [new PrintTreeVisitor()]);
$traverser->traverse($node);
