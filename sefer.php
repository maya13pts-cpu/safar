<?php
session_start();
include 'db.php';
// معالجة إضافة الرحلة للسلة والتوجيه المباشر
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['trip_id'];
    $name = $_POST['trip_name'];
    $price = (float)$_POST['trip_price'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }

    header("Location: cart.php");
    exit();
}
$tours = [
    [
        "id" => 1,
        "title" => "جولة هايكنج في جبال السودة",
        "location" => "منطقة عسير - جبال السودة، أبها",
        "desc" => "استكشاف المسارات الجبلية الوعرة وأجواء الضباب الساحرة في أبها برفقة مرشد محلي خبير.",
        "price" => 150,
        "duration" => "4 ساعات",
        "guide" => "فهد القحطاني",
        "guide_role" => "مرشد مرتفعات وطبيعة"
    ],
    [
        "id" => 2,
        "title" => "ورشة صناعة فخار في العلا",
        "location" => "منطقة الحجر التاريخية - محافظة العلا",
        "desc" => "عش أصالة التراث العريق وتعرف على حرف الأجداد الطينية وسط الطبيعة التاريخية الخلابة.",
        "price" => 100,
        "duration" => "3 ساعات",
        "guide" => "نورة العتيبي",
        "guide_role" => "أخصائية حرف تراثية"
    ],
    [
        "id" => 3,
        "title" => "تجربة غزل الصوف التقليدي",
        "location" => "القرية التراثية - الطائف",
        "desc" => "تعلم حياكة صوف الغنم وصنع خيوط وملابس تقليدية يدوياً على أصول الأجداد.",
        "price" => 70,
        "duration" => "ساعتان ونصف",
        "guide" => "نورة العتيبي",
        "guide_role" => "أخصائية حرف تراثية"
    ],
    [
        "id" => 4,
        "title" => "رحلة سفاري وكثبان الصحراء",
        "location" => "الصحراء الشرقية - رمال الربع الخالي",
        "desc" => "مغامرة استكشاف الكثبان الرملية الذهبية، ركوب الإبل، وجلسة سمر تقليدية تحت النجوم.",
        "price" => 250,
        "duration" => "6 ساعات",
        "guide" => "سالم المري",
        "guide_role" => "دليل الصحراء والبدو"
    ],
    [
        "id" => 5,
        "title" => "جولة مزارع النخيل والعيون",
        "location" => "واحة الأحساء التاريخية",
        "desc" => "استمتع بجولة هادئة بين ملايين النخيل والينابيع الطبيعية العذبة مع تذوق التمور المحلية.",
        "price" => 80,
        "duration" => "3 ساعات",
        "guide" => "فهد القحطاني",
        "guide_role" => "مرشد بيئي واحات"
    ],
    [
        "id" => 6,
        "title" => "رحلة بحرية واستكشاف الساحل",
        "location" => "ساحل البحر الأحمر - أملج",
        "desc" => "جولة بحرية ساحرة في مياه البحر الأحمر الصافية والتعرف على ثقافة الصيد والبيئة البحرية.",
        "price" => 200,
        "duration" => "5 ساعات",
        "guide" => "سالم المري",
        "guide_role" => "قائد رحلات بحرية"
    ]
];
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الرحلات والخدمات - سَفَر</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-beige: #f7f4ef;          
            --primary-accent: #a3704c;    
            --dark-brown: #bfb2a9;        
            --btn-beige: #a58f70;
        }

        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            background-color: var(--bg-beige);
            color: #333;
            min-height: 100vh;
        }

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

        header nav a {
            color: var(--dark-brown);
            text-decoration: none;
            margin-left: 20px;
            font-weight: 700;
            font-size: 15px;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s;
        }

        header nav a.btn-nav-auth {
            background-color: var(--btn-beige);
            color: var(--dark-brown);
        }

        header nav a:hover {
            opacity: 0.8;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: var(--dark-brown);
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #8c7361;
            margin-bottom: 35px;
            font-size: 16px;
            font-weight: 600;
        }

        .tour-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 4px 18px rgba(74, 53, 37, 0.05);
            border: none;
            border-right: 6px solid var(--primary-accent);
        }

        .tour-title {
            color: var(--dark-brown);
            font-size: 22px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 6px;
        }

        .location {
            font-size: 14px;
            color: var(--primary-accent);
            margin-bottom: 12px;
            font-weight: 700;
        }

        .desc {
            font-size: 14px;
            color: #665548;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .meta-box {
            background: #faf6f0;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--dark-brown);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            font-weight: 600;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f2e9dc;
            padding-top: 16px;
        }

        .price {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-accent);
        }

        .btn-book {
            background-color: var(--btn-beige);
            color: var(--dark-brown);
            border: none;
            padding: 10px 28px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 15px;
        }

        .btn-book:hover {
            background-color: var(--primary-accent);
            color: white;
        }
         body {
    font-family: Tahoma, sans-serif;
    margin: 0;
    background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.8)), url('tt.jpeg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
}

    </style>
</head>
<body>

    <header>
        <div class="logo-area">
            <img src="1000048940.jpg" alt="شعار سَفَر" class="logo-img" onerror="this.style.display='none';">
            <div class="logo-text">سَفَر | SAFAR</div>
        </div>
        <nav>
            <a href="index.php">الرئيسية</a>
            <a href="services.php">الرحلات والخدمات</a>
            <?php if(isset($_SESSION['username'])): ?>
                <a href="account.php" class="btn-nav-auth">حسابي</a>
                <a href="logout.php">تسجيل الخروج</a>
            <?php else: ?>
                <a href="login.php" class="btn-nav-auth">تسجيل الدخول</a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="container">
        <h1>استكشف وجهات وتجارب سَفَر</h1>
        <div class="subtitle">اختر جولتك السياحية التراثية المفضلة واستعرض التفاصيل الدقيقة لكل رحلة</div>

        <?php foreach($tours as $tour): ?>
            <div class="tour-card">
                <div class="tour-title"><?php echo $tour['title']; ?></div>
                <div class="location">📍 الموقع: <?php echo $tour['location']; ?></div>
                <div class="desc"><?php echo $tour['desc']; ?></div>
                
                <div class="meta-box">
                    <div>🧭 <strong>المرشد:</strong> <?php echo $tour['guide']; ?> (<?php echo $tour['guide_role']; ?>)</div>
                    <div>⏰ <strong>المدة:</strong> <?php echo $tour['duration']; ?></div>
                </div>
                
                <div class="card-footer">
                    <div class="price"><?php echo $tour['price']; ?> ر.س</div>
                    <?php if(isset($_SESSION['username'])): ?>
                        <a href="booking.php?id=<?php echo $tour['id']; ?>&title=<?php echo urlencode($tour['title']); ?>&price=<?php echo $tour['price']; ?>&guide=<?php echo urlencode($tour['guide']); ?>" class="btn-book">حجز التجربة</a>
                    <?php else: ?>
                        <a href="login.php" class="btn-book" onclick="alert('يرجى تسجيل الدخول أولاً لإتمام الحجز.');">حجز التجربة</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
