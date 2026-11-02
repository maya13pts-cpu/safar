<?php
session_start();

// جلب المبلغ من الجلسة إذا كان موجوداً (من السلة)، أو استخدام 750 كقيمة افتراضية للعرض
$total_amount = 750;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $calculated_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $calculated_total += $item['price'];
    }
    if ($calculated_total > 0) {
        $total_amount = $calculated_total;
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الدفع | سَفَر</title>
    
    <!-- Bootstrap 5 RTL & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-brown: #3C2A21;
            --accent-gold: #C5A059;
            --gold-hover: #A6823C;
            --cream-bg: #FAF7F2;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(rgba(250, 247, 242, 0.9), rgba(245, 239, 230, 0.95)), url('hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: var(--primary-brown);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .checkout-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            border: 1px solid rgba(197, 160, 89, 0.3);
            box-shadow: 0 10px 30px rgba(60, 42, 33, 0.08);
            padding: 35px;
            width: 100%;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #E0D6C8;
            padding: 12px 15px;
            background-color: #FAF8F5;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 89, 0.25);
            background-color: #fff;
        }

        .btn-gold {
            background-color: var(--accent-gold);
            color: #fff !important;
            font-weight: 700;
            border-radius: 30px;
            padding: 12px 24px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(197, 160, 89, 0.3);
        }

        .payment-icons i {
            font-size: 1.8rem;
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <div class="container" style="max-width: 700px;">
        
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <!-- شاشة النجاح بعد الدفع -->
            <div class="checkout-card text-center py-5">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success fa-4x"></i>
                </div>
                <h2 class="fw-bold mb-3" style="color: var(--primary-brown);">تم تأكيد حجزك بنجاح!</h2>
                <p class="text-muted mb-4 fs-5">شكراً لاستخدامك منصة "سَفَر"، نتمنى لك رحلة ممتعة وتجربة سياحية استثنائية لا تُنسى.</p>
                <a href="index.php" class="btn btn-gold px-5 py-2 fs-6">العودة للرئيسية</a>
            </div>
        <?php else: ?>

            <!-- نموذج الدفع -->
            <div class="checkout-card">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h3 class="fw-bold mb-1"><i class="fa-solid fa-credit-card text-warning me-2"></i> بوابة الدفع الآمن</h3>
                        <p class="text-muted small mb-0">أدخل بيانات البطاقة لإتمام حجز تجربتك</p>
                    </div>
                    <div class="payment-icons d-none d-sm-block">
                        <i class="fa-brands fa-cc-visa" style="color: #1A1F71;"></i>
                        <i class="fa-brands fa-cc-mastercard" style="color: #EB001B;"></i>
                        <i class="fa-brands fa-apple-pay" style="color: #000;"></i>
                    </div>
                </div>

                <form action="checkout.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">الاسم على البطاقة</label>
                        <input type="text" class="form-control" placeholder="مثال: نورة السعيد" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">رقم البطاقة</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="4000 1234 5678 9010" maxlength="16" required>
                            <span class="input-group-text bg-white border-start-0" style="border-radius: 0 12px 12px 0;"><i class="fa-solid fa-lock text-muted"></i></span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label fw-bold">تاريخ الانتهاء</label>
                            <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">رمز الأمان (CVV)</label>
                            <input type="text" class="form-control" placeholder="123" maxlength="3" required>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 mb-4" style="background-color: #FAF5EE; border: 1px dashed var(--accent-gold);">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">إجمالي المبلغ المستحق:</span>
                            <span class="fw-bold text-success fs-4"><?= $total_amount ?> ر.س</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-3 fs-6 shadow-sm">
                        <i class="fa-solid fa-shield-halved me-2"></i> تأكيد وإتمام الدفع الآن
                    </button>
                </form>
            </div>

        <?php endif; ?>

    </div>

</body>
</html>