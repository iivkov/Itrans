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
    <title>Itrans – Narudžbe</title>
    <!-- <link rel="stylesheet" href="../styles/style.css"> -->
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
            <h2>Narudžbe</h2>
            <p>Ovdje su ispisane tekuće narudžbe.</p>
        </article>
        <article>
        <div id="orders_table">
        <table class="table table-primary" border="1px">
                <tr><td><b>Oznaka narudžbe</b></td>
                <td><b>Nadnevak polaska</b></td>
                <td><b>Mjesto polaska</b></td>
                <td><b>Nadnevak dolaska</b></td>
                <td><b>Mjesto dolaska</b></td>
                <td><b>Podatci narudžbe</b></td>
                <td><b>Oznaka korisnika</b></td>
                <td><b>Oznaka vozila</b></td></tr>
            <?php
            $sql = "SELECT id_order, departure_date, departure_place, arrival_date, arrival_place, order_info, id_user, id_vehicle FROM orders";
            $result = $db->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>'.$row["id_order"].'</td>';
                    echo '<td>'.$row["departure_date"].'</td>';
                    echo '<td>'.$row["departure_place"].'</td>';
                    echo '<td>'.$row["arrival_date"].'</td>';
                    echo '<td>'.$row["arrival_place"].'</td>';
                    echo '<td>'.$row["order_info"].'</td>'; ?>
                    <td><input type="button" name="view_user_btn" value="<?php echo $row["id_user"]; ?>" id="<?php echo $row["id_user"]; ?>" class="btn btn-info btn-xs view_user_details" /></td>
                    <td><input type="button" name="view_vehicle_btn" value="<?php echo $row["id_vehicle"]; ?>" id="<?php echo $row["id_vehicle"]; ?>" class="btn btn-info btn-xs view_vehicle_details" /></td>
                    <td><input type="button" name="delete_order_btn" value="Obriši" id="<?php echo $row["id_order"]; ?>" class="btn btn-danger btn-xs delete_order" /></td>
                    <?php '</tr>';
                }
            }
            echo '</table>';
            ?>
            </div>
        </article>
    </main>

    <footer class="jumbotron text-center bg-light" style="margin-bottom:0">
        <p>&copy 2020 ivan.ivkovic@etfos.hr</p>
    </footer>
</body>

</html>

<div id="user_details_modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Podatci o korisniku</h4>
   </div>
   <div class="modal-body" id="user_details">
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
   </div>
  </div>
 </div>
</div>

<div id="vehicle_details_modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Podatci o vozilu</h4>
   </div>
   <div class="modal-body" id="vehicle_details">
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
   </div>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){
 $(document).on('click', '.view_user_details', function(){
  var id_user = $(this).attr("id");
  $.ajax({
   url:"../scripts/select_user_details.php",
   method:"POST",
   data:{id_user:id_user},
   success:function(data){
    $('#user_details').html(data);
    $('#user_details_modal').modal('show');
   }
  });
 });

 $(document).on('click', '.view_vehicle_details', function(){
  var id_vehicle = $(this).attr("id");
  $.ajax({
   url:"../scripts/select_vehicle_details.php",
   method:"POST",
   data:{id_vehicle:id_vehicle},
   success:function(data){
    $('#vehicle_details').html(data);
    $('#vehicle_details_modal').modal('show');
   }
  });
 });

 $(document).on('click', '.delete_order', function(){  
           var id_order=$(this).attr("id");  
           if(confirm("Sigurno želite obrisati narudžbu " + id_order +"?"))  
           {  
                $.ajax({  
                     url:"../scripts/delete_order.php",  
                     method:"POST",  
                     data:{id_order:id_order},  
                     success:function(data){  
                              $('#orders_table').html(data); 
                     }  
                });  
           }  
      });  

});  
 </script>