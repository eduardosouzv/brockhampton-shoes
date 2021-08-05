<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/checkout.css">
  <link rel="stylesheet" href="/frontend/customer/styles/alert.css">
  <title>Carrinho | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>

    <div id="alert-sucess" style="visibility: hidden;">
      <div class="overlay" style="display: flex;">
        <div class="container">
          <div class="header">
            <i class="fas fa-check fa-7x" style="color: green;"></i>
            <span>Seu pedido foi criado !</span>
          </div>

          <button onclick="clearCart()" class="ok_button">
            Ok
          </button>
        </div>
      </div>
    </div>


    <div class="container-checkout">
      <div>
        <span class="name_cart">Seu carrinho</span>
      </div>

      <div class="inline_content">
        <div class="products">
        </div>
        <div class="cart_infos">
          <p>Total: <span id="total">0,00</span></p>
          <p>Frete: GRÁTIS</p>
          <button onclick="generateOrder()" class="finish_button">FINALIZAR COMPRA</button>
        </div>
      </div>
    </div>



    <script src="/frontend/customer/js/checkout.js"></script>
    <script src="/frontend/customer/js/cart.js"></script>
</body>