<?php
/**
 * Template Name: Contact
 * Template for the Contact page.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

get_header();

// Get business information from options.
$business_phone = ecocltr_get_business_info('business_phone');
$business_email = ecocltr_get_business_info('business_email');

// Get page-specific ACF fields.
$service_areas = ecocltr_get_field('contact_service_areas');
$map_image     = ecocltr_get_field('contact_map_image');
?>

<div id="primary" class="content-area">
    <section class="relative bg-light min-h-[600px] overflow-x-clip">
        <!-- Sage background extending from left edge to middle of page -->
        <div class="absolute inset-y-0 left-0 w-full lg:w-1/2 bg-sage/20"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-[minmax(0,1fr)] lg:grid-cols-2 items-start gap-4 lg:gap-20 py-10 md:py-14 lg:py-20">
                <!-- Contact Information -->
                <div class="min-w-0 space-y-8 lg:space-y-10 px-4 md:px-8 lg:pr-12">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-dark mb-6 text-pretty">
                            <?php the_title(); ?>
                        </h1>
                        <?php if (has_excerpt() ) : ?>
                            <p class="text-lg text-dark/70 leading-relaxed max-w-md">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        <?php else : ?>
                            <p class="text-lg text-dark/70 leading-relaxed max-w-md">
                                <?php esc_html_e('Let\'s discuss how we can bring your vision to life with sustainable, nature-forward landscaping.', 'ecocltr'); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if ($business_phone || $business_email || $service_areas ) : ?>
                        <div class="space-y-6">
                            <?php if ($service_areas ) : ?>
                                <?php
                                $areas = array_filter(array_map('trim', explode("\n", $service_areas)));
                                if ($areas ) :
                                    $address = implode(', ', array_slice($areas, 0, 2));
                                    ?>
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 mt-1">
                                            <?php ecocltr_display_icon( 'map-pin', 'w-6 h-6 text-dark/70' ); ?>
                                        </div>
                                        <div class="text-dark/70">
                                            <?php echo esc_html($address); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($business_phone ) : ?>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <?php ecocltr_display_icon( 'phone', 'w-6 h-6 text-olive' ); ?>
                                    </div>
                                    <a href="tel:<?php echo esc_attr(ecocltr_phone_href( $business_phone )); ?>" class="text-lg font-semibold text-dark hover:text-olive transition-colors">
                                        <?php echo esc_html($business_phone); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($business_email ) : ?>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <?php ecocltr_display_icon( 'email', 'w-6 h-6 text-olive' ); ?>
                                    </div>
                                    <div class="text-lg font-semibold text-dark">
                                        <?php ecocltr_display_obfuscated_email($business_email, '', true, '', ''); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Get a random testimonial.
                    $testimonial = ecocltr_get_random_testimonial();
                    if ($testimonial ) :
                        $quote       = get_field('testimonial_quote', $testimonial->ID);
                        $client_name = get_field('testimonial_client_name', $testimonial->ID);
                        ?>
                        <div class="hidden lg:block bg-white/20 backdrop-blur-sm rounded-lg p-6 border border-white/40">
                            <blockquote class="text-dark/70 text-lg leading-relaxed italic">
                                <p class="mb-4">"<?php echo esc_html($quote); ?>"</p>
                                <footer class="font-semibold text-dark not-italic">
                                    <cite><?php echo esc_html($client_name); ?></cite>
                                </footer>
                            </blockquote>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Form -->
                <div class="min-w-0 lg:sticky lg:top-8 px-4 md:px-8 lg:pl-12">
                    <?php get_template_part('template-parts/form', 'contact'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
