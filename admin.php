<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="ncss/admin.css">
</head>

<body>
    <section>
        <div class="container">
            <div class="banner">
                <div class="logo"><a href="index.php">Petlands</a></div>
                <div class="admin"><a href="admin.html">xin chào admin</a><img height="100px" width="100px" src="img-vid/dog1.jpg"></div>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="admin.php">Dashboard</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <li><a href="addnew.php">Thêm mới</a></li>
                    <li><a href="#">Đơn hàng</a></li>
                    <li><a href="#">Khách hàng</a></li>
                </ul>
            </div>
        </div>
    </section>
    <header>
        <?php
        include("config.php");
        if(isset($_GET["id"]))
        {
            $id = $_GET["id"];
            mysqli_query($con,"delete from account_client where id = '$id'");
        }
        ?>
        <?php
        include("config.php");
        if (isset($_GET["xoasp"])) {
            $xoa = $_GET["xoasp"];
            $query1 = "delete from product_show where id_sp=".$xoa;
            if (mysqli_query($con,$query1)) {
                echo "đã xóa";
                header("refresh:1;url=admin.php");
            }
            else
            {
                echo "lỗi";
                header("refresh:1;url=admin.php");
            }
        }
        ?>
        <?php
        include("config.php");
        if (isset($_GET["xoastuff"])) {
            $xoa_at_id = $_GET["xoastuff"];
            $query = "delete from product_show where id_sp=".$xoa_at_id;
            if(mysqli_query($con,$query)) {
                echo "đã xóa";
                header("refresh:1;url=admin.php");
            }
            else
            {
                echo "lỗi";
                header("refresh:1;url=admin.php");
            }
        }
        ?>
        <div class="dashboard">
            <div class="sanpham">
                <h2>Thức ăn thú cưng </h2>
                <table border="1">
                    <tr>
                        <td bgcolor="#sdf234">ID Sản phẩm</td>
                        <td bgcolor="#sdf234">Tên sản phẩm</td>
                        <td bgcolor="#sdf234">Gía sản phẩm</td>
                        <td bgcolor="#sdf234">hình ảnh</td>
                        <td bgcolor="#sdf234">Mô tả</td>
                        <td bgcolor="#sdf234">Trạng thái</td>
                        <td bgcolor="#sdf234" colspan="2">Option</td>
                    </tr>
                    <?php 
                    include("config.php");
                    $result =mysqli_query($con,"select * from product_show where id_cate in (1,2)");
                    while($row = mysqli_fetch_array($result)){
                    echo"<tr>
                        <td>".$row["id_sp"]."</td>
                        <td>".$row["name_sp"]."(dành cho ".$row["for_sp"].")</td>
                        <td>".$row["price_sp"]."</td>
                        <td><img  src='img-vid/".$row["img_sp"]."' height='100px' width='100px'></td>
                        <td>".$row["describe_sp"]."</td>
                        <td>".$row["status_sp"]."</td>
                        <td><a href='admin.php?xoasp=".$row["id_sp"]."'>Xóa</a></td>
                        <td><a href='addnew.php?idup=".$row["id_sp"]."'>Sửa</a></td>
                    </tr>";
                    }
                    ?>
                </table>
                <h2 id="stuff">Vật dụng thú cưng </h2>
                <table border="1">
                    <tr>
                        <td bgcolor="#sdf234">ID Sản phẩm</td>
                        <td bgcolor="#sdf234">Tên sản phẩm</td>
                        <td bgcolor="#sdf234">Gía sản phẩm</td>
                        <td bgcolor="#sdf234">hình ảnh</td>
                        <td bgcolor="#sdf234">Mô tả</td>
                        <td bgcolor="#sdf234">Trạng thái</td>
                        <td bgcolor="#sdf234" colspan="2">Option</td>
                    </tr>
                    <?php 
                    include("config.php");
                    $result =mysqli_query($con,"select * from product_show where id_cate=3");
                    while($row = mysqli_fetch_array($result)){
                    echo"<tr>
                        <td>".$row["id_sp"]."</td>
                        <td>".$row["name_sp"]."</td>
                        <td>".$row["price_sp"]."</td>
                        <td><img  src='img-vid/".$row["img_sp"]."' height='100px' width='100px'></td>
                        <td>".$row["describe_sp"]."</td>
                        <td>".$row["status_sp"]."</td>
                        <td><a href='admin.php?xoastuff=".$row["id_sp"]."'>Xóa</a></td>
                        <td><a href='addnew.php?idupstuff=".$row["id_sp"]."'>Sửa</a></td>
                    </tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="cust-order">
                <div class="cust">
                    <h2 id="space30">KHÁCH HÀNG</h2>
                    <table border="1">
                        <tr>
                            <td bgcolor="#1246ed">ID khách hàng</td>
                            <td bgcolor="#1246ed">Email</td>
                            <td bgcolor="#1246ed">Tài khoản</td>
                            <td bgcolor="#1246ed" colspan="2">option</td>
                        </tr>
                        <?php
                        session_start();
                        include("config.php");
                        $results = mysqli_query($con,"select * from account_client");
                        while($row1 = mysqli_fetch_array($results)){
                        echo"
                            <tr>
                            <td>".$row1["id"]."</td>
                            <td>".$row1["email"]."</td>
                            <td>".$row1["taikhoan"]."</td>
                            <td><a href='admin.php?id=".$row1["id"]."'>Xóa</a></td>
                        </tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="order">
                    <h2 id="space30">DANH SÁCH ĐƠN HÀNG</h2>
                    <table border="1">
                        <tr>
                            <td bgcolor="#67ed781">OrderID</td>
                            <td bgcolor="#67ed781">Họ tên</td>
                            <td bgcolor="#67ed781">Địa chỉ</td>
                            <td bgcolor="#67ed781">Ngày đặt hàng</td>
                            <td bgcolor="#67ed781">Tổng thanh toán</td>
                            <td bgcolor="#67ed781">SDT-EMAIL</td>
                            <td bgcolor="#67ed781">Trạng thái</td>
                            <td bgcolor="#67ed781" colspan="2">option</td>
                        </tr>
                        <?php
                        include("config.php");
                        $order = mysqli_query($con,"select * from `order`");
                        while ($reOrder = mysqli_fetch_array($order)) {
                            
                        echo"
                        <tr>
                            <td>#".$reOrder["order_id"]."</td>
                            <td>".$reOrder["hoten_kh"]."</td>
                            <td>".$reOrder["diachi"]."</td>
                            <td>".$reOrder["order_date"]."</td>
                            <td>".number_format($reOrder["order_total"],0,",",".")."</td>
                            <td>".$reOrder["email_kh"]."<br>".$reOrder["sdt_kh"]."</td>
                            <td>".$reOrder["order_status"]."</td>
                            <td><a href='xóa'>Xóa</a></td>
                            <td><a href='Sửa'>Sửa</a></td>
                        </tr>";
                    }
                        ?>
                    </table>
                </div>

            </div>
            <div class="care">
                <h2 id="space30">DỊCH VỤ TRÔNG GIỮ THÚ CƯNG</h2>
                <table border="1">
                    <tr>
                        <td bgcolor="#5733ff">Tên DV</td>
                        <td bgcolor="#5733ff">Họ và Tên</td>
                        <td bgcolor="#5733ff">Số điện thoại</td>
                        <td bgcolor="#5733ff" width="40%">mô tả vật nuôi</td>
                        <td bgcolor="#5733ff" style="color: blue;">Trạng thái</td>
                    </tr>
                    <tr>
                        <td>Dịch Vụ Trông Giữ Thú Cưng</td>
                        <td>Nguyễn Hữu Phúc</td>
                        <td>0375990006</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae praesentium et rerum modi magnam nisi culpa magni aut, amet harum aspernatur ad qui maiores quae sint quas vel eius! Totam!</td>
                        <td>Đang xem xét</td>
                    </tr>
                </table>
            </div>
            <div class="spa">
                <h2 id="space30">DỊCH VỤ SPA THÚ CƯNG,TỈA LÔNG</h2>
                <table border="1">
                    <tr>
                        <td bgcolor="#654000">Tên DV</td>
                        <td bgcolor="#654000">Họ và Tên</td>
                        <td bgcolor="#654000">Số điện thoại</td>
                        <td bgcolor="#654000" width="40%">mô tả vật nuôi</td>
                        <td bgcolor="#654000" style="color: blue;">Trạng thái</td>
                    </tr>
                    <tr>
                        <td>Dịch Vụ SPA Thú Cưng</td>
                        <td>Nguyễn Hữu Phúc</td>
                        <td>0375990006</td>
                        <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae praesentium et rerum modi magnam nisi culpa magni aut, amet harum aspernatur ad qui maiores quae sint quas vel eius! Totam!</td>
                        <td>Đang xem xét</td>
                    </tr>
                </table>
            </div>
    </header>
</body>

</html>