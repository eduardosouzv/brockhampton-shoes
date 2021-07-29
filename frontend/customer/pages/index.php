<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/frontend/customer/styles/index.css">

  <title>Inicio | BROCKHAMPTON</title>

  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body>
  <?php include "./frontend/customer/components/header.php"; ?>
  <main>
    <?php include "./frontend/customer/components/menu.php"; ?>
    <div class="carousel">
      <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true, "prevNextButtons": false,
        "pageDots": false, "freeScroll": true }'>
        <div class="carousel-cell"><img src="/frontend/assets/carousel/01.jpg" alt="banner"></div>
        <div class="carousel-cell"><img src="/frontend/assets/carousel/02.jpg" alt="banner"></div>
        <div class="carousel-cell"><img src="/frontend/assets/carousel/03.jpg" alt="banner"></div>
        <div class="carousel-cell"><img src="/frontend/assets/carousel/04.jpg" alt="banner"></div>
      </div>
    </div>
  </main>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>

</html>