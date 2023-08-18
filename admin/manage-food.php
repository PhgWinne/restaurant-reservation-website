<?php include('partials/head.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="ct-box">
                <h1>Manage Food</h1>
                <br>
                <a href="<?php echo $siteurl; ?>admin/add-food.php" class="btn-prm">Add food</a>
                <br><br><br>
                
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['find']))
                {
                    echo $_SESSION['find'];
                    unset($_SESSION['find']);
                }

                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_food";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                    ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                    <?php
                                        if($image_name != "")
                                        {
                                    ?>
                                            <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name; ?>" Width="150px">
                                    <?php
                                        }
                                        else
                                        {
                                            echo "<div class='fail'>Image not Added.</div>";
                                        }
                                    ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo $siteurl; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-scd">Update food</a>
                                        <a href="<?php echo $siteurl; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-scd">Delete food</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                        else
                        {
                    ?>
                            <tr>
                                <td class="fail" colspan="6">No Food Added.</td>
                            </tr>
                    <?php
                        }
                    ?>

                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>