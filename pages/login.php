<?php include('../scripts/functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itrans – Prijava</title>
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
            <h2>Prijava</h2>
            <p>Ovdje se možete prijaviti koristeći svoju adresu e-pošte i zaporku.</p>
        </article>
        <div class="user_form">
            <form method="post" action="login.php">
                <div class="form-group">
                    <?php echo display_error(); ?>
                </div>
                <div class="form-group">
                    <label for="email">E-pošta</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Unesite e-poštu">
                </div>
                <div class="form-group">
                    <label for="password">Zaporka</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Unesite zaporku">
                </div>
                <button type="submit" class="btn btn-warning" name="login_btn">Prijava</button>
                <div class="form-group">
                    <p>
		                <a href="registration.php" class="question">Niste se registrirali? </a>
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