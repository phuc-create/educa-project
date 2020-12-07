<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="ncss/loginregis.css">
    <title>Đăng nhập Petsland</title>
</head>

<body>
<section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx"><img src="img-vid/dog1.jpg"></div>
                <div class="formBx">
                    <form action="xldn.php" method="post" name="formdn" onsubmit="return validateform()">
                        <h2>Đăng nhập Petsland</h2>
                        <input type="text" name="email" placeholder="Nhập email của bạn">
                        <input type="password" name="matkhau" placeholder="mật khẩu">
                        <input type="submit" name="submit" value="ĐĂNG NHẬP">
                        <p class="signup">Tạo một tài khoản mới? <a href="dangky.php" onclick="addClass();">Đăng kí</a></p>
                    </form>
                </div>
            </div>
        </div>
</section>
</body>
<script>
    function validateform() {
        var email = document.formdn.taikhoan.value;
        var matkhau = document.formdn.matkhau.value;

        if (email == null || email == "") {
            alert("Vui lòng điền đẩy đủ thông tin!!!");
            return false;
        }else if (matkhau == null || matkhau == "") {
            alert("Vui lòng điền mật khẩu!!!");
            return false;
        }
    }
</script>
</html>