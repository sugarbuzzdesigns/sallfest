<?php

/**
* Add the field to the checkout
*/
add_action( 'woocommerce_after_order_notes', 'additional_passenger_info' );

function additional_passenger_info( $checkout ) {
  
  $cart_items = WC()->cart->get_cart_item_quantities();
  
  $total_items = get_total_items_in_cart($cart_items);
  
  echo '<div id="additional_passenger_info"><h3>' . __('Additional Passenger Info') . '</h2>';
  
  for($i = 1; $i <= $total_items; ++$i) { ?>
    <div class="passenger">

    <strong><?php echo 'Passenger ' . $i; ?></strong>
    <?php
    woocommerce_form_field( 'passenger_name_' . $i, array(
      'type'          => 'text',
      'class'         => array('my-field-class form-row-wide'),
      'required'      => true,
      'label'         => __('Name'),
      'placeholder'   => __('First Last'),
    ), $checkout->get_value( 'passenger_' . $i )); 
    
    woocommerce_form_field( 'passenger_shirt_size_' . $i, array(
      'type'          => 'select',
      'class'         => array('my-field-class form-row-wide'),
      'required'      => true,
      'label'         => __('T-shirt Size'),
      'options'     => array(
        '' => __('Select a t-shirt size'),
        'S' => __('S'),
        'M' => __('M'),
        'L' => __('L'),
        'XL' => __('XL'),
        'XXL' => __('XXL'),
        'XXXL' => __('XXXL')
      ),
    ), $checkout->get_value( 'passenger_' . $i )); ?>
    
    </div>
    <?php
  }
  
  echo '</div>';
}

/**
* Process the checkout
*/
add_action('woocommerce_checkout_process', 'additional_passenger_info_process');

function additional_passenger_info_process() {
  $cart_items = WC()->cart->get_cart_item_quantities();
  $total_items = get_total_items_in_cart($cart_items);
  // Check if set, if its not set add an error.
  for($i = 1; $i <= $total_items; ++$i) {
    if ( ! $_POST['passenger_name_' . $i] )
    wc_add_notice( __( 'Please enter a name for passenger ' . $i ), 'error' );
    
    if ( ! $_POST['passenger_shirt_size_' . $i] )
    wc_add_notice( __( 'Please choose a t-shirt size for passenger ' . $i ), 'error' );
  }
  
}

/**
* Update the order meta with field value
*/
add_action( 'woocommerce_checkout_update_order_meta', 'additional_passenger_info_update_order_meta' );

function additional_passenger_info_update_order_meta( $order_id ) {
  $cart_items = WC()->cart->get_cart_item_quantities();
  $total_items = get_total_items_in_cart($cart_items);
    
  for($i = 1; $i <= $total_items; ++$i) {
    if ( ! empty( $_POST['passenger_name_' . $i] ) ) {
      update_post_meta( $order_id, 'Passenger ' . $i . ' name', sanitize_text_field( $_POST['passenger_name_' . $i] ) );
    }
    
    if ( ! empty( $_POST['passenger_shirt_size_' . $i] ) ) {
      update_post_meta( $order_id, 'Passenger ' . $i . ' shirt size', sanitize_text_field( $_POST['passenger_shirt_size_' . $i] ) );
    }  
  }
}


add_action('woocommerce_checkout_after_terms_and_conditions', 'add_custom_terms_and_conditions');
function add_custom_terms_and_conditions(){ ?>
    <div>
    <strong>-Disclaimer for credit card authorization:</strong>
    <p>
      By submitting payment via this website, you are authorizing payment to both Shine A Little Love Fest, LLC and Cruise Planners DBA Custom Tours & Cruises, Inc. You are agreeing to pay both the Shine A Little Love Fest event ticket, along with cruise payment. Cruise payment includes both deposit made via the website and final payment made directly with the travel agency before or on the final payment due date. 
    </p>
    </div>
    <div>
    <strong>- Refund Disclaimer</strong>
    <p>
      *No Refunds on SALLFEST Event Ticket after 90 days prior to the event
    </p>
    </div>
    <?php
}
