<?php
session_start();
include("config.php");
if(isset($_SESSION["success"])){
    $tk_nv = $_SESSION["success"];
    $sql = mysqli_query($con,"SELECT * FROM employee where tk_nv='$tk_nv'");
    $task_nv = mysqli_fetch_array($sql);
    $taskE = $task_nv["task"];
    if ($taskE=="sp" || $taskE=="all") {
        
    
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
                    <a class="dropdown-item" href="#"><?= $tk_nv ?></a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="fullstack.php?drop" data-toggle="modal" data-target="#logoutModal">Logout</a>
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
                    <li class="breadcrumb-item active">Nhóm sản phẩm và nhà cung cấp</li>
                </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>Thông tin </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã nhóm</th>
                                        <th>Tên nhóm</th>
                                        <th>Thêm</th>
                                        <th>Xóa</th>                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Mã nhóm</th>
                                        <th>Tên nhóm</th> 
                                        <th>Thêm</th>
                                        <th>Xóa</th>                                      
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include("config.php");
                                    $query = mysqli_query($con,"select * from category");
                                    while ($view = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?= $view["id_cate"] ?></td>
                                        <td><?= $view["name_cate"] ?></td>
                                        <td><a  href="cate_supplier.php?addnhom" ><button type="button" class="btn btn-primary">Thêm nhóm mới</button></a></td>
                                        <td><a class="del_cate" href="load_add.php?delnhom=<?= $view["id_cate"] ?>"><button type="button" class="btn btn-danger">Xóa nhóm</button></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    
                                </tbody>
                                <a href="cate_supplier.php?addnhom"><button type="button" class="btn btn-primary">Thêm Nhóm sản phẩm</button></a>
                            </table>
                            <?php
                            if(isset($_GET["addnhom"])){
                            ?>
                            <form method="post" action="load_add.php">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhóm</label>
                            <input type="text" name="nhomsp" class="form-control">
                            <small id="emailHelp" class="form-text text-muted">Thông tin được cung cấp bởi Admin</small>
                          </div>
                          <button type="submit" name="nhomnew" class="btn btn-primary">Thêm ngay</button><br><br>
                        </form>
                            <?php
                        }
                            ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã NCC</th>
                                        <th>Tên NCC</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Email</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Mã NCC</th>
                                        <th>Tên NCC</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Email</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>                                        
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include("config.php");
                                    $query2 = mysqli_query($con,"select * from supplier");
                                    while ($view2 = mysqli_fetch_array($query2)) {
                                    echo"
                                    <tr>
                                        <td>".$view2["id_spli"]."</td>
                                        <td>".$view2["company_name"]."</td>
                                        <td>".$view2["phone"]."</td>
                                        <td>".$view2["address"]."</td>
                                        <td>".$view2["email"]."</td>
                                        <td><a href='cate_supplier.php?edit=".$view2["id_spli"]."'><button type='button' class='btn btn-primary'>Sửa nội dung</button></a></td>
                                        <td><a class='del_ncc' href='load_add.php?del_ncc=".$view2["id_spli"]."'><button type='button' class='btn btn-danger'>Xóa NCC</button></a></td>
                                    </tr>";
                                }
                                ?>
                                    
                                </tbody>
                                <a href="cate_supplier.php?addncc"><button type="button" class="btn btn-primary">Thêm NCC</button></a>
                            </table>
                            <?php
                            if (isset($_GET["addncc"])) {
                                ?>
                                <form method="post" action="load_add.php">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Nhà Cung Cấp</label>
                            <input type="text" name="ten_ncc" class="form-control">
                            
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" name="dc_ncc" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email_ncc" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="sdt_ncc" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Fax</label>
                            <input type="text" name="fax_ncc" class="form-control" required="">
                          </div>
                          <small id="emailHelp" class="form-text text-muted">Thông tin được cung cấp bởi Admin</small>
                          <button type="submit" name="addnew_ncc" class="btn btn-primary">Thêm ngay</button><br><br>
                        </form>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($_GET["edit"])) {
                                $id_spli = $_GET["edit"];
                                $qr = mysqli_query($con,"select * from supplier where id_spli='$id_spli'");
                                $v = mysqli_fetch_array($qr);
                                ?>
                            <form method="post" action="load_add.php">
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Nhà Cung Cấp</label>
                            <input type="text" name="ten_ncc" class="form-control" value="<?= $v["company_name"] ?>">
                            <input type="hidden" name="id_spli" class="form-control" value="<?= $v["id_spli"] ?>">
                            
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="text" name="dc_ncc" class="form-control" value="<?= $v["address"] ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email Cung Cấp</label>
                            <input type="email" name="email_ncc" class="form-control" value="<?= $v["email"] ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="sdt_ncc" class="form-control" value="<?= $v["phone"] ?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Fax</label>
                            <input type="text" name="fax_ncc" class="form-control" value="<?= $v["fax"] ?>">
                          </div>
                          <small id="emailHelp" class="form-text text-muted">Thông tin được cung cấp bởi Admin</small>
                          <button type="submit" name="edit_ncc" class="btn btn-primary">Cập nhật</button><br><br>
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

            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Petsland 2020-Nguyễn Hữu Phúc</span>
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
                    <a class="btn btn-primary" href="xldn.php?break">Logout</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.del_cate').click(function(e) {
            var result = confirm("Nếu bạn xóa nhóm này,mọi sản phẩm thuộc nhóm này đều sẽ bị xóa,bạn chắc chắn là muốn xóa chứ ?");
        if(!result) {
            e.preventDefault();
            alert('Đã Hủy Thao Tác!');
    
        }
        });
        $('.del_ncc').click(function(e) {
            var result = confirm("Nếu bạn xóa NCC này,mọi sản phẩm thuộc NCC này đều sẽ bị xóa,bạn chắc chắn là muốn xóa chứ ?");
        if(!result) {
            e.preventDefault();
            alert('Đã Hủy Thao Tác!');
    
        }
        });
    });
</script>

</body>

</html>
<?php
    }else{
        echo"<script>alert('Bạn không được phân quyền ở trang này')</script>";
        header("refresh:0;url=indexadmin.php");
    }}
else
{
    header("location:login.php");
}

?>