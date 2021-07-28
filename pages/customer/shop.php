<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="icon" href="./assets/logo.png">

    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/pages/customer/shop.css">
    <script src="https://kit.fontawesome.com/4f9ae860b6.js" crossorigin="anonymous"></script>
    <title>Loja | BROCKHAMPTON</title>
</head>

<body>
    <?php include "./components/customer/header.php"; ?>
    <main>
        <?php include "./components/customer/menu.php"; ?>
        <div class="container">
            <div class="container_categories">
                <h2 class="categories_name">Categorias</h2>
                <a href="#">Todos</a>
                <a href="#">Masculino</a>
                <a href="#">Feminino</a>
                <a href="#">Hype Content</a>
                <a href="#">Sportive</a>
                <a href="#">Skate Shoes</a>
            </div>
            <div class="content">
                <div class="container_products">
                    <div class="container_items">
                    </div>
                </div>
                <div class="pagination">
                    <a id="previous" onclick="previous(params.page)"><i class="fas fa-arrow-left"></i></a>
                    <a onclick="next(params.page)"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <script>
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            if (!params.page) {
                window.location = "/shop?page=1";
            }

            showProducts(params.page);

            function next(page) {
                const num = parseInt(page);

                fetch(`http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${num}`)
                    .then((res) => {
                        return res.json()
                    })
                    .then((products) => {
                        if (num < products.total_pages) {
                            const url = `http://localhost:8000/shop?page=${num + 1}`;
                            window.location = url
                        };
                    })
            }

            function previous(page) {
                const num = parseInt(page);
                if (num > 1) {
                    const url = `http://localhost:8000/shop?page=${num - 1}`;
                    window.location = url;
                }
            }

            function showPags(page) {
                const num = parseInt(page);
                const containerPagination = document.querySelector('#previous');

                fetch(`http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${page}`)
                    .then((res) => {
                        return res.json();
                    })
                    .then((pagination) => {

                    });
            }

            function showProducts(page) {
                const containerItems = document.querySelector('.container_items');
                fetch(`http://localhost:8000/api/app/routes/products/findAllWithLimit.php?page=${page}`)
                    .then((res) => {
                        return res.json();
                    })
                    .then((res) => {
                        const productsMap = res.products.map((items) => {
                            return `<div class="shoes" onClick="redirectToProduct(${items.id})"><img src="${items.image_link}"><p class="name_shoe">${items.product_name}</p><p class="price_shoe">R$${items.price}</p></div>`;
                        })
                        containerItems.innerHTML = productsMap.join("");
                    })
                    .catch((error) => {
                        return error;
                    })
            }

            function redirectToProduct(id) {
                const url = `http://localhost:8000/product?id=${id}`;
                window.location = url;
            }
        </script>
    </main>
</body>