<?php
/**
 * Service Category taxonomy registration.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

/**
 * Register Service Category taxonomy.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_register_service_category_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Service Categories', 'taxonomy general name', 'ecocltr' ),
		'singular_name'              => _x( 'Service Category', 'taxonomy singular name', 'ecocltr' ),
		'search_items'               => __( 'Search Service Categories', 'ecocltr' ),
		'popular_items'              => __( 'Popular Service Categories', 'ecocltr' ),
		'all_items'                  => __( 'All Service Categories', 'ecocltr' ),
		'parent_item'                => __( 'Parent Service Category', 'ecocltr' ),
		'parent_item_colon'          => __( 'Parent Service Category:', 'ecocltr' ),
		'edit_item'                  => __( 'Edit Service Category', 'ecocltr' ),
		'view_item'                  => __( 'View Service Category', 'ecocltr' ),
		'update_item'                => __( 'Update Service Category', 'ecocltr' ),
		'add_new_item'               => __( 'Add New Service Category', 'ecocltr' ),
		'new_item_name'              => __( 'New Service Category Name', 'ecocltr' ),
		'separate_items_with_commas' => __( 'Separate service categories with commas', 'ecocltr' ),
		'add_or_remove_items'        => __( 'Add or remove service categories', 'ecocltr' ),
		'choose_from_most_used'      => __( 'Choose from the most used service categories', 'ecocltr' ),
		'not_found'                  => __( 'No service categories found.', 'ecocltr' ),
		'no_terms'                   => __( 'No service categories', 'ecocltr' ),
		'menu_name'                  => __( 'Categories', 'ecocltr' ),
		'items_list_navigation'      => __( 'Service categories list navigation', 'ecocltr' ),
		'items_list'                 => __( 'Service categories list', 'ecocltr' ),
		'back_to_items'              => __( '&larr; Back to Service Categories', 'ecocltr' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Categories for organizing services.', 'ecocltr' ),
		'hierarchical'       => true,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => true,
		'show_tagcloud'      => false,
		'show_in_quick_edit' => true,
		'show_admin_column'  => true,
		'rewrite'            => array(
			'slug'         => 'service-category',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'service_category', array( 'service' ), $args );
}
add_action( 'init', 'ecocltr_register_service_category_taxonomy' );
