<?php include('partials/head.php'); 
ob_start();
?>
<div class="main-content">
    <div class="ct-box">
        <h1>Add Food</h1>
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
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                if($res == TRUE)
                                {
                                    $count = mysqli_num_rows($res);
                                    if($count > 0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-prm">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if($title != "" AND $description != "" AND $price != "")
        {
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

            //Image
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name != "")
                {
                    $img_infor = explode('.', $image_name);
                    $ext = end($img_infor);
                    $image_name = "Food_".rand(000,999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == FALSE)
                    {
                        $_SESSION['upload'] = "<div class = 'fail'>Failed to Upload Image.</div>";
                        header('location:'.$siteurl.'admin/add-food.php');
                        //Stop the process
                        die();
                    }
                }
                else
                {
                    $image_name = "";
                }

                //Query
                $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active'";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == TRUE)
                {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully?</div>";
                    header('location:'.$siteurl.'Admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='fail'>Failed to Add Food!</div>";
                    header('location:'.$siteurl.'Admin/manage-food.php');
                }
            }
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header("location:".$siteurl.'admin/add-food.php'); 
        }
    }
    ob_end_flush();
?>