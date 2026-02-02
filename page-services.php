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
	<header class="bg-olive text-light py-12 md:py-16">
		<div class="container mx-auto text-center">
			<p class="text-sage text-sm uppercase tracking-widest mb-3">
				<?php esc_html_e( 'What We Do', 'ecocltr' ); ?>
			</p>
			<h1 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
				<?php the_title(); ?>
			</h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="text-balance text-lg md:text-xl text-sage/90 max-w-3xl mx-auto">
					<?php echo esc_html( get_the_excerpt() ); ?>
				</p>
			<?php endif; ?>
		</div>
	</header>

	<section class="py-16 md:py-24">
		<div class="container mx-auto">
			<?php if ( $service_categories && ! is_wp_error( $service_categories ) ) : ?>
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
											<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="text-dark hover:text-olive transition-colors !no-underline">
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
															<a href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>" class="text-dark hover:text-olive font-medium text-base transition-colors !no-underline group-hover:underline">
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
													class="inline-flex items-center gap-2 <?php echo esc_attr( $link_class ); ?> font-semibold text-sm transition-colors !no-underline group"
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
