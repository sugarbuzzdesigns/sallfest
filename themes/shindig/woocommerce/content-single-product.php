<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<div class="container-single-pro">
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
		</div><!-- close .container-single-pro -->
	</div><!-- .summary -->

	
	<div class="clearfix"></div>
	<div class="single-container-reviews-pro">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

<style>
	.addon-wrap-101-names + .addon-wrap-101-names {
		display: none;
	}
</style>

<script>
	// (function($){
	// 	$(function(){
	// 		function addField(num){
	// 			$('.addon-wrap-101-names').eq(num-1).show();

	// 			lastField = $('.addon-wrap-101-names').last();
	// 		};

	// 		function removeField(num){
	// 			console.log(num);
	// 			if (num === 1) {return};
	// 			console.log('remove field');
	// 			$('.addon-wrap-101-names').eq(num).hide();

	// 			lastField = $('.addon-wrap-101-names').last();
	// 		};			

	// 		var startNumber = $('[name="quantity"]').val();
	// 		var curNumber = $('[name="quantity"]').val();
	// 		var startField = $('.addon-wrap-101-names').eq(0);
	// 		var lastField = $('.addon-wrap-101-names').last();

	// 		$('[name="quantity"]').on('change', function(){
	// 			curNumber = $(this).val();

	// 			$('.addon-wrap-101-names').each(function(){

	// 			});			
	// 		});
	// 	});
	// })(jQuery);
</script>