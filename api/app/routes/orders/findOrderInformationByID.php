<?php

include '../../controllers/OrderController.php';

$url = $_SERVER['REQUEST_URI'];
$query_params = parse_url($url, PHP_URL_QUERY);
parse_str($query_params, $query_str);

$orderController = new OrderController();

header('Content-Type: application/json');

echo json_encode($orderController->findOrderInformationByID($query_str["id"]));
