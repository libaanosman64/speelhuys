<?php



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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Producten</a>
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
                                <form class="d-flex">
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" type="search" placeholder="Search" aria-label="Search">
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
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Thema1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Thema2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                    Thema3
                                </label>
                            </div>
                            <b>Merk</b>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Merk1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Merk2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                    Merk3
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-evenly">
            <div class="col-3">
                <div class="card h-100 border-shadow" style="width: 18rem;">
                    <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Naam</h5>
                        <a href="bestellen.html" class="btn btn-primary">Bekijk</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100 border-shadow" style="width: 18rem;">
                    <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Naam</h5>
                        <a href="bestellen.html" class="btn btn-primary">Bekijk</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card h-100 border-shadow" style="width: 18rem;">
                    <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Naam</h5>
                        <a href="bestellen.html" class="btn btn-primary">Bekijk</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-evenly align-items-begin" style="margin-top: 100;">
                <div class="col-3">
                    <div class="card h-100 border-shadow" style="width: 18rem;">
                        <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Naam</h5>
                            <a href="bestellen.html" class="btn btn-primary">bekijk</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card h-100 border-shadow" style="width: 18rem;">
                        <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Naam</h5>
                            <a href="bestellen.html" class="btn btn-primary">bekijk</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card h-100 border-shadow" style="width: 18rem;">
                        <img src="images/sets/smartmax_safari.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Naam</h5>
                            <a href="bestellen.html" class="btn btn-primary">bekijk</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 25;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>



</html>