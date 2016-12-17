<?php

session_start();
$username = $_SESSION["Name"];

$db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 

if(isset($_POST['updateCustSubmit'])){
    $result = pg_query($db, 
                   "UPDATE customers SET name = '$_POST[updateName]', 
                                    phonenumber = $_POST[updatePhone], 
                                    reservations = '$_POST[updateRes]'
                                    WHERE name = '$username'
                                    "
                  );
}
if (!$result) { 
    header('Location: manage.php'); 
} 
else { 
    header('Location: viewInventory.php'); 
}

?>