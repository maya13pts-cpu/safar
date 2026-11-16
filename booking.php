<?php
// بدء جلسة العمل والاتصال بقاعدة البيانات
session_start();
include("db.php"); 
include("tours_data.php");

// استقبال رقم الرحلة المرسل من الرابط
if (isset($_GET['id'])) {
    $trip_id = $_GET['id'];
} else {
    $trip_id = 1;
}

// نبحث عن الرحلة في المصفوفة (نفس مصفوفة صفحة الرحلات)
$found = false;
foreach ($tours as $tour) {
    if ($tour['id'] == $trip_id) {
        $found = true;
        $title = $tour['title'];
        $price = $tour['price'] . " ريال سعودي";
        $description = $tour['desc'];
        $guide = $tour['guide'] . " (" . $tour['guide_role'] . ")";
        $location = $tour['location'];
        $duration = $tour['duration'];
    }
}

// إذا الرحلة غير موجودة نرجع لصفحة الرحلات
if ($found == false) {
    header("Location: sefer.php");
    exit();
}

// معالجة الانتقال لصفحة الدفع عند النقر على زر الحجز
if (isset($_POST['book_now'])) {
    $selected_day = $_POST['trip_day'];
    $selected_time = $_POST['trip_time'];
    header("Location: checkout.php?id=$trip_id&day=$selected_day&time=$selected_time");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>منصة سَفَر - تفاصيل وحجز التجربة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(rgba(250, 247, 242, 0.9), rgba(245, 239, 230, 0.95)), url('tt.jpeg');
            background-size: cover;
            background-position: center;
            color: #3C2A21;
            margin: 0;
            padding: 30px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.08);
            border: 1px solid rgba(197, 160, 89, 0.3);
            border-top: 6px solid #C5A059;
        }
        h1 {
            color: #3C2A21;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 900;
        }
        .trip-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .details-section {
            margin: 20px 0;
            line-height: 2;
            background: #FAF8F5;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #E0D6C8;
        }
        .price {
            color: #C5A059;
            font-size: 26px;
            font-weight: 900;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 700;
            display: block;
            margin-bottom: 8px;
            color: #3C2A21;
        }
        select {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #E0D6C8;
            background-color: #FAF8F5;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            outline: none;
            color: #3C2A21;
        }
        .btn-book {
            background-color: #C5A059;
            color: white;
            font-weight: 700;
            padding: 14px;
            width: 100%;
            border-radius: 30px;
            cursor: pointer;
            border: none;
            font-size: 16px;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }
        .btn-book:hover {
            background-color: #A6823C;
            transform: translateY(-2px);
        }
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 15px;
            color: #666;
            font-size: 14px;
        }
        footer a {
            color: #C5A059;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- عرض تفاصيل الرحلة الصحيحة والخاصة بمشروعكم فقط -->
    <h1><?php echo $title; ?></h1>
    
    <div class="details-section">
        <div class="price">السعر: <?php echo $price; ?></div>
        <p><strong>الوصف:</strong> <?php echo $description; ?></p>
        <p><strong>المرشد المحلي المسؤول:</strong> <?php echo $guide; ?></p>
        <p><strong>الموقع الجغرافي:</strong> <?php echo $location; ?></p>
        <p><strong>المدة:</strong> <?php echo $duration; ?></p>
    </div>

    <hr style="border: 0; border-top: 1px solid #E0D6C8; margin: 25px 0;">

    <!-- نظام الحجز التفاعلي -->
    <form action="" method="POST">
        <h3 style="color: #3C2A21; margin-bottom: 15px;">نظام الحجز التفاعلي</h3>
        
        <div class="form-group">
            <label for="trip_day">اختيار اليوم المناسب:</label>
            <select name="trip_day" id="trip_day" required>
                <option value="">-- اختاري اليوم --</option>
                <option value="2026-06-10">الخميس - 2026/06/10</option>
                <option value="2026-06-11">الجمعة - 2026/06/11</option>
                <option value="2026-06-12" disabled>السبت - 2026/06/12 (محجوز بالكامل)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="trip_time">اختيار الوقت والساعة:</label>
            <select name="trip_time" id="trip_time" required>
                <option value="">-- اختاري الوقت --</option>
                <option value="04:00 PM">04:00 عصراً (متاح)</option>
                <option value="08:00 PM" disabled>08:00 مساءً (منتهي)</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" name="book_now" class="btn-book">حجز التجربة الآن (الانتقال للدفع)</button>
        </div>
    </form>
</div>

<footer>
    <p>جميع الحقوق محفوظة لمنصة سَفَر (Safar) &copy; 2026</p>
    <div>
        <a href="#">الشروط والأحكام</a> | 
        <a href="#">سياسة الخصوصية</a> | 
        <a href="#">الأسئلة الشائعة</a>
    </div>
</footer>

</body>
</html>