<?php
include '../classes/database.php';
include '../classes/producten.php';
include '../classes/merk.php';
include '../classes/thema.php';

$id = $_GET['id'] ?? null;
$product = $id ? Producten::findProductById($id) : null;
$merken = Merk::findMerken();
$themes = Thema::findThemas();

if (!$product) {
  header('Location: beheer.php');
  exit;
}

if (isset($_POST['naam'], $_POST['stukjes'], $_POST['prijs'], $_POST['Description'], $_POST['leeftijd'], $_POST['aantal'], $_POST['merken'], $_POST['thema'])) {
  $product->setNaam = $_POST['naam'];
  $product->setDiscription = $_POST['Description'];
  $product->setLeeftijd = $_POST['leeftijd'];
  $product->setStukjes = $_POST['stukjes'];
  $product->setPrijs = $_POST['prijs'];
  $product->setAantal = $_POST['aantal'];
  $product->Merk_id = $_POST['merken'];
  $product->setThema_id = $_POST['thema'];

  if (!empty($_FILES['setImage']['name'])) {
    $product->setImage = $_FILES['setImage']['name'];
    move_uploaded_file($_FILES['setImage']['tmp_name'], '../images/sets/' . basename($product->setImage));
  }

  $product->updateProduct();
  header('Location: beheer.php?bewerkt');
  exit;
}
?>
<html>
<head>
    <meta charset="utf-8">
  <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speelhuys Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
  <nav class="navbar">
    <div class="navbar-content">
      <a class="navbar-brand" href="#">Product Bewerken</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="beheer.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gebruikers.php">Gebruikers beheren</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="toevoegen.php">Product toevoegen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="merkBeheer.php">Merken beheren</a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uitgelogd">Uitloggen</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2>Product bewerken</h2>
        <form method="POST" action="edit.php?id=<?= $product->set_id ?>" enctype="multipart/form-data">
          <input type="text" class="textboxName" name="naam" value="<?=($product->setNaam) ?>" placeholder="productnaam" required><br>
          <input type="number" class="textboxName" name="leeftijd" value="<?= ($product->setLeeftijd) ?>" placeholder="leeftijd" required><br>
          <input type="number" class="textboxName" name="stukjes" value="<?= ($product->setStukjes) ?>" placeholder="aantal stukjes" required><br>
          <input type="number" class="textboxName" name="aantal" value="<?=($product->setAantal) ?>" placeholder="aantal" required><br><br>
          <input type="number" step="0.01" class="textboxName" name="prijs" value="<?=($product->setPrijs) ?>" placeholder="prijs" required><br><br>

          <select name="merken" required>
            <option value="">-- kies een merk --</option>
            <?php foreach ($merken as $merk) { ?>
              <option value="<?= $merk->Merk_id ?>" <?= $merk->Merk_id == $product->Merk_id ? 'selected' : '' ?>>
                <?=($merk->Merk_naam) ?>
              </option>
            <?php } ?>
          </select>
          <br><br>

          <select name="thema" required>
            <option value="">-- kies een thema --</option>
            <?php foreach ($themes as $theme) { ?>
              <option value="<?= $theme->Thema_id ?>" <?= $theme->Thema_id == $product->setThema_id ? 'selected' : '' ?>>
                <?= ($theme->Thema_naam) ?>
              </option>
            <?php } ?>
          </select>
          <br><br>

          <div class="form-group">
            <textarea class="jqte" name="Description" required><?=$product->setDiscription ?></textarea>
          </div>
          <br>
          Huidige afbeelding: <?=$product->setImage?><br>
          Nieuwe set afbeelding<br>
          <input type="file" name="setImage">
          <br><br>
          <input type="submit" class="add" value="product opslaan">
        </form>
      </div>
    </div>
  </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
  <script>
    $('.jqte').jqte();
  </script>
</body>
</html>


<?php 

include '../classes/gebruiker.php';
include '../classes/sessie.php';


if (!isset($_COOKIE['speelhuys-session'])) {
    header('Location: index.php?verlopen');
    exit;
}

$sessie = Sessie::findSessie($_COOKIE['speelhuys-session']);
$rol = $sessie ? Gebruiker::findRol($sessie->sessie_gebruiker_id) : null;

if ($rol !== 'admin') {
    header('Location: beheer.php?medewerker');
    exit;
}
