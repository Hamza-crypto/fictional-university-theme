<?php

require_once __DIR__ . "/vendor/autoload.php"; 

function university_files() {

  wp_enqueue_script('university_main_javascript', get_theme_file_uri('/build/index.js'), ['jquery'], '1.1', true);
  
  wp_enqueue_style('custom-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_theme_file_uri( '/build/style-index.css' ));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri( '/build/index.css' ));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features(){
  add_theme_support( 'title-tag');
}
add_action('after_setup_theme', 'university_features');


function meks_which_template_is_loaded() {
	if ( is_super_admin() ) {
		global $template;
		// print_r( $template );
    dump($template);
	}
}
 
add_action( 'wp_footer', 'meks_which_template_is_loaded' );