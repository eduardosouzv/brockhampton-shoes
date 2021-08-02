<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/checkout.css">
  <title>Carrinho | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>
    <div class="container-checkout">
      <div>
        <span class="name_cart">Seu Carrinho</span>
      </div>

      <div class="inline_content">
        <div class="products">
        </div>
        <div class="cart_infos">
          <p>Total:</p>
          <p>Frete: GRÁTIS</p>
          <button onclick="" class="finish_button">FINALIZAR COMPRA</button>
        </div>
      </div>
    </div>

    <script src="/frontend/customer/js/checkout.js"></script>
    <script src="/frontend/customer/js/cart.js"></script>
</body>