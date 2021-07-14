<?php

include '../../../database/Connection.php';

class Product extends Connection
{
  public function createProduct($product_name, $product_description, $product_price, $product_size)
  {

    $query_to_find_size_id = "SELECT * FROM sizes WHERE size_name =" . $product_size;
    $found_size = Connection::prepare($query_to_find_size_id);
    $found_size->execute();
    $found_size = (array) $found_size->fetchAll()[0];
    $product_size_id = $found_size["id"];

    if (!isset($product_size_id)) {
      http_response_code(404);
      throw new Exception('size not found');
    }

    $query = "INSERT INTO products (product_name, description,price, sizes_id)
    VALUES (:product_name, :product_description, :product_price, :product_size)";

    $result = Connection::prepare($query);
    $result->bindParam(':product_name', $product_name);
    $result->bindParam(':product_description', $product_description);
    $result->bindParam(':product_price', $product_price);
    $result->bindParam(':product_size', $product_size_id);

    $result->execute();

    http_response_code(201);
    return [
      "product_created" =>  $product_name,
    ];
  }

  public function editProduct($product_id, $product_name, $product_description, $product_price, $product_size)
  {
    $query_to_find_size_id = "SELECT * FROM sizes WHERE size_name =" . $product_size;
    $found_size = Connection::prepare($query_to_find_size_id);
    $found_size->execute();
    $found_size = (array) $found_size->fetchAll()[0];
    $product_size_id = $found_size["id"];

    if (!isset($product_size_id)) {
      http_response_code(404);
      throw new Exception('size not found');
    }

    $query = "UPDATE products SET product_name = :product_name, description= :product_description, price= :product_price, sizes_id= :product_size_id
    WHERE id = :product_id;";

    $result = Connection::prepare($query);
    $result->bindParam(':product_name', $product_name);
    $result->bindParam(':product_description', $product_description);
    $result->bindParam(':product_price', $product_price);
    $result->bindParam(':product_size_id', $product_size_id);
    $result->bindParam(':product_id', $product_id);

    $result->execute();

    http_response_code(201);
    return [
      "product_edited" =>  $product_name,
    ];
  }

  public function findAll()
  {
    $sql = "SELECT * FROM products";
    $all_products = Connection::prepare($sql);
    $all_products->execute();
    return $all_products->fetchAll();
  }
}
