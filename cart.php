   <?php
// تفعيل الأخطاء للاختبار
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// تهيئة السلة إن كانت فارغة
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        1 => ['name' => 'ورشة الفخار التراثية', 'price' => 120, 'quantity' => 2],
        2 => ['name' => 'رحلة السفاري الصحراوية', 'price' => 200, 'quantity' => 1]
    ];
}

// معالجة الحذف
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    header("Location: cart.php");
    exit();
}

// حساب المجموع
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سلة الحجوزات | سَفَر</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; background: #f7f3ed; color: #3b2f28; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #e2d7c7; }
        th { background: #8c6747; color: #fff; }
        .btn-del { color: #a94442; text-decoration: none; border: 1px solid #a94442; padding: 3px 8px; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">
    <h2>سلة الحجوزات | سَفَر</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p style="text-align:center;">السلة فارغة حالياً.</p>
    <?php else: ?>
        <table>
            <tr><th>الفعالية</th><th>السعر</th><th>العدد</th><th>الإجمالي</th><th>إجراء</th></tr>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                <td><?php echo $item['price']; ?> ر.س</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['price'] * $item['quantity']; ?> ر.س</td>
                <td><a href="cart.php?action=remove&id=<?php echo $id; ?>" class="btn-del">حذف</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h3>المجموع الإجمالي: <?php echo number_format($subtotal, 2); ?> ر.س</h3>
    <?php endif; ?>
</div>
</body>
</html> 
