# Color Filters Plugin

The **Color Filters** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). It provides additional Twig Color filters, for converting between various color formats.

Supports the following conversions:

* rgb2hex - outputs a standard hex code with # prefix, eg `#ff0000`
* hex2rgb - outputs rgb values mapped between 0-255, wrapped in 'rgb()', eg `rgb(255,0,0)`
* hex2rgbRaw - outputs comma-separated RGB values mapped between 0-255, eg `255,0,0`

## Installation

Installing the Color Filters plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install color-filters

This will install the Color Filters plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/color-filters`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `color-filters`. You can find these files on [GitHub](https://github.com/stom66/grav-plugin-color-filters) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/color-filters
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/stom66/grav-plugin-color-filters/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/color-filters/color-filters.yaml` to `user/config/plugins/color-filters.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named color-filters.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage Examples

Use this as you would any other Twig filter, eg:

`color = page.header.color|hex2rgb`
`color = page.header.color|default('#D97210')|hex2rgb|split(",")`


## To Do

- [ ] Add support for hex-to-rgb
- [ ] Add lighten/darken filters

