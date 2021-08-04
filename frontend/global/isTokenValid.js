async function isTokenValid() {
  const token = localStorage.getItem('token');

  if (!token) {
    console.log('undefined token');
    return;
  }

  try {
    const response = await fetch(`${BASE_URL}/sessions/validateSession.php`, {
      method: 'POST',
      body: JSON.stringify({ token }),
    });

    const { user_id, is_admin } = await response.json();

    if (window.location.pathname.startsWith('/admin') && !is_admin) {
      window.location.href = '/';
      return user_id;
    }

    return user_id;
  } catch (error) {
    return;
  }
}
