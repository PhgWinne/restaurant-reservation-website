<?php include("config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gau's Village</title>
        
        <!-- fontawesome link here -->
        <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
        
        <!-- style link here -->
        <link rel="stylesheet" href="css/home.css">
        

    </head>
    <body>
        
        <header class="header">
            <div class="logo">
                <!-- <img src="images/logo.png" alt=""> -->
                <h1><a href="<?php echo $siteurl; ?>">Gau's Village</a></h1>
            </div>

            <nav class="navbar">
                <a href="<?php echo $siteurl; ?>">Home</a>
                <a href="#about">About</a>
                <a href="<?php echo $siteurl; ?>menu.php">Menu</a>
                <a href="<?php echo $siteurl; ?>contact.php">Contact</a>
            </nav>

            <div class="icons">
                <div id="menu-bar" class="fas fa-bars"></div>
                <a class="contact-btn" href="<?php echo $siteurl; ?>reservation.php">Reservation</a>
            </div>

        </header>