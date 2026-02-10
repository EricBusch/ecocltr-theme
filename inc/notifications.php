<?php
/**
 * Notification banner functions.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

/**
 * Get hardcoded Tailwind classes for notification types.
 *
 * Classes are hardcoded to ensure they're included in the Tailwind build.
 *
 * @param string $type Notification type.
 * @return array Array with 'bg', 'text', 'border', and 'button' classes.
 * @since 1.0.0
 */
function ecocltr_get_notification_classes( $type ) {
	$classes = array();

	switch ( $type ) {
		case 'success-theme':
			$classes = array(
				'bg'     => 'bg-sage/20',
				'text'   => 'text-dark',
				'border' => 'border-sage',
				'button' => 'bg-sage hover:bg-sage-600 text-dark',
			);
			break;

		case 'success-standard':
			$classes = array(
				'bg'     => 'bg-green-50',
				'text'   => 'text-green-900',
				'border' => 'border-green-200',
				'button' => 'bg-green-600 hover:bg-green-700 text-white',
			);
			break;

		case 'danger-theme':
			$classes = array(
				'bg'     => 'bg-burgundy/10',
				'text'   => 'text-burgundy-900',
				'border' => 'border-burgundy',
				'button' => 'bg-burgundy hover:bg-burgundy-800 text-white',
			);
			break;

		case 'danger-standard':
			$classes = array(
				'bg'     => 'bg-red-50',
				'text'   => 'text-red-900',
				'border' => 'border-red-200',
				'button' => 'bg-red-600 hover:bg-red-700 text-white',
			);
			break;

		case 'info-theme':
			$classes = array(
				'bg'     => 'bg-olive/10',
				'text'   => 'text-olive',
				'border' => 'border-olive',
				'button' => 'bg-olive hover:bg-olive/90 text-white',
			);
			break;

		case 'info-standard':
			$classes = array(
				'bg'     => 'bg-blue-50',
				'text'   => 'text-blue-900',
				'border' => 'border-blue-200',
				'button' => 'bg-blue-600 hover:bg-blue-700 text-white',
			);
			break;

		case 'warning':
			$classes = array(
				'bg'     => 'bg-yellow-50',
				'text'   => 'text-yellow-900',
				'border' => 'border-yellow-200',
				'button' => 'bg-yellow-600 hover:bg-yellow-700 text-white',
			);
			break;

		default:
			$classes = array(
				'bg'     => 'bg-blue-50',
				'text'   => 'text-blue-900',
				'border' => 'border-blue-200',
				'button' => 'bg-blue-600 hover:bg-blue-700 text-white',
			);
			break;
	}

	return $classes;
}

/**
 * Check if notification should be displayed.
 *
 * @return bool True if notification should display.
 * @since 1.0.0
 */
function ecocltr_should_display_notification() {
	// Check if notification is enabled.
	$enabled = ecocltr_get_field( 'notification_enabled', 'option' );
	if ( ! $enabled ) {
		return false;
	}

	// Get date range.
	$start_date = ecocltr_get_field( 'notification_start_date', 'option' );
	$end_date   = ecocltr_get_field( 'notification_end_date', 'option' );
	$today      = current_time( 'Y-m-d' );

	// Check start date.
	if ( $start_date && $today < $start_date ) {
		return false;
	}

	// Check end date.
	if ( $end_date && $today > $end_date ) {
		return false;
	}

	// Check if there's notification text.
	$text = ecocltr_get_field( 'notification_text', 'option' );
	if ( empty( $text ) ) {
		return false;
	}

	return true;
}

/**
 * Display the notification banner.
 *
 * @return void
 * @since 1.0.0
 */
function ecocltr_display_notification_banner() {
	if ( ! ecocltr_should_display_notification() ) {
		return;
	}

	$type     = ecocltr_get_field( 'notification_type', 'option', 'info-standard' );
	$text     = ecocltr_get_field( 'notification_text', 'option' );
	$cta_text = ecocltr_get_field( 'notification_cta_text', 'option' );
	$cta_url  = ecocltr_get_field( 'notification_cta_url', 'option' );

	$classes = ecocltr_get_notification_classes( $type );
	?>
	<div class="<?php echo esc_attr( $classes['bg'] . ' ' . $classes['text'] ); ?> border-b <?php echo esc_attr( $classes['border'] ); ?>" role="alert">
		<div class="container mx-auto px-4 py-3 md:py-4">
			<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
				<!-- Notification Text -->
				<div class="notification-content flex-1 text-sm md:text-base leading-relaxed">
					<?php
					// Allow only basic HTML tags for styling.
					echo wp_kses(
						$text,
						array(
							'strong' => array(),
							'em'     => array(),
							'b'      => array(),
							'i'      => array(),
							'a'      => array(
								'href'   => array(),
								'title'  => array(),
								'target' => array(),
								'rel'    => array(),
							),
							'p'      => array(),
							'br'     => array(),
						)
					);
					?>
				</div>

				<!-- CTA Button -->
				<?php if ( $cta_text && $cta_url ) : ?>
					<div class="flex-shrink-0">
						<a
							href="<?php echo esc_url( $cta_url ); ?>"
							class="inline-block <?php echo esc_attr( $classes['button'] ); ?> font-semibold px-6 py-2 rounded-lg transition-colors text-sm md:text-base whitespace-nowrap"
						>
							<?php echo esc_html( $cta_text ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}
