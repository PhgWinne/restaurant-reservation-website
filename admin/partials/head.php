<?php 
    include('../config/constants.php'); 
    include('login-check.php');
 ?>


<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- Menu Section Starts -->
        <div class="menu">
            <div class="logo">Gau's Vilgae</div>
                <ul class="dropdown">
                    <li><a href="index.php">Dashboard</a></li>

                    <li>
                        <a href="#">Reservation</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo $siteurl; ?>admin/manage-reservation.php">Reservation</a></li>
                            <li><a href="<?php echo $siteurl; ?>admin/calendar.php">Calendar</a></li>
                            <li><a href="#">Food Order</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#">Employee</a>
                        <ul class="sub-menu">
                            <li><a href="#">Information</a></li>
                            <li><a href="manage-account.php">Account</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">Menu</a>
                        <ul class="sub-menu">
                            <li><a href="manage-category.php">Category</a></li>
                            <li><a href="manage-food.php">Food</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">Table</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo $siteurl; ?>admin/manage-type-table.php">Type Table</a></li>
                            <li><a href="manage-table.php">Table</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
        </div>