<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="icon" href="./assets/logo.png">

    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/pages/customer/product.css">
    <script src="https://kit.fontawesome.com/4f9ae860b6.js" crossorigin="anonymous"></script>
    <title>Loja | BROCKHAMPTON</title>
</head>

<body>
    <?php include "./components/customer/header.php"; ?>
    <main>
        <?php include "./components/customer/menu.php"; ?>
        <div class="container">
            <div class="image_shoe">
                <img src="./assets/products/shoe.jpg">
            </div>
            <div class="information">
                <div class="name_shoe">
                    <p>NIKE AIR MAX 97</p>
                </div>
                <div class="information_shoe">
                    <li>MADE IN BRAZIL / FEITO NO BRASIL</li>
                    <li>NIKE FEITO DE BORRACHA</li>
                </div>
                <div class="sizes_shoe">
                    <p>TAMANHOS</p>
                    <button>38</button>
                    <button>38</button>
                    <button>38</button>
                    <button>38</button>
                </div>
                <div class="price_shoe">
                    <p>PREÇO</p>
                    <p>R$399,00</p>
                </div>
                <button onclick="" class="add_button">Adicionar ao Carrinho</button>
            </div>
        </div>
    </main>
</body>