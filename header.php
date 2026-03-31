<?php
/**
 * Theme header template.
 *
 * @package Ecocltr
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-light text-dark antialiased' ); ?>>
<?php do_action( 'ecocltr_site_before' ); ?>

<a class="skip-link screen-reader-text" href="#main-content">
	<?php esc_html_e( 'Skip to content', 'ecocltr' ); ?>
</a>

<div id="page" class="min-h-screen flex flex-col">
	<?php do_action( 'ecocltr_header' ); ?>

	<?php
	$business_phone    = ecocltr_get_business_info( 'business_phone' );
	$business_email    = ecocltr_get_business_info( 'business_email' );
	$social_facebook   = ecocltr_get_business_info( 'social_facebook' );
	$social_instagram  = ecocltr_get_business_info( 'social_instagram' );
	$social_houzz      = ecocltr_get_business_info( 'social_houzz' );
	$has_contact_info  = $business_phone || $business_email;
	$has_social_links  = $social_facebook || $social_instagram || $social_houzz;

	if ( $has_contact_info || $has_social_links ) :
		?>
		<div class="bg-dark text-white">
			<div class="container mx-auto px-4 py-2 flex flex-row justify-between items-center gap-2 text-sm">
				<?php if ( $has_contact_info ) : ?>
					<div class="flex items-center gap-3 sm:gap-4">
						<?php if ( $business_phone ) : ?>
							<a href="tel:<?php echo esc_attr( ecocltr_phone_href( $business_phone ) ); ?>" class="flex items-center gap-1.5 text-white/80 hover:text-white transition-colors">
								<?php ecocltr_display_icon( 'phone', 'w-4 h-4 flex-shrink-0' ); ?>
								<span class="hidden sm:inline"><?php echo esc_html( $business_phone ); ?></span>
							</a>
						<?php endif; ?>

						<?php if ( $business_email ) : ?>
							<span class="flex items-center gap-1.5 text-white/80 hover:text-white transition-colors">
								<?php ecocltr_display_icon( 'email', 'w-4 h-4 flex-shrink-0' ); ?>
								<span class="hidden sm:inline">
									<?php ecocltr_display_obfuscated_email( $business_email, '', true, '', '' ); ?>
								</span>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $has_social_links ) : ?>
					<div class="flex items-center gap-3">
						<?php if ( $social_facebook ) : ?>
							<a href="<?php echo esc_url( $social_facebook ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors" aria-label="<?php esc_attr_e( 'Facebook', 'ecocltr' ); ?>">
								<?php ecocltr_display_icon( 'facebook', 'w-4 h-4' ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $social_instagram ) : ?>
							<a href="<?php echo esc_url( $social_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors" aria-label="<?php esc_attr_e( 'Instagram', 'ecocltr' ); ?>">
								<?php ecocltr_display_icon( 'instagram', 'w-4 h-4' ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $social_houzz ) : ?>
							<a href="<?php echo esc_url( $social_houzz ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors" aria-label="<?php esc_attr_e( 'Houzz', 'ecocltr' ); ?>">
								<?php ecocltr_display_icon( 'houzz', 'w-4 h-4' ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php ecocltr_display_notification_banner(); ?>

	<header class="container mx-auto py-6">
		<div class="md:flex md:justify-between md:items-center">
			<div class="flex justify-between items-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 min-w-0">
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					if ( $custom_logo_id ) :
						$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
						?>
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-14 w-auto flex-shrink-0 hidden xs:block">
					<?php endif; ?>
					<span class="site-title text-2xl text-dark">
						<?php bloginfo( 'name' ); ?>
					</span>
				</a>

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<div class="md:hidden flex-shrink-0">
						<button type="button" aria-label="<?php esc_attr_e( 'Toggle navigation', 'ecocltr' ); ?>" aria-expanded="false" aria-controls="primary-navigation" id="primary-menu-toggle">
							<?php ecocltr_display_icon( 'menu', 'size-6' ); ?>
						</button>
					</div>
				<?php endif; ?>
			</div>

			<div id="primary-navigation" class="hidden md:flex md:bg-transparent md:flex-1 md:justify-end items-center border border-light md:border-none rounded-xl p-4 md:p-0">
				<nav class="md:flex" aria-label="<?php esc_attr_e( 'Primary Navigation', 'ecocltr' ); ?>">
					<?php if ( current_user_can( 'administrator' ) && ! has_nav_menu( 'primary' ) ) : ?>
						<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="text-sm text-zinc-600"><?php esc_html_e( 'Edit Menus', 'ecocltr' ); ?></a>
					<?php else : ?>
						<?php
						wp_nav_menu(
							array(
								'container_id'    => 'primary-menu',
								'container_class' => '',
								'menu_class'      => 'md:flex md:-mx-4',
								'theme_location'  => 'primary',
								'li_class'        => 'md:mx-4',
								'fallback_cb'     => false,
							)
						);
						?>
					<?php endif; ?>
				</nav>

				<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block mt-4 md:mt-0 md:ml-6 bg-burgundy hover:bg-burgundy-800 text-white font-medium px-5 py-2 rounded-lg transition-colors">
					<?php esc_html_e( 'Contact', 'ecocltr' ); ?>
				</a>
			</div>
		</div>
	</header>

	<div id="content" class="site-content grow">
		<?php do_action( 'ecocltr_content_start' ); ?>
		<main id="main-content" role="main">
