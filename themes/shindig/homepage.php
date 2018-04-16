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
			<div class="stretch__bg background-image--home">
			<img class="logo--home" src="<?php echo get_template_directory_uri(); ?>/images/SALLatSEA_Logo_web.png" alt="">
			</div>
			<div class="width-container">
		</div>

		<div class="width-container">

		<?php if( is_page_template('homepage.php') ): ?>
			<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
				<?php dynamic_sidebar( 'homepage-widgets' ); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'homepage-all-widgets' ) ) : ?>
			<?php dynamic_sidebar( 'homepage-all-widgets' ); ?>
		<?php endif; ?>

		</div>

	<?php get_footer(); ?>
