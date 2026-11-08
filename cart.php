<?php
session_start();
 
// 1. استقبال الرحلة المضافة من صفحة sefer.php وإضافتها للسلة
if (isset($_POST['name']) && isset($_POST['price'])) {
    $_SESSION['cart'][] = array(
        'name'  => $_POST['name'],
        'price' => $_POST['price']
    );
}

// 2. معالجة حذف رحلة من السلة
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>سلة الحجوزات | سَفَر SAFAR</title>
  <style>
    :root {
      --primary: #6b4c35;     /* اللون البني المستوحى من الشعار */
      --accent: #a37b5d;      /* البني الترابي الفاتح */
      --bg: #f4efe6;          /* الخلفية البيج الصحراوية */
      --card-bg: #ffffff;
      --text: #3e3229;        /* لون النص الداكن */
      --danger: #b23b3b;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      margin: 0;
      padding: 0;
      direction: rtl;
    }

    /* الهيدر مطابق لصفحة sefer */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: var(--card-bg);
      padding: 15px 40px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .logo {
      font-weight: bold;
      font-size: 1.2rem;
      color: var(--primary);
      letter-spacing: 1px;
    }

    .nav-links {
      display: flex;
      gap: 25px;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: var(--text);
      font-weight: 500;
      transition: 0.2s;
    }

    .nav-links a:hover, .nav-links a.active {
      color: var(--primary);
    }

    .back-btn {
      border: 1px solid var(--primary);
      padding: 6px 16px;
      border-radius: 6px;
    }

    .back-btn:hover {
      background-color: var(--primary);
      color: #fff !important;
    }

    /* الحاوية الرئيسية */
    .container {
      max-width: 750px;
      margin: 40px auto;
      padding: 20px;
    }

    h1 {
      color: var(--primary);
      margin-bottom: 25px;
      font-size: 1.8rem;
    }

    .cart-items {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 20px;
    }

    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--card-bg);
      padding: 18px 22px;
      border-radius: 12px;
      border-right: 5px solid var(--primary);
      box-shadow: 0 3px 8px rgba(0,0,0,0.03);
    }

    .delete-btn {
      background: none;
      border: 1px solid var(--danger);
      color: var(--danger);
      padding: 6px 14px;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      transition: 0.2s;
    }

    .delete-btn:hover {
      background-color: var(--danger);
      color: #ffffff;
    }

    /* ملخص السلة والدفع */
    .summary {
      background: var(--card-bg);
      padding: 22px;
      border-radius: 12px;
      display: flex;
      justify-content: space-between;
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 20px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.03);
    }

    .checkout-btn {
      width: 100%;
      background: var(--primary);
      color: white;
      border: none;
      padding: 14px;
      border-radius: 10px;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: 0.2s;
    }

    .checkout-btn:hover {
      background-color: #523927;
    }

    .empty {
      text-align: center;
      color: #777;
      padding: 40px;
      background: var(--card-bg);
      border-radius: 12px;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

  <!-- الهيدر الموحد -->
  <header class="navbar">
    <div class="logo">
      <span>SAFAR | سَفَر</span>
    </div>
    <div class="nav-links">
      <a href="sefer.php">الرئيسية</a>
      <a href="sefer.php">الرحلات والخدمات</a>
      <a href="cart.php" class="back-btn active">سلة الحجوزات</a>
    </div>
  </header>

  <!-- المحتوى -->
  <main class="container">
    <h1>سلة الحجوزات</h1>
    
    <div class="cart-items">
      <?php
      if (empty($_SESSION['cart'])) {
          echo '<div class="empty">السلة فارغة حالياً، ابدأ باختيار رحلتك المفضلة!</div>';
      } else {
          $items_count = count($_SESSION['cart']);
          echo "<div style='margin-bottom: 10px; font-weight: bold;'>عدد الرحلات المتاحة في السلة: " . $items_count . "</div>";

          foreach ($_SESSION['cart'] as $i => $item) {
              $trip_name = strtoupper($item['name']);
              echo '
              <div class="cart-item">
                <span><b>' . $trip_name . '</b></span>
                <div style="display: flex; align-items: center; gap: 15px;">
                  <span style="color: var(--accent); font-weight: bold;">' . $item['price'] . ' ر.س</span>
                  <a href="cart.php?remove=' . $i . '" class="delete-btn">حذف</a>
                </div>
              </div>';
          }
      }
      ?>
    </div>

    <div class="summary">
      <span>الإجمالي الكلي:</span>
      <span>
        <?php
        $total = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'];
            }
        }
        echo $total . ' ر.س';
        ?>
      </span>
    </div>

    <button class="checkout-btn" onclick="checkout()">إتمام الدفع</button>
  </main>

  <script>
    function checkout() {
      alert('تم إتمام الحجز بنجاح! شكراً لاختيارك سَفَر.');
    }
  </script>
</body>
</html>
