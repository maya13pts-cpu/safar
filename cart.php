    <?php
session_start();

// الدوال البرمجية
function calculateSubtotal($items) {$total = 0;
    foreach ($items as $item) {$total += $item['price'] *$item['quantity']; }
    return $total;
}
function calculateVAT($amount) { return$amount * 0.15; }

// استعادة أو تهيئة السلة
if (!isset($_SESSION['cart']) && isset($_COOKIE['safar_saved_cart'])) {
    $_SESSION['cart'] = json_decode($_COOKIE['safar_saved_cart'], true);
}
if (!isset($_SESSION['cart'])) {$_SESSION['cart'] = [
        1 => ['name' => 'ورشة الفخار التراثية', 'price' => 120, 'quantity' => 2],
        2 => ['name' => 'رحلة السفاري الصحراوية', 'price' => 200, 'quantity' => 1]
    ];
}

// معالجة الحذف والتحديث
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'remove' && isset($_GET['id'])) unset($_SESSION['cart'][$_GET['id']]);
    if ($_GET['action'] == 'clear')$_SESSION['cart'] = [];
    setcookie("safar_saved_cart", json_encode($_SESSION['cart']), time() + 86400 * 7, "/");
    header("Location: cart.php"); exit();
}
if (isset($_POST['update_qty'])) {$_SESSION['cart'][$_POST['item_id']]['quantity'] = (int)$_POST['quantity'];
    setcookie("safar_saved_cart", json_encode($_SESSION['cart']), time() + 86400 * 7, "/");
}

// كوبون الخصم بالكوكيز
if (isset($_POST['apply_coupon']) &&$_POST['coupon_code'] === "SAFAR10") {
    setcookie("safar_coupon", "10", time() + 86400 * 30, "/");
    $msg = "تم تطبيق الخصم!";
}

$subtotal = calculateSubtotal($_SESSION['cart']);$discount = isset($_COOKIE['safar_coupon']) ?$subtotal * 0.10 : 0;
$vat = calculateVAT($subtotal -$discount);
$finalTotal = ($subtotal - $discount) +$vat;
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سلة الحجوزات | سَفَر</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f7f3ed;
            --primary-color: #8c6747;
            --primary-dark: #6e4e34;
            --accent-color: #b58356;
            --text-color: #3b2f28;
            --danger-color: #a94442;
            --border-color: #e2d7c7;
        }
        body { font-family: 'Tajawal', sans-serif; background: var(--bg-color); color: var(--text-color); margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #fff; border-bottom: 2px solid var(--border-color); padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 24px; font-weight: 700; color: var(--primary-color); text-decoration: none; }
        .logo span { color: var(--accent-color); font-weight: 400; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 20px; }
        nav a { text-decoration: none; color: var(--text-color); font-weight: 500; }
        nav a.active { color: var(--primary-color); font-weight: 700; }
        main { flex: 1; padding: 20px; }
        .container { max-width: 850px; margin: 20px auto; background: #fff; padding: 30px; border
