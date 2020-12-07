<?php include("config.php"); ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/happy_service.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert/sweetalert2.all.min.js"></script>
<head>
    <title>Dịch vụ thú cưng</title>
</head>
<?php include("config.php"); ?>
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
    <form method="post" action="protect_service.php" name="protect_service">
    <div class="happy_service">
        <div class="container-happy-service">
        <div class="title">
            <h1>Đăng kí dịch vụ trông giữ thú cưng</h1>
        </div>
        <div class="container-form-service">
            <div class="img-happy-service">
                <img src="img-vid/protect_service.svg">
            </div>
            <div class="form-happy-service">
                <div class="input-hs">
                    <label>Tên Dịch Vụ</label>
                    <input type="Adress" name="ten" value="Dịch Vụ Trông Giữ Thú Cưng" readonly="">
                </div>
                <div class="input-hs">
                    <label>Họ và Tên(bắt buộc!)</label>
                    <input type="text" name="hoten" required="">
                </div>
                <div class="input-hs">
                    <label>Số điện thoại(bắt buộc!)</label>
                    <input type="text" name="sdt" required="">
                </div>
                <div class="input-hs">
                    <label>Mô tả một chút về thú cưng của bạn(bắt buộc!)</label>
                    <textarea required="" name="mota"></textarea>
                </div>
                <div class="input-hs">
                    <input type="submit" name="submit" value="Đăng ký">
                </div>
            <div class="note-happy-service">
                    <h3>Một số lưu ý về dịch vụ*</h3>
                    <p>-Bắt buộc phải điền thông tin đầy đủ trên form</p>
                    <p>-Mô tả về vật nuôi của bạn chính xác</p>
                    <p>-thời gian sẽ có nhân viên gọi trực tiếp và hướng dẫn đặt hẹn</p>
                    <p>-Xin cảm ơn-</p>
            </div>
            </div>
        </div>
        <div class="bottom-class">
            <p>-Sau khi nhận được thông tin nhân viên sẽ liên hệ với bạn,vui lòng kiểm tra điện thoại của bạn để không bỏ lỡ cuộc gọi từ Petlands nhé</p>
        </div>
    </div>  
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('.menu_toggle').click(function(){
    			$('.menu_toggle').toggleClass('active')
    			$('nav').toggleClass('active')
    		})
    	})
    </script>
</body>

</html>
<?php
include("config.php");
if (isset($_POST["submit"])){
    $id = $roww["id"];
   $ten_dv = $_POST["ten"];
   $mota_dv = $_POST["mota"];
   $sql = mysqli_query($con,"SELECT * from service WHERE ten_dv='Dịch Vụ Trông Giữ Thú Cưng' AND id='$id'");
   if (mysqli_num_rows($sql)==0) {
       
   $query = mysqli_query($con,"INSERT INTO service(id,ten_dv,mota_dv,trangthai_dv,ngaydat_dv) VALUES ('$id','$ten_dv', '$mota_dv', 'Đang xử lý', current_timestamp())");
   if ($query==true) {
    header("refresh:1;url =protect_service.php");
       echo "<script>Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Đăng ký dịch vụ thành công   Nhân viên sẽ liên hệ và hỗ trợ khách hàng về thời gian (xin kiên nhẫn)',
              showConfirmButton: false,
              timer: 3500
                })</script>";
            
   }
   else
   {
    echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Vui lòng kiểm tra lại thông tin :(',
                            'error'  
                                )
                        </script>";
            header("refresh:1;url =protect_service.php");
   }
}else
{
    echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Bạn đã đăng ký dịch vụ này rồi :(',
                            'error'  
                                )
                        </script>";
            header("refresh:1;url =protect_service.php");
}
}
?>