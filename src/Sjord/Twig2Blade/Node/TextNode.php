<?php

namespace Sjord\Twig2Blade\Node;

use Twig\Compiler;

class TextNode extends \Sjord\Twig2Blade\Node\Node
{
    private $bladeDirectives = [
        'append',
        'arguments',
        'attributeechos',
        'auth',
        'aware',
        'bindings',
        'blockarguments',
        'break',
        'callable',
        'can',
        'canany',
        'cannot',
        'case',
        'choice',
        'class',
        'classcomponentopening',
        'classfooter',
        'classheader',
        'closingtags',
        'comments',
        'component',
        'componentfirst',
        'componenttags',
        'constructor',
        'continue',
        'csrf',
        'dd',
        'debuginfo',
        'default',
        'display',
        'dump',
        'each',
        'echos',
        'else',
        'elseauth',
        'elseguest',
        'elsecan',
        'elsecanany',
        'elsecannot',
        'elseif',
        'empty',
        'endauth',
        'endcomponent',
        'endcomponentclass',
        'endcomponentfirst',
        'endempty',
        'endenv',
        'endguest',
        'endisset',
        'endonce',
        'endproduction',
        'endslot',
        'endswitch',
        'endcan',
        'endcanany',
        'endcannot',
        'enderror',
        'endfor',
        'endforeach',
        'endforelse',
        'endif',
        'endlang',
        'endprepend',
        'endpush',
        'endsection',
        'endunless',
        'endwhile',
        'env',
        'error',
        'escapedechos',
        'extends',
        'extendsfirst',
        'extensions',
        'for',
        'foreach',
        'forelse',
        'getparent',
        'getsourcecontext',
        'gettemplatename',
        'guest',
        'hassection',
        'if',
        'include',
        'includefirst',
        'includeif',
        'includeunless',
        'includewhen',
        'inject',
        'istraitable',
        'isset',
        'js',
        'json',
        'lang',
        'loadtemplate',
        'macros',
        'method',
        'once',
        'openingtags',
        'overwrite',
        'parent',
        'php',
        'prepend',
        'production',
        'props',
        'push',
        'rawechos',
        'regularechos',
        'section',
        'sectionmissing',
        'selfclosingtags',
        'show',
        'slot',
        'slots',
        'source',
        'stack',
        'statement',
        'statements',
        'stop',
        'string',
        'switch',
        'tags',
        'template',
        'templatecall',
        'unless',
        'unset',
        'while',
        'yield',
    ];

    public function compile(Compiler $compiler): void
    {
        $text = $this->getAttribute('data');
        if (preg_match('~\w\z~', $text)) {
            // strings ends with word-character
            $compiler
                ->raw('{{ ')
                ->repr($text)
                ->raw(' }}');
        } else {
            if ($this->needsVerbatim($text)) {
                $compiler
                    ->raw("@verbatim")
                    ->raw($text)
                    ->raw("@endverbatim");
            } else {
                $compiler->raw($text);
            }
        }
    }

    private function needsVerbatim($text)
    {
        $directives = implode('|', array_map(function ($d) {
            return "@$d\W";
        }, $this->bladeDirectives));
        return preg_match("~({{|$directives)~", $text);
    }
}
