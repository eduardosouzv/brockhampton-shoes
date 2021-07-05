<!DOCTYPE html>

<head>
   <meta charset="UTF-8">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

   <link rel="icon" href="../../assets/logo.png">

   <link rel="stylesheet" href="../../styles/global.css">
   <link rel="stylesheet" href="../../styles/pages/customer/register.css">

   <title>Registrar | BROCKHAMPTON</title>
</head>

<body>
   <?php include "../../components/customer/header.php"; ?>
   <main>
      <?php include "../../components/customer/menu.php"; ?>
      <div class="container">
         <img src="https://i.imgur.com/bI0KYdg_d.webp?maxwidth=760&fidelity=grand" alt="banner">
         <form>
            <div class="title-box">
               <p>Registro</p>
            </div>
            <div class="fields">
               <div class="user">
                  <label>Informação de Usuario</label>
                  <input type="text" placeholder="Usuario">
                  <input type="password" placeholder="Senha">
                  <input type="password" placeholder="Repita a senha">
               </div>

               <div class="address">
                  <label>Informações de Endereço</label>
                  <div class="inline">
                     <input type="text" placeholder="Rua">
                     <input type="text" placeholder="Numero">
                  </div>
                  <input type="text" placeholder="CEP">
                  <input type="text" placeholder="Bairro">
                  <div class="inline">
                     <input type="text" placeholder="Cidade">
                     <select class="select_state">
                        <option value="" selected disabled hidden>Estado</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="PR">PR</option>
                        <option value="BR">BR</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="register_button">
               <button>Registrar-se</button>
            </div>
         </form>
      </div>

   </main>

</body>

</html>