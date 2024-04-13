<?php
namespace Sjord\Twig2Blade;

class Compiler extends \Twig\Compiler {
    public function ensureWhiteSpace() {
        if (!empty($this->getSource())) {
            if (!ctype_space(substr($this->getSource(), -1))) {
                $this->raw("\n");
            }
        }
        return $this;
    }
}