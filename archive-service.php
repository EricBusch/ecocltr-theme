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
						<?php esc_html_e( 'What We Do', 'ecocltr' ); ?>
					</p>
					<h1 class="text-pretty text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
						<?php esc_html_e( 'Our Services', 'ecocltr' ); ?>
					</h1>
					<p class="text-balance text-lg text-sage/90 max-w-xl leading-relaxed mb-8">
						<?php esc_html_e( 'From design to installation and ongoing care, we offer a full range of natural landscaping services to help you create a thriving, sustainable outdoor space.', 'ecocltr' ); ?>
					</p>

					<div class="flex flex-wrap gap-4">
						<a href="#service-categories" class="inline-flex items-center gap-2 bg-white text-olive hover:bg-sage hover:text-dark font-semibold px-6 py-3 rounded-lg transition-all duration-300">
							<?php esc_html_e( 'Browse Categories', 'ecocltr' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
								<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
							</svg>
						</a>
						<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-flex items-center gap-2 bg-transparent border-2 border-white/50 hover:border-white text-white hover:bg-white/10 font-semibold px-6 py-3 rounded-lg transition-all duration-300">
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
				<!-- Service Categories with Hierarchical Display -->
				<div class="space-y-12 md:space-y-16">
					<?php
					foreach ( $service_categories as $index => $category ) :
						$services       = ecocltr_get_services_by_category( $category->term_id );
						// Try to get image from taxonomy term first, fallback to first service's image
						$category_image = get_field( 'featured_image', 'term_' . $category->term_id );
						if ( $category_image ) {
							$thumbnail_url = is_array( $category_image ) ? $category_image['url'] : $category_image;
						} else {
							$thumbnail_url = ecocltr_get_category_thumbnail( $category->term_id );
						}
						$badge_bg_class    = 'bg-sage/10';
						$badge_text_class  = 'text-olive';
						$check_bg_class    = 'bg-sage';
						$link_class        = 'text-olive hover:text-olive/80';
						?>
						<!-- Category Section -->
						<div id="category-<?php echo esc_attr( $category->slug ); ?>" class="relative scroll-mt-8">
							<div class="bg-white rounded-2xl shadow-sm border border-dark/5 overflow-hidden">
								<div class="grid grid-cols-1 md:grid-cols-[16rem_1fr] lg:grid-cols-[20rem_1fr]">
									<!-- Category Image -->
									<?php if ( $thumbnail_url ) : ?>
										<div class="w-full">
											<div class="aspect-[4/3] md:aspect-square w-full h-full">
												<img
													src="<?php echo esc_url( $thumbnail_url ); ?>"
													alt="<?php echo esc_attr( $category->name ); ?>"
													class="w-full h-full object-cover object-center"
												>
											</div>
										</div>
									<?php endif; ?>

									<!-- Category Content -->
									<div class="p-6 md:p-8 min-w-0">
										<!-- Badge -->
										<div class="inline-flex items-center gap-2 <?php echo esc_attr( $badge_bg_class . ' ' . $badge_text_class ); ?> text-xs uppercase tracking-widest font-semibold px-3 py-1.5 rounded-full mb-3">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
												<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
											</svg>
											<?php esc_html_e( 'Service Type', 'ecocltr' ); ?>
										</div>

										<!-- Title -->
										<h2 class="text-pretty text-2xl md:text-3xl font-bold mb-3">
											<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="text-dark hover:text-olive transition-colors">
												<?php echo esc_html( $category->name ); ?>
											</a>
										</h2>

										<!-- Description -->
										<?php if ( $category->description ) : ?>
											<p class="text-balance text-base text-dark/70 leading-relaxed mb-6">
												<?php echo esc_html( $category->description ); ?>
											</p>
										<?php endif; ?>

										<!-- Services Checklist -->
										<?php if ( ! empty( $services ) ) : ?>
											<?php
											$service_count = count( $services );
											$grid_class    = $service_count > 3 ? 'grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2' : 'flex flex-col gap-y-2';
											?>
											<div class="<?php echo esc_attr( $grid_class ); ?>">
												<?php foreach ( $services as $service ) : ?>
													<div class="flex items-start gap-3 group min-w-0">
														<!-- Checkmark Icon -->
														<div class="flex-shrink-0 mt-0.5">
															<div class="w-5 h-5 <?php echo esc_attr( $check_bg_class ); ?> rounded-full flex items-center justify-center">
																<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-white">
																	<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
																</svg>
															</div>
														</div>
														<!-- Service Name -->
														<div class="flex-1 min-w-0">
															<a href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>" class="text-dark hover:text-olive font-medium text-base transition-colors group-hover:underline">
																<?php echo esc_html( $service->post_title ); ?>
															</a>
														</div>
													</div>
												<?php endforeach; ?>
											</div>

											<!-- View All Link -->
											<div class="mt-6 pt-6 border-t border-dark/10">
												<a
													href="<?php echo esc_url( get_term_link( $category ) ); ?>"
													class="inline-flex items-center gap-2 <?php echo esc_attr( $link_class ); ?> font-semibold text-sm transition-colors group"
												>
													<?php esc_html_e( 'View all services', 'ecocltr' ); ?>
													<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
														<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
													</svg>
												</a>
											</div>
										<?php else : ?>
											<p class="text-dark/50 text-sm">
												<?php esc_html_e( 'No services in this category yet.', 'ecocltr' ); ?>
											</p>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
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
