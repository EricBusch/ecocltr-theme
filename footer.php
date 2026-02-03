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
									<?php ecocltr_display_icon( 'facebook', 'w-5 h-5' ); ?>
								</a>
							<?php endif; ?>

							<?php if ( $social_instagram ) : ?>
								<a href="<?php echo esc_url( $social_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-burgundy flex items-center justify-center transition-colors" aria-label="<?php esc_attr_e( 'Instagram', 'ecocltr' ); ?>">
									<?php ecocltr_display_icon( 'instagram', 'w-5 h-5' ); ?>
								</a>
							<?php endif; ?>

							<?php if ( $social_houzz ) : ?>
								<a href="<?php echo esc_url( $social_houzz ); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-burgundy flex items-center justify-center transition-colors" aria-label="<?php esc_attr_e( 'Houzz', 'ecocltr' ); ?>">
									<?php ecocltr_display_icon( 'houzz', 'w-5 h-5' ); ?>
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
								<?php ecocltr_display_icon( 'phone', 'w-5 h-5 text-sage flex-shrink-0 mt-0.5' ); ?>
								<a href="tel:<?php echo esc_attr( ecocltr_phone_href( $business_phone ) ); ?>" class="text-sage/80 hover:text-white transition-colors">
									<?php echo esc_html( $business_phone ); ?>
								</a>
							</li>
						<?php endif; ?>

						<?php if ( $business_email ) : ?>
							<li class="flex items-start gap-3">
								<?php ecocltr_display_icon( 'email', 'w-5 h-5 text-sage flex-shrink-0 mt-0.5' ); ?>
								<?php ecocltr_display_obfuscated_email( $business_email, '', true, '', 'text-sage/80 hover:text-white transition-colors' ); ?>
							</li>
						<?php endif; ?>

						<?php if ( $business_address ) : ?>
							<li class="flex items-start gap-3">
								<?php ecocltr_display_icon( 'map-pin', 'w-5 h-5 text-sage flex-shrink-0 mt-0.5' ); ?>
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
