<?php
include"config.php";
if (isset($_SESSION['success']) && $_SESSION['success']) {
    $tk_nv = $_SESSION["success"];
    $sql = mysqli_query($con,"SELECT id_nv,tk_nv,task FROM employee where tk_nv='$tk_nv'");
    $task_nv = mysqli_fetch_array($sql);
    $taskE = $task_nv["task"];
    if($taskE=="all" || $taskE=="order"){
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
                        
                            <?php
                            include("config.php");
                            if (isset($_GET["view-order"])) {
                                
                            
                            ?>
                            <i class="fas fa-table"></i>Tất Cả Hóa đơn</div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã Hóa đơn</th>
                                        <th>Ngày nhận đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng thanh toán</th>
                                        <th>Hình thức</th>
                                        <th>Trạng thái</th>
                                        
                                        <th>Xem</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Mã Hóa đơn</th>
                                        <th>Ngày nhận đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng thanh toán</th>
                                        <th>Hình thức</th>
                                        <th>Trạng thái</th>
                                        
                                        <th>Xem</th>
                                        <th>Xóa</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                include("config.php");
                                $food =mysqli_query($con,"SELECT * FROM `order` o JOIN `account_client` a on o.`id`=a.`id`");
                                while ($foods = mysqli_fetch_array($food)) {
                                    $thoigian = $foods["order_date"];
                                    $newtime  = date("d-m-Y",strtotime($thoigian));
                                ?>
                                    <tr>
                                        <td><?= $foods["order_id"] ?></td>
                                        <td><?= $newtime ?></td>
                                        <td><?= $foods["hoten"]."<br>".
                                            $foods["diachi"]."<br>".
                                            $foods["sdt"]."<br>".
                                            $foods["email"] ?></td>
                                        <td><?= number_format($foods["order_total"],0,",",".") ?> VNĐ</td>
                                        <td><?= $foods["httt"] ?></td>
                                        <td><?php if($foods["order_status"]=="Đã Giao Hàng"){
                                            echo '<p style="color:green;font-weight:bold;">Đã Giao Hàng</p>';
                                        }elseif ($foods["order_status"]=="Đã Nhận Đơn") {
                                            echo '<p style="color:blue;">Đã Nhận Đơn</p>';
                                        }else{
                                            echo '<p style="color:red;">Đang Xử Lý</p>';
                                        } ?></td>
                                        
                                        <td><a href='tablesorder.php?detail=<?= $foods["order_id"] ?>'><input type='button' class='btn btn-primary' value='Chi tiết'></button></a></td>
                                        <td><a href='load_add.php?xoahd=<?= $foods["order_id"] ?>'><input type='button' class='btn btn-danger' value='Xóa'></button></a></td>
                                    </tr>
                                    <?php
                                    }
                                        
                                    ?>
                                    </tbody>
    
                                
                                </tbody>
                            </table>
                            <?php
                        }
                            ?>
                            <?php
                            include("config.php");
                            if (isset($_GET["detail"])) {
                                $order_id = $_GET["detail"];
                                $v_order = mysqli_query($con,"SELECT * FROM `order` o JOIN `account_client` a on o.`id`=a.`id` where order_id='$order_id'");
                                $vPro_order = mysqli_fetch_array($v_order);
                                $time = $vPro_order["order_date"];
                                $newt2 = date("d-m-Y",strtotime($time));
                            
                            ?>
                            <i class="fas fa-table"></i>Chi tiết Hóa đơn</div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <!--VIEW INFOR CỦA KHÁCH HÀNG-->
                            <div class="card" style="width: 100%;">
                              <div class="card-body">
                                <h5 class="card-title">Chi tiết hóa đơn số #<?= $order_id ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Thanh toán qua <?= $vPro_order["httt"] ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Ngày nhận đơn: <?= $newt2 ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Dự kiến nhận hàng: <?= $vPro_order["date_ship"] ?></h6>
                                <p class="card-text">Khách hàng: <?= $vPro_order["hoten"] ?><br>
                                                    Địa chỉ: <?= $vPro_order["diachi"] ?></p>
                                <a href="#" class="card-link">Email : <?= $vPro_order["email"] ?></a>
                                <a href="#" class="card-link">Số điện thoại : <?= $vPro_order["sdt"] ?></a>
                                <a href="#" class="card-link">Trạng thái : <?= $vPro_order["order_status"] ?></a>
                              </div>
                            </div>

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>Chi tiết sản phẩm</th>
                                    <th>Giá Tiền</th>
                                </tr>
                                <?php
                                include("config.php");
                                $detail = mysqli_query($con,"select * from order_details where order_id='$order_id'");
                                while ($detail2 = mysqli_fetch_array($detail)) {
                                echo"
                                <tr>
                                    <td>".$detail2["ten_sp"]." -số lượng: X ".$detail2["sl_sp"]."</td>
                                    <td style='color:red;'>".number_format($detail2["gia_sp"],0,",",".")." đ</td>
                                </tr>";
                            }
                                ?>
                            <label for="slect">Thay đổi trạng thái</label>
                            <form method="post" action="load_add.php?od_id=<?= $order_id ?>">
                            <select class="form-control" name="status" required="">
                                      <option value="Đang Xử Lý">Đang xử lý</option>
                                      <option value="Đã Nhận Đơn">Đã Nhận đơn</option>
                                      <option value="Đã Giao Hàng">Đã Giao Hàng</option>
                            </select><input type="submit" name="sb_status" class="btn btn-primary" value="Cập Nhật">
                            </form></br>
                            </table>
                            <div class="card" style="width: 22rem;">
                              <div class="card-body">
                                <h5 class="card-title">Cộng hóa đơn</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Tổng Tiền: <?= number_format($vPro_order["order_total"]-30000,0,",",".") ?>đ</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Đơn giá vận chuyển: 30.000đ(Tiêu chuẩn)</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Tổng thanh toán: <?= number_format($vPro_order["order_total"],0,",",".") ?>đ</h6>
                              </div>
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            include("config.php");
                            if (isset($_GET["xoahd"])) {
                                $id_hd = $_GET["xoahd"];
                                $del_detail = mysqli_query($con,"delete from order_details where order_id='$id_hd'");
                                if ($del_detail) {
                                    $delhd  = mysqli_query($con,"delete from `order` where order_id='$id_hd'");
                                
                                echo '<script>alert("Đã xóa thành công hóa đơn")</script>';
                                header("refresh:1;url=tablesorder.php");
                            }
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
                        <span>Copyright © Petsland-Nguyễn Hữu Phúc
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
{
    echo"<script>alert('Bạn không được phân quyền ở trang này')</script>";
    header("refresh:0;url=indexadmin.php");
}
}else
{
    header("location:indexadmin.php");
}
?>