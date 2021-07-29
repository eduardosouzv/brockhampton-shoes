async function isTokenValid() {
  const token = localStorage.getItem('token');

  if (!token) {
    console.log('undefined token');
    return;
  }

  try {
    const response = await fetch(`${BASE_URL}/api/app/routes/sessions/validateSession.php`, {
      method: 'POST',
      body: JSON.stringify({ token }),
    });

    const { user_id } = await response.json();
    console.log(user_id);

    return user_id;
  } catch (error) {
    return;
  }
}
