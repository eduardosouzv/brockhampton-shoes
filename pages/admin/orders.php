<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="icon" href="../assets/logo.png">

    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/pages/admin/orders.css">

    <title>Pedidos | BROCKHAMPTON</title>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</head>

<body>
    <div class="page_container">
        <div>
            <?php include "./components/admin/menu.php"; ?>
        </div>
        <main>
            <div>
                <h1 class="title">
                    <span>Pedidos</span>
                </h1>
            </div>

            <div class="orders_list">
                <div class="order">
                    <h1>Nº 1</h1>
                    <p>Eduardo Schulz</p>
                    <p class="status">PROCESSANDO</p>
                    <div class="buttons">
                        <i class="far fa-check-circle"></i>
                        <i class="fas fa-folder" id="look"></i>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="overlay" class="modal hidden visuallyHidden">
        <div class="content">
            <div class="order">
                <div class="close_button">
                    <button id="close" class="close">&times;</button>
                </div>
                <div class="information">
                    <h1>Pedido Nº 1</h1>
                    <h2>Nome:</h2>
                    <p>Eduardo Schulz</p>
                    <h2>Produtos:</h2>
                    <div class="products">
                        <div class="item">
                            <img src="/assets/products/shoe.jpg">
                            <p>AIRMAX 999</p>
                            <p>48</p>
                            <p>R$399,00</p>
                        </div>
                        <div class="item">
                            <img src="/assets/products/shoe.jpg">
                            <p>AIRMAX 999</p>
                            <p>48</p>
                            <p>R$399,00</p>
                        </div>
                    </div>
                    <h2>Endereço:</h2>
                    <p>Av. Marquês de Olinda, 460 - Costa e Silva, Joinville - SC, 89218-360</p>
                    <h2>Total:</h2>
                    <p>R$3.000</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const modal = document.getElementById('overlay');
        const body = document.getElementsByTagName('body');
        const container = document.getElementsByClassName('page_container');
        const btnClose = document.getElementById("close");
        const btnOpen = document.getElementById("look");

        btnOpen.onclick = function() {
            modal.className = "modal visuallyHidden";
            setTimeout(function() {
                container.className = "container blurred";
                modal.className = "modal";
            }, 100);
            container.className = "modalOpen";
        }

        btnClose.onclick = function() {
            modal.className = "modal hidden visuallyHidden";
            container.className = "container";
        }
    </script>
</body>

</html>