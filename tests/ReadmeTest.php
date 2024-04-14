<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sjord\Twig2Blade\Twig2Blade;

final class ReadmeTest extends TestCase {
    public function testReadme() {
        $sections = $this->getCodeSections();
        $matching = $this->matchCodeSections($sections);
        $converter = new Twig2Blade();
        foreach ($matching as [$twig, $blade]) {
            $this->assertEquals($blade, $converter->convertString($twig));
        }
    }

    private function matchCodeSections($sections) {
        $matches = [];
        $previous = null;
        foreach ($sections as [$lang, $code]) {
            if ($lang == 'blade' && !empty($previous)) {
                $matches[] = [$previous, $code];
            }
            if ($lang == 'twig') {
                $previous = $code;
            } else {
                $previous = '';
            }
        }
        return $matches;
    }

    private function getCodeSections() {
        $lines = file(__DIR__ . '/../README.md');
        $inCode = false;
        $code = '';
        $lang = '';
        $sections =  [];
        foreach ($lines as $line) {
            if (str_starts_with($line, '```')) {
                if ($inCode) {
                    $sections[] = [$lang, $code];
                    $code = '';
                }
                $inCode = !$inCode;
                $lang = substr(trim($line), 3);
            } else if ($inCode) {
                $code .= $line;
            }
        }
        return $sections;
    }
}
