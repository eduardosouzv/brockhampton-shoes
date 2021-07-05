<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

  <link rel="icon" href="./assets/logo.png">

  <link rel="stylesheet" href="./styles/global.css">

  <link rel="stylesheet" href="./styles/pages/customer/login.css">
  <title>Inicio | BROCKHAMPTON</title>
</head>

<body>
  <?php include "./components/customer/header.php"; ?>
  <main>
    <?php include "./components/customer/menu.php"; ?>

    <div class="overlay" style="display: flex;">
      <div class="container">
        <div class="header">
          <img src="./assets/logo.png" alt="logo">
        </div>
        <form>
          <div class="input_user">
            <label>Usuario</label>
            <input type="text" />
          </div>

          <div class="input_password">
            <label>Senha</label>
            <input type="password" />
          </div>

          <div class="footer_buttons">
            <a href="/register" class="create_account">
              Cadastre-se Aqui
            </a>
            <button class="login_button">
              Logar
            </button>
          </div>
        </form>

        <a href="/" class="close">Voltar para pagina inicial</a>
      </div>
    </div>

  </main>

  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>

</html>