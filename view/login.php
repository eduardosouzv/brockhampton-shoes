<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

  <link rel="icon" href="../assets/logo.png">

  <link rel="stylesheet" href="../styles/global.css">
  <link rel="stylesheet" href="../styles/index.css">

  <link rel="stylesheet" href="../styles/login.css">
  <link rel="stylesheet" href="../styles/global.css">
  <title>Inicio | BROCKHAMPTON</title>
</head>

<body>
  <?php include "../components/header.php"; ?>
  <main>
    <?php include "../components/menu.php"; ?>

    <div class="overlay" style="display: flex;">
      <div class="container">
        <div class="header">
          <img src="../assets/logo.png" alt="logo">
        </div>
        <form>
          <div class="input_user">
            <label>Usuario</label>
            <input ref="{userInput}" type="text" />
          </div>

          <div class="input_password">
            <label>Senha</label>
            <input ref="{passwordInput}" type="password" />
          </div>

          <div class="footer_buttons">
            <button class="create_account">
              Cadastre-se Aqui
            </button>
            <button class="login_button">
              Logar
            </button>
          </div>
        </form>

        <a href="/index.php" class="close">Voltar para pagina inicial</a>
      </div>
    </div>

  </main>

  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>

</html>