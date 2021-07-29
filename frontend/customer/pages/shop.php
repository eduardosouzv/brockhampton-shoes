<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/shop.css">

  <title>Loja | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>
    <div class="container">
      <div class="container_categories">
        <h2 class="categories_name">Categorias</h2>
        <a href="#">Todos</a>
        <a href="#">Masculino</a>
        <a href="#">Feminino</a>
        <a href="#">Hype Content</a>
        <a href="#">Sportive</a>
        <a href="#">Skate Shoes</a>
      </div>
      <div class="content">
        <div class="container_products">
          <div class="container_items">
          </div>
        </div>
        <div class="pagination">
          <a id="previous" onclick="previous(params.page)"><i class="fas fa-arrow-left"></i></a>
          <a onclick="next(params.page)"><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <script src="/frontend/customer/js/shop.js"></script>
  </main>
</body>