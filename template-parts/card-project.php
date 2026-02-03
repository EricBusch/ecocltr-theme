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

<article id="project-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden flex flex-col h-full' ); ?>>
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

	<div class="p-6 flex flex-col flex-grow">
		<h3 class="text-lg font-semibold text-dark mb-1.5">
			<a href="<?php the_permalink(); ?>" class="hover:text-burgundy transition-colors leading-tight inline-block">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $project_location || $project_year ) : ?>
			<div class="flex flex-wrap gap-4 text-sm text-dark/60 mb-4">
				<?php if ( $project_location ) : ?>
					<span class="inline-flex items-center">
						<?php ecocltr_display_icon( 'map-pin', 'w-4 h-4 mr-1' ); ?>
						<?php echo esc_html( $project_location ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $project_year ) : ?>
					<span class="inline-flex items-center">
						<?php ecocltr_display_icon( 'calendar', 'w-4 h-4 mr-1' ); ?>
						<?php echo esc_html( gmdate( 'Y', strtotime( $project_year ) ) ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-burgundy font-medium text-sm hover:text-burgundy-800 transition-colors mt-auto">
			<?php esc_html_e( 'View Project', 'ecocltr' ); ?>
			<?php ecocltr_display_icon( 'arrow-right', 'w-4 h-4 ml-1' ); ?>
		</a>
	</div>
</article>
