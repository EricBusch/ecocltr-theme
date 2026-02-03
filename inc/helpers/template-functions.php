<?php
/**
 * Template helper functions.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

/**
 * Get a random testimonial.
 *
 * @since 1.0.0
 *
 * @return WP_Post|null Random testimonial post object or null if none found.
 */
function ecocltr_get_random_testimonial()
{
    $testimonials = get_posts(
        array(
        'post_type'      => 'testimonial',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
        )
    );

    return ! empty($testimonials) ? $testimonials[0] : null;
}

/**
 * Display a testimonial.
 *
 * @since 1.0.0
 *
 * @param  int|null $post_id Optional. Testimonial post ID. If null, displays a random testimonial.
 * @return void
 */
function ecocltr_display_testimonial( $post_id = null )
{
    if (null === $post_id ) {
        $testimonial = ecocltr_get_random_testimonial();
        if (! $testimonial ) {
            return;
        }
        $post_id = $testimonial->ID;
    }

    $quote       = get_field('testimonial_quote', $post_id);
    $client_name = get_field('testimonial_client_name', $post_id);

    if (! $quote ) {
        return;
    }

    get_template_part(
        'template-parts/block',
        'testimonial',
        array(
        'quote'       => $quote,
        'client_name' => $client_name,
        )
    );
}

/**
 * Get services by category.
 *
 * @since 1.0.0
 *
 * @param  int $term_id        Service category term ID.
 * @param  int $posts_per_page Optional. Number of posts to return. Default -1 (all).
 * @return WP_Post[] Array of service post objects.
 */
function ecocltr_get_services_by_category( $term_id, $posts_per_page = -1 )
{
    return get_posts(
        array(
        'post_type'      => 'service',
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
        'tax_query'      => array(
                array(
                    'taxonomy' => 'service_category',
                    'field'    => 'term_id',
                    'terms'    => $term_id,
                ),
        ),
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        )
    );
}

/**
 * Get related projects for a service (uses bidirectional field).
 *
 * @since 1.0.0
 *
 * @param  int $service_id Service post ID.
 * @return WP_Post[] Array of project post objects.
 */
function ecocltr_get_related_projects( $service_id )
{
    $related_projects = get_field('service_related_projects', $service_id);

    if (! $related_projects || ! is_array($related_projects) ) {
        return array();
    }

    return $related_projects;
}

/**
 * Get related services for a project.
 *
 * @since 1.0.0
 *
 * @param  int $project_id Project post ID.
 * @return WP_Post[] Array of service post objects.
 */
function ecocltr_get_related_services( $project_id )
{
    $related_services = get_field('project_services', $project_id);

    if (! $related_services || ! is_array($related_services) ) {
        return array();
    }

    return $related_services;
}

/**
 * Get related services for a service (bidirectional).
 *
 * @since 1.0.0
 *
 * @param  int $service_id Service post ID.
 * @return WP_Post[] Array of related service post objects.
 */
function ecocltr_get_related_services_for_service( $service_id )
{
    $related_services = get_field('related_services', $service_id);

    if (! $related_services || ! is_array($related_services) ) {
        return array();
    }

    return $related_services;
}

/**
 * Get recent projects.
 *
 * @since 1.0.0
 *
 * @param  int $count Number of projects to return.
 * @return WP_Post[] Array of project post objects.
 */
function ecocltr_get_recent_projects( $count = 4 )
{
    return get_posts(
        array(
        'post_type'      => 'project',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'meta_key'       => 'project_year',
        'orderby'        => 'meta_value',
        'order'          => 'DESC',
        )
    );
}

/**
 * Get all service categories.
 *
 * @since 1.0.0
 *
 * @return WP_Term[] Array of service category term objects.
 */
function ecocltr_get_service_categories()
{
    return get_terms(
        array(
        'taxonomy'   => 'service_category',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
        )
    );
}

/**
 * Get the first service thumbnail for a category (to use as category image).
 *
 * @since 1.0.0
 *
 * @param  int $term_id Service category term ID.
 * @return string|false Thumbnail URL or false if not found.
 */
function ecocltr_get_category_thumbnail( $term_id )
{
    $services = ecocltr_get_services_by_category($term_id, 1);

    if (empty($services) ) {
        return false;
    }

    $thumbnail_id = get_post_thumbnail_id($services[0]->ID);

    if (! $thumbnail_id ) {
        return false;
    }

    $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'medium_large');

    return $thumbnail ? $thumbnail[0] : false;
}

/**
 * Get ACF field with fallback.
 *
 * @since 1.0.0
 *
 * @param  string $field_name Field name.
 * @param  mixed  $post_id    Optional. Post ID or 'options'. Default false.
 * @param  mixed  $default    Optional. Default value if field is empty. Default empty string.
 * @return mixed Field value or default.
 */
function ecocltr_get_field( $field_name, $post_id = false, $default = '' )
{
    if (! function_exists('get_field') ) {
        return $default;
    }

    $value = get_field($field_name, $post_id);

    return $value ? $value : $default;
}

/**
 * Get the contact page URL.
 *
 * @since 1.0.0
 *
 * @return string Contact page URL or home URL if not found.
 */
function ecocltr_get_contact_url()
{
    $contact_page = get_page_by_path('contact');

    if ($contact_page ) {
        return get_permalink($contact_page->ID);
    }

    return home_url('/contact/');
}

/**
 * Get other services in the same category (excluding current).
 *
 * @since 1.0.0
 *
 * @param  int $service_id Current service post ID.
 * @param  int $count      Optional. Number of services to return. Default 3.
 * @return WP_Post[] Array of service post objects.
 */
function ecocltr_get_related_services_by_category( $service_id, $count = 3 )
{
    $terms = get_the_terms($service_id, 'service_category');

    if (! $terms || is_wp_error($terms) ) {
        return array();
    }

    $term_ids = wp_list_pluck($terms, 'term_id');

    return get_posts(
        array(
        'post_type'      => 'service',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'post__not_in'   => array( $service_id ),
        'tax_query'      => array(
                array(
                    'taxonomy' => 'service_category',
                    'field'    => 'term_id',
                    'terms'    => $term_ids,
                ),
        ),
        'orderby'        => 'rand',
        )
    );
}

/**
 * Get business information field from options.
 *
 * @since 1.0.0
 *
 * @param  string $field_name Field name.
 * @param  mixed  $default    Optional. Default value if field is empty. Default empty string.
 * @return mixed Field value or default.
 */
function ecocltr_get_business_info( $field_name, $default = '' )
{
    return ecocltr_get_field($field_name, 'option', $default);
}

/**
 * Render an obfuscated email address using the Email Obfuscator plugin.
 *
 * @since 1.0.0
 *
 * @param  string $email   Email address to obfuscate.
 * @param  string $text    Optional. Display text. Default is the email address.
 * @param  bool   $link    Optional. Whether to render as a link. Default true.
 * @param  string $title   Optional. Title attribute for the link. Default empty.
 * @param  string $classes Optional. CSS classes to add to the wrapper. Default empty.
 * @return string Obfuscated email HTML or empty string if email is invalid.
 */
function ecocltr_obfuscate_email( $email, $text = '', $link = true, $title = '', $classes = '' )
{
    if (empty($email) || ! is_email($email) ) {
        return '';
    }

    // Build shortcode attributes.
    $atts = array(
    'address' => $email,
    'link'    => $link ? 'true' : 'false',
    );

    if (! empty($text) ) {
        $atts['text'] = $text;
    }

    if (! empty($title) ) {
        $atts['title'] = $title;
    }

    // Build shortcode string.
    $shortcode_atts = '';
    foreach ( $atts as $key => $value ) {
        $shortcode_atts .= sprintf(' %s="%s"', $key, esc_attr($value));
    }

    $output = do_shortcode("[email{$shortcode_atts}]");

    // Add custom classes if provided.
    if (! empty($classes) && ! empty($output) ) {
        $output = str_replace('class="eo-wrap"', 'class="eo-wrap ' . esc_attr($classes) . '"', $output);
    }

    return $output;
}

/**
 * Display an obfuscated email address.
 *
 * @since 1.0.0
 *
 * @param  string $email   Email address to obfuscate.
 * @param  string $text    Optional. Display text. Default is the email address.
 * @param  bool   $link    Optional. Whether to render as a link. Default true.
 * @param  string $title   Optional. Title attribute for the link. Default empty.
 * @param  string $classes Optional. CSS classes to add to the wrapper. Default empty.
 * @return void
 */
function ecocltr_display_obfuscated_email( $email, $text = '', $link = true, $title = '', $classes = '' )
{
    echo ecocltr_obfuscate_email($email, $text, $link, $title, $classes); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Sanitize a phone number for use in a tel: href attribute.
 *
 * Strips all characters except digits and the plus sign,
 * producing a valid tel: URI value.
 *
 * @since 1.0.0
 *
 * @param  string $phone Raw phone number string.
 * @return string Sanitized phone number containing only digits and +.
 */
function ecocltr_phone_href( $phone ) {
    return preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Render an SVG icon from the resources/svg directory.
 *
 * Loads an SVG file by name and injects optional CSS classes.
 * Icons are stored in resources/svg/{name}.svg and can be
 * swapped by replacing the file.
 *
 * @since 1.0.0
 *
 * @param  string $name  Icon filename without extension.
 * @param  string $class Optional. CSS classes to add to the SVG element. Default empty.
 * @return string SVG markup or empty string if file not found.
 */
function ecocltr_icon( $name, $class = '' ) {
	$file = get_template_directory() . '/resources/svg/' . $name . '.svg';

	if ( ! file_exists( $file ) ) {
		return '';
	}

	$svg = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	if ( $class ) {
		$svg = str_replace( '<svg ', '<svg class="' . esc_attr( $class ) . '" ', $svg );
	}

	// Add aria-hidden for decorative icons.
	if ( false === strpos( $svg, 'aria-' ) ) {
		$svg = str_replace( '<svg ', '<svg aria-hidden="true" ', $svg );
	}

	return $svg;
}

/**
 * Display an SVG icon from the resources/svg directory.
 *
 * @since 1.0.0
 *
 * @param  string $name  Icon filename without extension.
 * @param  string $class Optional. CSS classes to add to the SVG element. Default empty.
 * @return void
 */
function ecocltr_display_icon( $name, $class = '' ) {
	echo ecocltr_icon( $name, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

