<?php
include"config.php";
if (isset($_SESSION['success']) && $_SESSION['success']) {
    $tk_nv = $_SESSION["success"];
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
                    <a class="dropdown-item" href="revenue.php">Doanh thu</a>
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
                            if (isset($_GET["p"])) {
                                $new = "new"; 
                                
                            
                            ?>
                            <i class="fas fa-table"></i>Thêm mới</div>
                        <div class="card-body">
                        <div class="table-responsive">
                              <form method="post" action="load_add.php" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label for="ten">Tên sản phẩm</label>
                                  <input type="text" name="name_sp" class="form-control" id="ten" required="">
                                </div>
                                <div class="form-group">
                                  <label for="gia">Gía sản phẩm</label>
                                  <input type="text" name="price_sp" class="form-control" id="gia" required="">
                                </div>
                                <div class="form-group">
                                  <label for="km">Gía khuyến mãi</label>
                                  <input type="text" name="km" class="form-control" id="km" required="">
                                </div>
                                <div class="form-group">
                                  <label for="img">Chọn ảnh đại diện</label>
                                  <input type="file" name="img_sp" class="form-control-file" required="">
                                </div>
                                <div class="form-group">
                                  <label for="area">Mô tả sản phẩm</label>
                                  <textarea class="form-control" name="describe_sp" id="area" required=""></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Danh mục:</label>
                                  <select class="form-control" name="for_sp" id="slect" required="">
                                    <?php
                                    include("config.php");
                                    $pre = mysqli_query($con,"select * from category");
                                    while ($all = mysqli_fetch_array($pre)) {
                                      echo '
                                        <option value="'.$all["id_cate"].'">'.$all["name_cate"].'</option>
                                        ';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Nhà cung cấp:</label>
                                  <select class="form-control" name="ncc" id="slect" required="">
                                    <?php
                                    include("config.php");
                                    $pre = mysqli_query($con,"select * from supplier");
                                    while ($all = mysqli_fetch_array($pre)) {
                                      echo '
                                        <option value="'.$all["id_spli"].'">'.$all["company_name"].'</option>
                                        ';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="number">Khả dụng trong kho</label>
                                  <input type="number" min="0" max="100" name="available_sp" class="form-control-number" id="number" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit_add" class="btn btn-primary">Thêm Ngay</button>                         
                                </div>
                              </form>
                              <?php
                          }
                              ?>
                              <?php
                              include("config.php");
                              if (isset($_GET["edit"])) {
                                  $id_sp = $_GET["edit"];
                                  $result = mysqli_query($con,"select * from product_show where id_sp='$id_sp'");
                                  $row = mysqli_fetch_array($result);
                                  ?>
                              <i class="fas fa-table"></i>Sửa sản phẩm</div>
                                <div class="card-body">
                                <div class="table-responsive">
                              <form method="post" action="load_add.php" enctype="multipart/form-data">
                                <div class="form-group">
                                <input type="hidden" name="id_sp" class="form-control" value="<?= $row["id_sp"] ?>">
                                  <label for="ten">Tên sản phẩm</label>
                                  <input type="text" name="name_sp" class="form-control" required="" value="<?= $row["name_sp"] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="gia">Gía sản phẩm</label>
                                  <input type="text" name="price_sp" class="form-control" required="" value="<?= $row["price_sp"] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="km">Gía khuyến mãi</label>
                                  <input type="text" name="km" class="form-control" required="" value="<?= $row["km"] ?>">
                                </div>
                                
                                <div class="form-group">
                                  <label for="area">Mô tả sản phẩm</label>
                                  <textarea class="form-control" name="describe_sp" required="" ><?= $row["describe_sp"] ?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Name:</label>
                                  <select class="form-control" name="for_sp" required="">
                                      <?php
                                    include("config.php");
                                    $pre = mysqli_query($con,"select * from category");
                                    while ($all = mysqli_fetch_array($pre)) {
                                      echo '
                                        <option value="'.$all["id_cate"].'">'.$all["name_cate"].'</option>
                                        ';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="slect">Nhà cung cấp:</label>
                                  <select class="form-control" name="ncc" id="slect" required="">
                                    <?php
                                    include("config.php");
                                    $pre = mysqli_query($con,"select * from supplier");
                                    while ($all = mysqli_fetch_array($pre)) {
                                      echo '
                                        <option value="'.$all["id_spli"].'">'.$all["company_name"].'</option>
                                        ';
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="number">Khả dụng trong kho</label>
                                  <input type="number" min="0" max="100" name="available_sp" class="form-control-number" required="" value="<?= $row["available"] ?>">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="up" class="btn btn-primary" value="Cập Nhật"/>                         
                                </div>
                              </form>
                              <?php
                          }
                              ?>




                              <?php
                              include("config.php");
                              if (isset($_GET["img"])) {
                                  $id_sp = $_GET["img"];
                                  $result = mysqli_query($con,"select * from product_show where id_sp='$id_sp'");
                                  $row = mysqli_fetch_array($result);
                                  ?>
                              <i class="fas fa-table"></i>Sửa ảnh sản phẩm</div>
                                <div class="card-body">
                                <div class="table-responsive">
                              <form method="post" action="load_add.php" enctype="multipart/form-data">   
                                <div class="form-group">
                                  <label for="img">Chọn ảnh đại diện</label>
                                  <input type="file" name="img_sp" class="form-control-file" required="" value="<?= $row["img_sp"] ?>">
                                  <input type="hidden" name="id_sp" class="form-control"  value="<?= $row["id_sp"] ?>">
                                </div> 
                                <div class="form-group">
                                    <input type="submit" name="img" class="btn btn-primary" value="Cập Nhật"/>                         
                                </div>
                              </form>
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
    header("location:login.php");
}
?>