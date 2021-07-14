<?php
require '../../model/Product.php';

class ProductController
{
  function findAll()
  {
    $product = new Product();
    return $product->findAll();
  }

  function createProduct($product_name, $product_description, $product_price, $product_size)
  {
    try {
      $product = new Product();

      if (!isset($product_name) && !isset($product_description) && !isset($product_price) && !isset($product_size)) {
        http_response_code(404);
        throw new Exception('invalid data');
      }

      return $product->createProduct($product_name, $product_description, $product_price, $product_size);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }
}
