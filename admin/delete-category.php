<?php 
    include('../config/constants.php'); 

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Delete image from file
        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove == FALSE)
            {
                $_SESSION['remove-img'] = "<div class'fail'>Fail to Reamove Image File</div>";
                header('location: '.$siteurl.'admin/manage-category.php');
                die();
            }
        }
        //Delete from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully!</div>";
            header('location: '.$siteurl.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='fail'>Failed to Delete Category!</div>";
            header('location: '.$siteurl.'admin/manage-category.php');
        }
    }
    else
    {
        $_SESSION['delete'] = "<div class='fail'>Failed to Delete Category!</div>";
        header('location: '.$siteurl.'admin/manage-category.php');
    }
?>
