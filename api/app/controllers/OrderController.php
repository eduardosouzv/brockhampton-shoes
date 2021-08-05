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

  function updateStatus($id, $status)
  {
    try {
      $order = new Order();

      if (
        !isset($id) ||
        !isset($status)
      ) {
        http_response_code(400);
        throw new Exception('data error');
      }

      return $order->updateStatus($id, $status);
    } catch (Exception $e) {
      http_response_code(500);
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function findOrdersByStatus($status)
  {
    try {
      $order = new Order();

      return $order->findOpenOrders($status);
    } catch (Exception $e) {
      http_response_code(500);
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
  function findOrderInformationByID($id)
  {
    try {
      $order = new Order();

      if (!isset($id)) {
        http_response_code(400);
        return;
      }

      return $order->findOrderInformationByID($id);
    } catch (Exception $e) {
      http_response_code(500);
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
}
