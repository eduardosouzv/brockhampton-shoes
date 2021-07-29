const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

if (!params.id) {
  window.location = "/shop";
}

showProductInformations(params.id);

function showProductInformations(id) {
  const containerInfos = document.querySelector(".container");

  fetch(`http://localhost:8000/api/app/routes/products/findByID.php?id=${id}`)
    .then((res) => {
      return res.json();
    })
    .then((product) => {
      return (containerInfos.innerHTML = `
                <div class="image_shoe">
                    <img src="${product.image_link}">
                </div>
                <div class="information">
                    <div class="name_shoe">
                        <p>${product.product_name}</p>
                    </div>
                <div class="information_shoe">
                    <li>${product.description.replace(",", "<li>")}</li>
                </div>
                <div class="sizes_shoe">
                    <p>TAMANHOS</p>
                    <div class="all_sizes">
                        ${product.sizes
                          .map((items) => {
                            return `<button>${items}</button>`;
                          })
                          .join("")}
                    </div>
                </div>
                <div class="price_shoe">
                    <p>PREÇO</p>
                    <p>R$${product.price}</p>
                </div>
                    <button onclick="" class="add_button">Adicionar ao Carrinho</button>
                </div>
               `);
    })
    .catch((error) => {
      return error;
    });
}

function buttonAddToCart() {}
