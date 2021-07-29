<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/register.css">

  <title>Registrar | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>
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
    <script src="/frontend/customer/js/register.js"></script>
  </main>

</body>

</html>