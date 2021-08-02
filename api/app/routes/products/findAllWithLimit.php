<?php

include '../../controllers/ProductController.php';

$product_info = json_decode(file_get_contents('php://input'), true);
$url = $_SERVER['REQUEST_URI'];

$query_params = parse_url($url, PHP_URL_QUERY);

parse_str($query_params, $query_str);

$productController = new ProductController();

header('Content-Type: application/json');

echo json_encode($productController->findProductsWithLimit($query_str["category"], $query_str["page"]));
