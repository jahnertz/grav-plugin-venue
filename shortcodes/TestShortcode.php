<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TestShortcode extends Shortcode 
{
    public function init() 
    {
        $this->shortcode->getHandlers()->add('test-shortcode', function(ShortcodeInterface $sc) {
            //add assets etc
            $output = $this->twig->processTemplate('partials/venue-test.html.twig',[
            'text' => $sc->getParameter('text', 'Hello World'),
            'shortcode' => $sc,
            ]);
            return $output;
        });
    }
}