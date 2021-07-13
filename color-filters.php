<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class ColorFiltersPlugin
 * @package Grav\Plugin
 */
class ColorFiltersPlugin extends Plugin
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
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
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

        // Enable the main events we are interested in
        $this->enable([
            'onTwigInitialized' => ['onTwigInitialized', 0]
        ]);
    }


    /**
     * @param Event $e
     */
    public function onTwigInitialized()
    {
        $this->grav['twig']->twig()->addFilter(
            new \Twig_SimpleFilter('hex2rgb', [$this, 'hex2rgb'])
        );
        $this->grav['twig']->twig()->addFilter(
            new \Twig_SimpleFilter('rgb2hex', [$this, 'rgb2hex'])
        );
        $this->grav['twig']->twig()->addFilter(
            new \Twig_SimpleFilter('hex2rgbRaw', [$this, 'hex2rgbRaw'])
        );
    }

    /**
     * Converts a hexadecimal string to a comma-separated RGB string
     */
    public function hex2rgbRaw($color)
    {
        // Remove the leading # if present
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
        } elseif (strlen( $color ) == 3 ) {
            $hex = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        } else {
            return "0,0,0";
        }
 
        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        $output = implode(",",$rgb);
 
        //Return rgb(a) color string
        return $output;
    }
    public function hex2rgb($color)
    {
        $rgb = "rgb(".hex2rgbRaw($color).")";
        return $rgb;
    }

    public function rgb2hex($color) {
        //remove the prefix, brackets, and spaces
        $color = str_replace('rgb(', '', $color);
        $color = str_replace('rgba(', '', $color);
        $color = str_replace(')', '', $color);
        $color = str_replace(' ', '', $color);

        // split the values
        $rgb = explode(",", $color);

        // convert them to hex and preface with #
        $hex = sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);

        //return the result
        return $hex;
    }
}
