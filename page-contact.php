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
    <section class="relative bg-light min-h-[600px]">
        <!-- Sage background extending from left edge to middle of page -->
        <div class="absolute inset-y-0 left-0 w-full lg:w-1/2 bg-sage/20"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 py-16 md:py-24">
                <!-- Contact Information -->
                <div class="space-y-10 px-4 md:px-8 lg:pr-12">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-dark/60">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-olive">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                    </div>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $business_phone)); ?>" class="text-lg font-semibold text-dark hover:text-olive transition-colors">
                                        <?php echo esc_html($business_phone); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($business_email ) : ?>
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-olive">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
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
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6 border border-white/40">
                            <blockquote class="text-dark/70 text-lg mb-4 leading-relaxed italic">
                                "<?php echo esc_html($quote); ?>"
                            </blockquote>
                            <p class="font-semibold text-dark"><?php echo esc_html($client_name); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Form -->
                <div class="lg:sticky lg:top-8 px-4 md:px-8 lg:pl-12">
                    <?php get_template_part('template-parts/form', 'contact'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
