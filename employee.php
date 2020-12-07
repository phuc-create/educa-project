<?php
session_start();
include("config.php");
if(isset($_SESSION["success"])){
    $tk_nv = $_SESSION["success"];
    $sql = mysqli_query($con,"SELECT id_nv,tk_nv,task FROM employee where tk_nv='$tk_nv'");
    $task_nv = mysqli_fetch_array($sql);
    $taskE = $task_nv["task"];
    if($taskE=="all" || $taskE=="employee"){
       ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bảng</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="indexadmin.php">Petsland</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
                </div>
            </div>
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Cài đặt</a>
                    <a class="dropdown-item" href="#">Quản trị viên</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Đăng xuất</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="indexadmin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Danh sách bảng</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Cấp bởi admin</h6>
                    <a class="dropdown-item" href="tableservice.php">Danh sách dịch vụ</a>
                    <a class="dropdown-item" href="tablesorder.php?view-order">Danh sách hóa đơn</a>
                    <a class="dropdown-item" href="tables.php?food">Kho thức ăn</a>
                    <a class="dropdown-item" href="tables.php?stuff">Kho vật dụng</a>
                    <a class="dropdown-item" href="feedback.php">Xem feedback khách hàng</a>
                    <a class="dropdown-item" href="cate_supplier.php">Danh mục sản phẩm và NCC</a>
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header">Các trang khác:</h6>
                    <a class="dropdown-item" href="trangchu.php">Xem cửa hàng</a>
                    <a class="dropdown-item" href="doanhthu.php">Doanh thu</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Tổng</span></a>
            </li>
        </ul>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Bảng</li>
                </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>Danh sách nhân viên Petsland</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            if(isset($_GET["view"]))
                            {
                                $xem = "Nhân viên";                          
                            ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã nhân viên</th>
                                       
                                        <th>Tên nhân viên</th>
                                        <th>Ảnh nhân viên</th>
                                        
                                      
                                        <th>Bộ phận</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Mã nhân viên</th>
                                        
                                        <th>Tên nhân viên</th>
                                        <th>Ảnh nhân viên</th>
                                        
                                        
                                        <th>Bộ phận</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr> 
                                </tfoot>
                                <tbody>                                
                                    <?php
                                include("config.php");
                                $nv = mysqli_query($con,"select * from employee");
                                while($viewnv = mysqli_fetch_array($nv)){
                                $time = $viewnv["ngaysinh_nv"];
                                $new = date("d-m-Y",strtotime($time));
                                ?>
                                    <tr>
                                        <td><?= $viewnv["id_nv"] ?></td>
                                        
                                        <td><?= $viewnv["ten_nv"] ?></td>
                                        <td><img src='img-vid/<?= $viewnv["anh_nv"] ?>' width='100px' height='100px'></td>
                                        
                                        
                                        
                                        
                                        
                                        <td><?php if($viewnv["task"]=="sp"){
                                            echo 'Bộ phận sản phẩm';
                                        }elseif ($viewnv["task"]=="order"){
                                            echo 'Bộ phận đơn hàng';
                                        }elseif ($viewnv["task"]=="service") {
                                            echo 'Bộ phận dịch vụ';
                                        }elseif ($viewnv["task"]=="news") {
                                            echo 'Bộ phận tin tức';
                                        }else{
                                            echo 'Quản lý tổng';
                                        }
                                            
                                        ?></td>
                                        <td><a href='employee.php?change=<?= $viewnv['id_nv'] ?>'><input type='button' class='btn btn-primary' value='Sửa'/></a>

                                            <a href='employee.php?detailnvv=<?= $viewnv['id_nv'] ?>'><input type='button' class='btn btn-primary' value='Chi tiết'/></a></td>
                                        <td><a href='load_add.php?del_nv=<?= $viewnv["id_nv"] ?>'><input type='button' class='btn btn-danger' value='Xóa'></button></a></td>
                                        
                                    </tr>
                                    <?php
                                    } 
                                }
                                    ?>

                                    </tbody>
                                
                                
                                </tbody>
                                <a href="employee.php?addnv" ><button class="btn btn-primary">Thêm mới nhân viên</button></a>
                            </table>
                            <?php
                                include("config.php");
                                if (isset($_GET["detailnvv"])) {
                                    $id_nv = $_GET["detailnvv"];
                                    $inF = mysqli_query($con,"select * from employee where id_nv='$id_nv'");
                                    $inF2 = mysqli_fetch_array($inF);
                                    $ns = $inF2["ngaysinh_nv"];    
                                    $date2 = date("d-m-Y",strtotime($ns)); 
                                    ?>
                                    <i class="fas fa-table"></i>Chi tiết Nhân viên</div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <!--VIEW INFOR CỦA KHÁCH HÀNG-->
                            <div class="card" style="width: 100%;">
                              <div class="card-body">
                                <h5 class="card-title">Nhân viên <?= $inF2["ten_nv"] ?> </h5><br><br>
                                <img src="img-vid/<?= $inF2["anh_nv"] ?>" width="350px" height="450px" class="rounded float-right">
                                <h6 class="card-subtitle mb-2 text-muted">Địa chỉ :<?= $inF2["diachi_nv"] ?></h6><br><br>
                                <h6 class="card-subtitle mb-2 text-muted">Ngày sinh: <?= $date2 ?></h6><br><br>
                                <h6 class="card-subtitle mb-2 text-muted">Chức vụ :
                                    <?php if($inF2["task"]=="all"){
                                            echo "Quản lý tổng";
                                            }elseif($inF2["task"]=="sp"){
                                                echo "Quản lý sản phẩm";
                                            }elseif($inF2["task"]=="order"){
                                                echo "Quản lý hóa đơn";
                                            }
                                            elseif($inF2["task"]=="news"){
                                                echo "Quản lý tin tức";
                                            }elseif($inF2["task"]=="feedback"){
                                                echo "Quản lý phản hồi khách hàng";
                                            }elseif($inF2["task"]=="cate"){
                                                echo "Quản lý NCC và Danh mục";
                                            }?>   
                                </h6><br><br>
                                <p class="card-text">Mức lương : <?= number_format($inF2["salary"],0,",",".") ?> VNĐ/tháng</p><br><br>
                                <a href="#" class="card-link">Email :<?= $inF2["email_nv"] ?> </a><br><br>
                                <a href="#" class="card-link">Số điện thoại :<?= $inF2["sdt_nv"] ?> </a><br><br>
                                <a href='employee.php?view'><button type='button' class='btn btn-danger'>Đóng</button></a>
                                <a href='employee.php?change=<?= $inF2["id_nv"] ?>'><button type='button' class='btn btn-primary'>Chỉnh sửa</button></a>
                              </div>
                            </div>
                                    <?php
                                }
                                ?>
                            <?php
                            if(isset($_GET["addnv"])){
                                    echo"thêm nhân viên mới";
                                ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <hr>
                                <div class="form-group">
                                  <label>Tên Nhân Viên</label>
                                  <input type="text" name="ten_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label>Cấp tài khoản</label>
                                  <input type="text" name="tk_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label>Cấp Mật Khẩu</label>
                                  <input type="text" name="mk_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label>Cung cấp ảnh Nhân viên</label>
                                  <input type="file" name="anh_nv" class="form-control-file" required="">
                                </div>
                                <div class="form-group">
                                  <label for="img">Chọn ngày sinh</label>
                                  <input type="date" name="nsinh_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label for="area">Địa chỉ</label>
                                  <textarea class="form-control" name="diachi_nv" required=""></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="img">Cung cấp số điện thoại</label>
                                  <input type="text" name="sdt_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label for="img">Email</label>
                                  <input type="text" name="email_nv" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                  <label for="img">Chọn giới tính</label>
                                  <select class="form-control" name="gtinh_nv" required="">
                                    <option selected="">--Chọn 1--</option>
                                      <option value="Nam">Nam</option>
                                      <option value="Nữ">Nữ</option>
                                      <option value="Khác">Khác</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Cung cấp một chức vụ:</label>
                                  <select class="form-control" name="task" required="">
                                    <option selected="">--Chọn 1--</option>
                                    <option value="sp">Quản lý sản phẩm</option>
                                      <option value="service">Quản lý dịch vụ khách hàng</option>
                                      <option value="order">Quản lý đơn hàng</option>
                                      <option value="news">Quản lý tin tức,phản hồi</option>
                                      <option value="all">Quản lý tổng</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="themnv" class="btn btn-primary">Thêm Ngay</button>                         
                                </div>
                              </form>
                                <?php
                            }
                          elseif(isset($_POST["themnv"])){
                                $tk_nv = $_POST["tk_nv"];
                                $mk_nv = $_POST["mk_nv"];
                                $ten_nv = $_POST["ten_nv"];
                                $anh_nv = $_FILES["anh_nv"]["name"];
                                move_uploaded_file($_FILES["anh_nv"]["tmp_name"],"img-vid/".$_FILES["anh_nv"]["name"]);
                                $nsinh_nv = $_POST["nsinh_nv"];
                                $diachi_nv = $_POST["diachi_nv"];
                                $email_nv = $_POST["email_nv"];
                                $sdt_nv = $_POST["sdt_nv"];
                                $gtinh_nv = $_POST["gtinh_nv"];
                                $task = $_POST["task"];
                                $addnewE = mysqli_query($con,"insert into 
                                                            employee(tk_nv,mk_nv,anh_nv,ten_nv,ngaysinh_nv,diachi_nv,sdt_nv,email_nv,gtinh_nv,task)
                                                            values ('$tk_nv','$mk_nv','$anh_nv','$ten_nv','$nsinh_nv','$diachi_nv','$sdt_nv','$email_nv','$gtinh_nv','$task')");
                                if($addnewE){
                                    echo"<script>alert('Đã thêm 1 nhân viên')</script>";
                                }
                                else
                                {
                                    echo"<script>alert('Có lỗi gì đó đã xảy ra')</script>";
                                }
                                }elseif(isset($_GET["change"])){
                                    $id_nv = $_GET["change"];
                                    $view_nv = mysqli_query($con,"select * from employee where id_nv='$id_nv'");
                                    $row = mysqli_fetch_array($view_nv);
                                    ?>
                                    <form method="post" action="load_add.php?id_nv=<?= $id_nv ?>" enctype="multipart/form-data">
                                    <hr>
                                <div class="form-group">
                                  <label>Tên Nhân Viên(<span style="color: red;">Không thể thay thế</span>)</label>
                                  <input type="text" readonly="" class="form-control" required="" value="<?= $row['ten_nv'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label>Cấp tài khoản</label>
                                  <input type="text" name="tk_nv" class="form-control" required="" value="<?= $row['tk_nv'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label>Cấp Mật Khẩu</label>
                                  <input type="text" name="mk_nv" class="form-control" required="" value="<?= $row['mk_nv'] ?>" />
                                </div>
                                <div class="form-group">
                                  <label>Cung cấp ảnh Nhân viên</label>
                                  <input type="file" name="anh_nv" class="form-control-file" required="">
                                </div>
                                <div class="form-group">
                                  <label for="img">ngày sinh(<span style="color: red;">Không thể thay thế</span>)</label>
                                  <input type="date" readonly="" name="nsinh_nv" class="form-control" required="" value="<?= $row['ngaysinh_nv'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label for="area">Địa chỉ</label>
                                  <textarea class="form-control" name="diachi_nv" required=""><?= $row["diachi_nv"] ?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="img">Cung cấp số điện thoại</label>
                                  <input type="text" name="sdt_nv" class="form-control" required="" value="<?= $row['sdt_nv'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label>Email</label>
                                  <input type="text" name="email_nv" class="form-control" required="" value="<?= $row['email_nv'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label>Lương nhân viên</label>
                                  <input type="text" name="salary" class="form-control" required="" value="<?= $row['salary'] ?>"/>
                                </div>
                                <div class="form-group">
                                  <label for="img">Chọn giới tính</label>
                                  <select class="form-control" name="gtinh_nv" required="">
                                    <option selected="">--Chọn 1--</option>
                                      <option value="Nam">Nam</option>
                                      <option value="Nữ">Nữ</option>
                                      <option value="Khác">Khác</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Cung cấp một chức vụ:</label>
                                  <select class="form-control" name="task" required="">
                                    <option selected="" value="">--Chọn 1--</option>
                                      <option value="sp">Quản lý sản phẩm</option>
                                      <option value="service">Quản lý dịch vụ khách hàng</option>
                                      <option value="order">Quản lý đơn hàng</option>
                                      <option value="news">Quản lý tin tức,phản hồi</option>
                                      <option value="all">Quản lý tổng</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="changenv" class="btn btn-primary">Cập nhật</button>                         
                                </div>
                              </form>
                              <?php
                                }else{
                                    header("location:employee.php?view");
                                }
                            
                                ?>

                        </div>
                    </div>
                </div>

                <p class="small text-center text-muted my-5">
                    <em></em>
                </p>

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Petsland-Nguyễn Hữu Phúc-Dương Vĩ Khang
                        </span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<?php
    }else
echo"<script>alert('Bạn không được phân quyền ở trang này')</script>";
header("refresh:0;url=indexadmin.php");
}
else
{
    header("location:login.php");
}

?>