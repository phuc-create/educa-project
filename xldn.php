<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	

<?php
session_start();
include("config.php");
if (isset($_POST["submit"])) {
	$email = $_POST["email"];
	$matkhau = $_POST["matkhau"];
	$email = mysqli_real_escape_string($con,$email);
	$matkhau = mysqli_real_escape_string($con,$matkhau);
	$matkhau = md5($matkhau);
	$sql = mysqli_query($con,"select * from account_client where email = '$email' and matkhau = '$matkhau' ");
	$num = mysqli_num_rows($sql);
	if ($num == 1) {
		$_SESSION["taikhoan"] = $email;
		$_SESSION["success"] = "you are login";
		header("location:trangchu.php");
		}else {
			
			echo "<script>alert('Kiểm tra lại tài khoản hoặc mật khẩu')</script>";
			header("refresh:0;url=index.php");
		}
}
else {
	header("location:index.php");
	echo 'mật khẩu sai';
}
?>
<?php
if(isset($_GET["logout"])){
	session_destroy();
	unset($_SESSION["taikhoan"]);
	header("location:index.php");
}



?>
<?php
if(isset($_GET["break"])){
	session_destroy();
	unset($_SESSION["success"]);
	header("location:login.php");
}



?>	
</body>
</html>