<?php

require get_template_directory() . '/inc/custom/remove-fields.php';
require get_template_directory() . '/inc/custom/checkout-fields.php';

/**
* Display field value on the order edit page
*/
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
  echo '<p><strong>'.__('DOB: ').'</strong> ' . get_post_meta( $order->get_id(), '_billing_birth_date', true ) . '</p>';
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


add_filter( 'woocommerce_billing_fields', 'add_birth_date_billing_field', 20, 1 );
function add_birth_date_billing_field($billing_fields) {

  $billing_fields['billing_birth_date'] = array(
      'type'        => 'date',
      'label'       => __('Birth date'),
      'class'       => array('form-row-wide'),
      'priority'    => 25,
      'required'    => true,
      'clear'       => true,
  );
  return $billing_fields;
}
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
    }
  }
}


// add the action 
add_action( 'woocommerce_order_item_meta_start', 'action_woocommerce_order_item_meta_start', 10, 3 ); 
function action_woocommerce_order_item_meta_start( $item_id, $item, $order ) { 
  $dob = get_post_meta( $order->get_order_number(), '_billing_birth_date', true );

  echo '<div><strong>DOB</strong>: ' . $dob . '</div>';
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
