<?php
require 'ceklogin.php';

$h1 = mysqli_query($c,"select * from pesanan");
$h2 = mysqli_num_rows($h1);

 
$level = $_SESSION['level'];
if($level == 1) { include "admin.php"; }
if($level == 2) { include "staff.php"; }



?>





