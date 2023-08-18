<?php include("partials/head.php"); ?>

<div class="main-content">
    <div class="ct-box">
        <h1>Update account</h1>
        <br><br>

        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    $_SESSION['find_id'] = "<div class='faild'>Account not exist!</div>";
                    header('location:'.$siteurl.'admin/manage-account.php');
                }
            }
        ?> 

        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Usesrname: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update account" class="btn-scd">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        if($full_name != "" AND $username != "")
        {
            $sql = "UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id='$id'";
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $_SESSION['update'] = "<div class='success'>Account Updated Successfully!</div>";
                header('location:'.$siteurl.'admin/manage-account.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='fail'>Failed to Update Account!</div>";
                header('location:'.$siteurl.'admin/manage-account.php');
            }
        }
        else
        {
            $_SESSION['update'] = "<div class='fail'>Failed to Update Account!</div>";
            header('location:'.$siteurl.'admin/manage-account.php');
        }
    }
?>