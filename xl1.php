<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="ncss/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="sweetalert/sweetalert2.all.min.js"></script>
</head>
<body>
	

<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
include("config.php");
if (isset($_POST["submit"])){
	$email = $_POST["email"];
	$sql1 = "select * from account_client where email = '$email'";
	$result = mysqli_query($con,$sql1);
	$num = mysqli_num_rows($result);
	if ($num == 1) {
		echo "<script>
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Email đã tồn tại!'
			  
			})
		</script>";
		header("refresh:2;url=dangky.php");

	}
	else {

	$sql = "insert into account_client(email) values ('$email')";
	mysqli_query($con,$sql);
	    require "vendor/autoload.php";
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->CharSet = 'UTF-8';
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'petlandsfamily@gmail.com';                 // SMTP username
                    $mail->Password = '123456phucP';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                    //Recipients
                    $mail->setFrom('petlandsfamily@gmail.com',$pet);
                    $mail->addAddress($email);     // Add a recipient | name is option
                    $mail->addReplyTo('petlandsfamily@gmail.com', $pet);
//                    $mail->addCC('CCemail@gmail.com');
//                    $mail->addBCC('BCCemail@gmail.com');
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'THÔNG TIN XÁC NHẬN ĐĂNG KÝ TÀI KHOẢN Petlands';
                    $mail->Body = '<b>ấn vào <a href="http://localhost:81/dean2/dangky2.php?valid='.$email.'" style="text-decoration:none;color:red;">đây</a> để đến trang đăng ký tài khoản</b>';
                    $mail->AltBody = 'Được tạo tự động bởi Petlands'; //None HTML
                    $result = $mail->send();
                    if (!$result) {
                        $error = 'Có lỗi xảy ra trong quá trình gửi mail';
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
		echo "<script>
			Swal.fire({
			  icon: 'success',
			  title: 'Xác nhận email thành công,Vui lòng kiểm tra hộp thư',
			  text: 'Đang chuyển đến đăng nhập!'
			  
			})
		</script>";
		header("refresh:2;url=dangky2.php");
	}
}
else {
	header("location:dangky.php");
	echo "kiểm tra lại thông tin đăng ký!!!";
}

?>
	
</body>
</html>