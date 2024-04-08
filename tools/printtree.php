<?php

require_once('vendor/autoload.php');

use \Sjord\Twig2Blade\PrintTreeVisitor;

$path = $argv[1];
$loader = new \Twig\Loader\FilesystemLoader(dirname($path));
$source = $loader->getSourceContext(basename($path));
$twig = new \Twig\Environment($loader, ["autoescape" => false]);
$node = $twig->parse($twig->tokenize($source));
$traverser = new \Twig\NodeTraverser($twig, [new PrintTreeVisitor()]);
$traverser->traverse($node);