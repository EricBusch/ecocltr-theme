<?php
/**
 * Template Name: About
 * Template for the About page.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

get_header();

// Get About page fields.
$owner_photo   = ecocltr_get_field( 'about_owner_photo', get_the_ID() );
$owner_name    = ecocltr_get_field( 'about_owner_name', get_the_ID(), __( 'EcoCultures', 'ecocltr' ) );
$owner_bio     = ecocltr_get_field( 'about_owner_bio', get_the_ID() );
$values        = ecocltr_get_field( 'about_values', get_the_ID() );
$why_choose    = ecocltr_get_field( 'about_why_choose', get_the_ID() );
?>

<div id="primary" class="content-area">
	<!-- Meet the Team Section -->
	<?php if ( $owner_photo || $owner_bio ) : ?>
		<section class="py-16 md:py-24 bg-sage/20">
			<div class="container mx-auto">
				<div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
					<!-- Photo -->
					<div class="order-2 md:order-1">
						<?php if ( $owner_photo ) : ?>
							<div class="rounded-lg overflow-hidden shadow-lg">
								<img
									src="<?php echo esc_url( $owner_photo['url'] ); ?>"
									alt="<?php echo esc_attr( $owner_photo['alt'] ?: $owner_name ); ?>"
									class="w-full h-auto"
								>
							</div>
						<?php else : ?>
							<!-- Placeholder -->
							<div class="rounded-lg overflow-hidden shadow-lg bg-olive/10 aspect-[4/3] flex items-center justify-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-24 h-24 text-olive/30">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
								</svg>
							</div>
						<?php endif; ?>
					</div>

					<!-- Bio -->
					<div class="order-1 md:order-2">
						<p class="text-olive text-sm uppercase tracking-widest font-semibold mb-3">
							<?php esc_html_e( 'Meet the Team', 'ecocltr' ); ?>
						</p>
						<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-6">
							<?php echo esc_html( $owner_name ); ?>
						</h2>
						<?php if ( $owner_bio ) : ?>
							<div class="prose prose-lg max-w-none text-dark/80">
								<?php echo wp_kses_post( wpautop( $owner_bio ) ); ?>
							</div>
						<?php else : ?>
							<p class="text-lg text-dark/70 leading-relaxed">
								<?php esc_html_e( 'I\'ve been passionate about natural landscaping and native plants for over a decade. My approach focuses on creating beautiful, sustainable outdoor spaces that work in harmony with nature.', 'ecocltr' ); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Our Approach / Values Section -->
	<?php if ( $values && is_array( $values ) ) : ?>
		<section class="py-16 md:py-24 bg-white">
			<div class="container mx-auto">
				<div class="text-center mb-12">
					<p class="text-olive text-sm uppercase tracking-widest font-semibold mb-3">
						<?php esc_html_e( 'How We Work', 'ecocltr' ); ?>
					</p>
					<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-4">
						<?php esc_html_e( 'Our Approach', 'ecocltr' ); ?>
					</h2>
				</div>

				<div class="grid md:grid-cols-2 lg:grid-cols-<?php echo esc_attr( min( count( $values ), 4 ) ); ?> gap-8 max-w-6xl mx-auto">
					<?php foreach ( $values as $value ) : ?>
						<?php
						$icon        = isset( $value['icon'] ) ? $value['icon'] : 'passion';
						$title       = isset( $value['title'] ) ? $value['title'] : '';
						$description = isset( $value['description'] ) ? $value['description'] : '';

						// Icon SVG paths.
						$icon_paths = array(
							'passion' => 'M322.4 75.9C335.9 92.4 352.1 114.2 367.7 140.1C372.9 133.3 377.7 127.3 381.9 122.2C392.1 110 402.9 99.2 414.1 88C414.7 87.4 415.4 86.7 416 86.1C427.6 97.7 440.2 110.3 450.7 123C461 135.4 474.7 153.3 488.4 175.4C515.6 219.3 544 281.8 544 352C544 475.7 443.7 576 320 576C196.3 576 96 475.7 96 352C96 260.9 137.1 182 176.5 127C196.4 99.3 216.2 77.1 231.1 61.9C244.5 48.1 258.3 36.2 272.9 23.9C290.6 40.5 306.9 57 322.4 76zM385.9 198.3L363.3 234.3L344.2 196.3C325.2 158.7 302.9 127.8 285.3 106.2C280.1 99.8 275.3 94.2 271.1 89.6C269.3 91.3 267.5 93.2 265.5 95.2C251.9 109.2 233.7 129.5 215.6 154.8C179 205.8 144.1 274.9 144.1 351.8C144.1 449 222.9 527.8 320.1 527.8C417.3 527.8 496.1 449 496.1 351.8C496.1 294.1 472.5 240.5 447.7 200.4C436.4 182.1 425 167 416.1 156C407.6 166.5 396.8 180.8 385.9 198.1zM321.7 480C258.5 480 208 439.4 208 370.8C208 305.2 271.2 256 271.2 256C276.8 263 358.3 366.6 358.3 366.6L408.9 307.8C413.1 313.4 415.9 319 418.7 324.6C444 370.8 432.7 429.6 390.6 459C369.5 473 347.1 480 321.8 480z',
							'nature'  => 'M539.3 64.2C555.4 65.8 568 79.4 568 96L568 128L567.7 139.5C561.9 254 470 345.9 355.5 351.7L344 352L344 552C344 565.3 333.3 576 320 576C306.7 576 296 565.3 296 552L296 416L288 416C168.2 416 70.3 321.9 64.3 203.5L64 192L64 160C64 142.3 78.3 128 96 128L120 128L131.5 128.3C203.5 132 266.5 169.7 304.8 225.6C330.8 135.8 411.5 69.2 508.4 64.3L519.9 64L535.9 64L539.2 64.2zM112 192C112 289.2 190.8 368 288 368L296 368L296 352C296 254.8 217.2 176 120 176L112 176L112 192zM520 112C422.8 112 344 190.8 344 288L344 304C441.2 304 520 225.2 520 128L520 112z',
							'owner'   => 'M598.1 139.4C608.8 131.6 611.2 116.6 603.4 105.9C595.6 95.2 580.6 92.8 569.9 100.6L495.4 154.8L485.5 148.2C465.8 135 442.6 128 418.9 128L359.7 128L359.3 128L215.7 128C189 128 163.2 136.9 142.3 153.1L70.1 100.6C59.4 92.8 44.4 95.2 36.6 105.9C28.8 116.6 31.2 131.6 41.9 139.4L129.9 203.4C139.5 210.3 152.6 209.3 161 201L164.9 197.1C178.4 183.6 196.7 176 215.8 176L262.1 176L170.4 267.7C154.8 283.3 154.8 308.6 170.4 324.3L171.2 325.1C218 372 294 372 340.9 325.1L368 298L465.8 395.8C481.4 411.4 481.4 436.7 465.8 452.4L456 462.2L425 431.2C415.6 421.8 400.4 421.8 391.1 431.2C381.8 440.6 381.7 455.8 391.1 465.1L419.1 493.1C401.6 503.5 381.9 509.8 361.5 511.6L313 463C303.6 453.6 288.4 453.6 279.1 463C269.8 472.4 269.7 487.6 279.1 496.9L294.1 511.9L290.3 511.9C254.2 511.9 219.6 497.6 194.1 472.1L65 343C55.6 333.6 40.4 333.6 31.1 343C21.8 352.4 21.7 367.6 31.1 376.9L160.2 506.1C194.7 540.6 241.5 560 290.3 560L342.1 560L343.1 561L344.1 560L349.8 560C398.6 560 445.4 540.6 479.9 506.1L499.8 486.2C501 485 502.1 483.9 503.2 482.7C503.9 482.2 504.5 481.6 505.1 481L609 377C618.4 367.6 618.4 352.4 609 343.1C599.6 333.8 584.4 333.7 575.1 343.1L521.3 396.9C517.1 384.1 510 372 499.8 361.8L385 247C375.6 237.6 360.4 237.6 351.1 247L307 291.1C280.5 317.6 238.5 319.1 210.3 295.7L309 197C322.4 183.6 340.6 176 359.6 175.9L368.1 175.9L368.3 175.9L419.1 175.9C433.3 175.9 447.2 180.1 459 188L482.7 204C491.1 209.6 502 209.3 510.1 203.4L598.1 139.4z',
						);

						$icon_path = isset( $icon_paths[ $icon ] ) ? $icon_paths[ $icon ] : $icon_paths['passion'];
						?>
						<div class="bg-sage/10 rounded-lg p-6 text-center">
							<div class="w-16 h-16 bg-olive/10 rounded-full flex items-center justify-center mx-auto mb-4">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" class="w-8 h-8 text-olive">
									<path d="<?php echo esc_attr( $icon_path ); ?>" />
								</svg>
							</div>
							<h3 class="text-xl font-semibold text-dark mb-3">
								<?php echo esc_html( $title ); ?>
							</h3>
							<?php if ( $description ) : ?>
								<p class="text-dark/70 leading-relaxed">
									<?php echo esc_html( $description ); ?>
								</p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- Why Choose Us Section -->
	<?php if ( $why_choose && is_array( $why_choose ) ) : ?>
		<section class="py-16 md:py-24 bg-sage/20">
			<div class="container mx-auto">
				<div class="text-center mb-12">
					<p class="text-olive text-sm uppercase tracking-widest font-semibold mb-3">
						<?php esc_html_e( 'Why Work With Us', 'ecocltr' ); ?>
					</p>
					<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-4">
						<?php esc_html_e( 'Why Choose EcoCultures', 'ecocltr' ); ?>
					</h2>
				</div>

				<div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
					<?php foreach ( $why_choose as $item ) : ?>
						<?php $point = isset( $item['point'] ) ? $item['point'] : ''; ?>
						<?php if ( $point ) : ?>
							<div class="flex items-start gap-3 bg-white rounded-lg p-5">
								<div class="flex-shrink-0 mt-1">
									<div class="w-6 h-6 bg-olive rounded-full flex items-center justify-center">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white">
											<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
										</svg>
									</div>
								</div>
								<p class="text-dark font-medium flex-1">
									<?php echo esc_html( $point ); ?>
								</p>
							</div>
						<?php endif; ?>
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
