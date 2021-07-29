<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/admin/styles/products.css">
  <link rel="stylesheet" href="/frontend/admin/styles/modal_create_product.css">

  <title>Produtos | BROCKHAMPTON</title>
</head>

<body>
  <div class="page_container">
    <div>
      <?php include "./frontend/admin/components/menu.php"; ?>
    </div>
    <main>
      <div>
        <h1 class="title">
          <span>Produtos</span>
        </h1>
      </div>

      <div class="product_list">
      </div>

      <div class="new_product">
        <button onclick="openCreateProductModal()">Criar produto</button>
      </div>

      <div id="modal" style="visibility: hidden;">
        <div class="overlay">
          <div class="container">
            <header id="header">Novo produto</header>
            <form action="#">
              <div>
                <label>Nome</label>
                <input id="name" type="text">
              </div>
              <div>
                <label>Descrição</label>
                <input id="description" type="text">
              </div>
              <div>
                <label>R$</label>
                <input id="price" type="text">
              </div>
              <div>
                <label>Tamanho</label>
                <input placeholder="33,34,35" id="sizes" type="text">
              </div>
              <div id="image_div">
                <label>Imagem</label>
                <input id="upload" type="file">
              </div>
              <div>
                <button id="create_product_button" onclick="createProduct()">Criar</button>
                <button id="edit_product_button">Editar</button>
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

  <script src="/frontend/admin/js/products.js"></script>
</body>

</html>