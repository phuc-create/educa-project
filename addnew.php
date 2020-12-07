<?php
include("config.php");
?>
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


    <div class="form_add">
        <form method="post" action="load_add.php" enctype="multipart/form-data">
            <h1>Thêm mới sản phẩm</h1>

            <div class="input_add">
                <label>Nhập tên sản phẩm</label>
                <input type="text" name="name_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập giá sản phẩm</label>
                <input type="text" name="price_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập giá Khuyến Mãi</label>
                <input type="text" name="km"><br>
            </div>
            <div class="input_add">
                <label>Thêm ảnh</label>
                <input type="file" name="img_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập mô tả</label>
                <textarea name="describe_sp"></textarea><br>
            </div>
            
            <div class="input_add">
                <label>Chọn danh mục sản phẩm</label>
                <select name="for_sp" id="">
                    <option value="1">Thức ăn cho chó</option>
                    <option value="2">Thức ăn cho mèo</option>
                    <option value="5">Vật dụng thú cưng</option>
                </select><br>
            </div>
            <div class="input_add">
                <label>Số lượng sẵn dùng</label>
                <input type="number" min="1" max="100" name="available_sp" required=""><br>
            </div>
            <input type="submit" name="submit_add" value="Thêm">
        </form>

        <form method="post" action="load_add.php" enctype="multipart/form-data">
            <h1>Thêm mới vật dụng</h1>
            
            <div class="input_add">
                <label>Nhập tên sản phẩm</label>
                <input type="text" name="name_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập giá sản phẩm</label>
                <input type="text" name="price_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập giá Khuyến Mãi</label>
                <input type="text" name="km"><br>
            </div>
            <div class="input_add">
                <label>Thêm ảnh</label>
                <input type="file" name="img_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập mô tả</label>
                <textarea name="describe_sp"></textarea><br>
            </div>
            <div class="input_add">
                <label>Số lượng sẵn dùng</label>
                <input type="number" min="1" max="100" name="available_sp" required=""><br>
            </div>
            <input type="submit" name="submit_add2" value="Thêm">
        </form>
    
<?php
include("config.php");
if (isset($_GET["idup"])) {
    $idup = $_GET["idup"];
    $querySelect = mysqli_query($con,"select * from product_show where id_sp = '$idup'");
    while ($sel = mysqli_fetch_array($querySelect)) {
        ?>
        <form method="post" action="load_add.php" enctype="multipart/form-data">
            <h1 style="color: #e74c3c;">Chỉnh sửa Thông Tin sản phẩm</h1>
            <div class="input_add">
                <label>Không sửa ID</label>
                <input type="text" name="id_sp" value="<?= $sel["id_sp"] ?>" readonly><br>
            </div>
            <div class="input_add">
                <label>Nhập một tên sản phẩm</label>
                <input type="text" name="name_sp" value="<?= $sel["name_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Nhập một giá sản phẩm</label>
                <input type="text" name="price_sp" value="<?= $sel["price_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Thêm ảnh mới</label>
                <input type="file" name="img_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập một mô tả</label>
                <textarea name="describe_sp"><?= $sel["describe_sp"] ?></textarea><br>
            </div>
            <div class="input_add">
                <label>Thay đổi trạng thái</label>
                <input type="text" name="status_sp" value="<?= $sel["status_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Sản phẩm dành cho</label>
                <input type="text" name="for_sp" value="<?= $sel["for_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Số lượng sẵn dùng</label>
                <input type="number" min="1" max="100" name="available_sp" required="" value="<?= $sel["available"] ?>"><br>
            </div>
            <input type="submit" name="up" value="Cập nhật">
        </form>
        <?php
    }
}
?>
<?php
include("config.php");
if (isset($_GET["idupstuff"])) {
    $idup = $_GET["idupstuff"];
    $querySelect = mysqli_query($con,"select * from product_show where id_sp = '$idup'");
    while ($sel = mysqli_fetch_array($querySelect)) {
        ?>
        <form method="post" action="load_add.php" enctype="multipart/form-data">
            <h1 style="color: #e74c3c;">Chỉnh sửa Thông tin Vật Dụng</h1>
            <div class="input_add">
                <label>Nhập một ID sản phẩm</label>
                <input type="text" name="id_sp" value="<?= $sel["id_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Nhập một tên sản phẩm</label>
                <input type="text" name="name_sp" value="<?= $sel["name_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Nhập một giá sản phẩm</label>
                <input type="text" name="price_sp" value="<?= $sel["price_sp"] ?>"><br>
            </div>
            <div class="input_add">
                <label>Thêm ảnh mới</label>
                <input type="file" name="img_sp"><br>
            </div>
            <div class="input_add">
                <label>Nhập một mô tả</label>
                <textarea name="describe_sp"><?= $sel["describe_sp"] ?></textarea><br>
            </div>
            <div class="input_add">
                <label>Thay đổi trạng thái</label>
                <input type="text" name="status_sp" value="<?= $sel["status_sp"] ?>"><br>
            </div>
            <input type="submit" name="upstuff" value="Cập nhật">
        </form>
        <?php
    }
}
?>
</div>
</body>

</html>
