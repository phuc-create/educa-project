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
include("config.php");
if (isset($_POST["submit"])){
	$id = $_POST["id"];
	$hoten = $_POST["hoten"];
	$matkhau = $_POST["matkhau"];
	$matkhau = md5($matkhau);
	$sql1 = "select * from account_client where hoten = '$hoten'";
	$result = mysqli_query($con,$sql1);
	$num = mysqli_num_rows($result);
	if ($num == 1) {
		echo "<script>
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Tên Người Dùng Đã Tồn Tại!'
			  
			})
		</script>";
		header("refresh:2;url=dangky.php?valid='.$email.'");

	}
	else {
	$sql = "update account_client set matkhau='$matkhau',hoten='$hoten' where id='$id'";
	if(mysqli_query($con,$sql)){
		echo "<script>
			Swal.fire({
			  icon: 'success',
			  title: 'ĐĂNG KÝ THÀNH CÔNG',
			  text: 'Đang chuyển đến đăng nhập!'
			  
			})
		</script>";
		header("refresh:2;url=index.php");
	}else{
		echo "<script>
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Kiểm tra lại thông tin'
			  
			})
		</script>";
		header("refresh:2;url=dangky.php?valid='.$email.'");
	}
	}
}
else {
	header("location:dangky.php");
	echo "kiểm tra lại thông tin đăng ký!!!";
}

?>
	
</body>
</html>