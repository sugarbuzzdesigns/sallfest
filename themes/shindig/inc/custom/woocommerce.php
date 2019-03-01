<?php

add_filter( 'woocommerce_billing_fields', 'add_birth_date_billing_field', 20, 1 );
function add_birth_date_billing_field($billing_fields) {
    unset( $billing_fields['billing_company'] );

    $cart_items = WC()->cart->get_cart_item_quantities();

    $total = 0;

    foreach ($cart_items as $cart_item) {
        $total += $cart_item;
    }

    for($i = 1; $i < $total; ++$i) {
        echo 'guest_' . $i . '_name';
        $billing_fields['traveler_' . $i . '_name'] = array(
            'type'        => 'text',
            'label'       => __('Additional Guest ' . $i . ' Full Name'),
            'class'       => array('form-text flex-item'),
            'priority'    => 20 + $i,
            'required'    => true,
            'clear'       => true,
          ); 
          
          $billing_fields['traveler_' . $i . '_shirt_size'] = array(
            'type'        => 'text',
            'label'       => __('Guest ' . $i . ' Shirt Size'),
            'class'       => array('form-text flex-item'),
            'priority'    => 20 + $i,
            'required'    => true,
            'clear'       => true,
          );           
    }   

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

            WC()->cart->empty_cart(); // <== Empty cart (optional)
        }
    }
}
