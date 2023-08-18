<?php include("partials/head.php"); ?>

<?php
    $status = $_GET['status'];
?>

<!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="ct-box">
            <h1>Manage Reservation</h1>
            <br><br><br>
            <a href="add-reservation.php" class="btn-prm">Add Reservation</a>
            <br> <br>
            <?php
                //update
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                };
            ?>
             <br> <br>
            <section class="rsv-search" style="text-align: right">
                            <div class="container">
                                <form action="<?php echo $siteurl; ?>admin/search-rsv.php" method="POST">
                                    <input type="text" name="search"  required>
                                    <input type="submit" name="submit" value="Search" class="btn-scd btn-cal">
                                </form>
                            </div>
                        </section>
        <form action="" method="post">
            <table class="tbl-full">                   
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql="SELECT tbl_reservation.id, tbl_customer.full_name, tbl_lich_dat_ban.ngay_den, tbl_khung_gio.time_start, tbl_reservation.status 
                FROM tbl_reservation, tbl_customer, tbl_lich_dat_ban, tbl_khung_gio 
                WHERE tbl_reservation.id_khach_hang=tbl_customer.id AND tbl_reservation.id_lich_dat_ban=tbl_lich_dat_ban.id
                AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id AND tbl_reservation.status=$status";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $customer = $row['full_name'];
                        $date = $row['ngay_den'];
                        $time = $row['time_start'];
                        $status = $row['status'];
                        ?>
                        <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $customer; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $time; ?></td>
                        <?php 
                            if($status == 'pending')
                            {
                                ?>
                                <td class="text-bold"><?php echo $status; ?></td>
                                <?php
                            }
                            if($status == 'confirmed')
                            {
                                ?>
                                <td class="text-green text-bold"><?php echo $status; ?></td>
                                <?php
                            }
                            if($status == 'completed')
                            {
                                ?>
                                <td class="text-blue text-bold"><?php echo $status; ?></td>
                                <?php
                            }
                            if($status == 'canceled')
                            {
                                ?>
                                <td class="text-red text-bold"><?php echo $status; ?></td>
                                <?php
                            }
                        ?>
                        
                        <td>
                            <a href="<?php echo $siteurl; ?>admin/view-reservation.php?id=<?php echo $id; ?>" class="btn-scd">View</a>
                            
                        </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:'.$siteurl.'Admin/manage-category.php');
                }
                ?>
                </tr>
            </table>
        </form> 
    </div>
</div>
<div class="clearfix"></div>
<!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>
