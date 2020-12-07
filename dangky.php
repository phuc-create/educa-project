
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dean2/ncss/loginregis2.css">
    <title>Đăng ký</title>
</head>
<body>
<section>
        <div class="container">
            <div class="user signupBx">
                <div class="formBx">
                    <form name="formdk" method="post" action="xl1.php" onsubmit="return validateform()">
                        <h2>Đăng kí Petsland</h2>
                        <input type="text" name="email" placeholder="Nhập Email của bạn" required>
                        <input type="submit" name="submit" value="Xác nhận">
                        <p class="signup">Đã có tài khoản khả dụng ? <a href="index.php" onclick="addClass();">đăng nhập</a></p>
                    </form>
                </div>
                <div class="imgBx"><img src="img-vid/dog2.jpg"></div>
            </div>
        </div>
    </section>
</body>
<script>
    function validateform() {
        var x = document.formdk.email.value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        if (atposition < 1 || dotposition < (atposition + 2)
                || (dotposition + 2) >= x.length) {1
            alert("Vui lòng nhập đúng Email bao gồm '@' và '.'   !!!");
            return false;
        } else if(username.length < 9 || username.length > 16) {
            alert("Tên tài khoản chứa tối thiểu 10 kí tự và không sử dụng khoảng trắng!!!");
            return false;
        } else if (password.length < 8) {
            alert("Mật khẩu tối đa chứa hơn 8 kí tự!!!");
            return false;
            
        }else if (password != repassword) {
            alert("Vui lòng kiểm tra lại 2 mật khẩu!!!");
            return false;
            
        }
        }
</script>
</html>