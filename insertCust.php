<?php 
session_start();
$db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 

$query = "INSERT INTO customers VALUES ('$_POST[phone]','$_POST[name]', '$_POST[password]', ' ',0)"; 

$result = pg_query($query); 

header('Location: viewInventory.php');

?>
