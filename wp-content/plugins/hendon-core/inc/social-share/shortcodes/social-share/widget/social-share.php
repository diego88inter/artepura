<?php

if ( ! function_exists( 'hendon_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function hendon_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'HendonCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'hendon_core_filter_register_widgets', 'hendon_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class HendonCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'hendon_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'hendon_core_social_share' );
				$this->set_name( esc_html__( 'Hendon Social Share', 'hendon-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'hendon-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[hendon_core_social_share $params]" ); // XSS OK
		}
	}
}