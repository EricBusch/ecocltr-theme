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
			<div class="container mx-auto py-2 flex flex-col sm:flex-row justify-between items-center gap-2 text-sm">
				<?php if ( $has_contact_info ) : ?>
					<div class="flex items-center gap-4">
						<?php if ( $business_phone ) : ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $business_phone ) ); ?>" class="flex items-center gap-1.5 text-white/80 hover:text-white transition-colors !no-underline">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
								</svg>
								<?php echo esc_html( $business_phone ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $business_email ) : ?>
							<span class="flex items-center gap-1.5 text-white/80 hover:text-white transition-colors">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
								<?php ecocltr_display_obfuscated_email( $business_email, '', true, '', '!no-underline' ); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $has_social_links ) : ?>
					<div class="flex items-center gap-3">
						<?php if ( $social_facebook ) : ?>
							<a href="<?php echo esc_url( $social_facebook ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors !no-underline" aria-label="<?php esc_attr_e( 'Facebook', 'ecocltr' ); ?>">
								<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
									<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $social_instagram ) : ?>
							<a href="<?php echo esc_url( $social_instagram ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors !no-underline" aria-label="<?php esc_attr_e( 'Instagram', 'ecocltr' ); ?>">
								<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
									<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $social_houzz ) : ?>
							<a href="<?php echo esc_url( $social_houzz ); ?>" target="_blank" rel="noopener noreferrer" class="text-white/80 hover:text-white transition-colors !no-underline" aria-label="<?php esc_attr_e( 'Houzz', 'ecocltr' ); ?>">
								<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 640 640">
									<path d="M372 394.7L267.4 394.7L267.4 544L113.1 544L113.1 96L222.6 96L222.6 200.5L527.7 286.1L527.7 544L372 544L372 394.7z"/>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<header class="container mx-auto py-6">
		<div class="md:flex md:justify-between md:items-center">
			<div class="flex justify-between items-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 !no-underline">
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					if ( $custom_logo_id ) :
						$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
						?>
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-14 w-auto">
					<?php endif; ?>
					<span class="font-medium text-lg text-dark">
						<?php bloginfo( 'name' ); ?>
					</span>
				</a>

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<div class="md:hidden">
						<button type="button" aria-label="<?php esc_attr_e( 'Toggle navigation', 'ecocltr' ); ?>" id="primary-menu-toggle">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
							</svg>
						</button>
					</div>
				<?php endif; ?>
			</div>

			<div id="primary-navigation" class="hidden md:flex md:bg-transparent gap-6 items-center border border-light md:border-none rounded-xl p-4 md:p-0">
				<nav>
					<?php if ( current_user_can( 'administrator' ) && ! has_nav_menu( 'primary' ) ) : ?>
						<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="text-sm text-zinc-600"><?php esc_html_e( 'Edit Menus', 'ecocltr' ); ?></a>
					<?php else : ?>
						<?php
						wp_nav_menu(
							array(
								'container_id'    => 'primary-menu',
								'container_class' => '',
								'menu_class'      => 'md:flex md:-mx-4 [&_a]:!no-underline',
								'theme_location'  => 'primary',
								'li_class'        => 'md:mx-4',
								'fallback_cb'     => false,
							)
						);
						?>
					<?php endif; ?>
				</nav>

				<a href="<?php echo esc_url( ecocltr_get_contact_url() ); ?>" class="inline-block mt-4 md:mt-0 bg-burgundy hover:bg-burgundy-800 text-white font-medium px-5 py-2 rounded-lg transition-colors !no-underline">
					<?php esc_html_e( 'Contact', 'ecocltr' ); ?>
				</a>
			</div>
		</div>
	</header>

	<div id="content" class="site-content grow">
		<?php do_action( 'ecocltr_content_start' ); ?>
		<main>
