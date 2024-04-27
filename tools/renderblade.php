<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Illuminate\View\View;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;

$path = $argv[1];
$cache_dir = sys_get_temp_dir();
$template_paths = [];
$files = new Filesystem();
$finder = new FileViewFinder($files, [dirname($path), getcwd()]);
$events = new Dispatcher();
$compiler = new BladeCompiler($files, $cache_dir);
$engine = new CompilerEngine($compiler);
$resolver = new EngineResolver();
$resolver->register('blade', function () use ($engine) { return $engine; });
$factory = new Factory($resolver, $finder, $events);
$view = new View($factory, $engine, $path, $path, []);
echo $view->render();
