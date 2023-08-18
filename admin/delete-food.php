<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Delete image from file
        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['remove-img'] = "<div class='fail'>Failed to Remove Image!</div>";
                header('location: '.$siteurl.'admin/manage-food.php');
                die();
            }
        }
        //Delete from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE)
        {
            $_SESSION['delete'] = "<div class=success>Food Deleted Successfully!</div>";
            header('location: '.$siteurl.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='fail'>Failed to Delete Food!</div>";
            header('location: '.$siteurl.'admin/manage-food.php');
        }
    }
    else
    {
        $_SESSION['delete'] = "<div class='fail'>Failed to Delete Food!</div>";
        header('location: '.$siteurl.'admin/manage-food.php');
    }
?>