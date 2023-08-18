<?php include('partials/head.php'); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        //Get the category title
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else
    {
        header("location:".$siteurl);
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
    <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="label">MENU</h2>

        <?php
            $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2 > 0)
            {
                while($row = mysqli_fetch_assoc($res2))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name == "")
                                {
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4 class='text-white'><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?>$</p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>

                            <a href="#" class="btn-scd">Add to Cart</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Food not Available.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>

</section>

<?php include('partials/footer.php'); ?>