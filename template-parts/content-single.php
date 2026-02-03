<?php
/**
 * Template part for displaying single post content.
 *
 * @package Ecocltr
 * @since   1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="mx-auto flex max-w-5xl flex-col text-center">
		<h1 class="mt-6 text-3xl font-medium tracking-tight [text-wrap:balance] text-zinc-950 sm:text-4xl"><?php the_title(); ?></h1>

		<?php if ( ! is_page() ) : ?>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" class="order-first text-sm text-zinc-950"><?php echo esc_html( get_the_date() ); ?></time>

			<p class="mt-6 text-sm font-semibold text-zinc-950">
				<?php
				printf(
					/* translators: %s: Author name */
					esc_html__( 'by %s', 'ecocltr' ),
					esc_html( get_the_author() )
				);
				?>
			</p>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="mt-10 sm:mt-20 mx-auto max-w-4xl rounded-4xl bg-light overflow-hidden">
			<?php the_post_thumbnail( 'large', array( 'class' => 'aspect-16/10 w-full object-cover' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content mx-auto max-w-3xl mt-10 sm:mt-20">
		<?php the_content(); ?>
	</div>
</article>
