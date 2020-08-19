<?php  
 include('connect.php');
 if(!empty($_POST))  
 {  
      $output = '';  
      $email = mysqli_real_escape_string($db, $_POST["email"]);  
      $user_name = mysqli_real_escape_string($db, $_POST["user_name"]);
      $user_surname = mysqli_real_escape_string($db, $_POST["user_surname"]);  
      $user_personal_number = mysqli_real_escape_string($db, $_POST["user_personal_number"]);    
      $user_telephone = mysqli_real_escape_string($db, $_POST["user_telephone"]);  
      $user_address = mysqli_real_escape_string($db, $_POST["user_address"]);  
      $user_postal_code = mysqli_real_escape_string($db, $_POST["user_postal_code"]); 
      $user_town = mysqli_real_escape_string($db, $_POST["user_town"]);   
      $user_country = mysqli_real_escape_string($db, $_POST["user_country"]);  
      $user_type = mysqli_real_escape_string($db, $_POST["user_type"]);  
      if($_POST["id_user"] != '')  
      {  
           $query = "  
           UPDATE users   
           SET email='$email',
           user_name='$user_name',   
           user_surname='$user_surname',
           user_personal_number='$user_personal_number',
           user_telephone='$user_telephone',
           user_address='$user_address',
           user_postal_code='$user_postal_code',   
           user_town='$user_town',
           user_country='$user_country',
           user_type='$user_type'  
           WHERE id_user='".$_POST["id_user"]."'";    
      }  
      if(mysqli_query($db, $query))  
      {    
           $select_query = "SELECT * FROM users";  
           $result = mysqli_query($db, $select_query);  
           $output .= '  
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
                     ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>
                          <td>' . $row["id_user"] . '</td>
                          <td>' . $row["email"] . '</td>
                          <td>' . $row["user_name"] . '</td>
                          <td>' . $row["user_surname"] . '</td> 
                          <td>' . $row["user_personal_number"] . '</td>
                          <td>' . $row["user_telephone"] . '</td>  
                          <td>' . $row["user_address"] . '</td>  
                          <td>' . $row["user_postal_code"] . '</td> 
                          <td>' . $row["user_town"] . '</td>  
                          <td>' . $row["user_country"] . '</td>        
                          <td>' . $row["user_type"] . '</td>  
                          <td><input type="button" name="edit_user_btn" value="Uredi" id="'.$row["id_user"] .'" class="btn btn-info btn-xs edit_user" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>