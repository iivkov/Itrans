<?php
include('connect.php');
if(isset($_POST["id_user"]))
{
 $output = '';
 $query = "SELECT * FROM users WHERE id_user = '".$_POST["id_user"]."'";
 $result = mysqli_query($db, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="40%"><label>Oznaka korisnika</label></td>  
            <td width="60%">'.$row["id_user"].'</td>  
        </tr>
        <tr>  
            <td><label>Ime</label></td>  
            <td>'.$row["user_name"].'</td>  
        </tr>
        <tr>  
            <td><label>Prezime</label></td>  
            <td>'.$row["user_surname"].'</td>  
        </tr>
        <tr>  
            <td><label>OIB</label></td>  
            <td>'.$row["user_personal_number"].'</td>  
        </tr>
        <tr>  
            <td><label>Adresa</label></td>  
            <td>'.$row["user_address"].'<br>'.$row["user_postal_code"].' '.$row["user_town"].'<br>'.$row["user_country"].'</td>  
        </tr>
        <tr>  
            <td><label>Telefon</label></td>  
            <td>'.$row["user_telephone"].'</td>  
        </tr>
        <tr>  
            <td><label>E-pošta</label></td>  
            <td>'.$row["email"].'</td>  
        </tr>
        <tr>  
            <td><label>Vrsta korisnika</label></td>  
            <td>'.$row["user_type"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>