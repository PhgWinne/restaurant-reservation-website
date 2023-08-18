<?php
include ("config/constants.php");

// $rsv_id = $_GET['id'];
$sql = "SELECT tbl_reservation.id AS 'rsv_id', tbl_lich_dat_ban.ngay_den AS 'Date', tbl_khung_gio.time_start AS 'Time', 
tbl_table.name AS 'Table', tbl_customer.full_name AS 'Customer', tbl_customer.email, tbl_customer.phone FROM tbl_reservation, tbl_lich_dat_ban, 
tbl_khung_gio, tbl_table, tbl_customer WHERE tbl_reservation.id=28 AND tbl_reservation.id_lich_dat_ban=tbl_lich_dat_ban.id 
AND tbl_reservation.id_khach_hang=tbl_customer.id AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id 
AND tbl_lich_dat_ban.id_ban=tbl_table.id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$rsv_id = 28;
$cus_name = $row['Customer'];
$date = $row['Date'];
$time = $row['Time'];
$table = $row['Table'];
$cus_email = $row['email'];
$cus_phone = $row['phone'];
?>
<?php
$body ="<p>Kính chào quý khách <span style='color: red; font-weight: bold;'>".$cus_name."</span></p>
<p>Cảm ơn quý khách đã tin tưởng và đặt bàn tại <a style='color: blue;' href='http://localhost:89/restaurant/' target='_blank'>gausvillage.com</a></p>
<p>Hãy kiểm tra thông tin đặt bàn, nếu có bất kỳ thay đổi gì đừng ngần ngại mà hãy liên hệ với chúng tôi qua <span style='color: blue;'>Hotline: 0973404627</span></p>

<p><span style='font-weight: bold;'>Tên khách hàng: </span>".$cus_name."</p>
<p><span style='font-weight: bold;'>Số điện thoại: </span>0".$cus_phone."</p>
<p><span style='font-weight: bold;'>Mã đặt bàn: </span>".$rsv_id."</p>
<p><span style='font-weight: bold;'>Ngày đến: </span>".$date."</p>
<p><span style='font-weight: bold;'>Thời gian đến: </span>".$time."</p>
<p><span style='font-weight: bold;'>Bàn: </span>".$table."</p>

<p>Chúng tôi rất hân hạnh được đón tiếp quý khách!</p>
<p>Gau's Village</p>";

echo $body;
?>