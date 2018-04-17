<?php
/**
 * The Header for our theme.
 *
 * @package progression
 * @since progression 1.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php get_template_part( 'social', 'sharing' ); ?>
	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body <?php body_class(); ?>>

<!-- <div class="shop-header"> -->
	<?php //wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?><?php if ( has_nav_menu( 'primary' ) ):  ?><?php else: ?><span class="nav-pro-span"><?php _e( 'Insert Navigation under Appearance > Menus', 'progression' ); ?></span><?php endif; ?><div class="clearfix"></div>
  <?php //show_woo_cart(); ?>
<!-- </div> -->
