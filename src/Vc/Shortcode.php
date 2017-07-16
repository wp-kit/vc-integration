<?php
    
    namespace WPKit\Integrations\VisualComposer;
    
    use WPKit\Shortcodes\Shortcode as BaseShortcode;

	class Shortcode extends BaseShortcode {
    	  
    	var $base = ''; 	
    	var $name = '';
        var $description = '';
        var $class = '';
        var $show_settings_on_create = false;
        var $is_container = false;
        var $as_parent = array();
        var $as_child = array();
        var $weight = 1;
        var $category = '';
        var $group = '';
        var $admin_enqueue_js = '';
        var $admin_enqueue_css = '';
        var $front_enqueue_js = '';
        var $front_enqueue_css = '';
        var $icon = '';
        var $custom_markup = '';
        var $js_view = '';
        var $html_template = '';
        var $deprecated = false;
        var $content_element = true;
		
		protected function toArray() {
			
			return array_merge(get_object_vars($this), array(
				'params' => array_values( $this->atts )
			));
    		
		}
		
		protected function filterAtts( $atts = array() ) {
			
			foreach($atts as $key => &$att) {
        		
        		$param = $this->params[$key];
        		
        		switch( $param['type'] ) {
            		
            		case 'vc_link' :
            		
            		    $att = vc_build_link($att);
            		    
                    break;
            		
        		}
        		
    		}
    		
    		return $atts;
    		
		}
		
		protected function getDefaultAtts() {
    		
    		return array_combine(
                array_map(function($param) { 
            		return $param['param_name'];
                }, $this->params),
        		array_map(function($param) { 
            		return ! empty( $param['default'] ) ? $param['default'] : '';
                }, $this->params)
            );
    		
		}
    	
    }
