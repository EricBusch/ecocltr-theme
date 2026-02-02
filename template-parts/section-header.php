<?php
/**
 * Reusable section header component.
 *
 * Displays eyebrow text, heading, and optional description
 * with consistent styling across all pages.
 *
 * @package Ecocltr
 * @since 1.0.0
 *
 * @param array $args {
 *     Template arguments.
 *
 *     @type string $eyebrow     Eyebrow text (small, uppercase, burgundy).
 *     @type string $heading     Main heading text.
 *     @type string $description Optional. Description text below heading.
 * }
 */

$eyebrow     = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$heading     = isset( $args['heading'] ) ? $args['heading'] : '';
$description = isset( $args['description'] ) ? $args['description'] : '';

if ( ! $heading ) {
	return;
}
?>

<div class="max-w-2xl mx-auto text-center mb-12 md:mb-16">
	<?php if ( $eyebrow ) : ?>
		<p class="text-sm uppercase tracking-widest text-burgundy mb-3">
			<?php echo esc_html( $eyebrow ); ?>
		</p>
	<?php endif; ?>

	<h2 class="text-pretty text-2xl md:text-3xl font-bold text-dark mb-4">
		<?php echo esc_html( $heading ); ?>
	</h2>

	<?php if ( $description ) : ?>
		<p class="text-balance text-lg text-dark/60 leading-relaxed">
			<?php echo esc_html( $description ); ?>
		</p>
	<?php endif; ?>
</div>
