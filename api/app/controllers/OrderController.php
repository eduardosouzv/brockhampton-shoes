<?php
require '../../model/Order.php';

class OrderController
{
  function createOrder($token, $products)
  {
    try {
      $order = new Order();

      if (
        !isset($token) ||
        !count($products)
      ) {
        http_response_code(400);
        throw new Exception('data error');
      }

      return $order->createOrder($token, $products);
    } catch (Exception $e) {
      http_response_code(500);
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
}
