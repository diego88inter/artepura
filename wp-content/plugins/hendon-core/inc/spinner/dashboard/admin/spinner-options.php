<?php

if ( ! function_exists( 'hendon_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function hendon_core_add_page_spinner_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'hendon-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'hendon-core' ),
					'default_value' => 'no'
				)
			);
			
			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'hendon-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'hendon-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'hendon-core' ),
					'options'       => apply_filters( 'hendon_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'hendon_core_filter_page_spinner_default_layout_option', '' ),
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'hendon-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'hendon-core' )
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'hendon-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'hendon-core' )
				)
			);

			$spinner_section->add_field_element(
                array(
					'field_type' => 'text',
					'name'       => 'qodef_spinner_text',
					'title'      => esc_html__( 'Hendon Spinner Text', 'hendon-core' ),
                    'dependency'  => array(
                        'show' => array(
                            'qodef_page_spinner_type' => array(
                                'values'        => 'hendon',
                                'default_value' => ''
                            )
                        )
                    )
                )
            );
		}
	}
	
	add_action( 'hendon_core_action_after_general_options_map', 'hendon_core_add_page_spinner_options' );
}