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

    // Calendar
    $sql = "SELECT * FROM tbl_lich_dat_ban, tbl_khung_gio, tbl_table WHERE tbl_lich_dat_ban.id=$calendar_id 
    AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id AND tbl_lich_dat_ban.id_ban=tbl_table.id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $time_start = $row['time_start'];
        $time_end = $row['time_end'];
        $date = $row['ngay_den'];
        $table = $row['name'];
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
                        <p><?php echo $rsv_id; ?></p>
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
                        <p><?php echo $rsv_request; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Status: </p></td>
                    <td>
                        <p><?php echo $rsv_status; ?></p>
                    </td>
                </tr>
            </table>
        </form>

        <!-- Calendar -->
        <form action="" method="post">
            <table class="tbl-rsv">
            <tr>
                    <td colspan="2" style="font-weight: bold" class="text-red">Calendar</td>
                </tr>
                <tr>
                    <td colspan="2"><div class="line"></div></td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Date: </p></td>
                    <td>
                        <p><?php echo $date; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Time start: </p></td>
                    <td>
                        <p><?php echo $time_start; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Table: </p></td>
                    <td>
                        <p><?php echo $table; ?></p>
                    </td>
                </tr>
            </table>
        </form>

        <!-- Customer -->
        <form action="" method="post">
            <table class="tbl-rsv">
                <tr>
                    <td colspan="2" style="font-weight: bold" class="text-red">Customer Information</td>
                </tr>
                <tr>
                    <td colspan="2"><div class="line"></div></td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Name: </p></td>
                    <td>
                        <p><?php echo $cus_name; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Phone Number: </p></td>
                    <td>
                        <p><?php echo "0".$cus_phone; ?></p>
                    </td>
                </tr>
                <tr>
                    <td><p style="font-weight: bold">Email: </p></td>
                    <td>
                        <p><?php echo $cus_email; ?></p>
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
        header('location:'.$siteurl.'admin/update-reservation.php?id='.$rsv_id);
    }
    ob_end_flush(); 
?>
