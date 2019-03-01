<?php

require get_template_directory() . '/inc/custom/remove-fields.php';
require get_template_directory() . '/inc/custom/checkout-fields.php';

/**
* Display field value on the order edit page
*/
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
  echo '<p><strong>'.__('My Field').':</strong> ' . get_post_meta( $order->id, 'My Field', true ) . '</p>';
}

add_action( 'woocommerce_email_order_meta', 'add_email_order_meta', 10, 3 );
/*
* @param $order_obj Order Object
* @param $sent_to_admin If this email is for administrator or for a customer
* @param $plain_text HTML or Plain text (can be configured in WooCommerce > Settings > Emails)
*/
function add_email_order_meta( $order_obj, $sent_to_admin, $plain_text ){
  $items = $order_obj->get_item_count();
  
  echo '<div class="additional-passenger-info">';

  for($i = 1; $i < $items; ++$i) {
    $name = get_post_meta( $order_obj->get_order_number(), 'Passenger ' . $i . ' name', true );
    $shirt_size = get_post_meta( $order_obj->get_order_number(), 'Passenger ' . $i . ' shirt size', true );

    ?>
    
    <div style="margin-bottom: 10px;" class="passenger-info-email">
      <div><strong>Name: </strong><?php echo $name; ?></div>
      <div><strong>T-shirt Size: </strong><?php echo $shirt_size; ?></div>
    </div>

    <?php  

  }
  
  echo '</div>';  
}

add_action( 'woocommerce_order_details_after_order_table', 'misha_view_order_and_thankyou_page', 20 );

function misha_view_order_and_thankyou_page( $order ){  
  $items = $order->get_item_count();

  ?>

  <h2>Additional Passengers Information</h2>
	<table class="asdf woocommerce-table woocommerce-table--order-details shop_table order_details">

		<thead>
			<tr>
				<th class="woocommerce-table__product-name product-name"><?php _e( 'Name', 'woocommerce' ); ?></th>
				<th class="woocommerce-table__product-table product-total"><?php _e( 'T-shirt size', 'woocommerce' ); ?></th>
			</tr>
		</thead>

		<tbody>
      <?php for($i = 1; $i < $items; ++$i) { 
            $name = get_post_meta( $order->get_order_number(), 'Passenger ' . $i . ' name', true );
            $shirt_size = get_post_meta( $order->get_order_number(), 'Passenger ' . $i . ' shirt size', true );
      ?>
        <tr>
          <td>
            <?php echo $name; ?>
          </td>
          <td>
            <?php echo $shirt_size; ?>
          </td>
        </tr>
      <?php } ?>
		</tbody>
	</table>
<?php }

// Check customer age
add_action('woocommerce_checkout_process', 'check_birth_date');
function check_birth_date() {
  // Check billing city 2 field
  if( isset($_POST['billing_birth_date']) && ! empty($_POST['billing_birth_date']) ){
    // Get customer age from birthdate
    $age = date_diff(date_create($_POST['billing_birth_date']), date_create('now'))->y;
    
    // Checking age and display an error notice avoiding checkout (and emptying cart)
    if( $age < 18 ){
      wc_add_notice( __( "You need at least to be 18 years old, to be able to checkout." ), "error" );
      
      WC()->cart->empty_cart(); // <== Empty cart (optional)
    }
  }
}
