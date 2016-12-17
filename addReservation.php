<?php

session_start();
error_reporting(0);
$db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 

//if they are logged in
if($_SESSION["Name"] != null){
    
    $username = $_SESSION["Name"];
    
    if (isset($_POST['addRes'])) { 
        $count = 1111;
        $affected = 0;
        while($affected < 1){
            $count++;
            $query = "INSERT INTO orders VALUES ($count,'$_POST[reservations]')";
            $result = pg_query($query);
            $affected = pg_affected_rows($result);
        }
        
        $updateResult = pg_query($db, "UPDATE customers SET reservations = concat(reservations, ', $count') WHERE name = '$username'"); 
        
    }
    header('Location: viewInventory.php');
}
else{
    header('Location: createCust.php');
}


?>