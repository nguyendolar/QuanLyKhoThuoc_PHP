<?php
include('inc/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('inc/library.php');
include('vendor/autoload.php');
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $upass  = $_POST['matkhau'];
    $query = "SELECT * FROM nguoidung WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
      header("Location: login.php?fail=1");
    } 
    else {
      $row = mysqli_fetch_array($result);
      if ($upass != $row['matkhau']) {
        header("Location: login.php?fail=1");
      }
      else{
        header("Location: index.php?msg=1");
      $_SESSION['taikhoanadmin'] = $email;
      $_SESSION['id'] = $row['id'];
      $_SESSION['tenhienthi'] = $row['hoten'];
      $_SESSION['quyen'] = $row['quyen_id'];
      }
    }
    }
    if(isset($_POST['quenmk'])){
      $email = $_POST['email'];
      $query = "SELECT * FROM nguoidung WHERE email='$email'";
      $result = mysqli_query($connect, $query);
      $num_rows = mysqli_num_rows($result);
      if ($num_rows == 0) {
        header("Location: quenmk.php?fail=1");
      } 
      else {
        $row = mysqli_fetch_array($result);
        $matkhau = $row['matkhau'];
        $hoten = $row['hoten'];
        $noidung = 'Xin chào <strong> '.$hoten.' </strong> !<br> Mật khẩu hiện tại của bạn là :  <strong>'.$matkhau.'</strong>';
        $mail = new PHPMailer(true);                              
        try {
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = SMTP_HOST;  
            $mail->SMTPAuth = true;                               
            $mail->Username = SMTP_UNAME;                 
            $mail->Password = SMTP_PWORD;                           
            $mail->SMTPSecure = 'ssl';                            
            $mail->Port = SMTP_PORT;                                   
            $mail->setFrom(SMTP_UNAME, "QUẢN LÝ KHO NHÀ THUỐC CHU MAI");
            $mail->addAddress($email, $hoten);     
            $mail->addReplyTo(SMTP_UNAME, 'QUẢN LÝ KHO NHÀ THUỐC CHU MAI');
            $mail->isHTML(true);                                  
            $mail->Subject = 'Thông báo';
            $mail->Body = $noidung;
            $mail->AltBody = $noidung; 
            $result = $mail->send();
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        header("Location: login.php?msg=1");
        }
      }
 ?> 
 