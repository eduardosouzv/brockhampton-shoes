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
  function updateStatus($id, $status)
  {
    $query_uptate_order_status = 'UPDATE orders SET status = :status WHERE id = :id;';

    $uptate_order_status = Connection::prepare($query_uptate_order_status);
    $uptate_order_status->bindParam(':id', $id);
    $uptate_order_status->bindParam(':status', $status);
    $uptate_order_status->execute();

    http_response_code(201);

    return [
      "order_updated" =>  $id,
    ];
  }

  function findOpenOrders($status)
  {
    if (!isset($status)) {
      $query_select_pending_orders = 'SELECT * FROM orders;';

      $select_pending_orders = Connection::prepare($query_select_pending_orders);
      $select_pending_orders->execute();

      $select_pending_orders = $select_pending_orders->fetchAll();

      return $select_pending_orders;
    }

    if ($status === 'PROCESSANDO' || $status === 'CANCELADO' || $status === 'DESPACHADO') {
      $query_select_pending_orders = 'SELECT * FROM orders WHERE status = :status;';

      $select_pending_orders = Connection::prepare($query_select_pending_orders);
      $select_pending_orders->bindParam(':status', $status);
      $select_pending_orders->execute();

      $select_pending_orders = $select_pending_orders->fetchAll();

      http_response_code(200);
      return $select_pending_orders;
    }
    http_response_code(400);
    return;
  }
  function findOrderInformationByID($id)
  {
    $query_select_order_info_by_id =
      'SELECT o.id, u.username, u.street,u.`number`,u.district,u.state,u.zip,
        p.product_name,p.price,p.image_link, s.size_name, ohp.quantity 
        FROM orders o 
        INNER JOIN orders_has_products ohp 
        ON ohp.orders_id = o.id 
        INNER JOIN products p 
        ON p.id = ohp.products_id 
        INNER JOIN products_has_sizes phs 
        ON phs.products_id = p.id 
        INNER JOIN sizes s 
        ON s.id = phs.sizes_id 
        INNER JOIN users u 
        ON u.id = o.users_id 
        WHERE ohp.size_id = phs.sizes_id AND o.id = :id';

    $select_order_info_by_id = Connection::prepare($query_select_order_info_by_id);
    $select_order_info_by_id->bindParam(':id', $id);
    $select_order_info_by_id->execute();

    $orders_info = (array) $select_order_info_by_id->fetchAll();

    if (!count($orders_info)) {
      return [];
    }

    $products = [];

    foreach ($orders_info as $product) {
      $product = (array) $product;

      array_push($products, [
        "product_name" => $product["product_name"],
        "price" => $product["price"],
        "image_link" => $product["image_link"],
        "size_name" => $product["size_name"],
        "quantity" => $product["quantity"]
      ]);
    }

    http_response_code(200);
    return [
      "order_id" => $orders_info[0]->id,
      "username" => $orders_info[0]->username,
      "street" => $orders_info[0]->street,
      "number" => $orders_info[0]->number,
      "district" => $orders_info[0]->district,
      "state" => $orders_info[0]->state,
      "zip" => $orders_info[0]->zip,
      "products" => $products
    ];
  }
}
