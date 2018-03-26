<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class EventShowcase extends Shortcode 
{
    public function init() 
    {
        $this->shortcode->getHandlers()->add('event-showcase', function(ShortcodeInterface $sc) {

            $output = 'Hello world';
            return $output;
        });
    }
}