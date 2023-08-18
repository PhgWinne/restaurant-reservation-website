<?php include('partials/head.php'); ?>

<!-- SEARCH -->
<section class="food-search">
    <div class="container">
        <form action="<?php echo $siteurl; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn-prm">
        </form>
    </div>
</section>
<!-- SEARCH -->

<!-- CATEGORIES SECTION START HERE -->
    <div class="categories">
        <div class="container">
            <h1 class='label'>FOOD CATEGORIES</h1>

            <?php
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                $res=mysqli_query($conn, $sql);
                $count=mysqli_num_rows($res);

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo $siteurl; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 ">
                                <?php
                                    if($image_name == "")
                                    {
                                        echo "<<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo $siteurl; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <h2><?php echo $title; ?></h2>
                                        <?php
                                    }
                                ?>
                                
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
<!-- CATEGORIES SECTION END HERE -->

<?php include('partials/footer.php'); ?>