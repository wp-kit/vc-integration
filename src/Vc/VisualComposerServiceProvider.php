<?php
    
    namespace WPKit\Integrations\Vc;
    
    use WPKit\Integrations\Integration;
    use WPBMap;

	class VisualComposerServiceProvider extends Integration {
		
		public function boot() {
		
			$this->publishes([
				__DIR__.'/../../config/vc.config.php' => config_path('vc.config.php')
			], 'config');
			
			$this->publishes([
				__DIR__.'/../../shortcodes/Test.php' => shortcode_path('Test.php')
			], 'shortcodes');

		}
    	
		public function startIntegration() {
			
			$defaults = [
				'params' => [],
				'support' => [],
				'replace' => [],
				'vc_path' => resources_path('vc'),
				'reset' => true
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
			add_filter( 'vc_shortcodes_css_class', array($this, 'customCssClaess'), 10, 3 );
			add_action( 'vc_after_init', array($this, 'addVcParams') );

		}

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

		public function removeVcStyles() {

		    if( empty( $_REQUEST['vc_editable'] ) ) {

				wp_deregister_style( 'js_composer_front' );
				wp_deregister_script( 'wpb_composer_front_js' );

		    }

		}

		public function customCssClaess( $class, $tag, $atts ) {
			
			foreach($this->settings['replace'] as $find => $replace) {
				
				$class = preg_replace( $find, $replace, $class );
				
			}

		    return $class;

		}
        
    }
