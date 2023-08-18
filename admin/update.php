<?php include('partials/head.php'); ?>

<?php
    ob_start();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_food WHERE id='$id'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
    else
    {
        header('location:'.$siteurl.'Admin/manage-food.php');
    }
    
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value = "<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Current img: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                    <img src="<?php echo $siteurl; ?>/images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count = mysqli_num_rows($res2);
                                
                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res2))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>
                                        <option <?php if($current_category == $category_id) {echo "selected";} ?> value="<?php echo "$category_id"; ?>"><?php echo "$category_title"; ?></option>
                                       <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>No Category</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>New img: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name = "featured" value = "Yes">Yes
                        <input <?php if($featured == "No") {echo "checked";} ?> type="radio" name = "featured" value = "No">No
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
                        <input type="submit" name="submit" value ="Update Category" class="btn-primary">
                    </td> 
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //Get the value from category form
                $id = $_GET['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
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
                        $image_info = explode('.', $image_name);
                        $ext = end($image_info);    
                        //Rename
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        //Finally Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //If the image not uploaded then we will stop the process
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                            header('location:'.$siteurl.'Admin/manage-food.php');
                            //Stop the process
                            die();
                        }
                        if($current_image != "")
                        {
                            $path = "../images/food/".$current_image;
                            $remove = unlink($path);
                            if($remove == false)
                            {
                                $_SESSION['remove'] = "<div calss='error'>Failed to Remove Image.</div>";
                                header('location:'.$siteurl.'Admin/manage-food.php');
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }         
                }
                else
                {
                    $image_name = $current_image;
                }

                //Create SQL Query to Update Category into Database
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id = $id;
                ";
                //Execute the Query and Save in Database
                $res3 = mysqli_query($conn, $sql3);
                if($res3 == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    header('location:'.$siteurl.'Admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                    header('location:'.$siteurl.'Admin/add-food.php');
                }    
            }
            ob_end_flush(); 
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<!-- wq -->