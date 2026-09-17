<?php
include 'classes/database.php';
include 'classes/producten.php';

$producten = Producten::findProducten(3);
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speelhuys Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="homepage-page">
  <div class="container-fluid px-0">
    <nav class="navbar">
      <div class="navbar-content">
        <a class="navbar-brand" href="index.php">Speelhuys</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="overzicht.php">Producten</a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/index.php">Inloggen</a>
            </li>
        </ul>
      </div>
          </div>
        </nav>
      </div>

      <main class="container homepage">
        <section class="homepage-intro">
          <h1>Welkom bij Speelhuys</h1>
          <p>Ontdek leuke bouwsets voor urenlang speelplezier.</p>
          <a href="overzicht.php" class="btn btn-primary">Bekijk alle producten</a>
        </section>

        <section class="homepage-products">
          <h2>Uitgelichte producten</h2>
          <div class="row g-4">
            <?php foreach ($producten as $product) { ?>
              <div class="col-12 col-md-4">
                <div class="card border-shadow">
                  <img src="images/sets/<?= $product->setImage ?>" class="card-img-top images" alt="<?= htmlspecialchars($product->setNaam, ENT_QUOTES, 'UTF-8') ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?=$product->setNaam ?></h5>
                    <p class="card-text">€ <?= $product->setPrijs ?></p>
                    <a href="detail.php?id=<?= $product->set_id ?>" class="btn btn-primary">Bekijk product</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </section>
      </main>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>