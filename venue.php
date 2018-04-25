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
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onGetPageTemplates' => ['onGetPageTemplates', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onAssetsInitialized' => ['onAssetsInitialized', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        // If in an Admin page.
        if ($this->isAdmin()) {
            $this->enable([
                'onGetPageTemplates' => ['onGetPageTemplates', 0],
            ]);
            return;
        }
        // If not in an Admin page.
        $this->enable([
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 1],
        ]);
    }

    /**
     * Add blueprint directory to page templates.
     */
    public function onGetPageTemplates(Event $event)
    {
        $types = $event->types;
        $locator = Grav::instance()['locator'];
        $types->scanBlueprints($locator->findResource('plugin://' . $this->name . '/blueprints'));
        $types->scanTemplates($locator->findResource('plugin://' . $this->name . '/templates'));
    }
 
    /**
     * Add templates directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onAssetsInitialized()
    {
        $this->grav['assets']->addCss( 'user/plugins/venue/css-compiled/venue.css');
    }

    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/VenueTwigExtension.php');
        $this->grav['twig']->twig->addextension(new shortcodeuitwigextension());
    }

    /**
     * initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerallshortcodes(__dir__.'/shortcodes');
    }

}
