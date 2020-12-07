<?php
session_start();
include("config.php"); ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/happy_service.css">
<link rel="stylesheet" type="text/css" href="ncss/cart.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>
<head>
    <title>Giỏ hàng</title>
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
    <div class="info-left">
            <h1>Giỏ Hàng</h1>
            <div class="table-cart">
                <table border="0" id="a">
                    <th colspan="3">Thông tin sản phẩm trong giỏ</th>
                    <tr id="menu">
                        <td colspan="2" bgcolor="#222f3e"></td>
                        <td bgcolor="#222f3e">Tên Sản Phẩm</td>
                        <td bgcolor="#222f3e">Giá</td>
                        <td bgcolor="#222f3e">Số lượng</td>
                        <td bgcolor="#222f3e">Tạm tính</td>
                    </tr>

                  <?php
                    include("config.php");
                    if (isset($_GET["id_update"])) {
                        $sl_cart = $_POST["sl_sp"];
                        $id_sp = $_GET["id_update"];
                        $update = "update cart_client set sl_cart='$sl_cart' where id_sp='$id_sp' ";
                        if (mysqli_query($con,$update)) {
                            echo "<script>
                                Swal.fire(
                                'Đã cập nhật',
                            'Số lượng đã được cập nhật :)',
                            'success'  
                                )
                        </script>";
                        header("refresh:1.2;url=cart.php");
                        }
                        else
                        {
                            echo "<script>
                                Swal.fire(
                                'lỗi',
                            'Vui lòng kiểm tra lại :(',
                            'error'  
                                )
                        </script>";
                        }
                    }
                    ?>
                    <?php
                    include("config.php");
                    if(isset($_GET["id_spdel"])){
                        $id_sp = $_GET["id_spdel"];
                        mysqli_query($con,"delete from cart_client where id_sp ='$id_sp'");
                        echo "<script>
                                Swal.fire(
                                'Đã xóa',
                            'Sản phẩm đã được xóa :)',
                            'success'  
                                )
                        </script>";
                        header("refresh:2;url=cart.php");
                    }
                    ?>
                    <?php
                    include("config.php");
                    $nhan2 = mysqli_query($con,"SELECT * FROM account_client ac JOIN cart_client c on ac.id=c.id JOIN product_show pr on c.id_sp=pr.id_sp WHERE ac.id='$id'");
                    if (!empty($nhan2)) {
                            $total1 = 0;
                                
                                while ($view = mysqli_fetch_array($nhan2)){
                                     $id_sp = $view["id_sp"];
                                     $slton = $view["available"];
                                     $slmua = $view['sl_cart'];
                                     if ($slton<$slmua) {
                                         ?>
                        <tr id="top">
                        <td><a style='text-decoration:none;' class='delete_button' href='cart.php?id_spdel=<?= $id_sp ?>'><i class='fa fa-trash' aria-hidden='true'></i></a></td>
                        </td>
                        <td><img src="img-vid/<?= $view['imgsp_cart'] ?>" height="100px" width="100px"/></td>
                        <td style="color: #576574;"><?= $view['tensp_cart']?> x <?= $view['sl_cart'] ?></td>
                        <td style="color: #576574;"><?= number_format($view['giasp_cart'],0,",",".") ?><span>₫</span></td>
                        <td style="color: #576574;"><form method="post" action="cart.php"><input id="num" type="text" min="1" max="10" name="sl_sp" value="Hết hàng" readonly="" />
                            <p>Chỉ còn <?= $slton ?> sản phẩm</p></form></td>
                        <td style="color: #ee5253;"><?= number_format($total1,0,",",".")  ?><span>₫</span></td>
                    </tr>
                                         <?php
                                     }else{
                                    ?>
                   
                    <tr id="top">
                        <td><a style='text-decoration:none;' class='delete_button' href='cart.php?id_spdel=<?= $id_sp ?>'><i class='fa fa-trash' aria-hidden='true'></i></a></td>
                        </td>
                        <td><img src="img-vid/<?= $view['imgsp_cart'] ?>" height="100px" width="100px"/></td>
                        <td style="color: #576574;"><?= $view['tensp_cart'] ?> x <?= $view['sl_cart'] ?></td>
                        <td style="color: #576574;"><?= number_format($view['giasp_cart'],0,",",".") ?><span>₫</span></td>
                        <td style="color: #576574;"><form method="post" action="cart.php?id_update=<?= $id_sp ?>"><input id="num" type="number" min="1" max="10" name="sl_sp" id="sl_sp_<?= $id_sp ?>" value="<?= $view['sl_cart']['$id_sp']?>" /><input type="submit" name="update" value="Cập nhật"></form></td>
                        <?php
                        $total1 = $view['giasp_cart'] * $view['sl_cart'];
                        ?>
                        <td style="color: #ee5253;"><?= number_format($total1,0,",",".")  ?><span>₫</span></td>
                    </tr>
                    <?php
                        $totaln += $total1; 
                        $diachi =$view['diachi'];
                }}
                    ?>
                    <tr id="up" bgcolor="#222f3e">
                        <td colspan="6" bgcolor="#222f3e"></td>
                    </tr>
               
                </table>
                <div class="payment">
                    <h3>Cộng giỏ hàng</h3>
                    <table border="0" id="b">
                        <form method="post" action="payment.php">
                        <tr>
                            <td bgcolor="#222f3e">Tạm tính</td>
                            <td id="text-left" style="color: #576574;"><?= number_format($totaln,0,",",".") ?><span>₫</span></td>
                            <input type="hidden" name="tamtinh" value="<?= number_format($totaln,0,",",".") ?>">
                        </tr>
                        <tr>
                            <td bgcolor="#222f3e">Giao hàng</td>
                            <td id="text-left" style="color: #576574;">Phí Vận Chuyển:30.000(Tiêu chuẩn)</td>
                        </tr>
                        <tr>
                            <td bgcolor="#222f3e">Vận chuyển đến</td>
                            <td id="text-left" style="color: #576574;"><span><?php if($diachi){
                                echo $diachi;
                            }else
                            {
                                echo "cập nhật trong tài khoản";
                            } ?></span></td>
                            <input type="hidden" name="diachi" value="<?= $diachi ?>">
                        </tr>
                        <tr>
                            <td bgcolor="#222f3e" ></td>
                            <td id="text-left" style="color: #576574;"><a href="#" id="changeip">Đổi địa chỉ</a></td>
                        </td>
                        <tr>
                            <td bgcolor="#ee5253">Tổng</td>
                            <td id="text-left" style="color: #576574;">
                                <?php
                                 if ($total1 == 0) {
                                        echo "0";
                                    }else{
                                        $total2 = $totaln +30000;
                                       echo number_format($total2,0,",",".");
                                    }
                                    ?>

                                    <span>₫</span></td>
                                    <input type="hidden" name="total2" value="<?= $total2 ?>">
                        </tr>
                        <tr>
                            <td id="payment-td" bgcolor="#34495e" colspan="2"><a class="xn" href="payment.php?idkh=<?= $id?>&total=<?=$totaln?>" id="btn-payment">Thanh toán ngay<i class="fa fa-arrow-right" aria-hidden="true"></i></a></td>
                        </tr>
                        </form>
                    </table>
                    <?php
                        }
                    ?>
                 
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('.menu_toggle').click(function(){
    			$('.menu_toggle').toggleClass('active')
    			$('nav').toggleClass('active')
    		})
    	})
    </script>
    <script type="text/javascript">
    $('.delete_button').click(function(e){


        var result = confirm("Bạn có chắc là muốn xóa chứ?");
        if(!result) {
            e.preventDefault();
            Swal.fire(
            'Cancelled',
            'Đã Hủy Thao tác :)',
            '!...'
    )
        }
    })
</script>
<script type="text/javascript">
    function update(){
        var newsl = document.form.sl_sp.value()
        alert("newsl");
    }
</script>
</body>

</html>