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

        </div>
        </div>
        <script>
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            if (!params.id) {
                window.location = "/shop";
            }

            showProductInformations(params.id);

            function showProductInformations(id) {
                const containerInfos = document.querySelector('.container');

                fetch(`http://localhost:8000/api/app/routes/products/findByID.php?id=${id}`)
                    .then((res) => {
                        return res.json();
                    })
                    .then((product) => {
                        return containerInfos.innerHTML = `
                            <div class="image_shoe">
                                <img src="${product.image_link}">
                            </div>
                            <div class="information">
                                <div class="name_shoe">
                                    <p>${product.product_name}</p>
                                </div>
                            <div class="information_shoe">
                                <li>${product.description.replace(",", "<li>")}</li>
                            </div>
                            <div class="sizes_shoe">
                                <p>TAMANHOS</p>
                                <div class="all_sizes">
                                    ${product.sizes.map((items) => {
                                        return `<button>${items}</button>`
                                    }).join('')}
                                </div>
                            </div>
                            <div class="price_shoe">
                                <p>PREÇO</p>
                                <p>R$${product.price}</p>
                            </div>
                                <button onclick="" class="add_button">Adicionar ao Carrinho</button>
                            </div>
                           `
                    })
                    .catch((error) => {
                        return error;
                    })
            }

            function buttonAddToCart() {

            }
        </script>
    </main>
</body>