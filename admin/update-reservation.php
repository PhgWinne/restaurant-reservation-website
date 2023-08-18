<?php include('partials/head.php'); ?>

<?php
    ob_start();
    $rsv_id = $_GET['id'];
    //Reservation
    $sql = "SELECT * FROM tbl_reservation WHERE id=$rsv_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $cus_id = $row['id_khach_hang'];
        $calendar_id = $row['id_lich_dat_ban'];
        $rsv_timestamp = $row['timestamp'];
        $rsv_request = $row['request'];
        $rsv_status = $row['status'];
    }
    // Calendar
    $sql = "SELECT * FROM tbl_lich_dat_ban, tbl_khung_gio WHERE tbl_lich_dat_ban.id=$calendar_id 
    AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $time_start = $row['time_start'];
        $time_end = $row['time_end'];
        $date = $row['ngay_den'];
    }

    // Table
    $sql = "SELECT tbl_table.id, tbl_table.name FROM tbl_lich_dat_ban, tbl_table WHERE tbl_lich_dat_ban.id_ban=tbl_table.id 
    AND tbl_lich_dat_ban.id=$calendar_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $table_id = $row['id'];
        $table_name = $row['name'];
    }

    // Customer
    $sql = "SELECT * FROM tbl_customer WHERE id=$cus_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $cus_name = $row['full_name'];
        $cus_phone = $row['phone'];
        $cus_email = $row['email'];
    }
?>

<div class="main-content">
    <div class="ct-box">
        <br><br>
        <h1>Reservation</h1>
        <br><br><br><br><br>
        <!-- Reservation -->
        <form action="" method="post">
            <table class="tbl-rsv">
                <tr>
                    <td colspan="2"><div class="line"></div></td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">ID: </p></td>
                    <td>
                        <p><?php echo $rsv_id ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Timestamp: </p></td>
                    <td>
                        <p><?php echo $rsv_timestamp; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Request: </p></td>
                    <td>
                        <input type="text" name="rsv_request" value="<?php echo $rsv_request; ?>">
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Status: </p></td>
                    <td>
                    <select name="rsv_status">
                        <option <?php if($rsv_status == "pending") {echo "selected";} ?> value="pendding">pendding</option>
                        <option <?php if($rsv_status == "completed") {echo "selected";} ?> value="completed">completed</option>
                        <option <?php if($rsv_status == "canceled") {echo "selected";} ?> value="canceled">canceled</option>
                        <option <?php if($rsv_status == "confirmed") {echo "selected";} ?> value="confirmed">confirmed</option>
                    </select>
                    </td>
                </tr>
        <!-- Calendar -->
                <tr>
                    <td colspan="2" style="font-weight: bold" class="text-red">Calendar</td>
                </tr>
                <tr>
                    <td colspan="2"><div class="line"></div></td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Table: </p></td>
                    <td>
                        <select name="table">
                            <?php
                                $sql2 = "SELECT * FROM tbl_table";
                                $res2 = mysqli_query($conn, $sql2);
                                if($res2 == true)
                                {
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2 > 0)
                                    {
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            $tbl_id = $row2['id'];
                                            $tbl_name = $row2['name'];
                                            ?>
                                            <option <?php if($tbl_id == $table_id) {echo "selected"; }?> value="<?php echo $tbl_id; ?>"><?php echo $tbl_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Table Found</option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Time start: </p></td>
                    <td>
                        <select name="time">
                            <?php
                                $sql = "SELECT * FROM tbl_khung_gio";
                                $res = mysqli_query($conn, $sql);
                                if($res == true)
                                {
                                    $count = mysqli_num_rows($res);
                                    if($count > 0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $time_id = $row['id'];
                                            $time = $row['time_start'];
                                            ?>
                                            <option <?php if($time == $time_start) {echo "selected";} ?> value="<?php echo $time_id; ?>"><?php echo $time; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No Time Found</option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Date: </p></td>
                    <td>
                        <input type="date" name="date" value="<?php echo $date; ?>">
                    </td>
                </tr>

                <!-- Customer -->
                <tr>
                    <td colspan="2" style="font-weight: bold" class="text-red">Customer Information</td>
                </tr>
                <tr>
                    <td colspan="2"><div class="line"></div></td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Name: </p></td>
                    <td>
                        <input type="text" name="cus_name" value="<?php echo $cus_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Phone Number: </p></td>
                    <td>
                        <input type="text" name="cus_phone" value="<?php echo "0".$cus_phone; ?>">
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Email: </p></td>
                    <td>
                        <input type="text" name="cus_email" value="<?php echo $cus_email; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <?php
                            if(isset($_SESSION['test']))
                            {
                                echo $_SESSION['test'];
                                unset($_SESSION['test']);
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" value="Update" class="btn-scd btn-sub">
                        <input type="submit" value="Exit" name="exit" class="btn-prm btn-sub">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
    if(isset($_POST['exit']))
    {
        header('location:'.$siteurl.'admin/manage-reservation.php');
    }
    if(isset($_POST['update']))
    {
        // RSV
        $rsv_request = $_POST['rsv_request'];
        $rsv_status = $_POST['rsv_status'];
        if($rsv_status != "")
        {
            $sql1 = "UPDATE tbl_reservation SET request='$rsv_request', status='$rsv_status' WHERE id=$rsv_id";
            $res1 = mysqli_query($conn, $sql1);
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information! </div>";
            header('location:'.$siteurl.'admin/update-reservation.php?id='.$rsv_id);
        }

        // Calendar
        $table_id = $_POST['table'];
        $time_id = $_POST['time'];
        $date = $_POST['date'];
        $sql2 = "UPDATE tbl_lich_dat_ban SET id_khung_gio=$time_id, id_ban=$table_id, ngay_den='$date' WHERE id=$calendar_id";
        $res2 = mysqli_query($conn, $sql2);

        // Customer
        $cus_name = $_POST['cus_name'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];
        if($cus_name != "" AND $cus_phone != "" AND $cus_email != "")
        {
            $sql3 = "UPDATE tbl_customer SET full_name='$cus_name', phone='$cus_phone', email='$cus_email' WHERE id=$cus_id";
            $res3 = mysqli_query($conn, $sql3);
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information! </div>";
            header('location:'.$siteurl.'admin/update-reservation.php?id='.$rsv_id);
        }

        if($res1 == TRUE AND $res2 == TRUE AND $res3 == TRUE)
        {
            $_SESSION['update'] = "<div class='success'>Reservation Updated Successfully</div>";
            header('location:'.$siteurl.'admin/manage-reservation.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='fail'>Falied to update reservation</div>";
            header('location:'.$siteurl.'admin/manage-reservation.php');
        }
    }
    ob_end_flush(); 
?>
