<?php include('partials/head.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="ct-box">
        <h1>Manage Table</h1>
        <br>
        <a href="add-table.php" class="btn-prm">Add table</a>
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
                <th>Table Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT tbl_table.id, tbl_table.name, tbl_type_table.description  FROM tbl_type_table, tbl_table WHERE tbl_type_table.id = tbl_table.type_table";
                $res = mysqli_query($conn, $sql);
                if($res == true)
                {
                    $count = mysqli_num_rows($res);
                    if($count > 0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $name = $row['name'];
                            $description = $row['description'];
            ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <a href="<?php echo $siteurl; ?>admin/update-table.php?id=<?php echo $id; ?>" class="btn-scd">Update table</a>
                                <a href="<?php echo $siteurl; ?>admin/delete-table.php?id=<?php echo $id; ?>" class="btn-scd">Delete table</a>
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