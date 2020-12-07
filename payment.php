<?php
 include("config.php"); 
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/style.css">
<link rel="stylesheet" type="text/css" href="ncss/taikhoan.css">
<link rel="stylesheet" type="text/css" href="ncss/stylett.css">
<!--<link rel="stylesheet" type="text/css" href="ncss/style2.css">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <title>Thanh toán</title>
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
<div class="infor-payment">
            <div class="num1">
                <?php
                    include("config.php");
                    if (isset($_GET["idkh"]) && isset($_GET["total"])) {
                        $idkh = $_GET["idkh"];
                        $total = $_GET["total"];
                        $inforkh = mysqli_query($con,"select * from account_client WHERE id='$idkh'");
                        $row = mysqli_fetch_array($inforkh);
                        $ten = $row["hoten"];
                        $diachi = $row["diachi"];
                        $sdt = $row["sdt"];
                        $diachi2 = $row["diachi2"];
                        $email = $row["email"];
                        $tongmua = $row["tongmua"];
                    
                ?>
                    <form method="post" action="xlpayment.php">
                        <input type="hidden" name="idkh" value="<?= $idkh ?>">
                        
                    <h3>Thông tin thanh toán</h3>
                    <p id="text-output">Tên*</p>
                    <p><input type="text" name="txtten" id="full-width" placeholder="tên của bạn" value="<?= $ten ?>" required=""></p>
                    
                    
                    
                    <p id="text-output">Địa chỉ*</p>
                    <p><input type="text" name="diachi" placeholder="Nhập địa chỉ của bạn" value="<?= $diachi ?>" required="" id="full-width"/></p>
                    
                    <p id="text-output">Tỉnh/Thành phố*</p>
                    <p><input type="text" name="city" id="full-width" required="" placeholder="vd:Hồ Chí Minh"></p>
                    <p id="text-output">Số điện thoại</p>
                    <p><input type="text" name="sdt" id="full-width" required="" value="<?= $sdt ?>" placeholder="nhập vào chính xác số điện thoại của bạn"/></p>
                    <p id="text-output">Địa chỉ Email*</p>
                    <p><input type="text" name="email" id="full-width" placeholder="Ví dụ:petsland@gmail.com" value="<?= $email ?>" required=""/></p>
            </div>
            <div class="num2">
                <h3>Đơn hàng của bạn</h3>
                <table >
                    <tr>
                        <td bgcolor="#dfe4ea">Sản phẩm</td>
                        <td bgcolor="#dfe4ea">Tạm tính</td>
                    </tr>
                    <?php
                    include("config.php");
                    $query = mysqli_query($con,"SELECT * FROM account_client ac JOIN cart_client c on ac.id=c.id JOIN product_show pr on c.id_sp=pr.id_sp WHERE ac.id='$idkh'");
                    while ($row2 = mysqli_fetch_array($query)) {
                                    $id_sp = $row2["id_sp"];
                                    $slton = $row2["available"];
                                    $slmua = $row2['sl_cart'];
                        $tam = $row2["giasp_cart"] * $row2["sl_cart"];
                        if ($slton<$slmua) {
                        echo" ";
                        }else{
                        echo"
                        <tr>
                        <td>".$row2["tensp_cart"]." x".$row2["sl_cart"]."</td>
                        <td>".number_format($tam,0,",",".")."₫</td>
                        </tr>
                        ";
                        }}
                        ?>
                    
                    <tr>
                        <td bgcolor="#dfe4ea">Tạm tính</td>
                        <td>
                            <?php if ($tongmua>=2000000 && $tongmua <=4999999) {
                            $new_price = (98*$total)/100;
                            echo number_format($new_price,0,",",".")."₫ <br> Đơn hàng của bạn được giảm 2%";
                        }elseif ($tongmua>=5000000 && $tongmua <=7999999) {
                            $new_price = (95*$total)/100;
                            echo number_format($new_price,0,",",".")."₫ <br> Đơn hàng của bạn được giảm 5%";
                        }elseif ($tongmua>=8000000 && $tongmua <=9999999) {
                            $new_price = (92*$total)/100;
                            echo number_format($new_price,0,",",".")."₫ <br> Đơn hàng của bạn được giảm 8%";
                        }elseif ($tongmua>=10000000) {
                            $new_price = (90*$total)/100;
                            echo number_format($new_price,0,",",".")."₫ <br> Đơn hàng của bạn được giảm 10%";
                        } else{
                            $new_price = $total;
                            echo number_format($new_price,0,",",".")."₫ ";
                        }   
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#dfe4ea">Giao hàng</td>
                        <td>Đồng giá:30.000 ₫</td>
                    </tr>
                    <tr>
                        <td bgcolor="#dfe4ea">Tổng thanh toán</td>
                        <td><?= number_format($new_price+30000,0,",",".") ?></td>
                        <input type="hidden" name="total" value="<?= $new_price ?>">
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <table>
                    <tr>
                        <td bgcolor="#dfe4ea"><input type="radio" name="check" value="Chuyển Khoản Ngân Hàng" required="">&nbsp Chuyển khoản ngân hàng</td>
                    </tr>
                    <tr>
                    	<td><textarea type="text" name="" readonly=""  >Khách hàng vui lòng chuyển tiền đến 
Số tài khoản ACB 15039427
Chủ tài khoản Nguyễn Hữu Phúc
Với nội dung là mã hóa đơn khi đã đặt hàng
Đơn hàng sẽ được xử lý khi khách hàng đã chuyển tiền
Sẽ có sms hỗ trợ khi quý khách đã đặt hàngvà thanh toán bằng ngân hàng</textarea></td>
                    </tr>
                    <tr>
                        <td bgcolor="#dfe4ea"><input type="radio" name="check" required="" value="Thanh Toán Khi Nhận Hàng">&nbsp Trả tiền mặt khi nhận hàng</td>
                    </tr>
                    <tr>
                        <td><textarea type="text" name="" readonly="" >Khi nhấn vào đặt hàng đồng nghĩa với việc bạn đồng ý với tất cả điều khoản của petsland,chúng tôi sẽ sử dụng thông tin thanh toán của bạn để xác nhận việc giao hàng.Xin cảm ơn</textarea></td>
                    </tr>
                    <tr>
                        <td><p>ấn vào <a style="text-decoration: none; color: #6d6d6d" href="https://nama.vn/pages/dieu-khoan-va-dieu-kien-giao-dich-mua-ban-hang-hoa">đây</a> để xem chi tiết điều khoản</p></td>
                    </tr>
                </table>
                
                    <input type="submit" name="submit" value="ĐẶT HÀNG">
            </div>
        </form>
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