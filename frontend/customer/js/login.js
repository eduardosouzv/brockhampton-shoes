async function authenticateUser() {
  const form = document.querySelector('form');

  form.addEventListener('submit', (e) => {
    e.preventDefault();
  });

  const user = document.querySelector('#user');
  const password = document.querySelector('#password');
  user.style.border = 'none';
  password.style.border = 'none';

  if (!user.value || !password.value) {
    user.style.border = '1px solid red';
    password.style.border = '1px solid red';
    return;
  }
  const response = await fetch(`${BASE_URL}/sessions/generateSession.php`, {
    method: 'POST',
    body: JSON.stringify({
      user: user.value,
      password: password.value,
    }),
  });
  const { token, is_admin } = await response.json();

  localStorage.setItem('token', token);
  localStorage.setItem('cart', JSON.stringify([]));

  if (is_admin) {
    window.location.href = '/admin/products';
    return;
  }

  if (response.status === 401) {
    user.style.border = '1px solid red';
    password.style.border = '1px solid red';
    return;
  }

  location.href = '/shop';
}
