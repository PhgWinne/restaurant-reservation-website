<?php include('partials/head.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="ct-box">
                <br><br>
                <h1>Dashboard</h1>
                <br>
                <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                ?>
                <br><br><br>
                <a class="text-black" href="<?php echo $siteurl; ?>admin/manage-reservation.php">
                    <div class="col">
                        <?php
                        $sql = "SELECT * FROM tbl_reservation";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <h4>Reservation</h4>
                    </div>
                </a>

                <a class="text-black" href="<?php echo $siteurl; ?>admin/status-rsv.php?status='pending'">
                    <div class="col">
                        <?php
                        $sql = "SELECT * FROM tbl_reservation WHERE tbl_reservation.status='pending'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <h4>Pending Reservation</h4>
                    </div>
                </a>

                <a class="text-black" href="<?php echo $siteurl; ?>admin/status-rsv.php?status='completed'">
                    <div class="col">
                        <?php
                        $sql = "SELECT * FROM tbl_reservation WHERE tbl_reservation.status='completed'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <h4>Completed Reservation</h4>
                    </div>
                </a>

                <a class="text-black" href="<?php echo $siteurl; ?>admin/status-rsv.php?status='canceled'">
                    <div class="col">
                        <?php
                        $sql = "SELECT * FROM tbl_reservation WHERE tbl_reservation.status='canceled'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <h4>Canceled Reservation</h4>
                    </div>
                </a>

                <a class="text-black" href="<?php echo $siteurl; ?>admin/status-rsv.php?status='confirmed'">
                    <div class="col">
                        <?php
                        $sql = "SELECT * FROM tbl_reservation WHERE tbl_reservation.status='confirmed'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <h1><?php echo $count; ?></h1>
                        <h4>Upcomming Reservation</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>