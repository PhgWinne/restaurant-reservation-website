<?php include("partials/head.php"); ?>
<div class="main-content">
    <div class="ct-box">
        <h1>Add account</h1>
        <br>

        <?php
            if(isset($_SESSION['test']))
            {
                echo $_SESSION['test'];
                unset($_SESSION['test']);
            };
        ?> 
        
        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your full name">
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add account" class="btn-scd">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php include("partials/footer.php"); ?>

<?php 
     if(isset($_POST['submit'])){

        //Get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        if($full_name != "" AND $username != "" AND $_POST['password'] != "")
        {
            //SQL Query to Save the data into database
            $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
            ";

            //Excuting query and saving data into database
            $res = mysqli_query($conn, $sql);

            //Check whether the query is excuted data
            if($res == TRUE){
                echo "success";
                //Data Inserted
                $_SESSION['add'] = "<div class='success'>Account Added Successfully!</div>";
                header("location:".$siteurl.'admin/manage-account.php');
            }else{
                //Failed to Insert Data
                $_SESSION['add'] = "<div class='fail'>Failed to Add Account!</div>";
                header("location:".$siteurl.'admin/manage-account.php');
            }
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header("location:".$siteurl.'admin/add-account.php'); 
        }
        
    }
?>