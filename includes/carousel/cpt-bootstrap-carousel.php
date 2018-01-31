<?php

////////////////////////////
// Custom Post Type Setup
////////////////////////////
add_action( 'init', 'cptbc_post_type' );
function cptbc_post_type() {
	$labels = array(
		'name' => 'Список слайдеров',
		'singular_name' => __('Carousel Image', 'cpt-bootstrap-carousel'),
		'add_new' => 'Добавить',
		'add_new_item' => 'Добавить новый слайдер',
		'edit_item' => 'Редактировать слайдер',
		'new_item' => __('New Carousel Image', 'cpt-bootstrap-carousel'),
		'view_item' => __('View Carousel Image', 'cpt-bootstrap-carousel'),
		'search_items' => 'Искать слайдер',
		'not_found' => 'Слайдер не найден',
		'not_found_in_trash' => __('No Carousel Images found in Trash', 'cpt-bootstrap-carousel'),
		'parent_item_colon' => '',
		'menu_name' => 'Слайдшоу'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'page',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 21,
		'menu_icon' => 'dashicons-images-alt',
		'supports' => array('title','excerpt','thumbnail', 'page-attributes')
	); 
	register_post_type('cptbc', $args);
}
// Create a taxonomy for the carousel post type
function cptbc_taxonomies () {
	$args = array('hierarchical' => true);
	register_taxonomy( 'carousel_category', 'cptbc', $args );
}
add_action( 'init', 'cptbc_taxonomies', 0 );


// Add theme support for featured images if not already present
// http://wordpress.stackexchange.com/questions/23839/using-add-theme-support-inside-a-plugin
function cptbc_addFeaturedImageSupport() {
	$supportedTypes = get_theme_support( 'post-thumbnails' );
	if( $supportedTypes === false ) {
		add_theme_support( 'post-thumbnails', array( 'cptbc' ) );	  
		add_image_size('featured_preview', 100, 55, true);
	} elseif( is_array( $supportedTypes ) ) {
		$supportedTypes[0][] = 'cptbc';
		add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		add_image_size('featured_preview', 100, 55, true);
	}
}
add_action( 'after_setup_theme', 'cptbc_addFeaturedImageSupport');

// Load in the pages doing everything else!
require_once('cptbc-admin.php');
require_once('cptbc-settings.php');
require_once('cptbc-frontend.php');

