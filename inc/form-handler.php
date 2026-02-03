<?php
/**
 * Contact form handler with ALTCHA validation.
 *
 * DEPRECATED: This file is no longer used. Contact forms now use Contact Form 7.
 * Keeping this file for reference only.
 *
 * @package Ecocltr
 * @since   1.0.0
 * @deprecated 1.0.0 Use Contact Form 7 instead.
 */

/*
 * Old StaticForms handler - no longer in use.
 *
 * This code is commented out as the site now uses Contact Form 7.
 * Kept for reference only.
 *

function ecocltr_handle_contact_form()
{
    // Check if this is a contact form submission.
    if (! isset($_POST['ecocltr_contact_form']) || '1' !== $_POST['ecocltr_contact_form'] ) {
        return;
    }

    // Verify nonce.
    if (! isset($_POST['ecocltr_contact_nonce']) || ! wp_verify_nonce($_POST['ecocltr_contact_nonce'], 'ecocltr_contact_form') ) {
        wp_die(esc_html__('Security verification failed. Please try again.', 'ecocltr'), esc_html__('Security Error', 'ecocltr'), array( 'response' => 403 ));
    }

    // Validate ALTCHA if the plugin is active.
    if (function_exists('altcha_validate') ) {
        $altcha_payload = isset($_POST['altcha']) ? sanitize_text_field(wp_unslash($_POST['altcha'])) : '';

        if (! altcha_validate($altcha_payload) ) {
            wp_die(
                esc_html__('Captcha validation failed. Please try again.', 'ecocltr'),
                esc_html__('Validation Error', 'ecocltr'),
                array(
                'response'  => 400,
                'back_link' => true,
                )
            );
        }
    }

    // Get Static Forms API key.
    $api_key = ecocltr_get_staticforms_api_key();

    if (! $api_key ) {
        wp_die(esc_html__('Form configuration error. Please contact the site administrator.', 'ecocltr'), esc_html__('Configuration Error', 'ecocltr'), array( 'response' => 500 ));
    }

    // Prepare form data for Static Forms.
    $form_data = array(
    'accessKey' => $api_key,
    'name'      => isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '',
    'email'     => isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '',
    'phone'     => isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '',
    'message'   => isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '',
    'subject'   => sprintf(__('New Contact Form Submission from %s', 'ecocltr'), get_bloginfo('name')),
    'replyTo'   => '@',
    );

    // Submit to Static Forms API.
    $response = wp_remote_post(
        'https://api.staticforms.xyz/submit',
        array(
        'body'    => $form_data,
        'timeout' => 30,
        )
    );

    // Handle response.
    if (is_wp_error($response) ) {
        wp_die(esc_html__('Failed to send message. Please try again later.', 'ecocltr'), esc_html__('Submission Error', 'ecocltr'), array( 'response' => 500, 'back_link' => true ));
    }

    $response_code = wp_remote_retrieve_response_code($response);

    if (200 !== $response_code ) {
        wp_die(esc_html__('Failed to send message. Please try again later.', 'ecocltr'), esc_html__('Submission Error', 'ecocltr'), array( 'response' => $response_code, 'back_link' => true ));
    }

    // Redirect to success page.
    $redirect_url = add_query_arg('submitted', 'true', wp_get_referer());
    wp_safe_redirect($redirect_url);
    exit;
}
add_action('admin_post_nopriv_ecocltr_contact', 'ecocltr_handle_contact_form');
add_action('admin_post_ecocltr_contact', 'ecocltr_handle_contact_form');
*/
