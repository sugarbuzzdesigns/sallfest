<?php
/**
 * The template used for displaying page content in homepage.php
 *
 * @package progression
 */
?>
<?php get_header(); ?>
<div class="home-bg-img">
	<img src="<?php echo get_template_directory_uri(); ?>/images/SALL2019_Logo.png" alt="" class="text-logo">
	<img src="<?php echo get_template_directory_uri(); ?>/images/SALL2019_Splash_Wide_web.jpg" alt="" class="logo-bg">
	<img src="<?php echo get_template_directory_uri(); ?>/images/date-text-2019.png" alt="" class="text-date">
</div>
<div class="width-container home-bg">
	<div class="video-grid grid">
		<div class="video-column">
			<h3>1. Booking</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/BookSALLToday.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg"]'); ?>
		</div>		
		<div class="video-column">
			<h3>2. Pre-stay</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/PreStaySALL.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg"]'); ?>
		</div>		
		<div class="video-column">
			<h3>3. Destinations</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/DestinationsSALL.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg"]'); ?>
		</div>
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
