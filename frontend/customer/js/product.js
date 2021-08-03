const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

if (!params.id) {
  window.location = '/shop';
}

(async () => {
  const productContainer = document.querySelector('.container');

  const { image_link, product_name, description, sizes, price } = await (
    await fetch(`${BASE_URL}/api/app/routes/products/findByID.php?id=${params.id}`)
  ).json();

  productContainer.innerHTML = _mountProductElement(image_link, product_name, description, sizes, price);
})();

function _mountProductElement(image, name, description, sizes, price) {
  return `<div class="image_shoe">
      <img src="${image}" id="img_link">
    </div>

    <div class="information">
      <div class="name_shoe">
        <p id="product_name">${name}</p>
      </div>
      
    <div class="information_shoe">
      <li>${description.replace(',', '<li>')}</li>
    </div>

    <div class="sizes_shoe">
      <p>TAMANHOS</p>
      <div class="all_sizes">
          ${sizes.map((size) => `<button onclick="selectSize(${size})" value="${size}">${size}</button>`).join('')}
      </div>
    </div>

      <div class="price_shoe">
        <p>PREÇO</p>
        <p>R$${price}</p>
      </div>

        <button 
        onclick="putProductOnCart('${image}','${name}','${description}','${price}')" 
        class="add_button">Adicionar ao Carrinho</button>
    </div>`;
}

function selectSize(size) {
  _clearSelectedSizes(size);

  const buttonSize = document.querySelector(`button[value="${size}"]`);

  buttonSize.classList.contains('selected_size')
    ? buttonSize.classList.remove('selected_size')
    : buttonSize.classList.add('selected_size');
}

function _clearSelectedSizes(size) {
  document.querySelectorAll(`div[class="all_sizes"] > button`).forEach((e) => e.classList.remove('selected_size'));
}
