<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/product.css">
  <link rel="stylesheet" href="/frontend/customer/styles/alert.css">
  <title>Loja | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>

    <div class="container"></div>

    <div id="alert-sucess" style="visibility: hidden;">
      <div class="overlay" style="display: flex;">
        <div class="container-alert">
          <div class="header">
            <i class="fas fa-check fa-7x" style="color: green;"></i>
            <span>Produto adicionado ao carrinho !</span>
          </div>

          <button onclick="redirectToShop()" class="ok_button">
            Ok
          </button>
        </div>
      </div>
    </div>

    <script src="/frontend/customer/js/product.js"></script>
    <script src="/frontend/customer/js/cart.js"></script>
  </main>
</body>