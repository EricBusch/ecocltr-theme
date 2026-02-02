<?php
/**
 * Testimonials Custom Post Type registration.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

/**
 * Register Testimonials custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_register_testimonial_post_type() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'ecocltr' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'ecocltr' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'ecocltr' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'ecocltr' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'ecocltr' ),
		'add_new_item'       => __( 'Add New Testimonial', 'ecocltr' ),
		'new_item'           => __( 'New Testimonial', 'ecocltr' ),
		'edit_item'          => __( 'Edit Testimonial', 'ecocltr' ),
		'view_item'          => __( 'View Testimonial', 'ecocltr' ),
		'all_items'          => __( 'All Testimonials', 'ecocltr' ),
		'search_items'       => __( 'Search Testimonials', 'ecocltr' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'ecocltr' ),
		'not_found'          => __( 'No testimonials found.', 'ecocltr' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash.', 'ecocltr' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Client testimonials and reviews.', 'ecocltr' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array( 'title' ),
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'ecocltr_register_testimonial_post_type' );
