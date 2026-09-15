<?php
include '../classes/database.php';
include '../classes/producten.php';
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
$sessie = Sessie::findSessie($_COOKIE['speelhuys-session']);
$rol = $sessie ? Gebruiker::findRol($sessie->sessie_gebruiker_id) : null;

if ($rol !== 'admin') {
    header('Location: beheer.php?medewerker');
    exit;
}


$melding = '';
$meldingType = 'success';

if (isset($_POST['actie']) && $_POST['actie'] === 'toevoegen') {
	$thema = new Thema();
	$thema->Thema_naam = $_POST['naam'] ?? '';
	if ($thema->Thema_naam !== '') {
		$thema->insertThema();
		$melding = 'Thema succesvol toegevoegd.';
	} else {
		$melding = 'Het thema kon niet worden toegevoegd.';
		$meldingType = 'danger';
	}
} elseif (isset($_POST['actie']) && $_POST['actie'] === 'verwijderen') {
	if (Thema::deleteThema($_POST['thema_id'] ?? 0)) {
		$melding = 'Thema succesvol verwijderd.';
	} else {
		$melding = 'Dit thema kan niet worden verwijderd zolang er producten aan gekoppeld zijn.';
		$meldingType = 'danger';
	}
}



$themas = Thema::findThemas();
?>
<!doctype html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thema's beheren</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<nav class="navbar">
		<div class="navbar-content">
			<a class="navbar-brand" href="beheer.php">Thema's beheren</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Navigatie openen">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="beheer.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="gebruikers.php">Gebruikers beheren</a></li>
					<li class="nav-item"><a class="nav-link active" href="themaBeheer.php">Themas beheren</a></li>
					<li class="nav-item"><a class="nav-link" href="index.php?uitgelogd">Uitloggen</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="container mt-5">
		<h1>Thema's beheren</h1>

		<?php if ($melding !== '') { ?>
			<div class="alert alert-<?=($meldingType) ?>" role="alert">
				<?= ($melding) ?>
			</div>
		<?php } ?>

		<form method="post" class="row g-2 mb-4">
			<input type="hidden" name="actie" value="toevoegen">
			<div class="col-sm-8 col-md-6">
				<label class="visually-hidden" for="naam">Naam van thema</label>
				<input class="form-control" type="text" id="naam" name="naam" placeholder="Naam van thema" required maxlength="100">
			</div>
			<div class="col-auto">
				<button class="btn btn-primary" type="submit">Thema toevoegen</button>
			</div>
		</form>

		<?php
		echo "<table class='table'>";
		echo "<tr><td>ID</td><td>Naam</td><td>Verwijder</td></tr>";
		foreach ($themas as $thema) {
			echo "<tr>";
			echo "<td>" . $thema->Thema_id . "</td>";
			echo "<td>" . $thema->Thema_naam . "</td>";
			echo "<td><a href='themaDelete.php?id=" . $thema->Thema_id . "'>Verwijder</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		?>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
