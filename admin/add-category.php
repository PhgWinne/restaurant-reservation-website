<?php include('partials/head.php'); 
ob_start();
?>

    <div class="main-content">
        <div class="ct-box">
            <h1>Add category</h1>
            <br>

            <?php
                if(isset($_SESSION['test']))
                {
                    echo $_SESSION['test'];
                    unset($_SESSION['test']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-50">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">

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
        $title = $_POST['title'];

        if($title != ""){
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            //Check image
            if(isset($_FILES['image']['name']))
            {
                
                //To upload image we meed image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                
                //Upload the image only if image is selected
                if($image_name != "")
                {
                    
                    //auto rename the image
                    //Get the extension of the image
                    $ext = end(explode('.',$image_name));

                    //Rename
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //Finally Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Check whether the image is uploaded or not
                    //If the image not uploaded then we will stop the process
                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class = 'fail'>Failed to Upload Image.</div>";
                        header('location:'.$siteurl.'admin/add-category.php');
                        //Stop the process
                        die();
                    }
                }
                
            }
            else
            {
                $image_name = "";
            }
            
            //Create and excute query
            $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";
                header('location: '.$siteurl.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='fail'>Failed to Add Category!</div>";
                header('location: '.$siteurl.'admin/manage-category.php');
            }
        }
        else{
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header("location:".$siteurl.'admin/add-category.php'); 
        }
    }
    ob_end_flush();
?>