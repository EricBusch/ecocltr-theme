<?php
/**
 * Template for the front page (homepage).
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

// Get ACF fields.
$hero_heading         = ecocltr_get_field( 'hero_heading' );
$hero_subheading      = ecocltr_get_field( 'hero_subheading' );
$intro_heading        = ecocltr_get_field( 'intro_heading' );
$intro_text           = ecocltr_get_field( 'intro_text' );
$featured_services    = ecocltr_get_field( 'featured_services' );
$service_area_heading = ecocltr_get_field( 'service_area_heading' );
$service_area_text    = ecocltr_get_field( 'service_area_text' );
$cta_heading          = ecocltr_get_field( 'cta_heading' );
$cta_button_text      = ecocltr_get_field( 'cta_button_text', false, __( 'Get in Touch', 'ecocltr' ) );

// Get recent projects.
$recent_projects = ecocltr_get_recent_projects( 4 );

// Get site info.
$site_name    = get_bloginfo( 'name' );
$site_tagline = get_bloginfo( 'description' );

// Hero video URL - uses ACF field or falls back to default.
$hero_video_id  = ecocltr_get_field( 'hero_video', false, 44 );
$hero_video_url = is_numeric( $hero_video_id ) ? wp_get_attachment_url( $hero_video_id ) : $hero_video_id;
?>

<div id="primary" class="content-area">
	<!-- Hero Section with Video Background -->
	<section class="relative h-[500px] md:h-[600px] flex items-center justify-center overflow-hidden">
		<!-- Video Background -->
		<div class="absolute inset-0 w-full h-full">
			<video
				class="absolute inset-0 w-full h-full object-cover"
				autoplay
				muted
				loop
				playsinline
				poster=""
			>
				<source src="<?php echo esc_url( $hero_video_url ); ?>" type="video/mp4">
			</video>
			<!-- Overlay -->
			<div class="absolute inset-0 bg-gradient-to-b from-olive/70 via-olive/50 to-olive/70"></div>
		</div>

		<!-- Hero Content -->
		<div class="relative z-10 container mx-auto text-center px-4">
			<h1 class="text-pretty text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 tracking-tight drop-shadow-lg">
				<?php echo esc_html( $site_name ); ?>
			</h1>

			<?php if ( $site_tagline ) : ?>
				<p class="text-balance text-lg md:text-xl lg:text-2xl text-sage-200 max-w-4xl mx-auto leading-snug drop-shadow-md">
					<?php echo esc_html( $site_tagline ); ?>
				</p>
			<?php endif; ?>

			<div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="inline-block bg-white/10 hover:bg-white/20 text-white border-2 border-white/50 hover:border-white font-semibold px-10 py-4 rounded-lg transition-all duration-300 hover:scale-105 backdrop-blur-sm">
					<?php esc_html_e( 'Our Services', 'ecocltr' ); ?>
				</a>
				<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-burgundy hover:bg-burgundy-800 text-white font-semibold px-10 py-4 rounded-lg transition-all duration-300 hover:scale-105 shadow-lg">
					<?php echo esc_html( $cta_button_text ); ?>
				</a>
			</div>
		</div>

	</section>

	<?php
	// Get service categories.
	$service_categories = get_terms(
		array(
			'taxonomy'   => 'service_category',
			'hide_empty' => false,
		)
	);

	// Get service categories section fields.
	$sc_eyebrow     = ecocltr_get_field( 'service_categories_eyebrow', false, __( 'How We Can Help', 'ecocltr' ) );
	$sc_heading     = ecocltr_get_field( 'service_categories_heading', false, __( 'What\'s Your Plan?', 'ecocltr' ) );
	$sc_description = ecocltr_get_field( 'service_categories_description', false, __( 'Whether you want to attract pollinators, manage stormwater naturally, or restore your property\'s ecology, we have the expertise to make it happen.', 'ecocltr' ) );

	if ( $service_categories && ! is_wp_error( $service_categories ) ) :
		$category_count = 0;
		?>
		<!-- Service Categories Section -->
		<section class="py-20 md:py-32">
			<div class="container mx-auto">
				<?php
				get_template_part(
					'template-parts/section',
					'header',
					array(
						'eyebrow'     => $sc_eyebrow,
						'heading'     => $sc_heading,
						'description' => $sc_description,
					)
				);
				?>

				<div class="space-y-16 md:space-y-20">
					<?php foreach ( $service_categories as $category ) :
						$category_image = get_field( 'featured_image', 'service_category_' . $category->term_id );
						$category_link  = get_term_link( $category );
						$is_even        = ( $category_count % 2 === 0 );
						$category_count++;
						?>
						<div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-4 md:p-6">
							<div class="grid lg:grid-cols-2 gap-6 lg:gap-10 items-center <?php echo $is_even ? '' : 'lg:grid-flow-dense'; ?>">
								<!-- Image -->
								<a href="<?php echo esc_url( $category_link ); ?>" class="group block <?php echo $is_even ? '' : 'lg:col-start-2'; ?>">
									<div class="relative overflow-hidden rounded-xl shadow-md">
										<?php if ( $category_image ) : ?>
											<img
												src="<?php echo esc_url( $category_image['sizes']['large'] ?? $category_image['url'] ); ?>"
												alt="<?php echo esc_attr( $category_image['alt'] ?: $category->name ); ?>"
												class="w-full aspect-[3/2] object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-out"
											>
										<?php else : ?>
											<div class="w-full aspect-[3/2] bg-gradient-to-br from-sage-100 to-sage-200"></div>
										<?php endif; ?>
									</div>
								</a>

								<!-- Content -->
								<div class="<?php echo $is_even ? '' : 'lg:col-start-1 lg:row-start-1'; ?> <?php echo $is_even ? 'lg:pl-4' : 'lg:pl-4 lg:pr-4'; ?> py-4">
									<span class="inline-block text-xs uppercase tracking-widest text-olive/70 mb-3">
										<?php
										printf(
											/* translators: %d: number of services */
											esc_html( _n( '%d service', '%d services', $category->count, 'ecocltr' ) ),
											esc_html( $category->count )
										);
										?>
									</span>

									<h3 class="text-xl md:text-2xl font-semibold text-dark mb-3">
										<a href="<?php echo esc_url( $category_link ); ?>" class="hover:text-burgundy transition-colors">
											<?php echo esc_html( $category->name ); ?>
										</a>
									</h3>

									<?php if ( $category->description ) : ?>
										<p class="text-base md:text-lg text-dark/70 leading-relaxed mb-5">
											<?php echo esc_html( $category->description ); ?>
										</p>
									<?php endif; ?>

									<?php
									// Get services in this category.
									$category_services = get_posts(
										array(
											'post_type'      => 'service',
											'posts_per_page' => -1,
											'tax_query'      => array(
												array(
													'taxonomy' => 'service_category',
													'field'    => 'term_id',
													'terms'    => $category->term_id,
												),
											),
										)
									);

									if ( $category_services ) :
										$service_count = count( $category_services );
										$list_classes  = $service_count > 3 ? 'grid grid-cols-2 gap-x-4 gap-y-1.5 mb-6' : 'space-y-1.5 mb-6';
										?>
										<ul class="<?php echo esc_attr( $list_classes ); ?>">
											<?php foreach ( $category_services as $service ) : ?>
												<li class="flex items-center text-dark/60">
													<svg class="w-4 h-4 mr-2 text-sage-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
													</svg>
													<span><?php echo esc_html( $service->post_title ); ?></span>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<a href="<?php echo esc_url( $category_link ); ?>" class="group/link inline-flex items-center text-burgundy font-medium">
										<span class="transition-colors">
											<?php esc_html_e( 'Explore services', 'ecocltr' ); ?>
										</span>
										<svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
										</svg>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $intro_heading || $intro_text ) : ?>
		<!-- Introduction Section -->
		<section class="py-16 md:py-24">
			<div class="container mx-auto">
				<div class="max-w-3xl mx-auto text-center">
					<?php if ( $intro_heading ) : ?>
						<h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">
							<?php echo esc_html( $intro_heading ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $intro_text ) : ?>
						<p class="text-lg text-dark/70 leading-relaxed">
							<?php echo esc_html( $intro_text ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $featured_services && is_array( $featured_services ) ) : ?>
		<!-- Featured Services Section -->
		<section class="py-20 md:py-32 bg-gradient-to-b from-white to-sage/5">
			<div class="container mx-auto">
				<!-- Section Header -->
				<div class="max-w-3xl mx-auto text-center mb-16">
					<span class="inline-block text-sm uppercase tracking-widest text-burgundy font-semibold mb-4">
						<?php esc_html_e( 'What We Offer', 'ecocltr' ); ?>
					</span>
					<h2 class="text-pretty text-4xl md:text-5xl font-bold text-dark mb-6">
						<?php esc_html_e( 'Our Services', 'ecocltr' ); ?>
					</h2>
					<div class="w-24 h-1 bg-gradient-to-r from-burgundy via-sage to-olive mx-auto rounded-full"></div>
				</div>

				<!-- Services Grid -->
				<div class="grid md:grid-cols-2 lg:grid-cols-<?php echo esc_attr( min( count( $featured_services ), 3 ) ); ?> gap-8 lg:gap-10 mb-16">
					<?php
					foreach ( $featured_services as $service ) :
						$GLOBALS['post'] = $service; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						setup_postdata( $service );
						get_template_part( 'template-parts/card', 'service' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>

				<!-- CTA -->
				<div class="text-center">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="group inline-flex items-center border-2 border-burgundy text-burgundy hover:bg-burgundy hover:text-white font-semibold px-10 py-4 rounded-lg transition-all duration-300 hover:shadow-lg">
						<span><?php esc_html_e( 'View All Services', 'ecocltr' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
						</svg>
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $recent_projects ) : ?>
		<!-- Recent Projects Section -->
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold text-dark mb-12 text-center">
					<?php esc_html_e( 'Recent Projects', 'ecocltr' ); ?>
				</h2>

				<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
					<?php
					foreach ( $recent_projects as $project ) :
						$GLOBALS['post'] = $project; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						setup_postdata( $project );
						get_template_part( 'template-parts/card', 'project' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>

				<div class="text-center mt-12">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="inline-block border-2 border-burgundy text-burgundy hover:bg-burgundy hover:text-white font-semibold px-8 py-3 rounded-lg transition-colors">
						<?php esc_html_e( 'View All Projects', 'ecocltr' ); ?>
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Decorative Divider -->
	<div class="bg-white">
		<div class="container mx-auto">
			<hr class="border-0 h-px bg-gradient-to-r from-transparent via-sage/30 to-transparent">
		</div>
	</div>

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

	<?php if ( $service_area_heading || $service_area_text ) : ?>
		<!-- Service Area Section -->
		<section class="py-16 md:py-24 bg-sage/20">
			<div class="container mx-auto">
				<div class="max-w-3xl mx-auto text-center">
					<?php if ( $service_area_heading ) : ?>
						<h2 class="text-3xl md:text-4xl font-bold text-dark mb-6">
							<?php echo esc_html( $service_area_heading ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $service_area_text ) : ?>
						<p class="text-lg text-dark/70 leading-relaxed">
							<?php echo esc_html( $service_area_text ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/cta', 'footer' ); ?>
</div>

<?php
get_footer();
