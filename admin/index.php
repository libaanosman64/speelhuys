<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speelhuys Inlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a class="navbar-brand" href="#">Speelhuys Inlog</a>
            <ul class="navbar-nav"></ul>
        </div>
    </nav>

    <main class="centerlogin">
        <h1 class="colortext">Speelhuys Inlog</h1>
        <form name="form1" method="post">
            <input type="text" name="username" placeholder="Username" value="" size="35" class="textbox" /><br>
            <input type="password" name="password" placeholder="Password" value="" size="35" class="textbox" /><br>
            <input type="submit" value="Inloggen" class="button" />
            <div class="button a"> <a href="../index.php">Terug</a> </div>
        </form>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

<div class="errortext">

    <?php
    include '../classes/Database.php';
    include '../classes/sessie.php';
    include '../classes/gebruiker.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $gebruiker = Gebruiker::findGebruiker($username, $password);
    if ($username !== '' && $password !== '') {
        if ($gebruiker === null) {
            echo 'Ongeldige inloggegevens';
        } else {
            $key = md5(uniqid(rand(), true));
            $session = new Sessie();
            $session->sessie_gebruiker_id = $gebruiker->gebruikerid;
            $session->sessie_key = $key;
            $session->sessie_start = date('Y-m-d H:i:s');
            $session->sessie_end = date('Y-m-d H:i:s', strtotime('+1 month'));
            $session->insert();
            setcookie('speelhuys-session', $key, strtotime('+1 month'), '/');
            header('Location: beheer.php');
            exit;
        }
    }
    if (isset($_GET['verlopen'])) {
        echo 'Uw sessie is verlopen, log opnieuw in.';
    }
    ?>