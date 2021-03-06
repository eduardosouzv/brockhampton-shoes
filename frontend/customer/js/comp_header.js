(async () => {
  const login = document.querySelector('#login');
  const logout = document.querySelector('#logout');
  const cart = document.querySelector('#cart');

  logout.style.display = 'none';
  cart.style.display = 'none';

  const id = await isTokenValid();

  if (id) {
    login.style.display = 'none';
    cart.style.display = 'block';
    logout.style.display = 'block';
  }
})();

function logout() {
  const token = localStorage.getItem('token');

  if (!token) {
    location.reload();
    return;
  }

  fetch(`${BASE_URL}/sessions/logoutSession.php`, {
    method: 'POST',
    body: JSON.stringify({ token }),
  }).then(() => location.reload());
}
