<?php

if ( ! function_exists( 'hendon_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function hendon_child_theme_enqueue_scripts() {
		$main_style = 'hendon-main';
		
		wp_enqueue_style( 'hendon-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'hendon_child_theme_enqueue_scripts' );
}