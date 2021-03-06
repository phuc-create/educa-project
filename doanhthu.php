<?php
session_start();
include("config.php");
if(isset($_SESSION["success"])){
    $tk_nv = $_SESSION["success"];
    $sql = mysqli_query($con,"SELECT * FROM employee where tk_nv='$tk_nv'");
    $task_nv = mysqli_fetch_array($sql);
    $taskE = $task_nv["task"];
    if($taskE=="all"){
       ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản trị viên</title>

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

        <a class="navbar-brand mr-1" href="indexadmin.php">Model Clock</a>

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
                    <a class="dropdown-item" href="#">Xin chào admin</a>
                    <a class="dropdown-item" href="#">NO IDENTIFY</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Đăng xuất</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
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
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Nhân viên</span>
                </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Cấp bởi admin</h6>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-user"></i><?= $task_nv["ten_nv"] ?></a>
                    <a class="dropdown-item" href="#"><i class="fas fa-fw fa-tasks"></i><?php if($task_nv["task"]=="sp"){
                        echo"Quản lý sản phẩm";
                    }elseif($task_nv["task"]=="service"){
                        echo"Quản lý dịch vụ";
                    }elseif($task_nv["task"]=="order"){
                        echo"Quản lý đơn hàng";
                    }elseif($task_nv["task"]=="news"){
                        echo"Quản lý tin tức";
                    }else{
                        echo"Tổng quản lý";
                    } ?></a>
                    <a class="dropdown-item" href=""><i class="fas fa-fw fa-envelope-square"></i><?= $task_nv["email_nv"] ?></a>
                    <a class="dropdown-item" href="tables.php?stuff"><i class="fas fa-fw fa-phone"></i><?= $task_nv["sdt_nv"] ?></a>
                    
                </div>
            </li>
        </ul>

        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="indexadmin.php">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active">Tổng quan</li>
                </ol>

                <!-- Icon Cards-->
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-user"></i>
                                </div>
                                <div class="mr-5">
                                    <?php 
                                    include("config.php");
                                    $em = mysqli_query($con,"select count(*) as slem from employee where id_nv is not null");
                                    if ($em) {
                                        while ($all = mysqli_fetch_array($em)) {
                                        $sl = $all["slem"];
                                    }
                                    echo "Có tổng ".$sl." Nhân Viên";
                                    }
                                    ?>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="employee.php?view">
                                <span class="float-left">Chi tiết</span>
                                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-primary o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-comments"></i>
                                </div>
                                <div class="mr-5">
                                    <?php 
                                    include("config.php");
                                    $em = mysqli_query($con,"select count(*) as slem from feedback where stt is not null");
                                    if ($em) {
                                        while ($all = mysqli_fetch_array($em)) {
                                        $sl = $all["slem"];
                                    }
                                    echo "Có tổng ".$sl." feedback";
                                    }
                                    ?>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="feedback.php">
                                <span class="float-left">Chi tiết</span>
                                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-list"></i>
                                </div>
                                <div class="mr-5">
                                    <?php 
                                    include("config.php");
                                    $service = mysqli_query($con,"select * from service");
                                    if ($service) {
                                        while ($all = mysqli_fetch_array($service)) {
                                        $sl = $all["null"];
                                        $count += $sl;
                                    }
                                    echo "Có tổng ".$count." dịch vụ đã nhận";
                                    }
                                    ?>   
                                         </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="tableservice.php">
                                <span class="float-left">Chi tiết</span>
                                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-shopping-cart"></i>
                                </div>
                                <div class="mr-5">
                                    <?php 
                                    include("config.php");
                                    $order = mysqli_query($con,"SELECT COUNT(*) as sl FROM `order` WHERE order_id is not null");
                                    if ($order) {
                                        while ($all = mysqli_fetch_array($order)) {
                                        $sl = $all["sl"];
                                    }
                                    echo "Có tổng ".$sl." đơn hàng  ";
                                    }
                                    ?>   </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="tablesorder.php?view-order">
                                <span class="float-left">Chi tiết</span>
                                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-life-ring"></i>
                                </div>
                                <div class="mr-5">
                                    <?php 
                                    include("config.php");
                                    $sp = mysqli_query($con,"SELECT COUNT(*) as alll FROM product_show WHERE id_sp is not null");
                                    if ($sp) {
                                        while ($all = mysqli_fetch_array($sp)) {
                                        $sl = $all["alll"];
                                    }
                                    echo "Có tổng ".$sl." sản phẩm  ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="tables.php?food">
                                <span class="float-left">Chi tiết</span>
                                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Area Chart Example-->
                <!--<div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>-->

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>Chi tiết doanh thu(Bao gồm đơn hàng chưa hoàn tất)</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID hóa đơn</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng thái</th>
                                                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID hóa đơn</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng thái</th>
                                                                             
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include("config.php");
                                    $new = 0;
                                    $query = mysqli_query($con,"SELECT * FROM `order`");
                                    while ($row = mysqli_fetch_array($query)) {
                                        $tong = $row["order_total"];
                                        
                                        $new += $tong;
                                    ?>
                                    <tr>
                                        <th><?= $row["order_id"]?></th>
                                        <th><?= number_format($tong,0,",",".")?> VNĐ</th>
                                        <th><?php if($row["order_status"]=="Đã Giao Hàng"){
                                                echo '<p style="color:red">Đã Giao Hàng</p>';
                                        }else{
                                            echo '<p style="color:blue">Đang xử lý</p>';
                                        }?></th>                                      
                                    </tr>
                                    <?php
                                }
                                    ?>
                                </tbody>
                                <a href=""><button class="btn btn-primary">Reset doanh thu</button></a>
                            </table>
                            <h1>Doanh thu trên website</h1><span style="color:red;font-weight: bold;"><?= number_format($new,0,",",".") ?> VNĐ
                            </span>
                        </div>
                    </div>

                </div>



          <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>Chi tiết doanh thu(thực tế)</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID hóa đơn</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng thái</th>
                                                                              
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID hóa đơn</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng thái</th>
                                                                               
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include("config.php");
                                    $new = 0;
                                    $query = mysqli_query($con,"SELECT * FROM `order` where order_status='Đã Giao Hàng'");
                                    while ($row = mysqli_fetch_array($query)) {
                                        $tong = $row["order_total"];
                                        
                                        $new += $tong;
                                    ?>
                                    <tr>
                                        <th><?= $row["order_id"]?></th>
                                        <th><?= number_format($tong,0,",",".")?> VNĐ</th>
                                        <th><p style="color: red"><?= $row["order_status"]?></p></th>
                                    </tr>
                                    <?php
                                }
                                    ?>
                                </tbody>
                                <a href=""><button class="btn btn-primary">Reset doanh thu</button></a>
                            </table>
                            <h1>Doanh thu thực tế</h1><span style="color:red;font-weight: bold;"><?= number_format($new,0,",",".") ?> VNĐ
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Petsland 2020-Bản quyền thuộc về PTH2N</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng để rời đi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" để thoát khỏi giao diện admin</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="fullstack.php?drop">Đăng xuất</a>
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