<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="icon" href="../assets/logo.png">

    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/checkout.css">
    <script src="https://kit.fontawesome.com/4f9ae860b6.js" crossorigin="anonymous"></script>
    <title>Carrinho | BROCKHAMPTON</title>
</head>

<body>
    <?php include "../components/header.php"; ?>
    <main>
        <?php include "../components/menu.php"; ?>
        <div class="container-checkout">
            <div>
                <p class="name_cart">Seu Carrinho</p>
            </div>

            <div class="inline_content">
                <div class="products">
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button onclick=""><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <div class="product_item">
                        <div class="image_product">
                            <img src="../assets/products/shoe.jpg">
                        </div>
                        <div class="information_product">
                            <p>AIR MAX 9999</p>
                            <p>R$ 999.99</p>
                            <button><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>
                <div class="cart_infos">
                    <p>Total:</p>
                    <p>Frete: GRÁTIS</p>
                    <button onclick="" class="finish_button">FINALIZAR COMPRA</button>
                </div>
            </div>
        </div>
</body>