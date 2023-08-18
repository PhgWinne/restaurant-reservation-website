<?php include('partials/head.php'); ?>

<section class="food-search">
    <div class="container">
        <?php
            $search = $_POST['search'];
        ?>
        <h2>Foods on Your Search <?php echo $search; ?></h2>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h1 class="label">Food Menu</h1>

        <?php
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res=mysqli_query($conn, $sql);
            $count=mysqli_num_rows($res);

            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
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
                echo "<div class='error'>Food not Available!</div>";
            }
        ?>
        <div class="clearfix"></div>

    </div>
</section>

<?php include('partials/footer.php'); ?>