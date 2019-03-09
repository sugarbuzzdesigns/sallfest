<?php
/**
 * The template used for displaying page content in homepage.php
 *
 * @package progression
 */
?>
<?php get_header(); ?>
<div class="home-bg-img">
	<img src="https://www.sallfest.com/wp-content/uploads/2019/03/SALL2019_Logo_updated.png" alt="" class="text-logo">
	<img src="<?php echo get_template_directory_uri(); ?>/images/SALL2019_Splash_Wide_web.jpg" alt="" class="logo-bg">
	<div class="text-date">November 14-17</div>
</div>
<div class="width-container home-bg">
	<div class="video-grid grid">
		<div class="video-column">
			<h3>1. Booking</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/BookSALLToday.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg" preload="metadata"]'); ?>
		</div>		
		<div class="video-column">
			<h3>2. Pre-stay</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/PreStaySALL.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg" preload="metadata"]'); ?>
		</div>		
		<div class="video-column">
			<h3>3. Destinations</h3>
			<?php echo do_shortcode('[videojs_video url="' . get_template_directory_uri() . '/video/DestinationsSALL.mp4" poster="' . get_template_directory_uri() . '/images/video-poster.jpg" preload="metadata"]'); ?>
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
