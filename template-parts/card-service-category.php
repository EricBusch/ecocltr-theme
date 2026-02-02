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
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 text-olive/30">
					<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
				</svg>
			</div>
		</a>
	<?php endif; ?>

	<div class="p-6">
		<h3 class="text-xl font-semibold text-dark mb-2">
			<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="hover:text-burgundy transition-colors !no-underline">
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

			<a href="<?php echo esc_url( get_term_link( $category_term ) ); ?>" class="inline-flex items-center text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline">
				<?php esc_html_e( 'View All', 'ecocltr' ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
					<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
				</svg>
			</a>
		</div>
	</div>
</article>
