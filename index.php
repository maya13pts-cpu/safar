<?php
require_once 'db.php';

$result = mysqli_query($conn, "SELECT * FROM experiences");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>منصة سَفَر السياحية</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 20px; }
        h1 { color: #1e3a8a; text-align: center; }
        .container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 280px; padding: 15px; text-align: center; }
        .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; }
        .price { color: #059669; font-weight: bold; font-size: 1.1em; }
        .btn { display: inline-block; padding: 8px 15px; background-color: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>

    <h1>مرحباً بكم في منصة سَفَر ✈️</h1>
    <p style="text-align: center;">اكتشف أروع التجارب السياحية في المملكة</p>

    <div class="container">
        <?php while ($exp = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <img src="<?php echo $exp['image']; ?>" alt="<?php echo $exp['title']; ?>">
                <h3><?php echo $exp['title']; ?></h3>
                <p>المدينة: <?php echo $exp['city']; ?></p>
                <p class="price">السعر: <?php echo $exp['price']; ?> ريال</p>
                <p>المقاعد المتاحة: <?php echo $exp['seats']; ?></p>
                <a href="book.php?id=<?php echo $exp['id']; ?>" class="btn">احجز الآن</a>
            </div>
        <?php endwhile; ?>
    </div>
<div class="header-section" style="text-align: center; padding: 40px;">
    
    <!-- حطّي الأزرار هنا -->
    <div class="auth-buttons" style="margin-top: 20px;">
        <a href="register.php" class="btn" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">إنشاء حساب</a>
        <a href="login.php" class="btn" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px;">تسجيل الدخول</a>
    </div>
</div>
</body>
</html>