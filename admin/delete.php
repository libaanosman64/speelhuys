<?php 

include '../classes/database.php';
include '../classes/producten.php';
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

$id = $_GET['set_id'] ?? $_GET['id'] ?? null;
if ($id !== null) {
    Producten::deleteProduct($id);
    header('Location: beheer.php?deleted');
    exit;
}