<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */
?>

	<?php get_header(); ?>



	<?php if( /*is_user_logged_in()*/ true ){ ?>
		<div class="clearfix"></div>

		<?php while(have_posts()): the_post(); ?>
		<?php if($post->post_content=="") : ?><?php else : ?>
		<div id="about" class="widget homepage-widget-blog">
			<div id="homepage-content-container" class="dark">
			<div class="width-container">
				<div class="read-more-container">
					<h1 class="home-widget">ABOUT SALLFEST</h1>
					<?php the_content(); ?>
				</div>
				<div class='clearfix'></div>
			</div><!-- close  .width-container -->
			</div>
		</div><!-- close  #main -->
		<?php endif; ?>
		<?php endwhile; ?>
	<?php } else { ?>
		<?php include 'inc/coming-soon-home.php'; ?>
	<?php } ?>
		<div id="recap" class="widget homepage-widget-blog">
			<div class="dark">
				<div class="width-container">
					<h1 class="home-widget">SALLFEST RECAP 2015</h1>
					<div class="video-container">
						<iframe src="https://www.youtube.com/embed/_xvoG0GGTxk" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

<?php get_footer(); ?>