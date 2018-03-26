<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TestShortcode extends Shortcode {
    public function init() {
        $this->shortcode->getHandlers()->add('test-shortcode', function(ShortcodeInterface $sc) {
            //add assets
            $output = 'this is a shortcode';
            return $output;
        });
    }
}
?>