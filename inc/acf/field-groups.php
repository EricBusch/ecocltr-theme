<?php
/**
 * ACF Field Groups registration.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

/**
 * Register ACF field groups.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ecocltr_register_acf_field_groups()
{
    if (! function_exists('acf_add_local_field_group') ) {
        return;
    }

    // Register options page for business information.
    if (function_exists('acf_add_options_page') ) {
        acf_add_options_page(
            array(
            'page_title' => __('Business Information', 'ecocltr'),
            'menu_title' => __('Business Info', 'ecocltr'),
            'menu_slug'  => 'business-information',
            'capability' => 'manage_options',
            'redirect'   => false,
            'icon_url'   => 'dashicons-store',
            'position'   => 60,
            )
        );
    }

    // Business Information Settings.
    acf_add_local_field_group(
        array(
        'key'      => 'group_business_information',
        'title'    => __('Business Information', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'   => 'field_business_details_tab',
                    'label' => __('Business Details', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_business_name',
                    'label'        => __('Business Name', 'ecocltr'),
                    'name'         => 'business_name',
                    'type'         => 'text',
                    'instructions' => __('Full legal business name.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_business_phone',
                    'label'        => __('Phone Number', 'ecocltr'),
                    'name'         => 'business_phone',
                    'type'         => 'text',
                    'instructions' => __('Primary business phone number.', 'ecocltr'),
                    'placeholder'  => '(519) 555-1234',
                ),
                array(
                    'key'          => 'field_business_email',
                    'label'        => __('Email Address', 'ecocltr'),
                    'name'         => 'business_email',
                    'type'         => 'email',
                    'instructions' => __('Primary business email address.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_business_address',
                    'label'        => __('Business Address', 'ecocltr'),
                    'name'         => 'business_address',
                    'type'         => 'textarea',
                    'instructions' => __('Full mailing address for the business.', 'ecocltr'),
                    'rows'         => 3,
                    'placeholder'  => "123 Main Street\nCity, Province A1B 2C3",
                ),
                array(
                    'key'   => 'field_social_links_tab',
                    'label' => __('Social Media Links', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_social_facebook',
                    'label'        => __('Facebook URL', 'ecocltr'),
                    'name'         => 'social_facebook',
                    'type'         => 'url',
                    'instructions' => __('Full URL to your Facebook page.', 'ecocltr'),
                    'placeholder'  => 'https://facebook.com/yourpage',
                ),
                array(
                    'key'          => 'field_social_instagram',
                    'label'        => __('Instagram URL', 'ecocltr'),
                    'name'         => 'social_instagram',
                    'type'         => 'url',
                    'instructions' => __('Full URL to your Instagram profile.', 'ecocltr'),
                    'placeholder'  => 'https://instagram.com/yourusername',
                ),
                array(
                    'key'          => 'field_social_houzz',
                    'label'        => __('Houzz URL', 'ecocltr'),
                    'name'         => 'social_houzz',
                    'type'         => 'url',
                    'instructions' => __('Full URL to your Houzz profile.', 'ecocltr'),
                    'placeholder'  => 'https://houzz.com/pro/yourprofile',
                ),
                array(
                    'key'   => 'field_footer_settings_tab',
                    'label' => __('Footer Settings', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'           => 'field_footer_description',
                    'label'         => __('Footer Description', 'ecocltr'),
                    'name'          => 'footer_description',
                    'type'          => 'textarea',
                    'instructions'  => __('Short description that appears in the footer below the business name.', 'ecocltr'),
                    'rows'          => 3,
                    'default_value' => __('Creating sustainable, beautiful outdoor spaces across southern Ontario.', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_service_areas_description',
                    'label'         => __('Service Areas Description', 'ecocltr'),
                    'name'          => 'service_areas_description',
                    'type'          => 'textarea',
                    'instructions'  => __('Description of your service area coverage.', 'ecocltr'),
                    'rows'          => 3,
                    'default_value' => __('We proudly serve southern Ontario, from Owen Sound in the west to Collingwood in the east, and as far south as Markdale.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_service_areas_list',
                    'label'        => __('Service Areas List', 'ecocltr'),
                    'name'         => 'service_areas_list',
                    'type'         => 'textarea',
                    'instructions' => __('List of service areas (one per line).', 'ecocltr'),
                    'rows'         => 8,
                    'placeholder'  => "Owen Sound\nCollingwood\nMarkdale\nGrey County\nBlue Mountains",
                ),
                array(
                    'key'           => 'field_established_year',
                    'label'         => __('Year Established', 'ecocltr'),
                    'name'          => 'established_year',
                    'type'          => 'number',
                    'instructions'  => __('The year your business was established.', 'ecocltr'),
                    'default_value' => 2015,
                    'min'           => 1900,
                    'max'           => 2100,
                ),
                array(
                    'key'   => 'field_footer_cta_tab',
                    'label' => __('Footer Call to Action', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'           => 'field_footer_cta_heading',
                    'label'         => __('Heading', 'ecocltr'),
                    'name'          => 'footer_cta_heading',
                    'type'          => 'text',
                    'instructions'  => __('Main heading for the footer call-to-action section.', 'ecocltr'),
                    'default_value' => __('Ready to Transform Your Landscape?', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_footer_cta_description',
                    'label'         => __('Description', 'ecocltr'),
                    'name'          => 'footer_cta_description',
                    'type'          => 'textarea',
                    'instructions'  => __('Short description below the heading.', 'ecocltr'),
                    'rows'          => 2,
                    'default_value' => __('Let\'s discuss how we can bring your vision to life with sustainable, nature-forward landscaping.', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_footer_cta_button_text',
                    'label'         => __('Button Text', 'ecocltr'),
                    'name'          => 'footer_cta_button_text',
                    'type'          => 'text',
                    'instructions'  => __('Text for the CTA button.', 'ecocltr'),
                    'default_value' => __('Get in Touch', 'ecocltr'),
                ),
                array(
                    'key'   => 'field_integrations_tab',
                    'label' => __('Integrations', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'           => 'field_cf7_form_id',
                    'label'         => __('Contact Form 7 Form ID', 'ecocltr'),
                    'name'          => 'cf7_form_id',
                    'type'          => 'number',
                    'instructions'  => __('The ID of the Contact Form 7 form to display on the contact page. Find this in Contact > Contact Forms.', 'ecocltr'),
                    'default_value' => 30,
                    'min'           => 1,
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'options_page',
                        'operator' => '==',
                        'value'    => 'business-information',
                    ),
                ),
        ),
        )
    );

    // Service Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_service_fields',
        'title'    => __('Service Details', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'          => 'field_service_intro',
                    'label'        => __('Introduction', 'ecocltr'),
                    'name'         => 'service_intro',
                    'type'         => 'textarea',
                    'instructions' => __('A brief introduction to this service.', 'ecocltr'),
                    'rows'         => 3,
                ),
                array(
                    'key'                  => 'field_related_services',
                    'label'                => __('Related Services', 'ecocltr'),
                    'name'                 => 'related_services',
                    'type'                 => 'relationship',
                    'instructions'         => __('Select other services that are related or complementary to this one. The relationship works both ways - if you link Service A to Service B, Service B will automatically show Service A as related.', 'ecocltr'),
                    'post_type'            => array( 'service' ),
                    'filters'              => array( 'search', 'taxonomy' ),
                    'return_format'        => 'object',
                    'min'                  => 0,
                    'max'                  => 6,
                    'bidirectional'        => 1,
                    'bidirectional_target' => array( 'field_related_services' ),
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'service',
                    ),
                ),
        ),
        'position' => 'acf_after_title',
        )
    );

    // Project Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_project_fields',
        'title'    => __('Project Details', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'          => 'field_project_location',
                    'label'        => __('Location', 'ecocltr'),
                    'name'         => 'project_location',
                    'type'         => 'text',
                    'instructions' => __('Where was this project located?', 'ecocltr'),
                ),
                array(
                    'key'            => 'field_project_year',
                    'label'          => __('Date Completed', 'ecocltr'),
                    'name'           => 'project_year',
                    'type'           => 'date_picker',
                    'instructions'   => __('When was this project completed?', 'ecocltr'),
                    'display_format' => 'F j, Y',
                    'return_format'  => 'Y-m-d',
                ),
                array(
                    'key'           => 'field_project_gallery',
                    'label'         => __('Project Gallery', 'ecocltr'),
                    'name'          => 'project_gallery',
                    'type'          => 'gallery',
                    'instructions'  => __('Add photos of this project.', 'ecocltr'),
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                    'library'       => 'all',
                    'min'           => 0,
                    'max'           => 20,
                ),
                array(
                    'key'                  => 'field_project_services',
                    'label'                => __('Related Services', 'ecocltr'),
                    'name'                 => 'project_services',
                    'type'                 => 'relationship',
                    'instructions'         => __('Select services used in this project.', 'ecocltr'),
                    'post_type'            => array( 'service' ),
                    'filters'              => array( 'search' ),
                    'return_format'        => 'object',
                    'bidirectional'        => 1,
                    'bidirectional_target' => array( 'field_service_related_projects' ),
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'project',
                    ),
                ),
        ),
        'position' => 'normal',
        )
    );

    // Service Related Projects (bidirectional target).
    acf_add_local_field_group(
        array(
        'key'      => 'group_service_related_projects',
        'title'    => __('Related Projects', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'                  => 'field_service_related_projects',
                    'label'                => __('Related Projects', 'ecocltr'),
                    'name'                 => 'service_related_projects',
                    'type'                 => 'relationship',
                    'instructions'         => __('Projects that feature this service. This field is automatically updated when linking services to projects.', 'ecocltr'),
                    'post_type'            => array( 'project' ),
                    'filters'              => array( 'search' ),
                    'return_format'        => 'object',
                    'bidirectional'        => 1,
                    'bidirectional_target' => array( 'field_project_services' ),
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'service',
                    ),
                ),
        ),
        'position' => 'side',
        )
    );

    // Testimonial Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_testimonial_fields',
        'title'    => __('Testimonial Details', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'          => 'field_testimonial_quote',
                    'label'        => __('Quote', 'ecocltr'),
                    'name'         => 'testimonial_quote',
                    'type'         => 'textarea',
                    'instructions' => __('The testimonial quote.', 'ecocltr'),
                    'required'     => 1,
                    'rows'         => 4,
                ),
                array(
                    'key'          => 'field_testimonial_client_name',
                    'label'        => __('Client Name', 'ecocltr'),
                    'name'         => 'testimonial_client_name',
                    'type'         => 'text',
                    'instructions' => __('Name of the client providing the testimonial.', 'ecocltr'),
                    'required'     => 1,
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'testimonial',
                    ),
                ),
        ),
        'position' => 'acf_after_title',
        )
    );

    // Contact Page Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_contact_fields',
        'title'    => __('Contact Page Settings', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'          => 'field_contact_service_areas',
                    'label'        => __('Service Areas', 'ecocltr'),
                    'name'         => 'contact_service_areas',
                    'type'         => 'textarea',
                    'instructions' => __('List of areas served (one per line).', 'ecocltr'),
                    'rows'         => 5,
                ),
                array(
                    'key'           => 'field_contact_map_image',
                    'label'         => __('Service Area Map', 'ecocltr'),
                    'name'          => 'contact_map_image',
                    'type'          => 'image',
                    'instructions'  => __('Upload a map showing service areas.', 'ecocltr'),
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'page_template',
                        'operator' => '==',
                        'value'    => 'page-contact.php',
                    ),
                ),
        ),
        'position' => 'normal',
        )
    );

    // Homepage Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_homepage_fields',
        'title'    => __('Homepage Settings', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'   => 'field_hero_tab',
                    'label' => __('Hero Section', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_hero_heading',
                    'label'        => __('Hero Heading', 'ecocltr'),
                    'name'         => 'hero_heading',
                    'type'         => 'text',
                    'instructions' => __('Main heading for the hero section.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_hero_subheading',
                    'label'        => __('Hero Subheading', 'ecocltr'),
                    'name'         => 'hero_subheading',
                    'type'         => 'textarea',
                    'instructions' => __('Subheading text below the main heading.', 'ecocltr'),
                    'rows'         => 2,
                ),
                array(
                    'key'           => 'field_hero_video',
                    'label'         => __('Hero Background Video', 'ecocltr'),
                    'name'          => 'hero_video',
                    'type'          => 'file',
                    'instructions'  => __('Upload an MP4 video for the hero background. Recommended: short, looping video without audio.', 'ecocltr'),
                    'return_format' => 'id',
                    'mime_types'    => 'mp4,webm',
                ),
                array(
                    'key'   => 'field_service_categories_tab',
                    'label' => __('Service Categories Section', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'           => 'field_service_categories_eyebrow',
                    'label'         => __('Eyebrow Text', 'ecocltr'),
                    'name'          => 'service_categories_eyebrow',
                    'type'          => 'text',
                    'instructions'  => __('Small text above the heading.', 'ecocltr'),
                    'default_value' => __('How We Can Help', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_service_categories_heading',
                    'label'         => __('Heading', 'ecocltr'),
                    'name'          => 'service_categories_heading',
                    'type'          => 'text',
                    'instructions'  => __('Main heading for the service categories section.', 'ecocltr'),
                    'default_value' => __('What\'s Your Plan?', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_service_categories_description',
                    'label'         => __('Description', 'ecocltr'),
                    'name'          => 'service_categories_description',
                    'type'          => 'textarea',
                    'instructions'  => __('Short description below the heading.', 'ecocltr'),
                    'rows'          => 2,
                    'default_value' => __('Whether you want to attract pollinators, manage stormwater naturally, or restore your property\'s ecology, we have the expertise to make it happen.', 'ecocltr'),
                ),
                array(
                    'key'   => 'field_intro_tab',
                    'label' => __('Introduction Section', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_intro_heading',
                    'label'        => __('Introduction Heading', 'ecocltr'),
                    'name'         => 'intro_heading',
                    'type'         => 'text',
                    'instructions' => __('Heading for the introduction section.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_intro_text',
                    'label'        => __('Introduction Text', 'ecocltr'),
                    'name'         => 'intro_text',
                    'type'         => 'textarea',
                    'instructions' => __('Main text for the introduction section.', 'ecocltr'),
                    'rows'         => 4,
                ),
                array(
                    'key'   => 'field_services_tab',
                    'label' => __('Featured Services', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'           => 'field_featured_services',
                    'label'         => __('Featured Services', 'ecocltr'),
                    'name'          => 'featured_services',
                    'type'          => 'relationship',
                    'instructions'  => __('Select services to feature on the homepage.', 'ecocltr'),
                    'post_type'     => array( 'service' ),
                    'filters'       => array( 'search' ),
                    'return_format' => 'object',
                    'min'           => 0,
                    'max'           => 4,
                ),
                array(
                    'key'   => 'field_service_area_tab',
                    'label' => __('Service Area Section', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_service_area_heading',
                    'label'        => __('Service Area Heading', 'ecocltr'),
                    'name'         => 'service_area_heading',
                    'type'         => 'text',
                    'instructions' => __('Heading for the service area section.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_service_area_text',
                    'label'        => __('Service Area Text', 'ecocltr'),
                    'name'         => 'service_area_text',
                    'type'         => 'textarea',
                    'instructions' => __('Text describing service areas.', 'ecocltr'),
                    'rows'         => 3,
                ),
                array(
                    'key'   => 'field_cta_tab',
                    'label' => __('Call to Action', 'ecocltr'),
                    'type'  => 'tab',
                ),
                array(
                    'key'          => 'field_cta_heading',
                    'label'        => __('CTA Heading', 'ecocltr'),
                    'name'         => 'cta_heading',
                    'type'         => 'text',
                    'instructions' => __('Heading for the call-to-action section.', 'ecocltr'),
                ),
                array(
                    'key'           => 'field_cta_button_text',
                    'label'         => __('CTA Button Text', 'ecocltr'),
                    'name'          => 'cta_button_text',
                    'type'          => 'text',
                    'instructions'  => __('Text for the call-to-action button.', 'ecocltr'),
                    'default_value' => __('Get in Touch', 'ecocltr'),
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'page_type',
                        'operator' => '==',
                        'value'    => 'front_page',
                    ),
                ),
        ),
        'position' => 'normal',
        )
    );
    // Service Category Fields.
    acf_add_local_field_group(
        array(
        'key'      => 'group_service_category_fields',
        'title'    => __('Category Settings', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'           => 'field_service_category_image',
                    'label'         => __('Featured Image', 'ecocltr'),
                    'name'          => 'featured_image',
                    'type'          => 'image',
                    'instructions'  => __('Select a featured image for this service category.', 'ecocltr'),
                    'return_format' => 'array',
                    'preview_size'  => 'medium',
                    'library'       => 'all',
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'taxonomy',
                        'operator' => '==',
                        'value'    => 'service_category',
                    ),
                ),
        ),
        )
    );

    // About Page Settings.
    acf_add_local_field_group(
        array(
        'key'      => 'group_about_page',
        'title'    => __('About Page Content', 'ecocltr'),
        'fields'   => array(
                array(
                    'key'           => 'field_about_hero_tagline',
                    'label'         => __('Hero Tagline', 'ecocltr'),
                    'name'          => 'about_hero_tagline',
                    'type'          => 'text',
                    'instructions'  => __('Short, friendly tagline for the hero section.', 'ecocltr'),
                    'default_value' => __('Bringing nature back to your landscape, one native plant at a time.', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_about_hero_image',
                    'label'        => __('Hero Background Image', 'ecocltr'),
                    'name'         => 'about_hero_image',
                    'type'         => 'image',
                    'instructions' => __('Background image for the hero section (optional).', 'ecocltr'),
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library'      => 'all',
                ),
                array(
                    'key'          => 'field_about_owner_photo',
                    'label'        => __('Owner/Team Photo', 'ecocltr'),
                    'name'         => 'about_owner_photo',
                    'type'         => 'image',
                    'instructions' => __('Photo of the owner or team for the "Meet the Team" section.', 'ecocltr'),
                    'required'     => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library'      => 'all',
                ),
                array(
                    'key'          => 'field_about_owner_name',
                    'label'        => __('Owner Name', 'ecocltr'),
                    'name'         => 'about_owner_name',
                    'type'         => 'text',
                    'instructions' => __('Name of the owner or business.', 'ecocltr'),
                    'default_value' => __('EcoCultures', 'ecocltr'),
                ),
                array(
                    'key'          => 'field_about_owner_bio',
                    'label'        => __('Owner Bio', 'ecocltr'),
                    'name'         => 'about_owner_bio',
                    'type'         => 'textarea',
                    'instructions' => __('First-person bio. Keep it friendly and concise.', 'ecocltr'),
                    'rows'         => 6,
                    'new_lines'    => 'wpautop',
                ),
                array(
                    'key'          => 'field_about_values',
                    'label'        => __('Our Approach / Values', 'ecocltr'),
                    'name'         => 'about_values',
                    'type'         => 'repeater',
                    'instructions' => __('Add 3-4 core values or approaches.', 'ecocltr'),
                    'min'          => 0,
                    'max'          => 6,
                    'layout'       => 'block',
                    'button_label' => __('Add Value', 'ecocltr'),
                    'sub_fields'   => array(
                        array(
                            'key'   => 'field_about_value_icon',
                            'label' => __('Icon', 'ecocltr'),
                            'name'  => 'icon',
                            'type'  => 'select',
                            'choices' => array(
                                'passion'    => __('Passion', 'ecocltr'),
                                'nature'     => __('Rooted in Nature', 'ecocltr'),
                                'owner'      => __('Owner Led', 'ecocltr'),
                            ),
                            'default_value' => 'passion',
                        ),
                        array(
                            'key'   => 'field_about_value_title',
                            'label' => __('Title', 'ecocltr'),
                            'name'  => 'title',
                            'type'  => 'text',
                            'required' => 1,
                        ),
                        array(
                            'key'   => 'field_about_value_description',
                            'label' => __('Description', 'ecocltr'),
                            'name'  => 'description',
                            'type'  => 'textarea',
                            'rows'  => 3,
                        ),
                    ),
                ),
                array(
                    'key'          => 'field_about_why_choose',
                    'label'        => __('Why Choose Us', 'ecocltr'),
                    'name'         => 'about_why_choose',
                    'type'         => 'repeater',
                    'instructions' => __('Add 4-6 brief points about why clients should choose you.', 'ecocltr'),
                    'min'          => 0,
                    'max'          => 8,
                    'layout'       => 'table',
                    'button_label' => __('Add Point', 'ecocltr'),
                    'sub_fields'   => array(
                        array(
                            'key'   => 'field_about_why_point',
                            'label' => __('Point', 'ecocltr'),
                            'name'  => 'point',
                            'type'  => 'text',
                            'required' => 1,
                        ),
                    ),
                ),
        ),
        'location' => array(
                array(
                    array(
                        'param'    => 'page_template',
                        'operator' => '==',
                        'value'    => 'page-about.php',
                    ),
                ),
        ),
        )
    );
}
add_action('acf/init', 'ecocltr_register_acf_field_groups');
