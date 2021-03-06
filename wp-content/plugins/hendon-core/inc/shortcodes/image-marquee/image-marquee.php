<?php

if ( ! function_exists( 'hendon_core_add_image_marquee_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_image_marquee_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreImageMarqueeShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_image_marquee_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreImageMarqueeShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_image_marquee_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'hendon_core_filter_image_marquee_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/image-marquee' );
			$this->set_base( 'hendon_core_image_marquee' );
			$this->set_name( esc_html__( 'Image Marquee', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds Image Marquee element', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			
			$options_map = hendon_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'hendon-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'duration',
				'title'         => esc_html__( 'Animation Duration (Seconds)', 'hendon-core' ),
				'default_value' => '20',
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'image_action',
				'title'      => esc_html__( 'Image Action', 'hendon-core' ),
				'options'    => array(
					''            => esc_html__( 'No Action', 'hendon-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'hendon-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency'    => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

            $atts['holder_classes'] = $this->get_holder_classes( $atts );
            $atts['image_params']   = $this->generate_image_params( $atts );
            $atts['duration']       = $this->get_duration( $atts );
            $atts['image_inline_style']      = $this->get_image_inline_style( $atts );
            $atts['copy_image_inline_style'] = $this->get_image_inline_style( $atts, true );
            $atts['mobile_image_inline_style']      = $this->get_image_inline_style( $atts, false, true );
            $atts['copy_mobile_image_inline_style'] = $this->get_image_inline_style( $atts, true, true );
			
			return hendon_core_get_template_part( 'shortcodes/image-marquee', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

        private function get_holder_classes( $atts ) {
            $holder_classes = $this->init_holder_classes();
            $holder_classes[] = 'qodef-image-marquee';
            $holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
            return implode( ' ', $holder_classes );
        }
        private function generate_image_params( $atts ) {
            $image = array();
            if ( ! empty( $atts['image'] ) ) {
                $id = $atts['image'];
                $image['image_id']      = intval( $id );
                $image_original         = wp_get_attachment_image_src( $id, 'full' );
                $image['url']           = $image_original[0];
                $image['image_size']    = 'full';
                $image['height']        = wp_get_attachment_image_src( $id, 'full' )[2] . 'px';
                $image['mobile_height'] = ( wp_get_attachment_image_src( $id, 'full' )[2] / 2 ) . 'px';
            }
            return $image;
        }
        private function get_duration( $atts ) {
            $duration = $atts['duration'];
            return $duration;
        }
        private function get_image_inline_style( $atts, $is_copy = false, $is_mobile = false ) {
            $image_id   = $atts['image'];
            $duration   = $atts['duration'];
            $image_size = 'full';
            $image_src = wp_get_attachment_image_src( $image_id, $image_size )[0];
            if ( $is_mobile ) {
                $image_width  = ( wp_get_attachment_image_src( $image_id, $image_size )[1] / 2 ) . 'px';
                $image_height = ( wp_get_attachment_image_src( $image_id, $image_size )[2] / 2 ) . 'px';
            } else {
                $image_width  = wp_get_attachment_image_src( $image_id, $image_size )[1] . 'px';
                $image_height = wp_get_attachment_image_src( $image_id, $image_size )[2] . 'px';
            }
            $style = "";
            $style .= "width: " . $image_width . "; ";
            $style .= "height: " . $image_height . "; ";
            $style .= "animation: qodefMoveMarquee " . $duration . "s linear infinite; ";
            if ( $is_copy ) {
                $style .= "animation-name:qodefMoveMarqueeCopy;";
            }
            $style .= "background: url('" . $image_src . "')";
            return $style;
        }
    }
}