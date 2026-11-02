<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة الحجوزات | سَفَر</title>
    <!-- استيراد خط تجوال العربي -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f7f3ed;          /* خلفية صحراوية دافئة */
            --card-bg: #faf7f2;         /* خلفية البطاقات والصفوف */
            --primary-color: #8c6747;    /* لون طيني ترابي مستوحى من الفخار والشعار */
            --primary-dark: #6e4e34;     /* بني طيني غامق */
            --accent-color: #b58356;      /* بيج دافئ ورملي */
            --text-color: #3b2f28;        /* بني داكن للنصوص */
            --danger-color: #a94442;      /* أحمر خافض للحذف */
            --border-color: #e2d7c7;      /* حدود دافئة */
            --success-color: #4a6b5d;     /* أخضر هادئ ومتناسق مع الثيم للخصم */
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 20px;
            color: var(--text-color);
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(140, 103, 71, 0.08);
            border: 1px solid var(--border-color);
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 15px;
        }
        .header-title {
            margin: 0;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 24px;
        }
        .header-title span {
            font-weight: 400;
            color: var(--accent-color);
        }
        .back-btn {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background-color: var(--primary-color);
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }
        th {
            background-color: var(--primary-color);
            color: #ffffff;
            font-weight: 500;
        }
        tr:hover {
            background-color: var(--card-bg);
        }
        
        /* تنسيق مدخلات عدد التذاكر */
        .qty-input {
            width: 60px;
            padding: 6px 8px;
            text-align: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: 'Tajawal', sans-serif;
            font-size: 15px;
            font-weight: bold;
            color: var(--text-color);
            background-color: #fff;
            outline: none;
            transition: border-color 0.3s;
        }
        .qty-input:focus {
            border-color: var(--primary-color);
        }

        .btn-delete {
            background-color: transparent;
            color: var(--danger-color);
            border: 1px solid var(--danger-color);
            padding: 5px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background-color: var(--danger-color);
            color: #ffffff;
        }

        /* قسم كوبون الخصم */
        .coupon-section {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            background-color: var(--card-bg);
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed var(--border-color);
            align-items: center;
        }
        .coupon-input {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: 'Tajawal', sans-serif;
            outline: none;
        }
        .coupon-input:focus {
            border-color: var(--primary-color);
        }
        .coupon-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: bold;
            transition: background 0.3s;
        }
        .coupon-btn:hover {
            background-color: var(--primary-color);
        }
        .coupon-msg {
            font-size: 13px;
            margin-top: 5px;
            font-weight: bold;
        }

        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px dashed var(--border-color);
        }
        .cart-summary h3 {
            margin: 0;
            font-weight: 500;
        }
        .total-price {
            color: var(--primary-color);
            font-weight: 700;
        }
        .checkout-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            transition: background-color 0.3s ease, transform 0.2s;
            box-shadow: 0 4px 10px rgba(140, 103, 71, 0.2);
        }
        .checkout-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: var(--accent-color);
            padding: 30px;
            background-color: var(--card-bg);
            border-radius: 8px;
            border: 1px dashed var(--border-color);
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- ترويسة الصفحة مع زر العودة -->
        <div class="header-section">
            <h2 class="header-title">سلة الحجوزات <span>| سَفَر</span></h2>
            <a href="trips.html" class="back-btn">← العودة لاستعراض الرحلات</a>
        </div>

        <!-- جدول الحجوزات -->
        <table id="cartTable">
            <thead>
                <tr>
                    <th>اسم الرحلة / الفعالية</th>
                    <th>السعر الفردي</th>
                    <th>عدد التذاكر</th>
                    <th>الإجمالي الفرعي</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody id="cartItems">
                <tr>
                    <td><strong>ورشة عمل صناعة الفخار التراثية</strong></td>
                    <td class="unit-price" data-price="120">120.00 ر.س</td>
                    <td><input type="number" class="qty-input" value="2" min="1" onchange="updateRowTotal(this)"></td>
                    <td class="subtotal">240.00 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
                <tr>
                    <td><strong>رحلة السفاري واستكشاف الكثبان الرملية</strong></td>
                    <td class="unit-price" data-price="200">200.00 ر.س</td>
                    <td><input type="number" class="qty-input" value="1" min="1" onchange="updateRowTotal(this)"></td>
                    <td class="subtotal">200.00 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
                <tr>
                    <td><strong>جولة المعالم والمباني التاريخية القديمة</strong></td>
                    <td class="unit-price" data-price="85">85.00 ر.س</td>
                    <td><input type="number" class="qty-input" value="3" min="1" onchange="updateRowTotal(this)"></td>
                    <td class="subtotal">255.00 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
                <tr>
                    <td><strong>سهرة التخييم ورصد النجوم التراثية</strong></td>
                    <td class="unit-price" data-price="150">150.00 ر.س</td>
                    <td><input type="number" class="qty-input" value="2" min="1" onchange="updateRowTotal(this)"></td>
                    <td class="subtotal">300.00 ر.س</td>
                    <td><button class="btn-delete" onclick="removeItem(this)">حذف</button></td>
                </tr>
            </tbody>
        </table>

        <!-- قسم تطبيق كوبون الخصم -->
        <div style="margin-bottom: 10px;">
            <div class="coupon-section">
                <input type="text" id="couponInput" class="coupon-input" placeholder="ادخلي كود الخصم (مثال: SAFAR10)">
                <button class="coupon-btn" onclick="applyCoupon()">تطبيق الكوبون</button>
            </div>
            <div id="couponMessage" class="coupon-msg"></div>
        </div>

        <!-- رسالة السلة الفارغة -->
        <div id="emptyMessage" class="empty-cart">
            <p>السلة فارغة حالياً. لم تقومي بإضافة أي رحلات أو فعاليات بعد.</p>
        </div>

        <!-- ملخص السلة -->
        <div class="cart-summary" id="cartSummary">
            <h3>إجمالي المبلغ: <span id="totalAmount" class="total-price">995.00 ر.س</span></h3>
            <a href="#" class="checkout-btn" onclick="alert('تم الانتقال لصفحة الدفع بنجاح!'); return false;">الإنتقال لإتمام الحجز والدفع</a>
        </div>
    </div>

    <!-- كود JavaScript -->
    <script>
        let discountPercentage = 0; // نسبة الخصم المبدئية

        function updateRowTotal(input) {
            if (input.value < 1 || input.value === '') {
                input.value = 1;
            }
            const row = input.closest('tr');
            const price = parseFloat(row.querySelector('.unit-price').getAttribute('data-price'));
            const qty = parseInt(input.value);
            const subtotal = price * qty;
            row.querySelector('.subtotal').innerText = subtotal.toFixed(2) + ' ر.س';

            updateCartTotal();
        }

        function removeItem(button) {
            if (confirm("هل أنتِ متأكدة من حذف هذه الفعالية من السلة؟")) {
                const row = button.closest('tr');
                row.remove();
                updateCartTotal();
            }
        }

        function applyCoupon() {
            const code = document.getElementById('couponInput').value.trim();
            const msg = document.getElementById('couponMessage');

            // تجربة كوبون افتراضي باسم SAFAR10 يمنح خصم 10%
            if (code === "SAFAR10") {
                discountPercentage = 0.10;
                msg.style.color = "var(--success-color)";
                msg.innerText = "تم تطبيق الكوبون بنجاح! خصم 10%";
                updateCartTotal();
            } else {
                discountPercentage = 0;
                msg.style.color = "var(--danger-color)";
                msg.innerText = "كود الخصم غير صحيح أو منتهي الصلاحية.";
                updateCartTotal();
            }
        }

        function updateCartTotal() {
            const tbody = document.getElementById('cartItems');
            const rows = tbody.getElementsByTagName('tr');
            let total = 0;

            for (let i = 0; i < rows.length; i++) {
                const price = parseFloat(rows[i].querySelector('.unit-price').getAttribute('data-price'));
                const qty = parseInt(rows[i].querySelector('.qty-input').value);
                total += price * qty;
            }

            // تطبيق الخصم إن وجد
            if (discountPercentage > 0) {
                const discountAmount = total * discountPercentage;
                total = total - discountAmount;
            }

            document.getElementById('totalAmount').innerText = total.toFixed(2) + ' ر.س';

            if (rows.length === 0) {
                document.getElementById('cartTable').style.display = 'none';
                document.getElementById('couponInput').closest('.coupon-section').style.display = 'none';
                document.getElementById('cartSummary').style.display = 'none';
                document.getElementById('emptyMessage').style.display = 'block';
            }
        }
    </script>

</body>
</html>
