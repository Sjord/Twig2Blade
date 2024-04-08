<?php

require_once('vendor/autoload.php');

use \Sjord\Twig2Blade\Twig2Blade;

$converter = new Twig2Blade();
echo $converter->convert($argv[1])."\n";