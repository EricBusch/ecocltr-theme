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
 * Add custom CSS for Contact Form 7.
 *
 * @since 1.0.0
 */
function ecocltr_cf7_custom_styles() {
	?>
	<style>
		/* CF7 Form wrapper */
		.wpcf7 .wpcf7-form {
			display: block;
		}

		/* CF7 Form groups - override default CF7 margins */
		.wpcf7 .wpcf7-form p {
			margin: 0 !important;
		}

		/* CF7 Form controls wrapper */
		.wpcf7 .wpcf7-form .wpcf7-form-control-wrap {
			display: block;
			margin: 0 !important;
		}

		/* CF7 Labels */
		.wpcf7 .wpcf7-form label {
			display: block;
			font-size: 0.875rem;
			font-weight: 600;
			color: #1C1917;
			margin-bottom: 0.5rem;
		}

		/* Required asterisk */
		.wpcf7 .wpcf7-form .required {
			color: #7F1B20;
		}

		/* Optional text */
		.wpcf7 .wpcf7-form .optional {
			color: rgba(28, 25, 23, 0.6);
			font-weight: 400;
			font-size: 0.75rem;
			margin-left: 0.25rem;
		}

		/* CF7 Input fields */
		.wpcf7 .wpcf7-form input[type="text"],
		.wpcf7 .wpcf7-form input[type="email"],
		.wpcf7 .wpcf7-form input[type="tel"],
		.wpcf7 .wpcf7-form textarea {
			width: 100%;
			padding: 0.75rem 1rem;
			border: 1px solid rgba(28, 25, 23, 0.2);
			border-radius: 0.5rem;
			transition: box-shadow 0.2s;
			margin: 0;
		}

		.wpcf7 .wpcf7-form input[type="text"]:focus,
		.wpcf7 .wpcf7-form input[type="email"]:focus,
		.wpcf7 .wpcf7-form input[type="tel"]:focus,
		.wpcf7 .wpcf7-form textarea:focus {
			outline: none;
			box-shadow: 0 0 0 2px #7F1B20;
			border-color: transparent;
		}

		/* Textarea specific */
		.wpcf7 .wpcf7-form textarea {
			resize: vertical;
			min-height: 144px;
		}

		/* CF7 Submit button */
		.wpcf7 .wpcf7-form input[type="submit"] {
			width: 100%;
			background-color: #7F1B20;
			color: #F5F5F4;
			font-weight: 600;
			padding: 1rem 1.5rem;
			border-radius: 0.5rem;
			border: none;
			cursor: pointer;
			transition: background-color 0.2s;
			margin: 0;
		}

		.wpcf7 .wpcf7-form input[type="submit"]:hover {
			background-color: rgba(127, 27, 32, 0.9);
		}

		.wpcf7 .wpcf7-form input[type="submit"]:focus {
			outline: none;
			box-shadow: 0 0 0 2px #7F1B20, 0 0 0 4px rgba(127, 27, 32, 0.2);
		}

		/* CF7 Response messages */
		.wpcf7 .wpcf7-response-output {
			border-radius: 0.5rem;
			padding: 1.5rem;
			margin-top: 1.5rem !important;
		}

		.wpcf7 .wpcf7-mail-sent-ok {
			background-color: rgba(178, 195, 152, 0.2);
			border: 1px solid #B2C398;
			color: #404524;
		}

		.wpcf7 .wpcf7-validation-errors,
		.wpcf7 .wpcf7-acceptance-missing {
			background-color: rgba(127, 27, 32, 0.1);
			border: 1px solid rgba(127, 27, 32, 0.2);
			color: #7F1B20;
		}

		/* CF7 Validation errors */
		.wpcf7 .wpcf7-not-valid-tip {
			color: #7F1B20;
			font-size: 0.875rem;
			margin-top: 0.25rem;
			display: block;
		}

		/* CF7 Spinner */
		.wpcf7 .wpcf7-spinner {
			margin: 0 !important;
		}

		/* Turnstile widget container */
		.wpcf7 .wpcf7-form .cf-turnstile {
			margin: 0;
		}

		/* Screen reader text */
		.wpcf7 .wpcf7-form .screen-reader-response {
			position: absolute;
			left: -9999px;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'ecocltr_cf7_custom_styles' );

/**
 * Disable CF7 default styles.
 *
 * @since 1.0.0
 */
function ecocltr_cf7_disable_default_styles() {
	wp_dequeue_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'ecocltr_cf7_disable_default_styles', 100 );

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
 * @param string $message Success message.
 * @return string Modified message.
 */
function ecocltr_cf7_success_message( $message ) {
	$message = esc_html__( 'Thank you for your message! We\'ve received your inquiry and will get back to you as soon as possible.', 'ecocltr' );
	return $message;
}
add_filter( 'wpcf7_display_message', 'ecocltr_cf7_success_message' );

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
