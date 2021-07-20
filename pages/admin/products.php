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
                <input class="name" type="text">
              </div>
              <div>
                <label>Descrição</label>
                <input class="description" type="text">
              </div>
              <div>
                <label>R$</label>
                <input class="price" type="text" placeholder="">
              </div>
              <div>
                <label>Tamanho</label>
                <input class="sizes" type="text">
              </div>
              <div>
                <button type="submit" onclick="createProduct()">Criar</button>
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
    showProducts();

    function openModal() {
      document.querySelector('#modal').style.visibility = 'visible';
    }

    function closeModal() {
      document.querySelector('#modal').style.visibility = 'hidden';
    }

    function showProducts() {
      const containerItems = document.querySelector('.product_list');
      fetch('http://localhost:8000/api/app/routes/products/findAll.php')
        .then((res) => {
          return res.json();
        })
        .then((products) => {
          const productsMap = products.map((items) => {
            return `<div class="product" id="${items.id}"><img src="../../assets/products/shoe.jpg" alt="tenis"><p>${items.product_name}</p><div class="actions"><i class="fas fa-edit fa-lg"></i><i class="fas fa-times fa-lg" onclick="deleteProduct(${items.id})"></i></div></div>`
          })
          containerItems.innerHTML = productsMap.join("");
        })
        .catch((error) => {
          return error;
        })
    }

    function deleteProduct(id) {
      fetch(`http://localhost:8000/api/app/routes/products/delete.php?id=${id}`, {
          method: 'DELETE',
        })
        .then((res) => {
          location.reload();
          return res.json();
        })
        .catch((error) => {
          return error;
        })
    }

    function createProduct() {
      const name = document.querySelector('.name').value;
      const description = document.querySelector('.description').value;
      const sizes = document.querySelector('.sizes').value;
      const price = document.querySelector('.price').value.replace(",", ".");

      fetch('http://localhost:8000/api/app/routes/products/create.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json; charset=UTF-8'
          },
          body: JSON.stringify({
            product_name: name,
            product_description: description,
            product_price: price,
            product_size: sizes,
          })
        })
        .then((res) => {
          return res.json();
        })
        .catch((error) => {
          return console.log(error);
        })
    }
  </script>
</body>

</html>