<?php

include '../../controllers/OrderController.php';

$order_info = json_decode(file_get_contents('php://input'), true);

$orderController = new OrderController();

header('Content-Type: application/json');

echo json_encode($orderController->createOrder($order_info["token"], $order_info["products"]));
