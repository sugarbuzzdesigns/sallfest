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
</head>
<body <?php body_class(); ?>>

<header>
	<!-- <?php if (get_theme_mod( 'fixed_nav_pro', '1' )) : ?><div id="fixed-nav-pro"><?php endif; ?> -->
	<?php if (get_theme_mod( 'nav_reposition_pro' )) : ?>
		<div id="left-logo-pro">
		<nav>
			<div class="width-container">
			<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'logo_upload', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo get_theme_mod( 'logo_width', '180' ); ?>" /></a></h1>
			<?php wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false ) ); ?><?php if ( has_nav_menu( 'primary' ) ):  ?><?php else: ?><span class="nav-pro-span"><?php _e( 'Insert Navigation under Appearance > Menus', 'progression' ); ?></span><?php endif; ?><div class="clearfix"></div>
			</div><!-- close .width-container -->
		</nav>
		</div><!-- close #left-logo-pro -->
		<?php if (get_theme_mod( 'fixed_nav_pro', '1' )) : ?></div><!-- close #fixed-nav-pro --><?php endif; ?>
		<div id="gradient-header-pro"></div>
	<?php else: ?>
	<?php endif; ?>
	<div class="width-container">
		<div class="brigade-shield">
			<img src="<?php echo get_bloginfo('template_directory'); ?>/images/brigade-logo.png">
		</div>
		<img id="home-logo" class="logo" src="<?php echo get_bloginfo('template_directory'); ?>/images/SALLFest-1450x800.png" alt="">
	</div>
</header>

<div id="cvhn-homepage-widget" class="light-fonts-pro homepage-widget-blog widget">
	<div class="light">
		<div id="wrapper" class="width-container">
			<div class="inner">
				<h1 class="home-widget">About the Children's Volunteer Health Network</h1>
				<img class="cvhn-logo" src="<?php echo get_bloginfo('template_directory'); ?>/images/cvhn.png">

				<p><a href="http://www.cvhnkids.org/donate/" target="_blank">Children’s Volunteer Health Network</a> began in 2005, when one little boy’s crooked smile touched the heart of Tricia Carlisle-Northcutt. Tricia volunteered at an outreach program at her church, and every Tuesday, Tyler and his little brother were there “only for the cookies,” he would say. Tyler was disruptive, funny and had great leadership potential, but his jumbled mouth of teeth caused him emotional pain. He was called “Monster Mouth” and ridiculed by other children and, in turn, became a bully and show off. He was routinely suspended from school for fighting. Over a period of a few months, Tricia knew that Tyler needed to be helped or he would be a lost child. She also believed there were many more children like Tyler who could not afford dental or medical health care. Through a lot of prayer and research, the idea for Children’s Volunteer Health Network was born. Tricia Carlisle-Northcutt - Founder/President</p>
				<p>Volunteer doctors and dentists could donate their time, and volunteers would make sure the kids got to their appointments. In theory, it sounded great. Getting there was going to be a Herculean task. Tricia called 3 people in her church community and asked them to help form this faith based organization. All three of them said, “let’s do it!” The next step was convincing an orthodontist to see Tyler at no cost. With the first phone call placed and Tyler’s story shared, Dr. Runnels said, “Yes!” Tyler would get his braces. From that day forward, there was no going back. And for Tyler it was life changing. His grades improved, he became manager of his wrestling team and he learned that there was an entire community that cared for him.</p>
				<div class="donate">
					<span><a href="http://www.cvhnkids.org/donate/" target="_blank">Donate Now</a></span>
				</div>
			</div>
		</div>
	</div>
</div>