<?php include('partials/head.php'); ?>

<section class="calendar-search">
    <div class="container">
        <?php
            $search = $_POST['search-date'];
        ?>
    </div>
</section>

<div class="main-content">
    <div class="ct-box">
        <h1>Calendar</h1>
        <br>
        <h2>Calendar for <span class="text-red"><?php echo $search; ?></span></h2>
        <br><br><br>

        <!-- <section> -->
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Reservation ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Table</th>
            </tr>
            <?php
                $sql = "SELECT tbl_lich_dat_ban.id, tbl_reservation.id AS 'rsv_id', tbl_lich_dat_ban.ngay_den, tbl_khung_gio.time_start, 
                tbl_table.name FROM tbl_lich_dat_ban, tbl_reservation, tbl_khung_gio, tbl_table WHERE tbl_lich_dat_ban.id=tbl_reservation.id_lich_dat_ban 
                AND tbl_lich_dat_ban.id_ban=tbl_table.id AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id
                AND tbl_lich_dat_ban.ngay_den='$search'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $cal_id = $row['id'];
                        $rsv_id = $row['rsv_id'];
                        $date = $row['ngay_den'];
                        $time = $row['time_start'];
                        $table = $row['name'];
                        ?>
                        <tr>
                            <td><?php echo $cal_id; ?></td>
                            <td><?php echo $rsv_id; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $time; ?></td>
                            <td><?php echo $table; ?></td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
        <!-- </section> -->
    </div>
</div>

<?php include('partials/footer.php'); ?>