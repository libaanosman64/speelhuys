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
                   <a class="nav-link" href="gebruikers.php">Gebruikers beheren</a>
          
            </li>
          <li class="nav-item">
            <a class="nav-link" href="toevoegen.php">Themas en merken bewerken</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="index.php?uitgelogd">Uitloggen</a>
        </ul>
      </div>
    </div>
  </nav>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>


<?php 
include '../classes/database.php';
include '../classes/gebruiker.php';
include '../classes/sessie.php';


if(isset($_COOKIE['speelhuys-session'])) {

$sessie = Sessie::findSessie($_COOKIE['speelhuys-session']);
$rol = $sessie ? Gebruiker::findRol($sessie->sessie_gebruiker_id) : null;

 
echo "<table class='table'>";
echo "<tr><td>ID</td> <td>Naam</td> <td>Rol</td> <td>Acties</td></tr>";
$gebruikers = Gebruiker::findAllGebruikers();
foreach ($gebruikers as $gebruiker) {
  echo "<tr>";
  echo "<td>"  . $gebruiker->gebruikerid .  "</td>";
  echo "<td>" .   $gebruiker->gebruikersnaam . "</td>";
  echo "<td>" . $gebruiker->rol . "</td>";
  echo "<td><a href='rolbeheer.php?id=" . $gebruiker->gebruikerid . "'>rol aanpassen</a></td>";
  
}
echo "</table>";
}
if (isset($_GET['rol_aangepast'])) {
  echo "<div class='alert alert-success' role='alert'>rol aangepast.</div>";
}
if (isset($_GET['medewerker'])) {
  echo "<div class='alert alert-danger' role='alert'>U heeft geen toegang tot deze functie.</div>";
}
if(!isset($_COOKIE['speelhuys-session'])) {
  header('Location: index.php?verlopen');
  exit;

}
if($rol !== 'admin') {
  header('Location: beheer.php?medewerker');
  exit;
}