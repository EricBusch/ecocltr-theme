<?php
/**
 * Contact Form Template - Contact Form 7.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

// Check if Contact Form 7 is active.
if ( ! function_exists( 'wpcf7_contact_form' ) ) {
	if ( current_user_can( 'manage_options' ) ) {
		?>
		<div class="bg-burgundy/10 border border-burgundy/20 rounded-lg p-6">
			<p class="text-burgundy">
				<?php
				printf(
					/* translators: %s: Link to plugins page */
					esc_html__( 'Please install and activate the Contact Form 7 plugin to enable the contact form. Visit %s to install it.', 'ecocltr' ),
					'<a href="' . esc_url( admin_url( 'plugins.php' ) ) . '" class="underline font-semibold">' . esc_html__( 'Plugins', 'ecocltr' ) . '</a>'
				);
				?>
			</p>
		</div>
		<?php
	} else {
		?>
		<p class="text-dark/60">
			<?php esc_html_e( 'The contact form is temporarily unavailable. Please try again later.', 'ecocltr' ); ?>
		</p>
		<?php
	}
	return;
}

// Display the Contact Form 7 form.
echo do_shortcode( '[contact-form-7 id="30" title="Contact Form"]' );
