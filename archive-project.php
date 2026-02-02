<?php
/**
 * Template for Projects archive.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area">
	<!-- Archive Header -->
	<header class="bg-olive text-light py-16 md:py-24">
		<div class="container mx-auto text-center">
			<h1 class="text-4xl md:text-5xl font-bold mb-4">
				<?php esc_html_e( 'Our Projects', 'ecocltr' ); ?>
			</h1>
			<p class="text-xl text-sage max-w-2xl mx-auto">
				<?php esc_html_e( 'Explore our portfolio of natural landscaping projects across southern Ontario.', 'ecocltr' ); ?>
			</p>
		</div>
	</header>

	<section class="py-16 md:py-24">
		<div class="container mx-auto">
			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/card', 'project' );
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
						<?php esc_html_e( 'No projects found.', 'ecocltr' ); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="py-16 md:py-24 bg-sage/20">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">
				<?php esc_html_e( 'Ready to Start Your Project?', 'ecocltr' ); ?>
			</h2>
			<p class="text-lg text-dark/70 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Let us help you create a beautiful, sustainable outdoor space. Contact us today to discuss your vision.', 'ecocltr' ); ?>
			</p>
			<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-burgundy hover:bg-burgundy-800 text-white font-semibold px-8 py-4 rounded-lg transition-colors !no-underline">
				<?php esc_html_e( 'Get in Touch', 'ecocltr' ); ?>
			</a>
		</div>
	</section>
</div>

<?php
get_footer();
