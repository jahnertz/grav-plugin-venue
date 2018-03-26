<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;


class VenuePlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onAssetsInitialized' => ['onAssetsInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
        ];
    }

    public function onassetsinitialized()
    {
        $this->grav['assets']->addCss( 'user/plugins/venue/css-compiled/venue.css');
    }

    /**
     * add current directory to twig lookup paths.
     */
    public function ontwigtemplatepaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function ontwigextensions()
    {
        require_once(__DIR__ . '/twig/VenueTwigExtension.php');
        $this->grav['twig']->twig->addextension(new shortcodeuitwigextension());
    }

    /**
     * initialize configuration
     */
    public function onshortcodehandlers()
    {
        $this->grav['shortcode']->registerallshortcodes(__dir__.'/shortcodes');
    }

}
