<?php

include '../../controllers/ProductController.php';

$productController = new ProductController();

header('Content-Type: application/json');

echo json_encode($productController->categories());
