<?php include('partials/head.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="ct-box">
        <h1>Manage Type Table</h1>
        <br>
        <a href="add-type-table.php" class="btn-prm">Add type table</a>
        <br><br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Number of Chairs</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT *  FROM tbl_type_table";
                $res = mysqli_query($conn, $sql);
                if($res == true)
                {
                    $count = mysqli_num_rows($res);
                    if($count > 0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $chairs = $row['num_of_chairs'];
                            $description = $row['description'];
            ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td style="text-align: center;"><?php echo $chairs; ?></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <a href="<?php echo $siteurl; ?>admin/update-type-table.php?id=<?php echo $id; ?>" class="btn-scd">Update type table</a>
                                <a href="<?php echo $siteurl; ?>admin/delete-type-table.php?id=<?php echo $id; ?>" class="btn-scd">Delete type table</a>
                            </td>
                        </tr>
            <?php
                        }
                    }
                }
            ?>

        </table>
    </div>
</div>
<div class="clearfix"></div>
<!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>