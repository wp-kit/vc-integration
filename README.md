# wp-kit/vc-integration

This is a wp-kit component that handles [```Visual Composer```](https://vc.wpbakery.com/) configuration. 

This component was built to run within an [```Illuminate\Container\Container```](https://github.com/illuminate/container/blob/master/Container.php) so is perfect for frameworks such as [```Themosis```](http://framework.themosis.com/), [```Assely```](https://assely.org/) and [```wp-kit/theme```](https://github.com/wp-kit/theme).

This component is simply a [```ServiceProvider```](https://github.com/wp-kit/vc-integration/blob/master/src/Vc/VisualComposerServiceProvider.php) which helps to simplify the configuration of ```Visual Composer``` and registration of shortcodes compatible with ```Visual Composer``` via a [config file](config/vc.config.php).

## Installation

If you're using ```Themosis```, install via [```Composer```](https://getcomposer.org/) in the root of your ```Themosis``` installation, otherwise install in your ```Composer``` driven theme folder:

```php
composer require "wp-kit/vc-integration"
```

## Setup

### Add Service Provider

Just register the service provider in the providers config:

```php
//inside theme/resources/config/providers.config.php

return [
	//,
	WPKit\Integrations\Vc\VisualComposerServiceProvider::class,   
	//
];
```

### Add Config File

The recommended method of installing config files for ```wp-kit``` components is via ```wp kit vendor:publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install this component, ```wp kit vendor:publish``` will automatically be installed with ```wp-kit/utils```, once installed you can run:

```wp kit vendor:publish```

For more information, please visit [```wp-kit/utils```](https://github.com/wp-kit/utils#commands).

Alternatively, you can place the [config file(s)](config) and [shortcode file(s)](shortcodes) in your ```theme/resources/config``` and ```theme/resources/shortcodes``` directories manually.

## Usage

### Adding Classes

```wp-kit\vc-integration``` comes with a class [```WPKit\Integrations\Vc\Shortcode```](src/Vc/Shortcode.php) which can be extended by your own shortcode classes which should be added inside ```resources/shortcodes``` within the namespace ```Theme\Shortcodes```. 

[Here is an example Shortcode class](shortcodes/Test.php).

### Config

Please install and study the default [config file](config/vc.config.php) as described above to learn how to use this component.

## Get Involved

To learn more about how to use ```wp-kit``` check out the docs:

[View the Docs](https://github.com/wp-kit/theme/tree/docs/README.md)

Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/wp-kit)
- Sharing the project around your community

For details about contributing to the framework, please check the [contribution guide](https://github.com/wp-kit/theme/tree/docs/Contributing.md).

## Requirements

Wordpress 4+

Visual Composer 4+

PHP 5.6+

## License

wp-kit/vc-integration is open-sourced software licensed under the MIT License.
