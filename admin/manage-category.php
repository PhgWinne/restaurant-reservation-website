<?php include('partials/head.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="ct-box">
                <h1>Manage Category</h1>
                <br>
                <br>
                <a href="add-category.php" class="btn-prm">Add category</a>
                <br><br>
                <?php

                    if(isset($_SESSION['find']))
                    {
                        echo $_SESSION['find'];
                        unset($_SESSION['find']);
                    }

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

                    if(isset($_SESSION['remove-img']))
                    {
                        echo $_SESSION['remove-img'];
                        unset($_SESSION['remove-img']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>ID:</th>
                        <th>Title:</th>
                        <th>Image name:</th>
                        <th>Featured:</th>
                        <th>Active:</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                    ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                            if($image_name != "")
                                            {
                                        ?>
                                                <img src="<?php echo $siteurl; ?>images/category/<?php echo $image_name; ?>" width="150px">        
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
                                        <a href="<?php echo $siteurl; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-scd">Update category</a>
                                        <a href="<?php echo $siteurl; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-scd">Delete category</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                        else
                        {
                    ?>
                            <tr>
                                <td class="fail" colspan="6">No Category Added.</td>
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