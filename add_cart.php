<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="ncss/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="sweetalert/sweetalert2.all.min.js"></script>
</head>
<body>

<?php
//ĐÂY LÀ THÊM SẢN PHẨM KHI XEM THÔNG TIN SẢN PHẨM MỚI MUA
ob_start();
session_start();
include ("config.php");
		if (isset($_GET["idkh"]) && isset($_GET["oninfor_id"])) {
			$idsp = $_GET["oninfor_id"];
			$id = $_GET["idkh"];
			$sl = $_POST["slmua"];
			$slin = mysqli_query($con,"select * from product_show where id_sp='$idsp'");
			$out = mysqli_fetch_array($slin);

				$slcon = $out["available"];
			if ($slcon<$sl) {
				echo "<script>
                                Swal.fire(
                                'Hết hàng',
                            'Vui lòng chọn số lượng phù hợp :(',
                            'error'  
                                )
                        </script>";
			header("refresh:2;url = food_pet.php?khuyenmai=khuyenmai");
			}else{
			$selectPro = "select * from account_client,product_show WHERE account_client.id=".$id." AND product_show.id_sp=".$idsp;
			$result = mysqli_query($con,$selectPro);
			$row = mysqli_fetch_array($result);
			
			$name_sp = $row["name_sp"];
			$price_sp = $row["price_sp"];
			$img_sp = $row["img_sp"];
			/*echo $id;
			echo $idsp;
			echo $name_sp;
			echo $price_sp;
			echo $img_sp;*/
			echo "đang chuyển hướng trang";
			$check = mysqli_query($con,"select * from cart_client where id_sp='$idsp' and id='$id'");
			if(mysqli_num_rows($check)==0){
			$ok = mysqli_query($con,"insert into cart_client VALUES ('$idsp','$id','$name_sp','$sl','$price_sp','$img_sp')") ;
			if($ok){
			echo "<script>Swal.fire({
			  position: 'top-center',
			  icon: 'success',
			  title: 'Đã thêm sản phẩm vào giỏ',
			  showConfirmButton: false,
			  timer: 1500
				})</script>";
				header("refresh:1;url=food_pet.php?khuyenmai=khuyenmai");
			}
		}else{
				echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Sản phẩm đã tồn tại trong giỏ hàng :(',
                            'error'  
                                )
                        </script>";
			header("refresh:1;url = food_pet.php?khuyenmai=khuyenmai");
			}
		
		}		
	}
elseif (isset($_GET["id_sp"]) && isset($_GET["id"])) {
			$idsp = $_GET["id_sp"];
			$id = $_GET["id"];
			$sl = 1;
			$selectPro = "select * from account_client,product_show WHERE account_client.id=".$id." AND product_show.id_sp=".$idsp;
			$result = mysqli_query($con,$selectPro);
			$row = mysqli_fetch_array($result);
			$slcon = $row["available"];
			$name_sp = $row["name_sp"];
			$price_sp = $row["price_sp"];
			$img_sp = $row["img_sp"];
			if ($slcon < $sl) {
				echo "<script>
                                Swal.fire(
                                'Hết hàng',
                            'Sản phẩm này không còn hàng :(',
                            'error'  
                                )
                        </script>";
			header("refresh:2;url = food_pet.php?khuyenmai=khuyenmai");
			}else{
			/*echo $id;
			echo $idsp;
			echo $name_sp;
			echo $price_sp;
			echo $img_sp;*/
			echo "đang chuyển hướng trang";
			$check = mysqli_query($con,"select * from cart_client where id_sp='$idsp' and id='$id'");
			if(mysqli_num_rows($check)==0){
			mysqli_query($con,"insert into cart_client VALUES ('$idsp','$id','$name_sp',1,'$price_sp','$img_sp')") ;
			echo "<script>Swal.fire({
			  position: 'top-center',
			  icon: 'success',
			  title: 'Đã thêm sản phẩm vào giỏ',
			  showConfirmButton: false,
			  timer: 1500
				})</script>";
				header("refresh:1;url=food_pet.php?khuyenmai=khuyenmai");
			
			}
		else{
			echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Sản phẩm đã tồn tại trong giỏ hàng :(',
                            'error'  
                                )
                        </script>";
			header("refresh:1;url = food_pet.php?khuyenmai=khuyenmai");
		}	}	}
		
?>
<?php
session_start();
include ("config.php");
		if (isset($_GET["id_sp2"]) && isset($_GET["id"])) {
			$idsp = $_GET["id_sp2"];
			$id = $_GET["id"];
			$selectPro = "select * from account_client,product_show WHERE account_client.id=".$id." AND product_show.id_sp=".$idsp;
			$result = mysqli_query($con,$selectPro);
			$row = mysqli_fetch_array($result);
			
			$name_sp = $row["name_sp"];
			$price_sp = $row["price_sp"];
			$img_sp = $row["img_sp"];
			echo $id;
			echo $idsp;
			echo $name_sp;
			echo $price_sp;
			echo $img_sp;
			echo("Đang chuyển hướng trang");
			$check = mysqli_query($con,"select * from cart_client where id_sp='$idsp' and id='$id'");
			if(mysqli_num_rows($check)==0){
			mysqli_query($con,"insert into cart_client VALUES ('$idsp','$id','$name_sp',1,'$price_sp','$img_sp')") ;
			echo "<script>Swal.fire({
			  position: 'top-center',
			  icon: 'success',
			  title: 'Đã thêm sản phẩm vào giỏ',
			  showConfirmButton: false,
			  timer: 1500
				})</script>";
				header("refresh:1.5;url=food_pet.php?allproduct=full");
			
			}
		else{
			echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Sản phẩm đã tồn tại trong giỏ hàng :(',
                            'error'  
                                )
                        </script>";
			header("refresh:1;url = food_pet.php?allproduct=full");
		}		
}
?>
<?php
include("config.php");
if (isset($_POST["sendfeed"]) && isset($_GET["idkh"])) {
	$idkh = $_GET["idkh"];
	$namesend = $_POST["namesend"];
	$textsend = $_POST["textsend"];
	$query = mysqli_query($con,"insert into feedback(idkh,namesend,content) values ('$idkh','$namesend','$textsend')");
	if ($query) {
		echo "<script>Swal.fire({
			  position: 'top-center',
			  icon: 'success',
			  title: 'Cảm ơn bạn đã phản hồi cho chúng tôi',
			  showConfirmButton: false,
			  timer: 1500
				})</script>";
				header("refresh:1;url=trangchu.php");
}else{
echo "Một sự cố đã xảy ra";
header("refresh:1.5;url=trangchu.php");
}
}
?>
</body>
</html>