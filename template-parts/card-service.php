<?php
/**
 * Template part for displaying a service card.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

$service_id    = get_the_ID();
$service_intro = ecocltr_get_field( 'service_intro', $service_id );
$excerpt       = $service_intro ? $service_intro : get_the_excerpt();
?>

<article id="service-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden h-full flex flex-col' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
					'alt'   => esc_attr( get_the_title() ),
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="p-6 flex flex-col flex-1">
		<h3 class="text-xl font-semibold text-dark mb-2 leading-tight">
			<a href="<?php the_permalink(); ?>" class="hover:text-burgundy transition-colors !no-underline">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $excerpt ) : ?>
			<p class="text-dark/70 text-sm mb-4 line-clamp-3">
				<?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?>
			</p>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline mt-auto">
			<?php esc_html_e( 'Learn More', 'ecocltr' ); ?>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
				<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
			</svg>
		</a>
	</div>
</article>
