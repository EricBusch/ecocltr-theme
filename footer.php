<?php
/**
 * Theme footer template.
 *
 * @package Ecocltr
 */

?>
		</main>

		<?php do_action( 'ecocltr_content_end' ); ?>
	</div>

	<?php do_action( 'ecocltr_content_after' ); ?>

	<footer id="colophon" class="bg-dark text-light" role="contentinfo">
		<?php
		// Get business information from ACF options.
		$business_name              = ecocltr_get_business_info( 'business_name' );
		$business_phone             = ecocltr_get_business_info( 'business_phone' );
		$business_email             = ecocltr_get_business_info( 'business_email' );
		$business_address           = ecocltr_get_business_info( 'business_address' );
		$social_facebook            = ecocltr_get_business_info( 'social_facebook' );
		$social_instagram           = ecocltr_get_business_info( 'social_instagram' );
		$social_houzz               = ecocltr_get_business_info( 'social_houzz' );
		$footer_description         = ecocltr_get_business_info( 'footer_description' );
		$service_areas_description  = ecocltr_get_business_info( 'service_areas_description' );
		$service_areas_list         = ecocltr_get_business_info( 'service_areas_list' );
		$established_year           = ecocltr_get_business_info( 'established_year' );
		?>

		<div class="container mx-auto py-12 md:py-16">
			<?php do_action( 'ecocltr_footer' ); ?>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-12">
				<!-- Column 1: Logo & About -->
				<div class="lg:col-span-1">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block mb-4">
						<span class="text-2xl font-bold text-white">
							<?php echo esc_html( $business_name ?: get_bloginfo( 'name' ) ); ?>
						</span>
					</a>

					<?php if ( $footer_description ) : ?>
						<p class="text-sage/80 text-sm mb-6 leading-relaxed">
							<?php echo esc_html( $footer_description ); ?>
						</p>
					<?php endif; ?>

					<!-- Social Media Links -->
					<?php if ( $social_facebook || $social_instagram || $social_houzz ) : ?>
						<div class="flex gap-3">
							<?php if ( $social_facebook ) : ?>
								<a href="<?php echo esc_url( $social_facebook ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-burgundy flex items-center justify-center transition-colors" aria-label="<?php esc_attr_e( 'Facebook', 'ecocltr' ); ?>">
									<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
										<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
									</svg>
								</a>
							<?php endif; ?>

							<?php if ( $social_instagram ) : ?>
								<a href="<?php echo esc_url( $social_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-burgundy flex items-center justify-center transition-colors" aria-label="<?php esc_attr_e( 'Instagram', 'ecocltr' ); ?>">
									<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
										<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
									</svg>
								</a>
							<?php endif; ?>

							<?php if ( $social_houzz ) : ?>
								<a href="<?php echo esc_url( $social_houzz ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-burgundy flex items-center justify-center transition-colors" aria-label="<?php esc_attr_e( 'Houzz', 'ecocltr' ); ?>">
									<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 640">
										<path d="M372 394.7L267.4 394.7L267.4 544L113.1 544L113.1 96L222.6 96L222.6 200.5L527.7 286.1L527.7 544L372 544L372 394.7z"/>
									</svg>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Column 2: Quick Links -->
				<div class="lg:col-span-1">
					<h3 class="text-white font-semibold text-lg mb-4">
						<?php esc_html_e( 'Quick Links', 'ecocltr' ); ?>
					</h3>
					<nav>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'space-y-2',
								'container'      => false,
								'fallback_cb'    => false,
								'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
								'walker'         => new class() extends Walker_Nav_Menu {
									function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
										$output .= '<li>';
										$output .= '<a href="' . esc_url( $item->url ) . '" class="text-sage/80 hover:text-white transition-colors inline-block">';
										$output .= esc_html( $item->title );
										$output .= '</a>';
									}
									function end_el( &$output, $item, $depth = 0, $args = null ) {
										$output .= '</li>';
									}
								},
							)
						);
						?>
					</nav>
				</div>

				<!-- Column 3: Contact Information -->
				<div class="lg:col-span-1">
					<h3 class="text-white font-semibold text-lg mb-4">
						<?php esc_html_e( 'Contact Us', 'ecocltr' ); ?>
					</h3>

					<ul class="space-y-3 text-sm">
						<?php if ( $business_phone ) : ?>
							<li class="flex items-start gap-3">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-sage flex-shrink-0 mt-0.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
								</svg>
								<a href="tel:<?php echo esc_attr( ecocltr_phone_href( $business_phone ) ); ?>" class="text-sage/80 hover:text-white transition-colors">
									<?php echo esc_html( $business_phone ); ?>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $business_email ) : ?>
							<li class="flex items-start gap-3">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-sage flex-shrink-0 mt-0.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
								</svg>
								<?php ecocltr_display_obfuscated_email( $business_email, '', true, '', 'text-sage/80 hover:text-white transition-colors' ); ?>
							</li>
						<?php endif; ?>

						<?php if ( $business_address ) : ?>
							<li class="flex items-start gap-3">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-sage flex-shrink-0 mt-0.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
								</svg>
								<address class="text-sage/80 not-italic">
									<a href="<?php echo esc_url( 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $business_address ) ); ?>" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
										<?php echo nl2br( esc_html( $business_address ) ); ?>
									</a>
								</address>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Column 4: Service Areas -->
				<div class="lg:col-span-1">
					<h3 class="text-white font-semibold text-lg mb-4">
						<?php esc_html_e( 'Service Areas', 'ecocltr' ); ?>
					</h3>

					<?php if ( $service_areas_description ) : ?>
						<p class="text-sage/80 text-sm leading-relaxed mb-4">
							<?php echo esc_html( $service_areas_description ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $service_areas_list ) : ?>
						<ul class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-sage/80">
							<?php
							$areas = array_filter( array_map( 'trim', explode( "\n", $service_areas_list ) ) );
							foreach ( $areas as $area ) :
								?>
								<li><?php echo esc_html( $area ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>

			<!-- Bottom Bar: Copyright & Credits -->
			<div class="border-t border-white/10 pt-8">
				<div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-sage/60">
					<div>
						&copy;
						<?php
						$current_year = gmdate( 'Y' );
						if ( $established_year && $established_year < $current_year ) {
							echo esc_html( $established_year . '–' . $current_year );
						} else {
							echo esc_html( $current_year );
						}
						?>
						<?php echo esc_html( $business_name ?: get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'All rights reserved.', 'ecocltr' ); ?>
					</div>
					<div class="flex items-center gap-4">
						<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-white transition-colors">
							<?php esc_html_e( 'Privacy Policy', 'ecocltr' ); ?>
						</a>
						<span class="text-sage/30">|</span>
						<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>" class="hover:text-white transition-colors">
							<?php esc_html_e( 'Terms of Service', 'ecocltr' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
