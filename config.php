<?php
error_reporting("all");
session_start();
$con = mysqli_connect('localhost', 'root', '');
mysqli_select_db($con, 'petservice');
mysqli_query($con, "set names 'utf8'");

?>
