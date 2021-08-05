<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/admin/styles/orders.css">
  <link rel="stylesheet" href="/frontend/admin/styles/modal_order_info.css">

  <title>Pedidos | BROCKHAMPTON</title>
</head>

<body>
  <div class="page_container">
    <div>
      <?php include "./frontend/admin/components/menu.php"; ?>
    </div>
    <main>
      <div>
        <h1 class="title">
          <span>Pedidos</span>
        </h1>
      </div>

      <div id="order_list" class="orders_list">

      </div>

    </main>
  </div>

  <div id="modal" class="modal" style="visibility: hidden;">
  </div>

  <script src="/frontend/admin/js/orders.js"></script>
  <script src="/frontend/admin/js/modal_order.js"></script>

</body>

</html>