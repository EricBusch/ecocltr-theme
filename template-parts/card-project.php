<?php
/**
 * Template part for displaying a project card.
 *
 * @package Ecocltr
 * @since 1.0.0
 */

$project_id       = get_the_ID();
$project_location = ecocltr_get_field( 'project_location', $project_id );
$project_year     = ecocltr_get_field( 'project_year', $project_id );
?>

<article id="project-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-[4/3] overflow-hidden">
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300',
					'alt'   => esc_attr( get_the_title() ),
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="p-6">
		<h3 class="text-xl font-semibold text-dark mb-2">
			<a href="<?php the_permalink(); ?>" class="hover:text-burgundy transition-colors !no-underline">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $project_location || $project_year ) : ?>
			<div class="flex flex-wrap gap-4 text-sm text-dark/60 mb-4">
				<?php if ( $project_location ) : ?>
					<span class="inline-flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
						</svg>
						<?php echo esc_html( $project_location ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $project_year ) : ?>
					<span class="inline-flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
							<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
						</svg>
						<?php echo esc_html( $project_year ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors !no-underline">
			<?php esc_html_e( 'View Project', 'ecocltr' ); ?>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
				<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
			</svg>
		</a>
	</div>
</article>
