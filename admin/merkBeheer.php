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

$melding = '';
$meldingType = 'success';

if (isset($_POST['actie']) && $_POST['actie'] === 'toevoegen') {
    $naam = $_POST['naam'] ?? '';
    $logo = $_FILES['logo']['name'] ?? '';
    $logoMap = '../images/logos/';
    $logoBestand = $logoMap . basename($logo);

    if ($logo !== '' && move_uploaded_file($_FILES['logo']['tmp_name'], $logoBestand)) {
        $merk = new Merk();
        $merk->Merk_naam = $naam;
        $merk->Merk_logo = basename($logo);
        $merk->insertMerk();
        $melding = 'Merk succesvol toegevoegd.';
    } else {
        $melding = 'Het merk kon niet worden toegevoegd.';
        $meldingType = 'danger';
    }
} elseif (isset($_POST['actie']) && $_POST['actie'] === 'verwijderen') {
    if (Merk::deleteMerk($_POST['merk_id'] ?? 0)) {
        $melding = 'Merk succesvol verwijderd.';
    } else {
        $melding = 'Dit merk kan niet worden verwijderd zolang er producten aan gekoppeld zijn.';
        $meldingType = 'danger';
    }
}

$merken = Merk::findMerken();
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Merken beheren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a class="navbar-brand" href="beheer.php">Merken beheren</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Navigatie openen">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="beheer.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="gebruikers.php">Gebruikers beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="themaBeheer.php">Thema's beheren</a></li>
                    <li class="nav-item"><a class="nav-link active" href="merkBeheer.php">Merken beheren</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?uitgelogd">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <h1>Merken beheren</h1>

        <?php if ($melding !== '') { ?>
            <div class="alert alert-<?=($meldingType) ?>" role="alert">
                <?=($melding) ?>
            </div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" class="row g-2 mb-4">
            <input type="hidden" name="actie" value="toevoegen">
            <div class="col-sm-5 col-md-4">
                <label class="visually-hidden" for="naam">Naam van merk</label>
                <input class="form-control" type="text" id="naam" name="naam" placeholder="Naam van merk" required maxlength="100">
            </div>
            <div class="col-sm-5 col-md-4">
                <label class="visually-hidden" for="logo">Logo van merk</label>
                <input class="form-control" type="file" id="logo" name="logo" accept="image/*" required>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Merk toevoegen</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr><th>ID</th><th>Naam</th><th>Logo</th><th>Actie</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($merken as $merk) { ?>
                        <tr>
                            <td><?= $merk->Merk_id ?></td>
                            <td><?= ($merk->Merk_naam) ?></td>
                            <td><?= ($merk->Merk_logo) ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="actie" value="verwijderen">
                                    <input type="hidden" name="merk_id" value="<?= (int) $merk->Merk_id ?>">
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
