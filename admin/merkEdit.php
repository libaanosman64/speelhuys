<?php
include '../classes/database.php';
include '../classes/merk.php';
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

$merkId = $_GET['id'] ?? null;
$merk = $merkId ? Merk::findMerkById($merkId) : null;

if (!$merk) {
    header('Location: merkBeheer.php');
    exit;
}

if (isset($_POST['naam'])) {
    $naam = trim($_POST['naam']);
    if ($naam !== '') {
        $merk->Merk_naam = $naam;

        if (!empty($_FILES['logo']['name'])) {
            $logoMap = '../images/logos/';
            $logoNaam = basename($_FILES['logo']['name']);
            $logoPad = $logoMap . $logoNaam;

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $logoPad)) {
                $merk->Merk_logo = $logoNaam;
            }
        }

        $merk->updateMerk();
        header('Location: merkBeheer.php?bewerkt');
        exit;
    }
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Merk bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a class="navbar-brand" href="beheer.php">Merk Bewerken</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="beheer.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="gebruikers.php">Gebruikers beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="themaBeheer.php">Thema's beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="merkBeheer.php">Merken beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?uitgelogd">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Merk bewerken</h2>
                <form method="POST" action="merkEdit.php?id=<?= $merk->Merk_id ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="naam" name="naam" value="<?=$merk->Merk_naam ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Nieuw logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>

                    <p>Huidig logo: <?=$merk->Merk_logo?></p>
                    <input type="submit" class="add" value="Merk opslaan">
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
