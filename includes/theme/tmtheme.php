<?php

/*add_action( 'init', 'tmtheme_post_type' );
function tmtheme_post_type() {
	$labels = array(
		'name' => 'Список преимуществ',
		//'singular_name' => __('Carousel Image', 'cpt-bootstrap-carousel'),
		'add_new' => 'Добавить',
		'add_new_item' => 'Добавить преимущество',
		'edit_item' => 'Редактировать преимущество',
		//'new_item' => __('New Carousel Image', 'cpt-bootstrap-carousel'),
		//'view_item' => __('View Carousel Image', 'cpt-bootstrap-carousel'),
		'search_items' => 'Искать преимущество',
		'not_found' => 'Преимущество не найдено',
		//'not_found_in_trash' => __('No Carousel Images found in Trash', 'cpt-bootstrap-carousel'),
		'parent_item_colon' => '',
		'menu_name' => 'Преимущества'
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
		'menu_icon' => 'dashicons-thumbs-up',
		'supports' => array('title','excerpt','page-attributes')
	); 
	register_post_type('tmtheme', $args);
}*/

// Load in the pages doing everything else!
require_once('tmtheme-settings.php');
require_once('tmtheme-frontend.php');

