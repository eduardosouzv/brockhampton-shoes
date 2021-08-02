<link rel="icon" href="/frontend/assets/logo.png">
<link rel="stylesheet" href="/frontend/global/global.css">
<script src="https://kit.fontawesome.com/4f9ae860b6.js" crossorigin="anonymous"></script>
<script src="/frontend/global/env.js"></script>

<?php
$request = $_SERVER['PATH_INFO'];

switch ($request) {
    // customer routes
  case '':
    require './frontend/customer/pages/index.php';
    break;
  case '/shop':
    require './frontend/customer/pages/shop.php';
    break;
  case '/login':
    require './frontend/customer/pages/login.php';
    break;
  case '/register':
    require './frontend/customer/pages/register.php';
    break;
  case '/product':
    require './frontend/customer/pages/product.php';
    break;
  case '/checkout':
    require './frontend/customer/pages/checkout.php';
    break;
  case '/about':
    require './frontend/customer/pages/about.php';
    break;

    // admin routes
  case '/admin/dashboard':
    require './frontend/admin/pages/dashboard.php';
    break;
  case '/admin/products':
    require './frontend/admin/pages/products.php';
    break;
  case '/admin/orders':
    require './frontend/admin/pages/orders.php';
    break;
  default:
    echo '404';
    break;
}
