<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package progression
 */

get_header(); ?>
<div class="width-container"><img id="header-img" attr src="<?php header_image(); ?>"></div>
<div id="page-title">
	<div class="width-container"><h1><?php the_title(); ?></h1></div>
</div><!-- close #page-title -->
<?php if(function_exists('bcn_display')) { echo '<div class="width-container bread-crumb-container"><ul id="bread-crumb"><li><a href="'; echo esc_url( home_url( '/' ) ); echo '">'; echo '<i class="fa fa-home"></i></a></li>'; bcn_display_list(); echo '</ul></div>'; }?>
<div class="clearfix"></div>
</header>

<div id="main">
	<div class="width-container">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>

		<div class="clearfix"></div>

		<style>
			.order-info {
				background: #fff;
				margin-bottom: 10px;
				padding: 10px;
			}
		</style>

	<?php

		function pr($data) {
				echo "<pre>";
				var_dump($data); // or var_dump($data);
				echo "</pre>";
		}

		$customer_orders = wc_get_orders( array(
			'limit'    => -1,
			'date_paid' => '2018-01-01...2018-12-31',
		));

		// Iterating through each Order with pending status
		foreach ( $customer_orders as $order ) {
			// Going through each current customer order items
			?>
			<div class="order-info">
			<?php

			echo($order->id);

			foreach($order->get_items() as $item_id => $item_values){
					$product_id = $item_values['product_id']; // product ID

					pr($item_id);

					// Order Item meta data
					$meta = wc_get_order_item_meta( $item_id );
					// $shirt_sizes = wc_get_order_item_meta( $item_id, 'T-shirt Sizes - Sizes' );
					// $shirt_sizes = wc_get_order_item_meta( $item_id, 'T-shirt Sizes - Sizes' );
					for ($i=1; $i < 9; $i++) {
						if(array_key_exists("Name - ". $i .") Full Name", $meta)){
							echo '<p>Name ' . $i . ' - ' .$meta["Name - ". $i .") Full Name"][0] . '</p>';
						}
					}
					// Some output
					// echo '<p>Line total for '.wc_get_order_item_meta( $item_id, '_line_total', true ).'</p><br>';
			} ?>

			</div>
			<?php
		}
	?>
	</div><!-- close .width-container -->
</div><!-- close #main -->

<?php get_footer(); ?>
