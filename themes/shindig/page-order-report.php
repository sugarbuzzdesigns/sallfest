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

		<?php //while ( have_posts() ) : the_post(); ?>
			<?php //get_template_part( 'content', 'page' ); ?>
		<?php //endwhile; // end of the loop. ?>

		<div class="clearfix"></div>

		<style>
			.order {
				background: #fff;
				margin-bottom: 10px;
			}

			.order-info {
				background: #fff;
			}

			.order-info__item {
    		padding: 0 10px 20px 20px;
			}

			.order-info__id {
				font-size: 18px;
				display: block;
				background: #e3e3e3;
				padding: 10px;
			}
		</style>

			<?php

				$allOrderItems = [];
				$customer_orders = getCustomerOrders();
				// Iterating through each Order with pending status
				foreach ( $customer_orders as $order ) : 
					$orderId = $order->id;
			?>

			<div class="order-info">
				<h3 class="order-info__id">Order ID: <?php echo $orderId; ?></h3>
				
			<?php foreach($order->get_items() as $item_id => $item_values) : ?>
			<?php
				// pr($item_values);

				$product_id = $item_values['product_id']; // product ID
				$product_name = $item_values['name']; // product name
				$product_subtotal = $item_values['subtotal'];

				$allOrderItems[] = $product_name;
				// Order Item meta data
				$meta = wc_get_order_item_meta( $item_id );
			?>

				<div class="order-info__item">
					<div class="order-info__subtotal">
					<strong>Order Date: </strong><?php echo $order->get_date_created()->format ('m-d-Y'); ?>
					</div>
					<div class="order-info__subtotal">
						<strong>Total:</strong> $<?php echo $product_subtotal; ?>
					</div>
					<div class="order-info__product-name">
							<strong>Ticket Type: </strong><?php echo $product_name; ?>
					</div>

					<?php customerInfo($meta); ?>
					<div>
						<strong>Phone: </strong><?php echo $meta['Contact Information - Phone'][0]; ?>
					</div>
					<div>
						<strong>Email: </strong><?php echo $meta['Contact Information - Email'][0]; ?>
					</div>
					<div>
						<strong>T-Shirt Sizes: </strong><?php echo $meta['T-shirt Sizes - Sizes'][0]; ?>
					</div>
				</div>
			<?php endforeach; ?>

			</div>
			<?php endforeach; ?>
	</div><!-- close .width-container -->

	<div class="width-container">

	<?php

		$allOrderItems = [];
		$customer_orders = getCustomerOrders();
		// Iterating through each Order with pending status
		foreach ( $customer_orders as $order ) : 
			$orderId = $order->id;
	?>
	
	<div class="order-info">

		
	<?php foreach($order->get_items() as $item_id => $item_values) : ?>
	<?php
		// pr($item_values);

		$product_id = $item_values['product_id']; // product ID
		$product_name = $item_values['name']; // product name
		$product_subtotal = $item_values['subtotal'];

		$allOrderItems[] = $product_name;
		// Order Item meta data
		$meta = wc_get_order_item_meta( $item_id );
	?>


				<?php echo $meta['Contact Information - Email'][0]; ?>,

	<?php endforeach; ?>

	</div>
	<?php endforeach; ?>
</div><!-- close .width-container -->	
</div><!-- close #main -->

<?php get_footer(); ?>
