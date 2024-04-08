<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sjord\Twig2Blade\Twig2Blade;

use Illuminate\View\View;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;

/**
 * For every template in tests/templates/*.twig, convert it to blade.
 * Render both the Twig and the converted Blade template and verify
 * that they give the same output.
 */
final class TemplatesTest extends TestCase {
    public function setUp() : void {
        parent::setUp();
        $this->filesystem = new Filesystem();
        $this->tmpdir = tempnam(sys_get_temp_dir(), 'twig2blade');
        $this->filesystem->delete($this->tmpdir);
        $this->filesystem->makeDirectory($this->tmpdir);

    }

    public function tearDown() : void {
        $this->filesystem->deleteDirectory($this->tmpdir);
        parent::tearDown();
    }

    private function getContext() {
        $object = new \stdClass();
        $object->prop = "world";
        $object->nested = new \stdClass();
        $object->nested->prop = "world";

        $home = new \stdClass();
        $home->href = "/";
        $home->caption = "home";

        return [
            "a_variable" => "foo",
            "navigation" => [$home],
            "string" => "world",
            "assoc" => [
                "foo" => "world",
            ],
            "numarray" => ["world"],
            "object" => $object
        ];
    }

    public function testTemplates() {
        $converter = new Twig2Blade();

        $twigs = glob(__DIR__ . '/templates/*.twig');
        foreach ($twigs as $twig) {
            $blade = $converter->convert($twig);
            $this->assertEquals($this->renderBlade($blade), $this->renderTwig($twig), $twig);
        }
    }

    private function renderBlade($blade) {
        $path = tempnam($this->tmpdir, 'blade');
        file_put_contents($path, $blade);
        $cache_dir = $this->tmpdir;
        $template_paths = [];
        $extensions = ['blade.php'];
        $files = new Filesystem();
        $finder = new FileViewFinder($files, $template_paths, $extensions);
        $events = new Dispatcher();
        $compiler = new BladeCompiler($files, $cache_dir);
        $engine = new CompilerEngine($compiler);
        $resolver = new EngineResolver();
        $factory = new Factory($resolver, $finder, $events);
        try {
            $view = new View($factory, $engine, $path, $path, $this->getContext());
            return $view->render();
        } catch (\Illuminate\View\ViewException $e) {
            var_dump($blade);
            throw $e;
        }
    }

    private function renderTwig($path) {
        $loader = new \Twig\Loader\FilesystemLoader(dirname($path));
        $twig = new \Twig\Environment($loader);
        return $twig->load(basename($path))->render($this->getContext());
    }
}