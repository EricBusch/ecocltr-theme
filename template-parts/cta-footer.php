<?php
/**
 * Reusable footer CTA section.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

// Get CTA settings from ACF options or use defaults.
$cta_heading     = ecocltr_get_field( 'footer_cta_heading', 'option', __( 'Ready to Transform Your Landscape?', 'ecocltr' ) );
$cta_description = ecocltr_get_field( 'footer_cta_description', 'option', __( 'Let\'s discuss how we can bring your vision to life with sustainable, nature-forward landscaping.', 'ecocltr' ) );
$cta_button_text = ecocltr_get_field( 'footer_cta_button_text', 'option', __( 'Get in Touch', 'ecocltr' ) );
$business_phone  = ecocltr_get_business_info( 'business_phone' );
?>

<section class="py-20 md:py-28 bg-sage/20">
	<div class="container mx-auto text-center">
		<h2 class="text-pretty text-3xl md:text-4xl font-bold text-dark mb-4">
			<?php echo esc_html( $cta_heading ); ?>
		</h2>

		<p class="text-balance text-lg text-dark/70 max-w-2xl mx-auto mb-8">
			<?php echo esc_html( $cta_description ); ?>
		</p>

		<div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
			<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block bg-burgundy hover:bg-burgundy-800 text-white font-semibold px-10 py-4 rounded-lg transition-all duration-300 hover:scale-105 shadow-lg">
				<?php echo esc_html( $cta_button_text ); ?>
			</a>

			<?php if ( $business_phone ) : ?>
				<span class="text-dark/60 hidden sm:inline">or</span>
				<a href="tel:<?php echo esc_attr( ecocltr_phone_href( $business_phone ) ); ?>" class="inline-flex items-center gap-2 text-dark font-semibold text-lg hover:text-burgundy transition-colors">
					<?php ecocltr_display_icon( 'phone', 'w-5 h-5' ); ?>
					<?php echo esc_html( $business_phone ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
