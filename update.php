<?php
 include("config.php"); 
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/style.css">
<link rel="stylesheet" type="text/css" href="ncss/taikhoan.css">
<!--<link rel="stylesheet" type="text/css" href="ncss/style2.css">-->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert/sweetalert2.all.min.js"></script>

<head>
    <title>Petlands</title>
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
                                echo "null!!!";
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
    <div class="form_add">
        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = mysqli_query($con,"select * from account_client where id = '$id'");
            while ($row = mysqli_fetch_array($result)) {
                
            
        ?>
        <form method="post" action="update.php" name="update" class="f_up">
            <h3>Thông tin tài khoản</h3>
            <div class="input_add">
                <label>Nhập Họ Và Tên<span style="color: red">*Bắt buộc</span></label>
                <input type="hidden" name="id_kh" value="<?= $row['id']?>">
                <input type="text" name="ten_kh" value="<?= $row['hoten']?>"><br>
            </div>
            <div class="input_add">
                <label>Nhập địa chỉ <span style="color: red">*Bắt buộc</span></label>
                <textarea id="h50" name="diachi_kh"><?= $row['diachi']?></textarea>
            </div>
            <div class="input_add">
                <label>Nhập số điện thoại <span style="color: red">*Bắt buộc</span></label>
                <input  type="text" name="sdt_kh" value="<?= $row['sdt']?>">
            </div>
            <h3>Đổi Mật khẩu</h3>
            <div class="input_add">
                <label>Nhập Mật Khẩu Cũ<span style="color: red">(Bỏ trống nếu không muốn thay đổi)</span></label>
                <input type="password" name="old_p"><br>
            </div>
            <div class="input_add">
                <label>Nhập Mật Khẩu Mới<span style="color: red">(Bỏ trống nếu không muốn thay đổi)</span></label>
                <input type="password" name="new_p"><br>
            </div>
            <div class="input_add">
                <label>Xác Nhận Mật Khẩu Mới<span style="color: red">(Bỏ trống nếu không muốn thay đổi)</span></label>
                <input id="h50" type="password" name="renew_p">
            </div>
            <br>
            <input type="submit" name="submit_add" value="Thay đổi ngay">
        </form>
        <?php
         }
        }
        ?>
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
<?php
include("config.php");
if (isset($_POST["submit_add"])) {
    $ten = $_POST["ten_kh"];
    $sdt = $_POST["sdt_kh"];
    $diachi = $_POST["diachi_kh"];
    $id = $_POST["id_kh"];
    $old_p = $_POST["old_p"];
    $old_p = md5($old_p);
    $new_p = $_POST["new_p"];
    $renew_p = $_POST["renew_p"];

    $listpass = mysqli_query($con,"select * from account_client where id='$id'");
    $view = mysqli_fetch_array($listpass);
    $pass = $view["matkhau"];
    if ($old_p =="" || $new_p =="" || $renew_p =="") {
        mysqli_query($con,"update account_client set hoten ='$ten',sdt = '$sdt',diachi='$diachi',khuvuc = 'Việt Nam' where id='$id'");
        header("refresh:1;url =update.php?id=".$id."");
        echo "<script>Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Đã cập nhật thông tin',
              showConfirmButton: false,
              timer: 1500
                })</script>";
    }elseif ($old_p == $pass) {
        if ($new_p == $renew_p) {
            $renew_p = md5($renew_p);
            mysqli_query($con,"update account_client set hoten ='$ten',sdt = '$sdt',diachi='$diachi',matkhau='$renew_p',khuvuc = 'Việt Nam' where id='$id'");
        header("refresh:1;url =update.php?id=".$id."");
        echo "<script>Swal.fire({
              position: 'top-center',
              icon: 'success',
              title: 'Đã cập nhật thông tin tài khoản và mật khẩu',
              showConfirmButton: false,
              timer: 1500
                })</script>";
        }else{
            echo "<script>Swal.fire({
              position: 'top-center',
              icon: 'error',
              title: 'Thông tin mật khẩu mới chưa chính xác!!!',
              showConfirmButton: false,
              timer: 1500
                })</script>";
        }
    }else
    {
        echo "<script>Swal.fire({
              position: 'top-center',
              icon: 'error',
              title: 'Thông tin mật khẩu cũ chưa chính xác!!!',
              showConfirmButton: false,
              timer: 1500
                })</script>";
    }
}
?>