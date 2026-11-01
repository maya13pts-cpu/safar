<?php
include 'db.php';
session_start();

// التحقق من تسجيل الدخول (إذا لم يكن مسجلاً، يحول لصفحة تسجيل الدخول)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_username = $_SESSION['username'];
$success_message = "";
$error_message = "";

// معالجة طلبات التعديل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $new_fullname = $_POST['full_name'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $new_phone = $_POST['phone']; // بيانات أخرى مطلوبة

        // تحديث البيانات في قاعدة البيانات
        $update_sql = "UPDATE user SET full_name='$new_fullname', username='$new_username', email='$new_email', phone='$new_phone' WHERE username='$current_username'";
        
        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['username'] = $new_username; // تحديث الجلسة باسم المستخدم الجديد
            $current_username = $new_username;
            $success_message = "تم تحديث البيانات بنجاح!";
        } else {
            $error_message = "خطأ في التحديث: " . $conn->error;
        }
    } 
    // معالجة طلب حذف الحساب
    elseif (isset($_POST['delete_account'])) {
        $delete_sql = "DELETE FROM user WHERE username='$current_username'";
        if ($conn->query($delete_sql) === TRUE) {
            session_destroy();
            header("Location: register.php");
            exit();
        } else {
            $error_message = "فشل حذف الحساب.";
        }
    }
}

// جلب بيانات المستخدم الحالية لعرضها في الصفحة
$sql = "SELECT * FROM user WHERE username='$current_username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>صفحة الحساب - منصة سَفَر</title>
    <style>
        body { font-family: Tahoma, sans-serif; background-color: #f7f4ef; color: #333; text-align: center; padding: 30px; }
        .container { background: white; max-width: 500px; margin: 0 auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-top: 5px solid #6b4f3b; text-align: right; }
        h2 { color: #6b4f3b; text-align: center; }
        label { display: block; margin-top: 10px; font-weight: bold; color: #553d2d; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        button { background-color: #6b4f3b; color: white; border: none; padding: 12px; width: 100%; border-radius: 6px; font-size: 16px; cursor: pointer; margin-top: 15px; }
        button:hover { background-color: #553d2d; }
        .delete-btn { background-color: #d9534f; margin-top: 10px; }
        .delete-btn:hover { background-color: #c9302c; }
        .success { color: #2b542c; background: #dff0d8; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .error { color: #a94442; background: #f2dede; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
        .nav-links { text-align: center; margin-top: 20px; }
        .nav-links a { color: #6b4f3b; text-decoration: none; margin: 0 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>إدارة الحساب الشخصي</h2>

        <?php if(!empty($success_message)) echo "<div class='success'>$success_message</div>"; ?>
        <?php if(!empty($error_message)) echo "<div class='error'>$error_message</div>"; ?>

        <form method="POST" action="">
            <label>الاسم الكامل:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>

            <label>اسم المستخدم:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>رقم الجوال (بيانات أخرى):</label>
            <input type="text" name="phone" value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : ''; ?>">

            <button type="submit" name="update_profile">تحديث البيانات</button>
        </form>

        <form method="POST" action="" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف الحساب؟');">
            <button type="submit" name="delete_account" class="delete-btn">حذف الحساب</button>
        </form>

        <div class="nav-links">
            <a href="index.php">العودة للرئيسية</a> | 
            <a href="logout.php">تسجيل الخروج</a>
        </div>
    </div>

</body>
</html>