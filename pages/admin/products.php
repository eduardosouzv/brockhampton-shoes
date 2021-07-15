<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

  <link rel="icon" href="../assets/logo.png">

  <link rel="stylesheet" href="../../styles/global.css">
  <link rel="stylesheet" href="../../styles/pages/admin/products.css">
  <link rel="stylesheet" href="../../styles/components/admin/modal_create_product.css">

  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <title>Produtos | BROCKHAMPTON</title>
</head>

<body>
  <div class="page_container">
    <div>
      <?php include "./components/admin/menu.php"; ?>
    </div>
    <main>
      <div>
        <h1 class="title">
          <span>Produtos</span>
        </h1>
      </div>

      <div class="product_list">
        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>

        <div class="product">
          <img src="../../assets/products/shoe.jpg" alt="tenis">
          <p>AIR MAX 123</p>
          <div class="actions">
            <i class="fas fa-edit fa-lg"></i>
            <i class="fas fa-times fa-lg"></i>
          </div>
        </div>
      </div>

      <div class="new_product">
        <button onclick="openModal()">Criar produto</button>
      </div>

      <div id="modal" style="visibility: hidden;">
        <div class="overlay">
          <div class="container">
            <header>Novo produto</header>
            <form action="#">
              <div>
                <label>Nome</label>
                <input type="text">
              </div>
              <div>
                <label>Descrição</label>
                <input type="text">
              </div>
              <div>
                <label>R$</label>
                <input type="text" placeholder="">
              </div>
              <div>
                <label>Tamanho</label>
                <input type="text">
              </div>
              <div>
                <button type="submit">Criar</button>
              </div>
            </form>

            <button class="close_button" type="button" onclick="closeModal()">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    function openModal() {
      document.querySelector('#modal').style.visibility = 'visible';
    }

    function closeModal() {
      document.querySelector('#modal').style.visibility = 'hidden';
    }
  </script>
</body>

</html>