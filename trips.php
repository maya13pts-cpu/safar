<?php
session_start();

// إذا ضغط المستخدم على زر "إضافة إلى السلة"
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['trip_id'];
    $name = $_POST['trip_name'];
    $price = (float)$_POST['trip_price'];

    // إذا كانت الرحلة موجودة مسبقاً في السلة، نزيد العدد، وإلا نضيفها كجديدة
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];
    }
    
    // توجيه المستخدم لصفحة السلة مباشرة لرؤية الإضافة
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرحلات والفعاليات | سَفَر</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f7f3ed;
            --card-bg: #faf7f2;
            --primary-color: #8c6747;
            --primary-dark: #6e4e34;
            --accent-color: #b58356;
            --text-color: #3b2f28;
            --border-color: #e2d7c7;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--bg-color);
            margin: 0; padding: 0;
            color: var(--text-color);
            display: flex; flex-direction: column; min-height: 100vh;
        }

        header {
            background-color: #ffffff;
            border-bottom: 2px solid var(--border-color);
            padding: 15px 40px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo { font-size: 26px; font-weight: 700; color: var(--primary-color); text-decoration: none; }
        .logo span { color: var(--accent-color); font-weight: 400; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 25px; }
        nav a { text-decoration: none; color: var(--text-color); font-weight: 500; }
        nav a:hover, nav a.active { color: var(--primary-color); font-weight: 700; }

        main { flex: 1; padding: 40px 20px; max-width: 1000px; margin: auto; }
        h2 { text-align: center; color: var(--primary-color); margin-bottom: 30px; }

        .trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .trip-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(140, 103, 71, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .trip-title { font-size: 18px; font-weight: bold; color: var(--primary-color); margin-bottom: 10px; }
        .trip-price { font-size: 16px; font-weight: bold; color: var(--accent-color); margin-bottom: 15px; }
        
        .btn-add {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: bold;
            transition: background 0.3s;
            width: 100%;
        }
        .btn-add:hover { background-color: var(--primary-dark); }

        footer {
            background-color: var(--primary-dark);
            color: #ffffff;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">سَفَر <span>| Safar</span></a>
        <nav>
            <ul>
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="trips.php" class="active">الرحلات والفعاليات</a></li>
                <li><a href="cart.php">السلة</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>استعرض رحلاتنا وفعالياتنا التراثية</h2>
        
        <div class="trips-grid">
            <!-- رحلة 1 -->
            <div class="trip-card">
                <div>
                    <div class="trip-title">ورشة عمل صناعة الفخار التراثية</div>
                    <p style="font-size: 14px; color: #666;">تجربة تفاعلية لصناعة وتشكيل الفخار بالطرق التقليدية القديمة.</p>
                </div>
                <div>
                    <div class="trip-price">120.00 ر.س</div>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="1">
                        <input type="hidden" name="trip_name" value="ورشة عمل صناعة الفخار التراثية">
                        <input type="hidden" name="trip_price" value="120">
                        <button type="submit" name="add_to_cart" class="btn-add">إضافة إلى السلة</button>
                    </form>
                </div>
            </div>

            <!-- رحلة 2 -->
            <div class="trip-card">
                <div>
                    <div class="trip-title">رحلة السفاري واستكشاف الكثبان الرملية</div>
                    <p style="font-size: 14px; color: #666;">مغامرة مشوقة بين الكثبان الرملية الذهبية بروح الصحراء الأصيلة.</p>
                </div>
                <div>
                    <div class="trip-price">200.00 ر.س</div>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="2">
                        <input type="hidden" name="trip_name" value="رحلة السفاري واستكشاف الكثبان الرملية">
                        <input type="hidden" name="trip_price" value="200">
                        <button type="submit" name="add_to_cart" class="btn-add">إضافة إلى السلة</button>
                    </form>
                </div>
            </div>

            <!-- رحلة 3 -->
            <div class="trip-card">
                <div>
                    <div class="trip-title">جولة المعالم والمباني التاريخية القديمة</div>
                    <p style="font-size: 14px; color: #666;">جولة استكشافية لأبرز القلاع والمواقع التاريخية التراثية.</p>
                </div>
                <div>
                    <div class="trip-price">85.00 ر.س</div>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="3">
                        <input type="hidden" name="trip_name" value="جولة المعالم والمباني التاريخية القديمة">
                        <input type="hidden" name="trip_price" value="85">
                        <button type="submit" name="add_to_cart" class="btn-add">إضافة إلى السلة</button>
                    </form>
                </div>
            </div>

            <!-- رحلة 4 -->
            <div class="trip-card">
                <div>
                    <div class="trip-title">سهرة التخييم ورصد النجوم التراثية</div>
                    <p style="font-size: 14px; color: #666;">سهرة هادئة تحت نجوم الصحراء مع الضيافة العربية الأصيلة.</p>
                </div>
                <div>
                    <div class="trip-price">150.00 ر.س</div>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="4">
                        <input type="hidden" name="trip_name" value="سهرة التخييم ورصد النجوم التراثية">
                        <input type="hidden" name="trip_price" value="150">
                        <button type="submit" name="add_to_cart" class="btn-add">إضافة إلى السلة</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2026 جميع الحقوق محفوظة لـ منصة سَفَر (Safar)</p>
    </footer>

</body>
</html>
