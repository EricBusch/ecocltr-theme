<?php
/**
 * Projects Custom Post Type registration.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

/**
 * Register Projects custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_register_project_post_type() {
	$labels = array(
		'name'               => _x( 'Projects', 'post type general name', 'ecocltr' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'ecocltr' ),
		'menu_name'          => _x( 'Projects', 'admin menu', 'ecocltr' ),
		'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'ecocltr' ),
		'add_new'            => _x( 'Add New', 'project', 'ecocltr' ),
		'add_new_item'       => __( 'Add New Project', 'ecocltr' ),
		'new_item'           => __( 'New Project', 'ecocltr' ),
		'edit_item'          => __( 'Edit Project', 'ecocltr' ),
		'view_item'          => __( 'View Project', 'ecocltr' ),
		'all_items'          => __( 'All Projects', 'ecocltr' ),
		'search_items'       => __( 'Search Projects', 'ecocltr' ),
		'parent_item_colon'  => __( 'Parent Projects:', 'ecocltr' ),
		'not_found'          => __( 'No projects found.', 'ecocltr' ),
		'not_found_in_trash' => __( 'No projects found in Trash.', 'ecocltr' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Portfolio of completed landscaping projects.', 'ecocltr' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'projects' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'ecocltr_register_project_post_type' );
