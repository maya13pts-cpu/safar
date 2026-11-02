<?php
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $phone     = $_POST['phone'];

    $sql = "INSERT INTO user (full_name, username, email, password, phone) VALUES ('$full_name', '$username', '$email', '$password', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $message = "خطأ في التسجيل: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب جديد - سَفَر</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f7f4ef;
            color: #a78e8e;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .register-card {
            background: #ffffff;
            padding: 35px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(147, 76, 76, 0.08);
            border-top: 5px solid #dcc5b6;
            width: 100%;
            max-width: 400px;
        }
        
        h2 {
            color: #c8ad99;
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
            color: #baa18f;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            outline: none;
        }
        input:focus {
            border-color: #9f8979;
        }
        button {
            background-color: #a18875;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            font-weight: bold;
        }
        button:hover {
            background-color: #957f70;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .login-link a {
            color: #a58b78;
            text-decoration: none;
            font-weight: bold;
        }
        .error {
            color: #a94442;
            background: #f2dede;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h2>إنشاء حساب جديد</h2>
        
        <?php if(!empty($message)) echo "<div class='error'>$message</div>"; ?>

        <form method="POST" action="">
            <label>الاسم الكامل:</label>
            <input type="text" name="full_name" required>

            <label>اسم المستخدم:</label>
            <input type="text" name="username" required>

            <label>البريد الإلكتروني:</label>
            <input type="email" name="email" required>

            <label>كلمة المرور:</label>
            <input type="password" name="password" required>

            <label>رقم الجوال:</label>
            <input type="text" name="phone">

            <button type="submit">تسجيل</button>
        </form>

        <div class="login-link">
            لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a>
        </div>
    </div>

</body>
</html>