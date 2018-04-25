<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Grav;
use RocketTheme\Toolbox\Event\Event;


class VenuePlugin extends Plugin
{
    protected $route = "venue";

    /**
    * @var Uri
    */
    protected $uri;

    /**
    * @var Base
    */
    protected $base;

    /**
    * @var Admin_Route
    */
    protected $admin_route;
    /**
     * @return array
     */
    
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onAssetsInitialized' => ['onAssetsInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        // If in an Admin page.
        if ($this->isAdmin()) {
            $this->enable([
                'onGetPageTemplates' => ['onGetPageTemplates', 0],
                'onAdminMenu' => ['onAdminMenu', 0],
                'onTwigTemplatePaths' => ['addAdminTwigTemplatePaths', 1],
            ]);
            return;
        }
        // If not in an Admin page.
        $this->enable([
            'onTwigTemplatePaths' => ['addTwigTemplatePaths', 1],
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
    public function addTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }
    public function addAdminTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/admin/templates';
    }

    /**
     * Add navigation item to the admin plugin
     */
    public function onAdminMenu()
    {
        $this->grav['twig']->plugins_hooked_nav['   Events'] = ['route' => $this->route, 'icon' => ' fa-music'];
    }

    public function onAssetsInitialized()
    {
        $this->grav['assets']->addCss( 'user/plugins/venue/css-compiled/venue.css');
    }

    /**
     * initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerallshortcodes(__dir__.'/shortcodes');
    }

}
