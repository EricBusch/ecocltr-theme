<?php
/**
 * Template for single Service post.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

$service_id       = get_the_ID();
$service_intro    = ecocltr_get_field( 'service_intro', $service_id );
$related_projects = ecocltr_get_related_projects( $service_id );
// Try to get manually selected related services first, fallback to category-based.
$related_services = ecocltr_get_related_services_for_service( $service_id );
if ( empty( $related_services ) ) {
	$related_services = ecocltr_get_related_services_by_category( $service_id, 3 );
}
$service_terms = get_the_terms( $service_id, 'service_category' );
?>

<div id="primary" class="content-area">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<!-- Service Header -->
		<header class="bg-olive text-light py-16 md:py-24">
			<div class="container mx-auto">
				<div class="grid lg:grid-cols-3 gap-12 items-start">
					<!-- Left Column: Service Info -->
					<div class="lg:col-span-2">
						<?php if ( $service_terms && ! is_wp_error( $service_terms ) ) : ?>
							<p class="text-sage text-sm uppercase tracking-wider mb-4">
								<a href="<?php echo esc_url( get_term_link( $service_terms[0] ) ); ?>" class="hover:text-white transition-colors !no-underline">
									<?php echo esc_html( $service_terms[0]->name ); ?>
								</a>
							</p>
						<?php endif; ?>

						<h1 class="text-4xl md:text-5xl font-bold mb-4">
							<?php the_title(); ?>
						</h1>

						<?php if ( $service_intro ) : ?>
							<p class="text-xl text-sage leading-relaxed">
								<?php echo esc_html( $service_intro ); ?>
							</p>
						<?php endif; ?>
					</div>

					<!-- Right Column: Contact CTA -->
					<div class="lg:col-span-1">
						<div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 border border-white/20 sticky top-6">
							<h3 class="text-xl font-semibold text-white mb-3">
								<?php esc_html_e( 'Interested in this service?', 'ecocltr' ); ?>
							</h3>
							<p class="text-sage/90 mb-6 text-sm leading-relaxed text-pretty">
								<?php esc_html_e( 'Get in touch to discuss how we can help with your project.', 'ecocltr' ); ?>
							</p>
							<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="block text-center bg-white text-olive hover:bg-sage hover:text-dark font-semibold px-6 py-3 rounded-lg transition-colors !no-underline">
								<?php esc_html_e( 'Contact Us', 'ecocltr' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<article id="service-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="py-16 md:py-24">
				<div class="container mx-auto">
					<div class="grid lg:grid-cols-3 gap-12">
						<!-- Main Content -->
						<div class="lg:col-span-2">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="mb-10 rounded-lg overflow-hidden">
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
						</div>

						<!-- Sidebar -->
						<aside class="lg:col-span-1">
							<!-- Related Projects -->
							<?php if ( $related_projects ) : ?>
								<div class="bg-sage/20 rounded-lg p-6 mb-8">
									<h3 class="text-xl font-semibold text-dark mb-4">
										<?php esc_html_e( 'Featured Projects', 'ecocltr' ); ?>
									</h3>

									<ul class="space-y-4">
										<?php foreach ( $related_projects as $project ) : ?>
											<li class="flex items-start">
												<?php if ( has_post_thumbnail( $project->ID ) ) : ?>
													<a href="<?php echo esc_url( get_permalink( $project->ID ) ); ?>" class="flex-shrink-0 w-16 h-16 rounded overflow-hidden mr-4 block">
														<?php
														echo get_the_post_thumbnail(
															$project->ID,
															'thumbnail',
															array(
																'class' => 'w-full h-full object-cover',
																'alt'   => esc_attr( get_the_title( $project->ID ) ),
															)
														);
														?>
													</a>
												<?php endif; ?>
												<div>
													<a href="<?php echo esc_url( get_permalink( $project->ID ) ); ?>" class="font-medium text-dark hover:text-burgundy transition-colors !no-underline">
														<?php echo esc_html( get_the_title( $project->ID ) ); ?>
													</a>
													<?php
													$project_location = ecocltr_get_field( 'project_location', $project->ID );
													if ( $project_location ) :
														?>
														<p class="text-sm text-dark/60">
															<?php echo esc_html( $project_location ); ?>
														</p>
													<?php endif; ?>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>

									<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="inline-flex items-center mt-4 text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline">
										<?php esc_html_e( 'View All Projects', 'ecocltr' ); ?>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
											<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
										</svg>
									</a>
								</div>
							<?php endif; ?>

							<!-- Services TOC -->
							<?php
							$all_service_categories = ecocltr_get_service_categories();
							if ( $all_service_categories ) :
								?>
								<div class="bg-sage/20 rounded-lg p-6">
									<h3 class="text-lg font-semibold text-dark mb-4">
										<?php esc_html_e( 'All Services', 'ecocltr' ); ?>
									</h3>

									<nav class="space-y-4">
										<?php foreach ( $all_service_categories as $category ) : ?>
											<?php
											$category_services = ecocltr_get_services_by_category( $category->term_id );
											if ( $category_services ) :
												?>
												<div>
													<h4 class="text-sm font-semibold text-dark/80 uppercase tracking-wider mb-2">
														<?php echo esc_html( $category->name ); ?>
													</h4>
													<ul class="space-y-1.5">
														<?php foreach ( $category_services as $cat_service ) : ?>
															<?php $is_current = ( $cat_service->ID === $service_id ); ?>
															<li>
																<a
																	href="<?php echo esc_url( get_permalink( $cat_service->ID ) ); ?>"
																	class="block text-sm text-dark/70 hover:text-burgundy transition-colors !no-underline pl-3 border-l-2 <?php echo $is_current ? 'border-burgundy text-burgundy font-medium' : 'border-transparent'; ?>"
																>
																	<?php echo esc_html( get_the_title( $cat_service->ID ) ); ?>
																</a>
															</li>
														<?php endforeach; ?>
													</ul>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</nav>

									<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="inline-flex items-center mt-4 text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline">
										<?php esc_html_e( 'View All Services', 'ecocltr' ); ?>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
											<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
										</svg>
									</a>
								</div>
							<?php endif; ?>
						</aside>
					</div>
				</div>
			</div>
		</article>

	<?php endwhile; ?>

	<!-- Related Services -->
	<?php if ( $related_services ) : ?>
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto max-w-7xl">
				<div class="grid lg:grid-cols-[1fr_2fr] gap-12 lg:gap-16 items-start">
					<!-- Left Column: Section Info -->
					<div class="lg:sticky lg:top-8">
						<p class="text-sage text-xs uppercase tracking-widest font-semibold mb-3">
							<?php esc_html_e( 'Beautiful Pairings', 'ecocltr' ); ?>
						</p>
						<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-4">
							<?php esc_html_e( 'Companion Landscaping', 'ecocltr' ); ?>
						</h2>
						<p class="text-balance text-lg text-dark/70 leading-relaxed">
							<?php
							printf(
								/* translators: %s: Current service name */
								esc_html__( 'These services work beautifully alongside %s to create a thriving, interconnected landscape.', 'ecocltr' ),
								'<strong>' . esc_html( get_the_title() ) . '</strong>'
							);
							?>
						</p>
					</div>

					<!-- Right Column: Related Services -->
					<div class="space-y-4">
						<?php
						foreach ( $related_services as $service ) :
							$service_intro = ecocltr_get_field( 'service_intro', $service->ID );
							$excerpt       = $service_intro ? $service_intro : get_the_excerpt( $service->ID );
							?>
							<article class="group bg-white border border-dark/10 rounded-xl overflow-hidden hover:shadow-md transition-all">
								<a href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>" class="flex items-center gap-4 p-4 !no-underline">
									<!-- Service Image -->
									<?php if ( has_post_thumbnail( $service->ID ) ) : ?>
										<div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden">
											<?php
											echo get_the_post_thumbnail(
												$service->ID,
												'thumbnail',
												array(
													'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
													'alt'   => esc_attr( get_the_title( $service->ID ) ),
												)
											);
											?>
										</div>
									<?php endif; ?>

									<!-- Service Content -->
									<div class="flex-1 min-w-0">
										<h3 class="text-lg font-semibold text-dark group-hover:text-olive transition-colors mb-1">
											<?php echo esc_html( get_the_title( $service->ID ) ); ?>
										</h3>
										<?php if ( $excerpt ) : ?>
											<p class="text-sm text-dark/60 line-clamp-2">
												<?php echo esc_html( wp_trim_words( $excerpt, 15 ) ); ?>
											</p>
										<?php endif; ?>
									</div>

									<!-- Arrow Icon -->
									<div class="flex-shrink-0">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-sage group-hover:text-olive group-hover:translate-x-1 transition-all">
											<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
										</svg>
									</div>
								</a>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</div>

<?php
get_footer();
