(() => {
  const productContainer = document.querySelector('.products');
  const products = JSON.parse(localStorage.getItem('cart'));

  if (!products) {
    location.href = '/shop';
    return;
  }

  productContainer.innerHTML = products
    .map((p) => _mountProductElement(p.id, p.image, p.name, p.size, p.price))
    .join('');
})();

function _mountProductElement(id, image, name, size, price) {
  return `<div class="product_item">
  <div class="image_product">
    <img src="${image}">
  </div>
  <div class="information_product">
    <p>${name}</p>
    <p>R$ ${price}</p>
    <button onclick="removeProductFromCart('${id}', '${size}')"><i class="fas fa-trash-alt"></i></button>
  </div>
</div>
`;
}
