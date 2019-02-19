<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */
?>

	<?php get_header(); ?>
		<div class="stretch">
			<div>
				<div class="save-the-date-text">save the date</div>
				<img class="logo--home" src="<?php echo get_template_directory_uri(); ?>/images/SALLatSEA_Logo_web.png" alt="">
			</div>
		</div>
		<?php // get_template_part( 'content', 'homepage' ); ?>
		<?php get_template_part( 'content', 'homepage-pre-release' ); ?>
	<?php // get_footer(); ?>
