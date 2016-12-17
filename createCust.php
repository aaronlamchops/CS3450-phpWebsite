<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Mr.Smith's Groceries</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style> 
    </style> 
</head> 
<body> 
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Mr.Smith's Groceries</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="viewInventory.php">All Inventory</a></li>
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
                <h4 class="modal-title">Modal Header</h4>
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
    <!--END of Modal-->
    
    <div class="container">
        <div class ="well well-sm header text-center">
            <h2>Create an Account on Mr.Smith's Grocery Website!</h2>
        </div>
    </div>
    
    <h3 style="margin-left: 30px;">Enter Your Information:</h3> 
    <hr>
    <ul> 
        <div class="form-group">
            <form name="insert" action="insertCust.php" method="POST" > 
                <div class="form-group">
                    <label>Phone Number: </label><input style="margin-left: 20px;" type="text" name="phone" placeholder="Enter Phone Number"/>
                </div>
                    <div class="form-group">
                    <label>Name: </label><input style="margin-left: 83px;" type="text" name="name" placeholder="Enter Name"/>
                </div>
                    <div class="form-group">
                    <label>Password: </label><input style="margin-left: 54px;" type="password" name="password" placeholder="Enter Password"/>
                </div>
                <input type="submit" value="Create" class="btn btn-sm btn-success"/>
            </form>
        </div>
    </ul> 
</body> 
</html>