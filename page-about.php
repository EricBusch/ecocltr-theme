<?php
/**
 * Template Name: About
 * Template for the About page.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();
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
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-12 rounded-lg overflow-hidden">
							<?php
							the_post_thumbnail(
								'large',
								array(
									'class' => 'w-full h-auto',
									'alt'   => esc_attr( get_the_title() ),
								)
							);
							?>
						</div>
					<?php endif; ?>

					<div class="prose prose-lg max-w-none">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>
	</section>

	<!-- Testimonial Section -->
	<?php
	$testimonial = ecocltr_get_random_testimonial();
	if ( $testimonial ) :
		?>
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold text-dark mb-12 text-center">
					<?php esc_html_e( 'What Our Clients Say', 'ecocltr' ); ?>
				</h2>

				<div class="max-w-3xl mx-auto">
					<?php ecocltr_display_testimonial( $testimonial->ID ); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- CTA Section -->
	<section class="py-16 md:py-24 bg-burgundy text-white">
		<div class="container mx-auto text-center">
			<h2 class="text-3xl md:text-4xl font-bold mb-6">
				<?php esc_html_e( 'Let\'s Work Together', 'ecocltr' ); ?>
			</h2>
			<p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">
				<?php esc_html_e( 'Ready to create a beautiful, natural landscape? We\'d love to hear from you.', 'ecocltr' ); ?>
			</p>
			<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-white text-burgundy hover:bg-light font-semibold px-8 py-4 rounded-lg transition-colors">
				<?php esc_html_e( 'Get in Touch', 'ecocltr' ); ?>
			</a>
		</div>
	</section>
</div>

<?php
get_footer();
