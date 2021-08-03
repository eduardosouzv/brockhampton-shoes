<?php

include '../../../database/Connection.php';

class Order extends Connection
{
  private static function getSizeIDByName($size_name)
  {
    $query_find_size_name = "SELECT id FROM sizes WHERE size_name = :size_name";

    $result = Connection::prepare($query_find_size_name);
    $result->bindParam(':size_name', $size_name);
    $result->execute();
    $result = (array) $result->fetch();

    if (!count($result)) {
      http_response_code(404);
      throw new Exception('size not found');
    }

    return $result["id"];
  }

  function createOrder($token, $products)
  {
    $query_token_info =
      "SELECT users_id ,generated_in, expires_in 
      FROM sessions WHERE token = :token;";

    $token_info = Connection::prepare($query_token_info);
    $token_info->bindParam(':token', $token);
    $token_info->execute();
    $token_info = (array) $token_info->fetch();

    $now_date = date('Y-m-d H:i:s');

    if ($now_date >= $token_info['expires_in']) {
      http_response_code(401);
      return new Exception('unauthorized');
    }

    $query_create_order = 'INSERT INTO orders (users_id, status)
      VALUES (:users_id, :order_status)';
    $create_order = Connection::prepare($query_create_order);
    $create_order->bindParam(':users_id', $token_info['users_id']);
    $create_order->bindValue(':order_status', 'PROCESSANDO');
    $create_order->execute();

    $last_insert_id = Connection::getInstance()->lastInsertId();

    foreach ($products as $product) {
      $size_id = self::getSizeIDByName($product["size"]);

      $query_add_product_in_order = 'INSERT INTO orders_has_products (orders_id, products_id, size_id, quantity)
      VALUES (:orders_id, :products_id, :size_id, :quantity)';

      $add_product_in_order = Connection::prepare($query_add_product_in_order);
      $add_product_in_order->bindParam(':orders_id', $last_insert_id);
      $add_product_in_order->bindParam(':products_id', $product["product_id"]);
      $add_product_in_order->bindParam(':size_id', $size_id);
      $add_product_in_order->bindParam(':quantity', $product["quantity"]);

      $add_product_in_order->execute();
    }

    http_response_code(201);

    return [
      "order_created" =>  $last_insert_id,
    ];
  }
}
