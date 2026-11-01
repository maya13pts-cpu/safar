<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرئيسية - سَفَر | SAFAR</title>
    <!-- استدعاء خط Cairo الفخم -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-beige: #f7f4ef;          
            --primary-accent: #a3704c;    
            --dark-brown: #4a3525;        
            --btn-beige: #d8c3a5;
        }

        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-beige);
            color: #333;
            min-height: 100vh;
        }

        /* الهيدر المطابق لشعار وثيم المنصة */
        header {
            background-color: #f2e9dc;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e6d7c3;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            color: var(--dark-brown);
        }

        nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        nav a {
            color: var(--dark-brown);
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            padding: 8px 18px;
            border-radius: 20px;
            transition: all 0.3s;
        }

        nav a.btn-register {
            background-color: var(--btn-beige);
            color: var(--dark-brown);
        }

        nav a:hover {
            opacity: 0.85;
        }

        /* قسم الواجهة الرئيسية */
        .hero {
            text-align: center;
            padding: 60px 20px 30px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            color: var(--dark-brown);
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .hero p {
            color: #6b4f3b;
            font-size: 17px;
            line-height: 1.8;
            max-width: 650px;
            margin: 0 auto 25px auto;
            font-weight: 600;
        }

        .hero-btns {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-main-action {
            background-color: var(--primary-accent);
            color: white;
            padding: 12px 28px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 4px 15px rgba(163, 112, 76, 0.2);
            transition: all 0.3s;
        }

        .btn-main-action:hover {
            background-color: var(--dark-brown);
            transform: translateY(-2px);
        }

        .btn-sec-action {
            background-color: var(--btn-beige);
            color: var(--dark-brown);
            padding: 12px 28px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s;
        }

        .btn-sec-action:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }

        /* كروت الاستعراض السفلية */
        .content {
            margin: 20px auto 50px auto;
            max-width: 800px;
            padding: 0 20px;
            text-align: right;
        }

        .box {
            background: #ffffff;
            padding: 18px;
            margin-bottom: 20px;
            border-radius: 16px;
            border-right: 6px solid var(--primary-accent);
            box-shadow: 0 4px 15px rgba(74, 53, 37, 0.05);
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .box img {
            width: 140px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
        }

        .box-info h3 {
            color: var(--dark-brown);
            margin: 0 0 6px 0;
            font-size: 19px;
            font-weight: 800;
        }

        .box-info p {
            color: #665548;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-area">
        <img src="ww.jpeg" alt="شعار سَفَر" class="logo-img" onerror="this.src='logo.png';">
        <div class="logo-text">سَفَر | SAFAR</div>
    </div>
    <nav>
        <a href="index.php">الرئيسية</a>

        <?php if (isset($_SESSION['username'])): ?>
            <a href="account.php" class="btn-register">حسابي</a>
            <a href="logout.php">تسجيل الخروج</a>
        <?php else: ?>
            <a href="register.php">إنشاء حساب</a>
            <a href="login.php" class="btn-register">تسجيل الدخول</a>
        <?php endif; ?>
    </nav>
</header>
   
<div class="hero">
    <h1>اكتشف روح المملكة مع أهلها</h1>
    <p>منصة سَفَر: وجهتك الأولى لاستكشاف أجمل التجارب التراثية، رحلات الهايكنج، الحرف اليدوية، وبرفقَة مرشدين محليين.</p>
    
    <div class="hero-btns">
        <a href="sefer.php" class="btn-main-action">تصفح الرحلات والخدمات</a>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="register.php" class="btn-sec-action">انضم إلينا الآن</a>
        <?php endif; ?>
    </div>
</div> 

<div class="content">
    <div class="box">
        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=300&q=80" alt="هايكنج جبال السودة">
        <div class="box-info">
            <h3>جولة هايكنج في جبال السودة</h3>
            <p>استكشف المسارات الجبلية وأجواء الضباب الساحرة في أبها برفقة مرشد محلي.</p>
        </div>
    </div>

    <div class="box">
        <img src="pottery.jpeg" alt="فخار العلا" onerror="this.src='https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=300&q=80';">
        <div class="box-info">
            <h3>ورشة صناعة فخار في العلا</h3>
            <p>عش أصالة التراث العريق وتعرف على حرف الأجداد الطينية وسط الطبيعة التاريخية الخلابة.</p>
        </div>
    </div>
</div>

</body>
</html>