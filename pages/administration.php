<?php 
    include('../scripts/functions.php');
    if (!isAdmin()) {
        $_SESSION['msg'] = "Pristup odbijen.";
        header('location: vehicles.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itrans – Upravljanje</title>
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
            <h2>Upravljanje</h2>
        </article>
        <div class="user_form">
            <?php
                $id_user = $_SESSION['user']['id_user'];
                $query = "SELECT * FROM users WHERE id_user=$id_user";
                $user = mysqli_fetch_assoc(mysqli_query($db, $query));
                $user_name = $user['user_name'];
                $user_surname = $user['user_surname'];
                $user_email = $user['email'];
                $user_type = $user['user_type'];
            ?>
            <h2> <?php echo $user_name;?> <?php echo $user_surname;?> 
                <small><i>(<?php echo $user_type;?>)</i></small> </h2>
             <p><?php echo $user_email;?></p>
            <a class="btn btn-danger btn-xs" href="profile.php?logout='1'">Odjava</a>
            <a class="btn btn-warning btn-xs" href="orders.php">Narudžbe</a>
            <a class="btn btn-warning btn-xs" href="users.php">Korisnici</a>
        <div/>
    </main>

    <footer class="jumbotron text-center bg-light" style="margin-bottom:0">
        <p>&copy 2020 ivan.ivkovic@etfos.hr</p>
    </footer>
</body>

</html>