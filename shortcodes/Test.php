<?php

    namespace Theme\Shortcodes;

    use WPKit\Integrations\Vc\Shortcode;

    class Test extends Shortcode {

		/**
	     * The name of the shortcode
	     *
	     * @var string
	     */
        var $name = 'Test';
        
        /**
	     * The tag of the shortcode
	     *
	     * @var string
	     */
        var $tag = 'test';
        
        /**
	     * The icon for the shortcode
	     *
	     * @var string
	     */
        var $icon = THEME_URI . '/images/test-element.png';
        
        /**
	     * The description of the shortcode
	     *
	     * @var string
	     */
        var $description = 'Test Element';
        
        /**
	     * Should settings show on create
	     *
	     * @var boolean
	     */
        var $show_settings_on_create = true;
        
        /**
	     * The params of the shortcode
	     *
	     * @var array
	     */
        var $params = [
            'image' => [
                'type' => 'attach_image',
                'class' => '',
                'heading' => 'Test Element Image',
                'param_name' => 'image_url',
                'description' => 'The section image'
            ],
            'image_alt' => [
                'type' => 'textfield',
                'class' => '',
                'heading' => 'Image Alt Description',
                'param_name' => 'image_alt',
                'description' => 'Add a description of the image for accessibility.'
            ],
            'title' => [
                'type' => 'textfield',
                'class' => '',
                'heading' => 'Test Element Title',
                'param_name' => 'title',
                'admin_label' => true
            ],
            'content' => [
                'type' => 'textarea_html',
                'class' => '',
                'heading' => 'Test Element Content',
                'param_name' => 'content'
            ],
            'link_text' => [
                'type' => 'textfield',
                'class' => '',
                'heading' => 'Link Text',
                'param_name' => 'link_text'
            ],
            'link_url' => [
                'type' => 'textfield',
                'class' => '',
                'heading' => 'Link URL',
                'param_name' => 'link_url',
                'description' => 'The link URL.'
            ],
            'link_target' => [
                'type' => 'checkbox',
                'class' => '',
                'heading' => 'Choose if the link should open in a new window or not',
                'param_name' => 'link_target',
                'value' => [
                    'New Window' => '_blank'
                ]
            ]
        ];
        
        /**
	     * Get filename for the shortcode
	     *
	     * @return string
		 */
        protected function getFilename() {
			
			return 'tests' . DS . $this->tag;
			
		}
		
		/**
	     * Filter the shortcode attributes
	     *
	     * @param array $atts
	     * @return array
		 */
		protected function filterAtts( $atts = array() ) {
	
	    	$atts['icon'] = get_stylesheet_directory_uri() . '/images/' . $atts['icon'];
			
			return $atts;
			
		}
		
		/**
	     * Get default attributes for the shortcode
	     *
	     * @return array
		 */	
		protected function getDefaultAtts() {
	
			if( is_user_logged_in() ) {
	
				global $current_user;
		
				$this->atts['content'] = 'Hey ' . $current_user->first_name;
	
			}
			
			return $this->atts;
			
		}
        
    }
