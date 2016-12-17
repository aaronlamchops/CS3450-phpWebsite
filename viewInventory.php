<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html> 
<html>
<head>
    <title>Mr.Smith's Groceries</title> <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head> 
<body> 
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Mr.Smith's Groceries</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">All Inventory</a></li>
                <li><a href="manage.php">Manage Reservations</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#logoutModal">
                    
                    <?php
                        error_reporting(0);
                        if($_SESSION["Name"] != null && $_SESSION["Password"] != null){
                            // Echo session variables that were set on previous page
                            echo "Welcome ";
                            echo "" . $_SESSION["Name"] . "!<br>";
                            //echo "Password " . $_SESSION["Password"] . "";
                        }
                        else{
                            echo "";
                        }
                    ?>
                    
                    </a>
                </li>
                <li><a href="createCust.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Modal -->
    <div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- LOGIN MODAL content----------------------------------------------------->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter Information</h4>
            </div>
            <div class="modal-body">
                    <ul> 
                        <div class="form-group">
                            <form name="loginform" action="login.php" method="POST" >
                                <div class="form-group">
                                    <label>Name: </label><input style="margin-left: 83px;" type="text" name="loginname" placeholder="Enter Name"/>
                                </div>
                                <div class="form-group">
                                    <label>Password: </label><input style="margin-left: 54px;" type="password" name="loginpassword" placeholder="Enter Password"/>
                                </div><input type="submit" name="login" class="btn btn-sm btn-success" value="Login"/>
                            </form>
                        </div>
                    </ul> 
                <!--<p>Some text in the modal.</p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
    </div>
    <!--END of Modal----------------------------------------------------------------->
    
    <!-- LOGOUT modal --------------------------------------------------------------->
    <div id="logoutModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Logout?</h3>
            </div>
            <div class="modal-body" style="margin-left:45px;">
                <div class="container">
                    <a href="logout.php" class="btn btn-danger btn-lg" role="button" >Yes</a>
                    <a href="viewInventory.php" class="btn btn-danger btn-lg" role="button" style="margin-left:20px;">No</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
    </div>
    <!--END of Modal-->
    
    
    <div class="container">
        <div class ="well well-sm header text-center">
            <h2>View the entire inventory!</h2>
        </div>
    </div>
    
    <ul> 
        <div class="form-group">
            <h2>Search Product:</h2> 
            <form name="display" action="search.php" method="POST" > 
            <label for="sku">Product: </label>
            <input type="text" name="sku" placeholder="Name" id="myInput" onkeyup="myFunction()"/>
            <input type="submit" name="submit" value='Search' class="btn btn-success btn-sm" />
        </form> 
        </div>
    </ul> 
    
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("allInv");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } 
                    else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
    
    <hr>
    
    <!-- Below is displaying the whole inventory -->
    <?php 

    $db = pg_connect("host=vowoodhome.asuscomm.com port=5454 dbname=test user=postgres password=toothpaste"); 
    $result = pg_query($db, "SELECT * FROM inventory"); 
        echo "<table style='margin-left: 10px;' id='allInv' class='table table-hover dataTable' >";
    
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
        echo "<div class='btn-toolbar'>";
        echo "<button style='margin-left: 20px;' id='add' class='btn btn-success btn-md'>Add</button>";
        echo "</div>";
        echo "<hr>";
        echo "<form name='resrvation' action='addReservation.php' method='POST' >";
        echo "<label for='toAdd'>Added so far: </label>";
        echo "<input class='addedSoFar' type='text' name='reservations' style='margin-left: 10px;'/>";
        echo "<input type='submit' value='Submit' name='addRes' class='btn btn-success btn-sm' style='margin-left: 7px;'/>";
    ?>
        
    
    <script>
        /*
        $("#allInv tr").click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');    
            var value=$(this).find('td:first').html();    
        });
        */
        
        $('tr').click(function() {
            $('.selected').removeClass('selected');
            $(this).addClass('selected');
        });
        /*
        $('.ok').on('click', function(e){
            alert($("#allInv tr.selected td:first").html());
        });
        */
        $('#add').click(function() { 
            $(this).addClass('selected');
            //alert($("tr.selected td:first").html());
            //$("h3").append($("tr.selected td:first").html() + ", ");
            $('.addedSoFar').val($('.addedSoFar').val() + $("tr.selected td:first").html() + ", ");
        });
        
    </script>
    
</body> 
</html>
