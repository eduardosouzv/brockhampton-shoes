function _parseToUnitProduct(id, image, name, description, sizes, price) {
  return sizes.map((size) => {
    return {
      id,
      image,
      name,
      description,
      size,
      price,
    };
  });
}

async function addProductToCart(image, name, description, price) {
  const id = urlSearchParams.get('id');
  const sizes = [];

  document.querySelectorAll('button[class="selected_size"]').forEach((s) => sizes.push(s.value));

  if (!sizes.length) {
    return;
  }

  let cart = JSON.parse(localStorage.getItem('cart'));

  if (cart) {
    const products = _parseToUnitProduct(id, image, name, description, sizes, price);

    localStorage.setItem('cart', JSON.stringify([...cart, ...products]));
    return;
  }

  localStorage.setItem('cart', JSON.stringify(_parseToUnitProduct(id, image, name, description, sizes, price)));
}

function removeProductFromCart(id, size) {
  let cart = JSON.parse(localStorage.getItem('cart'));

  let index = cart.findIndex((p) => p.id === id && p.size === size);
  cart.splice(index, 1);
  localStorage.setItem('cart', JSON.stringify(cart));
  location.reload();
}
