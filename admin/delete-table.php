<?php
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_table WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        $_SESSION['delete'] = "<div class='success'>Table Deleted Successfully!</div>";
        header('location:'.$siteurl.'admin/manage-table.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='fail'>Failed to Delete Table!</div>";
            header('location:'.$siteurl.'admin/manage-table.php');
    }
?>