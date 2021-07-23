<?php

include '../../controllers/ProductController.php';

$product_info = json_decode(file_get_contents('php://input'), true);

$productController = new ProductController();

header('Content-Type: application/json');

echo json_encode($productController->editProduct(
  $product_info["id"],
  $product_info["name"],
  $product_info["description"],
  $product_info["price"],
  $product_info["sizes"]
));
