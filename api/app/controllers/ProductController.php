<?php
require '../../model/Product.php';

class ProductController
{
  function findAll()
  {
    $product = new Product();
    return $product->findAll();
  }

  function editProduct($product_id, $product_name, $product_description, $product_price, $product_sizes, $product_category)
  {
    try {
      $product = new Product();

      if (
        !isset($product_id) ||
        !isset($product_name) ||
        !isset($product_description) ||
        !isset($product_price) ||
        !isset($product_sizes) ||
        !isset($product_category)
      ) {
        http_response_code(404);
        throw new Exception('invalid data');
      }

      return $product->editProduct($product_id, $product_name, $product_description, $product_price, $product_sizes, $product_category);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function createProduct($product_name, $product_description, $product_price, $product_sizes, $img_base64, $product_category)
  {
    try {
      $product = new Product();

      if (
        !isset($product_name) ||
        !isset($product_description) ||
        !isset($product_price) ||
        !isset($product_sizes) ||
        !isset($img_base64) ||
        !isset($product_category)
      ) {
        http_response_code(404);
        throw new Exception('asdasd data');
      }

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . CLIENT_ID_IMGUR));
      curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $img_base64));

      $reply = curl_exec($ch);
      curl_close($ch);

      $reply = json_decode($reply);

      $img_link = $reply->data->link;

      return $product->createProduct($product_name, $product_description, $product_price, $product_sizes, $img_link, $product_category);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function delete($id)
  {
    try {
      $product = new Product();

      if (!isset($id)) {
        http_response_code(404);
        throw new Exception('id undefined');
      }

      return $product->delete($id);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function findByID($id)
  {
    try {
      $product = new Product();

      if (!isset($id)) {
        http_response_code(404);
        throw new Exception('id undefined');
      }

      return $product->findByID($id);
    } catch (Exception $e) {
      return [
        "message" =>  $e->getMessage(),
      ];
    }
  }

  function findProductsWithLimit($category, $page)
  {
    try {
      $product = new Product();

      if (!isset($page)) {
        http_response_code(404);
        throw new Exception('page undefined');
      }

      return $product->findProductsWithLimit($category, $page);
    } catch (Exception $e) {
      return [
        "message" => $e->getMessage(),
      ];
    }
  }

  function categories()
  {
    $product = new Product();
    return $product->categories();
  }
}
