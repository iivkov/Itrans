<?php
    $dbservername = "localhost";
    $dbusername   = "root";
    $dbpassword   = "";
    $dbname   = "itrans";

    $db = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    
    if($db->connect_error) {   
        die("Error: " . $db->connect_error);
    }
?>