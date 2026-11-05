<?php
// بدء جلسة العمل للتحقق من أن المستخدم مسجل دخول
session_start();
include 'db.php';

// منع فتح الصفحة إلا لمن سجل دخوله
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$message = "";

// التحقق من النقر على زر رفع الملف
if (isset($_POST['submitfile'])) {
    
    // استقبال معلومات الملف باستخدام مصفوفة $_FILES (حسب المحاضرة)
    $path = $_FILES['fileupload']['tmp_name']; // المسار المؤقت للملف على الخادم
    $name = $_FILES['fileupload']['name'];     // اسم الملف الأصلي
    $size = $_FILES['fileupload']['size'];     // حجم الملف
    $type = $_FILES['fileupload']['type'];     // نوع الملف
    
    // تحديد مجلد الوجهة لحفظ الملفات بداخله
    $dir_name = "upload/";
    
    // دالة رفع ونقل الملف إلى مجلد الوجهة على الخادم (حسب المحاضرة)
    if (move_uploaded_file($path, $dir_name . $name)) {
        $message = "تم رفع الملف بنجاح: " . $name;
    } else {
        $message = "حدث خطأ أثناء رفع الملف، يرجى المحاولة مجدداً.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>رفع الملفات - منصة سَفَر</title>
    <!-- استدعاء خط Tajawal ليتطابق مع باقي الصفحات -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        /* مطابقة خلفية صفحة تسجيل الدخول تماماً (تدرج لوني شفّاف مع صورة hero-bg) */
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(rgba(250, 247, 242, 0.9), rgba(245, 239, 230, 0.95)), url('hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: #3C2A21;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 30px 0;
            box-sizing: border-box;
        }

        /* تنسيق البطاقة الوسطى الطولية المتناسقة تماماً مع صفحة تسجيل الدخول */
        .upload-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.08);
            border: 1px solid rgba(197, 160, 89, 0.3);
            border-top: 6px solid #C5A059;
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            color: #3C2A21;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 24px;
        }

        p {
            font-weight: 600;
            color: #3C2A21;
            font-size: 14px;
            text-align: right;
            margin-top: 15px;
        }

        /* تنسيق حقل اختيار الملف ليكون متناسقاً ومرتباً */
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #E0D6C8;
            border-radius: 12px;
            background-color: #FAF8F5;
            box-sizing: border-box;
            outline: none;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            cursor: pointer;
        }

        /* تنسيق زر الرفع ليكون مطابقاً لزر تسجيل الدخول */
        button, input[type="submit"] {
            background-color: #C5A059;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 700;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }

        button:hover, input[type="submit"]:hover {
            background-color: #A6823C;
            transform: translateY(-2px);
        }

        /* صندوق رسالة النجاح */
        .msg {
            color: #2e7d32;
            background: #e8f5e9;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #c8e6c9;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
        }

        /* رابط العودة للصفحة الرئيسية */
        .home-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .home-link a {
            color: #C5A059;
            text-decoration: none;
            font-weight: 700;
        }

        .home-link a:hover {
            color: #A6823C;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="upload-card">
        <h2>رفع ملفات الرحلات أو الحجوزات</h2>
        
        <!-- عرض رسالة نجاح عملية الرفع في حال تمت -->
        <?php if(!empty($message)) echo "<div class='msg'>$message</div>"; ?>

        <!-- نموذج رفع الملفات مع خاصية enctype الإلزامية للملفات -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <p>اختر الملف المراد رفعه:</p>
            <input type="file" name="fileupload" required>
            
            <input type="submit" name="submitfile" value="رفع الملف">
        </form>

        <div class="home-link">
            <a href="index.php">العودة للصفحة الرئيسية</a>
        </div>
    </div>

</body>
</html>