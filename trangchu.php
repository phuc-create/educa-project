<?php
 include("config.php"); 
 ?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="en" dir="ltr">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ncss/style.css">
<!--<link rel="stylesheet" type="text/css" href="ncss/style2.css">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <title>Trang chủ</title>
</head>
<html>

<body>
    <header>
        <?php 
        if (isset($_SESSION["taikhoan"]) && $_SESSION["taikhoan"])
        {
            $email = $_SESSION["taikhoan"];
            ?>
        <a href="trangchu.php" class="logo">petsland</a>
        <div class="menu_toggle"></div>
        <nav>
        <ul>
            <li><a href="trangchu.php" class="active">TRANG CHỦ</a></li>
            <li><a href="trangchu.php#about">ABOUT</a></li>
            <li><a href="trangchu.php#service">DỊCH VỤ</a></li>
            <li><a href="trangchu.php#feedback">GÓP Ý</a></li>
            <li><a href="cart.php">GIỎ HÀNG<span class="sl" id="sl"><?php
            include("config.php");
            $result = mysqli_query($con,"select * from account_client where email = '$email'");
            $roww = mysqli_fetch_array($result);
            $id = $roww["id"];
            $name_tk = $roww["hoten"];
            $coutcart = 0;
            $result2 = mysqli_query($con,"select * from cart_client where id = '$id'");
            if ($result2) {
                while ($slcart = mysqli_fetch_array($result2)) {
                $sl = $slcart["sl_cart"];
                $coutcart += $sl;
            }
            echo $coutcart;
            }
            else
            {
                echo "0";
            }
            ?></span></a></li>
            <li><a href="trangchu.php#contactus">LIÊN HỆ</a></li>
            <li><div class="dropdown">
                <button class="dropbtn">
                    <a href="trangchu.php">
                          
                            <?php
                                echo $name_tk;
                            
                            ?>
                            <?php
                        }
                            else
                            {
                                echo "<script>alert('Bạn phải đăng nhập');</script>";
                                header("refresh:0;url=index.php");
                            }
                     ?>
                 </a>
                </button>
                    <div class="dropdown-content">
                        <a href="taikhoan.php">tài khoản</a>
                        <a href="xldn.php?logout = '1'">Đăng xuất</a>
                    </div>
                </div>
            </li>
        </ul>
        </nav>
        <div class="clearFix"></div>
    </header>

    <section class="betw">
        <video autoplay muted>
            <source src="img-vid/cat.mp4">
        </video>
        <div class="title">
            <h1 id="trangchu">hello</h1>
            <p>Petsland chào các bạn</br>
                Ngày mới tốt lành
            </p>
            <a href="#" class="btn">
                <h3>Nguyễn Hữu Phúc</h3>
            </a>
        </div>
    </section>
    <section>
        <div class="about">
            <h1 id="about">About</h1>
        </div>
        <div class="content">
            <div class="contentBx w50">
                <h3>Nhà sáng lập vùng đất thú cưng</h3>
                <p>Được sáng lập vào năm 2020,thuộc bản quyền của Nguyễn Hữu Phúc,Dương Vĩ Khang,chúng tôi đem đến những người bạn giúp bạn bỏ bớt áp lực công việc và đem đến niềm thích thú nhờ vào những thú cưng<br><br> chúng tôi hy vọng bạn sẽ chọn cho
                    mình một chú cún hoặc một con mèo con mà bạn sẽ thích tại đây.<br><br> Trong tương lai chúng tôi muốn đưa điều này đến với nhiều người hơn,theo như cho biết, công việc áp lực khiến bạn bị stress và hãy để một con thú cưng giúp bạn
                    cải thiện điều đó bằng việc chơi đùa cùng chúng,tạo dựng niềm vui và đè lên áp lực trong cuộc sống của bạn hãy đến với chúng tôi,chúng tôi sẽ giúp bạn làm điều đó<br></p>
                <div class="btn2">
                    <button class="phuc">Nguyễn Hữu Phúc</button>
                <button class="phuc"> Dương Vĩ Khang </button>
            </div>
        </div>
            <div class="toggle"></div>
            <div class="w50">
                <img src="img-vid/vatnuoi.jpg">
            </div>
        </div>
    </section>
    <div class="alll">
        <div class="about2">
            <h1 id="service">online service</h1>
        </div>
        <div class="box">
            <div class="imgBBx">
                <img src="img-vid/tialongg.jpg" />
            </div>
            <div class="contentBBx">
                <h1>happy pets<br>
                    <span>Y Tế-Spa waam</span><br>
                    <a href="happy_service.php"><input type="submit" name="carepet" value="ĐẶT HẸN"></a>
                </h1>
            </div>
        </div>
        <div class="box">
            <div class="imgBBx">
                <img src="img-vid/food.jpg" />
            </div>
            <div class="contentBBx">
                <h1>pet care<br>
                    <span>thức ăn thú cưng</span><br>
                    <a href="food_pet.php?khuyenmai=khuyenmai"><input type="submit" name="carepet" value="XEM"></a>
                </h1>
            </div>
        </div>
        <div class="box">
            <div class="imgBBx">
                <img src="img-vid/stuffpet.jpg" />
            </div>
            <div class="contentBBx">
                <h1>pet care<br>
                    <span>vật dụng thú cưng</span><br>
                    <a href="food_pet.php?cate=19"><input type="submit" name="carepet" value="XEM"></a>
                </h1>
            </div>
        </div>
        <div class="box">
            <div class="imgBBx">
                <img href src="img-vid/trongnomm.jpg" />
            </div>
            <div class="contentBBx">
                <h1>pet care<br>
                    <span>trông giữ thú cưng</span><br>
                    <a href="protect_service.php"><input type="submit" name="carepet" value="ĐẶT HẸN"></a>
                </h1>
            </div>
        </div>
    </div>
    <div class="feed" id="feedback">
        <div class="container">
        <div class="feedbackinfo">
            <div>
                <h1>Phản hồi về chúng tôi</h1>
                    <span>
                        <p>Hãy nói lên vấn đề của bạn Chúng tôi luôn ghi nhận sự đóng góp của bạn để giúp Petsland ngày càng cải thiện hơn.</p>
                    </span>
                    <div class="social">
                    <ul class="sci">
                        <li><a href="https://www.facebook.com/NHP1492"><i class="fa fa-facebook-official" aria-hidden="true" accesskey="facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/phucnguyen0006/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://twitter.com/NguynHu45975471"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
         
        <div class="feedbackForm">
            <h2>Cung cấp phản hồi cho chúng tôi</h2>
            <div class="formBox">
            <form method="post" action="add_cart.php?idkh=<?=$id?>">
                    <div class="inputBox w50">
                        <input type="text" name="namesend" required="" >
                        <span>Họ Và Tên</span>
                    </div>
                    <div class="inputBox w100">
                        <textarea required="" name="textsend"></textarea>
                        <span>Nhập phản hồi ở đây</span>
                    </div>
                    <div class="inputBox w100">
                        <input type="submit" name="sendfeed" value="Gửi">
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>
    <div class="appear_feedback">
        
    </div>
    <section class="contact">
        <div class="content">
            <h2 id="contactus">Liên hệ với chúng tôi</h2>
            <p>Petlands luôn phục vụ các bạn tình hình công việc ở Petlands ngày một nhiều nên sẽ xảy ra đôi chút chậm trễ,hy vọng không để ảnh hưởng đến các thành viên của Petlands</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box2">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>petlandsfamily@gmail.com</p>
                    </div>
                </div>
                <div class="box2">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Địa chỉ</h3>
                        <p>Công Ty TNHH MTV Petlands Economy<br> nơi nào đó trong hư không</p>
                    </div>
                </div>
                <div class="box2">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Fax</h3>
                        <p>0250-2222-2222 - 037-355-0006</p>
                    </div>
                </div>
            </div>
            <div class="contactForm">
                <form>
                    <h2>Gửi tin nhắn cho tôi</h2>
                    <div class="inputBox">
                        <input type="text" name="" required="">
                        <span class="titlename">Your Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="" required="">
                        <span class="content_name">Your Email</span>
                    </div>
                    <div class="inputBox">
                        <input type="Adress" name="" required="">
                        <span>Your Adress</span>
                    </div>
                    <div class="inputBox">
                        <textarea required=""></textarea>
                        <span>Give us your problem</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value="SEND" />
                    </div>

                </form>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.menu_toggle').click(function(){
                $('.menu_toggle').toggleClass('active')
                $('nav').toggleClass('active')
            })
        })
    </script>
</html>