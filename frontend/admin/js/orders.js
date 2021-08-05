window.onload = () => {
  mountOrders();
};

async function applyOrderAction(id) {
  try {
    const action = document.querySelector(`div[id="${id}"] > div > select`).value;

    if (!action) {
      return;
    }

    await fetch(`${BASE_URL}/orders/updateStatus.php?id=${id}`, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: JSON.stringify({
        status: action,
      }),
    });

    document.querySelector(`div[id="${id}"]`).remove();
  } catch (error) {
    console.log(error);
  }
}

async function mountOrders() {
  const orderListElement = document.querySelector('#order_list');

  const response = await fetch(`${BASE_URL}/orders/findOrdersByStatus.php?status=PROCESSANDO`);

  const products = await response.json();

  orderListElement.innerHTML = products.map((order) => mountOrderElement(order.id, order.status)).join('');
}

function mountOrderElement(id, status) {
  return `
    <div class="order" id="${id}">
      <p>Pedido Nº <strong>${id}</strong></p>
      <p class="status">${status}</p>
      <div class="buttons">
      <select name="select" class="status_select" id="select_action">
        <option value="" disabled selected hidden>Status</option>
        <option value="DESPACHADO">Despachar</option>
        <option value="CANCELADO">Cancelar</option>
      </select>
        <i class="far fa-check-circle" onclick="applyOrderAction(${id})"></i>
        <i class="fas fa-folder" onclick="mountOrderInformationModal(${id})"></i>
      </div>
    </div>`;
}

async function mountOrderInformationModal(id) {
  handleModal();

  const modal = document.querySelector('#modal');

  const response = await fetch(`${BASE_URL}/orders/findOrderInformationByID.php?id=${id}`);

  const { order_id, username, street, number, district, state, zip, products } = await response.json();

  modal.innerHTML = `
    <div class="content">
      <div class="order">
        <div class="close_button">
          <button onclick="handleModal()" class="close">&times;</button>
        </div>
        <div class="information">
          <h1>Pedido Nº ${order_id}</h1>
          <h2>Nome:</h2>
          <p>${username}</p>
          <h2>Produtos:</h2>
          <div class="products">
          ${products
            .map((product) => {
              return `
              <div class="item">
                <img src="${product.image_link}">
                <p>${product.product_name}</p>
                <p>${product.size_name}</p>
                <p>R$ ${product.price}</p>
              </div>
              `;
            })
            .join('')}
          </div>
          <h2>Endereço:</h2>
          <p>${street}, ${number} - ${district}, ${state}, ${mask(zip, '#####-###')}</p>
          <h2>Total:</h2>
          <p id="price">R$ ${products.reduce((acc, curr) => {
            return acc + parseFloat(curr.price) * parseFloat(curr.quantity);
          }, 0)}</p>
        </div>
    </div>
  </div>`;
}

function mask(value, pattern) {
  let i = 0;
  const v = value.toString();

  return pattern.replace(/#/g, () => v[i++] || '');
}
