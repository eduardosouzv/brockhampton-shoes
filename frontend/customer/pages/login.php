<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/login.css">
  <title>Inicio | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>

    <div class="overlay" style="display: flex;">
      <div class="container">
        <div class="header">
          <img src="/frontend/assets/logo.png" alt="logo">
        </div>
        <form>
          <div class="input_user">
            <label>Usuario</label>
            <input id="user" type="text" />
          </div>

          <div class="input_password">
            <label>Senha</label>
            <input id="password" type="password" />
          </div>

          <div class="footer_buttons">
            <a href="/register" class="create_account">
              Cadastre-se Aqui
            </a>
            <button onclick="authenticateUser()" class="login_button">
              Logar
            </button>
          </div>
        </form>

        <a href="/" class="close">Voltar para pagina inicial</a>
      </div>
    </div>

  </main>

  <script src="/frontend/customer/js/login.js"></script>
</body>

</html>