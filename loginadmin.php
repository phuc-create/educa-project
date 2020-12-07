<?php
session_start();
include("config.php");
error_reporting("all");
if(isset($_POST["login"])){
    $account = $_POST["account"];
    $password = $_POST["password"];
    $account = mysqli_real_escape_string($con,$account);
    $password = mysqli_real_escape_string($con,$password);
    $result = mysqli_query($con,"select * from employee where tk_nv='$account' and mk_nv='$password'");
    $row = mysqli_num_rows($result);
    if($row==1){
       $_SESSION["success"] = $account;
        header("location:indexadmin.php");
    }
    else{
        echo("Có lẽ bạn là người lạ ???");
        header("refresh:1.5;url=login.php");
    }
}
else
{
    header("location:login.php");
}

?>