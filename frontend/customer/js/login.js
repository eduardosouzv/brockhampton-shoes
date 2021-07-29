async function authenticateUser() {
  const form = document.querySelector('form');

  form.addEventListener('submit', (e) => {
    e.preventDefault();
  });

  const user = document.querySelector('#user').value;
  const password = document.querySelector('#password').value;

  if (!user || !password) {
    return;
  }

  try {
    const response = await fetch(`${BASE_URL}/api/app/routes/sessions/generateSession.php`, {
      method: 'POST',
      body: JSON.stringify({
        user,
        password,
      }),
    });
    const { token } = await response.json();

    localStorage.setItem('token', token);

    window.location.href = '/shop';
  } catch (error) {
    console.log(error);
  }
}
