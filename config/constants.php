<?php
    //Start Session
    session_start();

    //Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="restaurant";
    $siteurl = "http://localhost:89/restaurant/";

    $conn = mysqli_connect($servername, $username, $password,$dbname);
    mysqli_set_charset($conn , 'UTF8');
?>
