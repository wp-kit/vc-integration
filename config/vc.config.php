<?php
	
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
		
	  	'reset_shortcodes' => true,
	  	
	  	'reset_styles' => true,
	
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
		    'heading' => 'Style',
		    'param_name' => 'style',
		    'value' => array( 'one', 'two', 'three' ),
		    'description' => __( 'New style attribute', 'my-text-domain' ),
		    'shortcodes' => [
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
		    
			'/vc_row/' => 'grid',
			'/vc_row-fluid/' => 'grid--edge',
			'/wpb_row/' => '',
			'/vc_inner/' => '',
			'/wpb_column/' => 'grid__item',
			'/vc_column_container/' => '',
			'/vc_col-xs-(\d{1,2})/' => 'size-$1',
			'/vc_col-sm-(\d{1,2})/' => 'size-$1-m',
			'/vc_col-md-(\d{1,2})/' => 'size-$1-l',
			'/vc_col-lg-(\d{1,2})/' => 'size-$1-xl'
		
	    ],
	
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
