const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
  e.preventDefault();
});

window.onload = mountProducts();

function openCreateProductModal() {
  clearForm();
  document.querySelector("#image_div").style.visibility = "visible";

  document.querySelector("#edit_product_button").style.display = "none";
  document.querySelector("#create_product_button").style.display = "block";

  document.querySelector("#modal").style.visibility = "visible";

  document.querySelector("#modal").style.visibility = "visible";

  document.querySelector("#header").innerHTML = "Novo produto";
  document.querySelector("#header").style.color = "black";
}

function openEditProductModal(id) {
  fetch(`http://localhost:8000/api/app/routes/products/findByID.php?id=${id}`)
    .then((res) => {
      return res.json();
    })
    .then((product) => {
      const inputReferences = ["#name", "#description", "#sizes", "#price"];
      const inputElement = [];

      inputReferences.map((ref) =>
        inputElement.push(document.querySelector(ref))
      );

      const [name, description, sizes, price] = inputElement;

      name.value = product.product_name;
      description.value = product.description;
      sizes.value = product.sizes;
      price.value = product.price;

      document.querySelector("#edit_product_button").onclick = () =>
        editProduct(product.id);
    });

  document.querySelector("#image_div").style.visibility = "hidden";
  document.querySelector("#create_product_button").style.display = "none";
  document.querySelector("#edit_product_button").style.display = "block";

  document.querySelector("#modal").style.visibility = "visible";

  document.querySelector("#header").innerHTML = "Editar produto";
  document.querySelector("#header").style.color = "black";
}

function closeModal() {
  document.querySelector("#image_div").style.visibility = "hidden";

  document.querySelector("#edit_product_button").style.display = "none";
  document.querySelector("#create_product_button").style.display = "none";
  document.querySelector("#modal").style.visibility = "hidden";
}

function mountProducts() {
  const containerItems = document.querySelector(".product_list");
  fetch("http://localhost:8000/api/app/routes/products/findAll.php")
    .then((res) => {
      return res.json();
    })
    .then((products) => {
      containerItems.innerHTML = products
        .map((items) => {
          return `<div class="product" id="${items.id}">
              <img src="${items.image_link}" alt="tenis">
              <p>${items.product_name}</p>
              <div class="actions">
                <i class="fas fa-edit fa-lg" onclick="openEditProductModal(${items.id})"></i>
                <i class="fas fa-times fa-lg" onclick="deleteProduct(${items.id})"></i>
              </div>
            </div>`;
        })
        .join("");
    });
}

function deleteProduct(id) {
  fetch(`http://localhost:8000/api/app/routes/products/delete.php?id=${id}`, {
    method: "DELETE",
  })
    .then((res) => {
      location.reload();
      return res.json();
    })
    .catch((error) => {
      return error;
    });
}

function encodeImageFileAsURL(element) {
  return new Promise((resolve, reject) => {
    let file = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function () {
      return resolve(reader.result.split(";base64,")[1]);
    };

    reader.onerror = () => {
      reject(reader.error);
    };

    reader.readAsDataURL(file);
  });
}

function hasBlankFields(references) {
  const inputValues = [];
  references.map((ref) => inputValues.push(document.querySelector(ref).value));
  if (inputValues.includes("")) {
    return true;
  }
  return false;
}

function generateErrorOnProductCreation(message) {
  document.querySelector("#header").style.color = "red";
  document.querySelector("#header").innerHTML = message;
}

function clearForm() {
  const inputReferences = ["#name", "#description", "#sizes", "#price"];
  inputReferences.map((ref) => (document.querySelector(ref).value = ""));
}

async function createProduct() {
  document
    .querySelector("form")
    .addEventListener("submit", (e) => e.preventDefault());

  document.querySelector("#header").style.color = "black";
  document.querySelector("#header").innerHTML = "Criando...";

  const inputReferences = ["#name", "#description", "#sizes", "#price"];
  const inputValues = [];

  if (hasBlankFields([...inputReferences, "#upload"])) {
    return generateErrorOnProductCreation("Campos em branco.");
  }

  inputReferences.map((ref) =>
    inputValues.push(document.querySelector(ref).value)
  );
  const img = document.querySelector("#upload");

  const base64img = await encodeImageFileAsURL(img);

  const [name, description, sizes, price, base64] = [...inputValues, base64img];

  if (isNaN(parseFloat(price))) {
    generateErrorOnProductCreation("Erro na criação");
    return;
  }

  const formattedSizes = sizes.split(",");
  const wrongSize = formattedSizes.find((s) => isNaN(parseInt(s)));

  if (wrongSize) {
    return generateErrorOnProductCreation("Tamanho invalido.");
  }

  const productData = {
    name: name,
    description: description,
    price: parseFloat(price),
    sizes: formattedSizes,
    img_base64: base64,
  };

  fetch("http://localhost:8000/api/app/routes/products/create.php", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json; charset=UTF-8",
    },
    body: JSON.stringify(productData),
  })
    .then(() => {
      document.querySelector("#header").style.color = "green";
      document.querySelector("#header").innerHTML = "Produto criado";
      return;
    })
    .catch((error) => {
      document.querySelector("#header").style.color = "red";
      document.querySelector("#header").innerHTML = "Erro na criação";
    });
}

function editProduct(id) {
  document
    .querySelector("form")
    .addEventListener("submit", (e) => e.preventDefault());
  console.log(id);

  document.querySelector("#header").style.color = "black";
  document.querySelector("#header").innerHTML = "Editando...";

  const inputReferences = ["#name", "#description", "#sizes", "#price"];
  const inputValues = [];

  if (hasBlankFields(inputReferences)) {
    return generateErrorOnProductCreation("Campos em branco.");
  }

  inputReferences.map((ref) =>
    inputValues.push(document.querySelector(ref).value)
  );

  const [name, description, sizes, price] = inputValues;

  if (isNaN(parseFloat(price))) {
    return generateErrorOnProductCreation("Erro na edição");
  }

  const formattedSizes = sizes.split(",");
  const wrongSize = formattedSizes.find((s) => isNaN(parseInt(s)));

  if (wrongSize) {
    return generateErrorOnProductCreation("Tamanho invalido.");
  }

  const productData = {
    id: id,
    name: name,
    description: description,
    price: parseFloat(price),
    sizes: formattedSizes,
  };

  fetch("http://localhost:8000/api/app/routes/products/edit.php", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json; charset=UTF-8",
    },
    body: JSON.stringify(productData),
  })
    .then(() => {
      document.querySelector("#header").style.color = "green";
      document.querySelector("#header").innerHTML = "Produto editado";
      return;
    })
    .catch((error) => {
      document.querySelector("#header").style.color = "red";
      document.querySelector("#header").innerHTML = "Erro na ediição";
    });
}
