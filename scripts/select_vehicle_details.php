<?php  
//select.php  
include('connect.php');
if(isset($_POST["id_vehicle"]))
{
 $output = '';
 $query = "SELECT * FROM vehicles WHERE id_vehicle = '".$_POST["id_vehicle"]."'";
 $result = mysqli_query($db, $query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
     <tr>  
            <td width="30%"><label>Registracijska oznaka</label></td>  
            <td width="70%">'.$row["id_vehicle"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Tip</label></td>  
            <td width="70%">'.$row["type"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Nadogradnja</label></td>  
            <td width="70%">'.$row["set_up"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Duljina [m]</label></td>  
            <td width="70%">'.$row["length"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Širina [m]</label></td>  
            <td width="70%">'.$row["width"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Visina [m]</label></td>  
            <td width="70%">'.$row["height"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>Nosivost [t]</label></td>  
            <td width="70%">'.$row["capacity"].'</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>