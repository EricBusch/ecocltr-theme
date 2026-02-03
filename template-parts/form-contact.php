<?php
/**
 * Contact Form Template.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

// Get Static Forms API key from options.
$api_key = ecocltr_get_staticforms_api_key();

// If no API key is set, show an admin notice.
if (! $api_key && current_user_can('manage_options') ) {
    ?>
    <div class="bg-burgundy/10 border border-burgundy/20 rounded-lg p-6">
        <p class="text-burgundy">
    <?php
    printf(
                /* translators: %s: Link to business information settings page */
        esc_html__('Please configure your Static Forms API key in %s to enable the contact form.', 'ecocltr'),
        '<a href="' . esc_url(admin_url('admin.php?page=business-information')) . '" class="underline font-semibold">' . esc_html__('Business Information', 'ecocltr') . '</a>'
    );
    ?>
        </p>
    </div>
    <?php
    return;
}

if (! $api_key ) {
    ?>
    <p class="text-dark/60">
    <?php esc_html_e('The contact form is temporarily unavailable. Please try again later.', 'ecocltr'); ?>
    </p>
    <?php
    return;
}
?>

<form
    id="contact-form"
    class="space-y-6"
    method="POST"
    action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
    role="form"
    aria-labelledby="contact-form-heading"
>
    <!-- Hidden fields for form handler -->
    <input type="hidden" name="action" value="ecocltr_contact">
    <input type="hidden" name="ecocltr_contact_form" value="1">
    <?php wp_nonce_field('ecocltr_contact_form', 'ecocltr_contact_nonce'); ?>

    <!-- Honeypot field for spam protection -->
    <div style="position: absolute; left: -9999px;" aria-hidden="true">
        <label for="contact-form-honeypot">
            <?php esc_html_e('Leave this field empty', 'ecocltr'); ?>
        </label>
        <input type="text" id="contact-form-honeypot" name="honeypot" tabindex="-1" autocomplete="off">
    </div>

    <!-- Name field (required) -->
    <div>
        <label for="contact-name" class="block text-sm font-semibold text-dark mb-2">
            <?php esc_html_e('Name', 'ecocltr'); ?>
            <span class="text-burgundy" aria-label="<?php esc_attr_e('required', 'ecocltr'); ?>">*</span>
        </label>
        <input
            type="text"
            id="contact-name"
            name="name"
            required
            class="w-full px-4 py-3 border border-dark/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-burgundy focus:border-transparent transition-shadow"
            aria-required="true"
            aria-describedby="contact-name-description"
        >
        <span id="contact-name-description" class="sr-only">
            <?php esc_html_e('Enter your full name', 'ecocltr'); ?>
        </span>
    </div>

    <!-- Email field (required) -->
    <div>
        <label for="contact-email" class="block text-sm font-semibold text-dark mb-2">
            <?php esc_html_e('Email', 'ecocltr'); ?>
            <span class="text-burgundy" aria-label="<?php esc_attr_e('required', 'ecocltr'); ?>">*</span>
        </label>
        <input
            type="email"
            id="contact-email"
            name="email"
            required
            class="w-full px-4 py-3 border border-dark/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-burgundy focus:border-transparent transition-shadow"
            aria-required="true"
            aria-describedby="contact-email-description"
        >
        <span id="contact-email-description" class="sr-only">
            <?php esc_html_e('Enter your email address', 'ecocltr'); ?>
        </span>
    </div>

    <!-- Phone field (optional) -->
    <div>
        <label for="contact-phone" class="block text-sm font-semibold text-dark mb-2">
            <?php esc_html_e('Phone Number', 'ecocltr'); ?>
            <span class="text-dark/60 font-normal text-xs ml-1">
                <?php esc_html_e('(optional)', 'ecocltr'); ?>
            </span>
        </label>
        <input
            type="tel"
            id="contact-phone"
            name="phone"
            class="w-full px-4 py-3 border border-dark/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-burgundy focus:border-transparent transition-shadow"
            aria-describedby="contact-phone-description"
        >
        <span id="contact-phone-description" class="sr-only">
            <?php esc_html_e('Enter your phone number (optional)', 'ecocltr'); ?>
        </span>
    </div>

    <!-- Message field (required) -->
    <div>
        <label for="contact-message" class="block text-sm font-semibold text-dark mb-2">
            <?php esc_html_e('Message', 'ecocltr'); ?>
            <span class="text-burgundy" aria-label="<?php esc_attr_e('required', 'ecocltr'); ?>">*</span>
        </label>
        <textarea
            id="contact-message"
            name="message"
            rows="6"
            required
            class="w-full px-4 py-3 border border-dark/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-burgundy focus:border-transparent transition-shadow resize-y"
            aria-required="true"
            aria-describedby="contact-message-description"
        ></textarea>
        <span id="contact-message-description" class="sr-only">
            <?php esc_html_e('Enter your message', 'ecocltr'); ?>
        </span>
    </div>

    <!-- ALTCHA Captcha -->
    <?php if (function_exists('altcha_captcha') ) : ?>
    <div>
        <?php echo do_shortcode('[altcha_widget]'); ?>
    </div>
    <?php endif; ?>

    <!-- Submit button -->
    <div>
        <button
            type="submit"
            class="w-full bg-burgundy hover:bg-burgundy/90 text-light font-semibold py-4 px-6 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-burgundy focus:ring-offset-2"
            aria-label="<?php esc_attr_e('Submit contact form', 'ecocltr'); ?>"
        >
            <?php esc_html_e('Send Message', 'ecocltr'); ?>
        </button>
    </div>

    <!-- Form status messages -->
    <div id="form-status" role="status" aria-live="polite" class="hidden">
        <!-- JavaScript will populate this with success/error messages -->
    </div>
</form>

<!-- Success message (shown when redirected back with ?submitted=true) -->
<?php if (isset($_GET['submitted']) && 'true' === $_GET['submitted'] ) : ?>
    <div class="bg-sage/20 border border-sage rounded-lg p-6 mt-6" role="alert">
        <h3 class="text-lg font-semibold text-olive mb-2">
    <?php esc_html_e('Thank you for your message!', 'ecocltr'); ?>
        </h3>
        <p class="text-dark/80">
    <?php esc_html_e('We\'ve received your inquiry and will get back to you as soon as possible.', 'ecocltr'); ?>
        </p>
    </div>

    <script>
        // Hide the form after successful submission.
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contact-form');
            if (form) {
                form.style.display = 'none';
            }
        });
    </script>
<?php endif; ?>
