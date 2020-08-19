<?php
 include('connect.php');  
 if(isset($_POST["id_user"]))  
 {  
      $query = "SELECT * FROM users WHERE id_user = '".$_POST["id_user"]."'";  
      $result = mysqli_query($db, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>