<?php include('partials/head.php'); ?>

<?php 
    ob_start();
    //Get Customer Information
    $cus_id = $_GET['cus_id'];
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

    //Get calendar information
    $time_id = $_GET['time_id'];
    $sql ="SELECT * FROM tbl_lich_dat_ban, tbl_khung_gio WHERE tbl_lich_dat_ban.id=$time_id 
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
?>

<div class="rsv">
    <div class="rsv-box">
        <div class="rsv-time" style="text-align: left">
            <h2 class="heading" style="text-align: center">Your Reservation</h2>
            <h3 class="heading-days"> Your Information</h3>
            <table>
                <tr>
                    <td>Name: </td>
                    <td><?php echo $cus_name; ?></td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td><?php echo "0".$cus_phone; ?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?php echo Strtolower($cus_email); ?></td>
                </tr>
            </table>
            <h3 class="heading-days"> Reserve Date</h3>
            <table>
                <tr>
                    <td>Date: </td>
                    <td><?php echo $date; ?></td>
                </tr>
                <tr>
                    <td>Time: </td>
                    <td><?php echo $time_start; ?></td>
                </tr>
            </table>
        </div>
        
        <form method="post" class="rsv-form">
            <h2 class="heading yellow">Choose Table</h2>
            <table>
                <tr>
                    <td>Table:</td>
                    <td>
                        <select name="table">
                        <?php
                           //Get unavailable table
                                //ràng buộc time_end
                            $sql = "SELECT * FROM tbl_lich_dat_ban, tbl_khung_gio, tbl_reservation WHERE tbl_lich_dat_ban.ngay_den='$date' 
                            AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id AND tbl_khung_gio.time_end > '$time_start' 
                            AND tbl_khung_gio.time_end <= '$time_end' AND tbl_reservation.id_lich_dat_ban = tbl_lich_dat_ban.id 
                            AND tbl_reservation.status <> 'canceled' AND tbl_reservation.status <> 'completed'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            $exc_table = [];
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    if($row['id_ban'] != 0)
                                    {
                                        $exc_table[] = $row['id_ban'];  
                                    }          
                                }
                            }
                                //ràng buộc time_start
                            $sql = "SELECT * FROM tbl_lich_dat_ban, tbl_khung_gio, tbl_reservation WHERE tbl_lich_dat_ban.ngay_den='$date' 
                            AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id AND tbl_khung_gio.time_start >= '$time_start' 
                            AND tbl_khung_gio.time_start < '$time_end' AND tbl_reservation.id_lich_dat_ban = tbl_lich_dat_ban.id 
                            AND tbl_reservation.status <> 'canceled' AND tbl_reservation.status <> 'completed'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $i = 0;
                                    foreach($exc_table as $item)
                                    {
                                        if($row['id_ban'] == $item)
                                        {
                                            $i++;
                                        }
                                    }    
                                    if($i == 0 AND $row['id_ban'] != 0)
                                    {
                                        $exc_table[] = $row['id_ban'];
                                    }      
                                }
                            }

                            $sql = "SELECT * FROM tbl_table";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    if(count($exc_table) > 0)
                                    {
                                        $i=0;
                                        foreach($exc_table as $item)
                                        {
                                            if($item == $row['id'])
                                            {
                                                $i++;
                                            }
                                        }
                                        if($i == 0)
                                        {
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name'] ?></option>
                                        <?php
                                    }
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><p>Click here for <a href="#" class="yellow">table information</a></p></td>
                </tr>
                <tr>
                    <td>Request: </td>
                    <td><textarea name="request" cols="30" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name ="submit" value="Submit" class="btn-rsv">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php 
    if(isset($_POST['submit']))
    {
        $table = $_POST['table'];
        $request = $_POST['request'];

        $sql1 = "UPDATE tbl_lich_dat_ban SET id_ban=$table WHERE id=$time_id";
        $res1 = mysqli_query($conn, $sql1);

        $sql2 = "INSERT INTO tbl_reservation SET id_khach_hang=$cus_id, id_lich_dat_ban=$time_id, request='$request', status='pending'";
        $res2 = mysqli_query($conn, $sql2);
        if($res1 == TRUE and $res2 == TRUE)
        {
            header('location:'.$siteurl.'confirm-rsv.php');
        }
    }

    ob_end_flush();
?>