(window.onload = () => {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];

  if (cart.length) {
    document.querySelector('#total').innerHTML = _calculateTotal();
  }
})();

function putProductOnCart(image, name, description, price) {
  const id = urlSearchParams.get('id');
  const selectedSize = document.querySelector('button[class="selected_size"]').value;

  if (!selectedSize) {
    return;
  }

  let cart = JSON.parse(localStorage.getItem('cart'));

  if (cart) {
    const indexOfFoundProduct = cart.findIndex(
      (storageItem) => storageItem.id === id && storageItem.size === String(selectedSize)
    );

    if (indexOfFoundProduct === -1) {
      cart.push({
        id,
        image,
        name,
        description,
        size: selectedSize,
        price,
        quantity: 1,
      });

      localStorage.setItem('cart', JSON.stringify(cart));
      return;
    }

    cart[indexOfFoundProduct].quantity += 1;
    localStorage.setItem('cart', JSON.stringify(cart));
    return;
  }

  localStorage.setItem(
    'cart',
    JSON.stringify([
      {
        id,
        image,
        name,
        description,
        size: selectedSize,
        price,
        quantity: 1,
      },
    ])
  );
}

/**
 * @param {String} operation use 'add' or 'remove'
 */
function changeQuantity(operation, id, size) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  if (!cart.length) {
    return;
  }

  const indexOfFoundProduct = cart.findIndex((storageItem) => storageItem.id === id && storageItem.size === size);

  if (operation === 'add') {
    cart[indexOfFoundProduct].quantity += 1;
  } else {
    if (cart[indexOfFoundProduct].quantity === 1) {
      return _removeProductFrom(cart, indexOfFoundProduct);
    } else {
      cart[indexOfFoundProduct].quantity -= 1;
    }
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  _calculateTotal();
  document.querySelector(`#quantity-id-${id}${size}`).innerHTML = `Quant. ${cart[indexOfFoundProduct].quantity}`;
  document.querySelector('#total').innerHTML = _calculateTotal();
}

function _removeProductFrom(cart, index) {
  cart.splice(index, 1);
  localStorage.setItem('cart', JSON.stringify(cart));
  location.reload();
}

function _calculateTotal() {
  const cart = JSON.parse(localStorage.getItem('cart'));

  cart.forEach((product) => product);

  let total = cart.reduce((acumulador, valorAtual) => {
    return acumulador + Number(valorAtual.price) * valorAtual.quantity;
  }, 0);

  return total;
}
