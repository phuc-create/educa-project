<?php
 include("config.php"); 
 session_start();
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="ncss/demo.css">
<link rel="stylesheet" type="text/css" href="ncss/show.css">
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
            	echo "0";
            }
            ?></span></a></li>
            <li><a href="trangchu.php#contactus">LIÊN HỆ</a></li>
            <li><div class="dropdown">
                <button class="dropbtn">
                    <a href="trangchu.php">
                          
                            <?php
                                echo "Xin chào ".$name_tk;
                            
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
		<h1>Khu Vực Mua Sắm</h1>
		<p>Bên dưới là tổng hợp tất cả các sản phẩm bao gồm thức ăn,vật dụng được Petsland cập nhật và đưa đến cho khách hàng trải nghiệm,thông tin chi tiết quý khách vui lòng ấn vào hình ảnh nhé.<br>
		Chúc khách hàng của Petsland có một trải nghiệm mua sắm tuyệt vời ạ.</p>
		<hr>
        <div class="search"><form method="post" action="food_pet.php"><input type="text" name="search" placeholder="tìm kiếm sản phẩm"></form></div>
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
        
		<?php
			include("config.php");
			if (isset($_GET["xem"])) {
				$idxem = $_GET["xem"];
				$xem = mysqli_query($con,"select * from account_client,product_show where account_client.email ='$email' and product_show.id_sp='$idxem'");
				$infor = mysqli_fetch_array($xem);
                $sup = $infor["id_spli"];
                $ncc = mysqli_query($con,"select * from supplier where id_spli='$sup'");
                $view = mysqli_fetch_array($ncc);

echo"
				<div class='container2'>
        <div class='img-p'>
            <img src='img-vid/".$infor["img_sp"]."'>
        </div>
        <div class='infor-p'>

            <h1 class='h1'><strong>Petsland</strong></h1>
            <p id='boss'>Tên sản phẩm:".$infor["name_sp"]." | SKU:47".$infor["id_sp"]."</p>

            <h3 id='gia'>Gía sản phẩm: ".number_format($infor["price_sp"],0,",",".")." VNĐ</h3><p><strike>".number_format($infor["km"],0,",",".")." VNĐ</strike></p>
            <P id='gia'>Giao hàng:30.000(Tiêu chuẩn)</P>
            <p id='brand'>Được cung cấp bởi : ".$view["company_name"]."</p>
            <p>Hiện còn ".$infor["available"]."</p>
            <form method='POST' action='add_cart.php?idkh=".$infor["id"]."&oninfor_id=".$infor["id_sp"]."'>
                <input type='number' min='1' max='100' name='slmua' value='1'>
                <button type='submit' class='add'><i class='fa fa-cart-plus' aria-hidden='true'></i></button>

            </form>
            <hr>
            <p id='mota'>Mô tả sản phẩm:</p>
            <p id='mota2'>-".$infor["describe_sp"]."</p>
            <p id='brand2'>Thương hiệu Royal Canin Là một thương hiệu nổi tiếng chuyên cung cấp sản phẩm về thức ăn dành cho thú nuôi,chúng tôi đã hợp tác và đem về đây nguồn thức ăn dinh dưỡng và dồi dào dành cho thú cưng của bạn theo với nhiều sự lựa chọn và
                đảm bảo chất lượng
                </p>
                <p id='brand2'>
                Là sản phẩm được cung cấp bởi: ".$view["company_name"]."<br>
                Địa chỉ: ".$view["address"]."<br>
                Email: ".$view["email"]."<br>
                </p>


        </div>
    </div>
    <h1 text-align='center'>CÁC SẢN PHẨM KHÁC</h1>";
}
    
    	?>
    
    <div class="content">
        <?php
            include("config.php");
            if (isset($_POST["search"])) {
                $search = $_POST["search"];
            $result33 = mysqli_query($con,"select * from account_client,product_show where account_client.email ='$email' and product_show.name_sp like '%$search%'");
            echo '<h1 align="center">Kết quả cho sản phẩm: "'.$_POST["search"].'"</h1>';
            while ($rown = mysqli_fetch_array($result33)) {
            echo"            
                            <div class='box'>
                            <a href='food_pet.php?xem=".$rown["id_sp"]."'><img src='img-vid/".$rown["img_sp"]."' ></a>
                            <p>".substr($rown["name_sp"], 0,20)."...</p><p><b style='color:red;'>".number_format($rown["price_sp"],0,",",".")." VNĐ</b></p>
                            <div class='box2'>
                                <a href='add_cart.php?id_sp=".$rown["id_sp"]."&id=".$rown["id"]."'>
                                <div class='button'>
                                    Đặt hàng
                                </div>  
                                    </a>
                                    </div>
                            </div>
                            ";
                        }
                    }
                            ?>
    	<?php
    	if (isset($_GET["xem"])) {

    	
    	$another = mysqli_query($con,"select * from account_client,product_show   where account_client.email ='$email' ORDER BY rand() LIMIT 6");
    while ($app = mysqli_fetch_array($another)) {
 
    	echo"
    		<div class='box'>
							<a href='food_pet.php?xem=".$app["id_sp"]."'><img src='img-vid/".$app["img_sp"]."' ></a>
							<p>".substr($app["name_sp"], 0,20)."...</p><p><b style='color:red;'>".number_format($app["price_sp"],0,",",".")." VNĐ</b></p>
							<div class='box2'>
								<a href='add_cart.php?id_sp=".$app["id_sp"]."&id=".$app["id"]."'>
								<div class='button'>
									Đặt hàng
								</div>	
									</a>
									</div>
							</div>";
						}
}
			?>
		
			
			<?php
			include("config.php");
			if (isset($_GET["cate"])) {
				$cate = $_GET["cate"];
			$result33 = mysqli_query($con,"select * from account_client,product_show where account_client.email ='$email' and product_show.id_cate='$cate'");
			while ($rown = mysqli_fetch_array($result33)) {
			echo"
                			<div class='box'>
							<a href='food_pet.php?xem=".$rown["id_sp"]."'><img src='img-vid/".$rown["img_sp"]."' ></a>
							<p>".substr($rown["name_sp"], 0,20)."...</p><p><b style='color:red;'>".number_format($rown["price_sp"],0,",",".")." VNĐ</b></p>
							<div class='box2'>
								<a href='add_cart.php?id_sp=".$rown["id_sp"]."&id=".$rown["id"]."'>
								<div class='button'>
									Đặt hàng
								</div>	
									</a>
									</div>
							</div>";
						}
					}
							?>

		
							<?php
			include("config.php");
			if (isset($_GET["khuyenmai"])) {
				$dog = $_GET["khuyenmai"];
			$all = mysqli_query($con,"SELECT * FROM product_show,account_client WHERE account_client.email='$email' and product_show.km >1");
			while ($rown = mysqli_fetch_array($all)) {
			echo"
                			<div class='box'>
							<a href='food_pet.php?xem=".$rown["id_sp"]."'><img src='img-vid/".$rown["img_sp"]."' ></a>
							<p>".substr($rown["name_sp"], 0,20)."...</p><p><b style='color:red;'>".number_format($rown["price_sp"],0,",",".")." VNĐ</b> <strike>".number_format($rown["km"],0,",",".")." VNĐ</strike></p>
							<div class='box2'>
								<a href='add_cart.php?id_sp=".$rown["id_sp"]."&id=".$rown["id"]."'>
								<div class='button'>
									Đặt hàng
								</div>	
									</a>
									</div>
							</div>";
						}
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