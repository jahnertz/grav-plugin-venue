<?php

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class EventGrid extends Shortcode 
{
    public function init() 
    {
        $this->shortcode->getHandlers()->add('event-grid', function(ShortcodeInterface $sc) {

            $output = $this->twig->processTemplate('partials/venue-event-grid.html.twig', [
                'width' => $sc->getParameter('width', '4'),
                'shortcode' => $sc,
            ]);

            return $output;
        });
    }
}