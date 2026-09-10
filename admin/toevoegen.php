<?php
include '../classes/database.php';
include '../classes/producten.php';

$merken = Producten::findMerken();
$themes = Producten::findThemas();


if (isset($_POST["naam"]) && isset($_POST["stukjes"]) && isset($_POST["prijs"]) && isset($_POST["Description"]) && isset($_POST["leeftijd"]) && !empty($_POST["merken"]) && !empty($_POST["thema"]) && !empty($_FILES["setImage"]["name"])) {

  $naam = $_POST["naam"];
  $description = $_POST["Description"];
  $aantal = $_POST["aantal"];
  $leeftijd = $_POST["leeftijd"];
  $prijs = $_POST["prijs"];
  $stukjes = $_POST["stukjes"];
  $merkId = $_POST["merken"];
  $themaId = $_POST["thema"];
  $setImage = $_FILES["setImage"]["name"];
  $targetSetImage = "../images/sets/";
  $setFile = $targetSetImage . basename($_FILES["setImage"]["name"]);
  move_uploaded_file($_FILES["setImage"]["tmp_name"], $setFile);

  $product = new Producten();
  $product->setNaam = $naam;
  $product->setDiscription = $description;
  $product->setLeeftijd = $leeftijd;
  $product->setStukjes = $stukjes;
  $product->setPrijs = $prijs;
  $product->setAantal = $aantal;
  $product->Merk_id = $merkId;
  $product->setThema_id = $themaId;
  $product->setImage = $setImage;
  $product->insertProduct();



  header('Location: beheer.php?toegevoegd');
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
      <a class="navbar-brand" href="#">Product Toevoegen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="beheer.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gebruikers.php">Gebruikers beheren</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="toevoegen.php">Themas en merken bewerken</a>
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
        <h2>Product toevoegen</h2>
        <form method="POST" action="toevoegen.php" enctype="multipart/form-data">
          <input type="text" class="textboxName" id="naam" name="naam" placeholder="productnaam" required><br>
          <input type="number" class="textboxName" id="leeftijd" name="leeftijd" placeholder="leeftijd" required><br>
          <input type="number" class="textboxName" id="stukjes" name="stukjes" placeholder="aantal stukjes" required><br>
          <input type="number" class="textboxName" id="aantal" name="aantal" placeholder="aantal" required><br><br>
          <input type="number" class="textboxName" id="prijs" name="prijs" placeholder="prijs" required><br><br>
          <select name="merken" id="merk-select" required>
            <option value="">-- kies een merk --</option>
            <?php foreach ($merken as $merk) { ?>
              <option value="<?=($merk->Merk_id) ?>">
                <?=($merk->Merk_naam) ?>
              </option>
            <?php } ?>
          </select>
          <br><br>

          <select name="thema" id="thema-select" required>
            <option value="">-- kies een thema --</option>
            <?php foreach ($themes as $theme) { ?>
              <option value="<?=($theme->Thema_id) ?>">
                <?=($theme->Thema_naam) ?>
              </option>
            <?php } ?>
          </select>
          <br><br>

          <div class="form-group">
            <textarea class="jqte" id="Description" name="Description" required></textarea>
          </div>
          <br>
          Logo:<br>
          <input type="file" id="logo" name="logo" />
          <br>
          Set afbeelding:<br>
          <input type="file" id="setImage" name="setImage" />
          <br><br />
          <input type="submit" class="add" name="submit" value="product toevoegen" />
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