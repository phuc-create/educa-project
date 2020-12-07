<?php
 include("config.php"); 
 session_start();
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/style.css">
<link rel="stylesheet" type="text/css" href="ncss/showdetails.css">
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
            	echo "0";
            }
            ?></span></a></li>
            <li><a href="trangchu.php#contactus">LIÊN HỆ</a></li>
            <li><div class="dropdown">
                <button class="dropbtn">
                    <a href="trangchu.php">
                          
                            <?php
                                echo "Xin chào<br>".$name_tk;
                            
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
    <?php
            include("config.php");

            if (isset($_GET["ordernumber"])) {
                $order_id = $_GET["ordernumber"];
                $export1 = mysqli_query($con,"SELECT * FROM `order` o JOIN `account_client` a on o.`id`=a.`id` WHERE order_id='$order_id'");
                $push = mysqli_fetch_array($export1);
                $time = $push["order_date"];
                $ordertime  = date("d-m-Y",strtotime($time));
                ?>
                <div class="paper">
        <div class="allinfor">
            <h1>Chi tiết hóa đơn số #<?= $push["order_id"] ?></h1>
        </div>
        <div class="showdetail">
            <h3>Họ và tên:<?= $push["hoten"] ?></h3>
            <p>Số điện thoại:<?= $push["sdt"] ?></p>
            <p>Email:<?= $push["email"] ?></p>
              
            <table>
                <tr id="on">
                    <td id="left">Sản Phẩm</td>
                    <td id="left">Gía Tiền</td>
                </tr>
                <?php
                include("config.php");
                if (isset($_GET["ordernumber"])) {
                $order_id = $_GET["ordernumber"];
                $export2 = mysqli_query($con,"select * from order_details where order_id='$order_id'");
                while ($push2 = mysqli_fetch_array($export2)) {
                echo"
                <tr>
                    <td id='right'>".$push2["ten_sp"]." x ".$push2["sl_sp"]."</td>
                    <td>".number_format($push2["gia_sp"],0,",",".")." đ</td>
                </tr>";
            }
            }
                ?>
            </table>
            <p>Tổng : <?= number_format($push["order_total"]-30000,0,",",".") ?> đ</p>
            <p>Giao hàng: 30.000 đ(Tiêu Chuẩn)</p>
            <p>Tổng Thanh toán: <strong><?= number_format($push["order_total"],0,",",".") ?>đ (Đã được giảm giá)</strong></p>
            <p>Hình Thức Thanh Toán: <strong><?= $push["httt"] ?></strong></p>
            <p>Ngày đặt hàng:<?= $ordertime ?></p>
            <p>Dự kiến giao nhận hàng:<?= $push["date_ship"] ?></p>
            <p>Địa chỉ Giao hàng : <?= $push["diachi"] ?></p>
            
                    <hr style="margin-bottom: 20px;">
        </div>
    </div>
    <?php
            }
            ?>
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