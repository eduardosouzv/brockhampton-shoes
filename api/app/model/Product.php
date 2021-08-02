<?php

include '../../../database/Connection.php';

class Product extends Connection
{
  private static function getSizesIDByName($size_names)
  {
    $query_to_find_sizes_id = "SELECT * FROM sizes WHERE ";
    $params = '';

    foreach ($size_names as $i => $size_name) {
      if (sizeof($size_names) === $i + 1) {
        $params = $params . 'size_name = ' . $size_name . ';';
      } else {
        $params = $params . 'size_name = ' . $size_name . ' OR ';
      }
    }

    $query_to_find_sizes_id = $query_to_find_sizes_id . $params;

    $found_size = Connection::prepare($query_to_find_sizes_id);
    $found_size->execute();
    $found_size = (array) $found_size->fetchAll();

    $sizes_id = [];

    foreach ($found_size as $size) {
      $decoded_size = json_decode(json_encode($size), true);
      array_push($sizes_id, $decoded_size["id"]);
    }

    if (!isset($found_size) || sizeof($sizes_id) !== sizeof($size_names)) {
      http_response_code(404);
      throw new Exception('size not found');
    }

    return $sizes_id;
  }
  private static function getCategoriesIDByName($name)
  {
    $query = "SELECT * FROM categories WHERE category_name = :name";
    $found_category = Connection::prepare($query);
    $found_category->bindParam(':name', $name);
    $found_category->execute();
    $found_category = (array) $found_category->fetchAll()[0];
    $product_category_id = $found_category["id"];

    if (!isset($product_category_id)) {
      http_response_code(404);
      throw new Exception('category not found');
    }

    return $product_category_id;
  }

  public function createProduct($product_name, $product_description, $product_price, $product_sizes, $img_link, $product_category)
  {
    $product_sizes_id = self::getSizesIDByName($product_sizes);
    $product_category_id = self::getCategoriesIDByName($product_category);

    $query = "INSERT INTO products (product_name, description, price, image_link, categories_id)
    VALUES (:product_name, :product_description, :product_price, :image_link, :product_category)";

    $create_product = Connection::prepare($query);
    $create_product->bindParam(':product_name', $product_name);
    $create_product->bindParam(':product_description', $product_description);
    $create_product->bindParam(':product_price', $product_price);
    $create_product->bindParam(':image_link', $img_link);
    $create_product->bindParam(':product_category', $product_category_id);

    $create_product->execute();

    $last_insert_id = Connection::getInstance()->lastInsertId();
    $params_to_insert = '';

    foreach ($product_sizes_id as $i => $size_id) {
      if (sizeof($product_sizes_id) === $i + 1) {
        $params_to_insert = $params_to_insert . '(' . intval($last_insert_id) . ',' . intval($size_id) . ');';
      } else {
        $params_to_insert = $params_to_insert . '(' . intval($last_insert_id) . ',' . intval($size_id) . '),';
      }
    }

    $query = "INSERT INTO products_has_sizes (products_id, sizes_id) VALUES " . $params_to_insert;

    $products_has_sizes = Connection::prepare($query);
    $products_has_sizes->execute();

    http_response_code(201);

    return [
      "product_created" =>  $product_name,
    ];
  }

  public function editProduct($product_id, $product_name, $product_description, $product_price, $product_sizes, $product_category)
  {
    $product_sizes_id = self::getSizesIDByName($product_sizes);
    $product_category_id = self::getCategoriesIDByName($product_category);

    $delete_products_has_sizes = "DELETE FROM products_has_sizes WHERE products_id =" . $product_id;
    $products_has_sizes = Connection::prepare($delete_products_has_sizes);
    $products_has_sizes->execute();

    $params_to_insert = '';
    foreach ($product_sizes_id as $i => $size_id) {
      if (sizeof($product_sizes_id) === $i + 1) {
        $params_to_insert = $params_to_insert . '(' . intval($product_id) . ',' . intval($size_id) . ');';
      } else {
        $params_to_insert = $params_to_insert . '(' . intval($product_id) . ',' . intval($size_id) . '),';
      }
    }

    $edit_products_has_sizes = "INSERT INTO products_has_sizes (products_id, sizes_id) VALUES " . $params_to_insert;
    $products_has_sizes = Connection::prepare($edit_products_has_sizes);
    $products_has_sizes->execute();

    $edit_product = "UPDATE products SET product_name = :product_name, description = :product_description, price = :product_price, categories_id = :product_category
    WHERE id = :product_id;";
    $query_product = Connection::prepare($edit_product);
    $query_product->bindParam(':product_name', $product_name);
    $query_product->bindParam(':product_description', $product_description);
    $query_product->bindParam(':product_price', $product_price);
    $query_product->bindParam(':product_id', $product_id);
    $query_product->bindParam(':product_category', $product_category_id);
    $query_product->execute();

    http_response_code(201);
    return [
      "product_edited" =>  $product_name,
    ];
  }

  public function findAll()
  {
    $query =
      "SELECT p.id ,product_name, description, price, image_link, size_name 
    FROM products_has_sizes phs 
    INNER JOIN products p ON phs.products_id = p.id 
    INNER JOIN sizes s ON phs.sizes_id = s.id
    ORDER BY p.id ASC;";
    $all_products = Connection::prepare($query);
    $all_products->execute();
    $all_products = (array) $all_products->fetchAll();

    if (!isset($all_products)) {
      return [];
    }

    foreach ($all_products as $product) {
      $products_id_filtered[$product->id][] = $product;
    }

    $mounted_products = [];
    foreach ($products_id_filtered as $product) {
      $sizes = [];

      foreach ($product as $value) {
        array_push($sizes, $value->size_name);
        $mounted_product = [
          "id" => $value->id,
          "product_name" => $value->product_name,
          "description" => $value->description,
          "price" => $value->price,
          "image_link" => $value->image_link,
          "sizes" => $sizes
        ];
      }

      array_push($mounted_products, $mounted_product);
    }

    return $mounted_products;
  }

  public function delete($id)
  {
    $query_produts_has_sizes = "DELETE FROM products_has_sizes WHERE products_id = :id";

    $delete_produts_has_sizes = Connection::prepare($query_produts_has_sizes);
    $delete_produts_has_sizes->bindParam(':id', $id);
    $delete_produts_has_sizes->execute();

    $query_product = "DELETE FROM products WHERE id = :id";
    $delete_produt = Connection::prepare($query_product);
    $delete_produt->bindParam(':id', $id);
    $delete_produt->execute();

    http_response_code(201);
    return [
      "product deleted id" =>  $id,
    ];
  }

  public function findByID($id)
  {
    $query_category_name = "SELECT category_name
    FROM categories
    INNER JOIN products ON (categories.id = products.categories_id)
    WHERE products.id = :id;";
    $found_category_name = Connection::prepare($query_category_name);
    $found_category_name->bindParam(':id', $id);
    $found_category_name->execute();
    $found_category_name = (array) $found_category_name->fetch();

    $query =
      "SELECT p.id ,product_name, description, price, image_link, size_name FROM products_has_sizes phs 
    INNER JOIN products p ON phs.products_id = p.id 
    INNER JOIN sizes s ON phs.sizes_id = s.id
    WHERE p.id = :id;";
    $found_product_by_id = Connection::prepare($query);
    $found_product_by_id->bindParam(':id', $id);
    $found_product_by_id->execute();
    $found_product_by_id = (array) $found_product_by_id->fetchAll();

    if (!count($found_product_by_id)) {
      http_response_code(404);
      return [];
    }

    $sizes = [];

    foreach ($found_product_by_id as $value) {
      array_push($sizes, $value->size_name);
      $mounted_product = [
        "id" => $value->id,
        "product_name" => $value->product_name,
        "description" => $value->description,
        "price" => $value->price,
        "image_link" => $value->image_link,
        "category_name" => $found_category_name['category_name'],
        "sizes" => $sizes
      ];
    }

    return $mounted_product;
  }

  public function findProductsWithLimit($category, $page)
  {
    if (!isset($page)) {
      $page = 1;
    }

    $query = "SELECT * FROM products";
    $query_count = "SELECT COUNT(*) AS pages FROM products";
    $items_per_page = 6;
    $begin = ($page - 1) * $items_per_page;

    if (isset($category)) {
      $query = $query . " WHERE categories_id = :category";
      $query_count = $query_count . " WHERE categories_id = :category";
    }

    $query = $query . " LIMIT " . $begin . "," . $items_per_page;
    $all_products_with_limit = Connection::prepare($query);
    if (isset($category)) {
      $all_products_with_limit->bindParam(':category', $category);
    }
    $all_products_with_limit->execute();
    $result = (array) $all_products_with_limit->fetchAll();

    $count = Connection::prepare($query_count);
    if (isset($category)) {
      $count->bindParam(':category', $category);
    }
    $count->execute();
    $result_count = (array) $count->fetch();
    $total_pages = ceil($result_count['pages'] / $items_per_page);

    if (!count($result)) {
      http_response_code(404);
      return [];
    }

    $products = [
      "total_pages" => $total_pages,
      "products" => $result,
    ];

    return $products;
  }

  public function categories()
  {
    $query_get_categorioes = "SELECT * FROM categories";
    $get_categories = Connection::prepare($query_get_categorioes);
    $get_categories->execute();
    $result_get_categories = (array) $get_categories->fetchAll();

    return $result_get_categories;
  }
}
