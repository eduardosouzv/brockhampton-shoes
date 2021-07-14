<?php

include '../../controllers/ProductController.php';

$product_info = json_decode(file_get_contents('php://input'), true);
$url = $_SERVER['REQUEST_URI'];

$query_params = parse_url($url, PHP_URL_QUERY);

$id = explode("=", $query_params)[1];

$productController = new ProductController();

header('Content-Type: application/json');

echo json_encode($productController->findByID($id));
