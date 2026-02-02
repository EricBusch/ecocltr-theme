<?php
/**
 * Template Name: Services
 * Template for the Services landing page.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

$service_categories = ecocltr_get_service_categories();
?>

<div id="primary" class="content-area">
	<!-- Page Header -->
	<header class="bg-olive text-light py-16 md:py-24">
		<div class="container mx-auto text-center">
			<h1 class="text-4xl md:text-5xl font-bold mb-4">
				<?php the_title(); ?>
			</h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="text-xl text-sage max-w-2xl mx-auto">
					<?php echo esc_html( get_the_excerpt() ); ?>
				</p>
			<?php endif; ?>
		</div>
	</header>

	<section class="py-16 md:py-24">
		<div class="container mx-auto">
			<?php if ( $service_categories && ! is_wp_error( $service_categories ) ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					foreach ( $service_categories as $category ) :
						get_template_part(
							'template-parts/card',
							'service-category',
							array( 'term' => $category )
						);
					endforeach;
					?>
				</div>
			<?php else : ?>
				<div class="text-center py-12">
					<p class="text-dark/60 text-lg">
						<?php esc_html_e( 'No service categories found.', 'ecocltr' ); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	// Show page content if any.
	while ( have_posts() ) :
		the_post();

		$content = get_the_content();
		if ( ! empty( trim( $content ) ) ) :
			?>
			<section class="py-16 md:py-24 bg-white">
				<div class="container mx-auto">
					<div class="prose prose-lg max-w-3xl mx-auto">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endwhile;
	?>

	<!-- CTA Section -->
	<section class="py-16 md:py-24 bg-sage/20">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">
				<?php esc_html_e( 'Ready to Transform Your Landscape?', 'ecocltr' ); ?>
			</h2>
			<p class="text-lg text-dark/70 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Contact us today to discuss your project and discover how we can help create a beautiful, sustainable outdoor space.', 'ecocltr' ); ?>
			</p>
			<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-burgundy hover:bg-burgundy-800 text-white font-semibold px-8 py-4 rounded-lg transition-colors !no-underline">
				<?php esc_html_e( 'Get in Touch', 'ecocltr' ); ?>
			</a>
		</div>
	</section>
</div>

<?php
get_footer();
