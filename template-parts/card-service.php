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

<article id="service-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden h-full flex flex-col border border-sage/20 hover:border-sage/40' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-[16/10] overflow-hidden relative">
			<?php
			the_post_thumbnail(
				'medium',
				array(
					'class' => 'w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out',
					'alt'   => esc_attr( get_the_title() ),
				)
			);
			?>
			<!-- Subtle gradient overlay on hover -->
			<div class="absolute inset-0 bg-gradient-to-t from-dark/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
		</a>
	<?php endif; ?>

	<div class="p-6 md:p-7 flex flex-col flex-1">
		<!-- Subtle accent line -->
		<div class="w-12 h-0.5 bg-gradient-to-r from-burgundy to-sage mb-4"></div>

		<h3 class="text-pretty text-xl md:text-2xl font-semibold text-dark mb-3 leading-tight">
			<a href="<?php the_permalink(); ?>" class="hover:text-burgundy transition-colors">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $excerpt ) : ?>
			<p class="text-dark/70 text-base leading-relaxed mb-5 line-clamp-3 flex-1">
				<?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?>
			</p>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="group/link inline-flex items-center text-burgundy font-semibold text-sm hover:text-burgundy-800 transition-colors mt-auto">
			<span><?php esc_html_e( 'Learn More', 'ecocltr' ); ?></span>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform">
				<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
			</svg>
		</a>
	</div>
</article>
