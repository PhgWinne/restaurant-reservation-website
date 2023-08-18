<?php include('partials/head.php'); ?>

<div class="main-content">
    <div class="ct-box">
        <h1>Change password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>
        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" name="current_pwd" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New password: </td>
                    <td>
                        <input type="password" name="new_pwd" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password: </td>
                    <td>
                        <input type="password" name="confirm_pwd" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-scd">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $current_pwd = md5($_POST['current_pwd']);
        $new_pwd = md5($_POST['new_pwd']);
        $confirm_pwd = md5($_POST['confirm_pwd']);

        if($current_pwd != "" AND $new_pwd != "" AND $confirm_pwd != "")
        {
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pwd'";
            $res = mysqli_query($conn, $sql);

            if($res == true)
            {
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    if($new_pwd == $confirm_pwd)
                    {
                        $sql2 = "UPDATE tbl_admin SET password='$new_pwd' WHERE id=$id";
                        $res2 = mysqli_query($conn, $sql2);
                        
                        if($res == true)
                        {
                            $_SESSION['change_pwd'] = "<div class='success'>Password Changed Successfully!</div>";
                            header('location:'.$siteurl.'admin/manage-account.php');
                        }
                        else
                        {
                            $_SESSION['change_pwd'] = "<div class='fail'>Failed to Change Password!</div>";
                            header('location:'.$siteurl.'admin/manage-account.php');
                        }
                    }
                }
                else
                {
                    $_SESSION['change_pwd'] = "<div class='fail'>Failed to Change Password!</div>";
                    header('location:'.$siteurl.'admin/manage-account.php');
                }
            }
        }
        else
        {
            $_SESSION['change_pwd'] = "<div class='fail'>Failed to Change Password!</div>";
            header('location:'.$siteurl.'admin/manage-account.php');
        }
    }
?>