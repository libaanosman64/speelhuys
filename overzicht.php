<?php
include 'classes/database.php';
include 'classes/producten.php';

$themas = Producten::findThemas();
$prijsVolgorde = $_GET['prijs'] ?? null;
$themaId = isset($_GET['thema']) ? (int) $_GET['thema'] : null;
$zoekterm = trim($_GET['zoek'] ?? '');
if ($themaId < 1) {
    $themaId = null;
}


?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <nav class="navbar">
            <div class="navbar">
                <a class="navbar-brand" href="#">Speelhuys</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="overzicht.php">Producten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/index.php">Inloggen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container" style="margin-top: 200;">
        <div class="container" style="width: 800;">
            <div class="row textbox justify-content-center" style="text-align: center;">
                <div class="col">
                    <h1>Speelhuys</h1>
                </div>
            </div>
            <div class="row justify-content-evenly">
                <div class="col-9">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="d-flex" method="get" action="overzicht.php">
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" type="search" name="zoek" value="<?= htmlspecialchars($zoekterm, ENT_QUOTES, 'UTF-8') ?>" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-primary px-4" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <p class="d-inline-flex gap-1">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <h5>Filter<h5>
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <b>Thema</b>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="thema-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kies een thema
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="thema-dropdown">
                                    <li><a class="dropdown-item" href="overzicht.php">Alle thema's</a></li>
                                <?php foreach ($themas as $thema) { ?>
                                    <li>
                                        <a class="dropdown-item" href="?thema=<?=($thema->Thema_id) ?>">
                                            <?=($thema->Thema_naam) ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                            </div>
                            <b>Prijs</b>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="prijs-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sorteer op prijs
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="prijs-dropdown">
                                    <li><a class="dropdown-item" href="?prijs=hoog-laag">Hoog naar laag</a></li>
                                    <li><a class="dropdown-item" href="?prijs=laag-hoog">Laag naar hoog</a></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <?php
    $perPagina = 6;
    $pagina = max(1, (int) ($_GET['page'] ?? 1));
    $aantalPaginas = max(1, Producten::pages($themaId, $zoekterm));
    $pagina = min($pagina, $aantalPaginas);
    $producten = Producten::filter($zoekterm, $themaId, $prijsVolgorde, $perPagina, ($pagina - 1) * $perPagina);
    ?>
    <div class="container">
        <div class="row g-4" style="margin-top: 100px;">
            <?php foreach ($producten as $product) { ?>
                <div class="col-12 col-md-4">
                    <div class="card  border-shadow ">
                        <img src="images/sets/<?php echo $product->setImage; ?>" class="card-img-top images" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->setNaam; ?></h5>
                            <a href="detail.php?id=<?php echo $product->set_id; ?>" class="btn btn-primary"> bekijk</a>  prijs: € <?php echo $product->setPrijs ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
            <div class="container" style="margin-top: 25;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo $pagina === 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $pagina - 1; ?>" tabindex="-1">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $aantalPaginas; $i++) {
                            $active = $i === $pagina ? 'active' : '';
                            echo "<li class=\"page-item $active\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
                        } ?>
                        <li class="page-item <?php echo $pagina === $aantalPaginas ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $pagina + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>



</html>

<?php
