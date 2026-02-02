<?php
/**
 * Reusable testimonial section component.
 *
 * Displays a random testimonial in a full-width section.
 * Can be included at the bottom of any page for social proof.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

// Get a random testimonial.
$testimonial = ecocltr_get_random_testimonial();

if ( ! $testimonial ) {
	return;
}
?>

<section class="py-16 md:py-24 bg-white">
	<div class="container mx-auto">
		<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-12 text-center">
			<?php esc_html_e( 'What Our Clients Say', 'ecocltr' ); ?>
		</h2>

		<div class="max-w-3xl mx-auto">
			<?php ecocltr_display_testimonial( $testimonial->ID ); ?>
		</div>
	</div>
</section>
