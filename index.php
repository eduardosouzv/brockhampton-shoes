<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    // customer routes
  case '/':
    require './pages/customer/index.php';
    break;
  case '/shop':
    require './pages/customer/shop.php';
    break;
  case '/login':
    require './pages/customer/login.php';
    break;
  case '/register':
    require './pages/customer/register.php';
    break;
  case '/product':
    require './pages/customer/product.php';
    break;
  case '/checkout':
    require './pages/customer/checkout.php';
    break;
  case '/about':
    require './pages/customer/about.php';
    break;

    // admin routes
  case '/admin/dashboard':
    require './pages/admin/dashboard.php';
    break;
  case '/admin/products':
    require './pages/admin/products.php';
    break;
  default:
    echo '404';
    break;
}
