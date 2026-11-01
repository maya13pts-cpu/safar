<?php
include 'db.php';
session_start();

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // استعلام البحث عن المستخدم بواسطة اسم المستخدم في جدول user
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // مطابقة كلمة المرور (مقارنة مباشرة مثل ما اتفقنا)
        if ($password == $row['password']) {
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); // التحويل للصفحة الرئيسية بعد النجاح
            exit();
        } else {
            $error = "كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "اسم المستخدم غير مسجل.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - منصة سَفَر</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f7f4ef; color: #333; text-align: center; padding: 50px; }
        .form-container { background: white; max-width: 400px; margin: 0 auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-top: 5px solid #6b4f3b; }
        h2 { color: #6b4f3b; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; text-align: right; }
        button { background-color: #6b4f3b; color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #553d2d; }
        .error { color: #d9534f; margin-bottom: 15px; font-size: 14px; }
        a { color: #6b4f3b; text-decoration: none; display: block; margin-top: 15px; }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>تسجيل الدخول</h2>
        <?php if(!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST" action="">
            <!-- حقل اسم المستخدم -->
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            
            <!-- حقل كلمة المرور -->
            <input type="password" name="password" placeholder="كلمة المرور" required>
            
            <button type="submit">تسجيل الدخول</button>
        </form>
        <a href="register.php">ليس لديك حساب؟ إنشاء حساب جديد</a>
    </div>

</body>
</html>