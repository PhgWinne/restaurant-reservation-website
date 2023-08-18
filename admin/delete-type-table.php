<?php
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_type_table WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        $_SESSION['delete'] = "<div class='success'>Type Table Deleted Successfully!</div>";
        header('location:'.$siteurl.'admin/manage-type-table.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='fail'>Failed to Delete Type Table!</div>";
        header('location:'.$siteurl.'admin/manage-type-table.php');
    }
?>