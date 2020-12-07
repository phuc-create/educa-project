<?php
error_reporting("all");
include("config.php");
if(isset($_POST["submit_add"]))
{
   $name_sp =  $_POST["name_sp"];
   $price_sp =  $_POST["price_sp"];
   $describe_sp =  $_POST["describe_sp"];
   $available = $_POST["available_sp"];
   $for_sp = $_POST["for_sp"];
   $ncc = $_POST["ncc"];
   $km = $_POST["km"];
   $img_sp =  $_FILES["img_sp"]["name"];
   move_uploaded_file($_FILES["img_sp"]["tmp_name"], "img-vid/".$img_sp);
   mysqli_query($con,"insert into product_show(id_cate,id_spli,name_sp, price_sp, km,img_sp,describe_sp,available) values ('$for_sp','$ncc','$name_sp','$price_sp','$km','$img_sp','$describe_sp','$available')");
   echo "<script>alert('Đã thêm sản phẩm thành công');</script>";
   header("refresh:0.5 ;url=tables.php?food");
}
elseif(isset($_POST["up"]))
{
   $id_sp =  $_POST["id_sp"];
   $name_sp =  $_POST["name_sp"];
   $price_sp =  $_POST["price_sp"];
   $describe_sp =  $_POST["describe_sp"];
   $for_sp = $_POST["for_sp"];
   
   $km =$_POST["km"];
   $available = $_POST["available_sp"];
   
   $ex = mysqli_query($con,"update product_show 
                        set id_sp='$id_sp',
                        id_cate='$for_sp',
                        name_sp='$name_sp',
                        price_sp='$price_sp',
                        describe_sp='$describe_sp',
                        available='$available',
                        km='$km'
                         where id_sp='$id_sp'");
   if ($ex){
      echo"<script>alert('Đã Thay Đổi Thông Tin')</script>";
      header("refresh:0;url=tables.php?food");
   }else
   {
      echo"<script>alert('Opps....')</script>";
   header("refresh:0;url=tables.php?food");
}
}elseif (isset($_POST["img"])) {
  $id_sp =  $_POST["id_sp"];
  $img_sp =  $_FILES["img_sp"]["name"];
  move_uploaded_file($_FILES["img_sp"]["tmp_name"], "img-vid/".$img_sp);
   $ex = mysqli_query($con,"update product_show 
                        set 
                        img_sp='$img_sp'
                        where id_sp='$id_sp'");
   if ($ex){
      echo"<script>alert('Đã Thay Đổi Hình Ảnh')</script>";
      header("refresh:0;url=tables.php?food");
   }else
   {
      echo"<script>alert('Opps....')</script>";
   header("refresh:0;url=tables.php?food");
}
}
elseif(isset($_POST["upstuff"]))
{
   $id_sp =  $_POST["id_sp"];
   $name_sp =  $_POST["name_sp"];
   $price_sp =  $_POST["price_sp"];
   $describe_sp =  $_POST["describe_sp"];
   $status_sp = $_POST["status_sp"];
   $img_sp =  $_FILES["img_sp"]["name"];
   $km =$_POST["km"];
   move_uploaded_file($_FILES["img_sp"]["tmp_name"], "img-vid/".$img_sp);
   $ex = mysqli_query($con,"update product_show 
                        set id_sp='$id_sp',
                        name_sp='$name_sp',
                        price_sp='$price_sp',
                        img_sp='$img_sp',
                        describe_sp='$describe_sp',
                        status_sp='$status_sp',
                        category_sp='stuff',
                        km='$km' where id_sp='$id_sp'");
   if ($ex){
      echo"<script>alert('Đã Thay Đổi Thông Tin')</script>";
      header("refresh:2;url=indexadmin.php");
   }else
   {
      echo "LỖI";
   header("refresh:2;url=indexadmin.php");
}
}
elseif (isset($_POST["sb_status"]) && isset($_GET["od_id"])) {
   $order_id = $_GET["od_id"];
   $changestt = $_POST["status"];
   $update = mysqli_query($con,"update `order`set order_status='$changestt' where order_id='$order_id' ");
   if ($update) {
                  echo '<script>alert("Đã cập nhật trạng thái")</script>';
                  echo header('refresh:0;url=tablesorder.php?view-order');
                 }
                 }
                 elseif (isset($_GET["xoahd"])) {
   $id_hd = $_GET["xoahd"];
   $del_detail = mysqli_query($con,"delete from order_details where order_id='$id_hd'");
   if ($del_detail) {
                     $delhd  = mysqli_query($con,"delete from `order` where order_id='$id_hd'");
                                
                     echo '<script>alert("Đã xóa thành công hóa đơn")</script>';
                     header("refresh:0;url=tablesorder.php?view-order");
                     }
                    }
                    elseif (isset($_GET["doitt"])) {
                       $id_dv = $_GET["doitt"];
                       $trangthai = $_POST["tt_dv"];
                       $change = mysqli_query($con,"update service set trangthai_dv='$trangthai' where id_dv='$id_dv'");
                       echo '<script>alert("Đã cập nhật")</script>';
                     header("refresh:0;url=tableservice.php");
                  }elseif(isset($_POST["changenv"]) && isset($_GET["id_nv"])){
                                $id_dv = $_GET["id_nv"];
                                 $tk_nv = $_POST["tk_nv"];
                                $mk_nv = $_POST["mk_nv"];
                                $salary = $_POST["salary"];
                                $anh_nv = $_FILES["anh_nv"]["name"];
                                move_uploaded_file($_FILES["anh_nv"]["tmp_name"],"img-vid/".$_FILES["anh_nv"]["name"]);
                           
                                $diachi_nv = $_POST["diachi_nv"];
                                $email_nv = $_POST["email_nv"];
                                $sdt_nv = $_POST["sdt_nv"];
                                $gtinh_nv = $_POST["gtinh_nv"];
                                $task = $_POST["task"];
                                $changeNv = mysqli_query($con,"update employee 
                                                            set tk_nv='$tk_nv',
                                                                  mk_nv='$mk_nv',
                                                                  anh_nv='$anh_nv',
                                                                  salary='$salary',
                                                                  
                                                                  diachi_nv='$diachi_nv',
                                                                  sdt_nv='$sdt_nv',
                                                                  email_nv='$email_nv',
                                                                  gtinh_nv='$gtinh_nv',
                                                                  task='$task'
                                                                  where id_nv='$id_dv'");
                                if($changeNv){
                                    echo"<script>alert('Đã thay đổi thông tin')</script>";
                                    header("refresh:0;url=employee.php?view");
                                }
                  }
                  elseif(isset($_GET["del_nv"])){
                     $id_nv = $_GET["del_nv"];
                     $xoa_nv = mysqli_query($con,"delete from employee where id_nv='$id_nv'");
                     if($xoa_nv){
                        echo"<script>alert('Xóa thành công nhân viên')</script>";
                        header("refresh:0;url=employee.php?view");
                     }else
                     {
                        echo"<script>alert('Có lỗi')</script>";
                        header("refresh:0;url=employee.php?view");
                     }
                  }elseif (isset($_GET["del_dv"])) {
                                $id_dv = $_GET["del_dv"];
                                $sql = mysqli_query($con,"delete from service where id_dv='$id_dv'");
                                echo"<script>alert('Đã xóa khỏi danh sách dịch vụ')</script>";
                                header("refresh:0;url=tableservice.php");
                  }elseif (isset($_POST["nhomnew"])) {
                    $nhomsp = $_POST["nhomsp"];
                    $newcate = mysqli_query($con,"insert into category(name_cate) values ('$nhomsp')");
                    if($newcate){
                        echo"<script>alert('Thêm nhóm sản phẩm thành công')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }else
                     {
                        echo"<script>alert('Có lỗi')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }
                  }elseif (isset($_GET["delnhom"])) {
                    $idnhom = $_GET["delnhom"];
                    $qr = mysqli_query($con,"DELETE FROM `category` WHERE `category`.`id_cate` = '$idnhom'");
                    if ($qr) {
                      echo"<script>alert('Xóa Nhóm sản phẩm thành công')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }else
                     {
                        echo"<script>alert('Một số sản phẩm thuộc nhóm này vẫn tồn tại '\n' vui lòng xóa những sản phẩm thuộc nhóm này trước tiên')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }
                    
                  }elseif (isset($_POST["edit_ncc"])) {
                    $id_spli = $_POST["id_spli"];
                    $ten_ncc = $_POST["ten_ncc"];
                    $dc_ncc = $_POST["dc_ncc"];
                    $sdt_ncc = $_POST["sdt_ncc"];
                    $email_ncc = $_POST["email_ncc"];
                    $fax_ncc = $_POST["fax_ncc"];
                    $query = mysqli_query($con,"update supplier
                                                set company_name='$ten_ncc',
                                                address='$dc_ncc',
                                                phone='$sdt_ncc',
                                                email='$email_ncc',
                                                fax='$fax_ncc' where id_spli='$id_spli'");
                    if ($query) {
                      echo"<script>alert('Đã cập nhật nội dung nhà cung cấp')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }else
                     {
                        echo"<script>alert('kiểm tra lại nội dung trong quá trình nhập !!')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }
                  }elseif (isset($_POST["addnew_ncc"])) {
                    $ten_ncc = $_POST["ten_ncc"];
                    $dc_ncc = $_POST["dc_ncc"];
                    $sdt_ncc = $_POST["sdt_ncc"];
                    $email_ncc = $_POST["email_ncc"];
                    $fax_ncc = $_POST["fax_ncc"];
                    $query = mysqli_query($con,"insert into supplier(company_name,address,phone,email,fax)
                                                 values('$ten_ncc','$dc_ncc','$sdt_ncc','$email_ncc','$fax_ncc')");
                    if ($query) {
                      echo"<script>alert('Đã Thêm Một Nhà Cung Cấp')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }else
                     {
                        echo"<script>alert('kiểm tra lại nội dung trong quá trình nhập !!')</script>";
                        header("refresh:0;url=cate_supplier.php");
                     }
                  }
                  else
                  {
                  header('location: editadmin.php');
                  }
?>