<?php
/**
 * Template for Service Category taxonomy archive.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

$term = get_queried_object();
?>

<div id="primary" class="content-area">
	<!-- Category Header -->
	<header class="bg-olive text-light py-16 md:py-24">
		<div class="container mx-auto text-center">
			<p class="text-sage text-sm uppercase tracking-wider mb-4">
				<?php esc_html_e( 'Service Category', 'ecocltr' ); ?>
			</p>
			<h1 class="text-4xl md:text-5xl font-bold mb-4">
				<?php single_term_title(); ?>
			</h1>

			<?php if ( term_description() ) : ?>
				<p class="text-xl text-sage max-w-2xl mx-auto">
					<?php echo esc_html( wp_strip_all_tags( term_description() ) ); ?>
				</p>
			<?php endif; ?>
		</div>
	</header>

	<section class="py-16 md:py-24">
		<div class="container mx-auto">
			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/card', 'service' );
					endwhile;
					?>
				</div>

				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => __( '&larr; Previous', 'ecocltr' ),
						'next_text' => __( 'Next &rarr;', 'ecocltr' ),
					)
				);
				?>

			<?php else : ?>
				<div class="text-center py-12">
					<p class="text-dark/60 text-lg">
						<?php esc_html_e( 'No services found in this category.', 'ecocltr' ); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- Other Categories -->
	<?php
	$other_categories = get_terms(
		array(
			'taxonomy'   => 'service_category',
			'hide_empty' => true,
			'exclude'    => array( $term->term_id ),
			'number'     => 4,
		)
	);

	if ( $other_categories && ! is_wp_error( $other_categories ) ) :
		?>
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto">
				<h2 class="text-2xl md:text-3xl font-bold text-dark mb-8 text-center">
					<?php esc_html_e( 'Other Service Categories', 'ecocltr' ); ?>
				</h2>

				<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
					<?php
					foreach ( $other_categories as $cat ) :
						get_template_part(
							'template-parts/card',
							'service-category',
							array( 'term' => $cat )
						);
					endforeach;
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- CTA Section -->
	<section class="py-16 md:py-24 bg-sage/20">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">
				<?php esc_html_e( 'Interested in Our Services?', 'ecocltr' ); ?>
			</h2>
			<p class="text-lg text-dark/70 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Contact us today to discuss how we can help transform your outdoor space.', 'ecocltr' ); ?>
			</p>
			<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-burgundy hover:bg-burgundy-800 text-white font-semibold px-8 py-4 rounded-lg transition-colors !no-underline">
				<?php esc_html_e( 'Get in Touch', 'ecocltr' ); ?>
			</a>
		</div>
	</section>
</div>

<?php
get_footer();
