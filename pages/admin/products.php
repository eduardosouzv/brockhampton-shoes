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
                <input id="size" type="text">
              </div>
              <div>
                <label>Imagem</label>
                <input id="upload" type="file">
              </div>
              <div>
                <button onclick="createProduct()" type="submit">Criar</button>
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
    window.onload = mountProducts();

    function openModal() {
      document.querySelector('#modal').style.visibility = 'visible';

      document.querySelector('#header').innerHTML = 'Novo produto';
      document.querySelector('#header').style.color = 'black';
    }

    function closeModal() {
      document.querySelector('#modal').style.visibility = 'hidden';
    }

    function mountProducts() {
      const containerItems = document.querySelector('.product_list');
      fetch('http://localhost:8000/api/app/routes/products/findAll.php')
        .then((res) => {
          return res.json();
        })
        .then((products) => {
          containerItems.innerHTML = products.map((items) => {
            return `<div class="product" id="${items.id}">
              <img src="${items.image_link}" alt="tenis">
              <p>${items.product_name}</p>
              <div class="actions">
                <i class="fas fa-edit fa-lg"></i>
                <i class="fas fa-times fa-lg" onclick="deleteProduct(${items.id})"></i>
              </div>
            </div>`
          }).join('');
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

    function encodeImageFileAsURL(element) {
      return new Promise((resolve, reject) => {
        let file = element.files[0];
        let reader = new FileReader();
        reader.onloadend = function() {
          return resolve(reader.result.split(';base64,')[1])
        }

        reader.onerror = () => {
          reject(reader.error)
        }

        reader.readAsDataURL(file);
      })
    }

    function hasBlankFields(references) {
      const inputValues = [];
      references.map(ref => inputValues.push(document.querySelector(ref).value));
      if (inputValues.includes('')) {
        return true;
      }
      return false;
    }

    async function createProduct() {
      document.querySelector('#header').style.color = 'black'
      document.querySelector('#header').innerHTML = 'Criando...'

      const inputReferences = ['#name', '#description', '#size', '#price'];
      const inputValues = [];

      if (hasBlankFields([...inputReferences, '#upload'])) {
        document.querySelector('#header').style.color = 'red'
        document.querySelector('#header').innerHTML = 'Campos em branco.'
        return
      }

      inputReferences.map(ref => inputValues.push(document.querySelector(ref).value))
      const img = document.querySelector('#upload')

      const base64img = await encodeImageFileAsURL(img)

      const [name, description, size, price, base64] = [...inputValues, base64img];

      if (isNaN(parseFloat(price))) {
        document.querySelector('#header').style.color = 'red'
        document.querySelector('#header').innerHTML = 'Erro na criação'
        return
      }

      const productData = {
        name: name,
        description: description,
        price: parseFloat(price),
        size: parseInt(size),
        img_base64: base64
      }

      fetch('http://localhost:8000/api/app/routes/products/create.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json; charset=UTF-8'
          },
          body: JSON.stringify(productData)
        })
        .then(() => {
          document.querySelector('#header').style.color = 'green'
          document.querySelector('#header').innerHTML = 'Produto criado'
          return
        })
        .catch((error) => {
          document.querySelector('#header').style.color = 'red'
          document.querySelector('#header').innerHTML = 'Erro na criação'
        })
    }
  </script>
</body>

</html>