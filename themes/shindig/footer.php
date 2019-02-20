<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package progression
 * @since progression 1.0
 */
?>
		<footer>
			<div class="width-container flex-container">
				<div id="copyright flex-item">
					Contact: <a href="mailto:contact@sallfest.com">contact@sallfest.com</a>
				</div>

				<div id="copyright flex-item">
					<?php echo get_theme_mod( 'copyright_textbox'); ?>
				</div>				
			</div>
		</footer>

	<?php wp_footer(); ?>
	</body>
</html>
