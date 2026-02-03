<?php
/**
 * Template part for displaying a service category card.
 *
 * @package Ecocltr
 * @since 1.0.0
 *
 * @param array $args {
 *     Template arguments.
 *
 *     @type WP_Term $term Service category term object.
 * }
 */

$category_term = isset( $args['term'] ) ? $args['term'] : null;

if ( ! $category_term ) {
	return;
}

$thumbnail_url = ecocltr_get_category_thumbnail( $category_term->term_id );
$service_count = $category_term->count;
?>

<article class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
	<?php if ( $thumbnail_url ) : ?>
		<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="block aspect-video overflow-hidden">
			<img
				src="<?php echo esc_url( $thumbnail_url ); ?>"
				alt="<?php echo esc_attr( $category_term->name ); ?>"
				class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
			>
		</a>
	<?php else : ?>
		<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="block aspect-video overflow-hidden bg-sage/30">
			<div class="w-full h-full flex items-center justify-center">
				<?php ecocltr_display_icon( 'image-placeholder', 'w-16 h-16 text-olive/30' ); ?>
			</div>
		</a>
	<?php endif; ?>

	<div class="p-6">
		<h3 class="text-xl font-semibold text-dark mb-2">
			<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="hover:text-burgundy transition-colors">
				<?php echo esc_html( $category_term->name ); ?>
			</a>
		</h3>

		<?php if ( $category_term->description ) : ?>
			<p class="text-dark/70 text-sm mb-4 line-clamp-2">
				<?php echo esc_html( wp_trim_words( $category_term->description, 15 ) ); ?>
			</p>
		<?php endif; ?>

		<div class="flex items-center justify-between">
			<span class="text-sm text-dark/50">
				<?php
				printf(
					/* translators: %d: Number of services */
					esc_html( _n( '%d service', '%d services', $service_count, 'ecocltr' ) ),
					esc_html( $service_count )
				);
				?>
			</span>

			<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="inline-flex items-center text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors">
				<?php esc_html_e( 'View All', 'ecocltr' ); ?>
				<?php ecocltr_display_icon( 'arrow-right', 'w-4 h-4 ml-1' ); ?>
			</a>
		</div>
	</div>
</article>
