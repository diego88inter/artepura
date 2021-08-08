<?php

if ( ! function_exists( 'hendon_core_add_swapping_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_swapping_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreSwappingImageGalleryShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_swapping_image_gallery_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreSwappingImageGalleryShortcode extends HendonCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/swapping-image-gallery' );
			$this->set_base( 'hendon_core_swapping_image_gallery' );
			$this->set_name( esc_html__( 'Swapping Image Gallery', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds swapping image gallery holder', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_scripts(
				array(
					'swiper' => array(
						'registered'	=> true,
					),
					'hendon-main-js' => array(
						'registered'	=> true,
					)
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'info_position',
				'title'         => esc_html__( 'Info Position', 'hendon-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'hendon-core' ),
					'right'  => esc_html__( 'Right', 'hendon-core' ),
					'left'   => esc_html__( 'Left', 'hendon-core' )
				),
				'default_value' => 'right'
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'info_title',
				'title'         => esc_html__( 'Title', 'hendon-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Line Break', 'hendon-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'hendon-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h2'
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'info_description',
				'title'         => esc_html__( 'Description', 'hendon-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Image Items', 'hendon-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'hendon-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'image',
						'name'       => 'main_image',
						'title'      => esc_html__( 'Main Image', 'hendon-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'thumbnail_image',
						'title'      => esc_html__( 'Thumbnail Image', 'hendon-core' )
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['info_title']     = $this->get_modified_title( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['slider_data']    = $this->get_slider_data();
			$atts['this_shortcode'] = $this;
			
			return hendon_core_get_template_part( 'shortcodes/swapping-image-gallery', 'templates/swapping-image-gallery', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-swapping-image-gallery';
			$holder_classes[]  = ! empty( $atts['info_position'] ) ? 'qodef-info-position--' . $atts['info_position'] : 'qodef-info-position--right';
			$holder_classes[]  = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_modified_title( $atts ) {
			$title = $atts['info_title'];
			
			if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );
				
				foreach ( $line_break_positions as $position ) {
					$position = intval( $position );
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br>';
					}
				}
				
				$title = implode( ' ', $split_title );
			}
			
			return $title;
		}
		
		private function get_slider_data() {
			$data = array();
			
			$data['slidesPerView'] = '1';
			$data['spaceBetween']  = 0;
			$data['autoplay'] = false;
			
			return json_encode( $data );
		}
	}
}