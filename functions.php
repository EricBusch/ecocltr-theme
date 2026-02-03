<?php
/**
 * Ecocltr theme functions and definitions.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

if (is_file(__DIR__ . '/vendor/autoload_packages.php') ) {
    include_once __DIR__ . '/vendor/autoload_packages.php';
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
 * Include Contact Form 7 configuration.
 */
require_once __DIR__ . '/inc/contact-form-7-config.php';

/**
 * Initialize the theme.
 *
 * @since 1.0.0
 *
 * @return TailPress\Framework\Theme Theme instance.
 */
function ecocltr(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(
            fn( $manager ) => $manager
                ->withCompiler(
                    new TailPress\Framework\Assets\ViteCompiler(),
                    fn( $compiler ) => $compiler
                        ->registerAsset('resources/css/app.css')
                        ->registerAsset('resources/js/app.js')
                        ->editorStyleFile('resources/css/editor-style.css')
                )
                ->enqueueAssets()
        )
        ->features(fn( $manager ) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn( $manager ) => $manager->add('primary', 'Primary Menu'))
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
 * Load theme text domain for translations.
 *
 * WordPress 6.7.0+ requires text domain to be loaded on 'init' or later.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_load_textdomain() {
	load_theme_textdomain( 'ecocltr', get_template_directory() . '/languages' );
}
add_action( 'init', 'ecocltr_load_textdomain' );

/**
 * Enqueue self-hosted font stylesheet.
 *
 * Loads fonts locally instead of from Google Fonts CDN
 * for GDPR compliance and improved performance.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_enqueue_fonts() {
	wp_enqueue_style(
		'ecocltr-fonts',
		get_template_directory_uri() . '/resources/css/fonts.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'ecocltr_enqueue_fonts' );

/**
 * Enqueue FSLightbox script on single project pages.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_enqueue_lightbox()
{
    if (is_singular('project') ) {
        wp_enqueue_script(
            'fslightbox',
            get_template_directory_uri() . '/resources/js/fslightbox.js',
            array(),
            '3.8.4',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'ecocltr_enqueue_lightbox');

/**
 * Flush rewrite rules on theme activation.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_flush_rewrite_rules()
{
    // Register CPTs first.
    ecocltr_register_service_post_type();
    ecocltr_register_project_post_type();
    ecocltr_register_testimonial_post_type();
    ecocltr_register_service_category_taxonomy();

    // Flush rewrite rules.
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ecocltr_flush_rewrite_rules');

/**
 * Disable WordPress global styles inline CSS.
 *
 * This removes the inline CSS that WordPress injects with link underline styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_disable_global_styles()
{
    wp_dequeue_style('global-styles');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'ecocltr_disable_global_styles', 100);

/**
 * Modify project archive query to order by date completed.
 *
 * @since 1.0.0
 *
 * @param  WP_Query $query The WordPress query object.
 * @return void
 */
function ecocltr_modify_project_archive_query( $query )
{
    // Only modify the main query on project archives.
    if (! is_admin() && $query->is_main_query() && is_post_type_archive('project') ) {
        $query->set('meta_key', 'project_year');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'ecocltr_modify_project_archive_query');

/**
 * Add font-serif and text size classes to primary menu items.
 *
 * @since 1.0.0
 *
 * @param array    $atts  The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @return array Modified attributes.
 */
function ecocltr_add_menu_link_class( $atts, $item, $args )
{
	if ( 'primary' === $args->theme_location ) {
		$atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' font-serif text-lg' : 'font-serif text-lg';
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'ecocltr_add_menu_link_class', 10, 3);

/**
 * Configure SMTP mailer for local Herd mail server.
 *
 * Only active in local/development environments to route email
 * through the Herd mail server for testing.
 *
 * @since 1.0.0
 *
 * @param PHPMailer $phpmailer PHPMailer instance.
 * @return void
 */
function ecocltr_herd_mailer( $phpmailer ) {
	if ( ! ecocltr_is_local_environment() ) {
		return;
	}

	$phpmailer->isSMTP();
	$phpmailer->Host        = '127.0.0.1';
	$phpmailer->SMTPAuth    = true;
	$phpmailer->Port        = 2525;
	$phpmailer->Username    = 'WordPress';
	$phpmailer->Password    = '';
	$phpmailer->SMTPSecure  = '';
	$phpmailer->SMTPAutoTLS = false;
}
add_action( 'phpmailer_init', 'ecocltr_herd_mailer' );
