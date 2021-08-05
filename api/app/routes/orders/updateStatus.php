<?php

include '../../controllers/OrderController.php';

$order_info = json_decode(file_get_contents('php://input'), true);

$url = $_SERVER['REQUEST_URI'];
$query_params = parse_url($url, PHP_URL_QUERY);
parse_str($query_params, $query_str);

$orderController = new OrderController();

header('Content-Type: application/json');

echo json_encode($orderController->updateStatus($query_str["id"], $order_info["status"]));
