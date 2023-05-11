<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class NreachLivechatPlugin
 * @package Grav\Plugin
 */
class NreachLivechatPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],

        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $this->log("Adding widget script to page");
        $assets = $this->grav['assets'];
        $assets->addJs('https://lc.nreach.tech/chatwidget.js', ['loading' => 'defer', 'priority' => 100, 'group' => 'bottom']);
    }

    private function log($message)
    {
        $this->grav['debugger']->addMessage("[nreach]: " . $message);
    }
}
