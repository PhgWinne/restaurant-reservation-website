<?php 
    include('partials/head.php'); 

    //Get data
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn,$sql);
        if($res == TRUE)
        {
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_img = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                $_SESSION['find_id'] = "<div class='fail'>Category not exist!</div>";
                header('location:'.$siteurl.'admin/manage-category.php');
            }
        }
    }
    else
    {
        header('location: '.$siteurl.'admin/manage-category.php');
    }
?>

<div class="main-content">
    <div class="ct-box">
        <h1>Update Category</h1>
        <br><br>

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
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            if($current_img != "")
                            {
                                ?>
                                    <img src="<?php echo $siteurl; ?>images/category/<?php echo $current_img; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='fail'>Image not Available.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "Checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name = "active" value = "Yes">Yes
                        <input <?php if($active == "No") {echo "checked";} ?> type="radio" name = "active" value = "No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update category">
                    </td>
                </tr>
            </tbale>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        //Get data
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if($title != "")
        {
            //check image
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                if($image_name != "")
                {
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if($upload == FALSE)
                    {
                        $_SESSION['upload'] = "<div class = 'fail'>Failed to Upload Image.</div>";
                        header('location:'.$siteurl.'Admin/update-category.php');
                        die();
                    }
                    if($current_img != "")
                    {
                        $path = "../images/category/".$current_img;
                        $remove = unlink($path);
                        if($remove == FALSE)
                        {
                            $_SESSION['remove-img'] = "<div calss='fali'>Failed to Remove Image.</div>";
                            header('location:'.$siteurl.'Admin/manage-category.php');
                        }
                    }
                }
                else
                {
                    $image_name = $current_img;
                }
            }
            else
            {
                $image_name = $current_img;
            }

            $sql = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            if($res == TRUE)
            {
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header('location:'.$siteurl.'Admin/manage-category.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='fail'>Failed to Update Category!</div>";
                header('location:'.$siteurl.'Admin/manage-category.php');
            }
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header('location: '.$siteurl.'admin/update-category.php');
        }
    }
?>



