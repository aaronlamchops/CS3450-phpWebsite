<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php 
    
    $db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 
    
    $loginname = $_POST['loginname'];
    $loginpassword = $_POST['loginpassword'];
    
    $result = pg_query($db, "SELECT * FROM customers WHERE name = '$loginname' AND password = '$loginpassword'");
    $row = pg_fetch_assoc($result); 
    if (isset($_POST['login'])) { 
            
        if (!$result) { 
            echo "Login failed!!"; 
        } 
        else { 
            $_SESSION["Phone"] = $row['phonenumber'];
            $_SESSION["Name"] = $row['name'];
            $_SESSION["Password"] = $row['password'];
            $_SESSION["Reservations"] = $row['reservations'];
            $_SESSION["Points"] = $row['points'];
            header('Location: viewInventory.php');
        } 
        
    }

?>
</body>
</html>