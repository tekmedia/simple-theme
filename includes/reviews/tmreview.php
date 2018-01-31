<?php

add_action( 'init', 'tmreview_post_type' );
function tmreview_post_type() {
	$labels = array(
		'name' => 'Список отзывов',
		//'singular_name' => __('Carousel Image', 'cpt-bootstrap-carousel'),
		'add_new' => 'Добавить',
		'add_new_item' => 'Добавить отзыв',
		'edit_item' => 'Редактировать отзыв',
		//'new_item' => __('New Carousel Image', 'cpt-bootstrap-carousel'),
		//'view_item' => __('View Carousel Image', 'cpt-bootstrap-carousel'),
		'search_items' => 'Искать отзыв',
		'not_found' => 'Отзыв не найден',
		//'not_found_in_trash' => __('No Carousel Images found in Trash', 'cpt-bootstrap-carousel'),
		'parent_item_colon' => '',
		'menu_name' => 'Отзывы'
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
		'menu_icon' => 'dashicons-admin-comments',
		'supports' => array('title','editor','page-attributes','thumbnail')
	); 
	register_post_type('tmreview', $args);
}

function css_to_wp_head() {
 	wp_enqueue_style( 'wp_head_style', get_stylesheet_directory_uri() . '/includes/reviews/reviews.css', array(), null );
} 
add_action( 'wp_enqueue_scripts', 'css_to_wp_head' );

// Load in the pages doing everything else!
//require_once('tmreview-admin.php');
//require_once('tmreview-settings.php');
require_once('tmreview-frontend.php');

