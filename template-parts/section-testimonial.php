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

$testimonial_quote  = get_field( 'testimonial_quote', $testimonial->ID );
$testimonial_client = get_field( 'testimonial_client_name', $testimonial->ID );

if ( ! $testimonial_quote ) {
	return;
}
?>

<section class="py-16 md:py-24 bg-sage/20">
	<div class="container mx-auto">
		<div class="max-w-4xl mx-auto text-center">
			<!-- Quote Icon -->
			<div class="flex justify-center mb-6">
				<div class="w-16 h-16 bg-olive/10 rounded-full flex items-center justify-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-olive">
						<path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179z"/>
					</svg>
				</div>
			</div>

			<!-- Testimonial Quote -->
			<blockquote class="text-pretty text-xl md:text-2xl text-dark leading-relaxed mb-8 italic font-light">
				"<?php echo esc_html( $testimonial_quote ); ?>"
			</blockquote>

			<!-- Client Attribution -->
			<?php if ( $testimonial_client ) : ?>
				<div class="flex items-center justify-center gap-3">
					<div class="h-px w-12 bg-olive/30"></div>
					<div class="text-center">
						<cite class="not-italic font-semibold text-dark block text-lg">
							<?php echo esc_html( $testimonial_client ); ?>
						</cite>
						<span class="text-dark/60 text-sm">
							<?php esc_html_e( 'EcoCultures Client', 'ecocltr' ); ?>
						</span>
					</div>
					<div class="h-px w-12 bg-olive/30"></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
