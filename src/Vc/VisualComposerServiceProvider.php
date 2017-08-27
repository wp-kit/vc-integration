<?php
    
    namespace WPKit\Integrations\Vc;
    
    use WPKit\Integrations\Integration;
    use WPBMap;

	class VisualComposerServiceProvider extends Integration {
		
		public function boot() {
		
			$this->publishes([
				__DIR__.'/../../config/vc.config.php' => config_path('vc.config.php')
			], 'config');

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

		public function customCssClaess( $class_string, $tag, $atts ) {

		    if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
			    $class = ! empty( $this->settings['replace']['vc_row'] ) ? $this->settings['replace']['vc_row'] : 'grid';
			    $class .= ! empty( $atts['full_width'] ) ? ( ! empty( $this->settings['replace']['vc_row-fluid'] ) ? $this->settings['replace']['vc_row-fluid'] : ' grid--edge' ) : '';
			$class_string = str_replace( 'vc_row-fluid', $class, $class_string );
			$class_string = str_replace( array('vc_row', 'wpb_row', 'vc_inner'), array('', '', ''), $class_string );
		    }
		    if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = str_replace( 'wpb_column vc_column_container', ! empty( $this->settings['replace']['wpb_column'] ) ? $this->settings['replace']['wpb_column'] : 'grid__item', $class_string );
			$class_string = preg_replace( '/vc_col-xs-(\d{1,2})/', ! empty( $this->settings['replace']['vc_col-xs-$1'] ) ? $this->settings['replace']['vc_col-xs-$1'] : 'size-$1', $class_string );
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', ! empty( $this->settings['replace']['vc_col-sm-$1'] ) ? $this->settings['replace']['vc_col-sm-$1'] : 'size-$1-m', $class_string );
			$class_string = preg_replace( '/vc_col-md-(\d{1,2})/', ! empty( $this->settings['replace']['vc_col-md-$1'] ) ? $this->settings['replace']['vc_col-md-$1'] : 'size-$1-l', $class_string );
			$class_string = preg_replace( '/vc_col-lg-(\d{1,2})/', ! empty( $this->settings['replace']['vc_col-lg-$1'] ) ? $this->settings['replace']['vc_col-lg-$1'] : 'size-$1-xl', $class_string );
		    }
		    return $class_string;

		}
        
    }
