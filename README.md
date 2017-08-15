# WPKit Visual Composer Integration

This is a Wordpress PHP Component that handles Visual Composer Configuration. 

This PHP Component was built to run within an Illuminate Container so is perfect for frameworks such as Themosis.

This Components is very small and is simply a Service Provider which helps to simplify the configuration of Visual Composer and registration of Shortcodes compatible with Visual Composer via a [config file](https://github.com/wp-kit/vc-integration/blob/master/config/vc.config.php).

## Installation

If you're using Themosis, install via composer in the Themosis route folder, otherwise install in your theme folder:

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

If you are just using this component standalone then add the following the functions.php

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

The recommended method of installing config files for WPKit Components is via ```wp-kit/vendor-publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install the package via:

```wp package install wp-kit/vendor-publish```

Once installed you can run:

```wp kit vendor:publish```

For more information, please visit [wp-kit/vendor-publish](https://github.com/wp-kit/vendor-publish).

Alternatively, you can place the [config file(s)](config) in your ```theme/resources/config``` directory manually.

## Requirements

Wordpress 4+

Visual Composer 4+

PHP 5.6+

## License

WPKit VC Integration is open-sourced software licensed under the MIT License.
