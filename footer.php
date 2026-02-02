<?php
/**
 * Theme footer template.
 *
 * @package Ecocltr
 */

?>
		</main>

		<?php do_action( 'ecocltr_content_end' ); ?>
	</div>

	<?php do_action( 'ecocltr_content_after' ); ?>

	<footer id="colophon" class="bg-dark text-light" role="contentinfo">
		<div class="container mx-auto py-12">
			<?php do_action( 'ecocltr_footer' ); ?>
			<div class="text-sm text-sage">
				&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> - <?php bloginfo( 'name' ); ?>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
