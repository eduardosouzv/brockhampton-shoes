<?php

include '../../../database/Connection.php';

class Product extends Connection
{
  private static function getSizeIDByName($name)
  {
    $query_to_find_size_id = "SELECT * FROM sizes WHERE size_name =" . $name;
    $found_size = Connection::prepare($query_to_find_size_id);
    $found_size->execute();
    $found_size = (array) $found_size->fetchAll()[0];
    $product_size_id = $found_size["id"];

    if (!isset($product_size_id)) {
      http_response_code(404);
      throw new Exception('size not found');
    }

    return $product_size_id;
  }

  public function createProduct($product_name, $product_description, $product_price, $product_size)
  {
    $product_size_id = self::getSizeIDByName($product_size);

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
    $product_size_id = self::getSizeIDByName($product_size);

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
    $query = "SELECT * FROM products";
    $all_products = Connection::prepare($query);
    $all_products->execute();
    return $all_products->fetchAll();
  }

  public function delete($id)
  {
    $query = "DELETE FROM products WHERE id = :id";

    $result = Connection::prepare($query);
    $result->bindParam(':id', $id);

    $result->execute();

    http_response_code(201);
    return [
      "product deleted id" =>  $id,
    ];
  }

  public function findByID($id)
  {
    $query = "SELECT * FROM products WHERE id = :id";

    $result = Connection::prepare($query);
    $result->bindParam(':id', $id);

    $result->execute();
    http_response_code(201);
    return $result->fetchAll();
  }
}
