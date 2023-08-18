<?php
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        $_SESSION['delete'] = "<div class='success'>Account Deleted Successfully!</div>";
        header('location:'.$siteurl.'admin/manage-account.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='fail'>Failed to Delete Account!</div>";
            header('location:'.$siteurl.'admin/manage-account.php');
    }
?>