<?php

namespace Tests;

use Illuminate\View\ViewFinderInterface;
use Sjord\Twig2Blade\Twig2Blade;

final class ConvertingViewFinder implements ViewFinderInterface 
{
    private string $cachePath;
    private string $templatePath;

    public function __construct($cachePath, $templatePath) {
        $this->cachePath = $cachePath;
        $this->templatePath = $templatePath;
    }

    public function find($view){
        $converter = new Twig2Blade();
        $blade = $converter->convert($this->templatePath . $view);
        $path = tempnam($this->cachePath, 'ConvertingViewFinder') . '.blade.php';
        file_put_contents($path, $blade);
        return $path;
    }

    public function addLocation($location){ }
    public function addNamespace($namespace, $hints){ }
    public function prependNamespace($namespace, $hints){ }
    public function replaceNamespace($namespace, $hints){ }
    public function addExtension($extension){ }
    public function flush(){ }
}