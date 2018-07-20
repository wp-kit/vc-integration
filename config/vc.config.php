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
	    | VC Reset
	    |--------------------------------------------------------------------------
	    |
	    | Tell the Service Provider what to reset with Vc
	    |
	    */
	    
	    'reset_shortcodes' => true,
		
	    'reset_styles' => true,
		
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
	    | Tell the Service Provider which classnames to replace on rows and columns,
	    | replace must be an array, replace callback must be a closure
	    |
	    */
	
		'replace' => [
		    
		    'vc_row-fluid' => 'o-grid--edge',
			'vc_row' => 'o-grid',
			'wpb_row' => '',
			'vc_inner' => '',
			'wpb_column' => 'o-grid__item',
			'vc_column_container' => '',
			'/vc_col-xs-(\d{1,2})/' => 'u-size-$1',
			'/vc_col-sm-(\d{1,2})/' => 'u-size-$1@m',
			'/vc_col-md-(\d{1,2})/' => 'u-size-$1@l',
			'/vc_col-lg-(\d{1,2})/' => 'u-size-$1@xl'
		
	    ],
		
	    'replace_callback' => function( $class, $tag, $atts ) {
            
		    if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
			    $classname = ! empty( $this->settings['replace']['vc_row'] ) ? $this->settings['replace']['vc_row'] : 'o-grid';
			    $classname .= ! empty( $atts['full_width'] ) ? ( ! empty( $this->settings['replace']['vc_row-fluid'] ) ? $this->settings['replace']['vc_row-fluid'] : ' o-grid--edge' ) : '';
				$class = str_replace( 'vc_row-fluid', $classname, $class );
				$class = str_replace( array('vc_row', 'wpb_row', 'vc_inner'), array('', '', ''), $class );
		    }
		    if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
				$class = str_replace( 'wpb_column vc_column_container', ! empty( $this->settings['replace']['wpb_column'] ) ? $this->settings['replace']['wpb_column'] : 'o-grid__item', $class );
				$class = preg_replace( '/vc_col-xs-(\d{1,2})/', ! empty( $this->settings['replace']['/vc_col-xs-(\d{1,2})/'] ) ? $this->settings['replace']['vc_col-xs-$1'] : 'u-size-$1', $class );
				$class = preg_replace( '/vc_col-sm-(\d{1,2})/', ! empty( $this->settings['replace']['/vc_col-sm-(\d{1,2})/'] ) ? $this->settings['replace']['vc_col-sm-$1'] : 'u-size-$1@m', $class );
				$class = preg_replace( '/vc_col-md-(\d{1,2})/', ! empty( $this->settings['replace']['/vc_col-md-(\d{1,2})/'] ) ? $this->settings['replace']['vc_col-md-$1'] : 'u-size-$1@l', $class );
				$class = preg_replace( '/vc_col-lg-(\d{1,2})/', ! empty( $this->settings['replace']['/vc_col-lg-(\d{1,2})/'] ) ? $this->settings['replace']['vc_col-lg-$1'] : 'u-size-$1@xl', $class );
		    }
		    return $class;

		},
	
	    /*
	    |--------------------------------------------------------------------------
	    | VC View Path
	    |--------------------------------------------------------------------------
	    |
	    | Tell the Server Provider where to find original VC view files that you
	    | want to override
	    |
	    | ~/theme/resources/views/vc/
	    |
	    */
	
	    'vc_path' => resources_path('views/vc')
	
	];
