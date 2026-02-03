<?php
/**
 * Template for Projects archive.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

// Get a random testimonial for the hero.
$random_testimonial = ecocltr_get_random_testimonial();
?>

<div id="primary" class="content-area">
	<!-- Hero Section -->
	<header class="relative bg-olive text-light py-16 md:py-20 overflow-hidden">
		<!-- Subtle Gradient Background -->
		<div class="absolute inset-0 bg-gradient-to-br from-olive via-olive to-olive-900 opacity-60"></div>

		<!-- Decorative Organic Shapes -->
		<div class="absolute top-10 right-10 w-32 h-32 bg-sage/20 rounded-full blur-3xl"></div>
		<div class="absolute bottom-10 left-10 w-40 h-40 bg-burgundy/10 rounded-full blur-3xl"></div>
		<div class="absolute top-1/2 right-1/4 w-24 h-24 bg-sage/10 rounded-full blur-2xl"></div>

		<div class="container mx-auto relative z-10">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<!-- Left Column: Text Content -->
				<div>
					<p class="text-sage text-sm uppercase tracking-widest mb-4">
						<?php esc_html_e( 'Portfolio', 'ecocltr' ); ?>
					</p>
					<h1 class="text-pretty text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
						<?php esc_html_e( 'Our Projects', 'ecocltr' ); ?>
					</h1>
					<p class="text-balance text-lg text-sage/90 max-w-xl leading-relaxed mb-8">
						<?php esc_html_e( 'Explore our portfolio of natural landscaping projects across southern Ontario. Each project showcases our commitment to sustainable, beautiful outdoor spaces.', 'ecocltr' ); ?>
					</p>

					<div class="flex flex-wrap gap-4">
						<a href="#projects-grid" class="inline-flex items-center gap-2 bg-white text-olive hover:bg-sage hover:text-dark font-semibold px-6 py-3 rounded-lg transition-all duration-300">
							<?php esc_html_e( 'View Projects', 'ecocltr' ); ?>
							<?php ecocltr_display_icon( 'chevron-down', 'w-4 h-4' ); ?>
						</a>
						<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-flex items-center gap-2 bg-transparent border-2 border-white/50 hover:border-white text-white hover:bg-white/10 font-semibold px-6 py-3 rounded-lg transition-all duration-300">
							<?php esc_html_e( 'Get Started', 'ecocltr' ); ?>
							<?php ecocltr_display_icon( 'arrow-right', 'w-4 h-4' ); ?>
						</a>
					</div>
				</div>

				<!-- Right Column: Random Testimonial -->
				<?php
				if ( $random_testimonial ) :
					get_template_part(
						'template-parts/hero',
						'testimonial',
						array( 'testimonial' => $random_testimonial )
					);
				endif;
				?>
			</div>
		</div>
	</header>

	<section id="projects-grid" class="py-16 md:py-24">
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

	<!-- Call to Action Footer -->
	<?php get_template_part( 'template-parts/cta', 'footer' ); ?>
</div>

<?php
get_footer();
