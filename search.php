<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>
    <br>
    <div class="container">
        <div class ="well well-sm header text-center">
            <h2>Search Results</h2>
        </div>
    </div>
    
<?php 
    session_start();
    error_reporting(0);
    $db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 
    $result = pg_query($db, 
                       "SELECT * FROM inventory 
                       WHERE sku = '$_POST[sku]'");
//    if(pg_affected_rows($results) == 0){
//        $result = pg_query($db, 
//                       "SELECT * FROM inventory 
//                       WHERE name::text LIKE '%$_POST[sku]%'
//                       OR distributor::text LIKE '%$_POST[sku]%'
//                       ");
//    }
    
    
    //$row = pg_fetch_assoc($result); 
        if (isset($_POST['submit'])) { 
            echo "<table style='margin-left: 10px;' id='allInv' class='table table-hover dataTable'>";
    
                echo "<thead>";
                echo "<tr>";
                    echo "<th>SKU</th>";
                    echo "<th>Name</th>";
                    echo "<th>Distributor</th>";
                    echo "<th>Price</th>";
                    echo "<th>Weight</th>";
                    echo "<th>Quantity</th>";
                echo "</tr>";
            echo "</thead>";
    
            while ($row = pg_fetch_assoc($result)) { 
                echo "<tbody>";
                echo "<tr>";
                    echo "<td>". $row['sku'] . "</td>";
                    echo "<td>". $row['name'] . "</td>";
                    echo "<td>". $row['distributor'] . "</td>";
                    echo "<td>". $row['price'] . "</td>";
                    echo "<td>". $row['weight'] . "</td>";
                    echo "<td>". $row['quantity'] . "</td>";
                echo "</tr>";
                echo "</tbody>";
            } 
            echo "</table>"; 
        } 
/*
if (isset($_POST['new'])) { 
    
    $result1 = pg_query($db, "UPDATE inventory SET sku = '$_POST[sku]', name = '$_POST[name]', distributor = '$_POST[distributor]', price = '$_POST[price]', weight = '$_POST[weight]', quantity = '$_POST[quantity]' WHERE sku = '$_POST[sku]'"); 
    
    if (!$result1) { 
        echo "Update failed!!"; 
    } 
    else { 
        echo "Update successful!;"; 
    } 
} 
*/
?>

</body>
</html>