<?php
    include('connect.php');
    if(isset($_POST["id_order"]))
{
 $output = '';
 $query = "DELETE FROM orders WHERE id_order = '".$_POST["id_order"]."'";
 if(mysqli_query($db, $query))
    {
     $select_query = "SELECT * FROM orders";
     $result = mysqli_query($db, $select_query);
     $output .= '
     <table class="table table-primary" border="1px">
                <tr><td><b>Oznaka narudžbe</b></td>
                <td><b>Nadnevak polaska</b></td>
                <td><b>Mjesto polaska</b></td>
                <td><b>Nadnevak dolaska</b></td>
                <td><b>Mjesto dolaska</b></td>
                <td><b>Podatci narudžbe</b></td>
                <td><b>Oznaka korisnika</b></td>
                <td><b>Oznaka vozila</b></td></tr>
     ';
     while($row = mysqli_fetch_array($result))
     {
      $output .= '
      <tr>
      <td>' . $row["id_order"] . '</td>
      <td>' . $row["departure_date"] . '</td>
      <td>' . $row["departure_place"] . '</td>
      <td>' . $row["arrival_date"] . '</td>
      <td>' . $row["arrival_place"] . '</td>
      <td>' . $row["order_info"] . '</td>
      <td><input type="button" name="view_user_btn" value="' . $row["id_user"] . '" id="' . $row["id_user"] . '" class="btn btn-info btn-xs view_user_details" /></td>
      <td><input type="button" name="view_vehicle_btn" value="' . $row["id_vehicle"] . '" id="' . $row["id_vehicle"] . '" class="btn btn-info btn-xs view_vehicle_details" /></td>
      <td><input type="button" name="delete_btn" value="Obriši" id="' . $row["id_order"] . '" class="btn btn-danger btn-xs delete_order" /></td>
      </tr>
      ';
     }
     $output .= '</table>';
    }
    echo $output;
}
?>