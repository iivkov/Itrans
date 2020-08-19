<?php 
    include('../scripts/functions.php');
    if (!isLoggedIn()) {
        $_SESSION['msg'] = "Potrebno je prijaviti se.";
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itrans – Narudžba vozila</title>
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
            <h2>Narudžba vozila</h2>
        </article>
        <div class="user_form">
        <?php
        if(!isset($_POST['order_btn']))
        {
            ?>
            <form method="post" action="order.php">
                <div class="form-group">
                    <?php echo $_GET["id_vehicle"];?>
                </div>
                <div class="form-group">
                    <label for="departure_date">Nadnevak polaska</label>
                    <input type="date" class="form-control" id="departure_date" name="departure_date" placeholder="Unesite nadnevak polaska">
                </div>
                <div class="form-group">
                    <label for="departure_place">Mjesto polaska</label>
                    <input type="text" class="form-control" id="departure_place" name="departure_place" placeholder="Unesite mjesto polaska">
                </div>
                <div class="form-group">
                    <label for="arrival_date">Nadnevak dolaska</label>
                    <input type="date" class="form-control" id="arrival_date" name="arrival_date" placeholder="Unesite nadnevak dolaska">
                </div>
                <div class="form-group">
                    <label for="arrival_place">Mjesto dolaska</label>
                    <input type="text" class="form-control" id="arrival_place" name="arrival_place" placeholder="Unesite mjesto dolaska">
                </div>
                <div class="form-group">
                    <label for="order_info">Dodatne informacije o prijevozu</label>
                    <input type="text" class="form-control" id="order_info" name="order_info" placeholder="Unesite dodatne informacije o prijevozu">
                </div>
                <input type="hidden" name="id_vehicle" value="<?php echo $_GET["id_vehicle"]; ?>">
                <button type="submit" class="btn btn-warning" name="order_btn">Naruči</button>
            </form>
            <?php
        }
        else{
            $dbservername = "localhost";
            $dbusername   = "root";
            $dbpassword   = "";
            $dbname   = "itrans";
            
            $db = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
            
            if($db->connect_error) {   
                die("Error: " . $db->connect_error);
            }
            $id_vehicle = $_POST['id_vehicle'] ?? '';
            $departure_date=$_POST['departure_date'] ?? '';
            $departure_place=$_POST['departure_place'] ?? '';
            $arrival_date=$_POST['arrival_date'] ?? '';
            $arrival_place=$_POST['arrival_place'] ?? '';
            $order_info=$_POST['order_info'] ?? '';
            $id_user=$_SESSION['user']['id_user'];
            $sql_form = "INSERT INTO orders(id_vehicle, departure_date, departure_place, arrival_date, arrival_place, order_info, id_user)
                VALUES('$id_vehicle', '$departure_date', '$departure_place', '$arrival_date', '$arrival_place', '$order_info', '$id_user')";
            if (mysqli_query($db, $sql_form))
            {
                header('location: vehicles.php');
            } 
            else
            {
                echo "Error: " . $sql_form . "" . mysqli_error($db);
            }
        }
        ?>
        <div/>

    </main>

    <footer class="jumbotron text-center bg-light" style="margin-bottom:0">
        <p>&copy 2020 ivan.ivkovic@etfos.hr</p>
    </footer>
</body>

</html>