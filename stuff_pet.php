
<?php
 include("config.php"); 
 session_start();
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="ncss/demo.css">
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
            $result = mysqli_query($con,"select * from account_client where taikhoan = '$email'");
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
<div class="all-appear">
    <div class="header-appear">
        <h1>sản phẩm mới</h1>
        <p>Bên dưới là tổng hợp tất cả các sản phẩm bao gồm thức ăn,vật dụng được Petsland cập nhật và đưa đến cho khách hàng trải nghiệm,thông tin chi tiết quý khách vui lòng ấn vào hình ảnh nhé.<br>
        Chúc khách hàng của Petsland có một trải nghiệm mua sắm tuyệt vời ạ.</p>
        <hr>
        <div class="option-appear">
            <table>
                <tr>
                    <td><a href="food_pet.php?khuyenmai=khuyenmai">hàng khuyến mãi</a></td>
                    <?php
                    include("config.php");
                    $f = mysqli_query($con,"select * from category");
                    while ($v = mysqli_fetch_array($f)) {
                        echo '
                        <td><a href="food_pet.php?cate='.$v["id_cate"].'">'.$v["name_cate"].'</a></td>';

                    }
                    ?>
                    
                    
                </tr>
            </table>
        </div>

</div>
    <div class="appear-pr">
        <div class="content">
            <?php
            include("config.php");
            $result33 = mysqli_query($con,"select * from account_client,product_show where account_client.taikhoan ='$name_tk' and product_show.id_cate=3");
            while ($rown = mysqli_fetch_array($result33)) {
            echo"
                            <div class='box'>
                            <a href='food_pet.php?xem=".$rown["id_sp"]."'><img src='img-vid/".$rown["img_sp"]."' ></a>
                            <p>".$rown["name_sp"]."</p><p><b style='color:red;'>".number_format($rown["price_sp"],0,",",".")." VNĐ</b></p>
                            <div class='box2'>
                                <a href='add_cart.php?id_sp=".$rown["id_sp"]."&id=".$rown["id"]."'>
                                <div class='button'>
                                    Đặt hàng
                                </div>  
                                    </a>
                                    </div>
                            </div>";
                        }
                            ?>
                </div>
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