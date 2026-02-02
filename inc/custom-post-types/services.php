<?php
/**
 * Services Custom Post Type registration.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

/**
 * Register Services custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_register_service_post_type() {
	$labels = array(
		'name'               => _x( 'Services', 'post type general name', 'ecocltr' ),
		'singular_name'      => _x( 'Service', 'post type singular name', 'ecocltr' ),
		'menu_name'          => _x( 'Services', 'admin menu', 'ecocltr' ),
		'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'ecocltr' ),
		'add_new'            => _x( 'Add New', 'service', 'ecocltr' ),
		'add_new_item'       => __( 'Add New Service', 'ecocltr' ),
		'new_item'           => __( 'New Service', 'ecocltr' ),
		'edit_item'          => __( 'Edit Service', 'ecocltr' ),
		'view_item'          => __( 'View Service', 'ecocltr' ),
		'all_items'          => __( 'All Services', 'ecocltr' ),
		'search_items'       => __( 'Search Services', 'ecocltr' ),
		'parent_item_colon'  => __( 'Parent Services:', 'ecocltr' ),
		'not_found'          => __( 'No services found.', 'ecocltr' ),
		'not_found_in_trash' => __( 'No services found in Trash.', 'ecocltr' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Natural landscaping services offered by EcoCultures.', 'ecocltr' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-admin-customizer',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'service', $args );
}
add_action( 'init', 'ecocltr_register_service_post_type' );
