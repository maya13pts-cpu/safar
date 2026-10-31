<?php
// إعداد الاتصال بقاعدة البيانات
$host = "localhost";
$username = "root";
$password = "";
$database = "safar";

$conn = new mysqli($host, $username, $password, $database);

// التحقق من إرسال البيانات عبر نموذج التسجيل
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password']; // تخزين كلمة المرور بشكل مباشر بدون تشفير حسب الشرح البسيط
    $phone = $_POST['phone'];

    // استعلام الإدخال في جدول user
    $sql = "INSERT INTO user (full_name, username, email, password, phone) VALUES ('$full_name', '$user_name', '$email', '$pass', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>تم تسجيل الحساب بنجاح! <a href='login.php'>سجل دخول الآن</a></p>";
    } else {
        echo "<p style='color: red; text-align: center;'>خطأ في التسجيل: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب - منصة سَفَر</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f4f7f6; padding: 40px; }
        .form-container { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #555; }
        input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>إنشاء حساب جديد</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>الاسم الكامل:</label>
            <input type="text" name="full_name" required>
        </div>
        <div class="form-group">
            <label>اسم المستخدم:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>كلمة المرور:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>رقم الجوال:</label>
            <input type="text" name="phone">
        </div>
        <button type="submit">تسجيل</button>
    </form>
</div>

</body>
</html>