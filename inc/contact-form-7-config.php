<?php
/**
 * Contact Form 7 Configuration.
 *
 * Custom styling and configuration for Contact Form 7 forms.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

/**
 * Enqueue custom CF7 styles and disable default CF7 stylesheet.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_cf7_enqueue_styles() {
	// Disable default CF7 styles.
	wp_dequeue_style( 'contact-form-7' );

	// Only enqueue custom styles on pages with a CF7 form.
	if ( ! class_exists( 'WPCF7' ) ) {
		return;
	}

	wp_enqueue_style(
		'ecocltr-cf7',
		get_template_directory_uri() . '/resources/css/cf7.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'ecocltr_cf7_enqueue_styles', 100 );

/**
 * Configure CF7 email recipient from ACF options.
 *
 * @since 1.0.0
 *
 * @param array $components Form components.
 * @param int   $contact_form Contact form ID.
 * @return array Modified components.
 */
function ecocltr_cf7_dynamic_email_recipient( $components, $contact_form ) {
	// Get business email from ACF options.
	$business_email = get_field( 'business_email', 'option' );

	if ( $business_email ) {
		$components['recipient'] = $business_email;
	}

	return $components;
}
add_filter( 'wpcf7_mail_components', 'ecocltr_cf7_dynamic_email_recipient', 10, 2 );

/**
 * Customize CF7 success message.
 *
 * @since 1.0.0
 *
 * @param string $message Message text.
 * @param string $status  Message status key.
 * @return string Modified message.
 */
function ecocltr_cf7_success_message( $message, $status ) {
	if ( 'mail_sent_ok' === $status ) {
		$message = __( 'Thank you for your message! We\'ve received your inquiry and will get back to you as soon as possible.', 'ecocltr' );
	}
	return $message;
}
add_filter( 'wpcf7_display_message', 'ecocltr_cf7_success_message', 10, 2 );

/**
 * Check if the current environment is local/development.
 *
 * @since 1.0.0
 *
 * @return bool True if local environment, false otherwise.
 */
function ecocltr_is_local_environment() {
	$server_name = isset( $_SERVER['SERVER_NAME'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ) : '';
	$host        = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';

	// Common local development indicators.
	$local_indicators = array(
		'localhost',
		'127.0.0.1',
		'.test',
		'.local',
		'.dev',
		'::1',
	);

	foreach ( $local_indicators as $indicator ) {
		if ( false !== strpos( $server_name, $indicator ) || false !== strpos( $host, $indicator ) ) {
			return true;
		}
	}

	// Check for common local environment constants.
	if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV ) {
		return true;
	}

	if ( defined( 'WP_ENVIRONMENT_TYPE' ) && in_array( WP_ENVIRONMENT_TYPE, array( 'local', 'development' ), true ) ) {
		return true;
	}

	return false;
}

/**
 * Use Turnstile test keys in local environments.
 *
 * Automatically uses Cloudflare's test keys for local development,
 * allowing form testing without needing production keys configured.
 *
 * @since 1.0.0
 *
 * @param string $sitekey The original sitekey.
 * @return string Test sitekey if local, original otherwise.
 */
function ecocltr_turnstile_local_sitekey( $sitekey ) {
	if ( ecocltr_is_local_environment() ) {
		// Cloudflare Turnstile test site key (always passes).
		return '1x00000000000000000000AA';
	}

	return $sitekey;
}
add_filter( 'wpcf7_turnstile_sitekey', 'ecocltr_turnstile_local_sitekey' );

/**
 * Use Turnstile test secret in local environments.
 *
 * Automatically uses Cloudflare's test secret key for local development,
 * allowing form testing without needing production keys configured.
 *
 * @since 1.0.0
 *
 * @param string $secret The original secret key.
 * @return string Test secret if local, original otherwise.
 */
function ecocltr_turnstile_local_secret( $secret ) {
	if ( ecocltr_is_local_environment() ) {
		// Cloudflare Turnstile test secret key (always passes).
		return '1x0000000000000000000000000000000AA';
	}

	return $secret;
}
add_filter( 'wpcf7_turnstile_secret', 'ecocltr_turnstile_local_secret' );
