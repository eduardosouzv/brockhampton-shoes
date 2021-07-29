(async () => {
  const login = document.querySelector('#login');
  const logout = document.querySelector('#logout');

  logout.style.display = 'none';

  const id = await isTokenValid();

  if (id) {
    login.style.display = 'none';
    logout.style.display = 'block';
  }
})();

function logout() {
  const token = localStorage.getItem('token');

  if (!token) {
    location.reload();
    return;
  }

  fetch(`${BASE_URL}/api/app/routes/sessions/logoutSession.php`, {
    method: 'POST',
    body: JSON.stringify({ token }),
  }).then(() => location.reload());
}
