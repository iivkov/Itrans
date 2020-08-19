<?php
    include('connect.php');
    if(isset($_POST["id_vehicle"]))
{
 $output = '';
 $query = "DELETE FROM vehicles WHERE id_vehicle = '".$_POST["id_vehicle"]."'";
 if(mysqli_query($db, $query))
    {
     $select_query = "SELECT * FROM vehicles";
     $result = mysqli_query($db, $select_query);
     $output .= '
     <table class="table table-primary" border="1px">
                <tr><td><b>Reg. oznaka</b></td>
                <td><b>Tip</b></td>
                <td><b>Nadogradnja</b></td>
                <td><b>Duljina [m]</b></td>
                <td><b>Širina [m]</b></td>
                <td><b>Visina [m]</b></td>
                <td><b>Nosivost [t]</b></td></tr>
     ';
     while($row = mysqli_fetch_array($result))
     {
      $output .= '
      <tr>
      <td>' . $row["id_vehicle"] . '</td>
      <td>' . $row["type"] . '</td>
      <td>' . $row["set_up"] . '</td>
      <td>' . $row["length"] . '</td>
      <td>' . $row["width"] . '</td>
      <td>' . $row["height"] . '</td>
      <td>' . $row["capacity"] . '</td>
      <td><a class="btn btn-info btn-xs" href="order.php?id_vehicle='.$row["id_vehicle"].'">Naruči</a></td>
      <td><input type="button" name="delete_vehicle_btn" value="Obriši" id="' . $row["id_vehicle"] . '" class="btn btn-danger btn-xs delete_vehicle" /></td>
      </tr>
      ';
     }
     $output .= '</table>';
    }
    echo $output;
}
?>