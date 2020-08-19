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
    <title>Itrans – Korisnici</title>
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
            <h2>Korisnici</h2>
            <p>Ovdje su ispisani svi registrirani korisnici.</p>
        </article>
        <article>
        <div id="users_table">
            <table class="table table-primary" border="1px">
                <tr><td><b>Oznaka korisnika</b></td>
                <td><b>E-pošta</b></td>
                <td><b>Ime</b></td>
                <td><b>Prezime</b></td>
                <td><b>OIB</b></td>
                <td><b>Telefon</b></td>
                <td><b>Adresa</b></td>
                <td><b>Poštanski broj</b></td>
                <td><b>Mjesto</b></td>
                <td><b>Država</b></td>
                <td><b>Vrsta korisnika</b></td></tr>
                <?php
                $sql = "SELECT * FROM users";
                $result = $db->query($sql);
            
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr><td>'.$row["id_user"].'</td>';
                        echo '<td>'.$row["email"].'</td>';
                        echo '<td>'.$row["user_name"].'</td>';
                        echo '<td>'.$row["user_surname"].'</td>';
                        echo '<td>'.$row["user_personal_number"].'</td>';
                        echo '<td>'.$row["user_telephone"].'</td>';
                        echo '<td>'.$row["user_address"].'</td>';
                        echo '<td>'.$row["user_postal_code"].'</td>';
                        echo '<td>'.$row["user_town"].'</td>';
                        echo '<td>'.$row["user_country"].'</td>';
                        echo '<td>'.$row["user_type"].'</td>'; ?>
                        <td><input type="button" name="edit_user_btn" value="Uredi" id="<?php echo $row["id_user"]; ?>" class="btn btn-info btn-xs edit_user" /></td>
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

<div id="edit_user_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">
                     <h4 class="modal-title">Uređivanje podataka o korisniku</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="edit_user_form">  
                          <label>E-mail</label>  
                          <input type="email" name="email" id="email" class="form-control" readonly/>  
                          <br />  
                          <label>Ime</label>  
                          <input type="text" name="user_name" id="user_name" class="form-control" readonly/>  
                          <br />  
                          <label>Prezime</label>  
                          <input type="text" name="user_surname" id="user_surname" class="form-control" readonly/>  
                          <br />  
                          <label>OIB</label>  
                          <input type="text" name="user_personal_number" id="user_personal_number" class="form-control" readonly/>  
                          <br />  
                          <label>Telefon</label>  
                          <input type="tel" name="user_telephone" id="user_telephone" class="form-control" readonly/>  
                          <br />  
                          <label>Adresa</label>  
                          <input type="text" name="user_address" id="user_address" class="form-control" readonly/>  
                          <br />  
                          <label>Poštanski broj</label>  
                          <input type="text" name="user_postal_code" id="user_postal_code" class="form-control" readonly/>  
                          <br />  
                          <label>Mjesto</label>  
                          <input type="text" name="user_town" id="user_town" class="form-control" readonly/>  
                          <br />  
                          <label>Država</label>  
                          <input type="text" name="user_country" id="user_country" class="form-control" readonly/>  
                          <br />  
                          <label>Vrsta korisnika</label>  
                          <select name="user_type" id="user_type" class="form-control">  
                               <option value="customer">customer</option>  
                               <option value="admin">admin</option>  
                          </select>  
                          <br />  
                          <input type="hidden" name="id_user" id="id_user" />    
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    <input type="submit" name="insert_btn" id="insert_btn" value="Spremi" class="btn btn-success" />  
                </div>  
               </form>  
           </div>  
      </div>  
 </div>  
 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_user', function(){  
           var id_user = $(this).attr("id");  
           $.ajax({  
                url:"../scripts/fetch_user.php",
                method:"POST",  
                data:{id_user:id_user},  
                dataType:"json",  
                success:function(data){  
                    $('#id_user').val(data.id_user); 
                    $('#email').val(data.email);
                    $('#user_name').val(data.user_name);  
                    $('#user_surname').val(data.user_surname);
                    $('#user_personal_number').val(data.user_personal_number);
                    $('#user_telephone').val(data.user_telephone);
                    $('#user_address').val(data.user_address); 
                    $('#user_postal_code').val(data.user_postal_code); 
                    $('#user_town').val(data.user_town);
                    $('#user_country').val(data.user_country);
                    $('#user_type').val(data.user_type); 
                    $('#edit_user_modal').modal('show');  
                }  
           });  
      });  
      $('#edit_user_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#email').val() == "")  
           {  
                alert("Potrebno je unijeti e-poštu.");  
           }  
           else if($('#user_name').val() == "")  
           {  
                alert("Potrebno je unijeti ime.");  
           }  
           else if($('#user_surname').val() == "")  
           {  
                alert("Potrebno je unijeti prezime.");  
           }  
           else if($('#user_personal_number').val() == "")  
           {  
                alert("Potrebno je unijeti OIB.");  
           }  
           else if($('#user_telephone').val() == "")  
           {  
                alert("Potrebno je unijeti telefon.");  
           }  
           else if($('#user_address').val() == '')  
           {  
                alert("Address is required");  
           }  
           else if($('#user_postal_code').val() == "")  
           {  
                alert("Potrebno je unijeti poštanski broj.");  
           }  
           else if($('#user_town').val() == "")  
           {  
                alert("Potrebno je unijeti mjesto.");  
           }  
           else if($('#user_country').val() == "")  
           {  
                alert("Potrebno je unijeti državu.");  
           }  
           else  
           {  
                $.ajax({  
                     url:"../scripts/edit_user.php",
                     method:"POST",  
                     data:$('#edit_user_form').serialize(),  
                     success:function(data){  
                          $('#edit_user_form')[0].reset();  
                          $('#edit_user_modal').modal('hide');  
                          $('#users_table').html(data);  
                     }  
                });  
           }  
      });  
 });  
 </script>