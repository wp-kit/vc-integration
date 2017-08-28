<?php
    
    namespace WPKit\Integrations\Vc;
    
    use WPKit\Shortcodes\Shortcode as BaseShortcode;

	class Shortcode extends BaseShortcode {
    	
    	/**
	     * The name of the shortcode
	     *
	     * @var string
	     */
    	var $name = '';
    	
    	/**
	     * The description of the shortcode
	     *
	     * @var string
	     */
        var $description = '';
        
        /**
	     * The classname for the shortcode
	     *
	     * @var string
	     */
        var $class = '';
        
        /**
	     * Should settings show on create
	     *
	     * @var boolean
	     */
        var $show_settings_on_create = false;
        
        /**
	     * Is the shortcode a container
	     *
	     * @var boolean
	     */
        var $is_container = false;
        
        /**
	     * What does the shortcode act as a parant to
	     *
	     * @var array
	     */
        var $as_parent = array();
        
        /**
	     * What does the shortcode act as a child to
	     *
	     * @var array
	     */
        var $as_child = array();
        
        /**
	     * The weight of the shortcode
	     *
	     * @var int
	     */
        var $weight = 1;
        
        /**
	     * The category of the shortcode
	     *
	     * @var string
	     */
        var $category = '';
        
        /**
	     * The group of the shortcode
	     *
	     * @var string
	     */
        var $group = '';
        
        /**
	     * The admin js for the shortcode
	     *
	     * @var string
	     */
        var $admin_enqueue_js = '';
        
        /**
	     * The admin css for the shortcode
	     *
	     * @var string
	     */
        var $admin_enqueue_css = '';
        
        /**
	     * The frotend js for the shortcode
	     *
	     * @var string
	     */
        var $front_enqueue_js = '';
        
        /**
	     * The frotend css for the shortcode
	     *
	     * @var string
	     */
        var $front_enqueue_css = '';
        
        /**
	     * The icon for the shortode
	     *
	     * @var string
	     */
        var $icon = '';
        
        /**
	     * The custom markup for the shortcode
	     *
	     * @var string
	     */
        var $custom_markup = '';
        
        /**
	     * The js view for the shortcode
	     *
	     * @var string
	     */
        var $js_view = '';
        
        /**
	     * The html template for the shortcode
	     *
	     * @var string
	     */
        var $html_template = '';
        
        /**
	     * Is the shortcode a content elemenet
	     *
	     * @var boolean
	     */
        var $content_element = true;
        
        /**
	     * The params of the shortcode
	     *
	     * @var array
	     */
		var $params = array();
		
		/**
	     * Get base of shortcode
	     *
	     * @return string
		 */
		public function getBase() {
			
			return $this->tag;
			
		}
		
		/**
	     * Get array data for shortcode
	     *
	     * @return array
		 */
		public function toArray() {
			
			return array_merge(get_object_vars($this), array(
				'base' => $this->getBase()
			));
    		
		}
		
		/**
	     * Filter the shortcode attributes
	     *
	     * @param array $atts
	     * @return array
		 */
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
		
		/**
	     * Get default attributes for the shortcode
	     *
	     * @return array
		 */
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
