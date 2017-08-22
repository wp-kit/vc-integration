# wp-kit/vc-integration

This is a Wordpress PHP Component that handles [```Visual Composer```](https://vc.wpbakery.com/) Configuration. 

This PHP Component was built to run within an [```Illuminate\Container\Container```](https://github.com/illuminate/container/blob/master/Container.php) so is perfect for frameworks such as [```Themosis```](http://framework.themosis.com/).

This component is simply a [```ServiceProvider```](https://github.com/wp-kit/vc-integration/blob/master/src/Vc/VisualComposerServiceProvider.php) which helps to simplify the configuration of ```Visual Composer``` and registration of shortcodes compatible with ```Visual Composer``` via a [config file](config/vc.config.php).

## Installation

If you're using ```Themosis```, install via ```Composer```](https://getcomposer.org/) in the root of your ```Themosis``` installation, otherwise install in your ```Composer``` driven theme folder:

```php
composer require "wp-kit/vc-integration"
```

## Setup

### Add Service Provider

**Within Themosis Theme**

Just register the service provider in the providers config:

```php
//inside themosis-theme/resources/config/providers.config.php

return [
	//,
	WPKit\Integrations\Vc\VisualComposerServiceProvider::class,   
	//
];
```

**Within functions.php**

If you are just using this component standalone then add the following the ```functions.php```

```php
// within functions.php

// make sure composer has been installed
if( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	
	wp_die('Composer has not been installed, try running composer', 'Dependancy Error');
	
}

// Use composer to load the autoloader.
require __DIR__ . '/vendor/autoload.php';

$container = new Illuminate\Container\Container(); // create new app container

$provider = new WPKit\Integrations\Vc\VisualComposerServiceProvider($container); // inject into service provider

$provider->register(); //register service provider
```

### Add Config File

The recommended method of installing config files for ```wp-kit``` components is via ```wp-kit/vendor-publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install the package via:

```wp package install wp-kit/vendor-publish```

Once installed you can run:

```wp kit vendor:publish```

For more information, please visit [wp-kit/vendor-publish](https://github.com/wp-kit/vendor-publish).

Alternatively, you can place the [config file(s)](config) in your ```theme/resources/config``` directory manually.

## Usage

Please install and study the default [config file](config/vc.config.php) as described above to learn how to use this component.

## Requirements

Wordpress 4+

Visual Composer 4+

PHP 5.6+

## License

wp-kit/vc-integration is open-sourced software licensed under the MIT License.
