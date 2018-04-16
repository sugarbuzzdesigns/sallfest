<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */
?>

	<?php get_header(); ?>

		<div class="clearfix"></div>

		<?php //while(have_posts()): the_post(); ?>
		<?php //if($post->post_content=="") : ?><?php //else : ?>
		<div id="about" class="widget homepage-widget-blog">
			<div id="homepage-content-container" class="dark">
			<div class="width-container">
				<div class="read-more-container">
					<!-- <h1 class="home-widget">ABOUT SALLFEST</h1> -->
					<?php //the_content(); ?>
				</div>
				<div class='clearfix'></div>
			</div>
			</div>
		</div>
		<?php //endif; endwhile; ?>
	<?php get_footer(); ?>
