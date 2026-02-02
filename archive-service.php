<?php
/**
 * Template for Services archive.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

// Get service categories.
$service_categories = ecocltr_get_service_categories();

// Get a random testimonial for the hero.
$random_testimonial = ecocltr_get_random_testimonial();
?>

<div id="primary" class="content-area">
	<!-- Hero Section -->
	<header class="relative bg-olive text-light py-16 md:py-20 overflow-hidden">
		<!-- Organic Background Pattern -->
		<div class="absolute inset-0 opacity-[0.07]">
			<svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<pattern id="nature-pattern" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
						<!-- Leaf shapes -->
						<path d="M30 40 Q35 30, 40 40 Q35 50, 30 40" fill="currentColor"/>
						<path d="M35 43 Q40 38, 45 43" stroke="currentColor" stroke-width="0.5" fill="none"/>

						<!-- Branch-like curves -->
						<path d="M70 20 Q75 30, 80 40 Q85 50, 90 60" stroke="currentColor" stroke-width="0.8" fill="none"/>
						<path d="M75 28 L78 25 M82 38 L85 35 M87 48 L90 45" stroke="currentColor" stroke-width="0.5"/>

						<!-- Seed/berry dots -->
						<circle cx="20" cy="80" r="1.5" fill="currentColor"/>
						<circle cx="25" cy="82" r="1" fill="currentColor"/>
						<circle cx="22" cy="85" r="1.2" fill="currentColor"/>

						<!-- Organic flowing line -->
						<path d="M10 10 Q20 15, 30 10 Q40 5, 50 10" stroke="currentColor" stroke-width="0.6" fill="none"/>

						<!-- Small leaf cluster -->
						<path d="M100 90 Q102 88, 104 90 Q102 92, 100 90" fill="currentColor"/>
						<path d="M105 92 Q107 90, 109 92 Q107 94, 105 92" fill="currentColor"/>
					</pattern>
				</defs>
				<rect width="100%" height="100%" fill="url(#nature-pattern)"/>
			</svg>
		</div>

		<!-- Decorative Organic Shapes -->
		<div class="absolute top-10 right-10 w-32 h-32 bg-sage/20 rounded-full blur-3xl"></div>
		<div class="absolute bottom-10 left-10 w-40 h-40 bg-burgundy/10 rounded-full blur-3xl"></div>
		<div class="absolute top-1/2 right-1/4 w-24 h-24 bg-sage/10 rounded-full blur-2xl"></div>

		<div class="container mx-auto relative z-10">
			<div class="grid lg:grid-cols-2 gap-12 items-center">
				<!-- Left Column: Text Content -->
				<div>
					<p class="text-sage text-sm uppercase tracking-widest mb-4">
						<?php esc_html_e( 'What We Do', 'ecocltr' ); ?>
					</p>
					<h1 class="text-pretty text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
						<?php esc_html_e( 'Our Services', 'ecocltr' ); ?>
					</h1>
					<p class="text-balance text-lg text-sage/90 max-w-xl leading-relaxed mb-8">
						<?php esc_html_e( 'From design to installation and ongoing care, we offer a full range of natural landscaping services to help you create a thriving, sustainable outdoor space.', 'ecocltr' ); ?>
					</p>

					<div class="flex flex-wrap gap-4">
						<a href="#service-categories" class="inline-flex items-center gap-2 bg-white text-olive hover:bg-sage hover:text-dark font-semibold px-6 py-3 rounded-lg transition-all duration-300 !no-underline">
							<?php esc_html_e( 'Browse Categories', 'ecocltr' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
								<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
							</svg>
						</a>
						<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-flex items-center gap-2 bg-transparent border-2 border-white/50 hover:border-white text-white hover:bg-white/10 font-semibold px-6 py-3 rounded-lg transition-all duration-300 !no-underline">
							<?php esc_html_e( 'Get Started', 'ecocltr' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
								<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
							</svg>
						</a>
					</div>
				</div>

				<!-- Right Column: Random Testimonial -->
				<?php if ( $random_testimonial ) : ?>
					<?php
					$testimonial_quote  = get_field( 'testimonial_quote', $random_testimonial->ID );
					$testimonial_client = get_field( 'testimonial_client_name', $random_testimonial->ID );
					?>
					<div class="hidden lg:block">
						<div class="bg-white/10 backdrop-blur-sm rounded-lg p-8 border border-white/20 relative max-h-[400px] flex flex-col">
							<!-- Quote Icon -->
							<div class="absolute top-6 left-6 opacity-20">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-white">
									<path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5 3.871 3.871 0 0 1-2.748-1.179z"/>
								</svg>
							</div>

							<!-- Testimonial Content -->
							<div class="relative z-10 pt-8 flex-1 flex flex-col">
								<?php if ( $testimonial_quote ) : ?>
									<blockquote class="text-white/95 text-base leading-relaxed mb-6 italic line-clamp-6 flex-1">
										"<?php echo esc_html( $testimonial_quote ); ?>"
									</blockquote>
								<?php endif; ?>

								<?php if ( $testimonial_client ) : ?>
									<div class="border-t border-white/20 pt-4 mt-auto">
										<cite class="not-italic font-semibold text-white block">
											<?php echo esc_html( $testimonial_client ); ?>
										</cite>
										<span class="text-sage/70 text-sm">
											<?php esc_html_e( 'EcoCultures Client', 'ecocltr' ); ?>
										</span>
									</div>
								<?php endif; ?>

								<!-- Decorative Element -->
								<div class="absolute bottom-0 right-0 w-20 h-20 bg-sage/10 rounded-full blur-2xl -z-10"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<!-- Service Categories Section -->
	<?php if ( $service_categories && ! is_wp_error( $service_categories ) ) : ?>
		<section id="service-categories" class="py-16 md:py-24">
			<div class="container mx-auto">
				<?php
				get_template_part(
					'template-parts/section',
					'header',
					array(
						'eyebrow'     => __( 'What We Offer', 'ecocltr' ),
						'heading'     => __( 'Choose Your Path', 'ecocltr' ),
						'description' => __( 'Whether you want to attract pollinators, manage stormwater naturally, or restore your property\'s ecology, we have the expertise to make it happen.', 'ecocltr' ),
					)
				);
				?>

				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					foreach ( $service_categories as $category ) :
						get_template_part(
							'template-parts/card',
							'service-category',
							array(
								'term' => $category,
							)
						);
					endforeach;
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Testimonial Section -->
	<?php get_template_part( 'template-parts/section', 'testimonial' ); ?>

	<!-- Call to Action Footer -->
	<?php get_template_part( 'template-parts/cta', 'footer' ); ?>
</div>

<?php
get_footer();
