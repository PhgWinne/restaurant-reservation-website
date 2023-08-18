<?php 

    //Authorization
    //Check whether the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login'] = "<div class='error'>Please Login to access Admin panel.</div>";
        header('location:'.$siteurl.'Admin/login.php');
    }

    //wq
?>