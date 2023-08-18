<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Manage System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br> <br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['p-nlogin']))
                {
                    echo $_SESSION['no-login'];
                    unset ($_SESSION['no-login']);
                }
            ?>

            <!-- Login Form Start -->
            <form action="" method="POST" class="text-center">
                <h3>Username</h3> <br>
                <input type="text" name="username" placeholder="Enter Username"> <br> <br>
                <h3>Password</h3> <br>
                <input type="password" name="password" placeholder="Enter Password"> <br> <br>
                <input type="submit" name="submit" value="Login" class="btn-prm">
            </form>
            <!-- Login Form End -->

        </div>

    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        //Process For Login
        //Get The Data From Login Form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //SQL to check whether the user with username and password exist oor not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
            $_SESSION['user'] = $username; //To check whether user is logged in or not and logout will unset it

            header('location:'.$siteurl.'Admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
            header('location:'.$siteurl.'Admin/login.php');
        }
    }

?>