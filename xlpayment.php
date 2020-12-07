<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" type="text/css" href="ncss/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="sweetalert/sweetalert2.all.min.js"></script>
</head>
<body>
	

<?php
include("config.php");
/*if (isset($_GET["idkh"]) && isset($_GET["total"])) {
	$idkh = $_GET["idkh"];
	$total = $_GET["total"];
	$query = "select * from cart_client where id = '$idkh'";
	$getProduct = mysqli_query($con,$query);
	if ($getProduct) {
		while ($result = mysqli_fetch_array($getProduct)) {
			$id_sp = $result["id_sp"];
			$tensp = $result["tensp_cart"];
			$giasp = $result["giasp_cart"];
			$imgsp = $result["imgsp_cart"];
			$insertOderdetail = "insert into order_details(id_sp,id,ten_sp,gia_sp,img_sp) values('$id_sp','$idkh','$tensp','$giasp','$imgsp')";
			if(mysqli_query($con,$insertOderdetail))
			{
				$delCart = "delete from cart_client where id ='$idkh'";
				if(mysqli_query($con,$delCart)){
					//tới đây nhập đơn hàng
					$getInforpayment = "select * from account_client,order_details WHERE account_client.id='$idkh' AND order_details.id='$idkh'";
					$Infor = mysqli_query($con,$getInforpayment);
					if ($Infor) {
						$InforIs = mysql_fetch_array($Infor);
						$id = $InforIs["id"];
						$diachi = $InforIs["diachi"];
						$diachi2 = $InforIs["diachi2"];
						$inOrder = "insert into `order` (`id`, `diachi`, `order_date`, `order_status`, `order_total`) VALUES ('$id', '$diachi', current_timestamp(), 'đang xử lý', '$total')";
						if (mysqli_query($con,$inOrder)) {
							echo "thành công";
						}else
						{
							echo "đã có lỗi xảy ra";
						}

					}else
					{
						echo "có lỗi";
					}
				}
				
			}

		}
	}
}*/

/*if (isset($_POST["submit"])) {
    $idkh = $_POST["idkh"];
    $tenkh = $_POST["txtten"];
    $diachi = $_POST["diachi"];
    $tp = $_POST["city"];
    $sdtkh = $_POST["sdt"];
    $emailkh = $_POST["email"];
    $dckhac = $_POST["checkbox"];
    $diachi2 = $_POST["diachi2"];
    $total = $_POST["total"];
    $httt = $_POST["check"];

    echo $idkh."<br>";
    echo $tenkh."<br>";
    echo $diachi."<br>";
    echo $tp."<br>";
    echo $sdtkh."<br>";
    echo $emailkh."<br>";
    echo $dckhac."<br>";
    echo $diachi2."<br>";
    echo $total."<br>";
    echo $httt;exit;
    
}
**/


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
    if (isset($_POST["submit"])) {
    $idkh = $_POST["idkh"];
     $tenkh = $_POST["txtten"];
     $diachi = $_POST["diachi"];
     $tp = $_POST["city"];
     $sdtkh = $_POST["sdt"];
     $emailkh = $_POST["email"];
     $total1 = $_POST["total"];
     $total2 = $total1+30000;
     $httt = $_POST["check"];
     $ngaygiao = date('d-m-Y',strtotime('+5 day'));
     $order_id = rand(1,10000);
     
 //lấy địa chỉ khách hàng
 $insertPro = "INSERT INTO `order` (`order_id`,`id`,`date_ship`, `order_status`, `order_total`,`httt`) VALUES ('$order_id','$idkh','$ngaygiao','đang xử lý','$total2','$httt')";
                           
 //thêm vào order
 if(mysqli_query($con,$insertPro)){//ngoặc 2
     
 	$insertdetail = mysqli_query($con,"SELECT * FROM account_client ac JOIN cart_client c on ac.id=c.id JOIN product_show pr on c.id_sp=pr.id_sp WHERE pr.available>c.sl_cart and ac.id='$idkh'");
 	if($insertdetail){//ngoặc 3
        
 	while($row = mysqli_fetch_array($insertdetail)){
 		$id_sp = $row["id_sp"];
 		$ten_sp = $row["tensp_cart"];
 		$gia_sp = $row["giasp_cart"];
 		$img_sp = $row["imgsp_cart"];
         $sl_sp = $row["sl_cart"];
         $order_id2 = $order_id;
 		
                       
 	$insertOderdetail = "INSERT INTO order_details (order_id, id_sp, ten_sp,sl_sp,gia_sp,img_sp) VALUES ('$order_id2','$id_sp','$ten_sp','$sl_sp','$gia_sp','$img_sp')";
 		if(mysqli_query($con,$insertOderdetail)) {
             $Slton = mysqli_query($con,"SELECT * FROM order_details,product_show WHERE order_details.id_sp='$id_sp' AND product_show.id_sp='$id_sp'");
             while ($viewSlton = mysqli_fetch_array($Slton)){
                 $available = $viewSlton["available"];
             $tru = $available-$sl_sp;
             $updateSlton ="update product_show set available='$tru' where id_sp='$id_sp'";
             if (mysqli_query($con,$updateSlton)) {
             //ngoặc 4
 			$queryPro = "delete from cart_client where id = '$idkh'";
 			if(mysqli_query($con,$queryPro)){
                $v_account = mysqli_query($con,"select * from account_client where id='$idkh'");
                $fetch = mysqli_fetch_array($v_account);
                $tongmua = $fetch["tongmua"];
                $new = $tongmua + ($total2 -30000);
             $insertKh = "UPDATE account_client SET hoten='$tenkh', diachi='$diachi',sdt='$sdtkh',tongmua='$new' WHERE id='$idkh'";
             if(mysqli_query($con,$insertKh)){//ngoặc 5
             echo "<script>Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: 'Đặt hàng thành công',
  showConfirmButton: false,
  timer: 3000
    })</script>";
	header("refresh:2;url=cart.php");
             }
   }                  
 }}

                        
                        
 }
}
////////////////////đây là phân vùng gửi mail
$export1 = mysqli_query($con,"SELECT * FROM `order` o JOIN `account_client` a on o.`id`=a.`id` WHERE order_id='$order_id'");
                $push = mysqli_fetch_array($export1);
                $time = $push["order_date"];
                $ordertime  = date("d-m-Y",strtotime($time));
$pet = 'Petlands';


$content = "<div style='width:100%;display:block;box-sizing:border-box;'>";
$content .="<h1 style='text-align:left;font-size:17px;'>Thông tin về đơn hàng của bạn ".$push["order_id"]."</h1>";
$content.= '<h4 style="text-align:left;">Họ và tên:'. $tenkh .'</h4>';
$content.= '<h4 style="text-align:left;">Số điện thoại:'. $sdtkh.'</h4>';
$content.=  '<h4 style="text-align:left;">Email:'. $emailkh .'</h4>';
$content.='</div>';
$content .= "<table style='width:100%;text-align: center;align-items: center;box-sizing:border-box;'>";
$content .= "<tr>
    <td style='background-color: #b2bec3;padding: 20px;'>Sản Phẩm</td>
    <td style='background-color: #b2bec3;padding: 20px;'>Số Lượng</td>
    <td style='background-color: #b2bec3;padding: 20px;'>Gía Tiền</td>
</tr>";

$export2 = mysqli_query($con,"select * from order_details where order_id='$order_id'");
while ($push2 = mysqli_fetch_array($export2)) {
$content .= "<tr>
    <td style='background: #dfe4ea;padding: 20px;'>".$push2["ten_sp"]."</td>
    <td style='background: #dfe4ea;padding: 20px;'>x ".$push2["sl_sp"]."</td>
    <td style='background: #dfe4ea;padding: 20px;'>".number_format($push2["gia_sp"],0,",",".")." đ</td>
</tr>";

}
$content .= "</table>";
$content .='<div style="width:100%;display:block;box-sizing:border-box;">
<p style="text-align:left;color:blue;">Tổng : '. number_format($push["order_total"]-30000,0,",",".").' đ</p>
            <p style="text-align:left;">Giao hàng: 30.000 đ(Tiêu Chuẩn)</p>
            <p style="text-align:left;color:red;">Tổng Thanh toán: <strong>'. number_format($push["order_total"],0,",",".").' đ</strong></p>
            <p style="text-align:left;">Hình Thức Thanh Toán: <strong>'. $push["httt"] .'</strong></p>
            <p style="text-align:left;">(Đối với hình thức thanh toán là chuyển khoản ngân hàng<br>
                                        khách hàng vui lòng gửi tiền về số tài khoản ACB 15039427 
                                        kèm theo nội dung là -Đơn hàng :'.$push["order_id"].'-)</p>
            <p style="text-align:left;">Ngày đặt hàng:'.$ordertime.'</p>
            <p style="text-align:left;">Giao hàng dự kiến:'.$push["date_ship"].'</p>
            <p style="text-align:left;">Vận chuyển đến:'.$push["diachi"].'</p><br>
            <p style="text-align:left;">Đây là email xác nhận được gửi từ Petlands Qúy khách nếu có bất cứ vấn đề gì <br>vui lòng liên hệ qua Fanpage của Petlands theo đường dẫn https://www.facebook.com/NHP1492/<br>
            Theo dõi Instagram của Petlands tại đây:https://www.instagram.com/phucnguyen0006/<br>
            Theo dõi Twitter của Petlands tại đây:https://twitter.com/NguynHu45975471</p>

            <p style="text-align:left;">Petlands xin chúc quý khách có một ngày mới vui vẻ <3</p>
            <hr style="margin-bottom: 20px;width:100%;">
            </div>';










//////đóng phân vùng gửi mail
////////////////////Gửi meil chi tiết đơn
    require "vendor/autoload.php";
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->CharSet = 'UTF-8';
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'petlandsfamily@gmail.com';                 // SMTP username
                    $mail->Password = '123456phucP';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                    //Recipients
                    $mail->setFrom('petlandsfamily@gmail.com',$pet);
                    $mail->addAddress($emailkh);     // Add a recipient | name is option
                    $mail->addReplyTo('petlandsfamily@gmail.com', $pet);
//                    $mail->addCC('CCemail@gmail.com');
//                    $mail->addBCC('BCCemail@gmail.com');
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Thông tin về đơn hàng của bạn từ Petlands';
                    $mail->Body = $content;
                    $mail->AltBody = 'Được tạo tự động bởi Petlands'; //None HTML
                    $result = $mail->send();
                    if (!$result) {
                        $error = 'Có lỗi xảy ra trong quá trình gửi mail';
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

//////////////////////đóng
                    }}
                        }//end ngoặc 3
 else
 {
     echo " <script>
             Swal.fire({
               icon: 'error',
               title: 'Có Lỗi...',
               text: 'Chuyện gì đó đã xảy ra!'
               
             })
             </script>";
             header("refresh:2;url = cart.php");
 }
                        //end ngoặc 2



?>
	
</body>
</html>
