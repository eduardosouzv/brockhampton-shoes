<!DOCTYPE html>

<head>
   <meta charset="UTF-8">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

   <link rel="icon" href="./assets/logo.png">

   <link rel="stylesheet" href="./styles/global.css">
   <link rel="stylesheet" href="./styles/pages/customer/register.css">

   <title>Registrar | BROCKHAMPTON</title>
</head>

<body>
   <?php include "./components/customer/header.php"; ?>
   <main>
      <?php include "./components/customer/menu.php"; ?>
      <div class="container">
         <img src="https://i.imgur.com/bI0KYdg_d.webp?maxwidth=760&fidelity=grand" alt="banner">
         <form>
            <div class="title-box">
               <p>Registro</p>
            </div>
            <div class="fields">
               <div class="user">
                  <label>Informação de Usuario</label>
                  <input class="user_text" type="text" placeholder="Usuario">
                  <input class="password" type="password" placeholder="Senha">
                  <input class="repeat_password" type="password" placeholder="Repita a senha">
               </div>
               <div class="address">
                  <label>Informações de Endereço</label>
                  <div class="inline">
                     <input class="street" type="text" placeholder="Rua">
                     <input class="number" type="text" placeholder="Numero">
                  </div>
                  <input class="cep" type="text" placeholder="CEP">
                  <input class="district" type="text" placeholder="Bairro">
                  <div class="inline">
                     <input class="city" type="text" placeholder="Cidade">
                     <select class="select_state">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="result_and_register">
               <div class="result">
               </div>
               <div class="register">
                  <button onclick="postRegisterUser()">Registrar-se</button>
               </div>
            </div>
         </form>
      </div>
      <script>
         const form = document.querySelector('form');

         form.addEventListener('submit', (e) => {
            e.preventDefault();
         })

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
               fetch('http://localhost:8000/api/app/routes/user/register.php', {
                     method: 'POST',
                     headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json; charset=UTF-8'
                     },
                     body: JSON.stringify({
                        username: user_text,
                        password: password,
                        street: street,
                        number: number,
                        district: district,
                        state: select_state,
                        zip: zip,
                        type: 'CLIENT'
                     })
                  })
                  .then((res) => {
                     container_result.innerHTML = `<p class="success">Cadastrado com sucesso</p>`;
                     return res.json();
                  })
                  .catch((error) => {
                     return console.log(error);
                  })
            }
         }
      </script>
   </main>

</body>

</html>