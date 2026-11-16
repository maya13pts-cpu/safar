<?php
session_start();
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
            --primary-accent: #ba9275;    
            --dark-brown: #b59782;        
            --btn-beige: #a58f70; 
        }

        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('tt.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* الهيدر المطابق لشعار وثيم المنصة */
        header {
            background-color: rgba(242, 233, 220, 0.95);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #d6c4a9;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 70px;
            height: 70px;
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
            color: #fff;
        }

        nav a:hover {
            opacity: 0.85;
        }

        /* قسم الواجهة الرئيسية */
        .hero {
            text-align: center;
            padding: 25px 20px 10px 20px;
            max-width: 800px;
            margin: auto;
        }

        .hero h1 {
            color: #ffffff;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            color: #f0e6dc;
            font-size: 15px;
            line-height: 1.7;
            max-width: 650px;
            margin: 0 auto 15px auto;
            font-weight: 600;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        .hero-btns {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-main-action {
            background-color: var(--primary-accent);
            color: white;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .btn-main-action:hover {
            background-color: var(--dark-brown);
            transform: translateY(-2px);
        }

        .btn-sec-action {
            background-color: var(--btn-beige);
            color: #fff;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-sec-action:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }

        /* الكروت السفلية */
        .content {
            margin: 10px auto 25px auto;
            max-width: 750px;
            padding: 0 20px;
            text-align: right;
        }

        .box {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 20px;
            margin-bottom: 12px;
            border-radius: 16px;
            border-right: 6px solid var(--primary-accent);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            gap: 20px;
            align-items: center;
            color: #333;
        }

        .box img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 10px;
            background: #f7f3ee;
            padding: 8px;
            filter: sepia(100%) hue-rotate(330deg) saturate(250%) brightness(85%);
        }

        .box-info h3 {
            color: var(--dark-brown);
            margin: 0 0 4px 0;
            font-size: 17px;
            font-weight: 800;
        }

        .box-info p {
            color: #665548;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }

        /* شريط تنبيه الكوكيز */
        #cookie-banner {
            text-align: center;
            padding: 10px;
            background: rgba(0, 0, 0, 0.3);
            font-size: 12px;
            color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        .cookie-btn {
            background: transparent;
            border: 1px solid #ba9275;
            color: #f0e6dc;
            padding: 3px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 11px;
            font-family: 'Cairo', sans-serif;
            font-weight: 600;
            transition: all 0.3s;
        }

        .cookie-btn:hover {
            background-color: #ba9275;
            color: #fff;
        }
    </style>
</head>
<body>
<header class="main-header">
    <div class="logo-area">
        <img src="ww.JPEG" alt="شعار سفر" class="logo-img" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;">
        <div class="logo-text">سَفَر | SAFAR</div>
    </div>
    <nav class="nav-links">
        <a href="index.php">الرئيسية</a>
        <a href="sefer.php">الرحلات والتجارب</a>
        
        <?php 
        // إذا كان المستخدم مسجل دخوله، يظهر له زر "رفع الملفات" و"حسابي" و"تسجيل الخروج"
        if (isset($_SESSION['username'])) { 
        ?>
            <a href="upload.php">شاركنا رأيك</a>
            <a href="account.php" class="btn-account">حسابي</a>
            <a href="logout.php" class="btn-logout">تسجيل الخروج</a>
        <?php 
        } else { 
            // أما إذا كان زائراً، يظهر له خيار إنشاء حساب وتسجيل الدخول فقط
        ?>
            <a href="register.php">إنشاء حساب</a>
            <a href="login.php" class="btn-register">تسجيل الدخول</a>
        <?php 
        } 
        ?>
    </nav>
</header>
   
<div class="hero">
    <h1>اكتشف روح المملكة مع أهلها</h1>
    <p>منصة سَفَر: وجهتك الأولى لاستكشاف أجمل التجارب التراثية، رحلات الهايكنج، الحرف اليدوية، وبرفقَة مرشدين محليين.</p>
    
    <div class="hero-btns">
        <a href="sefer.php" class="btn-main-action">تصفح الرحلات والخدمات</a>
      <?php 
      if (!isset($_SESSION['username'])) { 
      ?>
          <a href="register.php" class="btn-sec-action">انضم إلينا الآن</a>
      <?php 
      } 
      ?>
    </div>
</div>

<div class="content">
    <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="مرشدون محليون">
        <div class="box-info">
            <h3>مرشدون محليون معتمدون</h3>
            <p>تواصل مباشرة مع أهل المنطقة وأصحاب الخبرة، لتكتشف الأسرار الخفية والقصص الأصيلة في كل وجهة سياحية.</p>
        </div>
    </div>

    <div class="box">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" alt="تجربة تراثية أصيلة">
        <div class="box-info">
            <h3>تجربة تراثية وثقافية أصيلة</h3>
            <p>عش تفاصيل الثقافة السعودية الحقيقية وتجارب الضيافة العريقة وسط الطبيعة التاريخية الخلابة بكل سهولة.</p>
        </div>
    </div>
</div>

<!-- تنبيه الكوكيز -->
<div id="cookie-banner">
    <span>هذا الموقع يستخدم ملفات تعريف الارتباط (الكوكيز) لتحسين تجربة الاستخدام.</span>
    <button class="cookie-btn" onclick="acceptCookies()">موافق</button>
</div>

<script>
    function acceptCookies() {
        document.getElementById('cookie-banner').style.display = 'none';
    }
</script>

</body>
</html>