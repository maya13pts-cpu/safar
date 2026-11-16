<?php
$host = "localhost";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password);

if ($conn == true) {
    mysqli_select_db($conn, "safar");
//لدعم النصوص العربية في قاعدة البيانات
    mysqli_set_charset($conn, "utf8");
}

?>