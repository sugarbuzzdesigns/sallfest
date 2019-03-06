<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */
?>

	<?php
		get_template_part( 'content', 'homepage' );
		// if ( is_user_logged_in() ) {
		// 	get_template_part( 'content', 'homepage' );
		// } else {
		// 	get_template_part( 'content', 'homepage-pre-release' );
		// }
		?>	
	<?php get_footer(); ?>
