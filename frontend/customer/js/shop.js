const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

if (!params.page) {
  window.location = "/shop?page=1";
}

showProducts(params.page);

function next(page) {
  const num = parseInt(page);

  fetch(
    `http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${num}`
  )
    .then((res) => {
      return res.json();
    })
    .then((products) => {
      if (num < products.total_pages) {
        const url = `http://localhost:8000/shop?page=${num + 1}`;
        window.location = url;
      }
    });
}

function previous(page) {
  const num = parseInt(page);
  if (num > 1) {
    const url = `http://localhost:8000/shop?page=${num - 1}`;
    window.location = url;
  }
}

function showPags(page) {
  const num = parseInt(page);
  const containerPagination = document.querySelector("#previous");

  fetch(
    `http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${page}`
  )
    .then((res) => {
      return res.json();
    })
    .then((pagination) => {});
}

function showProducts(page) {
  const containerItems = document.querySelector(".container_items");
  fetch(
    `http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${page}`
  )
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      const productsMap = res.products.map((items) => {
        return `<div class="shoes" onClick="redirectToProduct(${items.id})"><img src="${items.image_link}"><p class="name_shoe">${items.product_name}</p><p class="price_shoe">R$${items.price}</p></div>`;
      });
      containerItems.innerHTML = productsMap.join("");
    })
    .catch((error) => {
      return error;
    });
}

function redirectToProduct(id) {
  const url = `http://localhost:8000/product?id=${id}`;
  window.location = url;
}
