<?php include("partials/head.php"); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="ct-box">
                <h1>Manage Account</h1>
                <br>
                <a href="add-account.php" class="btn-prm">Add account</a>
                <br><br><br>

                <?php
                //add
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    };
                //update
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    };
                //find_id
                    if(isset($_SESSION['find_id']))
                    {
                        echo $_SESSION['find_id'];
                        unset($_SESSION['find_id']);
                    };
                //delete
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    };
                //change password
                if(isset($_SESSION['change_pwd']))
                {
                    echo $_SESSION['change_pwd'];
                    unset($_SESSION['change_pwd']);
                };
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);
                        if($res == true)
                        {
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo $siteurl; ?>admin/update-account.php?id=<?php echo $id; ?>" class="btn-scd">Update account</a>
                                        <a href="<?php echo $siteurl; ?>admin/change-pwd.php?id=<?php echo $id; ?>" class="btn-scd">Change password</a>
                                        <a href="<?php echo $siteurl; ?>admin/delete-account.php?id=<?php echo $id; ?>" class="btn-scd">Delete account</a>
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