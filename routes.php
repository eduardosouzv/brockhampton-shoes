<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    // customer routes
  case '/':
    require './view/customer/index.php';
    break;
  case '/shop':
    require './view/customer/shop.php';
    break;
  case '/login':
    require './view/customer/login.php';
    break;
  case '/register':
    require './view/customer/register.php';
    break;
  case '/product':
    require './view/customer/product.php';
    break;
  case '/checkout':
    require './view/customer/checkout.php';
    break;

    // admin routes
  case '/admin/dashboard':
    require './view/admin/dashboard.php';
    break;
  case '/admin/products':
    require './view/admin/products.php';
    break;
  default:
    echo '404';
    break;
}
