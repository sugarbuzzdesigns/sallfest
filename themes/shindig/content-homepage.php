<?php
/**
 * The template used for displaying page content in homepage.php
 *
 * @package progression
 */
?>
<?php get_header(); ?>
<div class="width-container home-bg">
	<div class="home-bg-img">
		<img src="<?php echo get_template_directory_uri(); ?>/images/SALL-2019_web.jpg" alt="">
	</div>

	<?php if( is_page_template('homepage.php') ): ?>
		<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
			<?php dynamic_sidebar( 'homepage-widgets' ); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'homepage-all-widgets' ) ) : ?>
		<?php dynamic_sidebar( 'homepage-all-widgets' ); ?>
	<?php endif; ?>

</div>
