<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "safar";

$conn = mysqli_connect($host, $username, $password, $dbname);

// التأكد من نجاح الاتصال
if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}

// ضبط الترميز ليدعم اللغة العربية
mysqli_set_charset($conn, "utf8");
?>