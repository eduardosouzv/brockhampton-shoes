const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

if (!params.page) {
  window.location = '/shop?page=1';
}

(window.onload = showCategories()), showProducts(params.category, params.page);

function next(page, category) {
  const num = parseInt(page);

  fetch(
    `http://localhost:8000/api/app/routes/products/findAllWithLimit.php?${
      category ? 'category=' + category + '&' : ''
    }page=${page}`
  )
    .then((res) => {
      return res.json();
    })
    .then((products) => {
      if (num < products.total_pages) {
        const url = `http://localhost:8000/shop?${category ? 'category=' + category + '&' : ''}page=${num + 1}`;
        window.location = url;
      }
    });
}

function previous(page, category) {
  const num = parseInt(page);
  if (num > 1) {
    const url = `http://localhost:8000/shop?category=${category ? 'category=' + category + '&' : ''}page=${num - 1}`;
    window.location = url;
  }
}

function showCategories() {
  const containerCategories = document.querySelector('.show_categories');

  fetch(`http://localhost:8000/api/app/routes/products/categories.php`)
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      const categoriesMap = res.map((items) => {
        return `<a id="${items.id}" onclick="redirectTo(${items.id})">${items.category_name}</a>`;
      });
      containerCategories.innerHTML = categoriesMap.join('');
    });
}

function showProducts(category, page) {
  const containerItems = document.querySelector('.container_items');
  fetch(
    `http://localhost:8000/api/app/routes/products/findAllWithLimit.php?${
      category ? 'category=' + category + '&' : ''
    }page=${page}`
  )
    .then((res) => {
      return res.json();
    })
    .then((res) => {
      const productsMap = res.products.map((items) => {
        return `<div class="shoes" onClick="redirectToProduct(${items.id})"><img src="${items.image_link}"><p class="name_shoe">${items.product_name}</p><p class="price_shoe">R$${items.price}</p></div>`;
      });
      containerItems.innerHTML = productsMap.join('');
    })
    .catch((error) => {
      return error;
    });
}

function redirectToProduct(id) {
  const url = `http://localhost:8000/product?id=${id}`;
  window.location = url;
}

function redirectTo(category) {
  if (!category) {
    const url = `http://localhost:8000/shop?page=1`;
    window.location = url;
  }
  const url = `http://localhost:8000/shop?category=${category}&page=1`;
  window.location = url;
}
