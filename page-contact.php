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
    <section class="py-12 md:py-16 bg-light">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
                <!-- Contact Information -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4 text-pretty">
                            <?php the_title(); ?>
                        </h1>
                        <?php if (has_excerpt() ) : ?>
                            <p class="text-xl text-dark/70 text-pretty leading-relaxed">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        <?php else : ?>
                            <p class="text-xl text-dark/70 text-pretty leading-relaxed">
                                <?php esc_html_e('Let\'s discuss how we can bring your vision to life with sustainable, nature-forward landscaping.', 'ecocltr'); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if ($business_phone || $business_email ) : ?>
                        <div class="space-y-3">
                        <?php if ($business_phone ) : ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $business_phone)); ?>" class="group flex items-center gap-3 text-dark hover:text-olive transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-olive">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                    <span class="text-lg font-medium"><?php echo esc_html($business_phone); ?></span>
                                </a>
                        <?php endif; ?>

                        <?php if ($business_email ) : ?>
                                <div class="flex items-center gap-3 text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-olive flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                    <div class="text-lg font-medium">
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
                        <div class="bg-white rounded-xl p-8 shadow-sm border-l-4 border-burgundy">
                            <div class="mb-4">
                                <svg class="w-10 h-10 text-sage" fill="currentColor" viewBox="0 0 32 32">
                                    <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                                </svg>
                            </div>
                            <blockquote class="text-dark/80 text-lg mb-6 leading-relaxed">
                                <?php echo esc_html($quote); ?>
                            </blockquote>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-sage/20 rounded-full flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-olive">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-dark"><?php echo esc_html($client_name); ?></p>
                                    <p class="text-sm text-dark/60"><?php esc_html_e('EcoCultures Client', 'ecocltr'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($service_areas ) : ?>
                        <div class="bg-white rounded-xl p-8 shadow-sm border border-sage/20">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-sage/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-olive">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-dark">
                        <?php esc_html_e('Service Areas', 'ecocltr'); ?>
                                </h3>
                            </div>
                            <div class="bg-gradient-to-br from-sage/10 to-olive/5 rounded-lg p-6">
                        <?php
                        $areas = array_filter(array_map('trim', explode("\n", $service_areas)));
                        if ($areas ) :
                            ?>
                                    <ul class="grid sm:grid-cols-2 gap-3">
                            <?php foreach ( $areas as $area ) : ?>
                                            <li class="flex items-center text-dark/80 group">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-burgundy mr-3 flex-shrink-0 group-hover:scale-110 transition-transform">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                                <span class="font-medium"><?php echo esc_html($area); ?></span>
                                            </li>
                            <?php endforeach; ?>
                                    </ul>
                        <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($map_image && isset($map_image['url']) ) : ?>
                        <div class="rounded-xl overflow-hidden shadow-lg border-4 border-white">
                            <img
                                src="<?php echo esc_url($map_image['url']); ?>"
                                alt="<?php echo esc_attr($map_image['alt'] ?? __('Service area map', 'ecocltr')); ?>"
                                class="w-full h-auto"
                            >
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Form -->
                <div class="lg:sticky lg:top-8">
                    <div class="bg-gradient-to-br from-white to-sage/5 rounded-2xl shadow-xl p-8 md:p-10 border border-sage/20">
                        <div class="mb-8">
                            <div class="inline-block mb-4">
                                <span class="text-sm font-semibold text-burgundy uppercase tracking-wider"><?php esc_html_e('Quick Response', 'ecocltr'); ?></span>
                                <div class="h-1 w-16 bg-burgundy mt-2"></div>
                            </div>
                            <h2 id="contact-form-heading" class="text-3xl md:text-4xl font-bold text-dark mb-4 text-pretty">
                                <?php esc_html_e('Send Us a Message', 'ecocltr'); ?>
                            </h2>
                            <p class="text-dark/70 text-pretty">
                                <?php esc_html_e('Fill out the form below and we\'ll get back to you within 24 hours.', 'ecocltr'); ?>
                            </p>
                        </div>

                        <?php get_template_part('template-parts/form', 'contact'); ?>

                        <div class="mt-8 pt-8 border-t border-sage/20">
                            <div class="flex items-start text-sm text-dark/60">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-olive mr-2 flex-shrink-0 mt-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                                <p><?php esc_html_e('Your information is secure and will never be shared. We respect your privacy.', 'ecocltr'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
