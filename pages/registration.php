<?php include('../scripts/functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itrans – Registracija</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="jumbotron text-center bg-primary text-light" style="margin:0">
        <h1>Itrans</h1>
    </header>

    <nav class="navbar navbar-expand-sm bg-light navbar-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../index.html">Početna</a></li>
            <li class="nav-item"><a class="nav-link" href="about.html">O nama</a></li>
            <li class="nav-item"><a class="nav-link" href="vehicles.php">Vozila</a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php">Korisnik</a></li>
        </ul>
    </nav>

    <main class="bg-info text-light" style="margin-bottom:0">
        <article>
            <h2>Registracija</h2>
            <p>Ovdje se možete registrirati.</p>
        </article>
        <div class="user_form">
            <form method="post" action="registration.php">
                <div class="form-group">
                    <?php echo display_error(); ?>
                </div>
                <div class="form-group">
                    <label for="user_name">Ime</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Unesite ime">
                </div>
                <div class="form-group">
                    <label for="user_surname">Prezime</label>
                    <input type="text" class="form-control" id="user_surname" name="user_surname" placeholder="Unesite prezime">
                </div>
                <div class="form-group">
                    <label for="user_personal_number">OIB</label>
                    <input type="text" class="form-control" id="user_personal_number" name="user_personal_number" placeholder="Unesite OIB">
                </div>
                <div class="form-group">
                    <label for="email">E-pošta</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Unesite e-poštu">
                </div>
                <div class="form-group">
                    <label for="user_telephone">Telefon</label>
                    <input type="tel" class="form-control" id="user_telephone" name="user_telephone" placeholder="Unesite telefonski broj">
                </div>
                <div class="form-group">
                    <label for="user_address">Adresa</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Unesite adresu">
                </div>
                <div class="form-group">
                    <label for="user_postal_code">Poštanski broj</label>
                    <input type="text" class="form-control" id="user_postal_code" name="user_postal_code" placeholder="Unesite poštanski broj">
                </div>
                <div class="form-group">
                    <label for="user_town">Mjesto</label>
                    <input type="text" class="form-control" id="user_town" name="user_town" placeholder="Unesite mjesto">
                </div>
                <div class="form-group">
                    <label for="user_country">Država</label>
                    <input type="text" class="form-control" id="user_country" name="user_country" placeholder="Unesite državu">
                </div>
                <div class="form-group">
                    <label for="password_1">Zaporka</label>
                    <input type="password" class="form-control" id="password_1" name="password_1" placeholder="Unesite zaporku">
                </div>
                <div class="form-group">
                    <label for="password_2">Zaporka</label>
                    <input type="password" class="form-control" id="password_2" name="password_2" placeholder="Ponovno unesite zaporku">
                </div>
                <button type="submit" class="btn btn-warning" name="register_btn">Registriraj</button>
                <div class="form-group">
                    <p>
		                <a href="login.php" class="question">Već ste registrirani? </a>
	                </p>
                </div>
            </form>
        <div/>
    </main>

    <footer class="jumbotron text-center bg-light" style="margin-bottom:0">
        <p>&copy 2020 ivan.ivkovic@etfos.hr</p>
    </footer>
</body>

</html>