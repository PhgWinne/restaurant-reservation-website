<?php

include('../config/constants.php');

//Destroy the session
session_destroy();

//Redirect to Login Page
header('location:'.$siteurl.'Admin/login.php');

?>