<?php
/**
 * Template part for displaying a testimonial in a hero section.
 *
 * Used in archive-project.php and archive-service.php hero sections
 * to display a random client testimonial with a glass-morphism card style.
 *
 * @package Ecocltr
 * @since   1.0.0
 *
 * @param array $args {
 *     Template arguments.
 *
 *     @type WP_Post $testimonial The testimonial post object.
 * }
 */

$testimonial = isset( $args['testimonial'] ) ? $args['testimonial'] : null;

if ( ! $testimonial ) {
	return;
}

$testimonial_quote  = get_field( 'testimonial_quote', $testimonial->ID );
$testimonial_client = get_field( 'testimonial_client_name', $testimonial->ID );

if ( ! $testimonial_quote ) {
	return;
}
?>
<div class="hidden lg:block">
	<div class="bg-white/10 backdrop-blur-sm rounded-lg p-8 border border-white/20 relative max-h-[400px] flex flex-col">
		<!-- Quote Icon -->
		<div class="absolute top-6 left-6 opacity-20">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-white">
				<path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179z"/>
			</svg>
		</div>

		<!-- Testimonial Content -->
		<div class="relative z-10 pt-8 flex-1 flex flex-col">
			<blockquote class="text-white/95 text-base leading-relaxed mb-6 italic line-clamp-6 flex-1">
				"<?php echo esc_html( $testimonial_quote ); ?>"
			</blockquote>

			<?php if ( $testimonial_client ) : ?>
				<div class="border-t border-white/20 pt-4 mt-auto">
					<cite class="not-italic font-semibold text-white block">
						<?php echo esc_html( $testimonial_client ); ?>
					</cite>
					<span class="text-sage/70 text-sm">
						<?php esc_html_e( 'EcoCultures Client', 'ecocltr' ); ?>
					</span>
				</div>
			<?php endif; ?>

			<!-- Decorative Element -->
			<div class="absolute bottom-0 right-0 w-20 h-20 bg-sage/10 rounded-full blur-2xl -z-10"></div>
		</div>
	</div>
</div>
