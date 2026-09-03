
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speelhuys Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
  <a href="toevoegen.php" class="voeg">Toevoegen</a>
  <nav class="navbar">
    <div class="navbar-content">
      <a class="navbar-brand" href="#">Speelhuys</a>
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
                <a class="nav-link" href="index.php?uitgelogd">Uitloggen</a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<?php

include '../classes/Database.php';
include '../classes/producten.php';


if(isset($_COOKIE['speelhuys-session'])) {
 
echo "<table class='table'>";
echo "<tr><td>ID</td> <td>Naam</td> <td>Voorraad</td> <td>Details</td> <td>Verwijder</td> <td>Edit</td></tr>";
$producten = Producten::findProducten();
foreach ($producten as $product) {
  echo "<tr>";
  echo "<td>"  . $product->set_id .  "</td>";
  echo "<td>" .   $product->setNaam . "</td>";
  echo "<td>" . $product->setVoorraad . "</td>";
  echo "<td><a href='detail.php?id=" . $product->set_id . "'>Bekijk</a></td>";
  echo "<td><a href='delete.php?id=" . $product->set_id . "'>Verwijder</a></td>";
  echo "<td><a href='edit.php?id=" . $product->set_id . "'>Edit</a></td>";
}
echo "</table>";
}
if (isset($_GET['deleted'])) {
  echo "<div class='alert alert-success' role='alert'>Product succesvol verwijderd.</div>";
}
if (isset($_GET['medewerker'])) {
  echo "<div class='alert alert-danger' role='alert'>U heeft geen toegang tot deze functie.</div>";
}
if(!isset($_COOKIE['speelhuys-session'])) {
  header('Location: index.php?verlopen');
  exit;

}
