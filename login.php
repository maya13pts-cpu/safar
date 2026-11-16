<?php
include 'db.php';
session_start();

$error = "";

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    
    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;

        // إذا تم تفعيل خيار "تذكرني"، يتم حفظ الكوكي لمدة 7 أيام مع خصائص الأمان
        if (isset($_POST['remember'])) {
            setcookie("users", $username, time() + (86400 * 7), "/", "", false, true);
        }

        header("Location: index.php");
        exit();
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - منصة سَفَر</title>
    
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
            padding: 30px 0;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            border: 1px solid rgba(197, 160, 89, 0.3);
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.08);
            padding: 60px 45px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            text-align: right;
        }

        h2 { 
            color: var(--primary-brown); 
            margin-bottom: 35px;
            font-weight: 700;
            text-align: center;
            font-size: 28px;
        }

        .form-control, input[type="text"], input[type="password"] {
            width: 100%;
            border-radius: 12px;
            border: 1px solid #E0D6C8;
            padding: 15px;
            background-color: #FAF8F5;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--accent-gold);
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.25);
            background-color: #fff;
        }

        /* تنسيق خيار تذكرني ليكون منسقاً مع تصميمك */
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-gold {
            background-color: var(--accent-gold);
            color: #fff !important;
            font-weight: 700;
            border-radius: 30px;
            padding: 15px 24px;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-gold:hover {
            background-color: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }

        .error { 
            color: #d9534f; 
            margin-bottom: 20px; 
            font-size: 14px; 
            background: #fdf2f2;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
            text-align: center;
        }

        a { 
            color: var(--accent-gold); 
            text-decoration: none; 
            display: block; 
            margin-top: 30px; 
            font-size: 15px;
            font-weight: 500;
            text-align: center;
        }

        a:hover {
            color: var(--gold-hover);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>تسجيل الدخول</h2>
        
       <?php 
        if ($error != "") { 
            echo "<div class='error'>" . $error . "</div>"; 
        } 
        ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label fw-bold mb-2">اسم المستخدم</label>
                <input type="text" name="username" placeholder="أدخل اسم المستخدم" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold mb-2">كلمة المرور</label>
                <input type="password" name="password" placeholder="أدخل كلمة المرور" required>
            </div>

            <!-- خيار تذكرني المطلوب -->
            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">تذكرني لمدة 7 أيام</label>
            </div>
            
            <button type="submit" class="btn-gold">تسجيل الدخول</button>
        </form>
        
        <a href="register.php">ليس لديك حساب؟ إنشاء حساب جديد</a>
    </div>

</body>
</html>