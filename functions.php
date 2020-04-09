<?php
/**
 * Jogasana Child Theme functions and definitions
 *
 */

if (!function_exists('jogasana_child_css')) {

	function jogasana_child_css() {

		if (!is_admin()) {

		$parent_style = 'jogasana-style';
		
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
		
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version') );

		if ( is_rtl() ) {
			wp_enqueue_style( 'child-style-rtl', get_stylesheet_directory_uri() . '/rtl.css' );
		}
		
		}
		
	}
	
	add_action('wp_enqueue_scripts', 'jogasana_child_css');
}

// don't allow the plugin to embed, we'll do it instead
add_filter( 'cvm_automatic_video_embed' , '__return_false' );