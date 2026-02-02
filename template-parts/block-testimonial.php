<?php
/**
 * Template part for displaying a testimonial block.
 *
 * @package Ecocltr
 * @since 1.0.0
 *
 * @param array $args {
 *     Template arguments.
 *
 *     @type string $quote       The testimonial quote.
 *     @type string $client_name The client name.
 * }
 */

$quote       = isset( $args['quote'] ) ? $args['quote'] : '';
$client_name = isset( $args['client_name'] ) ? $args['client_name'] : '';

if ( ! $quote ) {
	return;
}
?>

<blockquote class="bg-sage/20 rounded-lg p-8 md:p-10 relative">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-sage absolute top-6 left-6 opacity-50" aria-hidden="true">
		<path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.75 6.75 0 0 0 6.75-6.75v-.006c-.023-2.24-.163-4.56-1.025-6.672-1.008-2.468-2.996-4.553-6.452-5.55a.75.75 0 0 0-.458 1.428c2.886.83 4.372 2.514 5.14 4.394.538 1.318.753 2.762.856 4.206A6.75 6.75 0 0 0 6 9c-2.017 0-3.834.888-5.072 2.294a6.719 6.719 0 0 0-1.672 4.456c0 1.854.75 3.535 1.964 4.75l.612.619a6.752 6.752 0 0 0 2.972.525ZM12.75 21a6.75 6.75 0 0 0 6.75-6.75v-.006c-.023-2.24-.163-4.56-1.025-6.672-1.008-2.468-2.996-4.553-6.452-5.55a.75.75 0 1 0-.458 1.428c2.886.83 4.372 2.514 5.14 4.394.538 1.318.753 2.762.856 4.206A6.75 6.75 0 0 0 12.75 9a6.721 6.721 0 0 0-5.072 2.294 6.719 6.719 0 0 0-1.672 4.456 6.75 6.75 0 0 0 6.75 6.75Z" clip-rule="evenodd" />
	</svg>

	<div class="relative z-10 pt-8">
		<p class="text-lg md:text-xl text-dark leading-relaxed italic">
			<?php echo esc_html( $quote ); ?>
		</p>

		<?php if ( $client_name ) : ?>
			<footer class="mt-6">
				<cite class="not-italic text-olive font-semibold">
					&mdash; <?php echo esc_html( $client_name ); ?>
				</cite>
			</footer>
		<?php endif; ?>
	</div>
</blockquote>
