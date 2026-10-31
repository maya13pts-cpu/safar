<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>منصة سَفَر السياحية</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            background-color: #f7f3ed;
            color: #4a3525;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: #3b2b20;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #d4b595;
        }
        nav a {
            color: #f7f3ed;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            font-size: 15px;
        }
        nav a:hover {
            color: #d4b595;
        }
        .btn-register {
            background-color: #8c6239;
            color: white;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .btn-register:hover {
            background-color: #6f4e37;
        }
        .hero {
            padding: 45px 20px;
        }
        .hero h1 {
            color: #4a3525;
            font-size: 32px;
            margin-bottom: 12px;
        }
        .hero p {
            color: #7b6655;
            font-size: 16px;
            max-width: 650px;
            margin: 0 auto 25px auto;
            line-height: 1.6;
        }
        .content {
            margin: 30px auto;
            max-width: 800px;
            padding: 0 20px;
            text-align: right;
        }
        .box {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ebdccc;
            box-shadow: 0 2px 8px rgba(111, 78, 55, 0.05);
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .box img {
            width: 130px;
            height: 95px;
            object-fit: cover;
            border-radius: 6px;
        }
        .box-info h3 {
            color: #4a3525;
            margin-bottom: 6px;
            font-size: 18px;
        }
        .box-info p {
            color: #7b6655;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">سَفَر</div>
        <nav>
            <a href="index.php">الرئيسية</a>
            <a href="register.php" class="btn-register">تسجيل الدخول</a>
        </nav>
    </header>

    <div class="hero">
        <h1>اكتشف روح المملكة مع أهلها</h1>
        <p><strong>منصة سَفَر:</strong> وجهتك السياحية الأولى لاستكشاف أجمل التجارب التراثية، رحلات الهايكنج في الطبيعة، والتعرف على ثقافة المملكة الأصيلة برفقة مرشدين محليين.</p>
        <a href="register.php" class="btn-register" style="padding: 12px 28px; font-size: 16px;">انضم إلينا الآن</a>
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
            <!-- صورة فخار تراثية وطينية ترمز للعلا وأصالة الحرف اليدوية -->
            <img src="pottery.jpeg"alt="فخار العلا">
            <div class="box-info">
                <h3>ورشة صناعة فخار في العلا</h3>
                <p>عش أصالة التراث العريق وتعرف على حرف الأجداد الطينية وسط الطبيعة التاريخية الخلابة.</p>
            </div>
        </div>
    </div>

</body>
</html>