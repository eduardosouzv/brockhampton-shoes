const form = document.querySelector('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();
});

function postRegisterUser() {
  const user_text = document.querySelector('.user_text').value;
  const password = document.querySelector('.password').value;
  const repeat_password = document.querySelector('.repeat_password').value;
  const street = document.querySelector('.street').value;
  const number = document.querySelector('.number').value;
  const zip = document.querySelector('.cep').value;
  const district = document.querySelector('.district').value;
  const city = document.querySelector('.city').value;
  const select_state = document.querySelector('.select_state').value;
  const container_result = document.querySelector('.result');
  container_result.innerHTML = '';

  if (
    user_text.length === 0 ||
    password !== repeat_password ||
    password.length === 0 ||
    street.length === 0 ||
    number.length === 0 ||
    isNaN(number) ||
    zip.length > 8 ||
    zip.length < 8 ||
    zip.length === 0 ||
    isNaN(zip) ||
    district.length === 0 ||
    city.length === 0 ||
    select_state.length === 0
  ) {
    container_result.innerHTML = `<p class="error">Preencha os campos corretamente</p>`;
    return false;
  } else {
    fetch(`${BASE_URL}/user/register.php`, {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: JSON.stringify({
        username: user_text,
        password: password,
        street: street,
        number: number,
        district: district,
        state: select_state,
        zip: zip,
        type: 'CLIENT',
      }),
    })
      .then((res) => {
        container_result.innerHTML = `<p class="success">Cadastrado com sucesso</p>`;
        return res.json();
      })
      .catch((error) => {
        return console.log(error);
      });
  }
}
