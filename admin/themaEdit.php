<?php
include '../classes/database.php';
include '../classes/thema.php';
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

$themaId = $_GET['id'] ?? null;
$thema = $themaId ? Thema::findThemaById($themaId) : null;

if (!$thema) {
    header('Location: themaBeheer.php');
    exit;
}

if (isset($_POST['naam'])) {
    $naam = ($_POST['naam']);
    if ($naam !== '') {
        $thema->Thema_naam = $naam;
        $thema->updateThema();
        header('Location: themaBeheer.php?bewerkt');
        exit;
    }
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thema bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a class="navbar-brand" href="beheer.php">Thema Bewerken</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="beheer.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="gebruikers.php">Gebruikers beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="toevoegen.php">Product toevoegen</a></li>
                    <li class="nav-item"><a class="nav-link" href="merkBeheer.php">Merken beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?uitgelogd">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Thema bewerken</h2>
                <form method="POST" action="themaEdit.php?id=<?= $thema->Thema_id ?>">
                    <input type="text" class="textboxName" name="naam" value="<?= $thema->Thema_naam?>" placeholder="Naam van thema" required><br>
                    <input type="submit" class="add" value="Thema opslaan">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

