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

$id = $_GET['id'] ?? null;
if ($id !== null) {
    Thema::deleteThema($id);
}

header('Location: themaBeheer.php');
exit;
