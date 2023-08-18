<?php
    include "../config/constants.php";
    include "../css/admin.css";

    $rsv_id = $_GET['id'];
    $sql = "SELECT tbl_reservation.id AS 'rsv_id', tbl_lich_dat_ban.ngay_den AS 'Date', tbl_khung_gio.time_start AS 'Time', 
    tbl_table.name AS 'Table', tbl_customer.full_name AS 'Customer', tbl_customer.email, tbl_customer.phone FROM tbl_reservation, tbl_lich_dat_ban, 
    tbl_khung_gio, tbl_table, tbl_customer WHERE tbl_reservation.id=$rsv_id AND tbl_reservation.id_lich_dat_ban=tbl_lich_dat_ban.id 
    AND tbl_reservation.id_khach_hang=tbl_customer.id AND tbl_lich_dat_ban.id_khung_gio=tbl_khung_gio.id 
    AND tbl_lich_dat_ban.id_ban=tbl_table.id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $cus_name = $row['Customer'];
    $date = $row['Date'];
    $time = $row['Time'];
    $table = $row['Table'];
    $cus_email = $row['email'];
    $cus_phone = $row['phone'];

    $subject = "[Gau's village] Xác nhận đặt bàn";
    $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
    $body ="<p>Kính chào quý khách <span style='color: red; font-weight: bold;'>".$cus_name."</span></p>
    <p>Cảm ơn quý khách đã tin tưởng và đặt bàn tại <a style='color: blue;' href='http://localhost:89/restaurant/' target='_blank'>gausvillage.com</a></p>
    <p>Hãy kiểm tra thông tin đặt bàn, nếu có bất kỳ thay đổi gì vui lòng liên hệ với chúng tôi qua <span style='color: blue;'>Hotline: 0973404627</span></p>

    <p><span style='font-weight: bold;'>Tên khách hàng: </span>".$cus_name."</p>
    <p><span style='font-weight: bold;'>Số điện thoại: </span>0".$cus_phone."</p>
    <p><span style='font-weight: bold;'>Mã đặt bàn: </span>".$rsv_id."</p>
    <p><span style='font-weight: bold;'>Ngày đến: </span>".$date."</p>
    <p><span style='font-weight: bold;'>Thời gian đến: </span>".$time."</p>
    <p><span style='font-weight: bold;'>Bàn: </span>".$table."</p>

    <p>Chúng tôi rất hân hạnh được đón tiếp quý khách!</p>
    <p>Gau's Village.</p>";
?>

<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);  
$mail->charSet = 'UTF-8';
// print_r($mail);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'phuongquyen1342002@gmail.com';                 // SMTP username
    $mail->Password = 'hjlqnowtnwowbrmi';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
 
    //Recipients
    $mail->setFrom('phuongquyen1342002@gmail.com', "Gau's Village");
    
    $mail->addAddress($cus_email, $cus_name);     // Add a recipient

    // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
 
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    $mail->send();
    $_SESSION['sendmail'] = "<div class='success'>Email Sent Successfully!</div>";
    header('location:'.$siteurl.'admin/manage-reservation.php');
} catch (Exception $e) {
    $_SESSION['sendmail'] = "<div class='fail'>Failed to Send Email!</div>";
    header('location:'.$siteurl.'admin/manage-reservation.php');
    $mail->ErrorInfo;
}
?>