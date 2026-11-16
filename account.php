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

if (isset($_POST['update_profile'])) {
    $new_fullname = $_POST['full_name'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    
    // تحديث البيانات في قاعدة البيانات
    $update_sql = "UPDATE users SET full_name='$new_fullname', username='$new_username', email='$new_email', phone='$new_phone' WHERE username='$current_username'";
    $update_res = mysqli_query($conn, $update_sql);

    if ($update_res) {
        $_SESSION['username'] = $new_username; // تحديث الجلسة باسم المستخدم الجديد
        $current_username = $new_username;
        $success_message = "تم تحديث البيانات بنجاح!";
    } else {
        $error_message = "خطأ في التحديث: " . mysqli_error($conn);
    }
}
// معالجة طلب حذف الحساب (تم تصحيح اسم الجدول إلى users ليتطابق مع قاعدة البيانات)
elseif (isset($_POST['delete_account'])) {
    $delete_sql = "DELETE FROM users WHERE username='$current_username'";
    $delete_res = mysqli_query($conn, $delete_sql);

    if ($delete_res) {
        session_destroy();
        header("Location: register.php");
        exit();
    } else {
        $error_message = "فشل حذف الحساب.";
    }
} 

// جلب بيانات المستخدم الحالية لعرضها في الصفحة (تم توحيد اسم المتغير إلى $user)
$sql = "SELECT * FROM users WHERE username='$current_username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحساب - منصة سَفَر</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-brown: #3C2A21;
            --accent-gold: #C5A059;
            --gold-hover: #A6823C;
            --cream-bg: #FAF7F2;
        }

        body { 
            font-family: 'Tajawal', sans-serif; 
            background: linear-gradient(rgba(250, 247, 242, 0.9), rgba(245, 239, 230, 0.95)), url('tt.jpeg');
            background-size: cover;
            background-position: center;
            color: var(--primary-brown); 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 40px 0;
        }

        .container { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            max-width: 520px; 
            width: 100%;
            margin: 0 auto; 
            padding: 45px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.08); 
            border: 1px solid rgba(197, 160, 89, 0.3);
            box-sizing: border-box;
            text-align: right; 
        }

        h2 { 
            color: var(--primary-brown); 
            text-align: center; 
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 26px;
        }

        label { 
            display: block; 
            margin-top: 15px; 
            font-weight: 700; 
            color: var(--primary-brown); 
            font-size: 14px;
        }

        input { 
            width: 100%; 
            padding: 13px 15px; 
            margin-top: 8px; 
            border: 1px solid #E0D6C8; 
            border-radius: 12px; 
            box-sizing: border-box; 
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            background-color: #FAF8F5;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--accent-gold);
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.25);
            background-color: #fff;
        }

        button { 
            background-color: var(--accent-gold); 
            color: white; 
            border: none; 
            padding: 14px; 
            width: 100%; 
            border-radius: 30px; 
            font-size: 16px; 
            font-weight: 700;
            cursor: pointer; 
            margin-top: 20px; 
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
        }

        button:hover { 
            background-color: var(--gold-hover); 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }

        .delete-btn { 
            background-color: #d9534f; 
            margin-top: 10px; 
            border-radius: 30px;
        }
        
        .delete-btn:hover { 
            background-color: #c9302c; 
            box-shadow: 0 5px 15px rgba(217, 83, 79, 0.3);
        }

        .success { 
            color: #2b542c; 
            background: #dff0d8; 
            padding: 12px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            text-align: center; 
            border: 1px solid #d6e9c6;
            font-size: 14px;
        }

        .error { 
            color: #a94442; 
            background: #f2dede; 
            padding: 12px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            text-align: center; 
            border: 1px solid #ebccd1;
            font-size: 14px;
        }

        .nav-links { 
            text-align: center; 
            margin-top: 25px; 
        }

        .nav-links a { 
            color: var(--accent-gold); 
            text-decoration: none; 
            margin: 0 10px; 
            font-weight: 500;
            font-size: 15px;
        }

        .nav-links a:hover { 
            color: var(--gold-hover);
            text-decoration: underline; 
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>إدارة الحساب الشخصي</h2>
        <?php 
        if ($success_message != "") { 
            echo "<div class='success'>" . $success_message . "</div>"; 
        } 
        if ($error_message != "") { 
            echo "<div class='error'>" . $error_message . "</div>"; 
        } 
        ?> 
        
        <form method="POST" action="">
            <label>الاسم الكامل:</label>
            <input type="text" name="full_name" value="<?php echo isset($user['full_name']) ? $user['full_name'] : ''; ?>" required>

            <label>اسم المستخدم:</label>
            <input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" required>

            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>

            <label>رقم الجوال:</label>
            <input type="text" name="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : ''; ?>">

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