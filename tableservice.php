<?php
include"config.php";
if (isset($_SESSION['success']) && $_SESSION['success']) {
    $tk_nv = $_SESSION["success"];
    $sql = mysqli_query($con,"SELECT id_nv,tk_nv,task FROM employee where tk_nv='$tk_nv'");
    $task_nv = mysqli_fetch_array($sql);
    $taskE = $task_nv["task"];
    if($taskE=="all" || $taskE=="service"){
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
                        <i class="fas fa-table"></i>Dịch vụ đang đợi hỗ trợ</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã dịch vụ</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Ngày nhận</th>
                                        <th>Khách hàng</th>
                                        
                                        <th>Trạng thái</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Mã dịch vụ</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Ngày nhận</th>
                                        <th>Khách hàng</th>
                                        
                                        <th>Trạng thái</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </tfoot>
                                <tbody>                                
                                    <?php
                                include("config.php");
                                $food = mysqli_query($con,"SELECT * FROM service s join account_client ac WHERE s.id=ac.id");
                                while ($foods = mysqli_fetch_array($food)) {
                                    $thoigian = $foods["ngaydat_dv"];
                                    $newtime  = date("d-m-Y",strtotime($thoigian));
                                echo"
                                    <tr>
                                        <td>".$foods["id_dv"]."</td>
                                        <td>".$foods["ten_dv"]."</td>
                                        <td>".$newtime."</td>
                                        <td>".$foods["hoten"]."</td>
                                        
                                        <td>".$foods["trangthai_dv"]."</td>
                                        <td><a href='tableservice.php?detail_dv=".$foods["id_dv"]."'><input type='button' class='btn btn-primary' value='Xem'></button></a></td>
                                        <td><a href='load_add.php?del_dv=".$foods["id_dv"]."'><input type='button' class='btn btn-danger' value='Xóa'></button></a></td>
                                    </tr>";
                                    } 
                                    ?>
                                    </tbody>
    
                                
                                </tbody>
                            </table>
                            <?php
                            include("config.php");
                            if (isset($_GET["detail_dv"])) {
                                $id_dv = $_GET["detail_dv"];
                                $infor = mysqli_query($con,"SELECT * FROM service s join account_client ac ON s.id=ac.id WHERE s.id_dv='$id_dv'");
                                $xem = mysqli_fetch_array($infor);
                                $time = $xem["ngaydat_dv"];
                                $new = date("d-m-Y",strtotime($time));
                                $tt = $xem["trangthai_dv"];
                             
                            ?>

                            <div class="card" style="width: 100%;">
                              <div class="card-body">
                                <h5 class="card-title">Chi tiết dịch vụ #<?= $xem["id_dv"]  ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Tên Khách hàng: <?= $xem["hoten"] ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Ngày nhận: <?= $new ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Lời nhắn:<br><?= $xem["mota_dv"] ?></h6>
                                
                                <a href="#" class="card-link">Email : <?= $xem["email"] ?></a>
                                <a href="#" class="card-link">Số điện thoại : <?= $xem["sdt"] ?></a>
                                <a href="#" class="card-link">Trạng thái : <?php if($tt==""){
                                    echo '<p>ĐÃ HOÀN TẤT</p>';
                                }else{
                                    echo $tt;
                                } ?></a><br><br>
                                <label for="slect">Thay đổi trạng thái:</label>
                                <form method="post" action="load_add.php?doitt=<?= $xem["id_dv"] ?>">
                                  <select class="form-control" name="tt_dv" required="" style="width: 18rem;">
                                      <option value="Đã hoàn tất">Đã hoàn tất dịch vụ</option>
                                      <option value="Đang xử lý">Đang xử lý</option>
                                  </select>
                                  <p><input type="submit" name="change_ttdv" value="Cập nhật" class="btn btn-primary">
                              </form>
                              <a href="tableservice.php"><button class="btn btn-danger">Đóng</button></a></p>
                              </div>
                            </div>
                            <?php
                               
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
{
    echo"<script>alert('Bạn không được phân quyền ở trang này')</script>";
    header("refresh:0;url=indexadmin.php");
}
}else
{
    header("location:indexadmin.php");
}
?>