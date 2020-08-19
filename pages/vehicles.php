<?php include('../scripts/functions.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itrans – Vozila</title>
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
            <h2>Vozila</h2>
            <p>Ovdje su ispisana naša vozila koja možete naručiti. 
                Podsjećamo da je za naručivanje vozila potrebno biti registriran i prijavljen.</p>
        </article>
        <div class="table-responsive">
       <?php if(isAdmin())
             { ?>
                <div align="left">
                    <button type="button" name="add_btn" id="add_btn" data-toggle="modal" data-target="#add_vehicle_modal" class="btn btn-warning">Dodaj</button>
                </div>
                <?php  } 
            ?>
        <br />
        <div id="vehicles_table">
        <table class="table table-primary" border="1px">
                <tr><td><b>Reg. oznaka</b></td>
                <td><b>Tip</b></td>
                <td><b>Nadogradnja</b></td>
                <td><b>Duljina [m]</b></td>
                <td><b>Širina [m]</b></td>
                <td><b>Visina [m]</b></td>
                <td><b>Nosivost [t]</b></td></tr>
            <?php
            $query = "SELECT id_vehicle, type, set_up, length, width, height, capacity FROM vehicles";
            $result = mysqli_query($db, $query);
            
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_assoc($result)) { 
                    echo '<tr><td>'.$row["id_vehicle"].'</td>';
                    echo '<td>'.$row["type"].'</td>';
                    echo '<td>'.$row["set_up"].'</td>';
                    echo '<td>'.$row["length"].'</td>';
                    echo '<td>'.$row["width"].'</td>';
                    echo '<td>'.$row["height"].'</td>';
                    echo '<td>'.$row["capacity"].'</td>';
                    echo '<td><a class="btn btn-info btn-xs" href="order.php?id_vehicle='.$row["id_vehicle"].'">Naruči</a></td>';
                    if(isAdmin())
                     { ?>
                        <td><input type="button" name="delete_vehicle_btn" value="Obriši" id="<?php echo $row["id_vehicle"]; ?>" class="btn btn-danger btn-xs delete_vehicle" /></td>
                        <?php  } 
                    '</tr>';
                }
            }
            echo '</table>';
            ?>
        </div>
        </div>

    </main>

    <footer class="jumbotron text-center bg-light" style="margin-bottom:0">
        <p>&copy 2020 ivan.ivkovic@etfos.hr</p>
    </footer>
</body>

</html>

<div id="add_vehicle_modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Dodavanje vozila</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Registracijska oznaka</label>
     <input type="text" name="id_vehicle" id="id_vehicle" placeholder="Unesite registracijsku oznaku" class="form-control" />
     <br />
     <label>Tip</label>
     <select name="type" id="type" class="form-control">
      <option value="poluprikolica">poluprikolica</option>  
      <option value="solo">solo</option>
     </select>
     <br />
     <label>Nadogradnja</label>
     <select name="set_up" id="set_up" class="form-control">
      <option value="otvorena">otvorena</option>  
      <option value="cerada">cerada</option>
      <option value="hladnjača">hladnjača</option>  
      <option value="furgon">furgon</option>
     </select>
     <br />
     <label>Duljina (u metrima)</label>
     <input type="number" step="0.01" name="length" id="length" placeholder="Unesite duljinu" class="form-control" />
     <br />
     <label>Širina (u metrima)</label>
     <input type="number" step="0.01" name="width" id="width" placeholder="Unesite širinu" class="form-control" />
     <br />
     <label>Visina (u metrima)</label>
     <input type="number" step="0.01" name="height" id="height" placeholder="Unesite visinu" class="form-control" />
     <br />
     <label>Nosivost (u tonama)</label>
     <input type="number" name="capacity" id="capacity" placeholder="Unesite nosivost" class="form-control" />
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        <input type="submit" name="insert_btn" id="insert_btn" value="Dodaj" class="btn btn-success" />
     </div>
    </form>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#id_vehicle').val() == "")
  {  
   alert("Potrebno je unijeti registracijsku oznaku vozila.");  
  }  
  else if($('#type').val() == '')  
  {  
   alert("Potrebno je unijeti tip vozila.");  
  }  
  else if($('#set_up').val() == '')
  {  
   alert("Potrebno je unijeti nadogradnju vozila.");  
  }
  else if($('#length').val() == '')  
  {  
   alert("Potrebno je unijeti duljinu vozila.");  
  }  
  else if($('#width').val() == '')
  {  
   alert("Potrebno je unijeti širinu vozila.");  
  }
  else if($('#height').val() == '')  
  {  
   alert("Potrebno je unijeti visinu vozila.");  
  }  
  else if($('#capacity').val() == '')
  {  
   alert("Potrebno je unijeti nosivost vozila.");  
  }
  else  
  {  
   $.ajax({  
    url:"../scripts/add_vehicle.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),
    success:function(data){  
     $('#insert_form')[0].reset();
     $('#add_vehicle_modal').modal('hide');
     $('#vehicles_table').html(data);
    }  
   });  
  }  
 });

$(document).on('click', '.delete_vehicle', function(){  
           var id_vehicle=$(this).attr("id");  
           if(confirm("Sigurno želite obrisati vozilo " + id_vehicle +"?"))  
           {  
                $.ajax({  
                     url:"../scripts/delete_vehicle.php",  
                     method:"POST",  
                     data:{id_vehicle:id_vehicle},  
                     success:function(data){  
                              $('#vehicles_table').html(data); 
                     }  
                });  
           }  
      });  

});  
 </script>