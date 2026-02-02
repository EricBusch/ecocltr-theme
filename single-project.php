<?php
/**
 * Template for single Project post.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

$project_id       = get_the_ID();
$project_location = ecocltr_get_field( 'project_location', $project_id );
$project_year     = ecocltr_get_field( 'project_year', $project_id );
$project_gallery  = ecocltr_get_field( 'project_gallery', $project_id );
$related_services = ecocltr_get_related_services( $project_id );
?>

<div id="primary" class="content-area">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<!-- Project Header -->
		<header class="bg-olive text-light py-16 md:py-24">
			<div class="container mx-auto">
				<p class="text-sage text-sm uppercase tracking-wider mb-4">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="hover:text-white transition-colors !no-underline">
						<?php esc_html_e( 'Projects', 'ecocltr' ); ?>
					</a>
				</p>

				<h1 class="text-4xl md:text-5xl font-bold mb-6 max-w-4xl">
					<?php the_title(); ?>
				</h1>

				<?php if ( $project_location || $project_year ) : ?>
					<div class="flex flex-wrap gap-6 text-sage">
						<?php if ( $project_location ) : ?>
							<span class="inline-flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
								</svg>
								<?php echo esc_html( $project_location ); ?>
							</span>
						<?php endif; ?>

						<?php if ( $project_year ) : ?>
							<span class="inline-flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
								</svg>
								<?php echo esc_html( $project_year ); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</header>

		<article id="project-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="py-16 md:py-24">
				<div class="container mx-auto">
					<!-- Featured Image -->
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

					<div class="grid lg:grid-cols-3 gap-12">
						<!-- Main Content -->
						<div class="lg:col-span-2">
							<div class="prose prose-lg max-w-none">
								<?php the_content(); ?>
							</div>

							<!-- Project Gallery -->
							<?php if ( $project_gallery && is_array( $project_gallery ) ) : ?>
								<div class="mt-12">
									<h2 class="text-2xl font-bold text-dark mb-6">
										<?php esc_html_e( 'Project Gallery', 'ecocltr' ); ?>
									</h2>

									<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
										<?php foreach ( $project_gallery as $image ) : ?>
											<a
												href="<?php echo esc_url( $image['url'] ); ?>"
												data-fslightbox="project-gallery"
												class="aspect-square rounded-lg overflow-hidden block group"
											>
												<img
													src="<?php echo esc_url( $image['sizes']['medium_large'] ?? $image['url'] ); ?>"
													alt="<?php echo esc_attr( $image['alt'] ?? get_the_title() ); ?>"
													class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
												>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<!-- Sidebar -->
						<aside class="lg:col-span-1">
							<!-- Related Services -->
							<?php if ( $related_services ) : ?>
								<div class="bg-sage/20 rounded-lg p-6 mb-8">
									<h3 class="text-xl font-semibold text-dark mb-4">
										<?php esc_html_e( 'Services Used', 'ecocltr' ); ?>
									</h3>

									<ul class="space-y-3">
										<?php foreach ( $related_services as $service ) : ?>
											<li>
												<a href="<?php echo esc_url( get_permalink( $service->ID ) ); ?>" class="flex items-center text-dark hover:text-burgundy transition-colors !no-underline">
													<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-olive mr-3 flex-shrink-0">
														<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
													</svg>
													<?php echo esc_html( get_the_title( $service->ID ) ); ?>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>

									<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="inline-flex items-center mt-4 text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline">
										<?php esc_html_e( 'View All Services', 'ecocltr' ); ?>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
											<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
										</svg>
									</a>
								</div>
							<?php endif; ?>

							<!-- Contact CTA -->
							<div class="bg-burgundy text-white rounded-lg p-6">
								<h3 class="text-xl font-semibold mb-4">
									<?php esc_html_e( 'Like What You See?', 'ecocltr' ); ?>
								</h3>
								<p class="text-white/80 mb-6">
									<?php esc_html_e( 'Let\'s discuss how we can create something similar for your space.', 'ecocltr' ); ?>
								</p>
								<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-white text-burgundy hover:bg-light font-semibold px-6 py-3 rounded-lg transition-colors !no-underline">
									<?php esc_html_e( 'Contact Us', 'ecocltr' ); ?>
								</a>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</article>

	<?php endwhile; ?>

	<!-- More Projects -->
	<?php
	$more_projects = get_posts(
		array(
			'post_type'      => 'project',
			'posts_per_page' => 3,
			'post__not_in'   => array( $project_id ),
			'orderby'        => 'rand',
		)
	);

	if ( $more_projects ) :
		?>
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto">
				<h2 class="text-2xl md:text-3xl font-bold text-dark mb-8 text-center">
					<?php esc_html_e( 'More Projects', 'ecocltr' ); ?>
				</h2>

				<div class="grid md:grid-cols-3 gap-8">
					<?php
					foreach ( $more_projects as $project ) :
						$GLOBALS['post'] = $project; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						setup_postdata( $project );
						get_template_part( 'template-parts/card', 'project' );
					endforeach;
					wp_reset_postdata();
					?>
				</div>

				<div class="text-center mt-12">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="inline-block border-2 border-burgundy text-burgundy hover:bg-burgundy hover:text-white font-semibold px-8 py-3 rounded-lg transition-colors !no-underline">
						<?php esc_html_e( 'View All Projects', 'ecocltr' ); ?>
					</a>
				</div>
			</div>
		</section>
	<?php endif; ?>
</div>

<?php
get_footer();
