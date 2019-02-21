<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 1140; /* pixels */

if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */


function progression_setup() {

	if(function_exists( 'set_revslider_as_theme' )){
		add_action( 'init', 'pro_ezio_custom_slider_rev' );
		function pro_ezio_custom_slider_rev() { set_revslider_as_theme(); }
	}

	// Post Thumbnails
	add_theme_support('post-thumbnails');

	add_image_size('progression-header-bg', 1400, 550, true); // Masonry Gallery Image Size
	add_image_size('progression-blog', 800, 450, true); // Blog Index
	add_image_size('progression-blog-single', 1150, 550, true); // Blog Index
	add_image_size('progression-gallery', 800, 800, true ); // Gallery (cropped)


	// Custom Gallery Functions
	add_filter('image_size_names_choose', 'progression_image_sizes');
	function progression_image_sizes($sizes) {
		$addsizes = array(
			"progression-gallery" => __( 'Custom Gallery', 'progression')
	);
	$newsizes = array_merge($sizes, $addsizes);
		return $newsizes;
	}

	add_theme_support( 'title-tag' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
	) );




}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );


/* WooCommerce */
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Display 24 products per page. Goes in functions.php
add_filter('loop_shop_per_page', function($cols) {
	return get_theme_mod( "shop_pagination_pro" );
});
/* WooCommerce Related Products */
function woo_related_products_limit() {
  global $product;
	$col_count_progression = get_theme_mod('shop_col_progression', '3');
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> $col_count_progression,
		'ignore_sticky_posts' 	=> 1,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );






/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'description'   => 'Default Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'progression' ),
		'id' => 'sidebar-shop',
		'description'   => 'WooCommerce Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Widgets', 'progression' ),
		'id' => 'homepage-widgets',
		'description'   => 'Display Home: widgets on the homepage page template',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home: Widgets on all Pages', 'progression' ),
		'id' => 'homepage-all-widgets',
		'description'   => 'Display Home: widgets on all pages above footer',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'description' => __( 'Footer widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-container-footer">',
		'after_widget' => '</div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'progression_widgets_init' );


/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
    $scripts_location = '/js/dist/scripts.min.js';

    if(SCRIPT_DEBUG){
        $scripts_location = '/js/build/scripts.js';
    }

	wp_enqueue_style( 'progression-style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'progression-style' ) );
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom-styles.css', array( 'progression-style' ) );
	wp_enqueue_style( 'sallfest', get_template_directory_uri() . '/css/sallfest-styles.css', array( 'progression-style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic|Khula:400,300,600|Hind:500,600,700', array( 'progression-style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/src/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . $scripts_location, array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );


add_action( 'wp_print_styles', 'progression_deregister_styles', 100 );
function progression_deregister_styles() {
	wp_deregister_style( 'wpba_front_end_styles' );
}

function pro_mobile_menu_insert()
{
    ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		'use strict';
		<?php if (get_theme_mod( 'footer_bg_upload', get_template_directory_uri() . '/images/footer-bg.jpg' )) : ?>
		$("footer").backstretch([ "<?php echo get_theme_mod( 'footer_bg_upload', get_template_directory_uri() . '/images/footer-bg.jpg' ); ?>" ],{ fade: 750, centeredY:true, });
		<?php endif; ?>
		<?php if (is_post_type_archive('schedule')) : ?>
			$('#schedule-content-progression').children('li:not(.<?php $member_group_terms = get_terms( 'schedule_day' ); ?><?php $count = 1; $count_2 = 1; foreach ( $member_group_terms as $member_group_term ) { $member_group_query = new WP_Query( array( 'post_type' => 'schedule','posts_per_page' => '1','tax_query' => array(  array( 'taxonomy' => 'schedule_day', 'field' => 'slug', 'terms' => array( $member_group_term->slug ), 'operator' => 'IN' ) ) )  ); ?><?php if($count == 1): ?><?php echo $member_group_term->slug; ?><?php endif; ?><?php $count ++; $count_2++; $member_group_query = null; wp_reset_postdata(); } ?>)').hide();
		<?php endif; ?>
	});
	</script>
    <?php
}
add_action('wp_footer', 'pro_mobile_menu_insert');

/*
	MetaBox Options from Dev7studios
*/
require get_template_directory() . '/inc/dev7_meta_box_framework.php';
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Plugin Activiation
 */
require get_template_directory() . '/inc/shop-report-page.php';

/**
 * Load Plugin Activiation
 */
require get_template_directory() . '/tgm-plugin-activation/plugin-activation.php';



// define the woocommerce_after_single_product callback
function action_woocommerce_after_single_product(  )
{
	echo 'hey from functions';
};

// add the action
add_action( 'woocommerce_product_after_variable_attributes', 'action_woocommerce_after_single_product', 10, 0 );


/** Do NOT include the opening php tag */


add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
/**
* Custom text for 'woocommerce_product_add_to_cart_text' filter for all product types/ cases.
*
* @link   https://gist.github.com/deckerweb/cf466e017fd01d503469
*
* @global $product
*
* @return string String for add to cart text.
*/
function custom_woocommerce_product_add_to_cart_text() {

	global $product;

	$product_type = $product->get_type();

	switch ( $product_type ) {

		case 'external':
			return __( 'Buy Tickets', 'woocommerce' );

		break;
		case 'grouped':
			return __( 'Buy Tickets', 'woocommerce' );

		break;
		case 'simple':
			return __( 'Buy Tickets', 'woocommerce' );

		break;
		case 'variable':
			return __( 'Buy Tickets', 'woocommerce' );

		break;
		default:
			return __( 'Read more', 'woocommerce' );

	}  // end switch

}  // end function

add_filter('single_add_to_cart_text', 'woo_custom_cart_button_text');

function woo_custom_cart_button_text() {

return __('My Button Text', 'woocommerce');

}


add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
function wcs_woo_remove_reviews_tab($tabs) {
 unset($tabs['reviews']);
 return $tabs;
}

// Change the description tab title to product name
add_filter( 'woocommerce_product_tabs', 'wc_change_product_description_tab_title', 10, 1 );
function wc_change_product_description_tab_title( $tabs ) {
  global $post;
	if ( isset( $tabs['description']['title'] ) )
		$tabs['description']['title'] = $post->post_title;
	return $tabs;
}
// Change the description tab heading to product name
add_filter( 'woocommerce_product_description_heading', 'wc_change_product_description_tab_heading', 10, 1 );
function wc_change_product_description_tab_heading( $title ) {
	global $post;
	return 'Ticket Info';
}

/**
* Preview WooCommerce Emails.
* @author WordImpress.com
* @url https://github.com/WordImpress/woocommerce-preview-emails
* If you are using a child-theme, then use get_stylesheet_directory() instead
*/

$preview = get_template_directory() . '/woocommerce/emails/woo-preview-emails.php';

if(file_exists($preview)) {
    require $preview;
}

function sendinvoice($orderid)
{
    $email = new WC_Email_Customer_Invoice();
    $email->trigger($orderid);
}

add_action('woocommerce_order_status_completed_notification','sendinvoice');




function generatewp_quickedit_custom_posts_columns( $posts_columns ) {
	$posts_columns['generatewp_venue_name'] = __( 'Venue Name', 'generatewp' );
	return $posts_columns;
}
add_filter( 'manage_schedule_posts_columns', 'generatewp_quickedit_custom_posts_columns' );

function generatewp_quickedit_custom_column_display( $column_name, $post_id ) {
	$venue_name = get_post_meta( $post_id, 'progression_schedule_additional_info', true );

	?>
		<div class="venue-name"><?php echo $venue_name; ?></div>
	<?php
}

add_action( 'manage_schedule_posts_custom_column', 'generatewp_quickedit_custom_column_display', 10, 2 );

function generatewp_quickedit_fields( $column_name, $post_type ) {
	$venue_name = get_post_meta( $post_id, 'progression_schedule_additional_info', true );
	?>
	<fieldset class="inline-edit-col-right">
			<div class="inline-edit-col">
					<label>
							<span class="title"><?php esc_html_e( 'Venue Name', 'generatewp' ); ?></span>
							<span class="input-text-wrap">
									<input type="text" name="generatewp_venue_name" class="generatewpedittime" value="">
							</span>
					</label>
			</div>
	</fieldset>
	<?php
}
// add_action( 'quick_edit_custom_box', 'generatewp_quickedit_fields', 10, 2 );

function generatewp_quickedit_save_post( $post_id, $post ) {
	// if called by autosave, then bail here
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

	// if this "post" post type?
	if ( $post->post_type != 'schedule' )
			return;

	// does this user have permissions?
	 if ( ! current_user_can( 'edit_post', $post_id ) )
			 return;

	// update!
	if ( isset( $_POST['generatewp_venue_name'] ) ) {
			update_post_meta( $post_id, 'progression_schedule_additional_info', $_POST['generatewp_venue_name'] );
	}
}
add_action( 'save_post', 'generatewp_quickedit_save_post', 10, 2 );


function generatewp_quickedit_javascript() {
	$current_screen = get_current_screen();
	if ( $current_screen->id != 'edit-post' || $current_screen->post_type != 'schedule' )
			return;

	// Ensure jQuery library loads
	wp_enqueue_script( 'jquery' );
	?>
	<script type="text/javascript">
			jQuery( function( $ ) {
					$( '#the-list' ).on( 'click', 'a.editinline', function( e ) {
							e.preventDefault();
							var editTime = $(this).data( 'edit-time' );
							inlineEditPost.revert();
							$( '.generatewpedittime' ).val( editTime ? editTime : '' );
					});
			});
	</script>
	<?php
}
add_action( 'admin_print_footer_scripts-edit.php', 'generatewp_quickedit_javascript' );

function generatewp_quickedit_set_data( $actions, $post ) {
	$found_value = get_post_meta( $post->ID, 'progression_schedule_additional_info', true );

	if ( $found_value ) {
			if ( isset( $actions['inline hide-if-no-js'] ) ) {
					$new_attribute = sprintf( 'data-edit-time="%s"', esc_attr( $found_value ) );
					$actions['inline hide-if-no-js'] = str_replace( 'class=', "$new_attribute class=", $actions['inline hide-if-no-js'] );
			}
	}

	return $actions;
}

add_filter('post_row_actions', 'generatewp_quickedit_set_data', 10, 2);

function show_woo_cart() {
	global $woocommerce;

	// get cart quantity
	$qty = $woocommerce->cart->get_cart_contents_count();

	// get cart total
	$total = $woocommerce->cart->get_cart_total();

	// get cart url
	$cart_url = wc_get_cart_url();

	// if multiple products in cart
	if($qty>1)
				echo '<a class="cart-contents fa fa-shopping-cart" href="'.$cart_url.'"><span>'.$qty.'</span></a>';

	// if single product in cart
	if($qty==1)
				echo '<a class="cart-contents fa fa-shopping-cart" href="'.$cart_url.'"><span>1</span></a>';
}

add_filter( 'woocommerce_get_script_data', function( $params ) {
	if( false === $params ) {
			$params = array( 'wc_ajax_url' => '/' );
	}
	return $params;
}, 20 );


// check for empty-cart get param to clear the cart
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;

	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}

add_filter('post_row_actions', 'generatewp_quickedit_set_data', 10, 2);


add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) { ?>

	<div class="price price-disclaimer">
		<p><strong>*All prices include $100 per person room deposit</strong></p>
	</div>

<?php
		 $price = '';
		 $productPageClass = is_product() ? 'price-product-page' : 'price-product-list-page';
		 $variation_min_price = $product->get_variation_price('min');
		 $variation_max_price = $product->get_variation_price('max');

		if ( !$variation_min_price || $variation_min_price !== $variation_max_price ) {

			$price .= '<div class="'. $productPageClass .'">';
			$price .= '<div class="early-bird-pricing"><p class="from">' . _x('Early Bird Price', 'min_price', 'woocommerce') . ' </p>';
			$price .= wc_price($product->get_variation_price( 'min', true ));
			$price .= '</div>';
			$price .= '<div class="regular-pricing"><p class="from">' . _x('Regular Price', 'min_price', 'woocommerce') . ' </p>';
			$price .= wc_price($product->get_variation_regular_price( 'min', true ));
			$price .= '</div>';
			$price .= '</div>';
		}

     return $price;
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

show_admin_bar( false );

function wc_empty_cart_redirect_url() {
	return '/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

// add badge when tickets are sold out
add_action( 'woocommerce_before_shop_loop_item_title', function() {
	global $product;
	if ( !$product->is_in_stock() ) {
			echo '<span class="soldout">Sold out</span>';
	}
});
