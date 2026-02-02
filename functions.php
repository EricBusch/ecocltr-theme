<?php
/**
 * Ecocltr theme functions and definitions.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

if ( is_file( __DIR__ . '/vendor/autoload_packages.php' ) ) {
	require_once __DIR__ . '/vendor/autoload_packages.php';
}

/**
 * Include custom post types.
 */
require_once __DIR__ . '/inc/custom-post-types/services.php';
require_once __DIR__ . '/inc/custom-post-types/projects.php';
require_once __DIR__ . '/inc/custom-post-types/testimonials.php';

/**
 * Include taxonomies.
 */
require_once __DIR__ . '/inc/taxonomies/service-category.php';

/**
 * Include ACF field groups.
 */
require_once __DIR__ . '/inc/acf/field-groups.php';

/**
 * Include helper functions.
 */
require_once __DIR__ . '/inc/helpers/template-functions.php';

/**
 * Initialize the theme.
 *
 * @since 1.0.0
 *
 * @return TailPress\Framework\Theme Theme instance.
 */
function ecocltr(): TailPress\Framework\Theme {
	return TailPress\Framework\Theme::instance()
		->assets(
			fn( $manager ) => $manager
			->withCompiler(
				new TailPress\Framework\Assets\ViteCompiler(),
				fn( $compiler ) => $compiler
				->registerAsset( 'resources/css/app.css' )
				->registerAsset( 'resources/js/app.js' )
				->editorStyleFile( 'resources/css/editor-style.css' )
			)
			->enqueueAssets()
		)
		->features( fn( $manager ) => $manager->add( TailPress\Framework\Features\MenuOptions::class ) )
		->menus( fn( $manager ) => $manager->add( 'primary', __( 'Primary Menu', 'ecocltr' ) ) )
		->themeSupport(
			fn( $manager ) => $manager->add(
				array(
					'title-tag',
					'custom-logo',
					'post-thumbnails',
					'align-wide',
					'wp-block-styles',
					'responsive-embeds',
					'html5' => array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
					),
				)
			)
		);
}

ecocltr();

/**
 * Enqueue FSLightbox script on single project pages.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_enqueue_lightbox() {
	if ( is_singular( 'project' ) ) {
		wp_enqueue_script(
			'fslightbox',
			'https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.4.1/index.min.js',
			array(),
			'3.4.1',
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ecocltr_enqueue_lightbox' );

/**
 * Load theme text domain for translations.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_load_textdomain() {
	load_theme_textdomain( 'ecocltr', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'ecocltr_load_textdomain' );

/**
 * Flush rewrite rules on theme activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_flush_rewrite_rules() {
	// Register CPTs first.
	ecocltr_register_service_post_type();
	ecocltr_register_project_post_type();
	ecocltr_register_testimonial_post_type();
	ecocltr_register_service_category_taxonomy();

	// Flush rewrite rules.
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ecocltr_flush_rewrite_rules' );
