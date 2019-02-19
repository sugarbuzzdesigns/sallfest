<?php

function pr($data) {
  echo "<pre>";
  var_dump($data); // or var_dump($data);
  echo "</pre>";
}

function getCustomerOrders() {
  $customer_orders = wc_get_orders( array(
    'limit'    => -1,
    'date_paid' => '2018-01-01...2018-12-31',
  ));

  return $customer_orders;
}

function customerInfo($meta) {
  for ($i=1; $i < 9; $i++) {
    if(array_key_exists("Name - ". $i .") Full Name", $meta)){
      echo '<div class="order-info__customer-name"><strong>Name ' . $i . '</strong> - ' . $meta["Name - ". $i .") Full Name"][0] . '</div>';
    }
  }
}
