<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$path = $argv[1];
$loader = new \Twig\Loader\FilesystemLoader(dirname($path));
$twig = new \Twig\Environment($loader);
echo $twig->load(basename($path))->render([]);
