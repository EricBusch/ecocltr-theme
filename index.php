<?php
/**
 * Main template file for displaying posts.
 *
 * @package Ecocltr
 */

get_header();
?>

<div class="container mx-auto space-y-24 lg:space-y-32 pb-16 md:pb-24">
	<?php if ( ! is_singular() ) : ?>
		<?php if ( is_archive() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php the_archive_title(); ?>
				</h1>
			</header>
		<?php elseif ( is_category() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php single_cat_title(); ?>
				</h1>
			</header>
		<?php elseif ( is_tag() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php single_tag_title(); ?>
				</h1>
			</header>
		<?php elseif ( is_author() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php
					printf(
						/* translators: %s: Author name */
						esc_html__( 'Posts by %s', 'ecocltr' ),
						get_the_author()
					);
					?>
				</h1>
			</header>
		<?php elseif ( is_day() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php
					printf(
						/* translators: %s: Date */
						esc_html__( 'Daily Archives: %s', 'ecocltr' ),
						get_the_date()
					);
					?>
				</h1>
			</header>
		<?php elseif ( is_month() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php
					printf(
						/* translators: %s: Date */
						esc_html__( 'Monthly Archives: %s', 'ecocltr' ),
						get_the_date( 'F Y' )
					);
					?>
				</h1>
			</header>
		<?php elseif ( is_year() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php
					printf(
						/* translators: %s: Date */
						esc_html__( 'Yearly Archives: %s', 'ecocltr' ),
						get_the_date( 'Y' )
					);
					?>
				</h1>
			</header>
		<?php elseif ( is_search() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php
					printf(
						/* translators: %s: Search query */
						esc_html__( 'Search results for: %s', 'ecocltr' ),
						get_search_query()
					);
					?>
				</h1>
			</header>
		<?php elseif ( is_404() ) : ?>
			<header class="mb-8">
				<h1 class="text-3xl font-semibold">
					<?php esc_html_e( 'Page Not Found', 'ecocltr' ); ?>
				</h1>
			</header>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part( 'template-parts/content', is_singular() ? 'single' : '' ); ?>
		<?php endwhile; ?>

		<?php TailPress\Pagination::render(); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
