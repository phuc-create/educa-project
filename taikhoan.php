<?php
 include("config.php"); 
 session_start();
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/style.css">
<link rel="stylesheet" type="text/css" href="ncss/taikhoan.css">
<!--<link rel="stylesheet" type="text/css" href="ncss/style2.css">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <title>Trang chủ</title>
</head>
<html>

<body>
    <header>
    	<?php if (isset($_SESSION["taikhoan"]) && $_SESSION["taikhoan"])
    	{
    		$email = $_SESSION["taikhoan"];
    		?>
        <a href="#" class="logo">petsland</a>
        <div class="menu_toggle"></div>
        <nav>
        <ul>
            <li><a href="trangchu.php" class="active">TRANG CHỦ</a></li>
            <li><a href="trangchu.php#about">ABOUT</a></li>
            <li><a href="trangchu.php#service">DỊCH VỤ</a></li>
            <li><a href="trangchu.php#feedback">GÓP Ý</a></li>
            <li><a href="cart.php">GIỎ HÀNG<span class="sl" id="sl"><?php
            include("config.php");
            $result = mysqli_query($con,"select * from account_client where email = '$email'");
            $roww = mysqli_fetch_array($result);
            $id = $roww["id"];
            $name_tk = $roww["hoten"];
            $coutcart = 0;
            $result2 = mysqli_query($con,"select * from cart_client where id = '$id'");
            if ($result2) {
                while ($slcart = mysqli_fetch_array($result2)) {
                $sl = $slcart["sl_cart"];
                $coutcart += $sl;
            }
            echo $coutcart;
            }
            else
            {
                echo "<script>alert('Bạn phải đăng nhập');</script>";
                                header("refresh:0;url=index.php");
            }
            ?></span></a></li>
            <li><a href="trangchu.php#contactus">LIÊN HỆ</a></li>
            <li><div class="dropdown">
                <button class="dropbtn">
                    <a href="trangchu.php">
                          
                            <?php
                                echo $name_tk;
                            
                            ?>
                            <?php
                        }
                            else
                            {
                                echo "<script>alert('Bạn phải đăng nhập');</script>";
                                header("refresh:0;url=index.php");
                            }
                     ?>
                 </a>
                </button>
                    <div class="dropdown-content">
                        <a href="taikhoan.php">tài khoản</a>
                        <a href="xldn.php?logout = '1'">Đăng xuất</a>
                    </div>
                </div>
            </li>
        </ul>
        </nav>
        <div class="clearFix"></div>
    </header>
<div class="all">
	<div class="up">
		<?php
		include("config.php");
		$sql = mysqli_query($con,"select * from account_client where email = '$email'");
		while ($row = mysqli_fetch_array($sql)) {
			$id = $row["id"];
            $discount = $row['tongmua']/10000;
		echo'
	<div class="personal-infor boxp">
		<h1>Thông tin cá nhân</h1>

		<i class="fa fa-user-circle-o" aria-hidden="true"></i><p>'.$row['hoten'].'</p>
        <hr>
        <i class="fa fa-money" aria-hidden="true"></i><p>Khách hàng là hội viên tiềm năng với <span style="color:red">'.$discount.'</span> điểm tích lũy<br>
            <span style="color:blue">(Giảm 2% cho điểm tích lũy hơn 200<br>
            Giảm 5% cho điểm tích lũy hơn 500<br>
            Giảm 8% cho điểm tích lũy hơn 800</br>
            Giảm 10% cho điểm tích lũy hơn 1000(Tối đa 10%))</span></p>
		<hr>
		<i class="fa fa-envelope-o" aria-hidden="true"></i><p>'.$row['email'].'</p>
		<a href="update.php?id='.$row['id'].'">Sửa thông tin</a>
		
	</div>
	<div class="personal-address boxp">
		<h1>Địa chỉ giao hàng</h1>
		<i class="fa fa-user-circle-o" aria-hidden="true"></i><p>'.$row['hoten'].'</p>
		<hr>
		<i class="fa fa-address-card" aria-hidden="true"></i><p>'.$row['diachi'].'</p>
		<hr>
		<i class="fa fa-map-marker" aria-hidden="true"></i><p>'.$row['khuvuc'].'</p>
		<a href="update.php?id='.$row['id'].'">Sửa thông tin</a>
	</div>';
}
	?>
</div>
<div class="down">
	<div class="personal-order">
		<h2>Chi tiết hóa đơn</h2>
		<table border="0" bgcolor="#f1f1f1">
			<tr>
				<td>Mã hóa đơn</td>
				<td>Ngày tạo</td>
				<td>Tổng tiền</td>
				<td>Hình thức</td>
				<td>Trạng thái</td>
			</tr>
			<?php
		include("config.php");
		$sql2 = mysqli_query($con,"SELECT * FROM `order` where `id`='$id'");
		while ($row2 = mysqli_fetch_array($sql2)) {

			$thoigian = $row2["order_date"];
			$newtime  = date("d-m-Y",strtotime($thoigian));
			?>

			<tr>
				<td>#<?= $row2["order_id"] ?></td>
				<td><?= $newtime ?></td>
				<td><?= number_format($row2["order_total"],0,",",".") ?><span>đ</span></td>
				<td><?= $row2["httt"] ?><br>(Xem thêm trong sms)</td>
				<td id="xl"><?php if($row2["order_status"]=="Đã Giao Hàng"){
                                            echo '<p style="color:green;font-weight:bold;">Đã Giao Hàng</p>';
                                        }elseif ($row2["order_status"]=="Đã Nhận Đơn") {
                                            echo '<p style="color:blue;">Đã Nhận Đơn</p>';
                                        }else{
                                            echo '<p style="color:red;">Đang Xử Lý</p>';
                                        } ?>     
                </td>
                <td><a href="details.php?ordernumber=<?= $row2["order_id"] ?>&JASVCCVCSJJJx2833"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
			</tr>
        
			<?php
		}
			?>
        </table>
	</div>
    
</div>
<div class="personal-order">
        <h1 style="text-align: center;">Dịch vụ bạn đã đăng kí</h1>
        <table >
            <tr>
                <td>Tên dịch vụ</td>
                <td>Trạng thái</td>
                <td>Ngày đăng ký</td>
                <td>Thông tin</td>
            </tr>
            <?php
            include("config.php");
            $out = mysqli_query($con,"select * from service where id='$id'");
            while ($in = mysqli_fetch_array($out)) {
                $thoigian2 = $in["ngaydat_dv"];
            $newtime2  = date("d-m-Y",strtotime($thoigian2));
            ?>
            
            <tr>
                <td><?= $in["ten_dv"] ?></td>
                <td><?php if($in["trangthai_dv"]=="Đang xử lý"){
                    echo "<p style='color:red;'>Petsland đang xử lý yêu cầu của bạn</p>";
                }
                else
                {
                    echo"<p style='color:green;'>Dịch Vụ đã Kết Thúc</p>";
                } 
                ?>    
                </td>
                <td><?= $newtime2 ?></td>
                <td><?php if($in["trangthai_dv"]=="Đang xử lý"){
                    echo $in["trangthai_dv"];
                }
                else
                {
                    echo"<p style='color:green;'>Biến mất sau 24h</p>";
                } 
                ?>   </td>
            </tr>
            <?php
        }
            ?>
        </table>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.menu_toggle').click(function(){
                $('.menu_toggle').toggleClass('active')
                $('nav').toggleClass('active')
            })
        })
    </script>
</html>