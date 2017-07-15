# WPKit Visual Composer Integration

This is a Wordpress PHP Component that handles Visual Composer Configuration. 

This PHP Component was built to run within an Illuminate Container so is perfect for frameworks such as Themosis.

This Components is very small and is simply a Service Provider which helps to simplify the configuration of Visual Composer and registration of Shortcodes compatible with Visual Composer.

## Installation

If you're using Themosis, install via composer in the Themosis route folder, otherwise install in your theme folder:

```php
composer require "wp-kit/vc-integration"
```

## Registering Service Provider

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


## Config

Now just add the configuration file in your config directory:

```php
// In theme/resources/config/vc.config.php

return [

    /*
    |--------------------------------------------------------------------------
    | VC Support
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which original VC Components to retain and support
    |
    */

    'support' => [
	'vc_row',
	'vc_row_inner',
	'vc_column',
	'vc_column_inner',
	'vc_column_text',
	'vc_single_image',
	'vc_tta_accordion',
	'vc_tta_section',
	'vc_section',
	'gravityform',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | VC Params
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider of any params (fields) you would like to add to 
    | existing components
    |
    */

    'params' => [
    	
	[
	    'type' => 'dropdown',
	    'heading' => "Style",
	    'param_name' => 'style',
	    'value' => array( "one", "two", "three" ),
	    'description' => __( "New style attribute", "my-text-domain" ),
	    'shortcodes => [
	    	'vc_section',
		'vc_column'
	    ]
	]
	
    ],
    
     /*
    |--------------------------------------------------------------------------
    | VC Replace
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which classnames to replace on rows and columns 
    |
    */

    'replace' => [
    
	'vc_row' => 'grid',
	'vc_row-fluid' => 'grid--edge',
	'wpb_column' => 'grid__item',
	'vc_col-xs-$1' => 'size-$1',
	'vc_col-sm-$1' => 'size-$1-m'
	'vc_col-md-$1' => 'size-$1-l',
	'vc_col-lg-$1' => 'size-$1-xl'
	
    ]

    /*
    |--------------------------------------------------------------------------
    | VC View Path
    |--------------------------------------------------------------------------
    |
    | Tell the Server Provider where to find original VC view files that you
    | want to override
    |
    | ~/theme/resources/vc/
    |
    */

    'vc_path' => resources_path('vc')

];

```

## Requirements

Wordpress 4+

Visual Composer 4+

PHP 5.6+

## License

WPKit VC Integration is open-sourced software licensed under the MIT License.
