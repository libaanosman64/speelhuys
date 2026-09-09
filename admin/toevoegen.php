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
          </li>
        </ul>
      </div>
    </div>
  </nav>
   <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Product toevoegen</h2>
                <form method="POST" action="toevoegen.php" enctype="multipart/form-data">
                    <input type="text" class="textboxName" id="title" name="title" placeholder="productnaam" required><br>
                    <input type="text" class="textboxName" id="author" name="author" placeholder="thema" required><br>
                    <input type="text" class="textboxName" id="publisher" name="publisher" placeholder="merk" required><br>
                    <input type="text" class="textboxName" id="year" name="year" placeholder="aantal" required><br><br>

                    <div class="form-group">
                        <textarea class="jqte" id="content" name="content" required></textarea>
                    </div>

                    <input type="file" id="bestand" name="bestand" />
                    <br><br />
                    <input type="submit" class="add" name="submit" value="product toevoegen" />
                </form>
            </div>
        </div>
    </div>




 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>