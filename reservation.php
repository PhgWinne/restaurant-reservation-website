<?php 
    include('partials/head.php'); 
    ob_start();
?>

<div class="rsv">
    <div class="rsv-box">
        <div class="rsv-time">
            <h2 class="heading">Time Open</h2>
            <h3 class="heading-days">Monday-Sunday</h3>
            <p>11am - 10pm</p>
            <h3 class="heading-days">Address</h3>
            <p>G14A - G14B, Near C1 Gate, Ground Floor, Aeon Mall Tan Phu Celadon, 30 Tan Thang street, Son Ky, Tan Phu, Ho Chi Minh city</p>
            <h3 class="heading-days">Booking policy</h3>
            <p>Booking a table at least 4 hours before. Please contact us when you want to book a table for more than 15 people.
                <a href="#" class="yellow">See More</a>
            </p>

            <h4 class="heading-phone"><br>Call us: 0973 404 627 <br> Email: poppyhills_CSKH@mail.com</h4>
        </div>
        <form action="" class="rsv-form" method="POST">
            <h2 class="heading yellow">Reservation Online</h2>
            <table>
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" placeholder="Your Name"></td>
                </tr>    
                <tr>
                    <td>Phone: </td>
                    <td><input type="text" name="phone" placeholder="Your Phone Number"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" placeholder="Your Email"></td>
                </tr>
                <tr>
                    <td>Date: </td>
                    <td><input type="date" name="date"></td>
                </tr>    
                <tr>
                    <td>Time: </td>
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
                                            $id = $row['id'];
                                            $time_start = $row['time_start'];
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $time_start; ?></option>
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
                    <td></td>
                    <td>
                        <input type="submit" value="Next" name="submit" class="btn-rsv">
                        <br>
                        <br>
                        <?php
                            if(isset($_SESSION['test']))
                            {
                                echo $_SESSION['test'];
                                unset($_SESSION['test']);
                            }
                        ?>
                    </td>
                </tr>
            </table>   
        </form>
    </div>
</div>
<div class="clearfix"></div>

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        $cus_name = $_POST['name'];
        $cus_phone = $_POST['phone'];
        $cus_email = $_POST['email'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        if($cus_name != "" AND $cus_email != "" AND $cus_phone != "" AND $date != "" AND $time != "")
        {
            // Add customer information
            $sql = "SELECT * FROM tbl_customer WHERE phone=$cus_phone";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count == 0)
            {
                $sql = "INSERT INTO tbl_customer SET full_name='$cus_name', phone=$cus_phone, email='$cus_email'";
                $res = mysqli_query($conn, $sql);
                $cus_id = mysqli_insert_id($conn);

            }
            else
            {
                $row = mysqli_fetch_assoc($res);
                $cus_id = $row['id'];
            }

            // Add calendar information
            $sql = "INSERT INTO tbl_lich_dat_ban SET id_khung_gio=$time, ngay_den='$date' ";
            $res = mysqli_query($conn, $sql);
            $time_id = mysqli_insert_id($conn);
        }
        else
        {
            $_SESSION['test'] = "<div class='fail'>Please fill full information!</div>";
            header('location:'.$siteurl.'reservation.php');
        }
            header('location:'.$siteurl.'choose-table.php?cus_id='.$cus_id.'&time_id='.$time_id);
        
    }
    ob_end_flush(); 
?>