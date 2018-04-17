<?php
    
    namespace WPKit\Integrations\Vc;
    
    use WPKit\Integrations\Integration;
    use WPBMap;

	class VisualComposerServiceProvider extends Integration {
		
		/**
	     * Boot the service provider.
	     *
	     * @return void
	     */
		public function boot() {
		
			$this->publishes([
				__DIR__.'/../../config/vc.config.php' => config_path('vc.config.php')
			], 'config');
			
			$this->publishes([
				__DIR__.'/../../shortcodes/Test.php' => shortcode_path('Test.php')
			], 'shortcodes');

		}
    	
    	/**
	     * Start the integration.
	     *
	     * @return void
	     */
		public function startIntegration() {
			
			if( defined( 'WP_CLI' ) && WP_CLI ) {
				
				return false;
				
			}
			
			$defaults = [
				'params' => [],
				'support' => [],
				'replace' => [],
				'vc_path' => resources_path('vc'),
				'reset' => true,
				'reset_styles' => true
			];

			$this->settings = array_merge( $defaults, $this->app['config.factory']->get('vc', $defaults) );

			if( ! function_exists('vc_set_shortcodes_templates_dir') ) {
				return;
			}

			vc_set_shortcodes_templates_dir( $this->settings['vc_path'] );

			foreach( $this->app['config.factory']->get('shortcodes.shortcodes') as $tag => $shortcode ) {
				
				$shortcode = $this->app->make($shortcode);

				if( $shortcode instanceof Shortcode && $shortcode->getBase() ) {
	
					vc_map( $shortcode->toArray() );
	
				}

			}

			add_action( 'wp_enqueue_scripts', array($this, 'removeVcStyles'), 99 );
			add_filter( 'vc_shortcodes_css_class', array($this, 'customCssClasses'), 10, 3 );
			add_action( 'vc_after_init', array($this, 'addVcParams') );

		}

		/**
	     * Remove vc shortcodes and add params
	     *
	     * @return void
	     */
		public function addVcParams() {

			foreach( WPBMap::getAllShortCodes() as $base => $element ) {

				if( $this->settings['reset'] && ! in_array( $base, array_merge( $this->settings['support'], array_keys( $this->app['config.factory']->get('shortcodes.shortcodes') ) ) ) ) {
	
					WPBMap::dropShortcode( $base );
	
				}

			}

			foreach( $this->settings['params'] as $param ) {

				foreach( $param['shortcodes'] as $shortcode ) {

					vc_add_param( $shortcode, $param );

				}

			}

		}

		/**
	     * Remove vc styles
	     *
	     * @return void
	     */
		public function removeVcStyles() {

		    if( empty( $_REQUEST['vc_editable'] ) && $this->settings['reset_styles'] ) {

				wp_deregister_style( 'js_composer_front' );
				wp_deregister_script( 'wpb_composer_front_js' );

		    }

		}

		/**
	     * Apply custom classes
	     *
	     * @return void
	     */
		public function customCssClasses( $class, $tag, $atts ) {
			
			foreach($this->settings['replace'] as $find => $replace) {
				
				$class = preg_replace( $find, $replace, $class );
				
			}

		    return $class;

		}
        
    }
